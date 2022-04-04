<?php
include "Viaje.php";

//*********** COMENTAR LAS FUNCIONES SEGUN CONVENCIONES **************//

//ARREGLO PRECARGADO DE PASAJEROS
$pasajeros [0] = ["Nombre" => "María", "Apellido" => "Dolores", "DNI" => 40208976];
$pasajeros [1] = ["Nombre" => "Ezequiel", "Apellido" => "Zuñiga", "DNI" => 26188133];
$pasajeros [2] = ["Nombre" => "Muriel", "Apellido" => "Jara", "DNI" => 44365218];
$pasajeros [3] = ["Nombre" => "Rogelio", "Apellido" => "Buendia", "DNI" => 20459678];
$pasajeros [4] = ["Nombre" => "Franco", "Apellido" => "Rezanovich", "DNI" => 39850322];
$pasajeros [5] = ["Nombre" => "Camila", "Apellido" => "Troncoso", "DNI" => 41198762];
$pasajeros [6] = ["Nombre" => "Mariana", "Apellido" => "Arias", "DNI" => 42335785];


//funcion para agregar pasajeros a la base de datos
/**
 * función cargarPasajeros ()
 * carga los datos de los pasajeros ingresados en un arreglo $pasajeros
 * @param int $max
 * @return array
 */
function cargarPasajeros ($max){
    $rta = "S";
    $i = 0;
    do {
        echo "Ingrese el nombre del pasajero. ". "\n";
        $nombre = trim(fgets(STDIN)). "\n";
        echo "Ingrese el apellido del pasajero. ". "\n";
        $apellido = trim(fgets(STDIN)). "\n";
        echo "Ingrese sin puntos ni espacios el DNI del pasajero. ". "\n";
        $dni = trim(fgets(STDIN)). "\n";
        //se accede al arreglo mediante la variable $i como índice y se modifica
        //el contenido de sus claves
        $pasajeros [$i] = ["Nombre" => $nombre, "Apellido" => $apellido, "DNI" => $dni];
        $i = $i + 1;
        echo "¿Desea seguir ingresando pasajeros? S/N \n
        Le quedan ". $max - $i. " espacios disponibles. \n";
        $rta = trim(fgets(STDIN));
    //se verifica que se siga queriendo modificar datos y que no se supere el máximo permitido de pasajeros
    } while ($rta <> "N" && $i <= $max) ;
    echo "Pasajeros cargados correctamente. \n";
    return $pasajeros;
}
//fin cargarPasajeros

//funcion para modificar datos de pasajeros
/**
 * función modificarPasajeros
 * modifica los datos dentro del arreglo $pasajeros según las opciones que se elijan
 * @param object $viaje
 * @return object $viaje
 */
function modificarPasajeros ($viaje){
    do{
        echo "******** CAMBIO DE DATOS DE PASAJEROS ********\n
        cuál es el dato que desea modificar? \n
        Nombre: N \n
        Apellido: A \n
        DNI: DNI \n
        Volver atrás: V \n";
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
           case "N":
                //opción cambiar nombre
                echo "Ingrese el nro del pasajero. \n";
                $id = trim(fgets(STDIN));
                echo "Ingrese el nuevo nombre. \n";
                $nombre = trim(fgets(STDIN));
                //se llama a la función modificarNombre de la clase Viaje
                $viaje -> modificarNombre ($id, $nombre);
            break;
            case "A":
                //opción cambiar apellido
                echo "Ingrese el nro del pasajero. \n";
                $id = trim(fgets(STDIN));
                echo "Ingrese el nuevo apellido. \n";
                $apellido = trim(fgets(STDIN));
                //se llama a la función modificarApellido de la clase Viaje
                $viaje -> modificarApellido ($id, $apellido);
            break;
           case "DNI":
                //opción modificar DNI
                echo "Ingrese el nro del pasajero. \n";
                $id = trim(fgets(STDIN));
                echo "Ingrese el nuevo DNI. \n";
                $dni = trim(fgets(STDIN));
                //se llama a la función modificarDNI de la clase Viaje
                $viaje -> modificarDNI ($id, $dni);
            break;
            case "V":
                //opción volver atrás
            break;
           default: 
                //en caso de no recibir ningún caracter de los esperados
                echo "Opción incorrecta, por favor, vuelva a intentarlo. \n";
            break;
        }
    }while ($opcion <> "V");
    echo "CAMBIO REALIZADO EXITOSAMENTE \n";
    return $viaje;
}
//fin modificarPasajeros


