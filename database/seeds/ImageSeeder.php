<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listaImmagini = config('image');

        foreach($listaImmagini as $imaggine ){
            $newImage = new Image();
            $newImage->url_image = $imaggine['url_image'];
            $newImage->apartment_id = $imaggine['apartment_id'];
            $newImage->save();
        }

    }
}
