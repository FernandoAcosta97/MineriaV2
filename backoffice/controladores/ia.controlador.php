<?php


class ControladorIa
{

      public static function ctrExtraer($img, $iaValor, $doc_usuario, $id_campana, $tipoImg){


        if(isset($img) && isset($iaValor)){

            $texto = ModeloIa::mdlExtraer($img);

            // echo $texto;

            $fecha=ControladorIa::buscarFecha($texto);
            // echo $fecha."\n";

            $numeroProductos=ControladorIa::numeroDeProducto($texto);
            // echo $numeroProductos."\n";

            $numeroProductosDetectado=ControladorIa::detectarNumeroProducto($texto);

            $numeroRecibo=ControladorIa::numeroRecibo($texto);
            // echo $numeroRecibo."\n";

            $numeroAprobacion=ControladorIa::numeroApro($texto);
            // echo $numeroAprobacion."\n";

            $valor=ControladorIa::valorMonetario($texto,number_format($iaValor));
            // echo $valor."\n";
            $valorDetectado=ControladorIa::valorMonetarioDetectado($texto);
            // echo $valorDetectado."\n";

            $numeroProductoValido=false;
            // var_dump($numeroProductos);
            // var_dump($numeroProductosDetectado);

            if($numeroProductos==null && $numeroProductosDetectado!=null){
                $numeroProductos=$numeroProductosDetectado;
            }else if($numeroProductos!=null){
                $numeroProductoValido=true;
            }else{
                $numeroProductos=0;
            }


            if($numeroRecibo==null && $numeroAprobacion!=null){
                $numeroRecibo=$numeroAprobacion;
            }else if($numeroRecibo==null){
                $numeroRecibo=0;
            }


            $estado=2;
            $fechaCorrecta=false;
            $detalles = [];

            $fechaActual = date('Y-m-d');
            if($fecha==$fechaActual){
                $fechaCorrecta=true;
            }else{
                $detalles[] = "La fecha no es de hoy";
            }

            // var_dump($numeroProductoValido);

            $buscarRecibo=ControladorComprobantes::ctrMostrarDatosComprobantes("n_recibo", $numeroRecibo);
            // var_dump($buscarRecibo);


            if($numeroProductoValido && $valor!=null && $fechaCorrecta && !$buscarRecibo){
                $estado=1;
                $detalles[] = "Todo Está Correcto";

                
            }else if(!$numeroProductoValido || $buscarRecibo){

                if(!$numeroProductoValido){

                    $detalles[] = "El número de cuenta no es correcto";
            }
                
                if($buscarRecibo){

                    $detalles[] = "El número de recibo ya se encuentra registrado";
                }

                $estado=0;

                $cuentaToSearchPendientes = ["84100002251", "84100002252", "84100002253", "84100002254"];

                $ultimosCuatroNumeros = array_map(function($cuenta) {
                    return strval(substr($cuenta, -4));
                }, $cuentaToSearchPendientes);
                
                $r = array_merge($cuentaToSearchPendientes, $ultimosCuatroNumeros);
    
                foreach ($r as $numeroCuenta) {
                $pattern = '/\b' . preg_quote($numeroCuenta, '/') . '\b/';
                if (preg_match($pattern, $texto)) {
                      $estado=2;
                      break;
                } 
                }

            }


            if($valor==null){

                $detalles[] = "El valor ingresado es incorrecto";

            }


            if($valor==null && $valorDetectado!=null){
                $valor=$valorDetectado;
            }else if($valor==null){
                $valor=0;
            } 

            // if($fecha==null) $fecha=="";

            if($numeroAprobacion==null) $numeroAprobacion=0;


            $id_comprobante=ControladorComprobantes::ctrRegistrarComprobantesInversion($img, $iaValor, $doc_usuario, $id_campana, $tipoImg,$estado);

            $detallesString = implode("-", $detalles);

            $r=ControladorComprobantes::ctrRegistrarDatosComprobantes($numeroRecibo,$numeroAprobacion,$numeroProductos,$valor,$fecha,$id_comprobante,$detallesString);

            // var_dump($_FILES["imagen"]);
            $d=[$id_comprobante, $estado, $r];
            return $d;

            }
            return null;

      }



      public static function ctrExtraerPublicidad($img, $doc_usuario, $id_campana, $tipoImg, $vistas){


        if(isset($img)){

            $texto = ModeloIa::mdlExtraer($img);

            // echo $texto;
            $f="";

            $fecha=ControladorIa::buscarFecha($texto);

            if($fecha==null || $fecha==""){
                $f=ControladorIa::buscarFechaPublicidad($texto);
                // echo "fecha2: ".$fecha2."\n";
            }else{
                $f=$fecha;
                // echo "fecha: ".$fecha."\n";
            }

            $v=ControladorIa::buscarNvistas($texto,$vistas);
            // echo "vistas: ".$v."\n";

            $estadoHoy=ControladorIa::buscarEstadoHoy($texto);
            // echo "estado: ".$estadoHoy."\n";

            $estado=2;
            $fechaCorrecta=false;
            $detalles = [];

            // $fechaActual = date('Y-m-d');
            // if($fecha==$fechaActual){
            //     $fechaCorrecta=true;
            // }else{
            //     $detalles[] = "La fecha no es de hoy";
            // }

            $id_comprobante=ControladorComprobantes::ctrRegistrarComprobantesInversion($img, 2, $doc_usuario, $id_campana, $tipoImg,$estado);

            $detallesString = implode("-", $detalles);

            if($v==null){
                $v=$vistas;
            }

            $r=ControladorComprobantes::ctrRegistrarDatosComprobantesPublicidad($v,$estadoHoy,$f,$id_comprobante,$detallesString);

            // var_dump($_FILES["imagen"]);
            $d=[$id_comprobante, $estado, $r];
            // $d=[null, null, null];
            return $d;

            }
            return null;

      }


