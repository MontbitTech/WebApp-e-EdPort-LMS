<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->settingTableSeeds();
        $this->adminTableSeeds();
    }

    private function settingTableSeeds()
    {
        DB::table('tbl_settings')->insert([
            [
                'item'       => 'domain',
                'value'      => env('APP_DOMAIN'),
                'folder'     => null,
                'permission' => 'D',
            ],
            [
                'item'       => 'year',
                'value'      => date("Y"),
                'folder'     => null,
                'permission' => 'DE',
            ],
            [
                'item'       => 'mailfrom',
                'value'      => env('MAIL_USERNAME'),
                'folder'     => null,
                'permission' => 'D',
            ],
            [
                'item'       => 'schoolname',
                'value'      => env('SCHOOL_NAME'),
                'folder'     => null,
                'permission' => 'DE',
            ],
            [
                'item'       => 'schoollogo',
                'value'      => env('APP_URL') . '/images/Delhi-Public-School-Kolar-Road-Bhopal.png',
                'folder'     => 'images',
                'permission' => 'DF',
            ],
            [
                'item'       => 'schooladdress',
                'value'      => env('SCHOOL_ADDRESS'),
                'folder'     => null,
                'permission' => 'DEN',
            ],
        ]);
    }

    private function adminTableSeeds()
    {
        DB::table('tbl_admin')->insert([
            'first_name' => 'School',
            'last_name'  => 'Coordinator',
            'email'      => env('MAIL_USERNAME'),
            'password'   => env('MAIL_PASSWORD'),
            'phone'      => env('SCHOOL_ADMIN_CONTACT'),
        ]);
    }
}
