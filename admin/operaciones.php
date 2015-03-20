<?php

include_once('helpers.php');



if( !isset($_SESSION['login']) || !$_SESSION['login'])
  Redirect('/admin/index.php', false);



if(isset($_GET['op']) && $_GET['op'] == "update")
{

    $query = "UPDATE videos SET ". $_POST['name']."='".$_POST['value']."' WHERE id='".$_POST['pk']."'";
    
   $db = new PDO('sqlite:videoteca.db');
   $db->exec($query);
   $db = NULL;

}
if(isset($_GET['op']) && $_GET['op'] == "get")
{
   
    $query = 'SELECT id, category, link FROM videos';
   
     $db = new PDO('sqlite:videoteca.db');
     $result = $db->query($query);
     foreach($result as $row)
            {
               $rows[] = $row;
            }
     /*while($row = $result->fetch(PDO::FETCH_ASSOC) )
     {
       
     }*/

     $db = NULL;
     echo json_encode($rows);

}





?>
