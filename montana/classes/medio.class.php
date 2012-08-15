<?php 
class Medio {
	public $uploadFile;
	public function __construct($file, $accept, $base)
	{
		$this->uploadFile = array(	'file' 		=> $file,
									'type' 		=> $this->retFileType($file, $accept), 
									'accept' 	=> $accept, 
									'base' 		=> $base
								  );
		if ($this->uploadFile['type']) 
			$this->actionFile();
	
	}	
	private function retFileType($file, $acceptList) 
	{
		$str = strtoupper($file);
		//IMAGENES
		$fileType = false;
		if (preg_match("/.PNG/", $str))
			$fileType = 'png'; 
		if (preg_match("/.JPEG|.JPG/", $str))
			$fileType = 'jpg';
		if (preg_match("/.SWF/", $str))
			$fileType = 'swf';
		if (preg_match("/.GIF/", $str))
			$fileType = 'gif';
		//DOCUMENTOS
		if (preg_match("/.DOC/", $str))
			$fileType = 'doc';
		if (preg_match("/.PDF/", $str))
			$fileType = 'pdf';
		if (preg_match("/.ZIP/", $str))
			$fileType = 'zip';
		if (preg_match("/.RAR/", $str))
			$fileType = 'rar';
		$accept = false;
		foreach ($acceptList as $acceptExt) 
		{
			if ($acceptExt == $fileType) 
				$accept = true;
		}
		if (($accept) && ($fileType)) 
			return $fileType;	
		else 
			return false;
	}
	private function actionFile()
	{
		switch ($this->uploadFile['type']):
			case 'png':
				$this->processImage(); 
			break;
			case 'jpg':
				$this->processImage(); 
			break;
			case 'gif':
				$this->processImage(); 
			break;			
		endswitch;
	}
	private function processImage() {
		if ($handle = opendir($this->uploadFile['base'])) 
		{
			while (($file = readdir($handle)) !== false) 
			{		
				if (is_dir($this->uploadFile['base'].$file)) 
				{
					$waterMark 		 = false;
					$waterMarkFolder = '';
					if(file_exists($this->uploadFile['base'].$file.'/watermarked.mgmd'))
					{
						$waterMark 		 = true;				
						$waterMarkFolder = $this->uploadFile['base'].$file.'/';
					}
					if (($file != '.') && ($file != '..')) 
					{
						$res = (count(explode('x',$file)) > 1) ? explode('x',$file) : explode('r',$file) ;
						$width = $res[0];
						$height = $res[1];
						
						$image = new Image($this->uploadFile['base'].$this->uploadFile['file'], $waterMark, $waterMarkFolder);
						$image->newSize = array($width, $height);
						if(($width != 0) && ($height != 0))
							$image->autocrop(true);
						else
							$image->resize();	
						$dest = $this->uploadFile['base'].$file.'/'.$this->uploadFile['file'];
						$image->save($dest);
					}				
				}
			}
		}
	}		
	public function __get($field) 
	{
		if (array_key_exists($field, $this->uploadFile)) 
			return $this->uploadFile[$field];
	} 
}


?>