//función menu para modificar datos 
/**
 * función menuCambios 
 * modifica los datos dentro del objeto $viaje según las opciones que se elijan
 * @param object $viaje
 */
function menuCambios ($viaje){
    do {
        echo "******** MENU DE CAMBIOS ********\n
        ¿Qué datos desea modificar? \n
        Código del viaje: C \n
        Destino del viaje: D \n
        Cantidad máxima de pasajeros: MP \n
        Datos de uno o más pasajeros: P \n
        Volver atrás: V \n";
    $rta = trim(fgets(STDIN));
    switch ($rta){
        case "C":
            //opción cambiar código del viaje
            echo "Escriba el nuevo código.\n";
            $cNuevo = trim(fgets(STDIN));
            $viaje -> setcodigo ($cNuevo);
        break;
        case "D":
            //opción cambiar destino del viaje
            echo "Escriba el nuevo destino. \n";
            $dNuevo = trim(fgets(STDIN));
            $viaje -> setdestino ($dNuevo);
        break;
        case "MP":
            //opción cambiar máximo de pasajeros del viaje
            echo "Escriba el nuevo máximo de pasajeros. \n";
            $mPNuevo = trim(fgets(STDIN));
            $viaje -> setmaxPasajeros ($mPNuevo);
        break;
        case "P":
            //opción cambiar datos de uno o más pasajeros 
            //llamo a una función a parte para modificar los datos del arreglo $pasajeros
            modificarPasajeros ($viaje);
        break;
        case "V":
            //opción volver atrás
        break;
        default:
            //en caso de no recibir ninguno de los caracteres esperados
            echo "Opción incorrecta, por favor, vuelva a intentarlo. \n";
    }
    }while ($rta <> "V");
    echo "CAMBIO REALIZADO EXITOSAMENTE \n";
}
//fin menuCambios


//funcion que pide los datos para cargarlos en la bd.
/**
 * función cargarViaje
 * solicita los datos adecuados e implementa el constructor para crear el objeto $viaje 
 * y le asigna dichos datos
 * @return object
 */
function cargarViaje (){
    echo "Ingrese el código del viaje."."\n";
    $codigo = trim(fgets(STDIN));
    echo "Ingrese el destino del viaje.". "\n";
    $destino = trim(fgets(STDIN));
    echo "Ingrese la cantidad máxima de pasajeros."."\n";
    $maxPasajeros = trim(fgets(STDIN));
    //función a parte para cargar datos al arreglo $pasajeros, se utiliza como parámetro
    //la variable $maxPasajeros para evitar excederse del máximo permitido de pasajeros
    $pasajeros = cargarPasajeros ($maxPasajeros);
    //implementación del constructor
    $viaje = new Viaje ($codigo, $destino, $maxPasajeros, $pasajeros);
    return $viaje;
}
//fin cargarViaje


//PROGRAMA PRINCIPAL
 // Ya le dejé datos cargados al objeto $viaje, pero se puede sobreescribir y cargarle datos nuevos
 // con la opción "cargar datos"
$codigo = 314;
$destino = "Jujuy";
$maxPasajeros = 30;
$viaje = new Viaje ($codigo, $destino, $maxPasajeros, $pasajeros);
echo "¡Hola! \n";
do {
    echo "******** MENU PRINCIPAL ********\n
    Elija una opción:\n
    Cargar datos del viaje: C \n
    Modificar datos del viaje: M \n
    Ver datos del viaje: V \n
    Salir: S \n";
    $rta = trim(fgets(STDIN));
    switch ($rta){
    case "C":
        //opción cargar datos del viaje
      $viaje = cargarViaje ();
    break;
    case "M":
        //opción modificar datos del viaje
        menuCambios ($viaje);
    break;
    case "V":
        //opción ver datos del viaje
        echo $viaje -> __toString ();
    break;
    case "S":
        //opción salir
    break;
    default: 
    //si no se ingresa alguno de los caracteres contemplados
    echo "Opción incorrecta, por favor, vuelva a intentarlo. \n";
    }
} while ($rta <> "S");
echo "MUCHAS GRACIAS, HASTA LUEGO";
//FIN PROGRAMA






