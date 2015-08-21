$(document).ready(function () {
    setInterval(function () {
        $.get('/genealabs/laravel-caffeine/drip', function (result) {});
    }, 300000);
});
