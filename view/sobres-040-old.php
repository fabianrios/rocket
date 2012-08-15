<?php
$user = new User($_SESSION['user_active']);
if(!isset($_SESSION["visited_dashboard"]))
{
	unset($_SESSION["updated_envelopes"]);
	$_SESSION["visited_dashboard"] = true;
}
//$currentPeriodTotalExpenses 		= UserEnvelopeHelper::getPeriodTotalExpenses();
$currentPeriodRecurringItems	 	= EnvelopeItemHelper::RetrieveEnvelopeItems("AND envelope_bag_id != '0' ");
//$currentPeriodDailyItems	 		= UserEnvelopeHelper::getPeriodItems($userEnvelope, 'daily');
$userEnvelopesLogs					= UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_id = " . $user->__get('user_id') . " GROUP BY MONTH(user_envelope_log_date)  ORDER BY user_envelope_log_date");
$userEnvelopes 				= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_budget != '0' AND user_envelope_budget != '' ORDER BY user_envelope_name DESC");
$highUserEnvelopes 			= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_budget != '0' AND user_envelope_budget != '' AND user_envelope_priority = 1 ORDER BY user_envelope_name DESC");
$mediumUserEnvelopes 		= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_budget != '0' AND user_envelope_budget != '' AND user_envelope_priority = 2 ORDER BY user_envelope_name DESC");
$lowUserEnvelopes 			= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_budget != '0' AND user_envelope_budget != '' AND user_envelope_priority = 3 ORDER BY user_envelope_name DESC");
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
<meta charset="ISO-8859-1" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />

	<title>Rocket: Herramientas inteligentes para manejar mejor tu dinero</title>

		<meta name="description" content="SITE DESCRIPTION" />
		<meta name="keywords" content="SITE KEYWORDS" />
		<meta name="copyright" content="SITE COPYRIGHT" />
		<meta name="author" content="Metaphysic"/>
		<meta name="Distribution" content="Global" />
		<meta name="Rating" content="General" />
		<meta name="Robots" content="INDEX,FOLLOW" />
		<meta name="Revisit-after" content="90 Days" />
  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/foundation.css">
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/jquery-ui-1.8.20.custom.css" type="text/css" />
	<script language="JavaScript">
		var ApplicationUrl = '<?php echo APPLICATION_URL?>';
	</script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/envelopes-behaviors.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_lib.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/ajax_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/form_parser_helper.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>js/helpers.js" ></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo APPLICATION_URL?>favicon.ico" />
	

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="<?php echo APPLICATION_URL?>http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <script type="text/javascript">
    //GAUGES
      google.load('visualization', '1', {packages:['gauge']});
      //PE CHART
	 google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Gasto', 'Hours per Day'],
	          <?php
	          $first = true;

	          foreach($userEnvelopes as $userEnvelope)
			  {

					$currentPeriodExpenses 	= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
					if(!$first)
						echo ',';
					else
						$first = false;
					echo "['" . $userEnvelope->__get('user_envelope_name') . "', " . $currentPeriodExpenses . "]";
			  }

			  ?>
	        ]);
	        var options = {
	          title: ''
	        };		
	        var chart = new google.visualization.PieChart(document.getElementById('chart_div_participation'));
	        chart.draw(data, options);
	        
	        <?php
	        $currentPeriodExpenses	= 0;
	        foreach($highUserEnvelopes as $userEnvelope)
			{
				$currentPeriodExpenses 	+= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
			}
	        ?>
	        var data = google.visualization.arrayToDataTable([
	          ['Label', 'Value'],
	          ['Indispensables', <?php echo $currentPeriodExpenses?>],
	        ]);
	
	        var options = {
	          width: 500, height: 200,
	          redFrom: <?php echo $currentPeriodExpenses * 0.9?>, redTo: <?php echo $currentPeriodExpenses?>,
	          yellowFrom:<?php echo $currentPeriodExpenses * 0.7?>, yellowTo: <?php echo $currentPeriodExpenses * 0.9?>,
	          minorTicks: 5,
	          max: '250'
	        };
	
	        var chart = new google.visualization.Gauge(document.getElementById('chart_div_left'));
	        chart.draw(data, options);
	        
	        <?php
	        $currentPeriodExpenses	= 0;
	        foreach($mediumUserEnvelopes as $userEnvelope)
			{
				$currentPeriodExpenses 	+= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
			}	        
	        ?>
	        
	        var data = google.visualization.arrayToDataTable([
	          ['Label', 'Value'],
	          ['Necesarias', <?php echo $currentPeriodExpenses?>]
	        ]);
	
	        var options = {
	          width: 500, height: 200,
	          redFrom: <?php echo $currentPeriodExpenses * 0.9?>, redTo: <?php echo $currentPeriodExpenses?>,
	          yellowFrom:<?php echo $currentPeriodExpenses * 0.7?>, yellowTo: <?php echo $currentPeriodExpenses * 0.9?>,
	          minorTicks: 5
	        };
	
	        var chart = new google.visualization.Gauge(document.getElementById('chart_div_center'));
	        chart.draw(data, options);

	        <?php
	        $currentPeriodExpenses	= 0;
	        foreach($lowUserEnvelopes as $userEnvelope)
			{
				$currentPeriodExpenses 	+= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
			}	        
	        ?>

	        
			var data = google.visualization.arrayToDataTable([
	          ['Label', 'Value'],
	          ['Remotas', <?php echo $currentPeriodExpenses?>]
	        ]);
	
	        var options = {
	          width: 500, height: 200,
	          redFrom: <?php echo $currentPeriodExpenses * 0.9?>, redTo: <?php echo $currentPeriodExpenses?>,
	          yellowFrom:<?php echo $currentPeriodExpenses * 0.7?>, yellowTo: <?php echo $currentPeriodExpenses * 0.9?>,
	          minorTicks: 5
	        };
	
	        var chart = new google.visualization.Gauge(document.getElementById('chart_div_right'));
	        chart.draw(data, options);
          
	      }
	  // COMBO CHART
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Gasto', 'Ejecucion del presupuesto'],
          <?php
          $first = true;
          foreach($userEnvelopes as $userEnvelope)
		  {
			$currentPeriodExpenses 	= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
			$totalPeriodBudget		= $userEnvelope->__get('user_envelope_budget');
			
		  	if(!$first)
				echo ',';
			else
				$first = false;
		  	
		  	echo "['" . formatDate("%B %Y", date('Y-m-d')) . "', " . $currentPeriodExpenses . ", " . (($currentPeriodExpenses / $totalPeriodBudget) * 100) . "]";
			
		  }
		  ?>
        ]);

        var options = {
          vAxes: [{title: "Monto"}, {title: "Porcentaje"}],
          hAxis: {title: "Mes"},
          seriesType: "bars",
          series: {0: {type: "line"}, 1:{targetAxisIndex:1}, vAxes:{1:{title:'Porcentaje'}}}
        };
