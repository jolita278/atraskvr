<?php

use App\Models\VrMenuTranslations;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VrLanguageCodesSeeder::class);
        $this->call(VrRolesSeeder::class);
    }


}
