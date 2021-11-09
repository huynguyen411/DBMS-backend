<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BookContentSeeder extends Seeder
{
    protected $arr = [
        [
            "book_id" => "1",
            "quantity" => "12",
        ],
        [
            "book_id" => "2",
            "quantity" => "20",
        ],
        [
            "book_id" => "3",
            "quantity" => "35",
        ],
        [
            "book_id" => "4",
            "quantity" => "69",
        ],
        [
            "book_id" => "5",
            "quantity" => "4",
        ],
        [
            "book_id" => "6",
            "quantity" => "112",
        ],
        [
            "book_id" => "7",
            "quantity" => "0",
        ],
        [
            "book_id" => "8",
            "quantity" => "7",
        ],
        [
            "book_id" => "9",
            "quantity" => "6",
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
            DB::table('book_contents')->insert([
                'book_id' => $value["book_id"],
                "quantity" => $value["quantity"],
               
            ]);
        }
    }
}
