<?php

require_once 'excelreader/reader.php';



class Excel 

{

	public $xls;

	public $data;

	public $matrix;	

	public function __construct($file = false, $firstline = false, $cols=0, $rows=0) 

	{

		if ($file) 

		{

			$this->xls = array(	'file'			=>	$file,

								'cols'			=>	0, 

								'rows'			=>	0, 

								'firstTitle'	=> 	$firstline,

								'header'		=>  ''

						  );

			$this->data = new Spreadsheet_Excel_Reader();

			$this->data->setOutputEncoding('CP1251');

			$this->data->read($file);

			$this->xls['rows']	=	$this->data->sheets[0]['numRows'];

			$this->xls['cols']	=	$this->data->sheets[0]['numCols'];

			$this->makeHeader();	

		}

		else 

		{

			$this->xls = array(	'file'			=>	'',

								'cols'			=>	$cols, 

								'rows'			=>	$rows, 

								'firstTitle'	=> 	'',

								'header'		=>  ''

						  );

			$this->makeHeader();	

		}	

		$this->matrix = array();

	}	

	public function __get($field) 

	{

		if (array_key_exists($field, $this->xls)) 

			return $this->xls[$field];

	} 

	public function __set($field, $value) 

	{

		if (array_key_exists($field, $this->xls)) 

			$this->xls[$field] = $value;

	} 

	public function makeHeader() 

	{

		$this->xls['header'] = array();

		for ($i=1; $i<$this->xls['cols']; $i++) 

		{

			$this->xls['header'][$i] = 'COL'.$i;

		}

		if ($this->xls['firstTitle']) 

			$this->putFirstLineHeader();

	}	

	public function putHeaderValue($field, $value) 

	{

		if (array_key_exists($field, $this->xls['header'])) 

			$this->xls['header'] = $value;

	}

	public function putFirstLineHeader() 

	{

		for ($i=1; $i<= $this->data->sheets[0]['numCols']; $i++) 

		{

			$this->xls['header'][$i] = $this->data->sheets[0]['cells'][1][$i];

		}		

	}

	public function populate() 

	{ 

		if ($this->xls['firstTitle']) 

			$k = 2;

		else

			$k = 1;

		for ($i=$k; $i<=$this->xls['rows']; $i++) 

		{

			for ($j=1; $j<=$this->data->sheets[0]['numCols']; $j++) 

			{

				$this->matrix[$i][$j] = $this->data->sheets[0]['cells'][$i][$j];

			}

		}		

	}

	public function getMatrix() 

	{

		return $this->matrix;	

	}

	public function makeDbStruct() 

	{ 

		$connection = Connection::getInstance();	

	}	

}

?>