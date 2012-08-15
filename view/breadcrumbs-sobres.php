<div class="row">
	<!-- breadcrumb -->
	<ol class="breadcrumb-descubra clearfix">
		<li class="start-li">
			<span aria-hidden="true" data-icon="w"></span>
		</li>
		<li>
			Ingresos <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span>
		</li>
		<li>
			Configuración <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span>
		</li>
		<li>
			Tus Sobres <span aria-hidden="true" class="light-greytxt" data-icon="f"></span><span class="dot-1"></span>
		</li>
		<li class="finish-li">
			<span aria-hidden="true" data-icon="a"></span>
		</li>
	</ol>
</div><!-- /breadcrumb -->
<script type="text/javascript">

	$(document).ready(function () {
	var breads =  <?php echo $js_array; ?>	;
	$.each(breads, function(key, value) {
		$("li:contains(" + value + ")").addClass("active-bread");
		if (value == "Tus Sobres") {
			$("li.finish-li").find("span").addClass("bluetxt");
		}
	});
	$("li:contains('" + breads[breads.length - 1] + "')").find(".light-greytxt").removeClass("light-greytxt").addClass("bluetxt");
	});

</script>