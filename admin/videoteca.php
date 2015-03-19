<?php

include_once('helpers.php');



if( !isset($_SESSION['login']) || !$_SESSION['login'])
  Redirect('/admin/index.php', false);

//If the form is submitted
if(isset($_POST['submitted'])) {

  if ($db = sqlite_open('videoteca.db', 0666, $sqliteerror)) {
  

   $query = sqlite_query($db, 'SELECT id, link FROM videos');
    while ($entry = sqlite_fetch_array($query, SQLITE_ASSOC)) {
        echo 'id: ' . $entry['id'] . '  Link: ' . $entry['link'];
    }
   sqlite_close($db);

  
}else
{
  die ($sqliteerror);
}

  $jsonString = file_get_contents('videoteca.json');
  $data = json_decode($jsonString);

  foreach ($data as $key => $entry) {



      if ($entry->id == 'semana_1') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == 'semana_2') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == 'semana_3') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == 'semana_4') {
          $entry->link = $_POST[$entry->id];
      }


      if ($entry->id == 'concierto_1') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == 'artista_1') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == 'pelicula_1') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '80s_1') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '80s_2') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '80s_3') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '80s_4') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '90s_1') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '90s_2') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '90s_3') {
          $entry->link = $_POST[$entry->id];
      }
      if ($entry->id == '90s_4') {
          $entry->link = $_POST[$entry->id];
      }

      $newData[]= $entry;

  }

  file_put_contents('videoteca.json', json_encode($newData));






}



?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Admin Videoteca</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <style>
      body{
        padding-top:50px;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="#">Admin Videoteca</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">
            <li><a href="/admin/logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <form action="/admin/videoteca.php" method="POST" >
          <h1>Videos de la semana</h1>
            <div class="form-group">
              <label for="semana_1" class="control-label">Video #1</label>
              <input class="form-control"  name="semana_1" type="text" id="semana_1" validate>
            </div>
            <div class="form-group">
              <label for="semana_2" class="control-label">Video #2</label>
              <input class="form-control"  name="semana_2" type="text" id="semana_2" validate>
            </div>
            <div class="form-group">
              <label for="semana_3" class="control-label">Video #3</label>
              <input class="form-control"  name="semana_3" type="text" id="semana_3" validate>
            </div>
            <div class="form-group">
              <label for="semana_4" class="control-label">Video #4</label>
              <input class="form-control"  name="semana_4" type="text" id="semana_4" validate>
            </div>





            <h1>Concierto del mes</h1>
              <div class="form-group">
                <label for="concierto_1" class="control-label">Video #1</label>
                <input class="form-control"  name="concierto_1" type="text" id="concierto_1" validate>
              </div>

            <h1>Artista del mes</h1>
              <div class="form-group">
                <label for="artista_1" class="control-label">Video #1</label>
                <input class="form-control"  name="artista_1" type="text" id="artista_1" validate>
              </div>

              <h1>Pelicula del mes</h1>
                <div class="form-group">
                  <label for="pelicula_1" class="control-label">Pelicula #1</label>
                  <input class="form-control"  name="pelicula_1" type="text" id="pelicula_1" validate>
                </div>

            <h1>Videos 90's</h1>
              <div class="form-group">
                <label for="90s_1" class="control-label">Video #1</label>
                <input class="form-control"  name="90s_1" type="text" id="90s_1" validate>
              </div>
              <div class="form-group">
                <label for="90s_2" class="control-label">Video #2</label>
                <input class="form-control"  name="90s_2" type="text" id="90s_2" validate>
              </div>
              <div class="form-group">
                <label for="90s_3" class="control-label">Video #3</label>
                <input class="form-control"  name="90s_3" type="text" id="90s_3" validate>
              </div>
              <div class="form-group">
                <label for="90s_4" class="control-label">Video #4</label>
                <input class="form-control"  name="90s_4" type="text" id="90s_4" validate>
              </div>


              <h1>Videos 80's</h1>
                <div class="form-group">
                  <label for="80s_1" class="control-label">Video #1</label>
                  <input class="form-control"  name="80s_1" type="text" id="80s_1" validate>
                </div>
                <div class="form-group">
                  <label for="80s_2" class="control-label">Video #2</label>
                  <input class="form-control"  name="80s_2" type="text" id="80s_2" validate>
                </div>
                <div class="form-group">
                  <label for="80s_3" class="control-label">Video #3</label>
                  <input class="form-control"  name="80s_3" type="text" id="80s_3" validate>
                </div>
                <div class="form-group">
                  <label for="80s_4" class="control-label">Video #4</label>
                  <input class="form-control"  name="80s_4" type="text" id="80s_4" validate>
                </div>

            <div class="form-group">
              <input type="hidden" name="submitted" id="submitted" value="true" />
              <button type="submit" class="btn btn-info"  >Guardar</button>
            </div>

        </form>
        <div class="message"></div>
      </div>

    </div><!-- /.container -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script>
        (function($){

          $.ajax({
              type: 'GET',
              url: '/admin/videoteca.json',
              dataType:'json',
              success: function(data){
                for (var i = 0; i < data.length; i++) {


                        $('#'+ data[i].id).val(data[i].link);



                }

              },
              error:function(){


              }
          });



        })(jQuery);
    </script>
  </body>
</html>
