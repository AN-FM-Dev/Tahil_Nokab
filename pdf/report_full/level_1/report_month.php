<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../../api/google_sheets.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$spreadsheetId = $summation;

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
        'format' => [661.58, 354.61],
        'orientation' => 'P',
        'margin_left' => 22.7,
        'margin_right' => 0,
        'margin_top' => 136.4,
        'margin_bottom' => 0,
        'default_font_size' => 16,
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

    $month = $_GET['view'];
    if($month === "month_1"){$background = "all_template_1_1_month"; $pageName = "level_1_1_month";}
    elseif($month === "month_2"){$background = "all_template_1_2_month"; $pageName = "level_1_2_month";}
    elseif($month === "month_3"){$background = "all_template_1_3_month"; $pageName = "level_1_3_month";}
    elseif($month === "month_4"){$background = "all_template_1_4_month"; $pageName = "level_1_4_month";}

    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();

    $ranges = [
      "$pageName!A9:X13"
    ];

    $response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => $ranges
    ]);

    $valueRanges = $response->getValueRanges();
    $blockValues = $valueRanges[0]->getValues();

    if ($pageName === "level_1_1_month") {$monthName = 'الأول';}
    elseif ($pageName === "level_1_2_month") {$monthName = 'الثاني';}
    elseif ($pageName === "level_1_3_month") {$monthName = 'الثالث';}
    elseif ($pageName === "level_1_4_month") {$monthName = 'الرابع';}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../../style.css?v=<?= time() ?>">
   <title>نخب | التقرير الجامع - الشهر <?= $monthName; ?></title>

</head>
<body>

<section id="full_month">

<?php if (!empty($blockValues)) { ?>
    <table id="sheetTable">
      <?php foreach ($blockValues as $row) { ?>
        <tr>
          <?php foreach ($row as $cell) { ?>
            <td><?= htmlspecialchars($cell) ?></td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
  <?php } ?>

   </section>

</body>
</html>


<?php
    $html = ob_get_clean();
    $mpdf->WriteHTML($html);

    $mpdf->Output("نخب - التقرير الجامع - الشهر $monthName.pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>