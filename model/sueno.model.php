<?php
class Sueno
{
	protected $variables;
	protected $salidas;
	protected $user;
	protected $result;
	
	public function __construct(&$user)
	{
		$this->variables 		= array();
		$this->salidas			= array();
		$this->user				= $user;
		$this->calificacion		= array('vivienda'=>3.5, 'max_vivienda'=>0.1, 'total'=>3.5, 'max_total'=>0.1, 'nvivienda'=>3.5, 'max_nvivienda'=>0.1, 'maxi'=>3.5, 'max_maxi'=>0.1 );
		$this->result			= 'negativo';
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
		
		$ACUM 	= 0;
		$n 		= 0;
		$DIF 	= -$F;
		while ($DIF < 0)
		{
			$n = $n + 1;
			
			if ($TA > 0)
				$ACUM = $P * ((pow((1+$TA),$n)-1)/$TA) + $CI;				
//				$ACUM = $P * ( pow((1 + $TA), $n - 1) / $TA) + $CI * pow((1 + $TCDT), $n - 1);
			else
				$ACUM = $P * $n + $CI; 
				//$ACUM = $P * $n + $CI * pow((1 + $TCDT), $n - 1);
			//echo $n.'-'.$ACUM.'<br>';
			$DIF = $ACUM - $F * pow((1 + $INCRE),  $n);
			//echo 'd'.$DIF.'<br>';
		}
		return $n;
	}

	public function getProfile()
	{
		//PERFIL
		$userData 						= unserialize($this->user->__get('user_data'));
		$userData['user_incharge_of']	= $userData['user_men']+$userData['user_women']+$userData['user_sons']+$userData['user_daughters'];
		$profile						= ($userData['user_income_representation']/100) * $userData['user_incharge_of'];
		if ($profile <= 0.4)
			$switch = 1;
		else if (($profile > 0.4)&&($profile <= 0.99))		
			$switch = 2;
		else if (($profile > 0.99)&&($profile <= 1.61))		
			$switch = 3;
		else if (($profile > 1.61)&&($profile <= 2.99))		
			$switch = 4;
		else
			$switch	= 5;
		UserHelper::setData($this->user->__get('user_id'), 'user_profile', $switch);
		return ($switch);
	}
	
	public static function calculatePayment($credito, $term=0, $payment=0)
	{
		$tasaCreditoMensual	= 0.015;
		if ($term > 0)
			$return	= round(self::PMT($tasaCreditoMensual, $term, -$credito));
		if ($payment > 0)
			$return	= round(self::NPER($tasaCreditoMensual, $payment, -$credito));
		return $return;			   
	}
	
	public function calculateNivel($profile)
	{
		$this->variables['smmlv']	= round($this->variables['salud_28']/SMMLV,0);
		if ($this->variables['smmlv'] > 10)
		{
			if ($this->variables['smmlv'] > 15)
				$this->variables['smmlv'] = 15;
			else
				$this->variables['smmlv'] = 10;
		}
		if (intval($this->variables['salud_24']) == 0) 
			$debType 	= 'sin';
		else
			$debType	= 'con';
		//LIMITES FINANCIEROS
		$financiero					= FinancieroHelper::retrieveFinancieros(" AND perfil_id = ". $profile . " AND financiero_smmlv = " . $this->variables['smmlv']);
		$financiero					= (count($financiero) > 0) ? $financiero[0] : new Financiero(); 

		//CREDITO HIPOTERCARIO
		$this->variables['pct_credito_hipotecario']				= $this->variables['salud_24']/$this->variables['salud_28'];
		$this->variables['pct_credito_hipotecario_porcentaje']	= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->variables['pct_credito_hipotecario']/$financiero->__get('financiero_final_sin_h') : 0;
		//% INGRESOS CREDITOS TC Y ROTATIVOS
		$this->variables['pct_credito_tc']						= $this->variables['salud_25'] /$this->variables['salud_28'];
		$this->variables['pct_credito_tc_porcentaje']			= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->variables['pct_credito_tc']/$financiero->__get('financiero_final_sin_h') : 0;
		//% INGRESOS EN OTROS CREDITOS
		$this->variables['pct_credito_otros']					= $this->variables['salud_23-1']/$this->variables['salud_28'];
		$this->variables['pct_credito_otros_porcentaje']		= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->variables['pct_credito_otros']/$financiero->__get('financiero_final_sin_h') : 0;
		//% INGRESOS EN OTROS CREDITOS
		$this->variables['pct_credito_acreencias']				= $this->variables['gastos_no_financieros']/$this->variables['salud_28'];
		$this->variables['pct_credito_acreencias_porcentaje']	= ($financiero->__get('financiero_final_'.$debType.'_h') != '') ? $this->variables['pct_credito_acreencias']/$financiero->__get('financiero_final_sin_h') : 0;
		//TOTAL
		$this->variables['pct_deudas_total']					= 	$this->variables['pct_credito_hipotecario'] + $this->variables['pct_credito_tc']	+ $this->variables['pct_credito_otros'];
		$this->variables['pct_nvivienda']						= 	$this->variables['pct_credito_tc']	+ $this->variables['pct_credito_otros'];
		//INDICES
		//VIVIENDA
		$temp1												= 5-((5-$this->calificacion['vivienda'])/$financiero->__get('financiero_credito_vivienda'))*$this->variables['pct_credito_hipotecario'];
		$temp2												= ($this->calificacion['vivienda']*($financiero->__get('financiero_credito_vivienda')+$this->calificacion['max_vivienda'])/$this->calificacion['max_vivienda'])-($this->calificacion['vivienda']/$this->calificacion['max_vivienda'])*$this->variables['pct_credito_hipotecario'];
		$temp												= ($this->variables['pct_credito_hipotecario'] <= $financiero->__get('financiero_credito_vivienda')) ? MAX(array( $temp1, 0)) : MAX(array($temp2 ,0));
		$this->variables['calificacion_vivienda']				= ($this->variables['pct_credito_hipotecario'] == 0) ? 0 : $temp;
		//TOTAL
		$temp1												= 5-((5-$this->calificacion['total'])/$financiero->__get('financiero_final_'.$debType.'_h'))*$this->variables['pct_deudas_total'];
		$temp2												= ($this->calificacion['total']*($financiero->__get('financiero_final_'.$debType.'_h')+$this->calificacion['max_total'])/$this->calificacion['max_total'])-(($this->calificacion['total']/$this->calificacion['max_total'])*$this->variables['pct_deudas_total']);
		$temp												= ($this->variables['pct_deudas_total'] <= $financiero->__get('financiero_final_'.$debType.'_h')) ? MAX(array( $temp1, 0)) : MAX(array($temp2 ,0));
		$this->variables['calificacion_total']				= ($this->variables['pct_deudas_total'] == 0) ? 0 : $temp;
		//NO VIVIENDA
		$temp1												= 5-((5-$this->calificacion['nvivienda'])/$financiero->__get('financiero_total_'.$debType.'_h'))*$this->variables['pct_nvivienda'];
		$temp2												= ($this->calificacion['nvivienda']*($financiero->__get('financiero_total_'.$debType.'_h')+$this->calificacion['max_nvivienda'])/$this->calificacion['max_nvivienda'])-($this->calificacion['nvivienda']/$this->calificacion['max_nvivienda'])*$this->variables['pct_nvivienda'];
		$temp												= ($this->variables['pct_nvivienda'] <= $financiero->__get('financiero_total_'.$debType.'_h')) ? MAX(array( $temp1, 0)) : MAX(array($temp2 ,0));
		$this->variables['calificacion_nvivienda']				= ($this->variables['pct_nvivienda'] == 0) ? 0 : $temp;
		
		$this->variables['calificacion_1']					= ($this->variables['calificacion_total']-$financiero->__get('financiero_final_'.$debType.'_h') > 0) ? 1 : 0;
		$this->variables['calificacion_2']					= (($this->variables['pct_credito_hipotecario']	+ + $this->variables['pct_credito_tc'] + $this->variables['pct_credito_otros'] + $this->variables['pct_credito_acreencias']	 ) < 0.95) ? 1 : 0;

		return $financiero->__get('financiero_final_'.$debType.'_h');
		
	}

