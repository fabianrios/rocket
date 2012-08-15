<?php 
require_once(SITE_VIEW . "header.php");

$events = ContentHelper::retrieveAllContents("AND content_state = 'A' AND module_id = 47 AND language_id = " . LANG . " ORDER BY content_date_1");
$home    = new Content(313);
$stage   = ResourceHelper::getGallery($home->__get('content_id'), 'content_stage_1');
if (count($stage) > 0)
	$display_stage = APPLICATION_URL . 'resources/swf/' .  $stage[0]->__get('resource_file');
else
	$display_stage = APPLICATION_URL . 'images/129x96-default.jpg';
require_once(SITE_VIEW . "stage_include.php");
?>
<div id="contenido-general">
 <?php
	require_once(SITE_VIEW . "col_left.php");
 ?>
 <script type="text/javascript"> 
function displayDiv(div)
{
	
	object = document.getElementById(div);
	if (object.style.display == 'none')
	{
		object.style.display = '';
	}
	else
	{
		object.style.display = 'none';
	}
}

</script>
<!--columna-izquierda-->
				
				<div id="columna-central" class="agenda-cultural">
					<p class="breadcrumb"><a href="#">Inicio</a> > <a href="#">Agenda Cultural</a></p>
					
					<div id="main" class="agenda">
						<div class="caja-478">
							<div class="top">
								<div class="bottom">
															
										<h2>Agenda Cultural</h2>									
									<div class="interna">	
										<div class="fecha"><a href="#" class="evento">¿Tienes un evento que quieras publicar?</a><a href="#" class="anterior">anterior</a><a href="#" class="mes">Mayo</a><a href="#" class="siguiente">siguiente</a> <a href="#" class="ano">2009</a>	 </div>
										<?php 
										$daysMonth = getDaysInMonth(date('n'),date('Y'));
										$date =  explode(" ",formatDate()) ;
										$date = explode("-",$date[0]);
										if(isset($_GET[0]) && ($_GET[0] != ''))
										{
											$date[1] = $_GET[0];
											if((isset($_GET[1])) && ($_GET[1]!= '')){
												echo 'hola2';
												$date[2] = $_GET[1];
											}
											
											
										}	
										
										
										
										for($cont = 0 ; $cont < $daysMonth  ; $cont++)
										{
											$date1;
											$day = 	$cont + 1;
											if($day < 10)
												$day = '0'.$day;
											$date1 = $date[0]."-".$date[1]."-".$day;
											echo $day;
											echo '<br>';
											echo $date1;
											echo '<br>';
											$events =  ContentHelper::retrieveAllContents("AND content_state = 'A' AND module_id = 47 AND language_id = " . LANG . " AND (content_date_1 = '" . $date1 . "' OR content_date_2 = '" . $date1 . "' OR '" . $date1 . "' BETWEEN content_date_1 AND content_date_2 )  ORDER BY content_date_1");	
											
											
												foreach	($events as $event)
												{
													?>
														
													<div class="caja-detalle">
													<p class="fecha"><a><?=formatDate("%e", $event->getValue('conten_date_1'));?></a><br /><a href="#"><?=formatDate("%b", $event->getValue('conten_date_1'))?></a></p>
														<h4><a href="javascript:void(0)" onclick="displayDiv('detalle_<?=$event->__get('content_id')?>')"><?=$event->__get('content_varchar_1')?></a>
														<span><?=formatDate($event->__get('conten_date_1'))?></span></a></h4>
														
														<div id="detalle_<?=$event->__get('content_id')?>" style="display:none">
														
														<p class="lugar"><?=$event->__get('content_varchar_4')?></p>
														<p>
														<?php
														$content_text_1 = $event->__get('content_text_1');
														if(strlen($content_text_1) > 200)
														{
															$content_text_1 = substr($content_text_1,0,250);
														}
														
														$content_text_1 .= ' ...  ';
														
														
														?>
														</p>
														<p class="mas-info"><a href="<?=$event->__get('content_varchar_5')?>">M&aacute; informaci&oacute;n</a></p>
												
													</div>
													<?php												
												
												}	
										
											
										}
										
										?>
							      <!--caja-detalle-->
										
										<p></p>
											<ul id="paginacion">
											  <li class="previous-off">&laquo; Anterior</li>
												<li class="active">1</li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
												<li><a href="#">4</a></li>
												<li><a href="#">5</a></li>
												<li><a href="#">6</a></li>
												<li class="next"><a href="#">Siguiente &raquo;</a></li>
											</ul>
											
									</div>		
									
								</div><!--bottom-->
							</div><!--top-->
						</div><!--caja-478-->
						
						
						
						
						
					
					</div><!--main-->
					
					<div id="secondary">
						<!---p><img src="../images/cartagena-hoteles-pauta.jpg" alt="cartagena-hoteles" /></p--->
					</div><!--secondary-->
					
					
				
				</div><!--columna-central-->

			</div><!-- contenido-general -->
<?php
require_once(SITE_VIEW . "footer.php");
?>    