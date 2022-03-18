<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Form;
use App\Models\FormField;
use App\Models\Field;
use Illuminate\Support\Arr;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Form::truncate();
        FormField::truncate();

        $form = Form::create([
            'form_name' => 'Test Form'
        ]);
    }
}
