<?php
$order 	= new Order($this->orderId);
?>
<table width="100%" class="centered table-questions">
	<tr>
        <td width="25% ">
            <div class="box">
                <a class="bluebox-1">
                <div class="padding-10">
                    <h5 class="whitetxt txt-shadow-black text-center no-maring"><strong>Compras Nacionales</strong></h5>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Las realizas?</strong></label>
                        <select name="compras-nal-opcion" rel="transactions2" id="tran1">
                                <option>Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        </select>
                    </div>                                                     
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces por mes?</strong></label>
                        <select name="compras-nal-cantidad" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=0; $i<101; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>                    
                        
                    </div>

                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;A cuantas cuotas difieres?</strong></label>
                        <select name="compras-nal-cuotas" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=1; $i<49; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>
                    </div>												
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;En promedio cuanto gasta al mes?</strong></label>
                        <input name="compras-nal-monto" class="input-blue" rel="transactions2" id="tran4"/>
                    </div>
                    </div>

                </a>
                <div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
            </div>
        </td>
        <td width="25% ">
            <div class="box">
                <a class="bluebox-1">
                <div class="padding-10">
                   <h5 class="whitetxt txt-shadow-black text-center no-maring"><strong>Compras por Internet</strong></h5>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Las realizas?</strong></label>
                        <select name="compras-int-opcion" rel="transactions2" id="tran5">
                                <option>Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        </select>
                    </div>                
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces por mes?</strong></label>
                        <select name="compras-int-cantidad" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=0; $i<101; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>                    
                        
                    </div>                                                         
										
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;En promedio cuanto gasta al mes?</strong></label>
                        <input name="compras-int-monto" class="input-blue" rel="transactions2" id="tran8"/>
                    </div>
                   	</div>
                </a>
                <div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
            </div>
        </td>     
        <td width="25% ">
            <div class="box">
                <a class="bluebox-1">
                <div class="padding-10">
                   <h5 class="whitetxt txt-shadow-black text-center no-maring"><strong>Compras internacionales</strong></h5>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Las realizas?</strong></label>
                        <select name="compras-intl-opcion" rel="transactions2" id="tran9">
                                <option>Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        </select>
                    </div>          
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces por mes?</strong></label>
                        <select name="compras-intl-cantidad" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=0; $i<101; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>                    
                        
                    </div>                                                                
											
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;En promedio cuanto gasta al mes?</strong></label>
                        <input name="compras-intl-monto" class="input-blue" rel="transactions2" id="tran12" />
                    </div>
                </div>
                </a>
                <div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
            </div>
        </td>
    </tr>     
    <tr>     
        <td width="25% ">
            <div class="box">
                <a class="bluebox-1">
                <div class="padding-10">
                   <h5 class="whitetxt txt-shadow-black text-center no-maring"><strong>Avances Nacionales</strong></h5>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Los realizas?</strong></label>
                        <select name="avances-nal-opcion" rel="transactions2" id="tran13" >
                                <option>Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        </select>
                    </div>                                                     
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces por mes?</strong></label>
                        <select name="avances-nal-cantidad" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=0; $i<101; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>                    
                        
                    </div> 
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;A cuantas cuotas difieres?</strong></label>
                        <select name="avances-nal-cuotas" rel="transactions2"  id="tran15">
                        	<?php 
                            for ($i=1; $i<37; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>
                    </div>												
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;En promedio cuanto gasta al mes?</strong></label>
                        <input name="avances-nal-monto" class="input-blue" rel="transactions2" id="tran16"/>
                    </div>
                </div>
                </a>
                <div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
            </div>
        </td>  
        <td width="25% ">
            <div class="box">
                <a class="bluebox-1">
                <div class="padding-10">
                   <h5 class="whitetxt txt-shadow-black text-center no-maring"><strong>Avances Internacionales</strong></h5>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Los realizas?</strong></label>
                        <select name="avances-intl-opcion" rel="transactions2" id="tran17">
                                <option>Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        </select>
					</div>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces por mes?</strong></label>
                        <select name="avances-intl-cantidad" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=0; $i<101; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>                    
                        
                    </div> 
											
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;En promedio cuanto gasta al mes?</strong></label>
                        <input name="avances-nal-monto" class="input-blue" rel="transactions2" id="tran20"/>
                    </div>
                   	</div>
                </a>
                <div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
            </div>
        </td> 
        
        
        
                            
        <td width="25% ">
            <div class="box">
                <a class="bluebox-1">
                <div class="padding-10">
                  <h5 class="whitetxt txt-shadow-black text-center no-maring"><strong>Pago Impuestos</strong></h5>
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Las realizas?</strong></label>
                        <select name="pagos-imp-opcion" rel="transactions2" id="tran21">
                                <option>Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        </select>
                    </div>  
                     <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;Cuantas veces por mes?</strong></label>
                        <select name="pagos-imp-cantidad" rel="transactions2" id="tran3" >
                        	<?php 
                            for ($i=0; $i<101; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>                    
                        
                    </div>                                                                      
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;A cuantas cuotas difieres?</strong></label>
                        <select name="pagos-imp-cuotas" rel="transactions2"  id="tran23">
                        	<?php 
                            for ($i=1; $i<49; $i++)
								echo '<option value="'.$i.'">'.$i.'</option>"'; 
							?>	
							
                        </select>
                    </div>												
                    <div class="box-select">
                    <label class="whitetxt txt-shadow-black"><strong>&iquest;En promedio cuanto gasta al mes?</strong></label>
                        <input name="avances-nal-monto" class="input-blue" rel="transactions2"  id="tran24"/>
                    </div>
                   	</div>
                </a>
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
    <input class="precision-data" type="hidden" id="tran13-weight" name="tran13-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran14-weight" name="tran14-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran15-weight" name="tran15-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran16-weight" name="tran16-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran17-weight" name="tran17-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran18-weight" name="tran18-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran19-weight" name="tran19-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran20-weight" name="tran20-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran21-weight" name="tran21-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran22-weight" name="tran22-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran23-weight" name="tran23-weight" value="<?php echo $order->__get('order_peso')?>">	
    <input class="precision-data" type="hidden" id="tran24-weight" name="tran24-weight" value="<?php echo $order->__get('order_peso')?>">	