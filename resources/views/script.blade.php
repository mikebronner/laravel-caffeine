<script>
    var lastCheck = new Date();
    var caffeineSendDrip = function () {
        var ajax = window.XMLHttpRequest
            ? new XMLHttpRequest
            : new ActiveXObject('Microsoft.XMLHTTP');

        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4 && ajax.status === 204) {
                lastCheck = new Date();
            }
        };

        ajax.open('GET', '{{ $url }}');
        ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        ajax.send();
    }

    setInterval(function () {
        caffeineSendDrip();
    }, {{ $interval }});

    if ({{ $ageCheckInterval }} > 0) {
        setInterval(function () {
            if (new Date() - lastCheck >= {{ $ageCheckInterval + $ageThreshold }}) {
                location.reload(true);
            }
        }, {{ $ageCheckInterval }});
    }
</script>
