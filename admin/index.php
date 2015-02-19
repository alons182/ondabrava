<?php

include_once('helpers.php');


if( isset($_SESSION['login']) && $_SESSION['login'])
  Redirect('/admin/videoteca.php', false);

//If the form is submitted
if(isset($_POST['submitted'])) {




        function checkAuth()
        {
          $user = "admin";
          $pass = "ondabrava*";


          $response = (trim($_POST['user']) === $user && trim($_POST['password']) === $pass ) ?  true : false;

          return $response;

        }


        if(checkAuth())
        {

          $_SESSION['login'] = true;

        }else
        {
          $_SESSION['login'] = false;
        }


}


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Admin Videoteca</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <style>
            ::-moz-selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            ::selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            html {
                padding: 30px 10px;
                font-size: 20px;
                line-height: 1.4;
                color: #737373;
                background: #f0f0f0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            html,
            input {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

            body {
                max-width: 500px;
                _width: 500px;
                padding: 30px 20px 50px;
                border: 1px solid #b3b3b3;
                border-radius: 4px;
                margin: 0 auto;
                box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;
                background: #fcfcfc;
            }

            h1 {
                margin: 0 10px;
                font-size: 50px;
                text-align: center;
            }

            h1 span {
                color: #bbb;
            }

            h3 {
                margin: 1.5em 0 0.5em;
            }

            p {
                margin: 1em 0;
            }

            ul {
                padding: 0 0 0 40px;
                margin: 1em 0;
            }

            .container {
                max-width: 380px;
                _width: 380px;
                margin: 0 auto;
            }

            /* google search */

            #goog-fixurl ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #goog-fixurl form {
                margin: 0;
            }

            #goog-wm-qt,
            #goog-wm-sb {
                border: 1px solid #bbb;
                font-size: 16px;
                line-height: normal;
                vertical-align: top;
                color: #444;
                border-radius: 2px;
            }

            #goog-wm-qt {
                width: 220px;
                height: 20px;
                padding: 5px;
                margin: 5px 10px 0 0;
                box-shadow: inset 0 1px 1px #ccc;
            }

            #goog-wm-sb {
                display: inline-block;
                height: 32px;
                padding: 0 10px;
                margin: 5px 0 0;
                white-space: nowrap;
                cursor: pointer;
                background-color: #f5f5f5;
                background-image: -webkit-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -moz-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -ms-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -o-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                *overflow: visible;
                *display: inline;
                *zoom: 1;
            }

            #goog-wm-sb:hover,
            #goog-wm-sb:focus {
                border-color: #aaa;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                background-color: #f8f8f8;
            }

            #goog-wm-qt:hover,
            #goog-wm-qt:focus {
                border-color: #105cb6;
                outline: 0;
                color: #222;
            }

            input::-moz-focus-inner {
                padding: 0;
                border: 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Admin Videoteca <span></span></h1>
            <form action="/admin/index.php" data-remote="data-remote" data-remote-success-message="Logueado...">
                <div class="form-group">

                  <label for="name" class=" control-label">User</label>

                      <input class="form-control" required="required" name="user" type="text" id="user" validate>




                </div>
                <div class="form-group">

                  <label for="name" class=" control-label">Password</label>

                      <input class="form-control" required="required" name="password" type="password" id="password" validate>




                </div>

                <div class="form-group">
                  <input type="hidden" name="submitted" id="submitted" value="true" />
                  <button type="submit" class="btn btn-info"  >Log in</button>
                </div>

            </form>
            <div class="message"></div>



        </div>

        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>

        (function($){

          $("form[data-remote]").on('submit', function(e){

            var form = $(this);
            var method = form.find('input[name="_method"]').val() || 'POST';
            var url = form.prop('action');

            $.ajax({
                type: method,
                url: url,
                data: form.serialize(),
                success: function(data){

                    var message = form.data('remote-success-message');

                    if(message)
                    {

                        $('.message').removeClass('message-error').addClass('message-success').html(message).fadeIn(300).delay(2500).fadeOut(300);


                    }
                    if(data)
                      window.location.href = "/admin/videoteca.php";
                },
                error:function(){
                    $('.message').removeClass('message-success').addClass('message-error').html('Upss, Parece que ha ocurrido un error.').fadeIn(300).delay(2500).fadeOut(300);

                }
            });


            //limpiaForm(form);
            e.preventDefault();
          });

        })(jQuery);








        </script>
    </body>

</html>
