
<div class="row"><!-- breadcrumb -->
		<ol class="breadcrumb clearfix">
			<li class="start-li"><span aria-hidden="true" data-icon="w"></span></li>
			<li>Selección <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><a href="<?php echo APPLICATION_URL ?>diagnostico-metas.html" class="dot-1"></a></li>
			<li>Planeación <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><a href="<?php echo APPLICATION_URL ?>diagnostico-planeacion.html" class="dot-1"></a></li>
			<li>Consumo <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><a href="<?php echo APPLICATION_URL ?>diagnostico-consumo.html" class="dot-1"></a></li>
			<li>Finanzas <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><a href="<?php echo APPLICATION_URL ?>diagnostico-finanzas.html" class="dot-1"></a></li>
			<li class="finish-li"><span aria-hidden="true" data-icon="a"></span></li>
		</ol>
</div><!-- /breadcrumb -->
<script type="text/javascript">
	
$(document).ready(function () {
	var breads =  <?php echo $js_array; ?>	;
	$.each(breads, function(key, value) {
		$("li:contains(" + value + ")").addClass("active-bread");
		if (value == 1) {
			$("li.finish-li").find("span").addClass("bluetxt");
		}
	});
	$("li:contains('" + breads[breads.length - 1] + "')").find(".light-greytxt").removeClass("light-greytxt").addClass("bluetxt");
	});


</script>