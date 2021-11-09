<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BorrowingStatusSeeder extends Seeder
{

    protected $arr = [
        [
            'status_name' => 'Đang mượn',
        ],
        [
            'status_name' => 'Xác nhận đã trả sách',
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
            DB::table('borrowing_status')->insert([
                'status_name' => $value["status_name"],
                
            ]);
        }
    }
}
