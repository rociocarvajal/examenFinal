<?php

// Examen Final 06/12/2023 - Introducción a la Programación
// Alumna: Carol Rocio Godoy Carvajal. Legajo: FAI-3614

/**
 * Punto i --> Función que retorne colección de multas.
 * @return array
 */

 function dataMultas() {
    $dataMulta[0] = array (
        "patente" => "AB248CV",
        "sector" => 2,
        "exceso" => 29
    );
    $dataMulta[1] = array (
        "patente" => "AA001MH",
        "sector" => 1,
        "exceso" => 20
    );
    $dataMulta[2] = array (
        "patente" => "AC444PL",
        "sector" => 1,
        "exceso" => 25
    );
    $dataMulta[3] = array (
        "patente" => "AB248CV",
        "sector" => 3,
        "exceso" => 35
    );
    $dataMulta[4] = array (
        "patente" => "AA001MH",
        "sector" => 4,
        "exceso" => 36
    );
    $dataMulta[5] = array (
        "patente" => "AB248CV",
        "sector" => 2,
        "exceso" => 15
    );
    return $dataMulta;
 }

 /**
  * Punto ii --> Función que retorne valor de multa.
  * @param int $kmExcedidos
  * @return int
  */

  function valorMulta($kmExcedidos) {
    $gastoPapeleo = 12000;
    $incremento = 2500 * $kmExcedidos;
    $totalMulta = $gastoPapeleo + $incremento;
    return $totalMulta;
  }

  /**
   * Punto iii --> Función que muestra datos en pantalla.
   * @param array $multa
   */

   function mostrarData($multa) {
    $patente = $multa["patente"];
    $sector = $multa["sector"];
    $exceso = $multa["exceso"];
    $valorMulta = valorMulta($exceso);
    echo "Patente: $patente\n";
    echo "Sector: $sector\n";
    echo "Multa por exceso de: $exceso km/h\n";
    echo "Valor: $$valorMulta\n";
}

    /**
     * Punto iv --> Función que obtenga el índice de la multa de mayor valor ($).
     * @param array $dataMulta
     * @return int
     */

     function mayorMulta($dataMulta) {
        $mayorValor = 0;
        $indiceMayor = 0;
        foreach ($dataMulta as $indice => $multa) {
            $valorMulta = valorMulta($multa["exceso"]);
            if ($valorMulta > $mayorValor) {
                $mayorValor = $valorMulta;
                $indiceMayor = $indice;
            }
        }
        return $indiceMayor;
     }

     /** 
      * Punto v --> Función que retorne indice de multa que supere input.
      * @param array $multas
      * @param int $kmInput
      * @return int
      */

      function primerMulta($multas, $kmInput) {
        $mayorKm = 0;
        foreach ($multas as $indice => $multa) {
            if ($multa["exceso"] > $kmInput) {
                $mayorKm = $indice;
                return $mayorKm;
            }
        }
        return -1;
      }

      /**
       * Punto vi --> Función que retorne una nueva estructura de datos con la información de las multas de la patente ingresada por parámetro.
       * @param array $multas
       * @param mixed $patenteInput
       * @return array
       */

       function multasPatente ($multas, $patenteInput) {
        $newDato = [];
        $newArray = [];
        $counter = 0;
        for ($i=0 ; $i < count($multas) ; $i++) { 
            if ($multas[$i]["patente"] == $patenteInput) {
                $sector = $multas[$i]["sector"];
                $exceso = $multas[$i]["exceso"];
                $valor = valorMulta($exceso);
                $newArray = array (
                    "sector" => $sector,
                    "exceso" => $exceso,
                    "valor" => $valor
                );
                $newDato[] = $newArray;
            }
            else {
                $counter++;
            }
        }
        return $newDato;
       }


  /**
   * Punto vii --> Programa principal
   */

   // Punto A --> Cargar coleccion de multas
   $dataMultas = dataMultas();
   // Punto B --> Mostrar informacion de la mayor de las multas 
   // Recupero indice del mayor valor de la multa 
   $indice = mayorMulta($dataMultas);
   // Recupero array asociativo
   $asociativo = $dataMultas[$indice];
   // Ahora muestro información de la multa
   mostrarData($asociativo);
   // Punto C --> Solicitar usuario cantidad de km/h exceso y mostrar primer multa que supera cantidad 
   echo "Ingrese cantidad de km/h excedidos: ";
   $km = trim(fgets(STDIN));
   // Recupero indice
   $index = primerMulta($dataMultas, $km);
   if ($index != -1) {
    $newAsociativo = $dataMultas[$index];
    echo "La primer multa que supera los $km km/h es: \n";
    mostrarData($newAsociativo);
   }
   else {
    echo "No hay multas para este km/h.\n";
    }
    // Punto D --> Solicitar al usuario patente, etc
    echo "Ingrese una patente: ";
    $patente =  trim(fgets(STDIN));
    $patente = strtoupper($patente);
    $newArray = multasPatente($dataMultas, $patente);
    if ($newArray != null) {
        print_r( $newArray);
    }
    else {
       echo "No hay multas registradas para esta patente.";
    }
    
    ?>