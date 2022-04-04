<?php
//se crea la clase Viaje
class Viaje{
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $pasajeros; //Pasajeros es un arreglo multidimensional


    //se implementa el constructor para crear los objetos codigo, destino, maxPasajeros y pasajeros
    public function __construct ($c, $d, $mP, $p){
        $this -> codigo = $c;
        $this -> destino = $d;
        $this -> maxPasajeros = $mP;
        $this -> pasajeros = $p;
    }


    //se implementan las funciones para acceder a los datos de los objetos

    public function getcodigo (){
        return $this -> codigo;
    }

    public function getdestino (){
        return $this -> destino;
    }

    public function getmaxPasajeros (){
        return $this -> maxPasajeros;
    }

    public function getpasajeros (){
        return $this -> pasajeros;
    }

    //se implementan las funciones para modificar los datos de los objetos

    public function setcodigo ($codigoNuevo){
        $this -> codigo = $codigoNuevo;
    }

    public function setdestino ($destinoNuevo){
        $this -> destino = $destinoNuevo;
    }

    public function setmaxPasajeros ($mPNuevo){
        $this -> maxPasajeros = $mPNuevo;
    }

    public function setpasajeros ($pNuevo){
        $this -> pasajeros = $pNuevo;
    }

    //se implementa la función __toString para concatenar el contenido de los objetos

    public function __toString (){
        $infoPasajero = $this -> infoPasajero ();
        $infoViaje = "Código de viaje: ". $this -> getcodigo(). "\n 
        Destino de viaje: ". $this -> getdestino (). "\n 
        Cantidad máxima de pasajeros: ". $this -> getmaxPasajeros (). "\n.
        INFORMACION PASAJEROS \n" .
        //se utiliza una función a parte para concatenar el contenido del arreglo pasajeros
        $infoPasajero;
        return $infoViaje;
    }


    //repetitiva que concatena la información de los pasajeros
    public function infoPasajero (){
        $listaP = " ";
        $p = $this -> getpasajeros ();
        for ($i = 0; $i < count ($p); $i++){
            $listaP = $listaP. "\n". "Pasajero/a ". ($i+1). ": ". $p [$i]["Nombre"]. " ". $p [$i]["Apellido"]. ", DNI ". $p [$i]["DNI"]. "\n";
        }
        return $listaP;
    }

    //función que modifica el contenido de la clave "Nombre" del arreglo pasajeros a partir del índice ingresado
    public function modificarNombre ($indice, $nombreNuevo){
        $p = $this -> getpasajeros ();
        $p [$indice] ["Nombre"] = $nombreNuevo;
        $this -> setpasajeros ($p);
    }

    //función que modifica el contenido de la clave "Apellido" del arreglo pasajeros a partir del índice ingresado
    public function modificarApellido ($indice, $apellidoNuevo){
        $p = $this -> getpasajeros ();
        $p [$indice] ["Apellido"] = $apellidoNuevo;
        $this -> setpasajeros ($p);
    }

    //función que modifica el contenido de la clave "DNI" del arreglo pasajeros a partir del índice ingresado
    public function modificarDNI ($id, $dniNuevo){
        $p = $this -> getpasajeros ();
        $p [$id] ["DNI"] = $dniNuevo;
        $this -> setpasajeros ($p);
     }

}