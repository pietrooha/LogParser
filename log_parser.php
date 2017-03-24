<?php

require('Log.php');

$txt_file = fopen("log.txt", "r") or die("Unable to open file!");
$line = array();
while(!feof($txt_file))
{
	array_push($line, fgets($txt_file));
}
fclose($txt_file);

$number_of_line = sizeof($line);
for($i = 0; $i < $number_of_line; $i++)
{
	$log_parts[$i] = explode(" ", $line[$i]);
	$content[$i] = '';
}
for($i = 0; $i < $number_of_line; $i++)
{
	$date_time[$i] = $log_parts[$i][0] . ' ' . $log_parts[$i][1];
	$type[$i] = $log_parts[$i][2];

	$number_of_log_parts = sizeof($log_parts[$i]);
	for ($j=3; $j < $number_of_log_parts; $j++)
	{ 
		$content[$i] .= $log_parts[$i][$j] . ' ';
		$content[$i] = str_replace("\n", "", $content[$i]);
	}
}

$json_file = fopen("log.json", "w") or die("Unable to open file!");
for($i = 0; $i < $number_of_line; $i++)
{
	$log[$i] = new Log($date_time[$i], $type[$i], $content[$i]);
	$json[$i] = json_encode($log[$i],  JSON_UNESCAPED_UNICODE | JSON_ERROR_UTF8 | JSON_PRETTY_PRINT);
	//printf("<pre>%s</pre>", $json[$i]);
	$json[$i] = $json[$i] . ", \n";
	fwrite($json_file, $json[$i]);
}
fclose($json_file);

?>