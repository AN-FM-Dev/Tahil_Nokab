<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../api/google_sheets.php';
require_once __DIR__ . '/../vendor/autoload.php';

$spreadsheetId = $t_7;

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
        'format' => [385, 500],
        'orientation' => 'P',
        'margin_left' => 23.3,
        'margin_right' => 23.3,
        'margin_top' => 163.3,
        'margin_bottom' => 65,
        'default_font_size' => 34,
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

    $level = $_GET['view'] ?? '';
    if ($level === "all_level") {$background = "template_7_s_2"; $coverBackground = "template_7_s_1"; $pageName = "report_v_s";}

    ob_start();

    $mpdf->AddPageByArray([
        'orientation' => 'P',
        'sheet-size' => [385, 544],
    ]);
    if (!empty($coverBackground)) {
        $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$coverBackground.jpg')");
        $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
        $mpdf->SetDefaultBodyCSS('background-position', 'center center');
    }
    $mpdf->WriteHTML("");

    $mpdf->AddPageByArray([
        'orientation' => 'P',
        'sheet-size' => [385, 1084.72],
    ]);
    if (!empty($background)) {
        $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$background.jpg')");
        $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
        $mpdf->SetDefaultBodyCSS('background-position', 'center center');
    }

    if (!empty($pageName) && $pageName === "report_v_s") {$levelName = 'الكامل';}

    function safeValues($valueRanges, $index) {
        if (!is_array($valueRanges)) return [];
        if (!isset($valueRanges[$index])) return [];
        $vr = $valueRanges[$index];
        if ($vr === null) return [];
        if (is_object($vr) && method_exists($vr, 'getValues')) {
            return $vr->getValues() ?? [];
        }
        if (is_array($vr)) return $vr;
        return [];
    }

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css?v=<?= time() ?>">
    <title>نخب 7 | التقرير التفصيلي للدفعة</title>
</head>
<body>

<?php

$ranges = [
    "$pageName!F1"
];

$valueRanges = getSheetData($service, $spreadsheetId, $ranges);

$firstBlock = safeValues($valueRanges, 0);
$F1 = $firstBlock[0][0] ?? '';
$num = (int)$F1;

$offset = 0;
$step = 20;

for ($i = 0; $i < $num; $i++) {
    $names = 1 + $offset;
    $start_main_1 = 4 + $offset;
    $end_main_1   = 5 + $offset;

    $start_main_2 = 6 + $offset;
    $end_main_2   = 9 + $offset;

    $start_main_3 = 10 + $offset;
    $end_main_3   = 12 + $offset;

    $rate = 1 + $offset;

    $start_main_4 = 4 + $offset;
    $end_main_4   = 13 + $offset;

    $ranges = [
        "$pageName!A$names",
        "$pageName!B$start_main_1:E$end_main_1",
        "$pageName!B$start_main_2:E$end_main_2",
        "$pageName!B$start_main_3:E$end_main_3",
        "$pageName!B$rate",
        "$pageName!C$rate",
        "$pageName!D$rate",
        "$pageName!E$rate",
        "$pageName!G$start_main_4:N$end_main_4",
    ];

    $valueRanges = getSheetData($service, $spreadsheetId, $ranges);

    $blockValues = safeValues($valueRanges, 0);
    $cellValue_1 = safeValues($valueRanges, 1);
    $cellValue_2 = safeValues($valueRanges, 2);
    $cellValue_3 = safeValues($valueRanges, 3);
    $cellValue_4 = safeValues($valueRanges, 4);
    $cellValue_5 = safeValues($valueRanges, 5);
    $cellValue_6 = safeValues($valueRanges, 6);
    $cellValue_7 = safeValues($valueRanges, 7);
    $cellValue_8 = safeValues($valueRanges, 8);

    echo "<section id='report_v_s_all'>";
    if (!empty($blockValues)) {
        $A1 = $blockValues[0][0] ?? '';
        echo "<div class='A1'>" . htmlspecialchars($A1) . "</div>";
    }

    if (!empty($cellValue_1)) {
        echo "<table id='sheetTable_1'>";
        foreach ($cellValue_1 as $row) {
            if (empty(array_filter($row))) continue;
            echo "<tr><td></td>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    if (!empty($cellValue_2)) {
        echo "<table id='sheetTable_2'>";
        foreach ($cellValue_2 as $row) {
            if (empty(array_filter($row))) continue;
            echo "<tr><td></td>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    if (!empty($cellValue_3)) {
        echo "<table id='sheetTable_3'>";
        foreach ($cellValue_3 as $row) {
            if (empty(array_filter($row))) continue;
            echo "<tr><td></td>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<table class='num'>
    <tr>
    <td class='B1'>";

    if (!empty($cellValue_4)) {
        $B1 = $cellValue_4[0][0] ?? '';
        echo htmlspecialchars($B1);
    }

    echo "</td><td class='C1'>";
    if (!empty($cellValue_5)) {
        $C1 = $cellValue_5[0][0] ?? '';
        echo htmlspecialchars($C1);
    }

    echo "</td><td class='D1'>";
    if (!empty($cellValue_6)) {
        $D1 = $cellValue_6[0][0] ?? '';
        echo htmlspecialchars($D1);
    }

    echo "</td><td class='E1'>";
    if (!empty($cellValue_7)) {
        $E1 = $cellValue_7[0][0] ?? '';
        echo htmlspecialchars($E1);
    }
    echo "</tr></table>";

    if (!empty($cellValue_8)) {
        echo "<table class='test'>";
        foreach ($cellValue_8 as $row) {
            if (empty(array_filter($row))) continue;
            echo "<tr><td></td>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
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
    $mpdf->Output("نخب 7 - التقرير التفصيلي للدفعة.pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
} catch (\Throwable $e) {
    echo 'خطأ: ' . $e->getMessage();
}
?>