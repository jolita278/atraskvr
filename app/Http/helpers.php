<?php

use App\Models\VrLanguageCodes;

function getActiveLanguage()
{
    $locale = app()->getLocale();

    $lang = VrLanguageCodes::where('is_active', '1')->pluck('name', 'id')->toArray();

    if (!isset($lang[$locale])) {
        $locale = config('app.fallback_locale');

        if (!isset($lang[$locale]))
            return $lang;
    }

    $lang = array($locale => $lang[$locale]) + $lang;

    return $lang;
}
