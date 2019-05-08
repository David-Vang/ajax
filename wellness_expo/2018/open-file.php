<?php
	$response = $_REQUEST['response'];
	$question = $_REQUEST['question'];
	$file_name = 'media/ajax_info.csv';
	
	if ( $response ) {
		//echo $response;
		$output = $response . ',' . $question;
		$file = fopen($file_name, 'w');
		fwrite($file, $output);
		fclose($file);
	}
?>