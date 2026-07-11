<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require __DIR__ . '/../api/google_sheets.php';

$spreadsheetId = $summer48;

$track = $_GET['track'] ?? '';

switch ($track) {
    case 'uni':
        $view_sheet = "!J3";
        $name_sheet = "الجامعي";
        break;

    case 'sec':
        $view_sheet = "!J4";
        $name_sheet = "الثانوي";
        break;

    case 'blog':
        $view_sheet = "!J5";
        $name_sheet = "البلوغ";
        break;

    case 'zad':
        $view_sheet = "!J6";
        $name_sheet = "الزاد";
        break;

    default:
        die('Track not found');
}

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => [
        "report$view_sheet",
    ]
  ]);
  
  $valueRanges = $response->getValueRanges();
  
  $cellValue = $valueRanges[0]->getValues();
  
  if (!empty($cellValue)) {$J_num = $cellValue[0][0] ?? ''; $value_J_num = htmlspecialchars($J_num);}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="../image/feather_5.svg?v=<?= time() ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="../image/feather_1.svg?v=<?= time() ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="../image/Tahil_light.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: light)">
    <link rel="apple-touch-icon" href="../image/Tahil_dark.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: dark)">
   <title>نخب | الدورة الصيفية 1448</title>
</head>
<body>

<header>
    <img src="../image/logo_white.svg?v=<?= time() ?>">
    <div div class="title">
        <h3><?= $name_sheet; ?></h3>
    </div>
</header>

<a href="../index.php" class="bi bi-arrow-right"></a>
 
<section id="level">

    <nav>
    <h2>الدورة الصيفية</h2>


    <nav class="navbar">

        <div class="boxs">
            <h4 class="week_title">الأسبوع الأول</h4>

            <div <?php if($value_J_num == 1){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الأول</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_1&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-&sheet=<?= $track ?>- target="_blank" -->
            </div>
            <div <?php if($value_J_num == 2){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الثاني</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_2&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 3){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الثالث</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_3&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الرابع</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_4&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_J_num == 5){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الخامس</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_5&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-&sheet=<?= $track ?>- target="_blank" -->
            </div>
            <div <?php if($value_J_num == 6){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم السادس</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_6&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_J_num >= 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الأسبوع</h4>
                <a href="../pdf/m_summer48/report_week.php?view=week_1&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="week_title">الأسبوع الثاني</h4>

            <div <?php if($value_J_num == 7){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم السابع</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_7&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الثامن</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_8&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 9){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم التاسع</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_9&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-&sheet=<?= $track ?>- target="_blank" -->
            </div>
            <div <?php if($value_J_num == 10){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم العاشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_10&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 11){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الحادي عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_11&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الثاني عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_12&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_J_num >= 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الأسبوع</h4>
                <a href="../pdf/m_summer48/report_week.php?view=week_2&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="week_title">الأسبوع الثالث</h4>

            <div <?php if($value_J_num == 13){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الثالث عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_13&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-&sheet=<?= $track ?>- target="_blank" -->
            </div>
            <div <?php if($value_J_num == 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الرابع عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_14&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 13){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الخامس عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_13&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-&sheet=<?= $track ?>- target="_blank" -->
            </div>
            <div <?php if($value_J_num == 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم السادس عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_14&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_J_num == 13){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم السابع عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_13&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-&sheet=<?= $track ?>- target="_blank" -->
            </div>
            <div <?php if($value_J_num == 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>اليوم الثامن عشر</h4>
                <a href="../pdf/m_summer48/report_day.php?view=day_14&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_J_num >= 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الأسبوع</h4>
                <a href="../pdf/m_summer48/report_week.php?view=week_3&sheet=<?= $track ?>" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        </nav>
    </nav>

</section>

 <?php include '../src/footer_level.php'; ?>

</body>
</html>