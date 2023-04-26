<?php

// require_once "../../controladores/usuarios.controlador.php";
// require_once "../../modelos/usuarios.modelo.php";
// require '../../extensiones/vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\IOFactory;

class ReporteExcel
{


    public function reporteUsuarios(){

        if(isset($_GET["excel"]) && $_GET["excel"]==1){

        $usuarios=ControladorUsuarios::ctrMostrarUsuarios(null, null);

        $excel = new Spreadsheet();
        $hoja = $excel->getActiveSheet();
        $hoja->setTitle("Usuarios");

        $hoja->setCellValue("A1", "Documento");
        $hoja->setCellValue("B1", "Usuario");
        $hoja->setCellValue("C1", "Nombre");

        $fila = 2;

        foreach($usuarios as $key => $value){

            $hoja->setCellValue('A'.$fila, $value["doc_usuario"]);
            $hoja->setCellValue('B'.$fila, $value["usuario"]);
            $hoja->setCellValue('C'.$fila, $value["nombre"]);

            $fila++;

        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="usuarios.xlsx"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
        exit;
    }


    }


}