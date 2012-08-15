<?php
class CreditosValue
{
	protected $creditos;
	protected $filter;
	protected $orFilter;
	protected $evaluacion;
	protected $profile;
	protected $income;
	protected $loan;
	protected $term;
	protected $results;
	protected $channel_1;
	protected $channel_2;
	protected $channel_3;

	public function __construct()
	{
		$creditos 		= array();
		$filter 		= array();
		$orFilter 		= "";
		$evaluacion		= array();
		$califications 	= array();
	}
	
	public function addFilter($filter, $value1, $value2 = false)
	{
		switch ($filter)
		{
			case 'age':
				$this->filter[$filter]	= ' AND '. $value1 . ' BETWEEN condicion_edad_min AND condicion_edad_max';
			break;
			case 'income':
				$this->filter[$filter]	= ' AND '. $value1 . ' BETWEEN condicion_ingresos_min AND condicion_ingresos_max';
				$this->income			= $value1;
			break;
			case 'family':
				$this->filter[$filter]	= ' AND condicion_ingresos_familiar = "' .$value1 . '"';	
			break;	
			case 'family-income':
				//$this->filter[$filter]	= (isset($this->filter[$filter])) ? $this->filter[$filter] + $value1 : $value1;
			break;			
			case 'credit-history':
				$this->filter[$filter]	= ' AND condicion_experiencia_crediticia = "' .$value1 . '"';	
			break;		
			case 'occupation':
				switch ($value1)
				{
					case '1':
						$this->filter[$filter]	= ' AND condicion_pensionado = 1';
					break;
					case '2':
						$this->filter[$filter]	= ' AND condicion_independiente = 1';
					break;	
					case '3':
						$this->filter[$filter]	= ' AND condicion_estudiante = 1';
					break;	
					case '4':
						$this->filter[$filter]	= ' AND condicion_rentista = 1';
					break;		
					case '5':
						$this->filter[$filter]	= ' AND condicion_empleado = 1';
					break;							
				}
				$this->profile	= $value1;
			break;
			case 'term':
				$this->filter[$filter]	= ' AND '. $value1 . ' BETWEEN condicion_plazo_minimo AND condicion_plazo_maximo';
				$this->term				= $value1;
			break;		
			case 'loan':
				$this->filter[$filter]	= ' AND '. $value1 . ' BETWEEN condicion_monto_minimo AND condicion_monto_maximo';
				$this->loan				= $value1;
			break;	
			case 'study-level':
				switch ($value1)
				{
					case '1':
						$this->filter[$filter]	= ' AND condicion_bachillerato = 1';
					break;
					case '2':
						$this->filter[$filter]	= ' AND condicion_tecnico = 1';
					break;	
					case '3':
						$this->filter[$filter]	= ' AND condicion_pregrado = 3';
					break;	
					case '4':
						$this->filter[$filter]	= ' AND condicion_especializacion = 4';
					break;		
					case '5':
						$this->filter[$filter]	= ' AND condicion_maestria = 5';
					break;							
				}			
			break;				
			case 'credit-history':
				if ($value1 == 'SI')
					$this->filter[$filter]	= ' AND condicion_experiencia_crediticia <> "Si"';	
			break;	
			case 'occupation-extra':
				$filter1 = '';
				if ($value1 == '2')
					$filter1	= '';
				else
					$filter1	= ' AND condicion_medico <> "Si"';
				if ($value1 == '3')
					$filter1	.= ' ';
				else
					$filter1	.= ' AND condicion_empleado_publico <> "Si"';			
				$this->filter[$filter] = $filter1;
			break;
			case 'codeudor':
				$this->filter[$filter] = " AND 30-1 <> 'Si'";
			break;
			case 'credit_time':
				$this->filter[$filter] = " AND condicion_experiencia_crediticia = '".$value1."'";
			break;			
			case 'gender':
				if ($value1 == 'Hombre')
					$this->filter[$filter] = " AND condicion_mujer <> 'Si'";
				if ($value1 == 'Mujer')
					$this->filter[$filter] = " AND condicion_hombre <> 'Si'";					
			break;	
			case 'channel-1':
				$this->channel_1 = $value1;				
			break;				
			case 'channel-2':
				$this->channel_2 = $value1;				
			break;				
			case 'channel-3':
				$this->channel_3 = $value1;				
			break;							
			default:
			
			break;
		}
	}
	
