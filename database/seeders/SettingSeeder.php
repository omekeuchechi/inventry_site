<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'company_name',
        // 'favicon',
        // 'keywords',
        // 'web_color',
        // 'logo',
        Settings::updateOrCreate(
            ['id' => 1],
            ['company_name' => 'Inventry'],
            // ['favicon' => 'img/favicon'],
            // ['keywords' => 'inventry, inventory, management'],
            // ['web_color' => '#3490dc'],
            // ['logo' => 'img/logo'],
        );
    }
}
