<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<title>Update JSON</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="robots" content="noindex,nofollow">
<link rel="shortcut icon" href="#">
<head>

</head>

<body>

<?php
	/*
	* Use this page to update the json data.
	*/
	// Open csv file.
	$csv_file = fopen('media/data.csv', 'r');
	$csv_data = array();
	
	while (($row = fgetcsv($csv_file, 0, ",")) !== FALSE) {
		$csv_data[] = $row;
	}
	
	$json = json_encode($csv_data);
	echo '<pre>' . print_r($csv_data, true) . '</pre>';
	print_r($json);
	fclose($csv_file);
	
	// Update json file
	$json_file = fopen('media/healthbusters.json', 'w');
	fwrite($json_file, $json);
	fclose($json_file);
	
?>

</body>

</html>