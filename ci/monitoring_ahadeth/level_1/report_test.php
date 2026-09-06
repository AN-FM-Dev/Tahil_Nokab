<?php

require_once __DIR__ . '/../../../api/google_sheets.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$spreadsheetId = $blog_monitoring;

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
        'format' => [423, 609],
        'orientation' => 'P',
        'margin_left' => 41.5,
        'margin_right' => 0,
        'margin_top' => 201,
        'margin_bottom' => 0,
        'default_font_size' => 20,
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

    $test = $_GET['view'];
    if($test === "test_h_1"){$background = "blog_template_1_1_test_h"; $pageName = "level_1_1_test_h"; $name = "الحفظ";}
    elseif($test === "test_h_2"){$background = "blog_template_1_2_test_h"; $pageName = "level_1_2_test_h"; $name = "الحفظ";}
    elseif($test === "test_h_3"){$background = "blog_template_1_3_test_h"; $pageName = "level_1_3_test_h"; $name = "الحفظ";}
    elseif($test === "test_h_4"){$background = "blog_template_1_4_test_h"; $pageName = "level_1_4_test_h"; $name = "الحفظ";}
    elseif($test === "test_t_1"){$background = "blog_template_1_1_test_t"; $pageName = "level_1_1_test_t"; $name = "التفهم";}
    elseif($test === "test_t_2"){$background = "blog_template_1_2_test_t"; $pageName = "level_1_2_test_t"; $name = "التفهم";}
    elseif($test === "test_t_3"){$background = "blog_template_1_3_test_t"; $pageName = "level_1_3_test_t"; $name = "التفهم";}
    elseif($test === "test_t_4"){$background = "blog_template_1_4_test_t"; $pageName = "level_1_4_test_t"; $name = "التفهم";}

    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();

    $ranges = [
        "$pageName!B6:E50",
        "$pageName!E1"
    ];

    $response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => $ranges
    ]);

    $valueRanges = $response->getValueRanges();

    $valueRanges = $response->getValueRanges();

    $blockValues = $valueRanges[0]->getValues();
    $cellValue_1 = $valueRanges[1]->getValues();

    if ($pageName === "level_1_1_test_h" || "level_1_1_test_t") {$test_hName = 'الأول';}
    elseif ($pageName === "level_1_2_test_h" || "level_1_2_test_t") {$test_hName = 'الثاني';}
    elseif ($pageName === "level_1_3_test_h" || "level_1_3_test_t") {$test_hName = 'الثالث';}
    elseif ($pageName === "level_1_4_test_h" || "level_1_4_test_t") {$test_hName = 'الرابع';}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../../style.css?v=<?= time() ?>">
   <title>النخبة | اختبار <?= $name; ?> <?= $test_hName; ?></title>

</head>
<body>

<section id="test">

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
  

<?php if (!empty($cellValue_1)) { $E1 = $cellValue_1[0][0] ?? ''; ?>
  <div class="E1"><?= htmlspecialchars($E1); ?></div>
<?php } ?>

   </section>

</body>
</html>


<?php
    $html = ob_get_clean();
    $mpdf->WriteHTML($html);

    $mpdf->Output("النخبة - اختبار الحفظ $test_hName (مستوى السنة النبوية).pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>