<?php	
class DepositosVValue
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
	var $products;
	var $canales;
	
	public function __construct(&$user, $product, $showWork = true)
	{
		$this->field		= 'deposito_id';
		$this->table		= 'depv_depositos';		
		$this->user			= $user; 
		$this->items 		= array();
		$this->filter 		= array();
		$this->income		= 0;		
		$this->orFilter 	= "";
		$this->showWork		= $showWork;
		if ($product != 0)
			$this->productId	= " AND deposito_tipo_depositos_id = ". escape($product);	
		else
			$this->productId	= "";
		$this->canales 		= array();
		$this->productos	= array();
		$evaluacion			= array();
		$califications 		= array();
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
			case 'gender':
			
				if ($value1 == '1')
					$this->filter[$filter] = " AND (filtro_genero<> 'Hombre'";
				if ($value1 == '2')
					$this->filter[$filter] = " AND (filtro_genero <> 'Mujer'";		
				$this->filter[$filter] .= " OR filtro_genero = 'Ambos')";
			break;	
			case 'city':
					$this->filter[$filter] = " AND filtro_ciudad_id = ". escape($value) ;				
			break;				
		}
	}
	
	public function setFilters()
	{
		$userData 	= unserialize($this->user->__get('user_data'));
		$this->addFilter('age', $userData['usuario_edad']);
		$this->addFilter('gender', $userData['usuario_sexo']);	
		if (isset($userData['salud_28-1']))
		{
			$userData['salud_28']	= intval($userData['salud_28-1']) + intval($userData['salud_28-2']) + intval($userData['salud_28-3']);		
			$this->addFilter('income', $userData['salud_28']);	
		}
	}
	
	public function getCanales()
	{
		$this->productos = array();
		$userData 	= unserialize($this->user->__get('user_data'));			
		if ((isset($userData['retiro-opcion'])) && ($userData['retiro-opcion'] != ''))
		{
			$sql				= " AND costo_canal_id = ".escape($userData['retiro-opcion'])." AND costo_operacion_id = 17"; 
			$products			= CostovHelper::selectCostos($sql.$this->orFilter);
			$this->canales[]	= $userData['retiro-opcion'];
			while ($row = mysql_fetch_assoc($products['query']))
			{
				if (!isset($this->productos[$row['deposito_id']]))
					$this->productos[$row['deposito_id']] = array();											   	
				$this->productos[$row['deposito_id']][$userData['retiro-opcion']] = 1;
			}
		}
		if ((isset($userData['consignaciones-opcion'])) && ($userData['consignaciones-opcion'] != ''))
		{																	 
			$sql	= " AND costo_canal_id = ".escape($userData['consignaciones-opcion'])." AND costo_operacion_id = 3"; 
			$products			= CostovHelper::selectCostos($sql.$this->orFilter);
			$this->canales[]	= $userData['consignaciones-opcion'];
			while ($row = mysql_fetch_assoc($products['query']))
			{
				if (!isset($this->productos[$row['deposito_id']]))
					$this->productos[$row['deposito_id']] = array();											   	
				$this->productos[$row['deposito_id']][$userData['consignaciones-opcion']] = 1;
			}
		}
		if ((isset($userData['transferencias-opcion'])) && ($userData['transferencias-opcion'] != ''))
		{
			$sql	= " AND costo_canal_id = ".escape($userData['transferencias-opcion'])." AND costo_operacion_id = 19"; 
			$products			= CostovHelper::selectCostos($sql.$this->orFilter);
			$this->canales[]	= $userData['transferencias-opcion'];
			while ($row = mysql_fetch_assoc($products['query']))
			{
				if (!isset($this->productos[$row['deposito_id']]))
					$this->productos[$row['deposito_id']] = array();											   	
				$this->productos[$row['deposito_id']][$userData['transferencias-opcion']] = 1;
				echo $row['deposito_id'];
			}			
		}
		if ((isset($userData['servicios-opcion'])) && ($userData['servicios-opcion'] != ''))
		{
			$sql	= " AND costo_canal_id = ".escape($userData['servicios-opcion'])." AND costo_operacion_id = 13"; 																		 
			$products			= CostovHelper::selectCostos($sql.$this->orFilter);
			$this->canales[]	= $userData['servicios-opcion'];
			while ($row = mysql_fetch_assoc($products['query']))
			{
				if (!isset($this->productos[$row['deposito_id']]))
					$this->productos[$row['deposito_id']] = array();											   	
				$this->productos[$row['deposito_id']][$userData['servicios-opcion']] = 1;
			}						
		}
		$first 	= true;
		$sql	= "";
		$i		= 0;
		foreach ($this->productos as $key=>$value)
		{
			$showProduct = true;
			foreach ($this->canales as $canal)
			{
				if (!isset($this->productos[$key][$canal]) && ($this->productos[$key][$canal] != 1))
				{
					$showProduct = false;
					echo $key . ' - ' . $canal . ' <br>';
				}
			}
			if ($showProduct)
			{
				$sql .= ($first) ? " AND (" : " OR ";			
				$first = false;
				$sql .= $this->field.' = "' . $key . '"';										
				$i++;
			}			
		}
		$sql 	.= ($i > 0) ? ')' : 'AND 1=0';		
		$this->orFilter	= $sql;
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
		$this->getCanales();
		$this->getResults();
		if ($this->showWork)
		{
			echo '<strong>Total productos en esta consulta:</strong> '.count($this->items).'<br>';
			echo '<pre>';
			print_r ($this->items);
			echo '</pre>';
		}
		$return	= array();
		$i		= 0;
		foreach ($this->items as $item)
		{
			$entidad	 	= new Entidad($item->__get('deposito_entidad_id'));
			$return[$i][0]	= $entidad->__get('entidad_nombre_comercial');	
			$return[$i][1]	= $item->__get('deposito_nombre_deposito');
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
		$this->items		= DepositoVHelper::retrieveDepositos($this->orFilter. $this->productId. " ORDER by RAND()");
	}
	
}
?>