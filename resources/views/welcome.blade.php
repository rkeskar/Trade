<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>The List of E-commerce companies</title>
</head>
    <body>
       <div id="app">
            @if(isset($companies_info))
              @if($companies_info->isNotEmpty())
                <product-component :companies="{{$companies_info}}"></product-component>
              @else
                <p class="text-center">Please do database migration to see populated data</p>
              @endif
           @else
               <div class="jumbotron jumbotron-fluid text-center">
                   <div class="container">
                       <h1 class="display-4">No Data Available</h1>
                       <p class="lead">Please run database migration to see the working app.</p>
                       <img src="https://laravelnews.imgix.net/images/laravel-featured.png?ixlib=php-3.3.1" class="img-fluid" alt="Laravel">
                   </div>
               </div>
           @endif
       </div>
        <script src="{{ asset('js/app.js') }}"></script>
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </body>
</html>
