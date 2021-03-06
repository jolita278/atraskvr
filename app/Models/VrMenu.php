<?php

namespace App\Models;



class VrMenu extends CoreModel
{
    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_menu';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'new_window', 'sequence', 'vr_parent_id'];

    protected $with = ['translation'];

    public function translation(){
        $lang = request('language_code');
        if($lang == null)
        $lang = app()->getLocale();

        return $this->hasOne(VrmenuTranslations::class, 'record_id', 'id')->where('language_code',$lang);
    }


}
