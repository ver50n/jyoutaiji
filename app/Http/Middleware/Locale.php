<?php

namespace App\Http\Middleware;

use App;
use Session;
use Closure;
use Config;
use Lang;
use Carbon\Carbon;
use App\Helpers\LocaleUtils;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(\Auth::check()) {
            $locale = Session::get('locale') ?
                Session::get('locale') :
                'ja';
        } else {
            $locale = Session::get('locale') ? Session::get('locale') : 'ja';

            if(!$locale) {
                $countryCode = Session::get('country') ? 
                    Session::get('country') : null;
                    
                if(!$countryCode)
                    $countryCode = \App\Helpers\Teleport::getCountryCode();

                $locale = ($countryCode && isset(\App\Helpers\ApplicationConstant::COUNTRY_LANGUAGE[$countryCode])) ?
                    \App\Helpers\ApplicationConstant::COUNTRY_LANGUAGE[$countryCode] :
                    config('app.fallback_locale');
            }
        }

        Session::put('locale', $locale);
        app()->setLocale($locale);

        return $next($request);
    }
}
