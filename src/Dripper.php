<?php namespace GeneaLabs\LaravelCaffeine;

use Jenssegers\Model\Model;

/**
 * @property string $url
 * @property string $interval
 */
class Dripper extends Model
{
    public function getUrlAttribute() : string
    {
        return trim(config('genealabs-laravel-caffeine.domain', url('/')), '/')
            . '/'
            . trim(config(
                'genealabs-laravel-caffeine.route',
                'genealabs/laravel-caffeine/drip'
            ), '/');
    }

    public function getIntervalAttribute() : string
    {
        return config(
            'genealabs-laravel-caffeine.dripIntervalInMilliSeconds',
            300000
        );
    }

    public function getHtmlAttribute() : string
    {
        return '<script>setInterval(function(){'
            . "var e=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');"
            . "e.open('GET','{$this->url}',!0);"
            . "e.setRequestHeader('X-Requested-With','XMLHttpRequest');"
            . "e.send();}, {$this->interval});</script>";
    }
}
