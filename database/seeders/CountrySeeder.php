<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CountrySeeder extends Seeder
{
    protected $arr = [
        ['code' => 'VNM', 'name' => 'Việt Nam'],
        ['code' => 'JAN', 'name' => 'Japan'],
        ['code' => 'SIN', 'name' => 'Singapo'],
        ['code' => 'ALB', 'name' => 'Albania'],
        ['code' => 'DZA', 'name' => 'Algérie'],
        ['code' => 'ASM', 'name' => 'American Samoa'],
        ['code' => 'AGO', 'name' => 'Angola'],
        ['code' => 'AIA', 'name' => 'Anguilla'],
        ['code' => 'ATA', 'name' => 'Antarctica'],
        ['code' => 'ARG', 'name' => 'Argentina'],
        ['code' => 'ARM', 'name' => 'Armenia'],
        ['code' => 'ABW', 'name' => 'Aruba'],
        ['code' => 'AUS', 'name' => 'Australia'],
        ['code' => 'AUT', 'name' => 'Austria'],
        ['code' => 'AZE', 'name' => 'Azerbaijan'],
        ['code' => 'BHS', 'name' => 'Bahamas'],
        ['code' => 'BHR', 'name' => 'Bahrain'],
        ['code' => 'BGD', 'name' => 'Bangladesh'],
        ['code' => 'BRB', 'name' => 'Barbados'],
        ['code' => 'BLR', 'name' => 'Belarus'],
        ['code' => 'BEL', 'name' => 'Bỉ'],
        ['code' => 'BLZ', 'name' => 'Belize'],
        ['code' => 'BEN', 'name' => 'Benin'],
        ['code' => 'BMU', 'name' => 'Bermuda'],
        ['code' => 'BTN', 'name' => 'Bhutan'],
        ['code' => 'BOL', 'name' => 'Bolivia'],
        ['code' => 'BES', 'name' => 'Bonaire, Saint Eustatius and Saba'],
        ['code' => 'BIH', 'name' => 'Bosna và Hercegovina'],
        ['code' => 'BWA', 'name' => 'Botswana'],
        ['code' => 'IOT', 'name' => 'British Indian Ocean Territories'],
        ['code' => 'VGB', 'name' => 'British Virgin Islands'],
        ['code' => 'BGR', 'name' => 'Bulgaria'],
        ['code' => 'BRA', 'name' => 'Brasil'],
        ['code' => 'BRN', 'name' => 'Brunei'],
        ['code' => 'BDI', 'name' => 'Burundi'],
        ['code' => 'KHM', 'name' => 'Campuchia'],
        ['code' => 'CMR', 'name' => 'Cameroon'],
        ['code' => 'CAN', 'name' => 'Canada'],
        ['code' => 'CYM', 'name' => 'Cayman Islands'],
        ['code' => 'CAF', 'name' => 'Trung Phi'],
        ['code' => 'TCD', 'name' => 'Tchad'],
        ['code' => 'CHL', 'name' => 'Chile'],
        ['code' => 'CHN', 'name' => 'Trung Quốc'],
        ['code' => 'HKG', 'name' => 'China, Hong Kong Special Administrative Region'],
        ['code' => 'MAC', 'name' => 'China, Macao Special Administrative Region'],
        ['code' => 'CXR', 'name' => 'Christmas Islands'],
        ['code' => 'CCK', 'name' => 'Cocos Islands'],
        ['code' => 'COL', 'name' => 'Colombia'],
        ['code' => 'COM', 'name' => 'Comoros'],
        ['code' => 'COG', 'name' => 'Cộng hòa Congo'],
        ['code' => 'COK', 'name' => 'Cook Islands'],
        ['code' => 'CRI', 'name' => 'Costa Rica'],
        ['code' => 'CIV', 'name' => 'Bờ Biển Ngà'],
        ['code' => 'HRV', 'name' => 'Croatia'],
        ['code' => 'CUB', 'name' => 'Cuba'],
        ['code' => 'CUW', 'name' => 'Curaçao'],
        ['code' => 'CYP', 'name' => 'Cộng hoà Síp'],
        ['code' => 'CZE', 'name' => 'Séc'],
        ['code' => 'CSK', 'name' => 'Czechoslovakia'],
        ['code' => 'PRK', 'name' => 'Triều Tiên'],
        ['code' => 'COD', 'name' => 'Cộng hòa Dân chủ Congo'],
        ['code' => 'DNK', 'name' => 'Đan Mạch'],
        ['code' => 'DJI', 'name' => 'Djibouti'],
        ['code' => 'DMA', 'name' => 'Dominica'],
        ['code' => 'DOM', 'name' => 'Cộng hòa Dominicana'],
        ['code' => 'PAK', 'name' => 'Pakistan'],
        ['code' => 'EGY', 'name' => 'Egypt']
    ];
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // foreach ($this->arr as  $value) {
        //     DB::col('countries')->insert([
        //         'name' => $value["name"],
        //     ]);
        // }
        Country::factory(10)->create();
    }
}