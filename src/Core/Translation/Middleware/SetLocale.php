<?php

namespace Raakkan\Yali\Core\Translation\Middleware;

use Closure;
use Illuminate\Http\Request;
use Raakkan\Yali\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defaultLanguage = Language::getDefaultLanguage();

        $code = $defaultLanguage ? $defaultLanguage->code : config('app.locale');

        App::setLocale($code);

        return $next($request);
    }
}

