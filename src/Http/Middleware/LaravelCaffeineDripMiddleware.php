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

        if (is_string($content)
            && (strpos($content, '_token')
                || (preg_match("/\<meta name=[\"\']csrf[_-]token[\"\']/", $content)))
        ) {
            $dripper = (new Dripper);
            $content = str_replace(
                '</body>',
                "{$dripper->html}</body>",
                $content
            );
            $response->setContent($content);
        }

        return $response;
    }
}
