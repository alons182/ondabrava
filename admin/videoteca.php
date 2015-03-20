<?php

include_once('helpers.php');



if( !isset($_SESSION['login']) || !$_SESSION['login'])
  Redirect('/admin/index.php', false);

//$result;
  try
  {
    $db = new PDO('sqlite:videoteca.db');
    //$db->exec("INSERT INTO videos(id, category, link) VALUES ('semana_1', 'semana', 'https:\/\/www.youtube.com\/embed\/o7So0wmGDzw');");


    //now output the data to a simple html table...
    /*print "<table class='table table-striped'>";
    print "<tr><td>Id</td><td>category</td><td>link</td></tr>";
    $result = $db->query('SELECT * FROM videos order by id ');
    foreach($result as $row)
    {
      print "<tr><td>".$row['id']."</td>";
      print "<td>".$row['category']."</td>";
      print "<td>".$row['link']."</td></tr>";
    }
    print "</table>";

    // close the database connection
    $db = NULL;*/
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
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
        <h1>Videoteca</h1>
           <table class='table table-striped'>
            <thead>
              <tr>
                <th>Id</th>
                <th>category</th>
                <th>link</th>
              </tr>
            </thead>
            <tbody>
                         
           <?php  
            $result = $db->query('SELECT * FROM videos order by category Desc ');
           foreach($result as $row)
            {
              ?>
              <tr> 
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['category'] ?></td>
                <td><a href="#" class="x-edit" data-type="text" data-name="link" data-pk="<?php echo $row['id'] ?>" data-url="/admin/operaciones.php?op=update" data-title="Enter Link"><?php echo $row['link'] ?></a></td>
              </tr>
            <?php
              }
            ?>
            </tbody>
            </table>

       
        
      </div>

    </div><!-- /.container -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>
        (function($){
          $.fn.editable.defaults.ajaxOptions = {type: "POST"};
          $('.x-edit').editable();
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
