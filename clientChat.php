<?php
    session_start();

    $erro = null;
    $isServerOn = true;

    if(isset($_POST['btnLogin'])){
        $_SESSION['nome'] = ucfirst($_POST['nome']);
        $_SESSION['isLoggedIn'] = true;
    }
    else if(!isset($_SESSION['isLoggedIn'])){
        header('Location: index.php');
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
    <title>Chat Misael</title>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">

            <a class = "navbar-brand" href="#" style="font-family: 'Shrikhand', sans-serif;">
                <img src="chat.png" height="40" width="40">
                 Chat Misael
            </a>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <form action="index.php" method="POST">
                        <input class="btn btn-outline-danger" type="submit" value="Logout" name="logout">Logout</input>
                    </form>
                </li>
            </ul>
        </div>
</nav>

<?php if(isset($_SESSION['nome'])){ ?>
    <div class="alert alert-info" role="alert">
        Tem a sessão iniciada como <?php echo '<b>' . $_SESSION["nome"] . '</b>'; ?>
    </div>

<?php }?>

<div class="pt-4 title">
    <hr />
    <h2 class="px-3 ">Fale com o servidor</h2>
    <hr />
</div>

<?php

    function getError($err){
        return '<div class = "alert alert-danger" role="alert" style="display: flex; justify-content: center; align-items: center;">
                    <p style="font-size: large;"><b>Erro:' . $err . '</b></p>
                </div>';
    };

    ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
    ini_set('display_errors', 0); // disable error display
    ini_set('log_errors', 0); // disable error logging
            
    $nome  = $_SESSION['nome'];

    $host = "127.0.0.1";
    $port = 22233;


    if(isset($_POST['btnSend'])){

        $msg = $_REQUEST['txtmsg'];

        $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die(
            getError(" <b>falha na criação dos sockets</b> - ". socket_strerror(socket_last_error())));

        socket_connect($sock, $host, $port) or die(
            getError(" <b>falha na coneção com o servidor</b> - ". socket_strerror(socket_last_error())));

        socket_write($sock, $nome . " disse: ", strlen($nome . " disse: ")) or die(
            $erro = " <b>falha na escrita da mensagem</b> - ". socket_strerror(socket_last_error()));

        socket_write($sock, $msg, strlen($msg)) or die(
            $erro = " falha na escrita da mensagem ". socket_strerror(socket_last_error()));

        $replay = socket_read($sock, 1924) or die(
            $erro = " <b>falha na leitura da mensagem</b> ". socket_strerror(socket_last_error()));

        $replay = trim($replay);
        $replay = "<b style='font-size: large;'>Servidor </b>" . $replay;

    }

?>

<div class="container p-3">


        <div class="rounded container p-4" style="background-color: lightgrey;">

            <?php
                if($msg != null){
                echo "<pre>"; print_r($_SOCKET); echo "</pre>";

                        echo    '<div class="card p-3" style="background-color: lightblue;">
                                     <b style="font-size: large;"> Eu </b>' . $msg . '
                                </div>';
                }
            ?>
            <br>
            <div class="card p-3">
                <?php
                    echo @$replay;
                ?>
            </div>
            <br>

            <form method="POST" class="form.group">

                <div class="input-group">
                    <input type="text" placeholder="Mensagem" name = "txtmsg" class="form-control">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-success" name="btnSend" value="Enviar"></input>
                    </div>
                </div>

            </form>
        </div>

    <?php 

        // echo '<p class = "alert alert-danger" role="alert" style="font-size: large"><b>Erro:' . $erro . '</b></p>'
        
        ?>
        <!-- <div class="rounded container p-4" style="background-color: lightgrey;">

            <form method="POST" class="form.group">

                <div class="input-group">
                    <input type="text" placeholder="Mensagem" name = "txtmsg" class="form-control">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-success" name="btnSend" value="Enviar" disabled></input>
                    </div>
                </div>

            </form>
        </div> -->

    <?php ?>

</div>
    

</body>
</html>