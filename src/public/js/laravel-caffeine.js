(function (url, interval) {
    var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var drip = function () {
        request.open('GET', url, true);
        request.send();
    };

    setInterval(drip, interval);
}('/genealabs/laravel-caffeine/drip', 300000));
