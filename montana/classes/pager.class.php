<?php
class Pager {
	
	private $pager;
	
	
	public function __construct($parameter = '', $parameterGetVariable = 'criterio', $pageGetParameter = 'pag', $href = '',
								$defaultSize = 10, $resultNum, $page = 1 ) 
	{
		
			
		$this->pager = array('parameter'	        =>$parameter,
					         'parameterGetVariable' =>$parameterGetVariable,
							 'pageGetParameter'     =>$pageGetParameter,
							 'href'				    =>$href,
							 'defaultSize'		    =>$defaultSize,
							 'resultNum'			=>$resultNum,
							 'page'			        =>$page,
							 'resultSize'           =>10,
							 'numberPages'          =>0,
							 'arrayStartNumber'     =>0);
											
		$this->__set('resultSize', $this->retriveResultSize());
		$this->__set('numberPages', $this->retriveNumberPages());
		$this->__set('arrayStartNumber', $this->retrieveStartNumber());
		
	}	

 
 	public function __set($name, $value) 
	{
		$this->pager[$name] = $value;
	}

	public function __get($name) 
	{
		if (array_key_exists($name, $this->pager)) 
			return $this->pager[$name];
	 }	
	
	public function retriveResultSize ()
	{
		
		$actual = $this->__get('page')  * $this->__get('defaultSize');
		$actualNum = 0 ;
		
		if( $actual > $this->__get('resultNum')){
		
			$exceded = $actual - $this->__get('resultNum');
			$actualNum = $this->__get('defaultSize') - $exceded ;
		}
		else 
			$actualNum = $this->__get('defaultSize');
		
		return $actualNum;
	}
	
	public function retriveNumberPages () {
		
		$pageNo = 0 ;
		
		$tentativePageNo = $this->__get('resultNum')  / $this->__get('defaultSize');
		
		$roundedTentativepageNo = round($tentativePageNo) ;
		
		if ( $tentativePageNo > $roundedTentativepageNo ) 
			$pageNo = $roundedTentativepageNo + 1 ;
		else 
			$pageNo = $roundedTentativepageNo ;
		
		return $pageNo ;
	}
	
	
	public function retrieveStartNumber () {
	
		return  ($this->__get('page') * $this->__get('defaultSize')) - ($this->__get('defaultSize') - 1) - 1;
	}

	
	
	public function display ($pagDistance = 100, $class = 'paginador' ) 
	{
		$pager	  = '';
		if($this->__get('numberPages') > 1)
		{
			$startPag = $this->__get('page') - $pagDistance ;
			$endPag   = $this->__get('page') + $pagDistance ;
			//$pager    = '<div class="' . $class . '">' ;
			$itemSelect= false;
			//$pager	 .= '<p class="pagina_actual">P&aacute;gina <em>' . $this->__get('page') . '</em> of <em>' . $this->__get('numberPages') . '</em></p><p class="paginas">';
			$previous = $this->__get('page') - 1;
			$next     = $this->__get('page') + 1;
	
			if ( $startPag <= 0 ) 
				$startPag = 1 ;
			
			if ( $endPag > $this->__get('numberPages') )
				$endPag = $this->__get('numberPages');
		
			if ( $previous < 1 ) 
				$previous = 1 ;
			

			$pager .= '<a href="' . $this->__get('href') . '/' . $this->__get('parameter') . '/' . $previous . '.html" title="anterior" class="nav-next-pager">&laquo; Anterior</a> ';
	
			if( $startPag > 1 )
				$pager .= '<a href="'.$this->__get('href').'/'.$this->__get('parameter').'/1.html" title="1">1</a> ... ' ;
	
			for ( $i=$startPag ; $i<=$endPag ; $i++ ) 
			{
				if($this->__get('page') == $i)
					$itemSelect= true;
				if($itemSelect)	
					$pager .= '<a href="'.$this->__get('href').'/'.$this->__get('parameter').'/'.$i. '.html" title = "'.$i.'" class="pager-selected-number">'.$i;
				else
					$pager .= '<a href="'.$this->__get('href').'/'.$this->__get('parameter').'/'.$i. '.html" title = "'.$i.'" class="pager-number">'.$i;
				$pager .= ' </a> ' ;	
				/*if($i != $this->__get('numberPages'))
					$pager .= '| ';*/
				$itemSelect= false;
			}
			
			if ( $endPag < ($this->__get('numberPages') - 1 ))
				$pager .= ' ... ' ;
			
			if	( $endPag < $this->__get('numberPages') ) 
				$pager .= '<a href="'.$this->__get('href').'/'.$this->__get('parameter').'/'. $this->__get('numberPages').'.html" class="pager-number">' . $this->__get('numberPages') . '</a> ' ;
				
			
			if ( $next > $this->__get('numberPages') ) 
				$next = $this->__get('numberPages') ;
			$pager .= ' <a href="' . $this->__get('href') . '/' . $this->__get('parameter') . '/' . $next . '.html" title="siguiente" class="nav-next-pager" >Siguiente &raquo;</a>' ;

		}		
		else
		{
			//$pager    = '<div class="' . $class . '"><p class="current-page">P&aacute;gina  <em>1</em> de <em>1</em></p>
			//	<p class="paginas">' ;
			$pager .= ' <a hreh="javascript:void(0)" class="pager-selected-number">1</a> ' ;
			//$pager   .= '</p></div>';
		}		
		echo $pager;	
	}
	
}
?>