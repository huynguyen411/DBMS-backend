<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    protected $arr = [
        ['name' => 'Action and Adventure'],
        ['name' => 'Classics'],
        ['name' => 'Comic Book or Graphic Novel'],
        ['name' => 'Fantasy'],
        ['name' => 'Historical Fiction'],
        ['name' => 'Horror'],
        ['name' => 'Literary Fiction'],
        ['name' => 'Romance'],
        ['name' => 'Science Fiction'],
        ['name' => 'Short Stories'],
        ['name' => 'Suspense and Thrillers'],
        ['name' => 'Biographies and Autobiographies'],
        ['name' => 'Cookbooks'],        
        ['name' => 'Poetry'],        
        ['name' => 'History'],        
        ['name' => 'Self-Help'],        
        ['name' => 'Cookbooks'],        
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->arr as  $value) {
            // DB::table('types')->insert([

            //     "name" => $value["name"],
            //     'code' => $value["code"],

            // ]);

            Type::create($value);
        }
        //Type::factory(10)->create();
    }
}