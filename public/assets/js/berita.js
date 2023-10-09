import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

// Mendapatkan waktu berita dari server
var waktuBerita = "{{ $berita->created_at }}"; // Ganti dengan cara yang sesuai untuk mendapatkan waktu berita

// Memformat waktu dengan Day.js
var waktuFormatted = dayjs(waktuBerita).fromNow();

// Menampilkan waktu pada elemen HTML yang sesuai
document.getElementById('waktu-berita').textContent = waktuFormatted;
