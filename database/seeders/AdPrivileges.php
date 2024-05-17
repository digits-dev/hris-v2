<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdPrivileges extends Seeder
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
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'Super Administrator',
                'is_superadmin' => 1,
            ],
        ];

        foreach ($data as $priv) {
            DB::table('ad_privileges')->updateOrInsert(['name' => $priv['name']], $priv);
        }

    }
}