	public function createOrFilter()
	{
		$first 	= true;
		$sql	= '';
		while($row = mysql_fetch_assoc($this->creditos["query"]))	
		{
			$sql .= ($first) ? " AND (" : " OR ";			
			$first = false;
				$sql .= ' credito_id = "' . $row["credito_id"] . '"';
		}
		$sql 	.= ($this->creditos['num_rows'] > 0) ? ')' : 'AND 1=0';
		$this->orFilter	= $sql; 
	}
	
	public function getWithFilters()
	{
		$sql	= '';
		if (count($this->filter) > 0)
		{
			foreach ($this->filter as $key=>$value)
				$sql .= $value;
		}
		$this->creditos	= CreditoCondicionHelper::selectCreditoCondiciones(" AND cr_condiciones.credito_id = cr_creditos.credito_codigo " . $sql, ', cr_creditos');
		$this->createOrFilter();
		$this->getResults();
		return $this->creditos;
	}
	
	public function getResults()
	{
		$this->results		= CreditoSolicitudHelper::selectCreditoSolicitudes(" AND cr_solicitudes.credito_id = cr_creditos.credito_codigo " . $this->orFilter, ', cr_creditos');
	}
	
	public function Apertura()
	{
		$results		= &$this->results;
		$documents		= DocumentHelper::selectDocuments();
		$apertura		= array();
		$puntosArr		= array();
		//CALCULA LOS PUNTOS POR PERFIL
		while($row = mysql_fetch_assoc($results["query"]))
		{
			$puntos	= 0;
			switch ($this->profile):
				case 1:
					$type	= 'solicitud_pensionado_';					
				break;
				case 2:
					$type	= 'solicitud_independiente_';					
				break;
				case 3:
					$type	= 'solicitud_dependiente_';					
				break;	
				case 3:
					$type	= 'solicitud_rentista_';					
				break;	
				default:
					$type	= 'solicitud_empleado_';					
				break;					
			endswitch;
			while($document = mysql_fetch_assoc($documents["query"]))
			{
				
				if (isset($row[$type.$document['document_id']]))
				{
					if ($row[$type.$document['document_id']] == 'Obligatorio')
					{
						$puntos += $document['document_pints'];
					}
				}
			}
			$puntosArr[]										= $puntos;
			$apertura[$row['credito_id']]['tramites_puntos'] 	= $puntos;
		}	
		mysql_data_seek($results["query"], 0);
		//CALIFICA TRAMITES
		while($row = mysql_fetch_assoc($results["query"]))
		{		
				if (DV($apertura[$row['credito_id']]['tramites_puntos'], $puntosArr) < 0.5);
				{
					if ($apertura[$row['credito_id']]['tramites_puntos'] > AVERAGE($puntosArr))
						$apertura[$row['credito_id']]['tramites_puntos']	= max($puntosArr);
					else
						$apertura[$row['credito_id']]['tramites_puntos'] 	= min($puntosArr);
				}
				$apertura[$row['credito_id']]['tramites_calif']	=  5- (5 *  NORMALIZE($apertura[$row['credito_id']]['tramites_puntos'], $puntosArr)) ;
		}	
		mysql_data_seek($results["query"], 0);
		//Extrae tiempos, aviso y canales de desembolso, 
		$tiempos	= array();
		$canales	= array();		
		while($row = mysql_fetch_assoc($results["query"]))
		{
			$tramites	= CreditoTramiteHelper::selectCreditoTramites(" AND credito_id = '".$row['credito_id'] . "' ORDER by tramite_fecha DESC");
			{
			if ($tramites['num_rows'] > 0)
				$tramite	= $tramites['query'];
				$row 		= mysql_fetch_assoc($tramite);
				$tiempos[]	= $row['tramite_dias_aprobacion'] + $row['tramite_dias_desembolso'];
				$apertura[$row['credito_id']]['tiempos_puntos']		= $row['tramite_dias_aprobacion'] + $row['tramite_dias_desembolso'];
				$apertura[$row['credito_id']]['avisan_desembolso']	= ($row['tramite_desembolso_aviso'] == 1) ? 5 : 0;
				$apertura[$row['credito_id']]['canales_desembolso']	= 0;
				if ($row['tramite_desembolso_efectivo'] == 1) $apertura[$row['credito_id']]['canales_desembolso']++;
				if ($row['tramite_desembolso_cheque'] == 1) $apertura[$row['credito_id']]['canales_desembolso']++;
				if ($row['tramite_desembolso_consignacion'] == 1) $apertura[$row['credito_id']]['canales_desembolso']++;
				if ($row['tramite_desembolso_transferencia'] == 1) $apertura[$row['credito_id']]['canales_desembolso']++;
				if ($row['tramite_desembolso_tercero'] == 1) $apertura[$row['credito_id']]['canales_desembolso']++;
			}
		}
		mysql_data_seek($results["query"], 0);
		//Califica tiempos
		while($row = mysql_fetch_assoc($results["query"]))
		{
				if (DV($apertura[$row['credito_id']]['tiempos_puntos'], $tiempos) < 0.5);
				{
					if ($apertura[$row['credito_id']]['tiempos_puntos'] > AVERAGE($tiempos))
						$apertura[$row['credito_id']]['tiempos_puntos']	= max($tiempos);
					else
						$apertura[$row['credito_id']]['tiempos_puntos'] = min($tiempos);
				}
				$apertura[$row['credito_id']]['tiempos_calif']	=  5- (5 *  NORMALIZE($apertura[$row['credito_id']]['tiempos_puntos'], $tiempos)) ;			
		}
		//PONDERADO
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"]))
		{
			$tramites	= $apertura[$row['credito_id']]['tramites_calif']	 	* 0.5;
			$avisan		= $apertura[$row['credito_id']]['avisan_desembolso'] 	* 0.05;
			$canales	= $apertura[$row['credito_id']]['canales_desembolso'] 	* 0.05;
			$tiempos	= $apertura[$row['credito_id']]['tiempos_calif'] 		* 0.4;
			$apertura[$row['credito_id']]['calificacion_final']	= $tramites + $avisan + $canales + $tiempos;
		}
		echo '<pre>';
		print_r($apertura);
		echo '</pre>';		
	}
	
