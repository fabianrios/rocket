<?php
class EventCollection
{
     private $events;

     public function __construct()
     {
          $this->events = new ArrayObject();
     }

     public function Add($event)
     {
          if (!$this->Contains($event))
              $this->events->Append($event);
     }    

     public function Contains($event)
     {
          foreach ($this->events as $e)
          {
              if ($e->GetName() == $event)
                   return true;
          }
     }
}
?>