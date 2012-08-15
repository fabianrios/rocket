<?php
	class Order extends Builder implements Crud 
	{
		public function __construct($city_id = NULL, $tablePrefix = 'iden_')
		{
			parent :: __construct();
			
			$this->table       = $tablePrefix . 'orders';
			$this->identifyer  = 'order_id';
			$this->objectArray = $this->build($city_id);	
		
			if($this->objectArray != false)
			{
				$this->found      = true;
				$this->keys       = $this->returnTotalValidFields($this->objectArray);
	
			}
			else
				$this->found      = false;
		}
		
		
		public function __get($field) 
		{
			if (array_key_exists($field, $this->objectArray)) 
			{
				return $this->objectArray[$field];
			}
		} 
		
		public function __set($field, $value) 
		{
			if (array_key_exists($field, $this->objectArray)) 
			{
				$this->objectArray[$field] = $value;
			}
		} 
		
		public function updateField($field, $value)
		{
			return parent::updateField($field, $value);
		}
	
		public function save()
		{
			return parent::save();
		}
	
		public function update()
		{
			return parent::update();
		}
		
		public function delete()
		{
			return parent::delete();	
		}
	}
?>