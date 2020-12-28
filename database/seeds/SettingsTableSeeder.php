<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name' => "Laravel's Blog",
            'address' => 'cairo, Eygpt',
            'contact_number' => '01146324208',
            'contact_email' => 'magdymostafa@gmail.com'
        ]);
    }
}
