<?php

require __DIR__ . '/../../../api/google_sheets.php';

$spreadsheetId = $sec_monitoring;

$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
  'ranges' => [
      "level_3_2_month!B4:D15",
      "level_3_2_month!C2"
  ]
]);

$valueRanges = $response->getValueRanges();

$blockValues = $valueRanges[0]->getValues();
$cellValue_1 = $valueRanges[1]->getValues();

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../../style.css?v=<?= time() ?>">
   <title>نخب | الشهر الثاني</title>
</head>
<body>

<section id="month">

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

<?php if (!empty($cellValue_1)) { $C2 = $cellValue_1[0][0] ?? ''; ?>
  <div class="C2"><?= htmlspecialchars($C2); ?></div>
<?php } ?>

   </section>

</body>
</html>
