<?php

     function conectarBD(){ 
                $server = "localhost";
                $usuario = "c132weather";
                $pass = "powerlab1";
                $BD = "c132clima";
                //variable que guarda la conexión de la base de datos
                $conexion = mysqli_connect($server, $usuario, $pass, $BD); 
                //Comprobamos si la conexión ha tenido exito
                if(!$conexion){ 
                   echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>'; 
                } 
                //devolvemos el objeto de conexión para usarlo en las consultas  
                return $conexion; 
        }  
        /*Desconectar la conexion a la base de datos*/
        function desconectarBD($conexion){
                //Cierra la conexión y guarda el estado de la operación en una variable
                $close = mysqli_close($conexion); 
                //Comprobamos si se ha cerrado la conexión correctamente
                if(!$close){  
                   echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>'; 
                }    
                //devuelve el estado del cierre de conexión
                return $close;         
        }

        //Devuelve un array multidimensional con el resultado de la consulta
        function getArraySQL($sql){
            //Creamos la conexión
            $conexion = conectarBD();
            //generamos la consulta
            if(!$result = mysqli_query($conexion, $sql)) die();

            $rawdata = array();
            //guardamos en un array multidimensional todos los datos de la consulta
            $i=0;
            while($row = mysqli_fetch_array($result))
            {   
                //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
                $rawdata[$i] = $row;
                $i++;
            }
            //Cerramos la base de datos
            desconectarBD($conexion);
            //devolvemos rawdata
            return $rawdata;
        }

        //Sentencia SQL
    $sql = "SELECT * from clima;";
    
    $vel1 = 'SELECT * FROM `clima` WHERE `VEL_VIENTO`>=\'0\' AND `VEL_VIENTO`<=\'5\' AND `FECHA` > date_sub(now(), INTERVAL 365 day)';    
    $vel2 = 'SELECT * FROM `clima` WHERE `VEL_VIENTO`>=\'5\' AND `VEL_VIENTO`<=\'10\' AND `FECHA` > date_sub(now(), INTERVAL 365 day)';
    $vel3 = 'SELECT * FROM `clima` WHERE `VEL_VIENTO`>=\'10\' AND `VEL_VIENTO`<=\'15\' AND `FECHA` > date_sub(now(), INTERVAL 365 day)';
    $vel4 = 'SELECT * FROM `clima` WHERE `VEL_VIENTO`>=\'15\' AND `VEL_VIENTO`<=\'20\' AND `FECHA` > date_sub(now(), INTERVAL 365 day)';
    $vel5 = 'SELECT * FROM `clima` WHERE `VEL_VIENTO`>=\'20\' AND `VEL_VIENTO`<=\'25\' AND `FECHA` > date_sub(now(), INTERVAL 365 day)';
    $vel6 = 'SELECT * FROM `clima` WHERE `VEL_VIENTO`>=\'25\' AND `VEL_VIENTO`<=\'30\' AND `FECHA` > date_sub(now(), INTERVAL 365 day)';
    //Array Multidimensional
    $rawdata = getArraySQL($sql);
    $rawvel1 = getArraySQL($vel1);
    $rawvel2 = getArraySQL($vel2);
    $rawvel3 = getArraySQL($vel3);
    $rawvel4 = getArraySQL($vel4);
    $rawvel5 = getArraySQL($vel5);
    $rawvel6 = getArraySQL($vel6);

    //Adaptar el tiempo
    for($i=0;$i<count($rawdata);$i++){
        $FECHA = $rawdata[$i]["FECHA"];
        $date = new DateTime($FECHA);
        $rawdata[$i]["FECHA"]=$date->getTimestamp()*1000;
    }
    ?>
365