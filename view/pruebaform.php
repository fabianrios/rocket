<?php
define('PRECISION', 8.88E-016);

function ERFC($x) {

	if (is_numeric($x)) {
		if ($x < 0) {
			return 0;
		}
		return _erfcVal($x);
	}
	return 0;
}	


function _erfcVal($x) 
{
	$_one_sqrtpi = 0.564189583547756287;
	if (abs($x) < 2.2) {
		return 1 - erfVal($x);
	}
	if ($x < 0) {
		return 2 - ERFC(-$x);
	}
	$a = $n = 1;
	$b = $c = $x;
	$d = ($x * $x) + 0.5;
	$q1 = $q2 = $b / $d;
	$t = 0;
	do {
		$t = $a * $n + $b * $x;
		$a = $b;
		$b = $t;
		$t = $c * $n + $d * $x;
		$c = $d;
		$d = $t;
		$n += 0.5;
		$q1 = $q2;
		$q2 = $b / $d;
	} while ((abs($q1 - $q2) / $q2) > PRECISION);
	return $_one_sqrtpi * exp(-$x * $x) * $q2;
}	//	function _erfcVal()



function _erfVal($x) {
	
	$_two_sqrtpi = 1.128379167095512574;

	if (abs($x) > 2.2) {
		return 1 - _erfcVal($x);
	}
	$sum = $term = $x;
	$xsqr = ($x * $x);
	$j = 1;
	do {
		$term *= $xsqr / $j;
		$sum -= $term / (2 * $j + 1);
		++$j;
		$term *= $xsqr / $j;
		$sum += $term / (2 * $j + 1);
		++$j;
		if ($sum == 0.0) {
			break;
		}
	} while (abs($term / $sum) > PRECISION);
	return $_two_sqrtpi * $sum;
}	


function NORMDIST($value, $mean, $stdDev, $cumulative) {

	if ((is_numeric($value)) && (is_numeric($mean)) && (is_numeric($stdDev))) {
		if ($stdDev < 0) {
			return false;
		}
		if ((is_numeric($cumulative)) || (is_bool($cumulative))) {
			if ($cumulative) {
				return 0.5 * (1 + _erfVal(($value - $mean) / ($stdDev * sqrt(2))));
			} else {
				return (1 / (SQRT2PI * $stdDev)) * exp(0 - (pow($value - $mean,2) / (2 * ($stdDev * $stdDev))));
			}
		}
	}
	return 0;
}	//	function NORMDIST()


/**
 * NORMINV
 *
 * Returns the inverse of the normal cumulative distribution for the specified mean and standard deviation.
 *
 * @param	float		$value
 * @param	float		$mean		Mean Value
 * @param	float		$stdDev		Standard Deviation
 * @return	float
 *
 */


/**
 * NORMSDIST
 *
 * Returns the standard normal cumulative distribution function. The distribution has
 * a mean of 0 (zero) and a standard deviation of one. Use this function in place of a
 * table of standard normal curve areas.
 *
 * @param	float		$value
 * @return	float
 */
function NORMSDIST($value) {

	return NORMDIST($value, 0, 1, True);
}	//	function NORMSDIST()


function STDEVP($arr) 
{
	$aArgs = $arr;

	// Return value
	$returnValue = null;

	$aMean = AVERAGE($aArgs);
	if (!is_null($aMean)) {
		$aCount = 0;
		foreach ($aArgs as $k => $arg) {
			// Is it a numeric value?
			if ((is_numeric($arg)) && (!is_string($arg))) {
				if (is_null($returnValue)) {
					$returnValue = pow(($arg - $aMean),2);
				} else {
					$returnValue += pow(($arg - $aMean),2);
				}
				++$aCount;
			}
		}

		// Return
		if (($aCount > 0) && ($returnValue >= 0)) {
			return sqrt($returnValue / $aCount);
		}
	}
}

function AVERAGE($arr) {
	$returnValue = $aCount = 0;

	// Loop through arguments
	foreach ($arr as $k => $arg) 
	{
		// Is it a numeric value?
		if ((is_numeric($arg)) && (!is_string($arg))) 
		{
			$returnValue += $arg;
			++$aCount;
		}
	}

	// Return
	if ($aCount > 0) {
		return $returnValue / $aCount;
	} 
}	//	function AVERAGE()


$arr = array(108,132,68,86,74,85,109,75,93,89,108,132,68,86,74,85,109,35);

foreach ($arr as $value)
{
	echo $value . ' - ';
	echo (1 - NORMSDIST(abs($value - AVERAGE($arr))/STDEVP($arr)))*count($arr);
	echo '<br />';
}
//(1 - NORMSDIST( ABS(valor de esa columna - promedio(valores de todos los demás productos para esa columna))/STDEVP(valores de todos los demás productos para esa columna)) * (numero de productos con datos numericos en esa columna) 
?>