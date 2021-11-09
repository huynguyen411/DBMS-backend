<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    protected $arr = [
        [
            'code' => 'U-001',
            'name' => 'user-001'
        ],
        [
            'code' => 'A-001',
            'name' => 'admin-001'
        ],
        [
            'code' => 'A-002',
            'name' => 'admin-002'
        ],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->arr as  $value) {
            DB::table('roles')->insert([
                'code' => $value["code"],
                'name' => $value["name"],
            ]);
        }

    }
}
