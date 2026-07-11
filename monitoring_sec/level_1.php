<?php

require __DIR__ . '/../api/google_sheets.php';

$spreadsheetId = $sec_monitoring;

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
    'ranges' => [
        "report!G4",
        "report!I3:I6",
        "report!J3:J6"
    ]
  ]);
  
  $valueRanges = $response->getValueRanges();
  
  $G4_value = $valueRanges[0]->getValues();
  $I_values = $valueRanges[1]->getValues();
  $J_values = $valueRanges[2]->getValues();
  
  $G4 = htmlspecialchars($G4_value[0][0] ?? '');

  $I3 = htmlspecialchars($I_values[0][0] ?? '');
  $I4 = htmlspecialchars($I_values[1][0] ?? '');
  $I5 = htmlspecialchars($I_values[2][0] ?? '');
  $I6 = htmlspecialchars($I_values[3][0] ?? '');
  
  $J3 = htmlspecialchars($J_values[0][0] ?? '');
  $J4 = htmlspecialchars($J_values[1][0] ?? '');
  $J5 = htmlspecialchars($J_values[2][0] ?? '');
  $J6 = htmlspecialchars($J_values[3][0] ?? '');

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
   <title>نخب | الثانوي</title>
</head>
<body>

<header>
    <img src="../image/logo_white.svg?v=<?= time() ?>">
    <div div class="title">
        <h3>رصد المتون (الثانوي)</h3>
    </div>
</header>

<a href="../index.php" class="bi bi-arrow-right"></a>
 
<section id="level">

    <nav>
    <h2>التقرير الثانوي</h2>

        <nav class="navbar">

        <div class="boxs">
            <h4 class="month_title">الشهر الأول</h4>

            <div <?php if($G4 == 1){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الأول</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 2){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثاني</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 3){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثالث</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الرابع</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I3 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_h_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J3 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_t_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_month.php?view=month_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الثاني</h4>

            <div <?php if($G4 == 5){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الخامس</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_5" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 6){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع السادس</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_6" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 7){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع السابع</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_7" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثامن</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_8" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I4 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_h_2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J4 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_t_2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_month.php?view=month_2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الثالث</h4>

            <div <?php if($G4 == 9){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع التاسع</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_9" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 10){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع العاشر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_10" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 11){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الحادي عشر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_11" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثاني عشر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_12" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I5 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_h_3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J5 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_t_3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_month.php?view=month_3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الرابع</h4>

            <div <?php if($G4 == 13){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثالث عشر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_13" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الرابع عشر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_week.php?view=week_14" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I6 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_h_4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J6 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="../pdf/monitoring_sec/level_1/report_test.php?view=test_t_4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="../pdf/monitoring_sec/level_1/report_month.php?view=month_4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>
        </nav>
    </nav>

</section>

 <?php include '../src/footer_level.php'; ?>

</body>
</html>