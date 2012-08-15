<?php
class Event
{
     private $name;    

     public function GetName()
     {
          return $this->name;
     }    

     public function __construct($name)
     {
          $this->name = $name;
     }
}
?>