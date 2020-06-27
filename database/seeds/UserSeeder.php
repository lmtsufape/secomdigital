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
          'email'=>'secom@ufape.edu.br',
          'password'=>Hash::make('qazwsx@123'),
          'email_verified_at'=>'2020-01-01'
        ]);
    }
}
