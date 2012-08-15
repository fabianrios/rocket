<?php
class Diagnostico
{
	protected $variables;
	protected $salidas;
	protected $user;
	protected $points;
	protected $varfin;
	protected $calificacion;
	
	public function __construct(&$user)
	{
		$this->salidas			= array();
		$this->points			= array();
		$this->varfin			= array();		
		$this->user				= $user;
		$this->calificacion		= array('vivienda'=>3.5, 'max_vivienda'=>0.1, 'total'=>3.5, 'max_total'=>0.1, 'nvivienda'=>3.5, 'max_nvivienda'=>0.1, 'maxi'=>3.5, 'max_maxi'=>0.1 );
		$this->variables		= array("TIMR"=>0.0208 , "PLAZOMEDIO"=>48 ,"PCT_U_TC"=>0.035 , "DTF"=>0.05, "TLM"=>"0.0221", "DTFMES"=>0.004);
		$points					= PointHelper::retrievePoints(" ORDER by question_id, question_value");		
		$last					= 0;
		foreach ($points as $point)
		{
			
			if ($last != $point->__get('question_id'))
					$this->points[$point->__get('question_id')]	= array();
			$this->points[$point->__get('question_id')][$point->__get('question_value')]		= 	$point->__get('points_value');
			$last	= $point->__get('question_id');
		}
	}
	public function addFilter($filter, $value1, $value2 = false)
	{
		$this->variables[$filter] = $value1;	
	}
	
	public function fv($r,$n,$p,$pv=0)
	{
	   $sum = $pv;
	   for ( $i=0;$i<$n;$i++ )
	   {
		   $sum += $sum*$r + $p;
	   }
	   return $sum;
	}

	public function PV($rate, $nper, $pmt)
	{
		return $pmt / $rate * (1 - pow(1 + $rate, -$nper));
	}
	
	public function PMT($i, $n, $p) 
	{
 		return $i * $p * pow((1 + $i), $n) / (1 - pow((1 + $i), $n));
	}

	public function NPER($rate = 0, $pmt = 0, $pv = 0, $fv = 0, $type = 0) {


		if (!is_null($rate) && $rate != 0) 
		{
		   	$totalIncomeFromFlow 		= ($pmt / $rate);
			$sumOfPvAndPayment 			= (-$fv + $totalIncomeFromFlow);
			$currentValueOfPvAndPayment = ($pv + $totalIncomeFromFlow);
			
			if (($sumOfPvAndPayment < 0) && ($currentValueOfPvAndPayment < 0)) 
			{
				$sumOfPvAndPayment 			= -$sumOfPvAndPayment;
				$currentValueOfPvAndPayment = 0-$currentValueOfPvAndPayment;
			}
			else if (($sumOfPvAndPayment <= 0) || ($currentValueOfPvAndPayment <= 0)) 
			{
				return 0;
			}
			
			$totalInterestRate = $sumOfPvAndPayment / $currentValueOfPvAndPayment;
			return log($totalInterestRate) / log($rate + 1);
			//return log(($pmt * (1 + $rate * $type) / $rate - $fv) / ($pv + $pmt * (1 + $rate * $type) / $rate)) / log(1 + $rate);
		} 
		else 
		{
			return (-$pv -$fv) / $pmt;
		}
	}	//	function NPER()
	
	public function nAhorro($CI, $P, $F, $TA, $TCDT, $INCRE)
	{
		
		// DETERMINA EL NUMERO DE MESES QUE SE DEBE AHORRAR EN UNA RENTA DE PAGOS P Y UN VALOR INICIAL CI EN UN CDT
		// HASTA ALCANZAR EL VALOR FALTANTE F
		// CI CUOTA INICIAL
		// P VALOR PAGO CUOTA
		// F VALOR FALTANTE INICIAL
		// TA TASA AHORRO RENTA
		// TCDT TASA CDT PARA AHORRO FIJO
		// INCRE FACTOR DE INCREMENTO DEL FALTANTE (INFLACIîN)
		
		$ACUM 	= 0;
		$n 		= 0;
		$DIF 	= -$F;
		while ($DIF < 0)
		{
			$n = $n + 1;	 
			if ($TA > 0)
				$ACUM = $P * ( pow((1 + $TA), $n - 1) / $TA) + $CI * pow((1 + $TCDT), $n - 1);
			else
				$ACUM = $P * $n + $CI * pow((1 + $TCDT), $n - 1);
			$DIF = $ACUM - $F * pow((1 + $INCRE),  $n);
		}
		
		return $n;
	}
	public function getProfile()
	{
		//PERFIL
		$userData 	= unserialize($this->user->__get('user_data'));
		if (isset($userData['user_men']))
		{
			$userData['user_incharge_of']	= $userData['user_men']+$userData['user_women']+$userData['user_sons']+$userData['user_daughters'];
			$profile	= ($userData['user_income_representation']/100) * $userData['user_incharge_of'];
			if ($profile <= 0.4)
				$switch = 1;
			else if (($profile > 0.4)&&($profile <= 0.8))		
				$switch = 2;
			else if (($profile > 0.8)&&($profile <= 1.61))		
				$switch = 3;
			else if (($profile > 1.61)&&($profile <= 2.40))		
				$switch = 4;
			else
				$switch	= 5;
			UserHelper::setData($this->user->__get('user_id'), 'user_profile', $switch);
			$this->user = new User($this->user->__get('user_id'));
			return ($switch);
		}
		else
			$url	= 'diagnostico-010.html';
			echo "<script language=\"javascript\">
				window.location.href=\"$url\";			
            </script>";
			
	}
	
