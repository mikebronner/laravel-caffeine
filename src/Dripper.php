<?php namespace GeneaLabs\LaravelCaffeine;

use Jenssegers\Model\Model;

class Dripper extends Model
{
    public function getHtmlAttribute() : string
    {
        return (string) view('genealabs-laravel-caffeine::script')
            ->with([
                'ageCheckInterval' => $this->ageCheckInterval,
                'ageThreshold' => $this->ageThreshold,
                'interval' => $this->interval,
                'url' => $this->url,
            ]);
    }

    public function getAgeCheckIntervalAttribute() : int
    {
        return config(
            'genealabs-laravel-caffeine.outdated-drip-check-interval',
            2000
        );
    }

    public function getAgeThresholdAttribute() : int
    {
        return (config('session.lifetime', 32) - 2) * 60000;
    }

    public function getIntervalAttribute() : string
    {
        return config(
            'genealabs-laravel-caffeine.drip-interval',
            300000
        );
    }

    public function getUrlAttribute() : string
    {
        return trim(config('genealabs-laravel-caffeine.domain') ?? url('/'), '/')
            . '/'
            . trim(config(
                'genealabs-laravel-caffeine.route',
                'genealabs/laravel-caffeine/drip'
            ), '/');
    }
}
