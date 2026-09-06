<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/api/google_sheets.php';

$track = $_GET['track'] ?? '';

$spreadsheetId = ${$track . '_monitoring'};

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


    switch ($track) {
      case 'elmy':
          $view_sheet = "!G3";
          $name_sheet = "المتون العلمية";
          $pageName = "{$track}_week";
          break;

  
      case 'ahadeth':
          $view_sheet = "!G5";
          $name_sheet = "السنة النبوية";
          $pageName = "{$track}_week";
          break;
  
      case 'fekh':
          $view_sheet = "!G6";
          $name_sheet = "الفقه";
          $pageName = "{$track}_week";
          break;
  
      default:
          die('Track not found');
  }

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="image/book_1.svg?v=<?= time() ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="image/book_3.png?v=<?= time() ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="image/Alnokba_light.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: light)">
    <link rel="apple-touch-icon" href="image/Alnokba_dark.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: dark)">

    <script>
        const currentLevel = <?= (int)$G4 ?>;
    </script>


   <title>النخبة | <?= $name_sheet; ?></title>
</head>
<body>

<header>
    <img src="image/logo_color.png?v=<?= time() ?>">
    <div div class="title">
        <h3>رصد <?= $name_sheet; ?></h3>
    </div>
</header>

<a href="index.php" class="bi bi-arrow-right"></a>
 
<section id="level">

    <nav>
    <h2>تقرير المستوى الأول</h2>

        <nav class="navbar">

        <div class="boxs">
            <h4 class="month_title">الشهر الأول</h4>

            <div <?php if($G4 == 1){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الأول</h4>
                <a href="pdf/level_1/report_week.php?view=week_1&track=<?= $track; ?>"  data-level="1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 2){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثاني</h4>
                <a href="pdf/level_1/report_week.php?view=week_2&track=<?= $track; ?>"  data-level="2" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 3){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثالث</h4>
                <a href="pdf/level_1/report_week.php?view=week_3&track=<?= $track; ?>"  data-level="3" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الرابع</h4>
                <a href="pdf/level_1/report_week.php?view=week_4&track=<?= $track; ?>"  data-level="4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I3 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="pdf/level_1/report_test.php?view=test_h_1&track=<?= $track; ?>"  data-level="4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J3 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="pdf/level_1/report_test.php?view=test_t_1&track=<?= $track; ?>"  data-level="4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="pdf/level_1/report_month.php?view=month_1&track=<?= $track; ?>"  data-level="4" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الثاني</h4>

            <div <?php if($G4 == 5){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الخامس</h4>
                <a href="pdf/level_1/report_week.php?view=week_5&track=<?= $track; ?>"  data-level="5" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 6){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع السادس</h4>
                <a href="pdf/level_1/report_week.php?view=week_6&track=<?= $track; ?>"  data-level="6" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 7){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع السابع</h4>
                <a href="pdf/level_1/report_week.php?view=week_7&track=<?= $track; ?>"  data-level="7" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثامن</h4>
                <a href="pdf/level_1/report_week.php?view=week_8&track=<?= $track; ?>"  data-level="8" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I4 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="pdf/level_1/report_test.php?view=test_h_2&track=<?= $track; ?>"  data-level="8" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J4 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="pdf/level_1/report_test.php?view=test_t_2&track=<?= $track; ?>"  data-level="8" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 8){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="pdf/level_1/report_month.php?view=month_2&track=<?= $track; ?>"  data-level="8" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الثالث</h4>

            <div <?php if($G4 == 9){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع التاسع</h4>
                <a href="pdf/level_1/report_week.php?view=week_9&track=<?= $track; ?>"  data-level="9" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 10){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع العاشر</h4>
                <a href="pdf/level_1/report_week.php?view=week_10&track=<?= $track; ?>"  data-level="10" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 11){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الحادي عشر</h4>
                <a href="pdf/level_1/report_week.php?view=week_11&track=<?= $track; ?>"  data-level="11" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($G4 == 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثاني عشر</h4>
                <a href="pdf/level_1/report_week.php?view=week_12&track=<?= $track; ?>"  data-level="12" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I5 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="pdf/level_1/report_test.php?view=test_h_3&track=<?= $track; ?>"  data-level="12" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J5 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="pdf/level_1/report_test.php?view=test_t_3&track=<?= $track; ?>"  data-level="12" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 12){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="pdf/level_1/report_month.php?view=month_3&track=<?= $track; ?>"  data-level="12" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>

        <div class="boxs">
            <h4 class="month_title">الشهر الرابع</h4>

            <div <?php if($G4 == 13){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الثالث عشر</h4>
                <a href="pdf/level_1/report_week.php?view=week_13&track=<?= $track; ?>"  data-level="13" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a> <!-- target="_blank" -->
            </div>
            <div <?php if($G4 == 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>الأسبوع الرابع عشر</h4>
                <a href="pdf/level_1/report_week.php?view=week_14&track=<?= $track; ?>"  data-level="14" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>

            <?php if($I6 == 1){?>
            <div class="box test_box">
                <h4>اختبار الحفظ</h4>
                <a href="pdf/level_1/report_test.php?view=test_h_4&track=<?= $track; ?>"  data-level="14" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>
            
            <?php if($J6 == 1){?>
            <div class="box test_box">
                <h4>اختبار الفهم</h4>
                <a href="pdf/level_1/report_test.php?view=test_t_4&track=<?= $track; ?>"  data-level="14" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <?php } ?>

            <div <?php if($G4 >= 14){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>تقرير الشهر</h4>
                <a href="pdf/level_1/report_month.php?view=month_4&track=<?= $track; ?>"  data-level="14" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>
        </nav>
    </nav>

</section>

<script>
    document.querySelectorAll('a[data-level]').forEach(link => {
    const level = Number(link.dataset.level);

    if (level > currentLevel) {
        link.removeAttribute('href');

        link.addEventListener('click', function (e) {
            e.preventDefault();
        });

        link.style.cursor = 'not-allowed';
    }
});
</script>

 <?php include 'src/footer_level.php'; ?>

</body>
</html>