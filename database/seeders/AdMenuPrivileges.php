<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdMenuPrivileges extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('cms_moduls')->where('id', '>=', 12)->delete();
        // DB::statement('ALTER TABLE cms_moduls AUTO_INCREMENT = 12');
        $data = [
            [
                'id_ad_menus' => 1,
                'id_ad_privileges' => 1
            ],
            [
                'id_ad_menus' => 2,
                'id_ad_privileges' => 1
            ],
            [
                'id_ad_menus' => 3,
                'id_ad_privileges' => 1
            ],
            [
                'id_ad_menus' => 3,
                'id_ad_privileges' => 2
            ]
        ];
        DB::table('ad_menus_privileges')->insert($data);

    }
}