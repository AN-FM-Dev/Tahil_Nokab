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

    $day = $_GET['view'] ?? '';
    $sheet = $_GET['sheet'] ?? '';

    switch ($sheet) {
      case 'uni':
          $view_sheet = "!G3";
          $name_sheet = "مستوي المتون العلمية";
          $pageName = "{$sheet}_Day";
          break;
  
      case 'blog':
          $view_sheet = "!G5";
          $name_sheet = "مستوى السنة النبوية";
          $pageName = "{$sheet}_Day";
          break;
  
      case 'zad':
          $view_sheet = "!G6";
          $name_sheet = "مستوى الفقه";
          $pageName = "{$sheet}_Day";
          break;
  
      default:
          die('Track not found');
  }

    if($day === "day_1"){$background = "summer48_{$sheet}_1_1"; $dayName = 'الأول'; $day_step = 0;}
    elseif($day === "day_2"){$background = "summer48_{$sheet}_1_2"; $dayName = 'الثاني'; $day_step = 1;}
    elseif($day === "day_3"){$background = "summer48_{$sheet}_1_3"; $dayName = 'الثالث'; $day_step = 2;}
    elseif($day === "day_4"){$background = "summer48_{$sheet}_1_4"; $dayName = 'الرابع'; $day_step = 3;}
    elseif($day === "day_5"){$background = "summer48_{$sheet}_1_5"; $dayName = 'الخامس'; $day_step = 4;}
    elseif($day === "day_6"){$background = "summer48_{$sheet}_1_6"; $dayName = 'السادس'; $day_step = 5;}
    elseif($day === "day_7"){$background = "summer48_{$sheet}_2_1"; $dayName = 'السابع'; $day_step = 6;}
    elseif($day === "day_8"){$background = "summer48_{$sheet}_2_2"; $dayName = 'الثامن'; $day_step = 7;}
    elseif($day === "day_9"){$background = "summer48_{$sheet}_2_3"; $dayName = 'التاسع'; $day_step = 8;}
    elseif($day === "day_10"){$background = "summer48_{$sheet}_2_4"; $dayName = 'العاشر'; $day_step = 9;}
    elseif($day === "day_11"){$background = "summer48_{$sheet}_2_5"; $dayName = 'الحادي عشر'; $day_step = 10;}
    elseif($day === "day_12"){$background = "summer48_{$sheet}_2_6"; $dayName = 'الثاني عشر'; $day_step = 11;}
    elseif($day === "day_13"){$background = "summer48_{$sheet}_3_1"; $dayName = 'الثالث عشر'; $day_step = 12;}
    elseif($day === "day_14"){$background = "summer48_{$sheet}_3_2"; $dayName = 'الرابع عشر'; $day_step = 13;}
    elseif($day === "day_15"){$background = "summer48_{$sheet}_3_3"; $dayName = 'الخامس عشر'; $day_step = 14;}
    elseif($day === "day_16"){$background = "summer48_{$sheet}_3_4"; $dayName = 'السادس عشر'; $day_step = 15;}
    elseif($day === "day_17"){$background = "summer48_{$sheet}_3_5"; $dayName = 'السابع عشر'; $day_step = 16;}
    elseif($day === "day_18"){$background = "summer48_{$sheet}_3_6"; $dayName = 'الثامن عشر'; $day_step = 17;}

    $mpdf->SetDefaultBodyCSS('background', "url('" . __DIR__ . "/../img/$background.jpg')");
    $mpdf->SetDefaultBodyCSS('background-repeat', 'no-repeat');
    $mpdf->SetDefaultBodyCSS('background-position', 'center center');

    ob_start();

    $step = 10;

    $start = 5;
    $end  = 10;

    $start_main = $start + ($step * $day_step);
    $end_main   = $end + ($step * $day_step);

    $ranges = [
        "$pageName!P$start_main:W$end_main",
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
   <title>النخبة | اليوم <?= $dayName; ?></title>

</head>
<body>

<section id='summer_day'>
  

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

    $mpdf->Output("النخبة - الدورة الصيفية ($dayName) $name_sheet.pdf", 'I');

} catch (\Mpdf\MpdfException $e) {
    echo 'خطأ في توليد التقرير: ' . $e->getMessage();
}
?>