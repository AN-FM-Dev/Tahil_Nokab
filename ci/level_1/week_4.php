<?php

require __DIR__ . '/../../../api/google_sheets.php';

$spreadsheetId = $sec_monitoring;

$pageName = "level_1_4";

$ranges = [
    "$pageName!A4:Q15",
    "$pageName!J1",
    "$pageName!K1"
];


$response = $service->spreadsheets_values->batchGet($spreadsheetId, [
  'ranges' => $ranges
]);

$valueRanges = $response->getValueRanges();

$blockValues = $valueRanges[0]->getValues();
$cellValue_1 = $valueRanges[1]->getValues();
$cellValue_2 = $valueRanges[2]->getValues();


?>

<?php include 'weeks.php'; ?>