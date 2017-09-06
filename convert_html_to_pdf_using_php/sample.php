<?php
// include autoloader
require_once 'brochure/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

$res = file_get_contents('brochure/print.php');
//file_put_contents('tmp.html', $res);
// instantiate and use the dompdf class
$dompdf = new Dompdf();
// $dompdf->set_base_path('/var/www/html/convert_html_to_pdf_using_php/');
$dompdf->loadHtml($res);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A3', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codex",array("Attachment"=>0));
?>