      public static function buscarEstadoHoy($texto){

        // Utilizamos una expresión regular para buscar el patrón de "Hoy" seguido de la hora
        $patron = '/(MiestadoHoy\D+\d{1,2}:\d{2}(?::\d{2})?\s?[aApP]\.?[mM]\.)|(Miestadohace\d+(?:minutos|Minutos))|(MiestadoHace\d+(?:Horas|horas))|(MiestadoHace\d+seg)|((?:Hoy, \d{1,2}:\d{2}(?::\d{2})?\s?[aApP]\.?[mM]\.))/';

        // Buscamos el patrón en el texto
        if (preg_match($patron, $texto, $matches)) {
            $hora_encontrada = $matches[0];
            // print_r($matches);
            return $hora_encontrada;
        } else {
            return null;
        }

      }

    public static function buscarNvistas($texto,$n){

        // Utilizamos expresiones regulares para buscar el último número en el texto
        if($n!=null && $n!=""){
        if (preg_match_all('/\d+/', $texto, $matches)) {

            $numerosEncontrados = $matches[0];

            if (in_array($n, $numerosEncontrados)){
                return $n;
            }
            // print_r($numerosEncontrados);
        } 
    }

        return null;

    }


    public static function buscarFechaPublicidad($texto){

        // Patrón para buscar el día y el mes en formato "DIAddMES"
        $patron = '/DIA(\d{1,2})([A-Z]{3})(\d{4})?/i';
        
        // Realizamos la búsqueda en el texto usando el patrón
        if (preg_match($patron, $texto, $coincidencias)) {
            // Las coincidencias se encuentran en $coincidencias[0] (no se usa)
            // El día se encuentra en $coincidencias[1]
            // El mes se encuentra en $coincidencias[2]
        
            // Formateamos el resultado: unimos el día y el mes con un espacio en el medio
            // var_dump($coincidencias);
            $dia = $coincidencias[1];
            $mes = $coincidencias[2];
        
            // Obtenemos el nombre completo del mes
            $meses = array(
                'ENE' => 'ENERO', 'FEB' => 'FEBRERO', 'MAR' => 'MARZO', 'ABR' => 'ABRIL', 'MAY' => 'MAYO', 'JUN' => 'JUNIO',
                'JUL' => 'JULIO', 'AGO' => 'AGOSTO', 'SEP' => 'SEPTIEMBRE', 'OCT' => 'OCTUBRE', 'NOV' => 'NOVIEMBRE', 'DIC' => 'DICIEMBRE'
            );
        
            // Convertimos el mes abreviado a su nombre completo
            $mesAbreviado = strtoupper($coincidencias[2]);
            $mes = isset($meses[$mesAbreviado]) ? $meses[$mesAbreviado] : '';
        
            // Unimos el día y el mes con un espacio en el medio
            $fecha = $dia . ' ' . $mes;
        
            // Imprimimos el resultado
            return $fecha;
        } 
        return null;

    }


    public static function buscarFecha($texto) {

        $fecha_formateada = null;

        $meses_abreviados = array(
            'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'
        );
    
        $patrones_fecha = [
            '/('.implode('|', $meses_abreviados).') \d{1,2} \d{4}/i', // Formato: ABR 29 2023
            '/\d{2}\/\d{2}\/\d{4}|\d{2}\/\d{2}\/\d{2}/',// Formato: 01/01/2023 o 01/01/23

        ];
    
        foreach ($patrones_fecha as $patron) {
            if (preg_match($patron, $texto, $matches)) {
                $fecha_encontrada = $matches[0];
                // echo "fecha encontrada ".$fecha_encontrada;}
                $fecha = self::detectarFormatoFecha($fecha_encontrada);
    
                if ($fecha !== false) {
                    $fecha_formateada = $fecha->format('Y-m-d');
                    return $fecha_formateada;  // Devuelve la fecha encontrada en formato "YYYY-MM-DD"
                }
            }
        }
    
        return $fecha_formateada;
    }

    
    public static function detectarFormatoFecha($fecha) {
        // Verificar formato "M d Y" (ejemplo: ABR 29 2023)
        $partes_fecha = explode(' ', $fecha);
        if (count($partes_fecha) === 3) {
            $mes = self::obtenerMesNumero($partes_fecha[0]);
            $dia = intval($partes_fecha[1]);
            $anio = intval($partes_fecha[2]);
    
            if ($mes && $dia && $anio) {
                return DateTime::createFromFormat('Y-m-d', $anio . '-' . $mes . '-' . $dia);
            }
        }
        // print_r($fecha);
        if (strpos($fecha, '/') !== false) {
            $partes_fecha = explode('/', $fecha);
            // print_r($partes_fecha);
            if (strlen($partes_fecha[2]) === 2) {
                return DateTime::createFromFormat('m-d-y', $partes_fecha[0] . '-' . $partes_fecha[1] . '-' . $partes_fecha[2]);
            } else {

                return DateTime::createFromFormat('Y-m-d', $partes_fecha[2] . '-' . $partes_fecha[1] . '-' . $partes_fecha[0]);
            }
        }
        
    
        return null; // Si no se encuentra ninguna fecha válida
    }
    
    
    
    
    
    
    

