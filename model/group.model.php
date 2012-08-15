<?php
	class Group extends Builder implements Crud 
	{
		public function __construct($id = NULL)
		{
			parent :: __construct();
			
			$this->table       = 'iden_groups';
			$this->identifyer  = 'group_id';
			$this->objectArray = ($this->build($id)) ? $this->build($id) : array();	
		
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