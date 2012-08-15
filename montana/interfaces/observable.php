<?php
	
	class Observable
	{
		private $observers;
		private $state;
		

		public function __construct()
		{
			$this->observers  = array();
			$this->state      = NULL;	
		}
		
		public function notifyObservers()
		{
			foreach($this->observers as $observer)
			{
				$suject = $this->getState();
				$observer->handleNotification($suject);
			}
		}
		
		public function addObserver(Observer $observer)
		{
			$this->observers[] = $observer;
		}
		
		public function getState()
		{
			return $this->state;
		}
		 
		public function setState($state)
		{
			$this->state = $state;
		}
		
	}
	
	/**interface Observable 
	{
		public function notifyObservers();		
		public function addObserver(Observer $observer);		
		public function getState();		
		public function setState($state);
	}*/
?>
