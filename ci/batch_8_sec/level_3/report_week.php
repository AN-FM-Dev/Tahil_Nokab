<?php

require_once __DIR__ . '/../../../api/google_sheets.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$spreadsheetId = $sec_monitoring;

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

    $week = $_GET['view'];
    if($week === "week_1"){$background = "template_8_3_1"; $pageName = "level_3_1";}
    elseif($week === "week_2"){$background = "template_8_3_2"; $pageName = "level_3_2";}
    elseif($week === "week_3"){$background = "template_8_3_3"; $pageName = "level_3_3";}
    elseif($week === "week_4"){$background = "template_8_3_4"; $pageName = "level_3_4";}
    elseif($week === "week_5"){$background = "template_8_3_5"; $pageName = "level_3_5";}
    elseif($week === "week_6"){$background = "template_8_3_6"; $pageName = "level_3_6";}
    elseif($week === "week_7"){$background = "template_8_3_7"; $pageName = "level_3_7";}
    elseif($week === "week_8"){$background = "template_8_3_8"; $pageName = "level_3_8";}
    elseif($week === "week_9"){$background = "template_8_3_9"; $pageName = "level_3_9";}
    elseif($week === "week_10"){$background = "template_8_3_10"; $pageName = "level_3_10";}
    elseif($week === "week_11"){$background = "template_8_3_11"; $pageName = "level_3_11";}
    elseif($week === "week_12"){$background = "template_8_3_12"; $pageName = "level_3_12";}
    elseif($week === "week_13"){$background = "template_8_3_13"; $pageName = "level_3_13";}
    elseif($week === "week_14"){$background = "template_8_3_14"; $pageName = "level_3_14";}

    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();

    $ranges = [
        "$pageName!A4:Q15",
        "$pageName!J1",
        "$pageName!K1"
    ];

    $response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => $ranges
    ]);

    $valueRanges = $response->getValueRanges();

    $valueRanges = $response->getValueRanges();

    $blockValues = $valueRanges[0]->getValues();
    $cellValue_1 = $valueRanges[1]->getValues();
    $cellValue_2 = $valueRanges[2]->getValues();

    if ($pageName === "level_3_1") {$weekName = 'الأول';}
    elseif ($pageName === "level_3_2") {$weekName = 'الثاني';}
    elseif ($pageName === "level_3_3") {$weekName = 'الثالث';}
    elseif ($pageName === "level_3_4") {$weekName = 'الرابع';}
    elseif ($pageName === "level_3_5") {$weekName = 'الخامس';}
    elseif ($pageName === "level_3_6") {$weekName = 'السادس';}
    elseif ($pageName === "level_3_7") {$weekName = 'السابع';}
    elseif ($pageName === "level_3_8") {$weekName = 'الثامن';}
    elseif ($pageName === "level_3_9") {$weekName = 'التاسع';}
    elseif ($pageName === "level_3_10") {$weekName = 'العاشر';}
    elseif ($pageName === "level_3_11") {$weekName = 'الأول';}
    elseif ($pageName === "level_3_12") {$weekName = 'الأول';}
    elseif ($pageName === "level_3_13") {$weekName = 'الأول';}
    elseif ($pageName === "level_3_14") {$weekName = 'الأول';}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../../style.css?v=<?= time() ?>">
   <title>نخب | الأسبوع <?= $weekName; ?></title>

</head>
<body>

<section id="week">

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

<?php if (!empty($cellValue_2)) { $K1 = $cellValue_2[0][0] ?? ''; ?>
  <div class="K1"><?= htmlspecialchars($K1); ?></div>
<?php } ?>

<?php if (!empty($cellValue_1)) { $J1 = $cellValue_1[0][0] ?? ''; ?>
  <div class="J1"><?= htmlspecialchars($J1); ?></div>
<?php } ?>

   </section>

</body>
</html>


<?php
    $html = ob_get_clean();
    $mpdf->WriteHTML($html);

    $mpdf->Output("نخب - الأسبوع $weekName (الثانوي).pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>