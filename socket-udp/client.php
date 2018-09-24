<?php
/**
 * Socket UDP en PHP
 *
 * Desarrollo por: Alexander L. Lima & <3 
 *
 * Contacto: alexander.lima@detektor.com.gt
 *
 * Mas proyectos: https://github.com/alimadetektorgt/
 *
 * Los programadores Somos humanos, No máquinas..
*/


//Notificar todos los errores de PHP
error_reporting(E_ALL);

//Cambiar por la IP del equipo donde esta siendo ejecutado el servidor. 
$server = '192.168.72.137';
$port = 9999;
 
//Crea un socket UDP
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))){
    $errorcode  = socket_last_error();
    $errormsg   = socket_strerror($errorcode);

    die("No se pudo crear el socket: [$errorcode] $errormsg \n");
}

echo "Socket creado :D! \n";
 
//Bucle de comunicacion
while(1){    
    echo 'Ingrese un mensaje para enviar: ';
    $input = fgets(STDIN);
     
    //Envia el paquete de datos al servidor
    if(!socket_sendto($sock, $input, strlen($input), 0, $server, $port)){
        $errorcode  = socket_last_error();
        $errormsg   = socket_strerror($errorcode);
         
        die("No se pudo enviar el mensaje: [$errorcode] $errormsg \n");
    }
         
    //Respuesta del servidor
    if(socket_recv($sock, $reply, 2045, MSG_WAITALL) === false){
        $errorcode  = socket_last_error();
        $errormsg   = socket_strerror($errorcode);
         
        die("No se pudo recibir una respuesta del servidor: [$errorcode] $errormsg \n");
    }
     
    echo "Respuesta: $reply";
}