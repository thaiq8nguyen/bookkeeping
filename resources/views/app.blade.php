<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content = "{{ csrf_token() }}">
        <title>Bookkeeping</title>
        <!--Common Stylesheets-->
        <link rel = "shortcut icon" type = "image/png" href = "{{ asset('favicon.ico') }}">
        
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
        
        
    </head>
    <body>
        <div id="app"></div>
        
    </body>
    <script src = "{{ asset('js/app.js') }}"></script>
    

    
</html>