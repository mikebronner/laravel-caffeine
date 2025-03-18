@if (function_exists('csp_nonce'))
<script nonce="{{ csp_nonce() }}">
@else
<script>
@endif
    window.timers = window.timers || [];

    function startInterval(key, callback, delay) {
        // If an interval with the same key already exists, clear it
        if (window.timers[key]) {
            clearInterval(window.timers[key]);
        }
        // Start a new interval and store its ID in the timers object
        window.timers[key] = setInterval(callback, delay);
    }

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
    };

    var caffeineReload = function () {
        if (new Date() - lastCheck >= {{ $ageCheckInterval + $ageThreshold }}) {
            setTimeout(function () {
                location.reload();
            },  Math.max(0, {{ $ageCheckInterval }} - 500) )
        }
    };

    startInterval('dripTimer', caffeineSendDrip, {{ $interval }});

    if ({{ $ageCheckInterval }} > 0) {
        startInterval('ageTimer', caffeineReload, {{ $ageCheckInterval }});
    }
</script>
