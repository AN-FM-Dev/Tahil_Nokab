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
        'format' => [385, 740],
        'orientation' => 'P',
        'margin_left' => 10, //40.5
        'margin_right' => 5,
        'margin_top' => 183,
        'margin_bottom' => 20,
        'default_font_size' => 19,
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

    ?>


    <?php
    $level = $_GET['view'];
    if($level === "level_1"){$background = "template_8_1"; $tops = "tops_8_1"; $pageName = "report_v_1";}
    elseif($level === "level_2"){$background = "template_8_2"; $tops = "tops_8_2"; $pageName = "report_v_2";}
    elseif($level === "level_3"){$background = "template_8_3"; $tops = "tops_8_3"; $pageName = "report_v_3";}

    if ($pageName === "report_v_1") {$levelName = 'الأول';}
    elseif ($pageName === "report_v_2") {$levelName = 'الثاني';}
    elseif ($pageName === "report_v_3") {$levelName = 'الثالث';}

    $ranges = [
        "$pageName!B4:G15",
        "$pageName!C2",
        "$pageName!D2",
        "$pageName!I4:N4",
        "$pageName!B4:G6"
    ];
    
    $response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => $ranges
    ]);
    
    $valueRanges = getSheetData($service, $spreadsheetId, $ranges);
    
    $blockValues = $valueRanges[0]->getValues();
    $cellValue_1 = $valueRanges[1]->getValues();
    $cellValue_2 = $valueRanges[2]->getValues();
    $cellValue_3 = $valueRanges[3]->getValues();
    $cellValue_4 = $valueRanges[4]->getValues();


    $mpdf->AddPageByArray([
        'orientation' => 'P',
        'sheet-size' => [385, 740],
    ]);
    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css?v=<?= time() ?>">
    <title>النخبة | التقرير الاجمالي للمستوى <?= $levelName; ?></title>
</head>
<body>

<section id="report_v">

    <table class="num">
        <tr>
            <td class="C2">
                <?php if (!empty($cellValue_1)) { 
                    $C2 = $cellValue_1[0][0] ?? ''; 
                    echo htmlspecialchars($C2); 
                } ?>
            </td>
            <td class="D2">
                <?php if (!empty($cellValue_2)) { 
                    $D2 = $cellValue_2[0][0] ?? ''; 
                    echo htmlspecialchars($D2); 
                } ?>
            </td>
        </tr>
    </table>

    <?php if (!empty($blockValues)) { ?>
        <table id="sheetTable_1">
        <?php foreach ($blockValues as $row) { ?>
            <tr>
                <td></td>
            <?php foreach ($row as $cell) { ?>
                <td><?= htmlspecialchars($cell) ?></td>
            <?php } ?>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>

</section>

<?php 
$mpdf->WriteHTML(ob_get_clean());

$mpdf->SetTopMargin(159);
$mpdf->AddPageByArray([
    'orientation' => 'P',
    'sheet-size' => [385, 463],
]);
$mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$tops.jpg')");
$mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
$mpdf->SetDefaultBodyCSS('background-position', 'center center');

ob_start();
?>

<section id="report_v">

    <?php if (!empty($cellValue_3)) { ?>
        <table id="sheetTable_2">
        <?php foreach ($cellValue_3 as $row) { ?>
            <tr>
                <td></td>
            <?php foreach ($row as $cell) { ?>
                <td><?= htmlspecialchars($cell) ?></td>
            <?php } ?>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>


    <?php if (!empty($cellValue_4)) { ?>
        <table id="sheetTable_3">
        <?php foreach ($cellValue_4 as $row) { ?>
            <tr>
                <td></td>
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
    $mpdf->WriteHTML(ob_get_clean());

    $mpdf->Output("النخبة - التقرير الاجمالي [المستوى $levelName] (جامعي).pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>