<?php namespace GeneaLabs\LaravelCaffeine\Http\Middleware;

use Closure;
use GeneaLabs\LaravelCaffeine\Dripper;
use Illuminate\Http\Request;

class LaravelCaffeineDripMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $content = $response->getContent();

        if (! is_string($content) || strlen(trim($content)) === 0) {
            return $response;
        }

        $shouldDripRegexp = $this->makeRegex([
            '<meta\s+',
            '(name\s*=\s*[\'"]caffeinated[\'"]\s+content\s*=\s*[\'"]false[\'"]',
            '|content\s*=\s*[\'"]false[\'"]\s+name\s*=\s*[\'"]caffeinated[\'"])',
        ]);

        $shouldNotDrip = preg_match($shouldDripRegexp, $content);

        if ($shouldNotDrip) {
            return $response;
        }

        $formTokenRegexp = $this->makeRegex([
            "<input.*?name\s*=\s*[\'\"]_token[\'\"]",
        ]);
        $metaTokenRegexp = $this->makeRegex([
            "<meta.*?name\s*=\s*[\'\"]csrf[_-]token[\'\"]",
        ]);
        $hasNoFormToken = ! preg_match($formTokenRegexp, $content);
        $hasNoMetaToken = ! preg_match($metaTokenRegexp, $content);

        if ($hasNoFormToken && $hasNoMetaToken) {
            return $response;
        }

        $dripper = (new Dripper);
        $content = preg_replace('/(<\/html>)\s*\z/', $dripper->html . "</html>", $content);

        if (! preg_match_all('/(<\/html>)\s*\z/', $content, $matches)) {
            $content .= $dripper->html;
        }

        $original = $response->original;
        $response->setContent($content);
        $response->original = $original;

        return $response;
    }

    protected function makeRegex(array $regexp) : string
    {
        return '/' . implode('', $regexp) . '/';
    }
}
