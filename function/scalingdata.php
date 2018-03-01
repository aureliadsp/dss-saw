<?php

	$connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
      session_start();

    $sess_animalID = $_SESSION['m_animalIDsess'];
    $sess_chunkdata = $_SESSION['chunk_seldata'];

    //---------------------------------------------------------------------- selecting status & value process
    $sql_getlowtemp = mysqli_query($connect_db, "SELECT lower_temp FROM tb_animaldata WHERE animal_id ='$sess_animalID'");
		$fetch_lowtemp = mysqli_fetch_array($sql_getlowtemp);
		$get_lowtemp = $fetch_lowtemp['lower_temp'];
	$sql_getuptemp = mysqli_query($connect_db, "SELECT upper_temp FROM tb_animaldata WHERE animal_id ='$sess_animalID'");
		$fetch_uptemp = mysqli_fetch_array($sql_getuptemp);
		$get_uptemp = $fetch_uptemp['upper_temp'];
	
	array_unshift($sess_chunkdata, null); //transpose sess_chunkdata norm
	$arr_chunkdata = call_user_func_array('array_map', $sess_chunkdata);
	$arr_datatoslice = call_user_func_array('array_map', $sess_chunkdata);
	
	$temperature = $arr_chunkdata['5'];
	foreach ( $temperature as $tempvalue ) 
	{
		if ( $tempvalue > $get_uptemp ) 
		{
			$set_status = "High";
		}
		elseif ( $get_lowtemp > $tempvalue ) 
		{
			$set_status = "Low";		
		} 
		else
		{
			$set_status = "OK";
		}
		$tempstatus[] = $set_status;
	}

	$_SESSION['sess_tempstatus'] = $tempstatus;	
	//----------------------------------------------------------------------------- end of selecting status
    
    //-------------------------------------------------------get value from altitude, humidity, temperature
	$new_alt = array();
	$new_hum = array();
	$new_temp = array();

	$col_alt = $arr_chunkdata['3'];
	$col_hum = $arr_chunkdata['4'];
	$col_temp = $arr_chunkdata['5'];

	foreach( $col_alt as &$alt )						//altitude
	{
		if ( $alt > 2250 && $alt <= 3000 ) {
			$alt = 4;
		} elseif ( $alt > 1350 && $alt <= 2250 ) {
			$alt = 3;
		} elseif ( $alt > 600 && $alt <= 13350 ) {
			$alt = 2;
		} elseif ( $alt <= 600 ) {
			$alt = 1;
		} else {
			$alt = 0;
		}
		$new_alt[] = $alt;
	}

	foreach( $col_hum as $hum )						//humidity
	{
		if ( $hum >= 75 && $hum <= 100 ) {
			$hum = 4;
		} elseif ( $hum >= 50 && $hum <= 75 ) {
			$hum = 3;
		} elseif ( $hum >= 25 && $hum <= 50 ) {
			$hum = 2;
		} elseif ( $hum < 25 ) {
			$hum = 1;
		} else {
			$hum = 0;
		}
		$new_hum[] = $hum;
	}

	foreach ( $col_temp as $temp ) 				       //temperature
	{
		if ( $temp > 33 && $temp <= 38 ) {
			$temp = 4;
		} elseif ( $temp > 28 && $temp <= 33 ) {
			$temp = 3;
		} elseif ( $temp > 23 && $temp <= 28 ) {
			$temp = 2;
		} elseif ( $temp > 18 && $temp <= 23 ) {
			$temp = 1;
		} else {
			$temp = 0;
		}
		$new_temp[] = $temp;
	}
	//------------------------------------------end of get value of altitude, humidity, and temperature

	//------------------------------------------find quartile $ median
	$arr_dataslice = array_slice($arr_datatoslice, 6);
	$countslice = count($arr_dataslice);

	$slicesort = array();
	foreach ( $arr_dataslice as $col ) 
	{
    	array_multisort($col);
   		$slicesort[] = $col;
	}

	$arr_countsort = array();
	$arr_middlenum = array();

	for ( $i = 0; $i < $countslice; $i++ ) 
	{
		$arr_countsort = count($slicesort[$i]);
		$arr_middlenum = floor(($arr_countsort - 1) / 2);
		//quartile
		$q1_round = round( 0.25 *($arr_countsort + 1)) - 1;
		$q3_round = round( 0.75 *($arr_countsort + 1)) - 1;
		$quartile1[] = $slicesort[$i][$q1_round];
		$quartile3[] = $slicesort[$i][$q3_round];
		//median
		if ( $arr_countsort % 2 )
		{
			$median[] = $slicesort[$i][$arr_middlenum];
		} 
		else 
		{
			$low = $slicesort[$i][$arr_middlenum];
			$high = $slicesort[$i][$arr_middlenum + 1];
			$median[] = (($low +$high) / 2);
		}
	}
		
	for ( $i = 0; $i < $countslice; $i++ ) 
	{ 
		$c = count($arr_dataslice[$i]);
		$min = min($arr_dataslice[$i]);
		$max = max($arr_dataslice[$i]);

		foreach ( $arr_dataslice[$i] as $k ) 
		{
			if ($k <= $max && $k < $quartile3[$i]) {
				$cval = 4;
			} elseif ($k <= $quartile3[$i] && $k > $median[$i]) {
				$cval = 3;
			} elseif ($k <= $median[$i] && $k > $quartile1[$i]) {
				$cval = 2;
			} elseif ($k <= $quartile1[$i] && $k >= $min[$i]) {
				$cval = 1;
			} else {
				$cval = 0;
			}
			$new_cval[] = $cval;
		}
	}
	//------------------------------------------------------------GET value of water, fodder, mobility
	$water_value = array();
	$fodder_value = array();
	$mob_value = array();

	$water_value = $arr_chunkdata['0'];
	$fodder_value = $arr_chunkdata['1'];
	$mob_value = $arr_chunkdata['2'];
    //----------------------------------------------------------------------END OF GET VALUE

    //create new array with put all of criteria value
    $arr_C1merge = array_merge($water_value, $fodder_value, $mob_value, $new_alt, $new_hum, $new_temp, $new_cval); // combine all result
    $arr_chunkC1 = array_chunk($c1, $c);
    	
	$_SESSION['C1_matrix'] = $arr_chunkC1;
?>