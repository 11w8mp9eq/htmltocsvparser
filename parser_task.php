 <?php

/**
*
* Read data from HTML.
*
*/

$html = file_get_contents('wo_for_parse.html');

$dom = new DOMDocument();
@ $dom->loadHTML($html);

$wo_number = $dom->getElementById('wo_number')->nodeValue;
$po_number = $dom->getElementById('po_number')->nodeValue;
$scheduled_date = $dom->getElementById('scheduled_date')->nodeValue;
$location_customer = $dom->getElementById('location_customer')->nodeValue;
$trade = $dom->getElementById('trade')->nodeValue;
$nte = $dom->getElementById('nte')->nodeValue;
$location_name = $dom->getElementById('location_name')->nodeValue;
$location_address = $dom->getElementById('location_address')->nodeValue;
$location_phone = $dom->getElementById('location_phone')->nodeValue;

/**
*
* Format the data to the desired form
*
*/


// Format date.
$scheduleSplit = explode(" ",$scheduled_date);
$newDate = $scheduleSplit[50]." ".$scheduleSplit[48]." ".$scheduleSplit[49]." ".$scheduleSplit[51]." ".$scheduleSplit[52];


// Format NTE.
$floatNte1 = str_replace(",","",$nte);
$floatNte2 = str_replace("$","",$floatNte1);
$floatNte = floatval($floatNte2);

// Format adress.
$locationAddressSplit = explode(" ",$location_address);
$street = $locationAddressSplit[124] ." ". $locationAddressSplit[125]." ". $locationAddressSplit[126];
$city = $locationAddressSplit[190];
$state = $locationAddressSplit[191];
$zipCode = $locationAddressSplit[193];

// Format phone number.
$intPhone1 = str_replace("-","", $location_phone);
$intPhone = intval($intPhone1);


/**
*
* Save data to CSV.
*
*/

$file = fopen("data.csv","w");

fputcsv($file, array($wo_number, $po_number, $newDate, $location_customer, $trade, $floatNte, $location_name, $street, $city, $state, $zipCode, $intPhone));

fclose($file);
