<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../api/google_sheets.php';
require_once __DIR__ . '/../vendor/autoload.php';

$spreadsheetId = $summer48;

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
        'format' => [423, 562.94],
        'orientation' => 'P',
        'margin_left' => 11,
        'margin_right' => 0,
        'margin_top' => 237,
        'margin_bottom' => 0,
        'default_font_size' => 25,
        'tempDir' => $tempDir,

        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/../fonts'
        ]),

        'fontdata' => $fontData + [
            '29lt' => [
                'R' => '29LT_Kaff.ttf',
                'B' => '29LT_Kaff_Semibold.ttf',
            ],
        ],

        'default_font' => 'Cairo',

    ]);

    $week = $_GET['view'] ?? '';
    $sheet = $_GET['sheet'] ?? '';

    switch ($sheet) {
      case 'uni':
          $view_sheet = "!G3";
          $name_sheet = "مستوي المتون العلمية";
          $pageName = "{$sheet}_week";
          break;

  
      case 'blog':
          $view_sheet = "!G5";
          $name_sheet = "مستوى السنة النبوية";
          $pageName = "{$sheet}_week";
          break;
  
      case 'zad':
          $view_sheet = "!G6";
          $name_sheet = "مستوى الفقه";
          $pageName = "{$sheet}_week";
          break;
  
      default:
          die('Track not found');
  }

    if($week === "week_1"){$background = "summer48_{$sheet}_1"; $weekName = 'الأول'; $week_step = 0;}
    elseif($week === "week_2"){$background = "summer48_{$sheet}_2"; $weekName = 'الثاني'; $week_step = 1;}
    elseif($week === "week_3"){$background = "summer48_{$sheet}_3"; $weekName = 'الثالث'; $week_step = 2;}

    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();

    $step = 10;

    $start = 5;
    $end  = 10;

    $start_main = $start + ($step * $week_step);
    $end_main   = $end + ($step * $week_step);

    $ranges = [
        "$pageName!B$start_main:I$end_main",
    ];

    $valueRanges = getSheetData($service, $spreadsheetId, $ranges);

    $blockValues = $valueRanges[0]->getValues();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../style.css?v=<?= time() ?>">
   <title>النخبة | الأسبوع <?= $weekName; ?></title>

</head>
<body>

<section id='summer_week'>
  

    <?php if (!empty($blockValues)) { ?>
      <table id="sheetTable_1">
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

    $mpdf->Output("النخبة - الدورة الصيفية ($weekName) $name_sheet.pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>