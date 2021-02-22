<?php
    set_time_limit(0);

    $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Não foi possível criar o socket") . socket_strerror(socket_last_error());

    socket_bind($sock, '127.0.0.1', 22233) or die("Não foi possível ligar o server") . socket_strerror(socket_last_error());

    socket_listen($sock, 3) or die("Não é possível 'ouvir' as conexões" . socket_strerror(socket_last_error()));

    echo "\nAguardar ligações";
    
    class Chat {
        function readline(){
            return rtrim(fgets(STDIN));
        }
    }

    do{
        $client_sock = socket_accept($sock) or die("Não foi possível aceitar a ligação" . socket_strerror(socket_last_error()));

        $msg = socket_read($client_sock, 1024) or die("Não foi possível ler a mensagem" . socket_strerror(socket_last_error()));

        $msg = trim($msg);
        echo "\n $msg \n\n";

        $line = new Chat();
        echo 'Digite a resposta: ';
        $replay = $line -> readline();

        socket_write($client_sock, $replay, strlen($replay)) or die("Não foi possível escrever a mensagem" . socket_strerror(socket_last_error()));

    }while(true);

    socket_close($client_sock); 
    socket_close($sock);
    
?>