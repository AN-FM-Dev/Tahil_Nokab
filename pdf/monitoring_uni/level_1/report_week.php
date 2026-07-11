<?php

require_once __DIR__ . '/../../../api/google_sheets.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$spreadsheetId = $uni_monitoring;

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
        'format' => [651, 458.28],
        'orientation' => 'P',
        'margin_left' => 19.6,
        'margin_right' => 0,
        'margin_top' => 131,
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
    if($week === "week_1"){$background = "uni_template_1_1"; $pageName = "level_1_1";}
    elseif($week === "week_2"){$background = "uni_template_1_2"; $pageName = "level_1_2";}
    elseif($week === "week_3"){$background = "uni_template_1_3"; $pageName = "level_1_3";}
    elseif($week === "week_4"){$background = "uni_template_1_4"; $pageName = "level_1_4";}
    elseif($week === "week_5"){$background = "uni_template_1_5"; $pageName = "level_1_5";}
    elseif($week === "week_6"){$background = "uni_template_1_6"; $pageName = "level_1_6";}
    elseif($week === "week_7"){$background = "uni_template_1_7"; $pageName = "level_1_7";}
    elseif($week === "week_8"){$background = "uni_template_1_8"; $pageName = "level_1_8";}
    elseif($week === "week_9"){$background = "uni_template_1_9"; $pageName = "level_1_9";}
    elseif($week === "week_10"){$background = "uni_template_1_10"; $pageName = "level_1_10";}
    elseif($week === "week_11"){$background = "uni_template_1_11"; $pageName = "level_1_11";}
    elseif($week === "week_12"){$background = "uni_template_1_12"; $pageName = "level_1_12";}
    elseif($week === "week_13"){$background = "uni_template_1_13"; $pageName = "level_1_13";}
    elseif($week === "week_14"){$background = "uni_template_1_14"; $pageName = "level_1_14";}

    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();

    $ranges = [
        "$pageName!A6:X50",
        "$pageName!W1",
        "$pageName!W2",
    ];

    $response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => $ranges
    ]);

    $valueRanges = $response->getValueRanges();

    $valueRanges = $response->getValueRanges();

    $blockValues = $valueRanges[0]->getValues();
    $cellValue_1 = $valueRanges[1]->getValues();
    $cellValue_2 = $valueRanges[2]->getValues();

    if ($pageName === "level_1_1") {$weekName = 'الأول';}
    elseif ($pageName === "level_1_2") {$weekName = 'الثاني';}
    elseif ($pageName === "level_1_3") {$weekName = 'الثالث';}
    elseif ($pageName === "level_1_4") {$weekName = 'الرابع';}
    elseif ($pageName === "level_1_5") {$weekName = 'الخامس';}
    elseif ($pageName === "level_1_6") {$weekName = 'السادس';}
    elseif ($pageName === "level_1_7") {$weekName = 'السابع';}
    elseif ($pageName === "level_1_8") {$weekName = 'الثامن';}
    elseif ($pageName === "level_1_9") {$weekName = 'التاسع';}
    elseif ($pageName === "level_1_10") {$weekName = 'العاشر';}
    elseif ($pageName === "level_1_11") {$weekName = 'الحادي عشر';}
    elseif ($pageName === "level_1_12") {$weekName = 'الثاني عشر';}
    elseif ($pageName === "level_1_13") {$weekName = 'الثالث عشر';}
    elseif ($pageName === "level_1_14") {$weekName = 'الرابع عشر';}
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

  <!--?php
      if (!empty($cellValue_3)) {
        echo "<table class='nums'>";
        foreach ($cellValue_3 as $row_value_3) {
            if (empty(array_filter($row_value_3))) continue;
            echo "<tr>";
            foreach ($row_value_3 as $cell_value_3) {
                echo "<td>" . htmlspecialchars($cell_value_3) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
  ?-->

<?php if (!empty($cellValue_2)) { $T1 = $cellValue_2[0][0] ?? ''; ?>
  <div class="T1"><?= htmlspecialchars($T1); ?></div>
<?php } ?>

<?php if (!empty($cellValue_1)) { $T2 = $cellValue_1[0][0] ?? ''; ?>
  <div class="T2"><?= htmlspecialchars($T2); ?></div>
<?php } ?>

   </section>

</body>
</html>


<?php
    $html = ob_get_clean();
    $mpdf->WriteHTML($html);

    $mpdf->Output("نخب - الأسبوع $weekName (جامعي).pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>