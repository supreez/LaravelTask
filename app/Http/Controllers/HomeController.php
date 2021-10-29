<?php

//Laravel ietvars atlauj 'strongly-typed' jeb 'strict types' parbaudit tikai funkcijas parametrus vai return vertibu.
declare(strict_types=1);   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //Funkcija atgriež galveno lapu
    public function index()                                                         
    {

        return view('home');

    }

    //Funkcija ģenerē attēlu kolāžu un lejupielādē to
    public function downloadCollage()
    {
        
        //Pārbauda vai fails jau ir ticis ģenerēts, izdzēš ja ir
        if ( file_exists(public_path('collage.png')) ){

            unlink( public_path('collage.png') );

        }

        //Masīvs ar attēliem
        $images = [];

        //Attēlu masīva aizpilde
        for ($i = 0; $i < 10; $i++)
        {

            $imageNumber = $i + 1;

            $images[$i] = imagecreatefrompng(asset('images/'.$imageNumber.'.png'));

        }

        //Kolāžas parametri
        $width = 362 + 10;
        $height = 544 + 20;
        $columns = 5;
        $rows = 2;

        //Izveido tukšu attēlu uz kura tiks veidota kolāža
        $collage = imagecreatetruecolor($width * $columns, $height * $rows );

        //Izveido caurspīdīgu fonu
        imagecolortransparent($collage, imagecolorallocate($collage, 0 , 0 ,0 ));

        //Attēls
        $key = 0;

        //Sastāda kolāžu uz iepriekš izveidotā attēla
        //Cikls iziet cauri rindu skaitam
        for($x = 0; $x < $rows; $x++)
        {

            //Cikls iziet cauri kolonnu skaitam
            for($y = 0; $y < $columns; $y++){

                //Pievieno pašreizējā cikla attēlu kolāžas attēlam
                imagecopymerge( $collage, $images[$key], $width * $y + 10, $height * $x + 10, 0, 0, $width, $height, 100 );

                $key++;

            }

        }

        //Ģenerē iepriekš izveidoto kolāžu kā png attēlu
        imagepng($collage, 'collage.png');

        //Attīra atmiņu
        imagedestroy($collage);

        //Atgriež png attēla lejupielādi
        return response()->download( public_path('collage.png') );
    }
}