	public function calculatePlanning()
	{
		$userData 	= unserialize($this->user->__get('user_data'));
		if (isset($userData['salud_1']) && ($userData['salud_1'] != ''))
		{		
			if (!isset($userData['user_profile']))
				$switch	= $this->getProfile();
			else
				$switch = $userData['user_profile'];
			//DATA 1
			$questions	= array();
			$bloques	= array();
			for ($i= 1; $i< 10; $i++)
			{

				$questions[$i]	= $this->points[$i][$userData['salud_'.$i]];		
			}
			//BLOCKS
			$blocks			= array(); //Ponderations will be stored here according to id in db
			//Resolve for 4
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 4 ORDER by ponderation_parent");
			$min			= 5;
			$minId			= 0;
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();
				$blocks[$ponderation->__get('ponderation_id')-1][0] = $questions[$ponderation->__get('question_id')];
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $questions[$ponderation->__get('question_id')] * $ponderation->__get('ponderation_profile_'.$switch);
				$text	= new Text($ponderation->__get('question_id'));
				$temp	= intval($blocks[$ponderation->__get('ponderation_id')-1][0])+1;
				$blocks[$ponderation->__get('ponderation_id')-1][2] = $text->__get("text_range_".$temp);
				if ($min > $questions[$ponderation->__get('question_id')])
				{
					$min	= $questions[$ponderation->__get('question_id')];
					$minId	= $ponderation->__get('ponderation_id')-1;
				}
			}
			//Resolve for 3
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 3 AND ponderation_id < 21 ORDER by ponderation_parent");		
			
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();			
				$sons	= PonderationHelper::retrievePonderations(' AND ponderation_parent = '.$ponderation->__get('ponderation_id') .' ORDER by ponderation_parent');
				$temp	= 0;
				foreach ($sons as $pondSon)
				{
						$temp 	+= $blocks[$pondSon->__get('ponderation_id')-1][1];
				}
				$blocks[$ponderation->__get('ponderation_id')-1][0]	= $temp;
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $temp * $ponderation->__get('ponderation_profile_'.$switch);
			}
			//Resolve for 2
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 2 AND ponderation_id < 21 ORDER by ponderation_parent");		
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();			
				$sons	= PonderationHelper::retrievePonderations(' AND ponderation_parent = '.$ponderation->__get('ponderation_id') .' ORDER by ponderation_parent');
				$temp	= 0;
				foreach ($sons as $pondSon)
				{
						$temp 	+= $blocks[$pondSon->__get('ponderation_id')-1][1];
				}
				$blocks[$ponderation->__get('ponderation_id')-1][0]	= $temp;
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $temp * $ponderation->__get('ponderation_profile_'.$switch);
			}
			//Resolve for 1
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 1 AND ponderation_id < 21 ORDER by ponderation_parent");		
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();			
				$sons	= PonderationHelper::retrievePonderations(' AND ponderation_parent = '.$ponderation->__get('ponderation_id') .' ORDER by ponderation_parent');
				$temp	= 0;
				foreach ($sons as $pondSon)
				{
						$temp 	+= $blocks[$pondSon->__get('ponderation_id')-1][1];
						//echo $blocks[$pondSon->__get('ponderation_id')-1][1].'<br>';
				}
				if ($temp < 1) $temp = 0.25;
				$blocks[$ponderation->__get('ponderation_id')-1][0]	= $temp;
				
								
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $temp * $ponderation->__get('ponderation_profile_'.$switch);	
				$text	= new Text(19);
				$temp	= intval($blocks[$ponderation->__get('ponderation_id')-1][0])+1;
				$blocks[$ponderation->__get('ponderation_id')-1][2] = ($temp <= 5) ? $text->__get("text_range_".$temp) : $text->__get("text_range_5");
	
			}	
			//SAVE	
			if (!isset($blocks[$minId][2]))
			{
				$blocks[$minId][2]	= '';
			}
			UserHelper::setData($this->user->__get('user_id'), 'salu_planning_calification', MAX(array($blocks[1][0]*20,5)));
			UserHelper::setData($this->user->__get('user_id'), 'salu_planning_final', $blocks[1][1]);
			UserHelper::setData($this->user->__get('user_id'), 'salu_planning_text', $blocks[1][2].' '.$blocks[$minId][2]);
		}
		else
		{
			//SAVE	
			UserHelper::setData($this->user->__get('user_id'), 'salu_planning_calification', "");
			UserHelper::setData($this->user->__get('user_id'), 'salu_planning_final', "");
			UserHelper::setData($this->user->__get('user_id'), 'salu_planning_text', '');			
		}
	}
	
	public function calculateConsumo()
	{
		$user = new User($this->user->__get('user_id'));
		$userData 	= unserialize($this->user->__get('user_data'));

		if (isset($userData['salud_10']) && ($userData['salud_10'] != ''))
		{		
			if (!isset($userData['user_profile']))
				$userData['user_profile'] = $this->getProfile();
			$switch		= $userData['user_profile'];				
			//DATA 1
			$questions	= array();
			$bloques	= array();
			for ($i= 10; $i< 18; $i++)
			{
				$questions[$i]	= $this->points[$i][$userData['salud_'.$i]];
			}
			//BLOCKS
			$blocks			= array(); //Ponderations will be stored here according to id in db
			//Resolve for 4
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 3 AND ponderation_id > 20 ORDER by ponderation_parent");
			$min			= 5;
			$minId			= 0;
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();
				$blocks[$ponderation->__get('ponderation_id')-1][0] = $questions[$ponderation->__get('question_id')];
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $questions[$ponderation->__get('question_id')] * $ponderation->__get('ponderation_profile_'.$switch);
				$text	= new Text($ponderation->__get('question_id')+10);
				$temp	= intval($blocks[$ponderation->__get('ponderation_id')-1][0])+1;
				$blocks[$ponderation->__get('ponderation_id')-1][2] = $text->__get("text_range_".$temp);
				if ($min > $questions[$ponderation->__get('question_id')])
				{
					$min	= $questions[$ponderation->__get('question_id')];
					$minId	= $ponderation->__get('ponderation_id')-1;
				}
			}
			//Resolve for 3
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 2 AND ponderation_id > 20 ORDER by ponderation_parent");		
			
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();			
				$sons	= PonderationHelper::retrievePonderations(' AND ponderation_parent = '.$ponderation->__get('ponderation_id') .' ORDER by ponderation_parent');
				$temp	= 0;
				foreach ($sons as $pondSon)
				{
						$temp 	+= $blocks[$pondSon->__get('ponderation_id')-1][1];
				}
				$blocks[$ponderation->__get('ponderation_id')-1][0]	= $temp;
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $temp * $ponderation->__get('ponderation_profile_'.$switch);
			}

			//Resolve for 1
			$ponderations	= PonderationHelper::retrievePonderations(" AND ponderation_level = 1 AND ponderation_id > 20 AND ponderation_id < 34 ORDER by ponderation_parent");		
			foreach ($ponderations as $ponderation)
			{
				$blocks[$ponderation->__get('ponderation_id')-1]	= array();			
				$sons	= PonderationHelper::retrievePonderations(' AND ponderation_parent = '.$ponderation->__get('ponderation_id') .' ORDER by ponderation_parent');
				$temp	= 0;
				foreach ($sons as $pondSon)
				{
						$temp 	+= $blocks[$pondSon->__get('ponderation_id')-1][1];
				}
				if ($temp < 1) $temp = 0.25;
				$blocks[$ponderation->__get('ponderation_id')-1][0]	= $temp;
				$blocks[$ponderation->__get('ponderation_id')-1][1]	= $temp * $ponderation->__get('ponderation_profile_'.$switch);	
				$text	= new Text(31);
				$temp	= intval($blocks[$ponderation->__get('ponderation_id')-1][0])+1;
				$blocks[$ponderation->__get('ponderation_id')-1][2] = ($temp <= 5) ? $text->__get("text_range_".$temp) : $text->__get("text_range_5");
			}

			if (!isset($blocks[$minId][2]))
				$blocks[$minId][2]	= '';	
			//SAVE	
			UserHelper::setData($this->user->__get('user_id'), 'salu_consumption_calification', MAX(array($blocks[21][0]*20,5)));
			UserHelper::setData($this->user->__get('user_id'), 'salu_consumption_final', $blocks[21][1]);
			UserHelper::setData($this->user->__get('user_id'), 'salu_consumption_text', $blocks[21][2].' '.$blocks[$minId][2]);
			ksort ($blocks);
		}
		else
		{
			//SAVE	
			UserHelper::setData($this->user->__get('user_id'), 'salu_consumption_calification', "");
			UserHelper::setData($this->user->__get('user_id'), 'salu_consumption_final', "");
			UserHelper::setData($this->user->__get('user_id'), 'salu_consumption_text', '');			
		}
	}	
	
	public function calculateAll()
	{	
		//USER DATA
		$userData 	= unserialize($this->user->__get('user_data'));
		//PROFILE
		$switch		= $this->getProfile();
		//INVOKE
		
		
		$this->calculatePlanning();
		$this->calculateConsumo();
		$this->financiera($userData, $switch);
		$this->refreshUser();
		$this->calculateFinal();
		//echo '<pre>';
		//print_r($userData);
		//echo '</pre>';		
		
		return $this->salidas;
	}
	
	public function refreshUser()
	{
		$this->user	= new User($this->user->__get('user_id'));
	}
	public function calculateFinal()
	{
		$userData 	= unserialize($this->user->__get('user_data'));
		if (($userData['salu_consumption_final'] !== "") && ($userData['salu_planning_final'] !== "") && ($userData['salu_financial_final'] !== ""))
		{
			
			$temp	= $userData['salu_financial_final']+$userData['salu_planning_final']*20+$userData['salu_consumption_final']*20;
		
			
			$text	= new Text(33);
			UserHelper::setData($this->user->__get('user_id'), 'salu_final_calification', '');
			UserHelper::setData($this->user->__get('user_id'), 'salu_final_final', $temp);
			UserHelper::setData($this->user->__get('user_id'), 'salu_final_text', $text->__get("text_range_".intval($temp+1)));
		}
		else
		{
			UserHelper::setData($this->user->__get('user_id'), 'salu_final_calification', '');
			UserHelper::setData($this->user->__get('user_id'), 'salu_final_final', '');
			UserHelper::setData($this->user->__get('user_id'), 'salu_final_text', utf8_decode('Para obtener el diagnóstico general debes completar los 3 capitulos'));
		}
	}
	
	public function financiera(&$userData, &$profile)
	{
		if (isset($userData['salud_28-1']))
		{
			$userData['salud_28']	= intval($userData['salud_28-1']) + intval($userData['salud_28-2']) + intval($userData['salud_28-3']);
			
		}
		if (isset($userData['salud_23-1']))
		{
			$userData['salud_23']	= intval($userData['salud_23-1']) + intval($userData['salud_23-2']);
			
		}
		if (isset($userData['salud_20-1']))
		{
			$userData['salud_20']	= intval($userData['salud_20-1']) + intval($userData['salud_20-2']);
			
		}		
		if (isset($userData['salud_28']) && ($userData['salud_28'] != 0))
		{	
			//SALARIOS MINIMOS
			for ($i = 18; $i < 30; $i++)
				$userData['salud_'.$i] 	= str_replace(".", "", $userData['salud_'.$i]);
			$this->varfin['smmlv']	= floor($userData['salud_28']/SMMLV);
			if ($this->varfin['smmlv'] > 10)
			{
				if ($this->varfin['smmlv'] > 15)
					$this->varfin['smmlv'] = 15;
				else
					$this->varfin['smmlv'] = 10;
			}
			if ($userData['salud_24'] == 0) 
				$debType 	= 'sin';
			else
				$debType	= 'con';
			//LIMITES FINANCIEROS
			$financiero					= FinancieroHelper::retrieveFinancieros(" AND perfil_id = ". $profile . " AND financiero_smmlv = " . $this->varfin['smmlv']);
			$financiero					= (count($financiero) > 0) ? $financiero[0] : new Financiero(); 
			//CREDITO HIPOTERCARIO
			$this->varfin['pct_credito_hipotecario']			= $userData['salud_24']/$userData['salud_28'];
			$this->varfin['pct_credito_hipotecario_porcentaje']	= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->varfin['pct_credito_hipotecario']/$financiero->__get('financiero_final_'.$debType.'_h') : 0;
			//% INGRESOS CREDITOS TC Y ROTATIVOS
			$this->varfin['pct_credito_tc']						= $userData['salud_25']/$userData['salud_28'];
			$this->varfin['pct_credito_tc_porcentaje']			= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->varfin['pct_credito_tc']/$financiero->__get('financiero_final_'.$debType.'_h') : 0;
			//% INGRESOS EN OTROS CREDITOS
			$this->varfin['pct_credito_otros']					= $userData['salud_23']/$userData['salud_28'];
			$this->varfin['pct_credito_otros_porcentaje']		= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->varfin['pct_credito_otros']/$financiero->__get('financiero_final_'.$debType.'_h') : 0;
			//% INGRESOS EN OTROS CREDITOS
			$this->varfin['pct_credito_acreencias']				= $userData['salud_27']/$userData['salud_28'];
			$this->varfin['pct_credito_acreencias_porcentaje']	= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->varfin['pct_credito_acreencias']/$financiero->__get('financiero_final_'.$debType.'_h') : 0;
			//TOTAL
			$this->varfin['pct_deudas_total']					= 	$this->varfin['pct_credito_hipotecario'] + $this->varfin['pct_credito_tc']	+ $this->varfin['pct_credito_otros'];
			$this->varfin['pct_nvivienda']						= 	$this->varfin['pct_credito_tc']	+ $this->varfin['pct_credito_otros'];
			//MAXI
			$this->varfin['suma_creditos_nvivienda']			= $userData['salud_20']+$userData['salud_21'];
			$this->varfin['suma_limite_max']					= $this->PV($this->variables["TIMR"], $this->variables["PLAZOMEDIO"], $financiero->__get('financiero_total_'.$debType.'_h')*$userData['salud_28']);
			//INDICES
			//2		18	A cuanto asciende lo que puede tener en efectivo, en las cuentas bancarias, en CDTs, en carteras colectivas a la vista y en cesant�as?
			//3		19	A cuanto asciende todo lo que has trabajado y comprado durante la vida: casa, carro, electrodom�sticos, computadores, lo que tienes en tu fondo de pensiones obligatorias, en general toda lo que puedes vender. (finca acciones en club, art�culos deportivos,
			//4		20	Por favor ingrese el monto total de deudas que tengas por: libre inversi�n, carro, que le debas a tu familia amigos, agiotistas, bancos etc.
			//5		21	Por favor ingrese el monto total de las deudas que tiene  por concepto de tarjeta de cr�dito y cr�dito rotativos
			//6		22	Ingrese el valor total de la deuda hipotecaria en caso de tenerla
			//7		23	Monto de los pagos que realizo el mes pasado por sus cr�ditos de libre inversi�n, carro, a amigos, familiares o bancos
			//8		24	Cuanto pago por su cuota del cr�dito de vivienda el mes pasado, i en canon del leasing (si alguien mas le presto para comprar la vivienda por favor incl�yalo)
			//9		25	Cuanto pago el mes pasado en la cuota del cr�dito rotativo y/o tarjeta de cr�dito.
			//10	26	Cuanto tienes que pagar mensualmente en promedio por tus recibos p�blicos, celular, medicina pre pagada y pensi�n del colegio
			//11	27	A cuanto suman los gastos mensuales que tienes que hacer por el resto de cosas, sin incluir ahorros. (comida, transporte, vestuario, hogar, etc. + arriendo + diversion)
			//12	28	Cuanto es el monto de tus ingresos mensuales
			//13	29	Cuanto es el monto de tus ingresos mensuales
			
			$this->varfin['relacion_liquidez']			= $userData['salud_18']/MAX(array(($userData['salud_21']+(2*($userData['salud_23']+$userData['salud_24']+$userData['salud_25']))), 1));
			$this->varfin['flujo_ahorro']				= $userData['salud_29']/$userData['salud_28'];
			$this->varfin['relacion_deuda']				= ($userData['salud_20']+$userData['salud_21']+$userData['salud_22']+$userData['salud_26'])/MAX(array(($userData['salud_18']+$userData['salud_19']), 1));	
			//
			$this->varfin['nivel_endeudamiento']		= $financiero->__get('financiero_final_'.$debType.'_h') - $this->varfin['pct_deudas_total'];	 
			$this->varfin['capacidad_endeudamiento']	= $financiero->__get('financiero_final_'.$debType.'_h') - $this->varfin['pct_deudas_total'];
			$tempa										= (1-(($userData['salud_27']+$userData['salud_23']+$userData['salud_24']+$userData['salud_25']+$userData['salud_26'])/$userData['salud_28']));
			$tempb										= $financiero->__get('financiero_final_'.$debType.'_h') - $this->varfin['pct_deudas_total'];			
			$temp2										= MIN(array($tempa, $tempb));																	
			$this->varfin['capacidad_pago']				= $temp2	 -0.05;
			$this->varfin['capacidad_ahorro']			= MAX(array($userData['salud_28']-($userData['salud_24']+$userData['salud_25']+$userData['salud_23']+$userData['salud_27']+$userData['salud_26']), 0));
			//CALCULOS LIQUIDEZ
			$liquidez	= LiquidezHelper::retrieveLiquidez(" AND perfil_id = ".$profile. " ORDER by liquidez_id");
			$stock		= $liquidez[0];
			if ($this->varfin['relacion_liquidez'] >= $stock->__get('liquidez_alto'))
				$this->varfin['categoria_stock'] = 4;
			else if (($this->varfin['relacion_liquidez'] >= $stock->__get('liquidez_regular')) &&  ($this->varfin['relacion_liquidez'] < $stock->__get('liquidez_alto')))
				$this->varfin['categoria_stock'] = 3;
			else if (($this->varfin['relacion_liquidez'] >= $stock->__get('liquidez_bajo')) &&  ($this->varfin['relacion_liquidez'] < $stock->__get('liquidez_regular')))
				$this->varfin['categoria_stock'] = 2;			
			else
				$this->varfin['categoria_stock'] = 1;			
			
			switch ($this->varfin['categoria_stock']):
				case '4':
					$this->varfin['categoria_stock_msg'] = 'Has acumulado un buen nivel de ahorro';
				break;
				case '3':
					$this->varfin['categoria_stock_msg'] = 'Tienes un ahorro que te respalda, lo cual es bueno';
				break;
				case '2':
					$this->varfin['categoria_stock_msg'] = 'Tu nivel de ahorro es a penas lo necesario y ante cualquier eventualidad se veria afectado';
				break;
				default:
					$this->varfin['categoria_stock_msg'] = 'El ahorro que has acumulado pone en riesgo tu seguridad finaciera';
				break;
			endswitch;
			$this->varfin['categoria_stock_calif'] 		 = ($this->varfin['categoria_stock'] * 5)/4;
			$this->varfin['categoria_stock_calif_final'] = $this->varfin['categoria_stock_calif']  * 0.30;
			
			
			//FLUJO
			$flujo	= $liquidez[5-$this->varfin['categoria_stock']];
	
			if ($this->varfin['flujo_ahorro'] >= $flujo->__get('liquidez_alto'))
				$this->varfin['categoria_ahorro'] = 4;
			else if (($this->varfin['flujo_ahorro'] >= $flujo->__get('liquidez_regular')) &&  ($this->varfin['flujo_ahorro'] < $flujo->__get('liquidez_alto')))
				$this->varfin['categoria_ahorro'] = 3;
			else if (($this->varfin['flujo_ahorro'] >=$flujo->__get('liquidez_bajo')) &&  ($this->varfin['flujo_ahorro'] < $flujo->__get('liquidez_regular')))
				$this->varfin['categoria_ahorro'] = 2;			
			else
				$this->varfin['categoria_ahorro'] = 1;		
				
			switch ($this->varfin['categoria_ahorro']):
				case '4':
					$this->varfin['categoria_ahorro_msg'] = 'Tienes un nivel de ahorro es muy bueno';
				break;
				case '3':
					$this->varfin['categoria_ahorro_msg'] = 'Tu nivel de ahorro está bien';
				break;
				case '2':
					$this->varfin['categoria_ahorro_msg'] = 'Debes empezar a ahorrar un poco mas';
				break;	
				default:
					$this->varfin['categoria_ahorro_msg'] = 'Tu nivel de ahorro es muy bajo';
				break;
			endswitch;	
			
			$this->varfin['categoria_ahorro_calif'] 		= ($this->varfin['categoria_ahorro'] * 5)/4;
			$this->varfin['categoria_ahorro_calif_final'] 	= $this->varfin['categoria_ahorro_calif']  * 0.10;
			
			//DEUDA
			$deuda	= $liquidez[5];
			
			if ($this->varfin['relacion_deuda']	 <= $deuda->__get('liquidez_alto'))
				$this->varfin['categoria_deuda'] = 4;
			else if (($this->varfin['relacion_deuda']	 <= $deuda->__get('liquidez_regular')) &&  ($this->varfin['relacion_deuda']	 > $deuda->__get('liquidez_alto')))
				$this->varfin['categoria_deuda'] = 3;
			else if (($this->varfin['relacion_deuda']	 <=$deuda->__get('liquidez_bajo')) &&  ($this->varfin['relacion_deuda']	 > $deuda->__get('liquidez_regular')))
				$this->varfin['categoria_deuda'] = 2;			
			else
				$this->varfin['categoria_deuda'] = 1;		
				
			switch ($this->varfin['categoria_deuda']):
				case '4':
					$this->varfin['categoria_deuda_msg'] = 'Muy bien, lo que tienes realmente te pertenece';
				break;
				case '3':
					$this->varfin['categoria_deuda_msg'] = 'Estas bien, gran parte de lo que tienes realmente te pertenece';
				break;
				case '2':
					$this->varfin['categoria_deuda_msg'] = 'Gran parte de lo que tienes no te pertenece realmente';
				break;	
				default:
					$this->varfin['categoria_deuda_msg'] = 'La mayor parte de lo que tienes en realidad no te pertenece';
				break;
			endswitch;	
			
			$this->varfin['categoria_deuda_calif'] 		 = ($this->varfin['categoria_deuda'] * 5)/4;
			$this->varfin['categoria_deuda_calif_final'] = $this->varfin['categoria_deuda_calif']  * 0.25;
			
			//ENDEUDAMIENTO
			$endeudamiento	= $liquidez[6];
	
			$this->varfin['nivel_endeudamiento']  = $this->varfin['nivel_endeudamiento']/$financiero->__get('financiero_final_'.$debType.'_h');
			//print_r ($this->varfin['nivel_endeudamiento']);
			//echo $endeudamiento->__get('liquidez_alto');
			if ($this->varfin['nivel_endeudamiento']	 >= $endeudamiento->__get('liquidez_alto'))
				$this->varfin['categoria_endeudamiento'] = 4;
			else if (($this->varfin['nivel_endeudamiento']	 >= $endeudamiento->__get('liquidez_regular')) &&  ($this->varfin['nivel_endeudamiento']	 < $endeudamiento->__get('liquidez_alto')))
				$this->varfin['categoria_endeudamiento'] = 3;
			else if (($this->varfin['nivel_endeudamiento']	 >=$endeudamiento->__get('liquidez_bajo')) &&  ($this->varfin['nivel_endeudamiento']	 < $endeudamiento->__get('liquidez_regular')))
				$this->varfin['categoria_endeudamiento'] = 2;			
			else
				$this->varfin['categoria_endeudamiento'] = 1;		
				
			switch ($this->varfin['categoria_endeudamiento']):
				case '4':
					$this->varfin['categoria_endeudamiento_msg'] = 'Estas bien, tienes capacida de ahorrar o pedir prestado con holgura';
				break;
				case '3':
					$this->varfin['categoria_endeudamiento_msg'] = 'No estas mal, pero tu capacidad de endeudarte o de ahorrar no es le mejor';
				break;
				case '2':
					$this->varfin['categoria_endeudamiento_msg'] = 'Tu situacion no te permite un gran ahorro o poder endeudarte, este no es el mejor escenario';
				break;	
				default:
					$this->varfin['categoria_endeudamiento_msg'] = 'Tu situacion no te permite endeudarte o ahorrar, este escenario es algo preocupante, deberias emprender acciones inmediatamente';
				break;
			endswitch;	
			
			$this->varfin['categoria_endeudamiento_calif'] 		 = ($this->varfin['categoria_endeudamiento'] * 5)/4;
			$this->varfin['categoria_endeudamiento_calif_final'] = $this->varfin['categoria_endeudamiento_calif']  * 0.20;
	
			//CAPACIDAD
			$capacidad	= $liquidez[7];
	
			if ($this->varfin['capacidad_pago']	 >= $capacidad->__get('liquidez_alto'))
				$this->varfin['categoria_capacidad'] = 4;
			else if (($this->varfin['capacidad_pago']	 >= $capacidad->__get('liquidez_regular')) &&  ($this->varfin['capacidad_pago']	 < $capacidad->__get('liquidez_alto')))
				$this->varfin['categoria_capacidad'] = 3;
			else if (($this->varfin['capacidad_pago']	 >=$capacidad->__get('liquidez_bajo')) &&  ($this->varfin['capacidad_pago']	 < $capacidad->__get('liquidez_regular')))
				$this->varfin['categoria_capacidad'] = 2;			
			else
				$this->varfin['categoria_capacidad'] = 1;		
				
			switch ($this->varfin['categoria_capacidad']):
				case '4':
					$this->varfin['categoria_capacidad_msg'] = 'Muy buena capacidad';
				break;
				case '3':
					$this->varfin['categoria_capacidad_msg'] = 'Buena capacidad';
				break;
				case '2':
					$this->varfin['categoria_capacidad_msg'] = 'Regular capacidad';
				break;	
				default:
					$this->varfin['categoria_capacidad_msg'] = 'Muy mala capacidad';
				break;
			endswitch;	
			
			$this->varfin['categoria_capacidad_calif'] 		 = ($this->varfin['categoria_capacidad'] * 5)/4;
			$this->varfin['categoria_capacidad_calif_final'] = $this->varfin['categoria_capacidad_calif']  * 0.15;
			
			$this->varfin['final']				= $this->varfin['categoria_capacidad_calif_final'] + $this->varfin['categoria_endeudamiento_calif_final'] + $this->varfin['categoria_deuda_calif_final'] + $this->varfin['categoria_ahorro_calif_final'] + $this->varfin['categoria_stock_calif_final'];
		
			//TEXTOS
			$arr	= array('A'=>$this->varfin['categoria_stock_calif'], 'B'=>$this->varfin['categoria_ahorro_calif'], 'C'=>$this->varfin['categoria_deuda_calif'], 'D'=>$this->varfin['categoria_endeudamiento_calif'], 'E'=>$this->varfin['categoria_capacidad_calif']);
			asort($arr);
	
			
			if ($this->varfin['final'] <= 3)
			{
				if ($this->varfin['categoria_stock_calif'] <= 3)
					$this->varfin['mensaje']	= " nunca te atrases, siquiera por un día, en el pago de tus créditos y servicios. No sigas endeudandote. Sacrifica un poco de consumo y podras salir de esto.";
				else 
				{
					if (key($arr) == 'B')
						$this->varfin['mensaje']	= " mantengas pocas deudas de corto plazo. También sería conveniente que empezaras a ahorrar un poco mas, asi podras alcanzar tus metas: AHORRA o NUNCA!";
					else if (key($arr) == 'C')
						$this->varfin['mensaje']	= " te orientes en pagar tus deudas sin atrasarte si quiera un día. Esto porque tu endeudamiento total es alto. Haz tuyas las cosas que tienes. Sacrifica un poco de consumo y podras salir de eso.";
					else if (key($arr) == 'D')
						$this->varfin['mensaje']	= " te orientes en pagar tus deudas de corto plazo. El monto de lo que estas pagando por deudas es muy alto frente a tus ingresos. No te endeudes más y paga a tiempo tus deudas actuales.";
					else 
						$this->varfin['mensaje']	= " te orientes en pagar tus deudas de corto plazo. El monto de lo que estas pagando por deudas y consumo es muy alto frente a tus ingresos. No te endeudes más y paga a tiempo tus deudas actuales. Sacrifica consumo haciendo un mayor esfuerzo de planificación de tus finanzas.";
				}
			}
			if (($this->varfin['final'] > 3) && ($this->varfin['final'] <= 4))
			{
				if ($this->varfin['categoria_stock_calif'] <= 3)
					$this->varfin['mensaje']	= " nunca te atrases siquiera por un día en el pago de tus créditos y servicios. Manten bajo tu endeudandote. Sacrifica un poco de consumo.";
				else
				{
					if (key($arr) == 'B')
						$this->varfin['mensaje']	= " mantengas pocas deudas de corto plazo y comienza a ahorrar mas.";
					else if (key($arr) == 'C')
						$this->varfin['mensaje']	= " te orientes en pagar tus deudas sin atrasarte si quiera un día. Tu endeudamiento total es alto, entonces debes buscar disminuir las deudas grandes que tengas ";
					else if (key($arr) == 'D')
						$this->varfin['mensaje']	= " te orientes en pagar tus deudas de corto plazo. El monto de lo que estas pagando por deudas es alto frente a tus ingresos. No te endeudes más y paga a tiempo tus deudas actuales.";
					else 
						$this->varfin['mensaje']	= " te orientes en pagar tus deudas de corto plazo. El monto de lo que estas pagando por deudas y consumo es alto frente a tus ingresos. No te endeudes más y paga a tiempo tus deudas actuales. Sacrifica consumo haciendo un mayor esfuerzo de planificación de tus finanzas.";
					
				}
			}
			if ($this->varfin['final'] > 4)
			{
				if (key($arr) == 'A')
					$this->varfin['mensaje']	= " no descuides tu liquidez. Manten un poco mas de ahorro liquido.";				
				else if (key($arr) == 'B')
					$this->varfin['mensaje']	= " no descuides tu ahorro, trata de ahorrar mas.";
				else if (key($arr) == 'C')
					$this->varfin['mensaje']	= " no descuides tu monto de endeudamiento. Es importante que las cosas que tienes realmente te pertenezcan, entonces busca mantener controlado el monto de tus pasivos.";
				else if (key($arr) == 'D')
					$this->varfin['mensaje']	= " trates de optimizar tus gastos financieros. En descubre te podemos ayudar con esto.";
				else 
					$this->varfin['mensaje']	= " trata de mejorar tu consumo para que ahorres más.";
			}

			$this->varfin['final']		= $this->varfin['final'] * 20;
			$this->varfin['mensaje']	= utf8_decode($this->varfin['mensaje']);
			$planning		= new Ponderation(2);
			$consumption	= new Ponderation(22);	
			$text			= new Text(34);
			$temp			= intval($this->varfin['final'])+1;
			$finalText 		= ($temp <= 5) ? $text->__get("text_range_".$temp) : $text->__get("text_range_5");			
			$total			= (1-($planning->__get('ponderation_profile_'.$profile)+$consumption->__get('ponderation_profile_'.$profile)))*$this->varfin['final'];
			if ($this->varfin['final'] < 1) $this->varfin['final'] = 1;
			UserHelper::setData($this->user->__get('user_id'), 'salu_financial_calification', $this->varfin['final']);
			UserHelper::setData($this->user->__get('user_id'), 'salu_financial_final', $total);
			UserHelper::setData($this->user->__get('user_id'), 'salu_financial_text', $finalText.$this->varfin['mensaje']);				
		}
		else
		{
			//SAVE	
			UserHelper::setData($this->user->__get('user_id'), 'salu_financial_calification', "");
			UserHelper::setData($this->user->__get('user_id'), 'salu_financial_final', "");
			UserHelper::setData($this->user->__get('user_id'), 'salu_financial_text', '');			
		}	
	}
	
	public function getTips()
	{		
		
		$user	= new User($this->user->__get('user_id'));
		$mensajes	= array();
		//
		$userData 	= unserialize($this->user->__get('user_data'));
		if (isset($userData['salud_28-1']))
			$userData['salud_28']	= intval($userData['salud_28-1']) + intval($userData['salud_28-2']) + intval($userData['salud_28-3']);
		if ( (isset($userData['salu_final_final'])) && ($userData['salu_final_final'] !== ""))
		{
			if (($userData['salu_financial_calification'] < 60))
			{
				$mensajes['mala']	= "Tu situación financiera no es la mejor. Deberías ir a sobres para organizar tus finanzas.";
			}
			else
			{
				
				switch ($userData['user_goal_1']):
					case '1':
						$objetivo = 'Pagar estudio propio';
					break;
					case '2':
						$objetivo = 'Crear un fondo de emergencia';
					break;
					case '3':
						$objetivo = 'Carro';
					break;						
					case '4':
						$objetivo = 'Moto';
					break;								
					case '5':
						$objetivo = 'Casa';
					break;	
					case '6':
						$objetivo = 'Matrimonio';
					break;							
					case '7':
						$objetivo = 'Tener un hijo';
					break;							
					case '8':
						$objetivo = 'Pagar estudio de mis hijos';
					break;							
					case '9':
						$objetivo = 'Empezar un negocio';
					break;							
					case '10':
						$objetivo = 'Pagar deudas';
					break;						
					case '11':
						$objetivo = 'Irme de vacaciones';
					break;							
					case '12':
						$objetivo = 'Pagar un tratamiento médico o estético';
					break;								
					case '13':
						$objetivo = 'Ahorrar dinero adicional para el retiro';
					break;							
					case '14':
						$objetivo = 'Tener plata para hacer inversiones';
					break;								
					case '16':
						$objetivo = 'Remodelar la casa';
					break;							
					case '17':
						$objetivo = 'Comprar electrodomésticos';
					break;							
					case '18':
						$objetivo = 'Tener un plática extra';
					break;							
					default:
						$objetivo = 'Otro';
					break;
				endswitch;
				if ($userData['salu_final_final'] > 60)			
					if ($userData['salu_financial_calification'] >= 60)
						$temp		= "";
					else 
					{
						$temp		= "No te recomendamos perseguir tu objetivo momentaneamente. Te recomendamos ir a sobres para organizar tus finanzas";						
						$mensajes['no-objetivo']	= $temp;
					}
				else
				{
					$temp		= "No te recomendamos perseguir tu objetivo momentaneamente. Te recomendamos ir a sobres para organizar tus finanzas";
					$mensajes['no-objetivo']	= $temp;
				}
				
				$estado		= 'bueno';
				//PRIMER OBJETIVO
				$varTerm	= 60;
				
				
				if ($userData['user_goal_term_1'] !== '')
				{
					$term	= $userData['user_goal_term_1'];
					
					
					//AHORRO
					$prestamo	= true;
					$tempC		= $this->varfin['capacidad_ahorro'];
					if ($tempC > 0)
					{
						$temp		= "Si ahorras $".number_format($tempC)." cada mes durante ".$term." meses puedes alcanzar una cuota inicial de $".number_format($this->fv($this->variables["DTFMES"], $term, $tempC))." para tu meta (".strtolower($objetivo) ."), ahorrando en un producto financiero de bajo riesgo.";
						$mensajes['ahorro']	=	array($temp, number_format($tempC), 	$term, number_format($this->fv($this->variables["DTFMES"], $term, $tempC)), number_format($this->fv($this->variables["DTFMES"], $term, $tempC)-($term*$tempC)));				
					}
					else
					{
						$temp		= "Tu situación actual no te permite ahorrar ni endeudarte. Disminuye gastos para poder tener capacidad de credito y ahorro para hacer tu meta realidad.";
						$prestamo	= false;
						$mensajes['no-ahorro']	=	$temp;
					}
					
					
					//PRESTAMO
					
					$temp		= "";
					if ($this->PV($this->variables["TLM"], $varTerm, $this->varfin['capacidad_pago']*$userData['salud_28']) > 200000)
					{
						$temp	.= "Podrias adquirir un prestamo cuando lo desees por: $".number_format($this->PV($this->variables["TLM"], $varTerm, $this->varfin['capacidad_pago']*$userData['salud_28']))." pagando una cuota mensual aproximada de $".number_format($this->varfin['capacidad_pago']*$userData['salud_28']) . " a ".$varTerm." meses, para intentar alcanzar tu meta (".strtolower($objetivo) .")";
						$temp2  = "Si ahorraras $".number_format($this->fv($this->variables["DTFMES"], $term, $tempC*$userData['salud_28']))." y pidieras un crédito de $".number_format($this->PV($this->variables["TLM"], $varTerm, $this->varfin['capacidad_pago']*$userData['salud_28'])).", en ". $term. " meses, podrías llegar a tener  $".number_format($this->PV($this->variables["TLM"], $varTerm, $this->varfin['capacidad_pago']*$userData['salud_28'])+$this->fv($this->variables["DTFMES"], $term, $tempC*$userData['salud_28']))." para tu meta (".strtolower($objetivo) .")";
						$mensajes['prestamo']	= array($temp, number_format($this->varfin['capacidad_pago']*$userData['salud_28']), $varTerm, number_format($this->PV($this->variables["TLM"], $varTerm, $this->varfin['capacidad_pago']*$userData['salud_28'])), number_format((($this->varfin['capacidad_pago']*$userData['salud_28'])*$varTerm)-$this->PV($this->variables["TLM"], $varTerm, $this->varfin['capacidad_pago']*$userData['salud_28'])));
						$mensajes['conjunta']	= $temp2;
					}
					else
					{
						if ($prestamo)
						{
							$temp	.= "No puedes en este momento perdir un prestamo. Disminuye gastos para poder tener capacidad de credito y ahorro.";
							$mensajes['no-prestamo']	= $temp;
						}
					}
					
					//SUMA									
				}
			}
		}
		
		return $mensajes;

	}
}
?>