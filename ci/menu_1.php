<?php

require __DIR__ . '/../api/google_sheets.php';

$spreadsheetId = $uni_monitoring;

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
  'ranges' => [
      "report!G4"
  ]
]);

$valueRanges = $response->getValueRanges();

$cellValue = $valueRanges[0]->getValues();

if (!empty($cellValue)) {$G4 = $cellValue[0][0] ?? ''; $value_G4 = htmlspecialchars($G4);}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="../image/feather_5.svg?v=<?= time() ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="../image/logo_white.svg?v=<?= time() ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="../image/Tahil_light.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: light)">
    <link rel="apple-touch-icon" href="../image/Tahil_dark.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: dark)">
   <title>نخب | جامعي - الفصل الأول</title>
</head>
<body>

<header>
    <img src="../image/logo_white.svg?v=<?= time() ?>">
    <div div class="title">
        <h3>رصد المتون (جامعي)</h3>
        <h5>الفصل الأول</h5>
    </div>
</header>

<a href="../index.php" class="bi bi-arrow-right"></a>
 
<section id="menu">

    <nav>
        <h2>التقرير الفصل الأول</h2>

        <div class="boxs">
            <div <?php if($value_G4 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
            <a href="level_1.php?view=month_1">الشهر الأول</a></div>

            <div <?php if($value_G4 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
            <a href="level_1.php?view=month_2">الشهر الثاني</a></div>

            <div <?php if($value_G4 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
            <a href="level_1.php?view=month_3">الشهر الثالث</a></div>

            <div <?php if($value_G4 == 4){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
            <a href="level_1.php?view=month_4">الشهر الرابع</a></div>

            <div <?php if($value_G4 == 7){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>التقرير النهائي</h4>
                <a href="../pdf/monitoring_uni/report_level.php?view=level_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
            <div <?php if($value_G4 == 7){?> class="now_value" <?php }else{ ?> class="box" <?php } ?>>
                <h4>التقرير التفصيلي</h4>
                <a href="../pdf/monitoring_uni/report_students.php?view=level_1" target="_blank"><i class="bi bi-filetype-pdf"></i> <span>عرض</span></a>
            </div>
        </div>
    </nav>

</section>

 <?php include '../src/footer_level.php'; ?>

</body>
</html>