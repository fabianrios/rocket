<?php
class Image 
{
	// VARIABLES PRIVADAS	
	private $extension;      	// STRING || EXTENSION DEL ARCHIVO
	private $destinationInt; 	// INT || IMAGEN A GUARDAR EN PIXELES
	private $sourceInt;      	// INT || IMAGEN A COPIAR EN PIXELES
	private $source;         	// STRING || ARCHIVO BASE DE LA IMAGEN
	private $savedSize;
	private $waterMarkInt;	 	// INT || MARCA DE AGUA EN PIXELES
	private $waterMarkSize;	 	// INT || MARCA DE AGUA EN PIXELES	
	private $waterMarkNewSize;	// ARREGLO (ANCHO, ALTO) || TAMAÑO DE LA MARCA DE AGUA
	
	
	// VARIABLES PUBLICAS
	public $newSize;       	  	  // ARREGLO (ANCHO, ALTO) || TAMAÑO DE LA IMAGEN NUEVA 
	public $sourceXY;      	  	  // ARREGLO (X, Y) || COORDENADAS XY QUE DELIMITAN DESDE DONDE SE VA A EMPEZAR A TOMAR LA IMAGEN
	public $destinationXY; 	  	  // ARREGLO (X, Y) || COORDENADAS XY QUE DELIMITAN DESDE DONDE SE VA A EMPEZAR A ESCRIBIR LA NUEVA IMAGEN
	public $size;          	  	  // ARREGLO (ANCHO, ALTO) || TAMAÑO DE LA ZONA EN CORDENADAS XY DE PIXELES QUE SE VA A TOMAR PARA ESCRIBIR EN EL NUEVO ARCHIVO
	public $waterMark;	   	  	  // BOOL || DETERMINA SI LA IMAGEN VA A TENER MARCA DE AGUA
	public $waterMarkSrc;  	  	  // STRING || RUTA A LA MARCA DE AGUA
	public $waterMarkSizePctg; 	  // INT || PORCENTAJE DE TAMAÑO CON RELACION A LA IMAGEN ORGINAL
	public $waterMarkBorderPctg;  // INT || PORCENTAJE DE TAMAÑO DE BORDE CON RELACION A LA IMAGEN ORGINAL	
	
	// CONSTRUCTOR
	// IN: 1 STRING (ARCHIVO BASE)
	function __construct($source, $waterMark = false, $waterMarkFolder = '') 
	{
	 
	 	$this->source      = $source;
		$this->extension  = $this->retrieveExtension();	 
		
		$this->waterMark 		   = $waterMark;
		$this->waterMarkSrc 	   = $waterMarkFolder . 'watermark.png';
		$this->waterMarkSizePctg   = 100;
		$this->waterMarkBorderPctg = 0;	

		$this->setSize($this->source);                          // FUNCION || DETERMINA EL TAMAÑO DE LA IMAGEN EN PIXELES
		$this->newSize = array($this->size[0], $this->size[1]); // POR DEFECTO EL MISMO TAMAÑO DE LA IMAGEN
		$this->createSourceInt();                               // FUNCION || TRANSFORMA LA IMAGEN BASE EN UN GRUPO DE PIXELES
				
		$this->sourceXY      = array(0, 0); // POR DEFECTO 0,0
		$this->destinationXY = array(0, 0); // POR DEFECTO 0,0
		
	} 
	
	// RETORNA LA EXTENSION DEL ARCHIVO
	private function retrieveExtension()
	{
		$extensionBreak = explode('.', $this->source);
		$breakParts     = count($extensionBreak) - 1;
		
		return $extensionBreak[$breakParts];
	}
	
	// CREA LA COPIA EN PIXELES DE LA IMAGEN BASE
	private function createSourceInt()
	{
		switch(strtolower($this->extension)):
			case 'gif':
				$this->sourceInt = imagecreatefromgif($this->source);
			break;
			case 'jpg':
				$this->sourceInt = imagecreatefromjpeg($this->source);
			break;
			case 'jpeg':
				$this->sourceInt = imagecreatefromjpeg($this->source);
			break;
			case 'png':
				$this->sourceInt = imagecreatefrompng($this->source);
			break;
		endswitch;
		if($this->waterMark)
			$this->waterMarkInt = imagecreatefrompng($this->waterMarkSrc);  	
	}
	
	// CREA EL LIENZO DE LA NUEVA IMAGEN
	private function createDestinationInt()
	{
		$this->destinationInt = imagecreatetruecolor($this->newSize[0], $this->newSize[1]);
		imagealphablending($this->destinationInt, true); 	
	}
	
