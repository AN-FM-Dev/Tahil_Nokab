<?php


require_once __DIR__ . '/../../vendor/autoload.php';


use Mpdf\Mpdf;

try {
    $tempDir = __DIR__ . '/../../tmp';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }

    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => [571.5, 502.5],
        'orientation' => 'P',
        'margin_left' => 25.5,
        'margin_right' => 0,
        'margin_top' => 162.7,
        'margin_bottom' => 0,
        'default_font_size' => 17,
        'tempDir' => $tempDir,

        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),

        'fontdata' => $fontData + [
            '29LT' => [
                'R' => '../../../../29LT Kaff.ttf',
                'B' => '../../../../29LT Kaff Semibold.ttf'
            ],
        ],

        'default_font' => '29LT',
    ]);



    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../../img/template_8_2_2.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();
    require("week_2.php");
    $html = ob_get_clean();
    $mpdf->WriteHTML($html);

    $mpdf->Output('نخب - الأسبوع الثاني (الثانوي).pdf', 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>