<?php	
class CreditosValue
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
		$this->field	= 'consumo_id';
		$this->table	= 'cons_consumos';		
		$this->user		= $user; 
		$this->items 	= array();
		$this->filter 	= array();
		$this->income	= 0;		
		$this->orFilter = "";
		$this->showWork	= $showWork;
		if ($product != 0)
			$this->productId	= " AND consumo_tipo_credito_id = ". escape($product);	
		else
			$this->productId	= "";
		$evaluacion		= array();
		$califications 	= array();
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
				#$this->filter[$filter] = " AND filtro_tercero_avalista_id = 1";
			break;
			case 'credit_time':
				$this->filter[$filter] = " AND filtro_experiencia_crediticia = '".$value1."'";
			break;			
			case 'gender':

				if ($value1 == '1')
					$this->filter[$filter] = " AND (filtro_genero <> 'Hombre'";
				else if ($value1 == '2')
					$this->filter[$filter] = " AND (filtro_genero <> 'Mujer'";	
				else	
					$this->filter[$filter] .= " AND (filtro_genero = ''";
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
			default:
			
			break;
		}
	}
	
	public function setFilters()
	{
		
		$userData 	= unserialize($this->user->__get('user_data'));
		$this->addFilter('age', $userData['usuario_edad']);
		$this->addFilter('gender', $userData['usuario_sexo']);
		$this->addFilter('income', intval(str_replace(".", "", $userData['salud_28-1'])) + intval(str_replace(".", "", $userData['salud_28-3']))  );	
		$this->addFilter('family', $userData['usuario_ingresos_familiar']);
		$this->addFilter('family-income', $userData['usuario_ingresos_sumados']);
		$this->addFilter('codeudor', $userData['usuario_cuenta_codeudor']);

		#if (isset($userData['usuario_trabajo_empleado']))
		#	$this->addFilter('occupation-extra', $userData['usuario_trabajo_empleado']);
		
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
			$entidad	 	= new Entidad($item->__get('consumo_entidad_id'));
			$return[$i][0]	= $entidad->__get('entidad_nombre_comercial');	
			$return[$i][1]	= $item->__get('consumo_nombre_producto');
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
		$this->items		= CreditoHelper::retrieveCreditos($this->orFilter. $this->productId. " GROUP by consumo_id ORDER by RAND()");
	}
	
}
?>