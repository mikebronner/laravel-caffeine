<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCaffeine;

class Dripper
{
    public function getHtml(): string
    {
        return (string) view("genealabs-laravel-caffeine::script")
            ->with([
                "ageCheckInterval" => $this->getAgeCheckInterval(),
                "ageThreshold" => $this->getAgeThreshold(),
                "interval" => $this->getInterval(),
                "url" => $this->getUrl(),
            ]);
    }

    protected function getAgeCheckInterval(): int
    {
        return config("genealabs-laravel-caffeine.outdated-drip-check-interval", 2000);
    }

    protected function getAgeThreshold(): int
    {
        return (config("session.lifetime", 32) - 2) * 60000;
    }

    protected function getInterval(): int
    {
        return config("genealabs-laravel-caffeine.drip-interval", 300000);
    }

    protected function getUrl(): string
    {
        return trim(config("genealabs-laravel-caffeine.domain") ?? url("/"), "/")
            . "/"
            . trim(
                config("genealabs-laravel-caffeine.route", "genealabs/laravel-caffeine/drip"),
                "/",
            );
    }
}
