<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WeCare+</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body{
                background-color: #FFFFFF;
                color: #636b6f;
                font-family: 'Roboto Condensed', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }


            .flex-center{
                position:relative;
                float: all;
                text-align: center;
            }

            .content{
                float: all;
                position: relative;
                text-align: center;
                size: 50%;
            }

            .links > a {
                color: #F00033;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                font-family: 'Quicksand', sans-serif;
            }

        </style>
    </head>
    <body>

        <div class="flex-center links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
                <h1 style="margin: 20px; text-align:center;">WeCare+</h1>
            </div>
        </div>
    </body>
</html>