	public function Costo()
	{
		//PROGRAMAR
		$results		= &$this->results;
		$costo			= array();
		$costosArr		= array();
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"]))
		{
			$rand			= rand(1, 5)+rand(0, 9)/10+rand(0, 9)/100;
			$costosArr[]	= $rand;
			$costo[$row['credito_id']]['tir']	= $rand;
			
		}
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"]))
		{
			$costo[$row['credito_id']]['calificacion']	= 5- (5 *  NORMALIZE($costo[$row['credito_id']]['tir'], $costosArr));
		}
		echo '<pre>';
		print_r ($costo);
		echo '</pre>';
	}
	
	public function Facilidades()
	{
		$results		= &$this->results;
		$opciones		= array();
		$facilidades	= array();
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"])) //EXTRAE INFO DE ECONOMICO
		{
			$economico	= CreditoEconomicoHelper::selectCreditoEconomicos(" AND credito_id = '".$row['credito_id'] . "' ORDER by economico_fecha DESC");
			if ($economico['num_rows'] > 0)
			{
				$economico 	= &$economico['query'];
				$datos		= mysql_fetch_assoc($economico);
				$facilidades[$row['credito_id']]['periodicidad_diferente']	= ($datos['economico_acuerdo_pagos'] == 'Si') ? 5 : 0; //VERIFICAR
				$facilidades[$row['credito_id']]['opciones_mes']				= rand(0,10);	//VERIFICAR
				$opciones[]	= rand(0,10);
			}
			else
			{
				$facilidades[$row['credito_id']]['periodicidad_diferente']	= 0;//VERIFICAR
				$facilidades[$row['credito_id']]['opciones_mes']			= 1;	//VERIFICAR
				$opciones[]	= 1;				
			}
		}
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"])) //CALIFICA LAS OPCIONES
		{
			
			if (DV($facilidades[$row['credito_id']]['opciones_mes'], $opciones) < 0.5);
			{
				if ($facilidades[$row['credito_id']]['opciones_mes'] > AVERAGE($opciones))
					$facilidades[$row['credito_id']]['opciones_mes']	= max($opciones);
				else
					$facilidades[$row['credito_id']]['opciones_mes'] = min($opciones);
			}
			$facilidades[$row['credito_id']]['opciones_calif']		=  (5 *  NORMALIZE($facilidades[$row['credito_id']]['opciones_mes'], $opciones)) ;		
			$facilidades[$row['credito_id']]['versatilidad_calif']	= ($facilidades[$row['credito_id']]['periodicidad_diferente'] * 0.2) + ($facilidades[$row['credito_id']]['opciones_calif'] * 0.8);
		}			
		mysql_data_seek($results["query"], 0);
		$canalesArr	= array();
		while($row = mysql_fetch_assoc($results["query"])) //TRAE LOS CANALES
		{
			$canales	= CreditoCanalHelper::selectCreditoCanals(" AND credito_id = '".$row['credito_id'] . "' ORDER by canal_fecha DESC");
			if ($canales['num_rows'] > 0)
			{
				$canales 	= &$canales['query'];
				$datos		= mysql_fetch_assoc($canales);
			}	
			$rand			= rand(1, 5)+rand(0, 9)/10+rand(0, 9)/100;
			$canalesArr[]	= $rand;
			$facilidades[$row['credito_id']]['canales']	= $rand;			
		}				
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"])) //CALIFICA LOS CANALES
		{
			
			$facilidades[$row['credito_id']]['canales_calificacion']	= 5- (5 *  NORMALIZE($facilidades[$row['credito_id']]['canales'], $canalesArr));
		}		
		mysql_data_seek($results["query"], 0);
		$extractos	= array();
		while($row = mysql_fetch_assoc($results["query"])) //TRAE LOS CANALES DE EXTRACTOS
		{
			$tramites	= CreditoTramiteHelper::selectCreditoTramites(" AND credito_id = '".$row['credito_id'] . "' ORDER by tramite_fecha DESC");			
			$facilidades[$row['credito_id']]['canales_calificacion']	= 5- (5 *  NORMALIZE($facilidades[$row['credito_id']]['canales'], $canalesArr));
			if ($tramites['num_rows'] > 0)
			{
				$tramite	= $tramites['query'];
				$row 		= mysql_fetch_assoc($tramite);
				$facilidades[$row['credito_id']]['extratos']	= 0;
				if ($row['tramite_correo_fisico'] == 'Si') 	$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_email_correo'] == 'Si') 	$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_internet'] == 'Si') 		$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_audio'] == 'Si') 			$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_movil'] == 'Si') 			$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_oficina'] == 'Si') 		$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_cajero'] == 'Si') 		$facilidades[$row['credito_id']]['extratos']++;
				if ($row['tramite_corresponsal'] == 'Si') 	$facilidades[$row['credito_id']]['extratos']++;
				$extractos[]	= $facilidades[$row['credito_id']]['extratos'];
			}
		}	
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"])) //TRAE LOS CANALES DE EXTRACTOS
		{
			$facilidades[$row['credito_id']]['extratos_calificacion']	= 5- (5 *  NORMALIZE($facilidades[$row['credito_id']]['extratos'], $extractos));
			$facilidades[$row['credito_id']]['ponderado']				= ($facilidades[$row['credito_id']]['versatilidad_calif'] * 0.25) +  ($facilidades[$row['credito_id']]['canales_calificacion'] * 0.65) + ($facilidades[$row['credito_id']]['extratos_calificacion'] * 0.1);
			 
		}			
		echo '<pre>';
		print_r ($facilidades);
		echo '</pre>';		
	}
	
	public function Proteccion()
	{
		$results		= &$this->results;
		$opciones		= array();
		$proteccion		= array();
		mysql_data_seek($results["query"], 0);
		while($row = mysql_fetch_assoc($results["query"])) //TRAE LOS CANALES DE EXTRACTOS
		{
			$proteccion[$row['credito_id']]['calificacion_final']	= rand(1, 5)+rand(0, 9)/10+rand(0, 9)/100;
		}
		echo '<pre>';
		print_r ($proteccion);
		echo '</pre>';			
	}	
}

?>