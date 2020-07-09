<?php

use Illuminate\Database\Seeder;
use App\HelpTicketCategory;

class HelpTicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HelpTicketCategory::insert([
            ['category'=>'Live Class'],
            ['category'=>'Assignment'],
            ['category'=>'Content'],
            ['category'=>'Others']
        ]);
    }
}
