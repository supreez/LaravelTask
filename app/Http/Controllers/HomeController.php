<?php
declare(strict_types=1);    //Laravel ietvars atlauj 'strongly-typed' jeb 'strict types' parbaudit tikai funkcijas parametrus vai return vertibu.

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    
    public function index()
    {

        return view('home');

    }

    public function downloadCollage()
    {
        

        if ( file_exists(public_path('collage.png')) ){
            unlink( public_path('collage.png') );
        }

        $images = [];
        for ($i = 0; $i < 10; $i++)
        {
            $imageNumber = $i + 1;
            $images[$i] = imagecreatefrompng(asset('images/'.$imageNumber.'.png'));

        }

        $width = 362 + 10;
        $height = 544 + 20;
        $columns = 5;
        $rows = 2;


        $collage = imagecreatetruecolor($width * $columns, $height * $rows );
        imagecolortransparent($collage, imagecolorallocate($collage, 0 , 0 ,0 ));
        $key = 0;

        for($x = 0; $x < $rows; $x++)
        {

            for($y = 0; $y < $columns; $y++){

                imagecopymerge( $collage, $images[$key], $width * $y + 10, $height * $x + 10, 0, 0, $width, $height, 100 );

                $key++;

            }

        }
        
        imagepng($collage, 'collage.png');

        imagedestroy($collage);

        return response()->download( public_path('collage.png') );
    }
}
