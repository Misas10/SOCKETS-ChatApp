<?php
    session_start();

    ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
    ini_set('display_errors', 0); // disable error display
    ini_set('log_errors', 0); // disable error logging

    if($_SESSION['isLoggedIn']){

        if(isset($_POST['logout'])){
            session_destroy();
            $_SESSION['isLoggedIn'] = false;
        }

    }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shrikhand">
    <link rel="stylesheet" href="css.css">
    <title>Login</title>
</head>

<body> 

    <nav class="navbar navbar-dark bg-dark">

        <div class="container-fluid">

            <a class = "navbar-brand" href="#" style="font-family: 'Shrikhand', sans-serif;">
                <img src="chat.png" height="40" width="40">
                Chat Misael
            </a>

        </div>
    </nav>
    
    <div class="container">

        <div class="container p-5">
            <div class="title">
                <hr />
                <h2 class="px-3">Faça o Login</h2>
                <hr />
            </div>
        </div><br><br>

        <div class="container p-5">
            <div class="card shadow p-5 positio-flex top-0 start-50 translate-middle" style="width:30rem;">
                <form action="clientChat.php" method="POST" class="form-group">
                    
                    <input type="text" class="form-control" placeholder="Digite o seu nome" name="nome" required>
                    <br>
                    
                    <input type="submit" class = "btn btn-success col-12" value="Entrar" name="btnLogin">
                    
                </form>

            </div>
        </div>
        
    </div>

</body>
</html>