<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('Companies')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'company_name'=> 'コカ・コーラ',
                'street_address'=> '茨城県',
                'representative_name'=> '藤田',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'company_name'=> 'サントリー',
                'street_address'=> '千葉県',
                'representative_name'=> '宮本',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'company_name'=> 'アサヒ',
                'street_address'=> '東京都',
                'representative_name'=> '紀谷',
            ],
        ]);
    }
}
