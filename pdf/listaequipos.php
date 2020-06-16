<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<?php

include "../inc/comun.php";

include "../fpdf/fpdf.php";

$bd = new GestarBD;

$x1 = $_GET['codigo'];

date_default_timezone_set('Europe/Madrid');
$hora       = date('H:i:s a');
$fecha      = date('d-m-Y ');
$fecha7dias = date('d-m-Y', strtotime('-1 week')); // resta 1 semana

class MiPDF extends FPDF
{
    public function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 10);
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(2, 157, 116); //Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach ($cabecera as $fila) {

            $this->CellFitSpace(30, 7, utf8_decode($fila), 1, 0, 'L', true);

        }
    }

    public function datosHorizontal($datos)
    {
        $this->SetXY(10, 17);
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach ($datos as $fila) {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(30, 7, utf8_decode($fila['nombre']), 1, 0, 'L', $bandera);
            $this->CellFitSpace(30, 7, utf8_decode($fila['apellido']), 1, 0, 'L', $bandera);
            $this->CellFitSpace(30, 7, utf8_decode($fila['matricula']), 1, 0, 'L', $bandera);
            $this->Ln(); //Salto de línea para generar otra fila
            $bandera = !$bandera; //Alterna el valor de la bandera
        }
    }

    public function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }

    //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    public function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true)
    {
        //Get string width
        $str_width = $this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }

        $ratio = ($w - $this->cMargin * 2) / $str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit) {
            if ($scale) {
                //Calculate horizontal scaling
                $horiz_scale = $ratio * 100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            } else {
                //Calculate character spacing in points
                $char_space = ($w - $this->cMargin * 2 - $str_width) / max($this->MBGetStringLength($txt) - 1, 1) * $this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align = '';
        }

        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

        //Reset character spacing/horizontal scaling
        if ($fit) {
            $this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
        }

    }

    public function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

    //Patch to also work with CJK double-byte text
    public function MBGetStringLength($s)
    {
        if ($this->CurrentFont['type'] == 'Type0') {
            $len     = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++) {
                if (ord($s[$i]) < 128) {
                    $len++;
                } else {
                    $len++;
                    $i++;
                }
            }
            return $len;
        } else {
            return strlen($s);
        }

    }
//************** Fin del código para ajustar texto *****************
    //******************************************************************
} // FIN Class PDF

$cabeceraT = array("Id Prod");

$mipdf = new MiPDF();
$mipdf->addPage();

$mipdf->Setfont('Arial', 'B', 10);
$mipdf->Ln(2);
$mipdf->Cell(185, 10, "Lista de productos $fecha", 0, 0, 'C');
$mipdf->Ln(10);

$mipdf->Cell(7, 12, "N", 0, 0, 'C');
for ($i = 0; $i < count($cabeceraT); $i++) {

    $mipdf->SetFont('ARIAL', 'B', 8);
    $mipdf->SetFillColor(0, 191, 255);
    $mipdf->Cell(15, 11, $cabeceraT[$i], 1, 0, 'C', true);
}

$mipdf->SetFont('ARIAL', 'B', 8);
$mipdf->SetFillColor(0, 191, 255);
$mipdf->Cell(22, 11, "Producto", 1, 0, 'C', true);
$mipdf->SetFont('ARIAL', 'B', 8);
$mipdf->SetFillColor(0, 191, 255);
$mipdf->Cell(80, 11, "Modelo", 1, 0, 'C', true);

$mipdf->SetFont('ARIAL', 'B', 8);
$mipdf->SetFillColor(0, 191, 255);
$mipdf->Cell(11, 11, "Precio", 1, 0, 'C', true);

