<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name'=>'Administrador',
          'email'=>'admin@ufrpe.br',
          'password'=>Hash::make('12345678'),
          'email_verified_at'=>'2020-01-01'
        ]);
    }
}
