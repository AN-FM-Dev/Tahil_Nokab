<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/pdf/vendor/autoload.php';

require_once __DIR__ . '/api/google_sheets.php';

$sheets = [
    'elmy'   => ['id' => $elmy_monitoring,  'range' => 'report!G3']
];

$values = [];
foreach ($sheets as $key => $sheet) {
    $response    = $service->spreadsheets_values->batchGet($sheet['id'], ['ranges' => [$sheet['range']]]);
    $valueRanges = $response->getValueRanges();
    $cellValue   = $valueRanges[0]->getValues();
    $values[$key] = !empty($cellValue) ? htmlspecialchars($cellValue[0][0] ?? '') : '';
}

$progress_elmy = 89;
$progress_ahadeth = 45;
$progress_fekh = 79;

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="image/book_1.svg?v=<?= time() ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="image/book_3.svg?v=<?= time() ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="image/Alnokba_light.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: light)">
    <link rel="apple-touch-icon" href="image/Alnokba_dark.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: dark)">
   <title>النخبة | الصفحة الرئيسية</title>
</head>
<body>


<h5 class="title_date">1448هـ</h5>


<div id="header">
    <img src="image/logo_color.png?v=<?= time() ?>">
</div>

<div class="line">
    <hr>
</div>

<section id="index">

    <nav>
        <div class="boxs">
            <a href="level_1.php?track=elmy" class="box box_1">
                <h4><div></div> المتون العلمية</h4>
                <div class="title">
                    <p>نسبة الإنجاز</p>
                    <span><?= $progress_elmy; ?>%</span>
                </div>
                <div class="bar" style="--progress: <?= $progress_elmy; ?>%;"></div>
            </a>
            <a href="level_1.php?track=ahadeth" class="box box_2">
                <h4><div></div> الأحاديث النبوية</h4>
                <div class="title">
                    <p>نسبة الإنجاز</p>
                    <span><?= $progress_ahadeth; ?>%</span>
                </div>
                <div class="bar" style="--progress: <?= $progress_ahadeth; ?>%;"></div>
            </a>
            <a href="level_1.php?track=fekh" class="box box_3">
                <h4><div></div> الفقه</h4>
                <div class="title">
                    <p>نسبة الإنجاز</p>
                    <span><?= $progress_fekh; ?>%</span>
                </div>
                <div class="bar" style="--progress: <?= $progress_fekh; ?>%;"></div>
            </a>

            <!--div class="box box_6">
                <button onclick="openList(6)" id="link_box_6">الدورة الصيفية 48</button>
                <div class="list" id="list_6">
                    <a href="m_summer48/view.php?track=elmy">مستوي المتون العلمية</a>
                    <a href="m_summer48/view.php?track=ahadeth">مستوى السنة النبوية</a>
                    <a href="m_summer48/view.php?track=fekh">مستوى الفقه</a>
                </div>
            </div-->

            <!--div class="box_link">
                <a href="pdf/report_full/report_all.php?view=full_1" target="_blank">التقرير الجامع</a>
            </div-->

        </div>
    </nav>

</section>


<?php include 'src/footer.php'; ?>

</body>
</html>