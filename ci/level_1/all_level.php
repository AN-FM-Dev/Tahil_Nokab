<?php

require __DIR__ . '/../../../api/google_sheets.php';

$spreadsheetId = $sec_monitoring;
$ranges = [
    "report_v_1!B4:G15",
    "report_v_1!C2",
    "report_v_1!D2"
];

$valueRanges = getSheetData($service, $spreadsheetId, $ranges);

$blockValues = $valueRanges[0]->getValues();
$cellValue_1 = $valueRanges[1]->getValues();
$cellValue_2 = $valueRanges[2]->getValues();

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../style.css?v=<?= time() ?>">
    <title>نخب | المستوى الأول</title>
</head>
<body>

<section id="report_v">
    <div class="num">
        <?php if (!empty($cellValue_1)) { $J1 = $cellValue_1[0][0] ?? ''; ?>
        <span class="J1"><?= htmlspecialchars($J1); ?></span>
        <?php } ?>

        <?php if (!empty($cellValue_2)) { $K1 = $cellValue_2[0][0] ?? ''; ?>
        <span class="K1"><?= htmlspecialchars($K1); ?></span>
        <?php } ?>
    </div>

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
</section>


</body>
</html>
