<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageBookSeeder extends Seeder
{
    protected $arr = [
        [
            'book_id' => 1,
            'language_id' => 2
        ],
        [
            'book_id' => 1,
            'language_id' => 2
        ],
        [
            'book_id' => 1,
            'language_id' => 2
        ],
        [
            'book_id' => 2,
            'language_id' => 3
        ],
        [
            'book_id' => 1,
            'language_id' => 4
        ],
        [
            'book_id' => 1,
            'language_id' => 2
        ],
        [
            'book_id' => 5,
            'language_id' => 3
        ],
        [
            'book_id' => 5,
            'language_id' => 4
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
            DB::table('language_book')->insert([
                'book_id' => $value["book_id"],
                "language_id" => $value["language_id"],
                
            ]);
        }
    }
}
