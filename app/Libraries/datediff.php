<?php

namespace App\Libraries;

class dateDiff
{	
	function ageDOB($dob){ /* $y = year, $m = month, $d = day */
		$dob_a = explode("-", $dob);
		$dob_y = $dob_a[0];$dob_m = $dob_a[1];$dob_d = $dob_a[2];
		$ageY = date("Y")-intval($dob_y);
		$ageM = date("n")-intval($dob_m);
		$ageD = date("j")-intval($dob_d);

		if ($ageD < 0){
		    $ageD = $ageD += date("t");
		    $ageM--;
		    }
		if ($ageM < 0){
		    $ageM+=12;
		    $ageY--;
		    }
		if ($ageY < 0){ $ageD = $ageM = $ageY = -1; }
		// return array( 'y'=>$ageY, 'm'=>$ageM, 'd'=>$ageD );
		return "Years <b>".$ageY."</b> Months <b>".$ageM."</b> Days <b>".$ageD."</b>";
	}
}
