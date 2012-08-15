<?php	
class TCreditosValue
{
	var $items;
	var $user;
	var $filter;
	var $income;
	var $field;
	var $table;
	var $orFilter;
	var $showWord;
	var $productId;
	
	public function __construct(&$user, $product, $showWork = true)
	{
		$this->field	= 'tarjeta_id';
		$this->table	= 'tarj_tarjetas';		
		$this->user		= $user; 
		$this->items 	= array();
		$this->filter 	= array();
		$this->income	= 0;		
		$this->orFilter = "";
		$this->showWork	= $showWork;
		$this->productId	= "";
		$evaluacion		= array();
		$califications 	= array();
		if ($product == 2)
			$this->productId = " AND tarjeta_tipo_producto_id = 1";
		else if ($product == 44)
			$this->productId = " AND tarjeta_tipo_producto_id = 2";
	}
	public function addFilter($filter, $value1, $value2 = false)
	{
		switch ($filter)
		{
			case 'age':
				$this->filter[$filter]	= ' AND '. $value1 . ' > filtro_edad_minima';
				$this->filter[$filter]	.= ' AND ('.$value1. ' <  filtro_edad_maxima OR filtro_edad_maxima = 0)'; 
			break;
			case 'income':
				$value1 = str_replace(".", "", $value1);
				$this->filter[$filter]	= ' AND '. escape($value1) . ' > filtro_ingreso_minimo';
				$this->filter[$filter]	.= ' AND (filtro_ingreso_maximo = 0 OR '. escape($value1) . ' <= filtro_ingreso_maximo) ';
				$this->income			= $value1;
			break;
			case 'family':
				//$this->filter[$filter]	= ' AND filtro_ingresos_familiares = "' .$value1 . '"';	
			break;	
			case 'family-income':
				//$totalIncome	= $this->income + intval(str_replace(".", "", $value1));
				//$this->filter['income']	= ' AND '. escape($totalIncome) . ' > filtro_ingreso_minimo';
				//$this->filter['income']	.= ' AND (filtro_ingreso_maximo = 0 OR '. escape($totalIncome) . ' <= filtro_ingreso_maximo)';
				//$this->income			= $totalIncome;
			break;			
			case 'credit-history':
				$this->filter[$filter]	= ' AND condicion_experiencia_crediticia = "' .$value1 . '"';	
			break;		
			case 'occupation':
				#if ($value1 == '2')
				#	$filter1	= '';
				#else
				#	$filter1	= ' AND filtro_medico_residente <> "1"';
				#if ($value1 == '3')
				#	$filter1	.= ' ';
				#else
				#	$filter1	.= ' AND filtro_empleado_publico <> "1"';			
				#$this->filter[$filter] = $filter1;
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
				#if ($value1 == '2')
				#	$filter1	= '';
				#else
				#	$filter1	= ' AND filtro_medico_residente <> "1"';
				#if ($value1 == '3')
				#	$filter1	.= ' ';
				#else
				#	$filter1	.= ' AND filtro_empleado_publico <> "1"';			
				#$this->filter[$filter] = $filter1;
			break;
			case 'codeudor':
				$this->filter[$filter] = " AND filtro_tercero_avalista_id = 1";
			break;
			case 'credit_time':
				$this->filter[$filter] = " AND condicion_experiencia_crediticia = '".$value1."'";
			break;			
			case 'gender':

				if ($value1 == '1')
					$this->filter[$filter] = " AND (filtro_genero <> 'Hombre'";
				if ($value1 == '2')
					$this->filter[$filter] = " AND (filtro_genero <> 'Mujer'";		
				$this->filter[$filter] .= " OR filtro_genero = 'Ambos')";
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
			case 'cupo':
				$this->filter['cupo'] = " AND filtro_monto_minimo > ".intval(str_replace(".", "", $value1));
				$this->filter['cupo'] .= " AND (filtro_monto_maximo = 0 OR filtro_monto_maximo > ". intval(str_replace(".", "", $value1)) . ")";
			break;
			default:
			
			break;
		}
	}
	
