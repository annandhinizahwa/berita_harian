"use strict";

$(window).on("load", function () {
    $(".btn-tab-next").on("click", function (e) {
        e.preventDefault();
        $(".nav-tabs .nav-item > .active")
            .parent()
            .next("li")
            .find("a")
            .trigger("click");
    });
});
