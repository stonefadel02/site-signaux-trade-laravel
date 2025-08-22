<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('app_locale');
        if (!$locale) {
            // Détection simple via header navigateur (fr ou en), sinon config locale
            $preferred = $request->getPreferredLanguage(['fr', 'en']);
            $locale = $preferred ?? config('app.locale');
            session(['app_locale' => $locale]);
        }
        App::setLocale($locale);
        return $next($request);
    }
}