	public function setFilters()
	{
		$userData 	= unserialize($this->user->__get('user_data'));
		$this->addFilter('age', $userData['usuario_edad']);
		$this->addFilter('gender', $userData['usuario_sexo']);
		$this->addFilter('income', intval(str_replace(".", "", $userData['salud_28-1'])) + intval(str_replace(".", "", $userData['salud_28-3'])) + intval(str_replace(".", "", $userData['salud_28-2'])) );	
		if (isset($userData['usuario_ingresos_familiar']))
			$this->addFilter('family', $userData['usuario_ingresos_familiar']);
		if (isset($userData['usuario_ingresos_sumados']))		
		$this->addFilter('family-income', $userData['usuario_ingresos_sumados']);
		if (isset($userData['usuario_cuenta_codeudor']))	
		$this->addFilter('codeudor', $userData['usuario_cuenta_codeudor']);
		if (isset($userData['usuario_trabajo_empleado']))
			$this->addFilter('occupation-extra', $userData['usuario_trabajo_empleado']);
		if (isset($userData['usuario_cupo_particular']))
			$this->addFilter('cupo', $userData['usuario_cupo_particular']);
	}

	public function getWithFilters()
	{
		$this->setFilters();
		$sql	= '';
		if (count($this->filter) > 0)
		{
			foreach ($this->filter as $key=>$value)
				$sql .= $value;
		}
		$this->filter	= FiltroHelper::selectFiltros(" AND comp_filtros.filtro_producto_id =  ".$this->table.".".$this->field . $sql, ', '.$this->table);
		$this->createOrFilter();
		$this->getResults();
		if ($this->showWork)
		{
			echo '<strong>Total productos en esta consulta:</strong> '.count($this->items).'<br>';
			echo '<pre>';
			print_r ($this->items);
			echo '</pre>';
		}
		
		$return	= array();
		
		$i	= 0;
		foreach ($this->items as $item)
		{
			$entidad	 	= new Entidad($item->__get('tarjeta_entidad_id'));
			$return[$i][0]	= $entidad->__get('entidad_nombre_comercial');	
			$return[$i][1]	= $item->__get('tarjeta_nombre_producto');
			$i++;
		}
		
		return $return;
	}

	public function createOrFilter()
	{
		$first 	= true;
		$sql	= '';
		while($row = mysql_fetch_assoc($this->filter["query"]))	
		{
			$sql .= ($first) ? " AND (" : " OR ";			
			$first = false;
				$sql .= $this->field.' = "' . $row["filtro_producto_id"] . '"';
		}
		$sql 	.= ($this->filter['num_rows'] > 0) ? ')' : 'AND 1=0';
		$this->orFilter	= $sql; 
	}

	public function getResults()
	{
		$userData 	= unserialize($this->user->__get('user_data'));
		$extraFilter = '';
		if (isset($userData['usuario_franquicia']))
		{
			if ($userData['usuario_franquicia'] == 1)
				$extraFilter	= " AND franquicia_tipo_tarjeta_id  =  3";
			else if ($userData['usuario_franquicia'] == 2)
				$extraFilter	= " AND franquicia_tipo_tarjeta_id=  4";
			else if ($userData['usuario_franquicia'] == 3)
				$extraFilter	= " AND franquicia_tipo_tarjeta_id=  2";
			else if ($userData['usuario_franquicia'] == 4)
				$extraFilter	= " AND franquicia_tipo_tarjeta_id=  1";	
			else if ($userData['usuario_franquicia'] == 6)
				$extraFilter	= " AND (franquicia_tipo_tarjeta_id =  3 OR  franquicia_tipo_tarjeta_id = 4) ";					
			
		}		
		
			
		$this->items		= TCreditoHelper::retrieveTarjetas($this->orFilter. $this->productId. $extraFilter. " AND tarj_oper_monetarias.oper_monetaria_tarjeta_id = tarj_tarjetas.tarjeta_id AND comp_economicos.economico_codigo_producto = tarj_tarjetas.tarjeta_id AND tarj_tarjetas.tarjeta_franquicia_id = tarj_franquicias.franquicia_id GROUP by tarjeta_id  ORDER by SUM(tarj_oper_monetarias.oper_monetaria_tasa + comp_economicos.economico_cuota_manejo)  DESC", ", tarj_franquicias, tarj_oper_monetarias, comp_economicos");
	}
	
}
?>