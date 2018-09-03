<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if ( env('DB_DATABASE')=='homestead')
        <title>Laravel Simple Setup</title>
    @else
        <title>Laravel</title>
    @endif

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/tippy.js@2.5.4/dist/tippy.all.min.js"></script>

    <style>
        @media screen and (max-width:768px)
        {
            .btn
            {
                display: block;
                width: 100%;
            }
        }

        #tochange
        {
            background: #f3f3f3 !important;
            padding: 20px;
        }

        body,input { font-family: 'Quicksand', sans-serif;background:#1f2720}

        .container-progress
        {

            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            background:white;

        }

        input::placeholder
        {
            color:rgba(0,0,0,0.17) !important;
        }


        .progressbar
        {
            counter-reset: headings;
            list-style: none;
        }
        .progressbar li {
            list-style-type: none;
            width: 25%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;

        }
        .progressbar li:before {
            width: 30px;

            height: 30px;
            counter-increment: headings;
            content: counter(headings, decimal);
            line-height: 26px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }
        .progressbar li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }
        .progressbar li:first-child:after {
            content: none;
        }
         .tip{
            color: #f4645f;
        }

        .progressbar li.active, li.active a
        {
            color: black;
        }

        li a
        {
            color: #7d7d7d;
        }
        .progressbar li.active:before {
            border-color: #31d02a;
            background: #31d02a;
            color:white;
        }

        .btn-success
        {
            background-color: #31d02a;
            border-color: #31d02a;
        }

        .background
        {
            padding-top:40px;
            background-image: url(https://images.unsplash.com/photo-1500534623283-312aade485b7?ixlib=rb-0.3.5…EyMDd9&s=7002036…&auto=format&fit=crop&w=1350&q=50);
            height: 100vh;
            width: auto;
            background-size: cover;
        }

        #errormsg
        {
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="background">
    <div class="container-progress container">
        <div class="row text-center" style="background:#f4645f;color:white;">
            <div class="col-12">
                <h1 style="font-size:1.5rem;padding:30px 0px">Laravel Simple Setup</h1>
            </div>
        </div>
        @yield('content')
    </div>
</div>
</body>
</html>