	// CONSTRUYE LA NUEVA IMAGEN Y LA ALISTA PARA GUARDAR
	private function build()
	{
		imagecopyresampled($this->destinationInt,
						   $this->sourceInt,
						   $this->destinationXY[0],
						   $this->destinationXY[1],
						   $this->sourceXY[0],
						   $this->sourceXY[1],
						   $this->newSize[0],
						   $this->newSize[1],
						   $this->size[0],
						   $this->size[1]);			
		if($this->waterMark)
		{
			imagecopy($this->destinationInt, 
					   $this->waterMarkInt, 
					   (($this->destinationXY[0] + $this->newSize[0]) - ($this->waterMarkSize[0] + round(($this->waterMarkBorderPctg / 100 ) * $this->newSize[0]))), 
					   (($this->destinationXY[1] + $this->newSize[1]) - ($this->waterMarkSize[1] + round(($this->waterMarkBorderPctg / 100 ) * $this->newSize[0]))), 
					   0, 
					   0, 
					   $this->waterMarkSize[0], 
					   $this->waterMarkSize[1]);  						   
		}
	}

	// ESTABLECE EL TAMAÑO INICIAL DE LA IMAGEN BASE (puede usarse para hacer un reset de el tamaño)
	public function setSize()
	{
		$this->size = getimagesize($this->source);
	}
	private function setWaterMarkSize()
	{
		$this->waterMarkSize 	= getimagesize($this->waterMarkSrc);
		$waterMarkWidth			= (($this->waterMarkSizePctg / 100 ) * $this->newSize[0]);
		$waterMarkHeight		= ($waterMarkWidth/$this->waterMarkSize[0]) * $this->waterMarkSize[1];	
		$this->waterMarkNewSize	= array(round($waterMarkWidth), round($waterMarkHeight));
	}	
	// HACE UN RESIZE DE LA IMAGEN TOMANDO MAXIMOS Y MINIMOS
	public function resize()
	{
		$this->savedSize = $this->newSize;
		if ($this->size[0] > $this->size[1]) 
		{
			$newWidth = $this->newSize[0];
			$newHeight = ($this->newSize[0]/$this->size[0])*$this->size[1];
			if ($newHeight < $this->newSize[1]) 
			{
				$newHeight =  $this->newSize[1];
				$newWidth = ($this->newSize[1]/$this->size[1])*$this->size[0];
			}			
		}
		else 
		{
			$newHeight =  $this->newSize[1];
			$newWidth = ($this->newSize[1]/$this->size[1])*$this->size[0];
			if ($newWidth <  $this->newSize[0]) 
			{
				$newWidth = $this->newSize[0];
				$newHeight = ($this->newSize[0]/$this->size[0])*$this->size[1];
			} 	
		}
		$this->newSize[0] = $newWidth;
		$this->newSize[1] = $newHeight;
		if($this->waterMark)
			$this->setWaterMarkSize();
		$this->createDestinationInt();	
	}
	
	public function resetToDefaults()
	{
		$this->setSize();
		$this->setSize($this->source);                         
		$this->newSize = array($this->size[0], $this->size[1]);
		$this->sourceXY      = array(0, 0); 
		$this->destinationXY = array(0, 0); 
	}
	
	public function autocrop()
	{
		$this->savedSize  = array($this->newSize[0], $this->newSize[1]);
		
		$this->resize();
		
		if($this->savedSize[0] < $this->newSize[0])
		{
			$remainingSize = ($this->size[1]/$this->savedSize[1])*$this->savedSize[0];
			$this->sourceXY[0] = ($this->size[0] - $remainingSize) / 2;		
			$this->size[0] = $remainingSize;	
		}	
		else
		{
			$remainingSize = ($this->size[0]/$this->savedSize[0])*$this->savedSize[1];
			$this->sourceXY[1] = ($this->size[1] - $remainingSize) / 2;				
			$this->size[1] = $remainingSize;	
		}	
		$this->newSize = $this->savedSize;
		if($this->waterMark)
			$this->setWaterMarkSize();		
		$this->createDestinationInt();	
	}
	
	// GUARDA LA IMAGEN EN EL DIRECTORIO DESEADO CON EL NOMBRE DESEADO
	// IN: 1 STRING (RUTA Y NOMBRE DEL ARCHIVO A GUARDAR)
	public function save($destination)
	{
		if($this->waterMark)
			$this->setWaterMarkSize();			
		$this->createDestinationInt();
		$this->build();
		$this->writeImage($destination);
	}
	private function writeImage($destination)
	{
		switch(strtolower($this->extension)):
			case 'gif':
				imagegif($this->destinationInt, $destination);
			break;
			case 'jpg':
				imagejpeg($this->destinationInt, $destination, 100);
			break;
			case 'jpeg':
				imagejpeg($this->destinationInt, $destination, 100);
			break;
			case 'png':
				imagepng($this->destinationInt, $destination);
			break;
		endswitch;
	}
}
?>