<?php
class ExcelHelper
{
	public static function export ( $items, $fileName = 'export' )
	{
		//MAKE HEADER
		$header = '';
		foreach($items as $item)
		{
			foreach($item as $key => $value)
				$header .= $key . "\t";		
			break;
		}
		//DATA
		$data   = '';
		foreach($items as $item)
		{
			$line  = '';
			foreach($item as $value)
			{
				$value = str_replace('"', '""', $value);
				$value = '"' . $value . '"' . "\t";
				$line .= $value;
			}
		  $data .= trim($line)."\n";
		}
		# this line is needed because returns embedded in the data have "\r"
		# and this looks like a "box character" in Excel
		  $data = str_replace("\r", "", $data);
		
		
		# Nice to let someone know that the search came up empty.
		# Otherwise only the column name headers will be output to Excel.
		if ($data == "") {
		  $data = "\nno matching records found\n";
		}
		
		# This line will stream the file to the user rather than spray it across the screen
		header("Content-type: application/octet-stream");
		
		# replace excelfile.xls with whatever you want the filename to default to
		header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		echo $header."\n".$data;		
	}
}
?>