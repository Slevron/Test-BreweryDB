<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test vue.js</title>
    <link rel="stylesheet" href="./css/app.css">
  </head>
  <body>
    <div class="container-fluid">
        <div id="app" class="row">
              <beers></beers>
        </div>
    </div>
    <script src="./js/app.js"></script>
  </body>
</html>