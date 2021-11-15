<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Book;

class BookSeeder extends Seeder
{
    protected $arrInfoBook = [
        [
            "name_book" => "The Godfather",
            "type_id" => "9",
            "author" => "Mario Puzo",
            "translator" => "huy",
            "price" => "123000",
            "review" => "mafia Italy",
            "isbn" => "1123783",
            'publication_date' => '2002-11-25',
            'country_id' => '1'
        ],
        [
            "name_book" => "TMany Lives - Many Times",
            "type_id" => "2",
            "author" => "John Vũ - Nguyên Phong",
            "translator" => "unknown",
            "price" => "104.800",
            "review" => "Atlantis ",
            "isbn" => "1678676",
            'publication_date' => '2013-05-19',
            'country_id' => '22'
        ],
        [
            "name_book" => "Chủ Nghĩa Khắc Kỷ - Phong Cách Sống Bản Lĩnh Và Bình Thản",
            "type_id" => "3",
            "author" => " William B. Irvine",
            "translator" => "unknown",
            "price" => "96.250",
            "review" => "Kién thức bách khoa",
            "isbn" => "18465146",
            'publication_date' => '2021-12-30',
            'country_id' => '12'
        ],
        [
            "name_book" => "Nhà Giả Kim",
            "type_id" => "4",
            "author" => "Paulo Coelho",
            "translator" => "unknown",
            "price" => "54.000",
            "review" => "phiêu lưu",
            "isbn" => "179846513",
            'publication_date' => '1959-10-26',
            'country_id' => '23'
        ],
        [
            "name_book" => "Đàn Ông Sao Hỏa Đàn Bà Sao Kim",
            "type_id" => "5",
            "author" => "John Gray",
            "translator" => "unknown",
            "price" => "120.200",
            "review" => "Tư duy - kỹ năng",
            "isbn" => "198746532",
            'publication_date' => '2000-06-16',
            'country_id' => '34'
        ],
        [
            "name_book" => "Ba Người Thầy Vĩ Đại",
            "type_id" => "6",
            "author" => "Robin Sharma",
            "translator" => "unknown",
            "price" => "61.900",
            "review" => "Tư duy - kỹ năng",
            "isbn" => "1564511",
            'publication_date' => '2009-09-24',
            'country_id' => '4'
        ],
        [
            "name_book" => "Những Giấc Mơ Ở Hiệu Sách Morisaki",
            "type_id" => "7",
            "author" => "Yagisawa Satoshi",
            "translator" => "unknown",
            "price" => "42.500",
            "review" => "Văn học",
            "isbn" => "197846513",
            'publication_date' => '2006-01-03',
            'country_id' => '8'
        ],
        [
            "name_book" => "Những Tù Nhân Của Địa Lý",
            "type_id" => "8",
            "author" => "Tim Marshall",
            "translator" => "unknown",
            "price" => "154.900",
            "review" => "tình hình thế giới",
            "isbn" => "16654651",
            'publication_date' => '2007-05-13',
            'country_id' => '6'
        ],
        [
            "name_book" => "Yêu - Being In Love",
            "type_id" => "9",
            "author" => "Osh1o",
            "translator" => "unknown",
            "price" => "104.900",
            "review" => "yêu",
            "isbn" => "112654",
            'publication_date' => '2003-01-06',
            'country_id' => '4'
        ],
        [
            "name_book" => "Yêu - Being In Love1",
            "type_id" => "7",
            "author" => "Osho",
            "translator" => "unknown",
            "price" => "105.900",
            "review" => "yêu",
            "isbn" => "112654",
            'publication_date' => '2010-04-01',
            'country_id' => '2'
        ],
        [
            "name_book" => "Yêu - Being In Love2222",
            "type_id" => "8",
            "author" => "Osho",
            "translator" => "unknown",
            "price" => "104.000",
            "review" => "yêu",
            "isbn" => "112654",
            'publication_date' => '2001-05-07',
            'country_id' => '1'
        ],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        // foreach ($this->arrInfoBook as  $value) {
        //     // DB::table('books')->insert([
        //     //     'name_book' => $value["name"],
        //     //     "type_id" => $value["type_id"],
        //     //     "author" => $value["author"],
        //     //     "translator" => $value["translator"],
        //     //     "price" => $value["price"],
        //     //     "review" => $value["review"],
        //     //     "isbn" => $value["isbn"],
        //     // ]);
        //     Book::create($value);

        // }
        Book::factory(100)->create();
    }
}