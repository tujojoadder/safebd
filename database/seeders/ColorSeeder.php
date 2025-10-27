<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'top_header'    => '#fcfcfc',
            'small_header'  => '#0d8f45',
            'footer_color'     => '#033334',
            'primary_color'      => '#23e1de',
            'secondary_color'       => '#ededed',
            'button_color'         => '#000000',
            'hover_color'         => '#000000',
            'text_color'         => '#fcfcfc',
            'bg_color'         => '#ffffff',
            'status'           => '1'
        ]);
    }
}
