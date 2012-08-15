<?php
UserHelper::setData($this->user->__get('user_id'), 'retiro-opcion', "");
UserHelper::setData($this->user->__get('user_id'), 'consignaciones-opcion', "");
UserHelper::setData($this->user->__get('user_id'), 'transferencias-opcion', "");
UserHelper::setData($this->user->__get('user_id'), 'servicios-opcion', "");
$canales 		= "1=> Oficina|4=> Cajero|8=> CNB|7=>Cajeros internacionales";
$optionArray 	= explode('|', $canales);
$tipo			= 'retiro';
$order 	= new Order($this->orderId);
?>
								<table width="100%" class="centered table-questions">
									<tr>
										<td width="20% ">
											<div class="box">
												<div class="bluebox-1 text-center">
												<div class="padding-10">
                                                
													<h5 class="whitetxt txt-shadow-black no-margin"><strong>Retiros<strong></h5>                                                    
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Que canal utilizar&iacute;as?</strong></label>
                                                        <select name="<?php echo $tipo;?>-opcion" rel="transactions1" id="tran1">
                                                                <option value="">Seleccione</option>
																<?php
                                                                foreach($optionArray as $option)
                                                                {
                                                                    $values = explode('=>', $option);
                                                                    ?>
                                                                    <option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>    													
                                                    <div class="box-select">
													<label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces al mes lo har&iacute;a?</strong></label>  
														<select name="<?php echo $tipo;?>-cantidad" rel="transactions1" id="tran2">
																<option value="">Seleccione</option>
                                                                <?php for($i = 1; $i < 201; $i++)
																{
																?>
                                                                	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                <?php
																}
																?>
														</select>
													</div>
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuanto dinero al mes retir&iacute;as?</strong></label>
                                                        <input name="<?php echo $tipo;?>-monto" class="input-blue" rel="transactions1" id="tran3"/>
                                                    </div>                                                    
												</div>
												</div>
												<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
											</div>
										</td>
<?php
$canales 		= "1=> Oficina|4=> Cajero|8=>CNB";
$optionArray 	= explode('|', $canales);
$tipo			= 'consignaciones';
?>                                        
										<td width="20% ">
											<div class="box">
												<div class="bluebox-1 text-center">
												<div class="padding-10">
                                                
													<h5 class="whitetxt txt-shadow-black no-margin"><strong>Consignaciones<strong></h5>                                                    
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Que canal utilizar&iacute;as?</strong></label>
                                                        <select name="<?php echo $tipo;?>-opcion" rel="transactions1" id="tran4">
                                                                <option value="">Seleccione</option>
																<?php
                                                                foreach($optionArray as $option)
                                                                {
                                                                    $values = explode('=>', $option);
                                                                    ?>
                                                                    <option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>    													
                                                    <div class="box-select">
													<label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces al mes lo har&iacute;a?</strong></label>  
														<select name="<?php echo $tipo;?>-cantidad" rel="transactions1" id="tran5">
																<option value="">Seleccione</option>
                                                                <?php for($i = 1; $i < 201; $i++)
																{
																?>
                                                                	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                <?php
																}
																?>
														</select>
													</div>
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuanto dinero al mes consignar&iacute;as?</strong></label>
                                                        <input name="<?php echo $tipo;?>-monto" class="input-blue" rel="transactions1" id="tran6"/>
                                                    </div>                                                    
												</div>
												</div>
												<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
											</div>
										</td>
<?php
$canales 		= "1 => Oficina| 4 => Cajero| 8 => CNB| 12 => Internet| 13 => Audio respuesta| 15 => Banca móvil";
$optionArray 	= explode('|', $canales);
$tipo			= 'transferencias';
?>                                          
										<td width="20% ">
											<div class="box">
												<div class="bluebox-1 text-center">
												<div class="padding-10">
                                                
													<h5 class="whitetxt txt-shadow-black no-margin"><strong>Transferencias a otros bancos<strong></h5>                                                    
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Que canal utilizar&iacute;as?</strong></label>
                                                        <select name="<?php echo $tipo;?>-opcion" rel="transactions1" id="tran7">
                                                                <option value="">Seleccione</option>
																<?php
                                                                foreach($optionArray as $option)
                                                                {
                                                                    $values = explode('=>', $option);
                                                                    ?>
                                                                    <option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>    													
                                                    <div class="box-select">
													<label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces al mes lo har&iacute;a?</strong></label>  
														<select name="<?php echo $tipo;?>-cantidad" rel="transactions1" id="tran8">
																<option value="">Seleccione</option>
                                                                <?php for($i = 1; $i < 201; $i++)
																{
																?>
                                                                	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                <?php
																}
																?>
														</select>
													</div>
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuanto dinero al mes transferir&iacute;as?</strong></label>
                                                        <input name="<?php echo $tipo;?>-monto" class="input-blue" rel="transactions1" id="tran9"/>
                                                    </div>                                                    
												</div>
												</div>
												<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
											</div>
										</td>
									
																		
									
									</tr>
<?php
$canales 		= "1 => Oficina| 4 => Cajero| 8 => CNB| 12 => Internet| 13 => Audio respuesta| 15 => Banca móvil";
$optionArray 	= explode('|', $canales);
$tipo			= 'servicios';
?>                                          
										<td width="20% ">
											<div class="box">
												<div class="bluebox-1 text-center">
												<div class="padding-10">
                                                
													<h5 class="whitetxt txt-shadow-black no-margin"><strong>Pagar serv&iacute;cios p&uacute;blicos</strong></h5>                                                    
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Que canal utilizar&iacute;as?</strong></label>
                                                        <select name="<?php echo $tipo;?>-opcion" rel="transactions1" id="tran10">
                                                               <option value="">Seleccione</option>
																<?php
                                                                foreach($optionArray as $option)
                                                                {
                                                                    $values = explode('=>', $option);
                                                                    ?>
                                                                    <option value="<?php echo $values[0]?>"><?php echo $values[1]?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>    													
                                                    <div class="box-select">
													<label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces al mes lo har&iacute;a?</strong></label>  
														<select name="<?php echo $tipo;?>-cantidad" rel="transactions1" id="tran11">
																<option value="">Seleccione</option>
                                                                <?php for($i = 1; $i < 201; $i++)
																{
																?>
                                                                	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                <?php
																}
																?>
														</select>
													</div>
                                                    <div class="box-select">
                                                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuanto dinero al mes pagar&iacute;s serv&iacute;cios?</strong></label>
                                                        <input name="<?php echo $tipo;?>-monto" class="input-blue" rel="transactions1" id="tran12"/>
                                                    </div>                                                    
												</div>
												</div>
												<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
											</div>
										</td>
									</tr>    								
								</table>
    <input class="precision-data" type="hidden" id="tran1-weight" name="tran1-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran2-weight" name="tran2-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran3-weight" name="tran3-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran4-weight" name="tran4-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran5-weight" name="tran5-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran6-weight" name="tran6-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran7-weight" name="tran7-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran8-weight" name="tran8-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran9-weight" name="tran9-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran10-weight" name="tran10-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran11-weight" name="tran11-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran12-weight" name="tran12-weight" value="<?php echo $order->__get('order_peso')?>">	
