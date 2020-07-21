<?php

use App\HelpTicketCategory;
use Illuminate\Database\Seeder;

class StagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $this->settingTableSeeds();
        $this->adminTableSeeds();
        $this->classesAndSubjectSeeds();
        $this->categoryTableSeeds();
    }

    private function settingTableSeeds ()
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
                'value'      => 'noreply@' . env('APP_DOMAIN'),
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
                'value'      => env('APP_URL') . '/public/images/Delhi-Public-School-Kolar-Road-Bhopal.png',
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

    private function adminTableSeeds ()
    {
        DB::table('tbl_admin')->insert([
            'first_name' => 'Admin',
            'last_name'  => 'Sys',
            'email'      => env('MAIL_USERNAME'),
            'password'   => '',
            'phone'      => '7981921945',
        ]);
    }

    private function classesAndSubjectSeeds ()
    {
        DB::table('tbl_classes')->insert([
            'class_name'   => 10,
            'section_name' => 'A',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        DB::table('tbl_student_subjects')->insert([
            'subject_name' => 'English',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);
    }

    private function categoryTableSeeds ()
    {
        HelpTicketCategory::insert([
            ['category' => 'Live Class'],
            ['category' => 'Assignment'],
            ['category' => 'Content'],
            ['category' => 'Others'],
        ]);
    }
}
