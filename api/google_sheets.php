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


$elmy_monitoring      = "1ltaWC3ZI_14gDxwx1UPg3p2_FQ7b4VLd9WCC_MM7LUE";
$ahadeth_monitoring   = "1If4k26sDM5IGuRgU1Qb1eQ2Z48oNp05lfsMYvlQMWXk";
$fekh_monitoring      = "1-UZezOS6w7JADPsXT0NCoksBOdj6Fz410FC_Fs6U5Sw";
$summation            = "";
$summer48             = "";


//echo 'elmy';
//echo 'ahadeth';
//echo 'fekh';