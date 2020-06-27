<?php

use Illuminate\Database\Seeder;

class FontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-Bold',
	        'file_name' => public_path("font/OpenSans-Bold.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-BoldItalic',
	        'file_name' => public_path("font/OpenSans-BoldItalic.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-ExtraBold',
	        'file_name' => public_path("font/OpenSans-ExtraBold.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-ExtraBoldItalic',
	        'file_name' => public_path("font/OpenSans-ExtraBoldItalic.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-Italic',
	        'file_name' => public_path("font/OpenSans-Italic.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-Light',
	        'file_name' => public_path("font/OpenSans-Light.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-LightItalic',
	        'file_name' => public_path("font/OpenSans-LightItalic.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-Regular',
	        'file_name' => public_path("font/OpenSans-Regular.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-Semibold',
	        'file_name' => public_path("font/OpenSans-Semibold.ttf"),
	    ]);
	    DB::table('fonts')->insert([
	        'font_name' => 'OpenSans-SemiboldItalic',
	        'file_name' => public_path("font/OpenSans-SemiboldItalic.ttf"),
	    ]);

    }
}
