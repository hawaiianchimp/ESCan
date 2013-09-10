<?php

require_once 'inc/standard.php';
$DB = new DB();

foreach ($_GET as $key => $value) {
	//echo '$user[\''.$key.'\'] = '.$value.';<br>';
	$scan[$key] = trim(strip_tags($value));
}

if($scan['eid'])
{
    $sql = 'SELECT scans.*, users.name, users.ucinetid, users.major, users.level
		FROM scans LEFT JOIN users
		ON scans.barcode = users.barcode
		WHERE scans.eid = "'.$scan['eid'].'"
		ORDER BY date DESC, time DESC' ;
	$DB->query($sql);
    $output['scans'] = $DB->resultToArray();
}
else
{
   $output['message']['text'] = "No Event Id Provided";
   $output['message']['status'] = "error";
}

echo json_encode($output);
?>