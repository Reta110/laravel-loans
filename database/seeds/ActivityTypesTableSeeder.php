<?php

use Illuminate\Database\Seeder;

class ActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('activity_types')->insert([
        'id' => 1,
        'name' => 'Pago',
      ]);

      DB::table('activity_types')->insert([
        'id' => 2,
        'name' => 'Pago Final',
      ]);

    }
}
