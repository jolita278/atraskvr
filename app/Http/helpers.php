<?php

use App\Models\VrLanguageCodes;

function getActiveLanguage()
{
    $lang = VrLanguageCodes::where('is_active', '1')->pluck('id', 'name');
    return $lang;
}