	public function calculate()
	{
		if (isset($this->variables['salud_28-1']))
			$this->variables['salud_28']	= intval($this->variables['salud_28-1']) + intval($this->variables['salud_28-2']) + intval($this->variables['salud_28-3']);
		if (isset($this->variables['salud_26']))
			$this->variables['gastos_no_financieros']	= intval($this->variables['salud_26']) + intval($this->variables['salud_27']);
		
		$profile									= $this->getProfile();
		//TOTALIZA TODOS LOS GASTOS
		$this->variables['gastos_financieros']		= $this->variables['salud_24'] + $this->variables['salud_25'] + $this->variables['salud_23-1'];
		//LIMPIA LA VARIABLE DE CUOTAS
		$this->variables['cuotas']					= str_replace(" meses", "", $this->variables['cuotas']);
		//CALCULA EL MÁXIMO NIVEL DE CREDITO
		$this->variables['pct_maximo_creditos']		= $this->calculateNivel($profile);
		
		// MINIMO PORCENTAJE DE AHORRO
		$min_pct_ahorro								= new Dato(11);		
		if (!isset($this->variables['cuota_inicial']))
			$this->variables['cuota_inicial']		= 0;
		$this->variables['pct_gastos_no_credito'] 	= $this->variables['gastos_no_financieros'] /  $this->variables['salud_28'];
		$this->variables['pct_gastos_credito'] 		= $this->variables['gastos_financieros'] /  $this->variables['salud_28'];
		$this->variables['pct_gastos'] 				= $this->variables['pct_gastos_no_credito'] + $this->variables['pct_gastos_credito'];
		$tempArray									= array($this->variables['pct_maximo_creditos'], 1-$this->variables['pct_gastos_no_credito']-$min_pct_ahorro->__get('dato_valor')); 
		$this->variables['pct_maximo_creditos'] 	= MIN($tempArray);
		$tempArray									= array($this->variables['pct_maximo_creditos'] - $this->variables['pct_gastos_credito'], 0);
		$this->variables['pct_restante']		 	= MAX($tempArray);
		$tempArray									= array(0, 1 - $this->variables['pct_gastos_no_credito'] - $min_pct_ahorro->__get('dato_valor') - $this->variables['pct_gastos_credito']);
		$this->variables['pct_ahorro']			 	= MAX($tempArray);	
		$tempArray									= array(0, ($this->variables['pct_ahorro']*$this->variables['salud_28']));
		$this->variables['cuota_max']				= MAX($tempArray);
		$tempArray									= array(1, $this->variables['pct_restante'] * $this->variables['salud_28']);
		$this->variables['cuota_max_credito']		= MAX($tempArray);	
		$pct_gasto									= 0.95;
		//CUOTA INICIAL
		$tempArray									= array($this->variables['salud_28'] - ($this->variables['gastos_no_financieros'] + $this->variables['gastos_financieros']), 0);
		$this->variables['cuota_max_ahorro']		= MAX($tempArray);
		$this->variables['cuota_ini_calc']	 		= $this->variables['cuota_inicial'];
		//DATOS POR CREDITO
		$variables								= VariableHelper::retrieveVariables(" AND sueno_tipo = ".escape($this->variables['sueno_tipo']));		
		if (count($variables) > 0)
		{
			$tasa_mensual						= pow(1+$variables[0]->__get('tasa_mensual'), 1/12) - 1;
			$numero_max_cuotas					= $variables[0]->__get('plazo_maximo');
			$tiempo_max_ahorro					= $variables[0]->__get('tiempo_ahorro');
		}
		else //DEFAULT para que el modelo no muera
		{
			$tasa_mensual						= '0.0126703';
			$numero_max_cuotas					= 72;
			$tiempo_max_ahorro					= 60;			
		}
		//NEW SALIDAS
		$this->variables['ahorromes']			= 0;
		$this->variables['ahorrototal']			= 0;
		if ($this->variables['pct_gastos'] <= $pct_gasto)
			$cp	= 1;
		else
			$cp = 0;
		
		if ($this->variables['pct_restante'] > 0)
			$ne = 1;
		else
			$ne = 0;
		
		if ($cp == 1)
		{
			if ($ne == 1)
			{
				if ($this->variables['tiempo_sueno'] > 0)
				{
					$tasa_cdt								= new Dato(6);
					if ($this->variables['suen_ahorro'] == '1')
					{
						$tiempo	= str_replace(" meses", "", $this->variables['tiempo_sueno']);
						$this->variables['cuota_ini_calc'] 	= $this->variables['cuota_inicial'] + $this->FV($tasa_cdt->__get('dato_valor'), $tiempo, $this->variables['cuota_max_ahorro'] * ($this->variables['suen_porcentaje_ahorro']/100));
						$this->variables['ahorromes']		= $this->variables['cuota_max_ahorro'] * ($this->variables['suen_porcentaje_ahorro']/100);
						//echo $this->variables['ahorromes'];
						$this->variables['ahorrototal']		= ($this->variables['ahorromes'] != 0) ? $this->FV($tasa_cdt->__get('dato_valor'), $tiempo, $this->variables['cuota_max_ahorro'] * ($this->variables['suen_porcentaje_ahorro']/100)) : 0;
					}
					else
						$this->variables['cuota_ini_calc'] 		= $this->variables['cuota_inicial'];

					$this->variables['valor_credito'] 		= MAX(array($this->variables['valor_bien'] - $this->variables['cuota_ini_calc'], 0));
					
					$temp									= array();
					$temp['sort']							= 0;
					$temp['tipo']							= 'tiempo';
					$temp['tiempo']							= number_format($this->variables['tiempo_sueno'], 0, ",", ".");
					$temp['total']							= number_format($this->variables['cuota_ini_calc'], 0, ",", ".");
					$temp['ahorro']							= number_format($this->variables['cuota_max_ahorro'] * ($this->variables['suen_porcentaje_ahorro']/100), 0, ",", ".");					
					$text									= new Text(1, 'suen_');
					$temp['text']							= ' Si ahorras $'.$temp['ahorro'].' por '.$temp['tiempo'].' '.$text->__get('text_segunda').' '.$temp['total'].' '.$text->__get('text_tercera');
					if ($_POST['cuota_inicial'] > 0)
						$temp['text'] 							.= ' incluyendo tu cuota inicial de $'. number_format($this->variables['cuota_inicial']). " y $". number_format( $this->FV($tasa_cdt->__get('dato_valor'), $tiempo, $this->variables['cuota_max_ahorro'] * ($this->variables['suen_porcentaje_ahorro']/100))). ' de ahorro';
					$this->salida['tiempo']					= $temp;
				}
				else
				{
					$this->variables['cuota_ini_calc'] 		= $this->variables['cuota_inicial'];
					$this->variables['valor_credito'] 		= $this->variables['valor_bien'] - $this->variables['cuota_ini_calc'] ;				
					$this->variables['valor_credito'] 		= $this->variables['valor_bien'] - $this->variables['cuota_ini_calc'] ;				
					
				}
				
				$this->variables['valor_monto_credito']		= $this->PV($tasa_mensual, $numero_max_cuotas, $this->variables['cuota_max_credito']);			
				
				if ($this->variables['valor_monto_credito'] > $this->variables['valor_credito']) // SI EL VALOR DEL CREDITO ES INFERIOR AL MÁXIMO CREDITO QUE PODRÍA TENER EL USUARIO
				{
					
					
					$this->variables['minimo_permitido']	= $this->NPER($tasa_mensual, $this->variables['cuota_max_credito'], -$this->variables['valor_credito']);
					$this->variables['pago_minimo']			= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);	
					
					if (($this->variables['minimo_permitido'] == 0) &&  ($this->variables['pago_minimo'] == 0))
					{

						$temp									= array();
						$temp['sort']							= 0;					
						$temp['tipo']							= 'nonecesario';
						$text									= new Text(19, 'suen_');
						$temp['tiempo']							= 0;
						$temp['cuota']							= 0;
						$temp['total']							= 0;	
						$temp['text']							= "En ".$this->variables['tiempo_sueno'] ." y ahorrando $" . number_format($this->variables['cuota_max_ahorro'] * ($this->variables['suen_porcentaje_ahorro']/100)) . " mensualmente, puedes alcanzar tu meta sin endeudarte";
						if ($this->variables['valor_credito'] < $this->variables['cuota_ini_calc'])
						$temp['text']							.= ", y hasta te sobrar&iacute;an $".number_format($this->variables['cuota_ini_calc']-$this->variables['valor_bien']);
						$this->salida							= array();
						$this->salida['nonecesario']			= $temp;

					}
					else
					{
						$this->result	= 'positivo'; // EL RESULTADO ES POSITIVO PARA LA PERSONA
						
						if (($this->variables['minimo_permitido'] <= $this->variables['cuotas']) && ($this->variables['cuotas'] <= $numero_max_cuotas))
						{
							$this->variables['pago_sugerido']		= $this->PMT($tasa_mensual, $this->variables['cuotas'], -$this->variables['valor_credito']);
							$temp									= array();
							$temp['sort']							= number_format($this->variables['cuotas']);					
							$temp['tipo']							= 'positivo';
							$temp['tiempo']							= number_format($this->variables['cuotas'], 0, ",", ".");
							$temp['cuota']							= number_format($this->variables['pago_sugerido'], 0, ",", ".");
							$temp['total']							= number_format($this->variables['pago_sugerido']*$this->variables['cuotas'], 0, ",", ".");
							$text									= new Text(2, 'suen_');
							$temp['text']							= $text->__get('text_primera').' '.$temp['tiempo'].' '.$text->__get('text_segunda').' '.$temp['cuota'].' '.$text->__get('text_tercera').' '.$temp['total'];						
							$this->salida[round($temp['tiempo'])]	= $temp;					
						}
						else
						{
							$temp												= array();
							$temp['sort']										= 1;												
							$temp['tipo']										= 'nocando';
							$temp['tiempo']										= number_format($this->variables['cuotas'], 0, ",", ".");
							$temp['cuota']										= 0;
							$temp['total']										= 0;
							$text												= new Text(3, 'suen_');
							$temp['text']										= $text->__get('text_primera');											
							$this->salida[round($this->variables['cuotas'])]	= $temp;						
						}
						
						$temp									= array();
						$temp['tipo']							= 'positivo';
						$temp['sort']							= number_format($this->variables['minimo_permitido']);					
						$temp['tiempo']							= number_format($this->variables['minimo_permitido'], 0, ",", ".");
						$temp['cuota']							= number_format($this->variables['cuota_max_credito'], 0, ",", ".");
						$temp['total']							= number_format($this->variables['cuota_max_credito']*$this->variables['minimo_permitido'], 0, ",", ".");
						$text									= new Text(4, 'suen_');
						$temp['text']							= $text->__get('text_primera').' '.$temp['tiempo'].' '.$text->__get('text_segunda').' '.$temp['cuota'].' '.$text->__get('text_tercera').' '.$temp['total'];						
						$this->salida[round($temp['tiempo'])]	= $temp;	
						
						$this->variables['periodo_alternativo'] = ($this->variables['minimo_permitido'] + $numero_max_cuotas)/2;					
						$this->variables['pego_alternativo'] 	= $this->PMT($tasa_mensual, $this->variables['periodo_alternativo'], -$this->variables['valor_credito']);	
						
						$temp									= array();
						$temp['tipo']							= 'positivo';
						$temp['sort']							= number_format($this->variables['periodo_alternativo']);											
						$temp['tiempo']							= number_format($this->variables['periodo_alternativo'], 0, ",", ".");
						$temp['cuota']							= number_format($this->variables['pego_alternativo'], 0, ",", ".");
						$temp['total']							= number_format($this->variables['periodo_alternativo'] *  $this->variables['pego_alternativo'], 0, ",", ".");
						$text									= new Text(6, 'suen_');
						$temp['text']							= $text->__get('text_primera').' '.$temp['tiempo'].' '.$text->__get('text_segunda').' '.$temp['cuota'].' '.$text->__get('text_tercera').' '.$temp['total'];						
						$this->salida[round($temp['tiempo'])]	= $temp;	


						$temp									= array();
						$temp['sort']							= number_format($numero_max_cuotas);																	
						$temp['tipo']							= 'positivo';
						$temp['tiempo']							= number_format($numero_max_cuotas, 0, ",", ".");
						$temp['cuota']							= number_format($this->variables['pago_minimo'], 0, ",", ".");
						$temp['total']							= number_format($numero_max_cuotas*  $this->variables['pago_minimo'], 0, ",", ".");
						$text									= new Text(5, 'suen_');
						$temp['text']							= $text->__get('text_primera').' '.$temp['tiempo'].' '.$text->__get('text_segunda').' '.$temp['cuota'].' '.$text->__get('text_tercera').' '.$temp['total'];						
						$this->salida[round($temp['tiempo'])]	= $temp;	
					
					}
				}
				else // SI EL VALOR DEL CREDITO ES SUPERIOR AL MÁXIMO CREDITO QUE PODRÍA TENER EL USUARIO
				{
					
					$rentas								= new Dato(4);
					$tasa_mensual_cdt					= new Dato(6);
					$inflacion							= new Dato(8);					
					$porcentaje_credito					= new Dato(9);	
					$porcentaje_min_ahorro				= new Dato(11);	
					
					
					$this->variables['faltante']		= $this->variables['valor_credito'] - $this->variables['valor_monto_credito'];
					$this->variables['por_ahorrar']		= $this->nAhorro($this->variables['cuota_ini_calc'], $this->variables['cuota_max_ahorro'], $this->variables['faltante'], $rentas->__get('dato_valor'), $tasa_mensual_cdt->__get('dato_valor'),  $inflacion->__get('dato_valor'));

					if ($this->variables['por_ahorrar']	 <= $tiempo_max_ahorro) 
					{
						$temp									= array();
						$temp['sort']							= 0;					
						$temp['tipo']							= 'ahorro';
						$temp['tiempo']							= $this->variables['por_ahorrar']; // POR CUANTO TIEMPO TIENES QUE AHORRAR						
						$temp['ahorro_mes']						= $this->variables['cuota_max_ahorro']; // CUANTO TIENES QUE AHORRAR
						//
						$temp['ahorro_total']					= $this->FV($tasa_mensual_cdt->__get('dato_valor'), $this->variables['por_ahorrar'], $this->variables['cuota_max_ahorro']);
						$temp['plazomax']						= $numero_max_cuotas;
						$temp['creditocuota']					= $this->variables['cuota_max'];
						
						
						$text									= new Text(7, 'suen_');
						if ($this->variables['tiempo_sueno'] == 0)
							$temp['text']						= $text->__get('text_primera').' '.$temp['ahorro_mes'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['ahorro_total']. ' y en ese entonces podr&iacute;as pedir un cr&eacute;dito a '.$numero_max_cuotas.' meses con una cuota de $'.number_format($this->variables['cuota_max']).' mensuales.';
						else
							$temp['text']						= 'Adicionalmente tendr&iacute;as que ahorrar '.$temp['ahorro_mes'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' meses y as&iacute; alcanzar&iacute;as una cuota inicial de '.$temp['ahorro_total']. ' y en ese entonces podr&iacute;as pedir un cr&eacute;dito a '.$numero_max_cuotas.' meses con una cuota de $'.number_format($this->variables['cuota_max']).' mensuales.';						
						$this->salida['ahorro']					= $temp;
					}
					
					$this->variables['pago_minimo']				= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);	
					
					if (($this->variables['pago_minimo'] + $this->variables['gastos_financieros'])/($this->variables['pago_minimo'] + $this->variables['gastos_financieros'] + $this->variables['gastos_no_financieros']) < $this->calculateNivel($profile))
						$this->variables['ingreso_nuevo']		=	($this->variables['pago_minimo'] + $this->variables['gastos_financieros'] + $this->variables['gastos_no_financieros']) / (1 - $porcentaje_min_ahorro->__get('dato_valor'));
					else
						$this->variables['ingreso_nuevo']		=	(($this->variables['pago_minimo'] + $this->variables['gastos_financieros'])/$this->variables['pct_maximo_creditos'] + 	$this->variables['gastos_no_financieros']) / (1 - $porcentaje_min_ahorro->__get('dato_valor'));						
					
					//META MENOR
					$temp									= array();
					$temp['sort']							= 4;
					$temp['tipo']							= 'inferior';
					$temp['tiempo']							= $numero_max_cuotas;
					$temp['cuota']							= $this->variables['cuota_max_credito'];
					$temp['total']							= $this->variables['valor_monto_credito']+$this->variables['cuota_ini_calc'];
					$text									= new Text(9, 'suen_');
					if ($this->variables['tiempo_sueno'] == 0)
						$temp['text']							= $text->__get('text_primera').' '.$temp['total'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['cuota']. ' que es lo que actualmente tus finanzas te permiten pagar.';					
					else
						$temp['text']							= ' Si quieres la meta en '.$this->variables['tiempo_sueno'].', podr&iacute;as reducir su valor a $'.$temp['total'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['cuota']. ' que es lo que actualmente tus finanzas te permiten pagar.';										
					$this->salida['inferior']				= $temp;					
										
					//INCREMENTO DE DINERO										
					$temp									= array();
					$temp['sort']							= 2;		
					//echo $this->variables['ingreso_nuevo'];
					$temp['tipo']							= 'increment';
					$temp['tiempo']							= $numero_max_cuotas;
					$temp['cuota']							= $this->variables['ingreso_nuevo'];
					$temp['total']							= $this->variables['pago_minimo'];
					$text									= new Text(10, 'suen_');
					$temp['text']							= $text->__get('text_primera').' '.number_format(-$this->variables['salud_28']+$this->variables['ingreso_nuevo'], 0, ",", "."). ' de $'.number_format($this->variables['salud_28'], 0, ",", ".").' a $'.number_format($this->variables['ingreso_nuevo'], 0, ",", ".").', '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['total'];					
					$this->salida['increment']				= $temp;					
					
					//DECRECER CONSUMO
					$this->variables['cuota-max-plazo'] 	= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);
					$this->variables['cuota-endeudamiento'] = $this->variables['salud_28']*$this->variables['pct_maximo_creditos']-$this->variables['gastos_financieros'];	
					$this->variables['objetivo-red']		= $this->variables['cuota-max-plazo']  - $this->variables['cuota-endeudamiento'];
					$temp									= $this->variables['salud_28']-$this->variables['salud_28']*$this->variables['pct_maximo_creditos']-$this->variables['gastos_no_financieros'];					
					$this->variables['objetivo-red-nf']		= MIN($temp, 0);
					$this->variables['objetivo-red-total']	= $this->variables['objetivo-red'] + $this->variables['objetivo-red-nf'];

					if (($this->variables['salud_28']*$this->variables['pct_maximo_creditos']) < $this->variables['cuota-max-plazo'])
					{
						
						$temp									= array();
						$temp['sort']							= 3;										
						$temp['tipo']							= 'reduce';
						$temp['tiempo']							= $this->variables['objetivo-red'];
						$temp['cuota']							= number_format($this->variables['objetivo-red-nf'], 0, ",", ".");
						$temp['total']							= number_format($this->variables['objetivo-red-total'], 0, ",", ".");
						$temp['gastos_financieros']				= number_format($this->variables['gastos_financieros'], 0, ",", ".");	
						$temp['plazomax']						= $numero_max_cuotas;
						$temp['cuota-mes']						= $this->variables['objetivo-red'] + $this->variables['salud_28']*$this->variables['pct_maximo_creditos'] - $this->variables['gastos_financieros'];
; 
						
						$temp['reduccion-gastos']				= number_format(-$this->variables['objetivo-red-total']+$this->variables['gastos_financieros'], 0, ",", ".");	
						$text									= new Text(20, 'suen_');
						if ($temp['cuota'] != 0)
							$temp['text']							= $text->__get('text_primera').' $'.$temp['total'].' '.$text->__get('text_segunda').' $'.$temp['tiempo'].' '.$text->__get('text_tercera').' $'.$temp['cuota'];					
						else
							$temp['text']							= $text->__get('text_primera').' $'.$temp['total'].' '.$text->__get('text_segunda').' pasando de $'.number_format($this->variables['gastos_financieros'], 0 , ',', '.')." a $".$temp['reduccion-gastos'];					
						$this->salida['reduce']						= $temp;					
					}
					
				}
			}
			
			else
			{

				$this->variables['cuota_ini_calc'] 		= $this->variables['cuota_inicial'];
				$this->variables['valor_credito'] 		= $this->variables['valor_bien'] - $this->variables['cuota_ini_calc'] ;				

							
				$rentas								= new Dato(4);
				$tasa_mensual_cdt					= new Dato(6);
				$inflacion							= new Dato(8);	
				$porcentaje_min_ahorro				= new Dato(11);	
				
				$this->variables['por_ahorrar']		= $this->nAhorro($this->variables['cuota_ini_calc'], $this->variables['cuota_max'], $this->variables['valor_credito'], $rentas->__get('dato_valor'), $tasa_mensual_cdt->__get('dato_valor'),  $inflacion->__get('dato_valor'));

				if ($this->variables['por_ahorrar']	 <= $tiempo_max_ahorro->__get('datos_valor'))
				{
					$temp									= array();
					$temp['sort']							= 0;					
					$temp['tipo']							= 'ahorro';
					$temp['tiempo']							= $this->variables['por_ahorrar']; // POR CUANTO TIEMPO TIENES QUE AHORRAR						
					$temp['ahorro_mes']						= $this->variables['cuota_max_ahorro']; // CUANTO TIENES QUE AHORRAR
					//
					$temp['ahorro_total']					= $this->FV($tasa_mensual_cdt->__get('dato_valor'), $this->variables['por_ahorrar'], $this->variables['cuota_max_ahorro']);
					$temp['plazomax']						= $numero_max_cuotas;
					$temp['creditocuota']					= $this->variables['cuota_max'];
					
					
					$text									= new Text(7, 'suen_');
					if ($this->variables['tiempo_sueno'] == 0)
						$temp['text']						= $text->__get('text_primera').' '.$temp['ahorro_mes'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['ahorro_total']. ' y en ese entonces podr&iacute;as pedir un cr&eacute;dito a '.$numero_max_cuotas.' meses con una cuota de $'.number_format($this->variables['cuota_max']).' mensuales.';
					else
						$temp['text']						= 'Adicionalmente tendr&iacute;as que ahorrar '.$temp['ahorro_mes'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' meses y as&iacute; alcanzar&iacute;as una cuota inicial de '.$temp['ahorro_total']. ' y en ese entonces podr&iacute;as pedir un cr&eacute;dito a '.$numero_max_cuotas.' meses con una cuota de $'.number_format($this->variables['cuota_max']).' mensuales.';						
					$this->salida['ahorro']					= $temp;
				}

				
				//Abono deudas
				$temp									= array();
				$temp['tipo']							= 'deudas';
				$temp['sort']							= 0;									
				$temp['tiempo']							= 0;
				$temp['cuota']							= $this->variables['cuota_max'];
				$temp['total']							= $this->variables['cuota_max'];
				$text									= new Text(14, 'suen_');
				$temp['text']							= $text->__get('text_primera').$temp['total'];													
				$this->salida['deudas']					= $temp;
						
				$this->variables['pago_minimo']		= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);

				if (($this->variables['pago_minimo'] + $this->variables['gastos_financieros'])/($this->variables['pago_minimo'] + $this->variables['gastos_financieros'] + $this->variables['gastos_no_financieros']) < $this->variables['pct_maximo_creditos'])
					$this->variables['ingreso_nuevo']		=	($this->variables['pago_minimo'] + $this->variables['gastos_financieros'] + $this->variables['gastos_no_financieros']) / (1 - $porcentaje_min_ahorro->__get('dato_valor'));
				else
					$this->variables['ingreso_nuevo']		=	(($this->variables['pago_minimo'] + $this->variables['gastos_financieros'])/$this->variables['pct_maximo_creditos'] + 	$this->variables['gastos_no_financieros']) / (1 - $porcentaje_min_ahorro->__get('dato_valor'));						

				//incrementar ingresos
				$temp									= array();
				$temp['tipo']							= 'increment';
				$temp['sort']							= 0;													
				$temp['tiempo']							= number_format($numero_max_cuotas, 0, ",", ".");
				$temp['cuota']							= number_format($this->variables['ingreso_nuevo'], 0, ",", ".");
				$temp['total']							= number_format($this->variables['pago_minimo'], 0, ",", ".");
				$text									= new Text(15, 'suen_');
				$temp['text']							= $text->__get('text_primera').' '.$temp['cuota'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['total'];					
				$this->salida['increment']				= $temp;	

				//DECRECER CONSUMO
				$this->variables['cuota-max-plazo'] 	= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);
				$this->variables['cuota-endeudamiento'] = $this->variables['salud_28']*$this->variables['pct_maximo_creditos']-$this->variables['gastos_financieros'];	
				$this->variables['objetivo-red']		= $this->variables['cuota-max-plazo']  - $this->variables['cuota-endeudamiento'];
				$temp									= $this->variables['salud_28']-$this->variables['salud_28']*$this->variables['pct_maximo_creditos']-$this->variables['gastos_no_financieros'];					
				$this->variables['objetivo-red-nf']		= MIN($temp, 0);
				$this->variables['objetivo-red-total']	= $this->variables['objetivo-red'] + $this->variables['objetivo-red-nf'];
				
				if (($this->variables['salud_28']*$this->variables['pct_maximo_creditos']) > $this->variables['cuota-max-plazo'])
				{
					$temp									= array();
					$temp['sort']							= 4;										
					$temp['tipo']							= 'reduce';
					$temp['tiempo']							= number_format($this->variables['objetivo-red'], 0, ",", ".");
					$temp['cuota']							= number_format($this->variables['objetivo-red-nf'], 0, ",", ".");
					$temp['total']							= number_format($this->variables['objetivo-red-total'], 0, ",", ".");
					$temp['cuota-mes']						= $this->variables['objetivo-red'] + $this->variables['salud_28']*$this->variables['pct_maximo_creditos'] - $this->variables['gastos_financieros']; 
					$temp['plazomax']						= $numero_max_cuotas;
					$text									= new Text(20, 'suen_');
					if ($temp['cuota'] != 0)
						$temp['text']							= $text->__get('text_primera').' $'.$temp['total'].' '.$text->__get('text_segunda').' $'.$temp['tiempo'].' '.$text->__get('text_tercera').' $'.$temp['cuota'];					
					else
						$temp['text']							= $text->__get('text_primera').' $'.$temp['total'].' '.$text->__get('text_segunda').' $'.$temp['tiempo'].' ';					
					$this->salida['reduce']					= $temp;					
				}
				
			}
		}
		else
		{
			$porcentaje_min_ahorro				= new Dato(11);	
			
			$this->variables['valor_credito'] 		= $this->variables['valor_bien'] - $this->variables['cuota_ini_calc'];
			

			$temp									= array();
			$temp['tipo']							= 'negativo';
			$temp['sort']							= 0;												
			$temp['tiempo']							= 0;
			$temp['cuota']							= 0;
			$temp['total']							= 0;			
			$text									= new Text(17, 'suen_');
			$temp['text']							= $text->__get('text_primera');					
			$this->salida['negativo']				= $temp;
			
			$this->variables['pago_minimo']		= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);
			
			

			if (($this->variables['pago_minimo'] + $this->variables['gastos_financieros'])/($this->variables['pago_minimo'] + $this->variables['gastos_financieros'] + $this->variables['gastos_no_financieros']) < $this->variables['pct_maximo_creditos'])
				$this->variables['ingreso_nuevo']		=	($this->variables['pago_minimo'] + $this->variables['gastos_financieros'] + $this->variables['gastos_no_financieros']) / (1 - $porcentaje_min_ahorro->__get('dato_valor'));
			else
				$this->variables['ingreso_nuevo']		=	(($this->variables['pago_minimo'] + $this->variables['gastos_financieros'])/$this->variables['pct_maximo_creditos'] + 	$this->variables['gastos_no_financieros']) / (1 - $porcentaje_min_ahorro->__get('dato_valor'));						

			//INCREMENTAR INGRESO
			$temp									= array();
			$temp['tipo']							= 'increment';
			$temp['sort']							= 0;												
			$temp['tiempo']							= number_format($numero_max_cuotas, 0, ",", ".");
			$temp['cuota']							= number_format($this->variables['ingreso_nuevo'], 0, ",", ".");
			$temp['total']							= number_format($this->variables['pago_minimo'], 0, ",", ".");
			$text									= new Text(18, 'suen_');
			$temp['text']							= $text->__get('text_primera').' '.$temp['cuota'].' '.$text->__get('text_segunda').' '.$temp['tiempo'].' '.$text->__get('text_tercera').' '.$temp['total'];					
			$this->salida['increment']				= $temp;	

			//DECRECER CONSUMO
			$this->variables['cuota-max-plazo'] 	= $this->PMT($tasa_mensual, $numero_max_cuotas, -$this->variables['valor_credito']);
			$this->variables['cuota-endeudamiento'] = $this->variables['salud_28']*$this->variables['pct_maximo_creditos']-$this->variables['gastos_financieros'];	
			$this->variables['objetivo-red']		= $this->variables['cuota-max-plazo']  - $this->variables['cuota-endeudamiento'];
			$temp									= $this->variables['salud_28']-$this->variables['salud_28']*$this->variables['pct_maximo_creditos']-$this->variables['gastos_no_financieros'];					
			$this->variables['objetivo-red-nf']		= MIN($temp, 0);
			$this->variables['objetivo-red-total']	= $this->variables['objetivo-red'] + $this->variables['objetivo-red-nf'];
			
			if (($this->variables['salud_28']*$this->variables['pct_maximo_creditos']) > $this->variables['cuota-max-plazo'])
			{
				$temp									= array();
				$temp['sort']							= 4;										
				$temp['tipo']							= 'reduce';
				$temp['tiempo']							= number_format($this->variables['objetivo-red'], 0, ",", ".");
				$temp['cuota']							= number_format($this->variables['objetivo-red-nf'], 0, ",", ".");
				$temp['total']							= number_format($this->variables['objetivo-red-total'], 0, ",", ".");
				$temp['plazomax']						= $numero_max_cuotas;
				$temp['cuota-mes']						= $this->variables['objetivo-red'] + $this->variables['salud_28']*$this->variables['pct_maximo_creditos'] - $this->variables['gastos_financieros']; 
				
				$text									= new Text(20, 'suen_');
				if ($temp['cuota'] != 0)
					$temp['text']							= $text->__get('text_primera').' $'.$temp['total'].' '.$text->__get('text_segunda').' $'.$temp['tiempo'].' '.$text->__get('text_tercera').' $'.$temp['cuota'];					
				else
					$temp['text']							= $text->__get('text_primera').' $'.$temp['total'].' '.$text->__get('text_segunda').' $'.$temp['tiempo'].' ';					
				$this->salida['reduce']					= $temp;					
			}
			
		}
		$tmc	=	new Dato(2);
		$max	=	new Dato(10);
		
		$this->variables['calificacion_3']		= ($this->PV($tmc->__get('dato_valor'), $max->__get('dato_valor'), $this->variables['cuota_max_credito']) > $this->variables['valor_credito']) ? 1 : 0;		

		if (!isset($this->variables['show_work']))
		{
			echo '<pre>';
			print_r ($this->variables);
			print_r ($this->salida);
			echo '</pre>';
		}
		return $this->salida;
	}
	
	public function getMsg()
	{
		$msg	= '';
		
		if (($this->variables['calificacion_1']+ $this->variables['calificacion_2'] + $this->variables['calificacion_3']) == 3)
			$msg = "Tienes cupo para endeudarte, tienes una forma de consumo aceptable y tu sueño esta en tus manos";
		else if (($this->variables['calificacion_1']+ $this->variables['calificacion_2'] + $this->variables['calificacion_3']) == 2)
		{
			if ($this->variables['calificacion_1']+ $this->variables['calificacion_2'] == 2)
				$msg = "Aunque tienes la posibilidad de cumplir tu sueño, este en particular está temporalmente más allá de tus posibilidades inmediatas, pero tienes capacidad para endeudarte y tu nivel de consumo es aceptable. Sin embargo, te ofrecemos varias posibilidades para que lo alcances.";
			if ($this->variables['calificacion_1']+ $this->variables['calificacion_3'] == 2)
				$msg = "Puedrias lanzarte a cumplir tu sueno ahora, sin embargo, tus habitos de consumo pueden traerte problemas en el corto plazo y truncar el disfrute de tu sueño, te recomendamos alterar un poco este aspecto, por otro lado, tienes cupo para endeudarte. Te damos algunas alternativas para cumplir tu sueno ahora:";
			if ($this->variables['calificacion_2']+ $this->variables['calificacion_3'] == 2)
				$msg = "Tu endeudamiento es muy elevado, esto tiene varios inconvenientes, aplaza la posibilidad de ejecucion de tu sueno, y te crea varios inconvenientes en tu vida y salud financiera. Si quieres usar el sistema financiero para agilizar la consecucion de tu sueno debes mejorar este aspecto, aunque tu forma de consumir es aceptable. Te recomendamos algunas alternativas:";		
		}
		else
		{
			if ($this->variables['calificacion_1'] == 1)
				$msg = "Tienes dos piedritas en el camino hasta tu sueno, primero, este es un poco elevado para tus posibilidades, y segundo, tu forma de consumir puede impedir que puedas obtenerlo y disfrutarlo, aunque tienes capacidad para endeudarte. A continuacion veras algunas alternativas que te ayudaran al respecto:";
			else if ($this->variables['calificacion_2'] == 1)
				$msg = "Tu capacidad de crédito no es suficiente para solicitar un nuevo crédito, pero existen otras alternativas:  ";
			else
				$msg = "Tu endeudamiento es muy elevado, esto tiene varios inconvenientes, aplaza la posibilidad de ejecucion de tu sueno, y te crea varios inconvenientes en tu vida y salud financiera. Si quieres usar el sistema financiero para agilizar la consecucion de tu sueno debes mejorar este aspecto. Por otra parte, la forma en que consumes puede afectar la obtencion y disfrute de tu sueno, debes replantear tu forma de consumo. Te recomendamos algunas alternativas:";
		}
		return $msg;
	}
	
	public function getResult()
	{
		return $this->result;
	}

	public function getValue($value)
	{
		return $this->variables[$value];
	}
	
}
?>