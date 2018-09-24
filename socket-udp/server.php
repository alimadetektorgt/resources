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
 
//Crea un socket UDP
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))){
    $errorcode  = socket_last_error();
    $errormsg   = socket_strerror($errorcode);

    die("No se pudo crear el socket: [$errorcode] $errormsg \n");
}

echo "Socket creado :D! \n";

//Vincula la dirección de origen
if(!socket_bind($sock, "0.0.0.0" , 9999)){
    $errorcode  = socket_last_error();
    $errormsg   = socket_strerror($errorcode);
     
    die("No se pudo vincular el socket: [$errorcode] $errormsg \n");
}
 
echo "Socket vinculado :D! \n";
 
//Recibe información desde un socket, este bucle permite recibir informacion de varios clientes a vez
while(1){
    echo "Esperando un paquete de datos ... \n";
     
    //Recibe un paquete de datos de la IP del cliente
    $r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
    echo "$remote_ip : $remote_port -- " . $buf;
     
    //Enviar al cliente una respuesta
    socket_sendto($sock, "OK: " . $buf , 100 , 0 , $remote_ip , $remote_port);
}

//Cierra el socket para dejar de recibir, enviar, o ambos
socket_close($sock);