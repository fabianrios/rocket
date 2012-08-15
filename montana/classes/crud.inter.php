<?php
interface Crud
{
	public function __get($field);
	public function __set($field, $value);
	public function updateField($field, $value);
	public function save();
	public function update();
	public function delete();	
}
?>