		<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/kinetic.js"></script>
		<script type="text/javascript" src="<?php echo APPLICATION_URL?>javascripts/piechart.js"></script>
<script language="javascript">
	$(function () {
		totalPresicionWeight 	+= 1;
	});	
</script>
<div id="piechart" class="clearfix"></div>


	<div class="pie-numbers">


			<table class="table-chart tiempo">
				<tr>
					<td><label id="field1label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field1" name="usuario_tramites" /></td>
					<td><strong>Solidez<br /> Entidad</strong></td>
				</tr>
			</table>
		
			<table class="table-chart costo">
				<tr>
					<td><label id="field2label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field2" name="usuario_costo" /></td>
					<td><strong>Tramites<br /> Apertura</strong></td>
				</tr>
			</table>
			
			<table class="table-chart proteccion">
				<tr>
					<td><label id="field4label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field4" name="usuario_proteccion" /></td>
					<td><strong>Rentabilidad <br /> y costo</strong></td>
				</tr>
			</table>
		
			<table class="table-chart atencion">
				<tr>
					<td><label id="field5label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field5" name="usuario_facilidades" /></td>
					<td><strong>Disponibilidad<br /> y operatividad</strong></td>
				</tr>
			</table>
			
			<table class="table-chart uso">
				<tr>
					<td><label id="field6label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field6" name="usuario_facilidades_uso" /></td>
					<td><strong>Protección<br /> al consumidor </strong></td>
				</tr>
			</table>
			
			<table class="table-chart facilidades">
				<tr>
					<td><label id="field3label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field3" name="usuario_facilidades_pago" /></td>
					<td><strong>Atención<br />y calidad</strong></td>
				</tr>
			</table>
			
			<table class="table-chart beneficios">
				<tr>
					<td><label id="field7label" style="display:inline;"></label>%<input type="hidden" class="piechart-input" id="field7" name="usuario_beneficios" /></td>
					<td><strong>Cercanía de<br />cajeros y oficinas</strong></td>
				</tr>
			</table>
		
	</div>


	    <script>
	    chartInfo 	= new Array();
	    chartInfo1  = new Array();
	    
	    chartInfo[0] = {"percentage" : 14, "color" : '#1269b1', "fieldID" : 'field1', "percentageLabelID" : 'field1label'};
	    chartInfo[1] = {'percentage' : 14, 'color' : '#fddb02', 'fieldID' : 'field2', 'percentageLabelID' : 'field2label'};
	    chartInfo[2] = {'percentage' : 14, 'color' : '#bdcc2b', 'fieldID' : 'field3', 'percentageLabelID' : 'field3label'};
	    chartInfo[3] = {'percentage' : 14, 'color' : '#26b8eb', 'fieldID' : 'field4', 'percentageLabelID' : 'field4label'};
	    chartInfo[4] = {'percentage' : 14, 'color' : '#f58d48', 'fieldID' : 'field5', 'percentageLabelID' : 'field5label'};
	    chartInfo[5] = {'percentage' : 15, 'color' : 'orange', 'fieldID' : 'field6', 'percentageLabelID' : 'field6label'};
	    chartInfo[6] = {'percentage' : 15, 'color' : 'purple', 'fieldID' : 'field7', 'percentageLabelID' : 'field7label'};
	    window.onload = function() {
			initPieChart('piechart', 700, 400, chartInfo);
	}
	    </script>
