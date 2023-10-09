<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::get();
        return view('index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required',
            'isi' => 'required',
        ]);

        $berita = Berita::create([
            'subjek' => $request->subjek,
            'isi' => $request->isi,
        ]);

        // perbedaan waktu antara waktu pembuatan berita dan waktu saat ini
        $waktuBerita = Carbon::parse($berita->created_at);
        $waktuSekarang = Carbon::now();
        $perbedaanWaktu = $waktuBerita->diffForHumans($waktuSekarang);

        // telegram
        $message = "Ada berita baru!\n\nSubjek : {$request->subjek}\nIsi : {$request->isi}\nDibuat : {$perbedaanWaktu}";

        Telegram::sendMessage([
            'chat_id' => 896883392,
            'text' => $message,
        ]);

        return redirect()->route('berita.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::where('id', $id)->first();
        return view('detail', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::where('id', $id)->first();
        return view('edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subjek' => 'required',
            'isi' => 'required',
        ]);

        Berita::where('id', $id)->update([
            'subjek' => $request->subjek,
            'isi' => $request->isi,
        ]);

        return redirect()->route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Berita::where('id', $id)->delete();

        return redirect(route('berita.index'));
    }
}
