
<? ob_start();

include(dirname(__FILE__).'/genera_diplomas_pdf.php');

$content = ob_get_clean();

    //convert in PDF
    require_once('../plugins/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L', 'A4', 'fr');
     // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        ob_clean();
        $html2pdf->Output('exemple00.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    } ?>