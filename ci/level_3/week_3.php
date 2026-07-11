<?php

require __DIR__ . '/../../../api/google_sheets.php';

$spreadsheetId = $sec_monitoring;

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
  'ranges' => [
      "level_3_3!A4:Q15",
      "level_3_3!J1",
      "level_3_3!K1"
  ]
]);

$valueRanges = $response->getValueRanges();

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
   <title>نخب | الأسبوع الثالث</title>

</head>
<body>

<section id="week">

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

<?php if (!empty($cellValue_2)) { $K1 = $cellValue_2[0][0] ?? ''; ?>
  <div class="K1"><?= htmlspecialchars($K1); ?></div>
<?php } ?>

<?php if (!empty($cellValue_1)) { $J1 = $cellValue_1[0][0] ?? ''; ?>
  <div class="J1"><?= htmlspecialchars($J1); ?></div>
<?php } ?>

   </section>

</body>
</html>
