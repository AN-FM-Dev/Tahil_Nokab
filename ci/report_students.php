<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../api/google_sheets.php';
require_once __DIR__ . '/../vendor/autoload.php';

$spreadsheetId = $elmy_monitoring;

use Mpdf\Mpdf;

try {
    $tempDir = __DIR__ . '/../tmp';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }

    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => [385, 824],
        'orientation' => 'P',
        'margin_left' => 14,
        'margin_right' => 14,
        'margin_top' => 163.3,
        'margin_bottom' => 40,
        'default_font_size' => 15,
        'tempDir' => $tempDir,
        'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
        'fontdata' => $fontData + [
            '29LT' => [
                'R' => '../../../29LT Kaff.ttf',
                'B' => '../../../29LT Kaff Semibold.ttf'
            ],
        ],
        'default_font' => '29LT',
    ]);

    $level = $_GET['view'];
    if($level === "level_1"){$background = "template_8_1_s_2"; $coverBackground = "template_8_1_s_1"; $pageName = "report_v_s_1";}
    elseif($level === "level_2"){$background = "template_8_2_s_2"; $coverBackground = "template_8_2_s_1"; $pageName = "report_v_s_2";}
    elseif($level === "level_3"){$background = "template_8_3_s_2"; $coverBackground = "template_8_3_s_1"; $pageName = "report_v_s_3";}

    ob_start();

    $mpdf->AddPageByArray([
        'orientation' => 'P',
        'sheet-size' => [385, 544],
    ]);
    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$coverBackground.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');
    $mpdf->WriteHTML("");


    $mpdf->AddPageByArray([
        'orientation' => 'P',
        'sheet-size' => [385, 775],
    ]);
    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    if ($pageName === "report_v_s_1") {$levelName = 'الأول';}
    elseif ($pageName === "report_v_s_2") {$levelName = 'الثاني';}
    elseif ($pageName === "report_v_s_3") {$levelName = 'الثالث';}

?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css?v=<?= time() ?>">
    <title>النخبة | التقرير التفصيلي للمستوى <?= $levelName; ?></title>
</head>
<body>

<?php

$ranges = [
    "$pageName!A1"
];

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => $ranges
]);

$valueRanges = getSheetData($service, $spreadsheetId, $ranges);

$blockValues = $valueRanges[0]->getValues();
if (!empty($blockValues)) { 
    $A1 = $blockValues[0][0] ?? ''; 
}

$num = (int)$A1;
$offset = 0;
$step = 20;
$fixed = 1;

for ($i = 0; $i < $num; $i++) {
    $start_main = 4 + $offset;
    $end_main   = 19 + $offset;

    if ($i > 0) $fixed += 20;

    $single_row_start = 20 + $offset;
    $single_row_end   = 20 + $offset;

    $summary_start = 4 + $offset;
    $summary_end   = 6 + $offset;

    $ranges = [
        "$pageName!B$start_main:Q$end_main",
        "$pageName!B$single_row_start:Q$single_row_end",
        "$pageName!D$fixed",
        "$pageName!K$fixed",
        "$pageName!P$fixed",
        "$pageName!S$summary_start:Z$summary_end"
    ];

    $valueRanges = getSheetData($service, $spreadsheetId, $ranges);

    $blockValues = $valueRanges[0]->getValues();
    $cellValue_1 = $valueRanges[1]->getValues();
    $cellValue_2 = $valueRanges[2]->getValues();
    $cellValue_3 = $valueRanges[3]->getValues();
    $cellValue_4 = $valueRanges[4]->getValues();
    $cellValue_5 = $valueRanges[5]->getValues();

    echo "<section id='report_v_s'>";
    if (!empty($cellValue_2)) {
        $C1 = $cellValue_2[0][0] ?? '';
        echo "<div class='C1'>" . htmlspecialchars($C1) . "</div>";
    }

    if (!empty($blockValues)) {
        echo "<table id='sheetTable'>";
        foreach ($blockValues as $row) {
            if (empty(array_filter($row))) continue;
            echo "<tr><td></td>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        foreach ($cellValue_1 as $row_value_1) {
            if (empty(array_filter($row_value_1))) continue;
            echo "<tr><td></td>";
            foreach ($row_value_1 as $cell_value_1) {
                echo "<td style='color: #f5f5f5;'>" . htmlspecialchars($cell_value_1) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<table class='num'><tr><td class='J1'>";
    if (!empty($cellValue_3)) {
        $J1 = $cellValue_3[0][0] ?? '';
        echo htmlspecialchars($J1);
    }
    echo "</td><td class='N1'>";
    if (!empty($cellValue_4)) {
        $N1 = $cellValue_4[0][0] ?? '';
        echo htmlspecialchars($N1);
    }
    echo "</td></tr></table>";

    if (!empty($cellValue_5)) {
        echo "<table class='test'>";
        foreach ($cellValue_5 as $row_value_5) {
            if (empty(array_filter($row_value_5))) continue;
            echo "<tr><td></td><td></td>";
            foreach ($row_value_5 as $cell_value_5) {
                echo "<td>" . htmlspecialchars($cell_value_5) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "</section>";

    $offset += $step;
}
?>


</body>
</html>


<?php
    $html = ob_get_clean();
    $mpdf->WriteHTML($html);

    $mpdf->Output("النخبة - التقرير التفصيلي [المستوى $levelName] (جامعي).pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>