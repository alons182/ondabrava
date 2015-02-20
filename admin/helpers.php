<?php

Session_start();

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

function dd($var)
   {
       echo '<pre>', var_dump($var), '</pre>';
       die();
   }

/*function dd()
  {
    array_map(function($x) { var_dump($x); }, func_get_args()); die;
  }*/
