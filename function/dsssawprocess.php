<?php
	$connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
      session_start();
	//-----------------------------------------------------------------------NORMALIZATION PROCESS
	//select max
	$C1matrix = $_SESSION['C1_matrix'];
	$sqlcrit = mysqli_query($connect_db, "SELECT type FROM tb_criteria");
	while ($resultcrit = mysqli_fetch_array($sqlcrit)) {
		$crite[] = $resultcrit['type'];
	}
	$m_locnewID = $_SESSION['m_locnewID'];
	$cc1 = count($_SESSION['m_locnewID']);
	$cc2 = count($crite);

	for ($i=0; $i < $cc2; $i++) { 
		for ($j=0; $j < $cc1; $j++) { 

			$max = max($C1matrix[$i]);
			$min = min($C1matrix[$i]);

			if ($crite[$i] = 1) {
				$c1val[] = $C1matrix[$i][$j] / $max;
			} else {
				$c1val[] = $min / $C1matrix[$i][$j];
			}
		}
	}

	$c1norm = array_chunk($c1val, $cc1); //chunk array by 6 row each column

	array_unshift($c1norm, null); //transpose c1 norm
		$newc1norm = call_user_func_array('array_map', $c1norm);
	//----------------------------------------------------------------------------------END OF NORMALIZATION PROCESS

	//----------------------------------------------------------------------------------WEIGHTING PROCESS
	//select weight from criteria table
	$weight = $_SESSION['m_weightsess'];

	$yaxis1 = sizeof($newc1norm); //get size of y axis
	$xaxis1 = max(array_map('count', $newc1norm)); // get size of x axis

	for($i = 0; $i < $xaxis1; $i++) {
		for($j = 0; $j < $yaxis1; $j++) {
			$c1weight[] = $newc1norm[$j][$i] * $weight[$i];
		}
	}

	$c1weight1 = array_chunk($c1weight, $cc1); //chunk for transpose

	array_unshift($c1weight1, null); //transpose c1 weight result
		$newc1weight = call_user_func_array('array_map', $c1weight1);
	
	//sum each row of alternative
	for($i = 0; $i < sizeof($newc1weight); $i++) {
    	$sumresult[] = round(array_sum($newc1weight[$i]),2);
	}
	//--------------------------------------------------------------------------END OF WEIGHTING PROCESS

	//--------------------------------------------------------------------------INSERT RESULT INTO DB TEMPORARY

	/*$sql9 = mysqli_query("SELECT * FROM tempselect");
	$alternatifID = array();
	$locname = array();
	$locdis = array();
	$longitude = array();
	$latitude = array();
	while ($alternatif = mysql_fetch_array($sql9)) {
		$alternatifID[] = $alternatif['loc_id'];
		$locname[] = $alternatif['loc_name'];
		$locdis[] = $alternatif['loc_district'];
		$longitude[] = $alternatif['longitude'];
		$latitude[] = $alternatif['latitude'];
	}
	$criteriastat = $_SESSION['statustemp'];
	foreach ($alternatifID as $num) {
		$cate1[] = 2;
	}

	// urutan : ID, status, C1, C2, C3, C4, C5, C6, result
	$finalmerge = array_merge($alternatifID, $locname, $locdis, $cate1, $longitude, $latitude, $criteriastat, $sumresult, $c1weight);
	$final1 = array_chunk($finalmerge, $cc1);
	$cc3 = count($final1);
	//tranpose final1
	array_unshift($final1, null);
		$FINALRESULT = call_user_func_array('array_map', $final1);


	//inserting
	if(is_array($FINALRESULT)) {

		$queryi = "INSERT INTO tempresult VALUES ";

		foreach($FINALRESULT as $key) {
		    $row_values = [];
		    foreach($key as $s_key => $s_value) {
		        $row_values[] = '"'.$s_value.'"';
		    }
		    $all_values[] = '('.implode(',', $row_values).')';
		}


		//Implode all rows
		$queryi .= implode(',', $all_values);
		$mysqladd = mysql_query($queryi);
    }
	//--------------------------------------------------------------------------END OF INSERT RESULT

	//-------------------------------------------------------------------------Select category
	$sql13 = mysql_query("UPDATE tempresult SET categoryid = 1 WHERE categoryid = 2 ORDER BY sum DESC LIMIT 3");*/
	echo $cc1; echo $cc2;
	echo '<pre>'; echo 'c1norm '; print_r($c1norm); echo '</pre>';
    echo '<pre>'; echo 'fodder_value '; print_r($fodder_value); echo '</pre>';
    
    
?>