<?php
if(empty($_SESSION))
{
  session_start();
}
if(!isset($_SESSION['email']))
{
  header("Location: login.php");
  exit;
}

    // USE WHEN LIVE
    //$connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
    //mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.

    // USE WHEN BETA
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    
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
			$c1weight[] = round(($newc1norm[$j][$i] * $weight[$i]),3);
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

	//-------------------------------------------------------------------------- GET DATA TO PUT INTO ONE
	$m_locID = $_SESSION['m_locnewID']; // Get location
	$querylocget = mysqli_query($connect_db, "SELECT l.loc_id, l.loc_name, l.loc_district, 
                      l.loc_longitude, l.loc_latitude
                      FROM tb_locationdata l
                      WHERE l.loc_id IN ('" . implode("','",$m_locID) . "')" );
	while($rowloc= mysqli_fetch_row($querylocget)) 
    {
    	$dataget[] = $rowloc;
    }

   	for($i = 0; $i < count($m_locID); $i++)
    {
		$toSet_locID[] = $dataget[$i]['0'];
    	$toSet_locName[] = $dataget[$i]['1'];
    	$toSet_locDis[] = $dataget[$i]['2'];
    	$toSet_locLongi[] = $dataget[$i]['3'];
    	$toSet_locLati[] = $dataget[$i]['4'];
    }

    $cri_tempstat = $_SESSION['sess_tempstatus'];
	//-------------------------------------------------------------------------- END OF GET DATA TO PUT INTO ONE

	//-------------------------------------------------------------------------Select category
	$merge_final = array_merge($toSet_locID, $toSet_locName, $toSet_locDis, $toSet_locLongi, $toSet_locLati, $cri_tempstat, $c1weight, $sumresult);
	$chunk_final = array_chunk($merge_final, $cc1);
	//tranpose final1
	array_unshift($chunk_final, null);
		$FINALRESULT = call_user_func_array('array_map', $chunk_final);

	$_SESSION['FINALRESULT'] = $FINALRESULT;
	/*echo $cc1; echo $cc2;
	echo '<pre>'; echo 'dataget '; print_r($dataget); echo '</pre>';
	echo '<pre>'; echo 'toSet_locID '; print_r($toSet_locID); echo '</pre>';
    echo '<pre>'; echo 'FINALRESULT '; print_r($FINALRESULT); echo '</pre>';
    */
?>