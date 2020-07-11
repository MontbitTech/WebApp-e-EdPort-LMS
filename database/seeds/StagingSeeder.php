<?php

use Illuminate\Database\Seeder;

class StagingSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () {
        $this->settingTableSeeds();
        $this->adminTableSeeds();
    }

    private function settingTableSeeds () {
        DB::table('tbl_settings')->insert([
            [
                'item'       => 'domain',
                'value'      => 'schooltimes-s.ca',
                'folder'     => null,
                'permission' => 'D',
            ],
            [
                'item'       => 'year',
                'value'      => '1522',
                'folder'     => null,
                'permission' => 'DE',
            ],
            [
                'item'       => 'mailfrom',
                'value'      => 'noreply@schooltimes-s.ca',
                'folder'     => null,
                'permission' => 'D',
            ],
            [
                'item'       => 'schoolname',
                'value'      => 'DPS Chennai',
                'folder'     => null,
                'permission' => 'DE',
            ],
            [
                'item'       => 'schoollogo',
                'value'      => env('APP_URL').'/public/images/Delhi-Public-School-Kolar-Road-Bhopal.png',
                'folder'     => 'images',
                'permission' => 'DF',
            ],
            [
                'item'       => 'schooladdress',
                'value'      => 'DPS Bhopal',
                'folder'     => null,
                'permission' => 'DEN',
            ],
        ]);
    }

    private function adminTableSeeds () {
        DB::table('tbl_admin')->insert([
            'first_name' => 'Admin',
            'last_name'  => 'Sys',
            'email'      => 'developer@schooltimes-s.ca',
            'password'   => '',
            'phone'      => '7981921945',
        ]);
    }
}
