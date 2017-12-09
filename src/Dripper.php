<?php namespace GeneaLabs\LaravelCaffeine;

use Jenssegers\Model\Model;

/**
 * @property string $html
 * @property string $interval
 * @property string $url
 */
class Dripper extends Model
{
    public function getHtmlAttribute() : string
    {
        
        return '<script>'
            . "let ld = new Date();"
            . "function caffeineSendDrip () {"
            . "    let e = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');"
            . "    e.onreadystatechange = function () {"
            . "        if (e.readyState === 4 && e.status === 204) {"
            . "            ld = new Date();"
            . "        }"
            . "    };"
            . "    e.open('GET', '{$this->url}', !0);"
            . "    e.setRequestHeader('X-Requested-With', 'XMLHttpRequest');"
            . "    e.send();"
            . "}"
            . "setInterval(function () { caffeineSendDrip(); }, $this->interval);"
            . "setInterval(function () {"
            . "    if (new Date() - ld >= $this->interval + $this->threshold) {"
            . "        location.reload(true);"
            . "    }"
            . "}, $this->checkInterval);"
            . "</script>";
    }

    public function getIntervalAttribute() : string
    {
        return config(
            'genealabs-laravel-caffeine.dripIntervalInMilliSeconds',
            300000
        );
    }
    
    public function getThresholdAttribute() : int
    {
        return config(
            'genealabs-laravel-caffeine.thresholdDifference',
            10000
        );
    }
    
    public function getCheckIntervalAttribute() : int
    {
        return config(
            'genealabs-laravel-caffeine.checkLastDripInterval',
            2000
        );
    }

    public function getUrlAttribute() : string
    {
        return trim(config('genealabs-laravel-caffeine.domain', url('/')), '/')
            . '/'
            . trim(config(
                'genealabs-laravel-caffeine.route',
                'genealabs/laravel-caffeine/drip'
            ), '/');
    }
}
