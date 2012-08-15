
<div class="row"><!-- breadcrumb -->
		<ol class="breadcrumb-metas clearfix">
			<li class="start-li"><span aria-hidden="true" data-icon="e"></span></li>
			<li>Selección <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span></li>
			<li>Costos <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span></li>
			<li>Finanzas <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span></li>
			<li>Cuota <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span></li>
			<li>Resultado <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span></li>
			<li class="finish-li"><span aria-hidden="true" data-icon="a"></span></li>
		</ol>
</div><!-- /breadcrumb -->
<script type="text/javascript">
	
$(document).ready(function () {
	
	var breads =  <?php echo $js_array; ?>;
	//console.log("breads: "+breads);
	//console.log(breads.length);
	$.each(breads, function(key, value) { 
		//console.log(key + ': ' + value);
		$("li:contains("+value+")").addClass("active-bread");
		if(value == "Resultado"){
			$("li.finish-li").find("span").addClass("bluetxt");
		}
	});
	
	$("li:contains('"+breads[breads.length-1]+"')").find(".light-greytxt").removeClass("light-greytxt").addClass("bluetxt");
	});

</script>