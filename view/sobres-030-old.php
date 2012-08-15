<?php
$user = new User($_SESSION['user_active']);
if(!isset($_SESSION["visited_dashboard"]))
{
	unset($_SESSION["updated_envelopes"]);
	$_SESSION["visited_dashboard"] = true;
}
$userEnvelope						= new UserEnvelope(escape($_GET[0]));
$selectedUserEnvelope				= $userEnvelope;
$currentPeriodTotalExpenses 		= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
$currentPeriodRecurringItems	 	= EnvelopeItemHelper::RetrieveEnvelopeItems("AND envelope_bag_id != '0' AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id'));
$currentPeriodDailyItems	 		= UserEnvelopeHelper::getPeriodItems($userEnvelope, 'daily');
$userEnvelopesLogs					= UserEnvelopeLogHelper::retrieveUserEnvelopeLogs("AND user_id = " . $user->__get('user_id') . " AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " GROUP BY MONTH(user_envelope_log_date)  ORDER BY user_envelope_log_date");
$otherUserEnvelopes 				= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND user_envelope_budget != '0' AND user_envelope_budget != '' AND user_envelope_id != " . $userEnvelope->__get('user_envelope_id') . " ORDER BY user_envelope_name DESC");
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
    // GASTO POR ITEMS
	 google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Gasto', 'Hours per Day'],
	          <?php
	          $first = true;
	          foreach($currentPeriodRecurringItems as $envelopeItem)
			  {

				echo "['" . $envelopeItem->__get('envelope_item_name') . "', " . $envelopeItem->__get('envelope_item_value') . "],";
			  }
			  $extraTotal = 0;
			  foreach($currentPeriodDailyItems as $envelopeItem)
			  {
			  	$extraTotal += $envelopeItem->__get('envelope_item_value');
			  }
			  echo "['Extras', " . $extraTotal . "]";
			  ?>
	        ]);
	        var options = {
	          title: ''
	        };		
	        var chart = new google.visualization.PieChart(document.getElementById('chart_div_participation'));
	        chart.draw(data, options);
	      }
	  // GASTO DE SOBRE POR DIA
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Gasto', 'Ejecucion del presupuesto'],
          <?php
          $first = true;
          foreach($userEnvelopesLogs as $userEnvelopeLog)
		  {
		  	if(!$first)
				echo ',';
			else
				$first = false;
			
			$userEnvelopeData = unserialize($userEnvelopeLog->__get('user_envelope_log_data'));
		  	$currentPeriodExpenses 	= UserEnvelopeHelper::getPeriodExpenses($userEnvelope, 'all', $userEnvelopeLog->__get('user_envelope_log_date'));
		  	echo "['" . formatDate("%B %Y", $userEnvelopeLog->__get('user_envelope_log_date')) . "', " . $currentPeriodExpenses . ", " . (($currentPeriodExpenses / $userEnvelope->__get('user_envelope_budget')) * 100) . "]";
			
		  }
		  ?>
        ]);

        var options = {
          vAxes: [{title: "Monto"}, {title: "Porcentaje"}],
          hAxis: {title: "Fecha"},
          seriesType: "bars",
          series: {0: {type: "line"}, 1:{targetAxisIndex:1}, vAxes:{1:{title:'Porcentaje'}}}
        };
