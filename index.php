<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/pdf/vendor/autoload.php';

require_once __DIR__ . '/api/google_sheets.php';

$sheets = [
    'uni'       => ['id' => $uni_monitoring,  'range' => 'report!G3'],
    'sec'       => ['id' => $sec_monitoring,  'range' => 'report!G3'],
    'blog'      => ['id' => $blog_monitoring, 'range' => 'report!G3'],
    'zad'       => ['id' => $zad_monitoring,  'range' => 'report!G3'],
    'summation' => ['id' => $summation,       'range' => 'report!F8'],
];

$values = [];
foreach ($sheets as $key => $sheet) {
    $response    = $service->spreadsheets_values->batchGet($sheet['id'], ['ranges' => [$sheet['range']]]);
    $valueRanges = $response->getValueRanges();
    $cellValue   = $valueRanges[0]->getValues();
    $values[$key] = !empty($cellValue) ? htmlspecialchars($cellValue[0][0] ?? '') : '';
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="image/feather_5.svg?v=<?= time() ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="image/feather_1.svg?v=<?= time() ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="image/Tahil_light.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: light)">
    <link rel="apple-touch-icon" href="image/Tahil_dark.png?v=<?= time() ?>" sizes="180x180" media="(prefers-color-scheme: dark)">
   <title>نخب | الصفحة الرئيسية</title>
</head>
<body>

<!--header>
    <div class="title">
        <h3>رصد المتون</h3>
        <h5>1447هـ</h5>
    </div>
</header-->


<div id="header">
    <img src="image/logo_white.svg?v=<?= time() ?>">
</div>

<section id="index">

    <nav>
        <div class="boxs">
            <div class="box box_1">
                <button onclick="openList(1)" id="link_box_1">رصد المتون (جامعي)</button>
                <div class="list" id="list_1">
                    <a href="monitoring_uni/level_1.php" <?php if($values['uni'] == 1){?> class="active" <?php } ?>>المستوى الأول</a>
                    <a href="monitoring_uni/level_2.php" <?php if($values['uni'] == 2){?> class="active" <?php } ?>>المستوى الثاني</a>
                </div>
            </div>

            <div class="box box_2">
                <button onclick="openList(2)" id="link_box_2">رصد المتون (الثانوي)</button>
                <div class="list" id="list_2">
                    <a href="monitoring_sec/level_1.php" <?php if($values['sec'] == 1){?> class="active" <?php } ?>>المستوى الأول</a>
                    <a href="monitoring_sec/level_2.php" <?php if($values['sec'] == 2){?> class="active" <?php } ?>>المستوى الثاني</a>
                </div>
            </div>

            <div class="box box_3">
                <button onclick="openList(3)" id="link_box_3">رصد البلوغ</button>
                <div class="list" id="list_3">
                    <a href="monitoring_blog/level_1.php" <?php if($values['blog'] == 1){?> class="active" <?php } ?>>المستوى الأول</a>
                    <a href="monitoring_blog/level_2.php" <?php if($values['blog'] == 2){?> class="active" <?php } ?>>المستوى الثاني</a>
                </div>
            </div>

            <div class="box box_4">
                <button onclick="openList(4)" id="link_box_4">رصد الزاد</button>
                <div class="list" id="list_4">
                    <a href="monitoring_zad/level_1.php" <?php if($values['zad'] == 1){?> class="active" <?php } ?>>المستوى الأول</a>
                    <a href="monitoring_zad/level_2.php" <?php if($values['zad'] == 2){?> class="active" <?php } ?>>المستوى الثاني</a>
                </div>
            </div>

            <div class="box box_5">
                <button onclick="openList(5)" id="link_box_5">التقرير الجامع</button>
                <div class="list" id="list_5">
                    <a href="m_summation/level_1.php" <?php if($values['summation'] == 1){?> class="active" <?php } ?>>المستوى الأول</a>
                    <a href="m_summation/level_2.php" <?php if($values['summation'] == 2){?> class="active" <?php } ?>>المستوى الثاني</a>
                </div>
            </div>

            <div class="box box_6">
                <button onclick="openList(6)" id="link_box_6">الدورة الصيفية 48</button>
                <div class="list" id="list_6">
                    <a href="m_summer48/view.php?track=uni">الجامعي</a>
                    <a href="m_summer48/view.php?track=sec">الثانوي</a>
                    <a href="m_summer48/view.php?track=blog">البلوغ</a>
                    <a href="m_summer48/view.php?track=zad">الزاد</a>
                </div>
            </div>

            <!--div class="box_link">
                <a href="pdf/report_full/report_all.php?view=full_1" target="_blank">التقرير الجامع</a>
            </div-->

        </div>
    </nav>

</section>

<script>
    function openList(activeIndex) {
        for (let i = 1; i <= 6; i++) {
            const list = document.getElementById(`list_${i}`);
            const box = document.getElementById(`link_box_${i}`);
            const isActive = i === activeIndex;

            list.style.display = isActive ? "flex" : "none";
            list.classList.add("style");

            box.style.height = isActive ? "4rem" : "5rem";
            box.style.background = isActive ? "#16473a40" : "#f5f5f5";
            box.classList.add("style");
        }
    }
</script>


<?php include 'src/footer.php'; ?>

</body>
</html>