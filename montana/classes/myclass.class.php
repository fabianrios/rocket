<?php
class MyClass
{
     private $events;
     private $eventHandlers;    

     public function __construct(EventHandlerCollection $handlers
= null)
     {
          $this->events = new EventCollection();         

          if ($handlers)
              $this->eventHandlers = $handlers;
          else
              $this->eventHandlers = new EventHandlerCollection
();          

          $this->InitEvents();
          $this->TriggerEvent('OnLoad', array('arg1'=>1));
     }    

     public function __destruct()
     {
          $this->TriggerEvent('OnUnload', array('arg2'=>2));
     }    

     public function RegisterEventHandler($handler)
     {
          if ($this->events->Contains($handler->GetEventName()))
              $this->eventHandlers->Add($handler);
     }
     private function InitEvents()
     {
          $this->events->Add(new Event('OnLoad'));
          $this->events->Add(new Event('OnUnload')); 
     }
     private function TriggerEvent($eventName, $args)
     {
          $this->eventHandlers->RaiseEvent($eventName, $this,
$args);
     }
}
?>