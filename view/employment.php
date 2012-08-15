<?php
$options = "1=>Empleado|2=>Desempleado|3=>Estudiante|4=>Ama de casa|5=>Indepediente|6=>Rentista|7=>Pensionado";
$optionArray = explode('|', $options);
$order = new Order($this->orderId);
$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
?>
<table width="40%" class="centered table-questions">
    <tr>
        <td>	
        	<div class="box" >
                <a class="bluebox-1">
                <div class="padding-10">
                <label class="whitetxt text-center txt-shadow-black"><strong>&iquest;A qué te dedicas?</strong></label>		
                    <div class="box-select text-center">
                        <select name="usuario_trabajo" onchange="if(this.value == 1) { $('#employmentPanel2').show(); $('#employmentPanel3').hide(); $('#employmentPanel4').hide();} else if(this.value == 5) { $('#employmentPanel2').hide(); $('#employmentPanel3').show(); $('#employmentPanel4').hide();}  else if(this.value == 3) { $('#employmentPanel2').hide(); $('#employmentPanel3').hide(); $('#employmentPanel4').show();}" id="user_job" class="userdata <?php echo $validable?>" title="¿A qué te dedicas?">
                            <option value="NULL">Seleccione</option>
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
               </div>				
               </a>	
			</div>
            <div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
		</td>
	
	</tr>
	<tr>
	
    	<td >
    
    
    
    <div id="employmentPanel2" style="display: none;">
<?php
$options = "1=> Abogado|2=> Agronomía|3=> Arquitecto|4=> Ciencias básicas|5=> Ciencias sociales|6=> Contador|7=> Diseñador|8=> Economista|9=> Empleado publico|10=> Estudiante universitario|11=> Ingeniero|12=> Negocios, administración y comercio|13=> Profesional del área de la salud|14=> Profesor o Docente";
$optionArray = explode('|', $options);
?>
        	
        	
        	<div class="box" >
                <a class="bluebox-1">
                <div class="padding-10">	
					<label class="whitetxt text-center txt-shadow-black"><strong>&iquest;Le aplica alguno de estas ocupaciones?</strong></label>
                    <div class="box-select text-center">
                        <select class="userdata" name="usuario_trabajo_empleado" onchange="" title="">
                            <option value"0">Seleccione</option>
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
			</div>
            </a>
            </div>
			<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
	</div>
	
    <div id="employmentPanel3" style="display: none;">
<?php
$options = "1=> Abogado|2=> Agronomía|3=> Arquitecto|4=> Ciencias básicas|5=> Ciencias sociales|6=> Contador|7=> Diseñador|8=> Economista|9=> Empleado publico|10=> Estudiante universitario|11=> Ingeniero|12=> Negocios, administración y comercio|13=> Profesional del área de la salud|14=> Profesor o Docente";
$optionArray = explode('|', $options);
?>
        	<div class="box" >
                <a class="bluebox-1">		
                <div class="padding-10">	
					<label class="whitetxt text-center txt-shadow-black"><strong>&iquest;Le aplica alguno de estos oficios?</strong></label>
                    <div class="box-select text-center">				
                        <select class="userdata" name="usuario_trabajo_independiente" onchange="">
                            <option value"0">Seleccione</option>
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
				</div>
            </a>
            </div>
			<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
        </div>    	
	
    <div id="employmentPanel4" style="display: none;">
<?php
$options = "1=> Escuela Colombiana de Ingeniería|2=> Escuela de Ingeniería de Antioquia|3=> Fundación Universidad Central|4=> Fundación Universidad del Norte|5=> Fundación Universitaria Konrad Lorenz|6=> Fundación Universitaria Los Libertadores|7=> Instituto Tecnológico Metropolitano|8=> Pontificia Universidad Javeriana|9=> Pontificia Universidad Javeriana-Cali|10=> Universidad Antonio Nariño|11=> Universidad Autónoma de Bucaramanga|12=> Universidad Autónoma de Colombia|13=> Universidad Autónoma de Manizales|14=> Universidad Autónoma de Occidente|15=> Universidad Católica de Colombia|16=> Universidad Católica de Manizales|17=> Universidad CES|18=> Universidad Cooperativa de Colombia|19=> Universidad de Antioquia|20=> Universidad de Caldas|21=> Universidad de Cartagena|22=> Universidad de Ciencias Aplicadas y Ambientales|23=> Universidad de Córdoba|24=> Universidad de Ibagué|25=> Universidad de la Sabana|26=> Universidad de la Salle|27=> Universidad de los Andes|28=> Universidad de los Llanos|29=> Universidad de Manizales|30=> Universidad de Medellín|31=> Universidad de Nariño|32=> Universidad de Pamplona|33=> Universidad de San Buenaventura|34=> Universidad del Atlántico - Barranquilla|35=> Universidad del Cauca|36=> Universidad del Magdalena|37=> Universidad del Quindío|38=> Universidad del Rosario|39=> Universidad del Tolima|40=> Universidad del Valle|41=> Universidad Distrital Francisco José de Caldas|42=> Universidad EAFIT|43=> Universidad EAN|44=> Universidad el Bosque|45=> Universidad Externado de Colombia|46=> Universidad Francisco de Paula Santander|47=> Universidad ICESI|48=> Universidad Industrial de Santander|49=> Universidad Libre|50=> Universidad Libre|51=> Universidad Militar Nueva Granada|52=> Universidad Nacional de Colombia|53=> Universidad Nacional de Colombia|54=> Universidad Nacional de Colombia|55=> Universidad Nacional de Colombia - Manizales|56=> Universidad Pedagógica Nacional|57=> Universidad Pedagógica y Tecnológica de Colombia|58=> Universidad Piloto de Colombia|59=> Universidad Pontificia Bolivariana|60=> Universidad San Buenaventura|61=> Universidad Santo Tomás|62=> Universidad Santo Tomás - Bogotá|63=> Universidad Sergio Arboleda|64=> Universidad Simón Bolívar - Barranquilla|65=> Universidad Tecnológica de Pereira|66=> Universidad Tecnológica del Chocó|67=> Universidad Jorge Tadeo Lozano|68=> Politécnico Gran Colombiano|69=> Otra";
$optionArray = explode('|', $options);
?>
        	<div class="box" >
                <a class="bluebox-1">		
                <div class="padding-10">	
					<label class="whitetxt text-center txt-shadow-black"><strong>&iquest;En que universidad estudia actualmente?</strong></label>
                    <div class="box-select text-center">				
                        <select class="userdata" name="usuario_estudia_universidad" onchange="">
                            <option value"0">Seleccione</option>
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
				</div>
            </a>
            </div>
			<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-bluebox.png" alt="" width="" height=""></div>
        </div>	

    
		</td>
	</tr>
    <input class="precision-data" type="hidden" id="user_job-weight" name="user_job-weight" value="<?php echo $order->__get('order_peso')?>">
</table>                        