//series:{2:{targetAxisIndex:1}}, vAxes:{1:{title:'Losses',textStyle:{color: 'red'}}}
        var chart = new google.visualization.ComboChart(document.getElementById('chart_div_hystoric'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
	 // GASTO TOTAL DE SOBRE
	 google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart2);
	      function drawChart2() {
	        var data = google.visualization.arrayToDataTable([
	          ['Gasto', 'Hours per Day'],
	          ['<?php echo $selectedUserEnvelope->__get('user_envelope_name')?>', <?php echo $currentPeriodTotalExpenses?>],
	          <?php
	          $first = true;
			  $currentPeriodExpenses		= 0;
	          foreach($otherUserEnvelopes as $userEnvelope)
			  {
				
					$currentPeriodExpenses 	+= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
			  }

			echo "['Total gasto', " . round($currentPeriodExpenses) . "]";
			  ?>
	        ]);
	        var options = {
	          title: ''
	        };		
	        var chart = new google.visualization.PieChart(document.getElementById('chart_div_distribution'));
	        chart.draw(data, options);
	        }
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

/*$userEnvelopes2 = UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND envelope_id != " . $userEnvelope->__get('envelope_id') . " GROUP BY envelope_id ORDER BY user_envelope_id DESC");
$userEnvelopeId			= $userEnvelope->__get('user_envelope_id');
$envelopeExtras			= EnvelopeExtraHelper::retrieveEnvelopeExtras("AND user_id = " . $user->__get('user_id') . " AND envelope_id = '" . $envelope->__get('envelope_id') . "' ORDER BY envelope_extra_date DESC");
$allUserEnvelopes 			= UserEnvelopeHelper::retrieveUserEnvelopes("AND user_id = " . $user->__get('user_id') . " AND envelope_id = '" . $envelope->__get('envelope_id') . "' ORDER BY user_envelope_date");
$recurringData 			= unserialize($userEnvelope->__get('user_envelope_recurring_data'));*/

switch($userEnvelope->__get('user_envelope_priority')):
	case 1:
		$priority = 'Alta';
	break;
	case 2:
		$priority = 'Media';
	break;
	case 3:
		$priority = 'Baja';
	break;
	default:
		$priority = 'Alta';
	break;
endswitch;
?>
<!--1. End HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	
		<!-- 2.1 Row: Title -->
		<div class="row">
			<div class="six columns">
				<h2 class="title"><span class="sprite-1 sobres-icon">Icon</span>Sobres</h2>
			</div>


		<hr class="dotted" />
		</div>
		<!-- 2.1 END Row: title -->

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
										<div class="budget-title left"><span class="sprite-1 folder left">icon</span><h2 class="left white txt-shadow-black"><strong><?php echo $selectedUserEnvelope->__get('user_envelope_name')?></strong></h2><span class="sprite-1 info left">icon</span></div><div class="sprite-1 ribbon-detail left">icon</div>
									</div>
									<div class="budget-btn">
										<a href="<?php echo APPLICATION_URL?>#" class="button radius graph_button selected" rel="hystoric">Gasto hist&oacute;rico</a>
										<a href="<?php echo APPLICATION_URL?>#" class="button radius graph_button" rel="distribution">Distribuci&oacute;n de los sobres</a>
										<a href="<?php echo APPLICATION_URL?>#" class="button radius graph_button" rel="participation">Participaci&oacute;n del sobre</a>

									</div>
								</div>
								
							</div>
						</div><!-- End Row -->
						
					<div class="row budget-chart"  id="chart_div_hystoric"></div><!-- Row/Chart --><!-- End Row -->
					<div class="row budget-chart"  id="chart_div_distribution" style="display:none"></div><!-- Row/Chart --><!-- End Row -->			<div class="row budget-chart"  id="chart_div_participation" style="display:none"><!-- Row/Chart -->
					</div>	
					<!-- End Budget Detail -->
					
					<div class="budget-main clearfix"><!-- Budget Main -->
						<div class="budget-col1 left"><!-- Col 1 Sidebar -->
							<ul class="budget-ul clearfix">

								<li class="budget-li"><div class="sprite-1 sobres-icon-2 left margin-left">icon</div>
<p class="left bugdet-li-p margin-top-10"><strong><a href="<?php echo APPLICATION_URL?>sobres-040.html">Resumen</a></strong></p></li>
								<?php
								
								foreach($userEnvelopes as $userEnvelope)
								{
									$currentPeriodExpenses 	= UserEnvelopeHelper::getPeriodExpenses($userEnvelope);
									
									$classExtra = '';
									if($currentPeriodExpenses > $userEnvelope->__get('user_envelope_budget'))
									{
										$classExtra = '-red';
										
										if($userEnvelope->__get('user_envelope_id') == $selectedUserEnvelope->__get('user_envelope_id'))
											$alerts["warnings"]["exceded"][] = $userEnvelope->__get('user_envelope_name') . '|' . formatNumber($currentPeriodExpenses) . '|' . formatNumber($userEnvelope->__get('user_envelope_budget'));
									}
									elseif($currentPeriodExpenses == $userEnvelope->__get('user_envelope_budget'))
									{
										$classExtra = '-red';
										
										if($userEnvelope->__get('user_envelope_id') == $selectedUserEnvelope->__get('user_envelope_id'))
											$alerts["warnings"]["maxed"][] = $userEnvelope->__get('user_envelope_name') . '|' . formatNumber($currentPeriodExpenses) . '|' . formatNumber($userEnvelope->__get('user_envelope_budget'));
									}
									elseif($currentPeriodExpenses >= ($userEnvelope->__get('user_envelope_budget') * 0.9))
									{
										$classExtra = '-red';
										
										if($userEnvelope->__get('user_envelope_id') == $selectedUserEnvelope->__get('user_envelope_id'))
											$alerts["warnings"]["almost-maxed"][] = $userEnvelope->__get('user_envelope_name') . '|' . formatNumber($currentPeriodExpenses) . '|' . formatNumber($userEnvelope->__get('user_envelope_budget'));
									}
									
									if($userEnvelope->__get('user_envelope_id') == $selectedUserEnvelope->__get('user_envelope_id'))
									{
										$nextPaymentsShort = UserEnvelopeHelper::getNextPayments($userEnvelope, 7);
										$nextPaymentsLong  = UserEnvelopeHelper::getNextPayments($userEnvelope, 30, 7);
										$previousPayments  = UserEnvelopeHelper::getPreviousPayments($userEnvelope, 30, 30);
										$nextPaymentsShortArray 	= $nextPaymentsShort + $nextPaymentsShortArray;
										$nextPaymentsLongArray 		= $nextPaymentsLong + $nextPaymentsLongArray;
										$previousPaymentsArray 		= $previousPayments + $previousPaymentsArray;
									}
									$class = '';
									if($userEnvelope->__get('user_envelope_id') == $selectedUserEnvelope->__get('user_envelope_id'))
										$class = ' active-sidebar';
									?>
									<li class="budget-li<?php echo $class?>"><div class="sprite-1 folder-small<?php echo $classExtra?> left">icon</div>
								<p class="left bugdet-li-p"><a href="<?php echo APPLICATION_URL?>sobres-030/<?php echo $userEnvelope->__get('user_envelope_id')?>.html"><?php echo $userEnvelope->__get('user_envelope_name')?><a/><br /><span class="small grey">$<?php echo formatNumber($currentPeriodExpenses);?> de $<?php echo formatNumber($userEnvelope->__get('user_envelope_budget'))?> </small></p></li>
									<?php
								}
								ksort($nextPaymentsShortArray);
								ksort($nextPaymentsLongArray);
								krsort($previousPaymentsArray);
								$alerts["soon_expiring"] 	= $nextPaymentsShortArray;
								$alerts["reminders"]		= $nextPaymentsLongArray;

								$userEnvelope			= new UserEnvelope(escape($_GET[0]));
								?>
								<li class="budget-li text-center"><a href="<?php echo APPLICATION_URL?>sobres-010.html" class="add grey"><span class="sprite-1 add-icon">Agregar un nuevo sobre</span></a></li>
							</ul>
						</div><!-- Col 1 Sidebar -->
						
						<div class="budget-col2 left"><!-- Col 2 Mainbar -->
						
						
							<div class="budget-mainbar"><!-- Mainbar -->
								<div class="header-sobre clearfix"><!-- Header --> 
								
									<div class="row"><!-- Row -->
										<div class="seven columns">
											<h3 class="subtitle"><span class="sprite-1 sobres-icon-1">Icon</span><strong><?php echo $userEnvelope->__get('user_envelope_name')?></strong></h3><a href="<?php echo APPLICATION_URL?>sobres-010/<?php echo $userEnvelope->__get('user_envelope_id')?>.html" 	class="button-small round green-bg">Editar</a>
										</div>
										<div class="five columns">
											<p class="text-right no-margin"><strong>Presupuesto asignado</strong></p>
											<input type="text" class="input-nice-2 sprite-1 dollar-icon" value="<?php echo formatNumber($userEnvelope->__get('user_envelope_budget'))?>"/>
										</div>
									</div><!-- End Row -->
									<br />
									<div class="row"><!-- Row -->
												<div class="three columns">
													<label>Periodicidad</label>
													<p class="no-margin"><strong>Mensual</strong></p>
												</div>
												<div class="three columns">
													<label>Prioridad</label>
													<p class="no-margin"><strong><?php echo $priority?></strong></p>
												</div>										
									</div><!-- End Row -->
									

									
								</div><!-- End Header -->
							</div><!-- End Mainbar -->
						

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
											  <th scope="col" width="25%">Nombre</th>
											  <th scope="col" width="25%">Categor&iacute;a</th>
											  <th scope="col" width="20%">Monto</th>
											  <th scope="col" width="20%">Fecha</th>
											  <th scope="col" width="5%"></th>
											</tr>
											<?php
											$userEnvelopeExtraItemArray	= EnvelopeItemHelper::retrieveEnvelopeItems("AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " AND user_id = " . $user->__get('user_id') . " AND envelope_bag_id = 0 AND envelope_item_save != 1 ORDER BY envelope_item_payday DESC LIMIT 0,10");	
											foreach($userEnvelopeExtraItemArray as $userEnvelopeExtraItem)
											{
												$userEnvelope = new UserEnvelope($userEnvelopeExtraItem->__get('user_envelope_id'));
												$envelopeCategory = new EnvelopeCategory($userEnvelopeExtraItem->__get('envelope_category_id'));
												?>
												<tr>
													<td><?php echo $userEnvelopeExtraItem->__get('envelope_item_name')?></td>
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
											  <th scope="col" width="20%">Fecha</th>
											  <th scope="col" width="40%">Nombre</th>
											  <th scope="col" width="20%">Periodo</th>
											  <th scope="col" width="20%">Cantidad</th>
											  <th scope="col" width="5%"></th>
											</tr>
											</thead>
											<?php
											$envelopeItemArray = EnvelopeItemHelper::retrieveEnvelopeItems("AND user_envelope_id = " . $userEnvelope->__get('user_envelope_id') . " AND user_id = " . $user->__get('user_id') . " AND envelope_item_value != 0 AND envelope_bag_id != 0 ORDER BY envelope_item_last_log_date DESC LIMIT 0,10 ");
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
		
		
	</div><!-- END Container Padding 20px -->
</div>
<!--2. END MAIN--> 	

<?php	
include_once('footer.php');	
?>


			
		
</body>
</html>
