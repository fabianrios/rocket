<?php $nombre = explode("/", $path);
	$nombre = $nombre[1];?>
	<script>
			$(document).ready(function() {//DOCUMENTREADY
				
				var filename = '<?php echo $nombre; ?>';
				filename = filename.split("-");
				//console.log('filename = '+ filename[0]);
				$('.nav-bar li a').removeClass('activo');
				$('.nav-bar li a[title="'+filename[0]+'"]').addClass('activo');
				
				$('.config').click(function() {
				  console.log($(this));
				  $(this).find('.cancelar').slideToggle("fast");
				});
				
				
			//	$('.config').hover(
				//function() {
				  //console.log($(this));
				  //$(this).find('.cancelar').slideDown("fast");
				//},
				//function() {
				  //console.log("sale");
				  //$(this).find('.cancelar').slideUp("slow");
				//}
				//);
				
			});///DOCUMENTREADY
	</script>