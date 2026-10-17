<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Caches the rendered HTML of public pages for guests.
 *
 * The CSRF token is swapped for a placeholder before storing and filled in with
 * the visitor's own token on every hit, so forms on cached pages keep working.
 * Requests carrying flash data (form errors, old input, success messages), query
 * strings or a logged-in user always render fresh.
 *
 * Any Eloquent save/delete or settings save calls flush() (see AppServiceProvider),
 * so admin edits show up immediately.
 */
class CachePublicPage
{
    private const TOKEN_PLACEHOLDER = '__PAGE_CACHE_CSRF_TOKEN__';

    private const VERSION_KEY = 'page-cache:version';

    public function handle(Request $request, Closure $next, int $ttl = 600): SymfonyResponse
    {
        if (! $this->isCacheable($request)) {
            return $next($request);
        }

        $key = 'page-cache:' . Cache::get(self::VERSION_KEY, 0) . ':' . sha1($request->getHost() . $request->getPathInfo());

        if (is_string($html = Cache::get($key))) {
            return $this->htmlResponse($html, 'HIT');
        }

        $response = $next($request);

        if ($this->isStorable($response)) {
            Cache::put($key, str_replace(csrf_token(), self::TOKEN_PLACEHOLDER, $response->getContent()), $ttl);
            $response->headers->set('X-Page-Cache', 'MISS');
        }

        return $response;
    }

    public static function flush(): void
    {
        Cache::forever(self::VERSION_KEY, (string) microtime(true));
    }

    private function isCacheable(Request $request): bool
    {
        if (! $request->isMethodCacheable() || $request->getQueryString() !== null || $request->user()) {
            return false;
        }

        $session = $request->session();

        return empty($session->get('_flash.old')) && ! $session->has('errors') && ! $session->has('_old_input');
    }

    private function isStorable(SymfonyResponse $response): bool
    {
        return $response instanceof Response
            && $response->getStatusCode() === 200
            && str_contains((string) $response->headers->get('Content-Type'), 'text/html');
    }

    private function htmlResponse(string $html, string $status): Response
    {
        return response(str_replace(self::TOKEN_PLACEHOLDER, csrf_token(), $html))
            ->header('Content-Type', 'text/html; charset=UTF-8')
            ->header('X-Page-Cache', $status);
    }
}
