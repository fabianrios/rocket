<?php	
class DepositosTValue
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
		$this->field	= 'deposito_id';
		$this->table	= 'dept_depositos';		
		$this->user		= $user; 
		$this->items 	= array();
		$this->filter 	= array();
		$this->income	= 0;		
		$this->orFilter = "";
		$this->showWork	= $showWork;
		if ($product != 0)
			$this->productId	= " AND deposito_tipo_depositos_id = ". escape($product);	
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
				$this->filter[$filter]	= ' AND '. escape($value1) . ' > filtro_ingreso_minimo';
				$this->filter[$filter]	.= ' AND (filtro_ingreso_maximo = 0 OR '. escape($value1) . ' <= filtro_ingreso_maximo)';
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
		$i = 0;
		foreach ($this->items as $item)
		{
			$entidad	 	= new Entidad($item->__get('deposito_entidad_id'));
			$return[$i][0]	= $entidad->__get('entidad_nombre_comercial');	
			$return[$i][1]	= $item->__get('deposito_nombre_producto');
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
		$this->items		= DepositoTHelper::retrieveDepositos($this->orFilter. $this->productId);
	}
	
}
?>