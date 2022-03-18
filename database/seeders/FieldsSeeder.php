<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::truncate();

        Field::insert([
            ['field_type' => "input"],
            ['field_type' => "number"],
            ['field_type' => "select"],
        ]);
    }
}
