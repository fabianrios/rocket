<?php
	class CoreLog extends Builder implements Crud 
	{
		public function __construct($CoreLog_id = NULL)
		{
			parent :: __construct();
			
			$this->table       = 'core_log';
			$this->identifyer  = 'log_id';
			$this->objectArray = $this->build($CoreLog_id);
			
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
			if(is_array($this->objectArray))
			{
				if (array_key_exists($field, $this->objectArray)) 
				{
					return $this->objectArray[$field];
				}
			}
		} 
		
		public function __set($field, $value) 
		{
			if(is_array($this->objectArray))
			{
				if (array_key_exists($field, $this->objectArray)) 
				{
					$this->objectArray[$field] = $value;
				}
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