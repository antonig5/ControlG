<?php
ob_start();
session_start();
require_once('../../connections/connection.php');



if (isset($_GET['idRecibo'])) {
    $mues = $_GET['idRecibo'];
    $sql = "SELECT * FROM recibo INNER JOIN tipogasolina ON tipogasolina.idTGaso = recibo.idTGaso INNER JOIN tipovehiculo ON tipovehiculo.idTvehiculo = recibo.idTvehiculo INNER JOIN usuarios ON usuarios.documento = recibo.idUs where recibo.idRecibo = $mues";
    $result = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $date = $row['fecha'];
        $tipo = $row['tipoGasolina'];
        $name = $row['nombre'];
        $ape = $row['apellido'];
        $id = $row['idRecibo'];
        $vehiculo = $row['tipoVehiculo'];
        $precio = $row['precio'];
        $cantidad = $row['cantid'];
        $total =  $cantidad * $precio;
    }
}










?>

<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">


    <h1 style="font-size: 50px;">FACTURA Nº <? echo $id ?></h1>
    <div class="images">
        <img src="../../images/logo.png" alt="" style="width: 250px; margin: 100%px; margin: botton 400px;  position: relative;
            top: -200px;">
    </div>
    <div style="display: grid; position: relative; top: -200px; border-collapse: collapse;
  margin: 2px;
  
 
  min-width: 80px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); ">




        <table>
            <thead>
                <tr style="border-top: solid #009879;">

                    <th style=" padding: 1px 15px; border-bottom: solid #009879;">
                        <p style="font-size: 15px;  font-weight: bold; ">Vendido por: <? echo $name ?>
                            <? echo $ape ?> </p>
                    </th>

                    <th style=" padding: 1px 15px; border-bottom: solid #009879;">
                        <p style="font-size: 15px;  font-weight: bold;">Combustible: <? echo $tipo ?></p>
                    </th>

                    <th style=" padding: 1px 15px; border-bottom: solid #009879;">
                        <p style="font-size: 15px;  font-weight: bold; ">Precio: $<? echo $precio ?></p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr style=" text-align: left;">
                    <td style=" padding: 1px 20px; border-bottom: solid #009879;">
                        <p style="font-size: 15px;  font-weight: bold;">Fecha: <? echo $date ?></p>
                    </td>
                    <td style=" padding: 1px 20px; border-bottom: solid #009879;">
                        <p style="font-size: 15px;  font-weight: bold;">Cantidad: <? echo $cantidad ?> Galones</p>
                    </td>

                    <td style=" padding: 1px 20px; border-bottom: solid #009879;">
                        <p style="font-size: 15px;  font-weight: bold; ">vehiculo: <? echo $vehiculo ?> </p>
                    </td>
                </tr>




            </tbody>
        </table>



        <table style=" border-collapse: collapse;
  margin: 2px;
  position: absolute;
  top: 30%;
  right: 110%;
  min-width: 80px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  ">
            <thead>
                <tr style="background-color: #009879;
  color: #ffffff;
  text-align: left; ">
                    <th style=" padding: 12px 110px;">Total</th>
                    <td style=" padding: 12px 400px;">CO $<? echo $total ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>

    </div>






</page>

<?php

$content = ob_get_clean();
require_once(dirname(__FILE__) . '../../../vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;

try {
    $html2pdf = new HTML2Pdf('P', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('PDF-CF.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
