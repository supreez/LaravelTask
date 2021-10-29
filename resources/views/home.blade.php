<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link rel="stylesheet" href="{{ asset('css/style.css?'.time()) }}">

        <title>Collage generator</title>

    </head>

    <body>
    
        <div class="row justify-content-center">

            <div class="col-4 align-middle m-5">

                <div class="row">
                    
                    <a href='/generateCollage' class="btn btn-dark">Generate collage</a> 
                    
                </div>

            </div>

        </div>

        <div class="row">

            @for ($i = 1; $i <= 10; $i++)

                @include('picture._picture')

                @if ($i == 5)

                    </div>

                    <div class="row">

                @endif

            @endfor    
            
        </div>

    </body>

</html>
