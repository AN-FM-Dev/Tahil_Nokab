<?php

require __DIR__ . '/../api/google_sheets.php';

$spreadsheetId = $summation;

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
  'ranges' => [
      "report!G8"
  ]
]);

$valueRanges = $response->getValueRanges();

$cellValue = $valueRanges[0]->getValues();

if (!empty($cellValue)) {$G8 = $cellValue[0][0] ?? ''; $value_G8 = htmlspecialchars($G8);}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="../image/book_1.svg?v=<?= time() ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="../image/book_3.svg?v=<?= time() ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="../image/Alnokba_light.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: light)">
    <link rel="apple-touch-icon" href="../image/Alnokba_dark.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: dark)">
   <title>النخبة | التقرير الجامع</title>
</head>
<body>

<header>
    <img src="../image/logo_color.png?v=<?= time() ?>">
    <div div class="title">
        <h3>1448هـ</h3>
    </div>
</header>

<a href="../index.php" class="bi bi-arrow-right"></a>
 
<section id="level">

    <nav>
    <h2>التقرير الجامع</h2>

    <nav class="navbar">

        <div class="boxs">
            <h4 class="month_title">الشهر الأول</h4>

            <div <?php if($value_G8 == 1){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الأول</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($value_G8 == 2){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثاني</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G8 == 3){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثالث</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G8 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الرابع</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_G8 >= 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/report_full/level_1/report_month.php?view=month_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الثاني</h4>

            <div <?php if($value_G8 == 5){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الخامس</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_5" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($value_G8 == 6){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع السادس</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_6" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G8 == 7){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع السابع</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_7" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G8 == 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثامن</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_8" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_G8 >= 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/report_full/level_1/report_month.php?view=month_2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الثالث</h4>

            <div <?php if($value_G8 == 9){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع التاسع</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_9" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($value_G8 == 10){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع العاشر</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_10" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G8 == 11){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الحادي عشر</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_11" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G8 == 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثاني عشر</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_12" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_G8 >= 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/report_full/level_1/report_month.php?view=month_3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الرابع</h4>

            <div <?php if($value_G8 == 13){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثالث عشر</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_13" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($value_G8 == 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الرابع عشر</h4>
                <a href="../pdf/report_full/level_1/report_week.php?view=week_14" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <div <?php if($value_G8 >= 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/report_full/level_1/report_month.php?view=month_4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>
        </nav>
    </nav>

</section>

 <?php include '../src/footer_level.php'; ?>

</body>
</html>