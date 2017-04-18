<?php
$today    = [];
$tomorrow = [];
$note     = [];
$removed  = [];

$result_set = $mysqli->query('SELECT * FROM `note`');
while ($row = $result_set->fetch_assoc()) {
	if($row['tab'] == 'today')        array_push($today,    $row);
	elseif($row['tab'] == 'tomorrow') array_push($tomorrow, $row);
	elseif($row['tab'] == 'note') 	  array_push($note,     $row);
	elseif($row['tab'] == 'removed')  array_push($removed,  $row);
}
