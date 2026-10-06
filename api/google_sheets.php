<?php


require __DIR__ . '/../pdf/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets API PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS_READONLY]);
$client->setAuthConfig(__DIR__ . '/../credentials.json');
$service = new Google_Service_Sheets($client);

function getSheetData($service, $spreadsheetId, $ranges = []) {
    $response = $service->spreadsheets_values->batchGet($spreadsheetId, ['ranges' => $ranges]);
    $valueRanges = $response->getValueRanges();
    return $valueRanges;
}


$elmy_monitoring         = "SecretKey :)";
$ahadeth_monitoring      = "SecretKey :)";
$fekh_monitoring         = "SecretKey :)";
$summation_monitoring    = "SecretKey :)";
$summer48                = "SecretKey :)";
