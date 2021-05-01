<!DOCTYPE html>  
<html lang="en">  
    <head>      
        <meta charset="utf-8">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">

        <title>Přihlašovací stránka</title>  
    </head>  
    <style>
        div {text-align: center; }

    </style>

    <body>

        <div class="center-block">
            <h1>Přihlášení</h1>  


            <?php
            echo form_open('Main/login_action');

            echo validation_errors();

            echo "<p>Email: ";
            echo form_input('email', $this->input->post('email'));
            echo "</p>";

            echo "<p>Heslo:   ";
            echo form_password('password');
            echo "</p>";

            echo "</p>";
            echo form_submit('login_submit', 'Přihlásit se');
            echo "</p>";

            echo form_close();
            ?>  
        </div>
    </body>  
</html>  