//series:{2:{targetAxisIndex:1}}, vAxes:{1:{title:'Losses',textStyle:{color: 'red'}}}
        var chart = new google.visualization.ComboChart(document.getElementById('chart_div_hystoric'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>

</head>

<body>


<!--1. HEADER -->
<?php	
include_once('header.php');	
require_once(SITE_VIEW . "check_envelopes.php");

$userEnvelopes = UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_budget != '0' AND user_envelope_budget != '' ORDER BY user_envelope_name DESC");

$alerts		   = array("warnings" => array(),
					   "reminders" => array(),
					   "soon_expiring" => array());
$nextPaymentsShortArray = array();
$nextPaymentsLongArray  = array();
$previousPaymentsArray	= array();
$envelopeExtras			= array();

/*$allUserEnvelopes 		= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . "");

$groupedUserEnvelopes 	= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " GROUP BY envelope_id");

$highUserEnvelopes 		= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_priority = 1");

$mediumUserEnvelopes 	= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_priority = 2");

$lowUserEnvelopes 		= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_priority = 3");*/
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	


		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
				
					<!-- Budget Detail 1 -->
					<div class="budget-detail">
					<div class="b-shadow">
						
						<div class="row"><!-- Row -->
							<div class="eleven columns centered">
								<div class="bugdet-innerheader clearfix">
									<div class="budget-ribbon">
										<div class="budget-title left"><span class="sprite-1 folder left">icon</span><h3 class="left whitetxt txt-shadow-black"><strong>Resumen</strong></h3><span class="sprite-1 info left">icon</span></div><div class="sprite-1 ribbon-detail left">icon</div>
									</div>
									<div class="budget-btn">
										<a href="<?php echo APPLICATION_URL?>#" class="button radius graph_button selected" rel="hystoric">Gasto hist&oacute;rico</a>
										<a href="<?php echo APPLICATION_URL?>#" class="button radius graph_button" rel="priorities">Gasto por prioridades</a>
										<a href="<?php echo APPLICATION_URL?>#" class="button radius graph_button" rel="participation">Participaci&oacute;n de sobres</a>
									</div>
								</div>
								
							</div>
						</div><!-- End Row -->
						
					<div class="row budget-chart"  id="chart_div_hystoric"></div><!-- Row/Chart --><!-- End Row -->
					<div class="row budget-chart"  id="chart_div_priorities" style="display:none">
						<div style="display:inline; float:right; margin-right: 200px;" id="chart_div_left"></div>
						<div style="display:inline; float:right;" id="chart_div_center"></div>
						<div style="display:inline; float:right;" id="chart_div_right"></div>
						
					</div><!-- Row/Chart --><!-- End Row -->			<div class="row budget-chart"  id="chart_div_participation" style="display:none"><!-- Row/Chart -->
						
					</div>	

					<!-- End Budget Detail -->
					
					<div class="budget-main clearfix"><!-- Budget Main -->
						<div class="budget-col1 left"><!-- Col 1 Sidebar -->
							<ul class="budget-ul clearfix">

								<li class="budget-li active-sidebar"><div class="sprite-1 sobres-icon-2 left margin-left">icon</div>
								<p class="left bugdet-li-p margin-top-10"><strong><a href="<?php echo APPLICATION_URL?>sobres-040.html" class="whitetxt">Resumen</a></strong></p></li>
								<?php
								
								foreach($userEnvelopes as $userEnvelope)
								{
									//$envelope 				= new Envelope($userEnvelope->__get('envelope_id'));
									$currentPeriodExpenses 	= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
									
									$classExtra = '';
									if($currentPeriodExpenses > $userEnvelope->__get('user_envelope_budget'))
									{
										$classExtra = '-red';
										
										$alerts["warnings"]["exceded"][] = $userEnvelope->__get('user_envelope_name') . '|' . formatNumber($currentPeriodExpenses) . '|' . formatNumber($userEnvelope->__get('user_envelope_budget'));
									}
									elseif($currentPeriodExpenses == $userEnvelope->__get('user_envelope_budget'))
									{
										$classExtra = '-red';
										
										$alerts["warnings"]["maxed"][] = $userEnvelope->__get('user_envelope_name') . '|' . formatNumber($currentPeriodExpenses) . '|' . formatNumber($userEnvelope->__get('user_envelope_budget'));
									}
									elseif($currentPeriodExpenses >= ($userEnvelope->__get('user_envelope_budget') * 0.9))
									{
										$classExtra = '-red';
										
										$alerts["warnings"]["almost-maxed"][] = $userEnvelope->__get('user_envelope_name') . '|' . formatNumber($currentPeriodExpenses) . '|' . formatNumber($userEnvelope->__get('user_envelope_budget'));
									}
									
									$nextPaymentsShort = UserEnvelopeHelper::getNextPayments($userEnvelope, 7);
									$nextPaymentsLong  = UserEnvelopeHelper::getNextPayments($userEnvelope, 30, 7);
									$previousPayments  = UserEnvelopeHelper::getPreviousPayments($userEnvelope, 30, 30);
									$nextPaymentsShortArray 	= $nextPaymentsShort + $nextPaymentsShortArray;
									$nextPaymentsLongArray 		= $nextPaymentsLong + $nextPaymentsLongArray;
									$previousPaymentsArray 		= $previousPayments + $previousPaymentsArray;
									?>
									<li class="budget-li"><div class="sprite-1 folder-small<?php echo $classExtra?> left">icon</div>
								<p class="left bugdet-li-p"><a href="<?php echo APPLICATION_URL?>sobres-030/<?php echo $userEnvelope->__get('user_envelope_id')?>.html"><?php echo $userEnvelope->__get('user_envelope_name')?><a/><br /><span class="small grey">$<?php echo formatNumber($currentPeriodExpenses);?> de $<?php echo formatNumber($userEnvelope->__get('user_envelope_budget'))?> </small></p></li>
									<?php
								}
								ksort($nextPaymentsShortArray);
								ksort($nextPaymentsLongArray);
								krsort($previousPaymentsArray);
								$alerts["soon_expiring"] 	= $nextPaymentsShortArray;
								$alerts["reminders"]		= $nextPaymentsLongArray;

								?>
								<li class="budget-li text-center"><a href="<?php echo APPLICATION_URL?>sobres-010.html" class="add grey"><span class="sprite-1 add-icon">Agregar un nuevo sobre</span></a></li>
							</ul>
						</div><!-- Col 1 Sidebar -->
						
						<div class="budget-col2 left"><!-- Col 2 Mainbar -->
						
						
						

							<div class="agregar-gasto-block"><!-- Block: Agregar gasto -->
								<div class="agregar-gasto">
									<div class="container-2">
										<div class="row">
											<div class="four columns"><!-- elem. Agregar Btn -->
												<a href="<?php echo APPLICATION_URL?>#" class="add grey"><span class="sprite-1 add-icon add-expense">Agregar nuevo gasto</span></a>
											</div><!-- End Elem: Agregar Btn -->
											<div class="four columns"><!-- Elem. Buscar -->
												
											</div><!-- end elem. Buscar -->

										</div>
									</div>
								</div>
								<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-1.png" alt="" width="" height=""></div>
							</div><!-- Block: Agregar gasto -->
							
							<div class="expand-box left"><!-- Block: Agregar gasto expand -->

							<?php
							require_once(SITE_VIEW . "add_expense_block.php");
							?>
								
							</div><!-- Block: Agregar gasto expand -->
							
							
							
							<div class="notificaciones"><!-- Block: Notificaciones -->
								<div class="container-2">
									<p class="grey no-margin"><strong>Notificaciones y alertas</strong></p>
									<table class="notificaciones-table">
										<?php
										require_once(SITE_VIEW . "alert_parser.php");
										?>
									
									</table>
								</div>
							</div><!-- end Block: Notificaciones -->
							
							
							<div class="ultimo-gasto-block"><!-- Block: Ultimo gasto -->
								
								<div class="ultimo-gasto-bar"><!-- barra azul -->
									<div class="container-2">
										<p class="no-margin"><strong>&Uacute;ltimos gastos incluidos</strong></p>
									</div>
								</div><!-- barra azul -->
								
								<div class="ultimos-gasto-items"><!-- Ultimos gastos Table -->
									<div class="container-2">
										<table summary="Table summary" width="100%" class="table-gastos">
											 <thead>
											 <tr>
											  <th scope="col" width="20%">Nombre</th>
											  <th scope="col" width="20%">Sobre</th>
											  <th scope="col" width="20%">Categor&iacute;a</th>
											  <th scope="col" width="20%">Monto</th>
											  <th scope="col" width="15%">Fecha</th>
											  <th scope="col" width="5%"></th>
											</tr>
											</thead>
											<?php
											$userEnvelopeExtraItemArray	= EnvelopeItemHelper::retrieveEnvelopeItems("AND user_id = " . $user->__get('user_id') . " AND envelope_bag_id = 0 AND envelope_item_save != 1 ORDER BY envelope_item_payday DESC LIMIT 0,10");	
											foreach($userEnvelopeExtraItemArray as $userEnvelopeExtraItem)
											{
												$userEnvelope = new UserEnvelope($userEnvelopeExtraItem->__get('user_envelope_id'));
												$envelopeCategory = new EnvelopeCategory($userEnvelopeExtraItem->__get('envelope_category_id'));
												?>
												<tr>
													<td><?php echo $userEnvelopeExtraItem->__get('envelope_item_name')?></td>
													<td><strong><?php echo $userEnvelope->__get('user_envelope_name')?></strong></td>	
													<td><strong><?php echo $envelopeCategory->__get('envelope_category_name')?></strong></td>	
													<td>$<?php echo formatNumber($userEnvelopeExtraItem->__get('envelope_item_value'))?></td>
													<td><?php echo formatDate('%b %d', $userEnvelopeExtraItem->__get('envelope_item_payday'))?></td>
												  	<td><a href="<?php echo APPLICATION_URL?>envelopes.controller/delete_envelope_extra/<?php echo $userEnvelopeExtraItem->__get('envelope_item_id')?>.html" onclick="return confirm('Esta seguro que desea borrar este gasto?')" title="">_</a><span class="sprite-1 trash-icon">Icon</span></a></td>
												</tr>
												<?php
											}
											?>

										</table>
									</div>
								</div><!-- end Ultimos gastos Table -->
								
								
							</div><!-- Block: Ultimo gasto -->
							

							<div class="ultimo-gasto-block"><!-- Block: Ultimo gasto recurrente -->
								
								<div class="ultimo-gasto-bar"><!-- barra azul -->
									<div class="container-2">
										<p class="no-margin"><strong>&Uacute;ltimos gastos recurrentes</strong></p>
									</div>
								</div><!-- barra azul -->
								
								<div class="ultimos-gasto-items"><!-- Ultimos gastos Table -->
									<div class="container-2">
										<table summary="Table summary" width="100%" class="table-gastos">
											 <thead>
											 <tr>
											  <th scope="col" width="5%"></th>
											  <th scope="col" width="15%">Fecha</th>
											  <th scope="col" width="35%">Nombre</th>
											  <th scope="col" width="15%">Periodo</th>
											  <th scope="col" width="20%">Cantidad</th>
											  <th scope="col" width="5%"></th>
											</tr>
											</thead>
											<?php
											$envelopeItemArray = EnvelopeItemHelper::retrieveEnvelopeItems("AND user_id = " . $user->__get('user_id') . " AND envelope_item_value != 0 AND envelope_bag_id != 0 ORDER BY envelope_item_last_log_date DESC LIMIT 0,10 ");
											foreach($envelopeItemArray as $envelopeItem)
											{
												?>
												<tr>
													<td><div class="sprite-1 recurrencia-icon">icon</div></td>
													<td><?php echo date('F d', strtotime($envelopeItem->__get('envelope_item_last_log_date')))?></td>
													<td><?php echo $envelopeItem->__get('envelope_item_name');?></td>
													<td><?php echo UserEnvelopeHelper::retrievePeriod($envelopeItem->__get('envelope_item_recurrence'));?></td>
													<td><strong>$<?php echo formatNumber($envelopeItem->__get('envelope_item_value'))?></strong></td>
												  	<td><a href="<?php echo APPLICATION_URL?>envelopes.controller/delete_envelope_item/<?php echo $envelopeItem->__get('envelope_item_id')?>.html" onclick="return confirm('Esta seguro que desea borrar este gasto recurrente?')" title="">_</a><span class="sprite-1 trash-icon">Icon</span></a></td>
												</tr>
												<?php
											}
											?>
										</table>
									</div>
								</div><!-- end Ultimos gastos Table -->
								
								
							</div><!-- Block: Ultimo gasto recurrente -->
							
							

							
						</div><!-- Col 2 Mainbar -->
						
					</div><!-- End Budget Main -->
					
				</div> <!-- END panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
				
			</div><!-- End Main Panel Width -->
		</div>
		<!-- 2.2 End Row: Content -->
	</div>	
		
	</div><!-- END Container Padding 20px -->
</div>
<!--2. END MAIN--> 	

<?php	
include_once('footer.php');	
?>

<!-- Included JS Files -->
			
		
</body>
</html>
