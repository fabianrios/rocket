<?php
class Builder
{
	protected $table;
	protected $identifyer;
	protected $keys;
	protected $objectArray;
	protected $modifyPrimary;
	protected $connection;


	public function __construct()
	{
		$this->modifyPrimary = false;
	}

	protected function build($identifyerValue)
	{
		$fields     		= array();
		$this->connection 	= Connection::getInstance();
		$fieldSql 			= "";
		$first				= true;
		$defined 			= defined($this->table);
		if (!$defined)
		{
			$tableData  = array();
			$fieldsQry  = $this->connection->query("SHOW COLUMNS FROM " . $this->table);
			while($row = mysql_fetch_assoc($fieldsQry["query"]))
				$tableData[] = $row;
			define($this->table, serialize($tableData));
		}
		
		$fieldsResult = unserialize(constant($this->table));
		if (count($fieldsResult) > 0) 
		{
			foreach ($fieldsResult as $row) 
			{
				if($identifyerValue !== NULL)
				{
					if(!$first)
						$fieldSql .= ", ";
					$fieldSql .= $row["Field"];
					if($row["Field"] == $this->identifyer)
					{
						if ($row["Extra"] == 'auto_increment')
							$this->modifyPrimary = true;
					}
					$first = false;					
				}
				else
				{
					if($row["Field"] == $this->identifyer)
					{
						if ($row["Extra"] == 'auto_increment')
							$this->modifyPrimary = true;
					}
					$fields[$row["Field"]] = '';
				}
			}
			if($identifyerValue !== NULL)
			{
				$fieldContent = $this->connection->query("SELECT " . $fieldSql . " FROM " . $this->table . " WHERE " . $this->identifyer . " = '" . $identifyerValue . "'");
				
				$dataRow = mysql_fetch_assoc($fieldContent["query"]);
				if($dataRow !== false)
				{
					foreach($dataRow as $field => $value)
					{
						if(mysql_num_rows($fieldContent["query"]) > 0)
						{
							$fields[$field] = $value;
						}
						else
						{
							$fields = false;
							break;
						}
					}
				}
			}			
		}
		return $fields;
	}
	
	protected function updateField($field, $value)
	{
		$updateFiledSql = "UPDATE " . $this->table ."  
						   SET " . $field . " = '" . mysql_escape_string($value) . "' 
						   WHERE " . $this->identifyer . " = " . $this->objectArray[$this->identifyer];
		
		$updateFieldQry = $this->connection->query($updateFiledSql);
	}

	protected function returnTotalValidFields($objectArray)
	{
		$keys   = array_keys($objectArray);
		$fields = array();
		
		
		foreach($keys as $field)
		{
			if(($field != $this->identifyer) || ($this->modifyPrimary == true))
			{
				$fields[] = $field;
			}
		}
		return $fields;	
	}	

	protected function save()
	{
		$totalFields = count($this->keys);
		$count       = 1;
		$insertSql   = "INSERT INTO " . $this->table ." (";
		
		foreach($this->keys as $field)
		{
			if($field != $this->identifyer)
			{
				$insertSql .= $field;
				if($totalFields != $count)
					$insertSql .= ", "	; 
			
			}
			$count++;
		}

		$insertSql .= ") VALUES (";		
		$count      = 1;
		
		foreach($this->keys as $field)
		{
			if($field != $this->identifyer)
			{
				if(is_int(mysql_escape_string($this->objectArray[$field])))
					$insertSql .= mysql_escape_string($this->objectArray[$field]);
				else
					$insertSql .= "'" . str_replace('\\\"', '"', mysql_escape_string($this->objectArray[$field])) . "'";
				
				if($totalFields != $count)
					$insertSql .= ", "	;  
			} 
			$count++;
		}
		$insertSql .= ")";	
		
		$insertQry = $this->connection->query($insertSql);
	
		return $insertQry;
	}

	protected function update()
	{
		$totalFields = count($this->keys);
		$count       = 1;
		
		$updateSql = "UPDATE " . $this->table . " SET ";
		foreach($this->keys as $field)
		{
			if(is_int(mysql_escape_string($this->objectArray[$field])))
				$updateSql .= $field . " = " . mysql_escape_string($this->objectArray[$field]);
			else
				$updateSql .= $field . " = '" . str_replace('\\\"', '"', mysql_escape_string($this->objectArray[$field])) . "'";
			if($totalFields != $count)
				$updateSql .= ", "	; 
			$count++;
		}

		$updateSql .= " WHERE " . $this->identifyer . " = '" . $this->objectArray[$this->identifyer] . "'";	
		$updateQry = $this->connection->query($updateSql);
		return $updateQry;
	}
	
	protected function delete()
	{
		$deleteSql = sprintf("DELETE FROM " .$this->table ."
					  WHERE " . $this->identifyer . " = %d", mysql_escape_string($this->objectArray[$this->identifyer]));						  
					  
		$deleteQry = $this->connection->query($deleteSql);
		
		return $deleteQry;	
	}		
}
?>