    private static function obtenerMesNumero($mes) {
        $meses_abreviados = [
            'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN',
            'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'
        ];
    
        $mes = strtoupper($mes);
        if (in_array($mes, $meses_abreviados)) {
            $numero_mes = array_search($mes, $meses_abreviados) + 1;
            return str_pad($numero_mes, 2, '0', STR_PAD_LEFT);
        }
    
        return null;
    }
    
    

    
      public static function numeroDeProducto($texto){

            $cuentaToSearch = ["84100002395", "84100002396", "84100002397", "84100002398"];

            $ultimosCuatroNumeros = array_map(function($cuenta) {
                return strval(substr($cuenta, -4));
            }, $cuentaToSearch);
            
            $r = array_merge($cuentaToSearch, $ultimosCuatroNumeros);

            foreach ($r as $numeroCuenta) {
            $pattern = '/\b' . preg_quote($numeroCuenta, '/') . '\b/';
            if (preg_match($pattern, $texto)) {
                  return $numeroCuenta;
            } 
            }

            return null;

            
      }


      public static function detectarNumeroProducto($texto) {
        // Patrón para detectar un número de producto
        $patron = '/(?i)(?:producto:|\*{4,})(\d+)/';
    
        // Encontrar la primera coincidencia del número de producto en el texto
        if (preg_match($patron, $texto, $matches)) {
            return $matches[1];
        } else {
            return null;
        }
    }


      public static function numeroRecibo($texto){

            // Expresión regular para el número de recibo
            $patronRecibo = '/(?<!\w)RECIBO:\s*(\d+)/';
            preg_match($patronRecibo, $texto, $matches);
            $numeroRecibo = isset($matches[1]) ? $matches[1] : '';

            if (!empty($numeroRecibo)) {
                  // Retornar el número de recibo
                  return $numeroRecibo;
              } else {
                  // Expresión regular para el número de registro de operación
                  $patronRegistro = '/(?<!\w)Registro de Operación:\s*(\d+)/';
                  preg_match($patronRegistro, $texto, $matches);
                  $numeroRegistro = isset($matches[1]) ? $matches[1] : null;
              
                  // Retornar el número de registro de operación
                  return $numeroRegistro;
              }

      }


      public static function numeroApro($texto) {
        // Expresión regular para el número de aprobación
        $patronAprobacion = '/(?<!\w)APRO:\s*(\d+)/';
        preg_match($patronAprobacion, $texto, $matches);
        $numeroAprobacion = isset($matches[1]) ? $matches[1] : null;
    
        // Si no se encuentra el número de aprobación, buscar el número después de la hora
        if ($numeroAprobacion === null) {
            $patronNumeroHora = '/\d{2}:\d{2}\s*(\d+)/';
            preg_match($patronNumeroHora, $texto, $matches);
            $numeroAprobacion = isset($matches[1]) ? $matches[1] : null;
        }
    
        // Retornar el número de aprobación
        return $numeroAprobacion;
    }



    public static function valorMonetario($texto, $valor) {
        $patronValorMonetario = '/[^\d]*(' . preg_quote($valor) . '|'. str_replace(',', '\.', preg_quote($valor)) . ')[^\d]*/';
        preg_match($patronValorMonetario, $texto, $matches);
        $valorMonetario = isset($matches[1]) ? $matches[1] : null;
    
        if ($valorMonetario !== null) {
            // Eliminar los caracteres no numéricos
            $valorMonetario = preg_replace('/[^0-9]/', '', $valorMonetario);
        }
    
        return $valorMonetario;
    }


    public static function valorMonetarioDetectado($texto)
    {
        $valorMonetario = null;
        // $patron = '/\$\s*([\d.,]+)/';
        $patron = '/\$\s*((?!0(?:\.00)?)(?:\d{1,3}(?:[.,]\d{3})*(?:,\d{2})?|\d{1,3}))/u';
    
        if (preg_match($patron, $texto, $coincidencias)) {
            // Obtener el primer valor capturado
            $valor_texto = $coincidencias[1];
            $valorMonetario = preg_replace('/[^\d]/', '', $valor_texto);
    
        } 
    
        return $valorMonetario;
    }
    
    
    

    
    
 

}