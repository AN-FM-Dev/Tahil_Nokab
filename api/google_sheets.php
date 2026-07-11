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


$uni_monitoring   = "1VleDcwswQK926D8uuDDmvGzfdePrrURctdGMy3h_TBM";
$sec_monitoring   = "1VqmAjN1Z4I40heotP1FrnkxaLh_THljkg9KoDZG5ttQ";
$blog_monitoring  = "17aCK38JD1qgk89pV7j1rU-wfjlI8sb1uR8vPVyxb30A";
$zad_monitoring   = "1fycZASJwDhLzYd0bJ3PynxK6gTdByyd8k-ZuZ-2uWR0";
$summation        = "1qx_pc6W9i-H4Sj78bkL1u-hbl4KW2Dkus_J6v2_Lkpk";
$summer48         = "1pgzmF5k8w9RI2CsH5yeXOwRDGPOPrNyYuJy_6LZoBdc";