$mipdf->SetFont('ARIAL', 'B', 8);
$mipdf->SetFillColor(0, 191, 255);
$mipdf->Cell(20, 11, "Marca", 1, 0, 'C', true);
$mipdf->SetFont('ARIAL', 'B', 8);
$mipdf->SetFillColor(0, 191, 255);
/*$mipdf->Cell(15, 11, "Estado", 1, 0, 'C', true);*/
$mipdf->SetFont('ARIAL', 'B', 8);
$mipdf->SetFillColor(0, 191, 255);
$mipdf->Cell(15, 11, "Cantidad", 1, 0, 'C', true);

$mipdf->Ln(1);

//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");

$mipdf->Ln(10);

$sql = "SELECT * FROM productos where id_productos";
//$consulta=mysql_query($conexion,$sql);
$sql2 = $bd->consulta($sql);

//$fecha55=$fecha7dias;
//$consulta55=mysql_query($conexion,$fecha55);
//$result=mysql_query($fecha55,$link) or die("Error: ".mysql_error());
$oye = 0;

$num = 0;

while ($datos = $bd->mostrar_registros($sql2)) {

    $num;

    $id = $datos['id_productos'];

    $nombre   = $datos['descripcion'];
    $apellido = $datos['modelo'];

    $sexo     = $datos['marca'];
    $p        = $datos['precio'];
    $am       = $datos['cod'];
    $cantidad = $datos['cantidad'];
    $marca    = $datos['marca'];

    /*$estado = $datos['estado'];*/

    $fec = date('d-m-y', $fechai);
    $d   = date('d', $fec);
    $m   = date('m', $fec);
    $y   = date('Y', $fec);

    $dia = date(d);
    $mes = date(m);
    $ano = date(Y);

//fecha de nacimiento

    $dianaz = 4;
    $mesnaz = 2;
    $anonaz = 2005;

//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

    if (($mesnaz == $mes) && ($dianaz > $dia)) {
        $ano = ($ano - 1);}

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

    if ($mesnaz > $mes) {
        $ano = ($ano - 1);}

//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

    $edad = ($ano - $anonaz);

    $fec = strtotime($parto);
    $fec = date('d-m-Y ', $fec);
    $d   = date('d', $fec);
    $m   = date('m', $fec);
    $y   = date('Y', $fec);

    $cabeceraS = array("$id");

    $num++;

    $mipdf->Cell(7, 5, "$num", 1, 0, 'C');
    for ($i = 0; $i < count($cabeceraS); $i++) {
        $mipdf->SetFont('ARIAL', 'B', 6.5);
        $mipdf->SetFillColor(1000, 1000, 255);
        $mipdf->Cell(15, 5, $cabeceraS[$i], 1, 0, 'C', true);
    }

    $mipdf->Cell(22, 5, "$nombre", 1, 0, 'C');
    $mipdf->CellFitSpace(80, 5, "$apellido", 1, 0, 'C');
    $mipdf->Cell(11, 5, "$p", 1, 0, 'C');

    $mipdf->Cell(20, 5, "$marca", 1, 0, 'C');
    /*$mipdf->Cell(15, 5, "$estado", 1, 0, 'C');*/

    if ($cantidad == "") {

        $cantidad = 0;
    }
    $mipdf->Cell(15, 5, "$cantidad", 1, 0, 'C');

    $mipdf->Ln(5);
}

/* $mipdf -> Cell(140,5,"",0,0,'C');
$regu="select sum(horalec)+sum(potelec)-0.5
from dlec";
$regu2=mysql_query($conexion,$regu);
$fila3 = mysqli_fetch_row($regu2);
$regu3 = $fila3[0];

$r="SELECT  count(horalec) FROM dlec";
$re=mysqli_query($conexion,$r);
$fil = mysqli_fetch_row($re);
$reg = $fil[0];

$pro=$reg/$oye;
 */

$mipdf->Ln(10);
$mipdf->cell(179.3, 4, "Fecha: $fecha", 0, 10, true);
$mipdf->cell(178.8, 4, "Hora: $hora", 0, 10, true);

$mipdf->Output();
class PDF extends FPDF
{
    public function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');

    }
}

?>
</head>
</html>
