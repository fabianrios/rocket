<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
<meta charset="utf-8" />

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
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery-ui-1.8.20.custom.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jshashtable.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/jquery.numberformatter-1.2.3.min.js" ></script>
	<script language="JavaScript" src="<?php echo APPLICATION_URL?>javascripts/envelopes-behaviors.js" ></script>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo APPLICATION_URL?>favicon.ico" />
	

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo APPLICATION_URL?>stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="<?php echo APPLICATION_URL?>http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>


<!--1. HEADER -->
<?php	
include_once('header.php');	
$incomes 			= IncomeHelper::retrieveIncomes("AND user_id = " . $user->__get('user_id'));
$incomeCategories 	= IncomeCategoryHelper::retrieveIncomeCategories("ORDER BY income_category_name");
$incomeTotal 		= 0;
?>
<!--1. /HEADER -->
	


<!--2. MAIN-->
<div id="main"> 
	<div class="container principal clearfix"><!-- Container Padding 20px -->
	

		<!-- 2.2 Row: Content -->
		<div class="row">
			<div class="twelve columns"><!-- Main Panel Width -->
				<div class="panel header-explorar"> <!-- panel -->
					<form name="income_form" action="<?php echo APPLICATION_URL?>income.controller.html" method="post" >
						<input type="hidden" name="action" value="addIncome" />
					<!-- Ribbon -->
					<div class="ribbon">
						<h2><span class="head-e"><span class="sprite-1 sobres-icon">Icon</span></span><strong>Sobres:</strong> Tus ingresos, ¿cuánto te puedes gastar?</h2>
						<img src="<?php echo APPLICATION_URL?>images/border.png" class="right border" width="12" height="44">
					</div>
					<!-- /Ribbon -->
					
						<div class="row question"><!-- Row Question 3 -->
							<br />
							<div class="eleven columns centered"><!-- 11 col -->
								<h5 class="text-center greytxt no-margin"><strong>Es importante que determines tus ingresos para saber cuanto dispones para repartir en cada uno de tus sobres, es decir en tus grupos de gastos. El que sabe lo que tiene, sabe lo que debe.</strong></h5>
							</div>
							<br />
							<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow-03.png" alt="" width="" height=""></div>
						</div>	

					<!-- Question 1 -->
					<div class="question">
						
						<div class="row"><!-- Row -->
							<div class="eleven columns centered">
								<div class="income-inputs clearfix">
									
								<table summary="Table summary" width="100%" class="table-inputs" id="table-inputs">
									 <thead>
									 <tr>
									  <th scope="col" width="17%">Categoría</th>
									  <th scope="col" width="30%">Nombre</th>
									  <th scope="col" width="15%">fecha de entrada</th>
									  <th scope="col" width="20%">Recurrencia</th>
									  <th scope="col" width="13%">Monto</th>
									  <th scope="col" width="5%"></th>
									</tr>
									</thead>
									<?php
									$count = 1;
									foreach($incomes as $income)
									{
										?>
										<tr class="even">
											<td>
												<select name="income_category_id_<?php echo $count?>">
												<?php
												foreach($incomeCategories as $incomeCategory)
												{
													$selected = "";
													if($incomeCategory->__get('income_category_id') == $income->__get('income_category_id'))
														$selected = 'selected="selected"';
													?>
													<option <?php echo $selected?> value="<?php echo $incomeCategory->__get('income_category_id')?>"><?php echo $incomeCategory->__get('income_category_name')?></option>
													<?php
												}
												?>
												</select>
											</td>
											<td><input type="text" name="income_name_<?php echo $count?>" class="input-nice-2 sprite-1 pencil-icon" value="<?php echo $income->__get('income_name')?>"/></td>
											<td>
												<input type="text" name="income_day_<?php echo $count?>" class="calendar-input" value="<?php echo $income->__get('income_day')?>"/>
											</td>
											<td>
												<div>
												<a title="7" src="<?php echo APPLICATION_URL?>#" class="sprite-1 seven-days-small  periodicity <?php if($income->__get('income_periodicity') == 7) echo 'active-cal'?>">Siete días</a>
												<a title="15" src="<?php echo APPLICATION_URL?>#" class="sprite-1 fifty-days-small  periodicity <?php if($income->__get('income_periodicity') == 15) echo 'active-cal'?>">Quince días</a>
												<a title="30" src="<?php echo APPLICATION_URL?>#" class="sprite-1 thirty-days-small  periodicity <?php if($income->__get('income_periodicity') == 30) echo 'active-cal'?>">Treinta días</a>
												<a title="60" src="<?php echo APPLICATION_URL?>#" class="sprite-1 sixty-days-small  periodicity  <?php if($income->__get('income_periodicity') == 60) echo 'active-cal'?>" >Sesenta días</a>
												<a title="180" src="<?php echo APPLICATION_URL?>#" class="sprite-1 one-eighty-days-small  periodicity <?php if($income->__get('income_periodicity') == 180) echo 'active-cal'?>" >Cientochenta días</a>
												<a title="360" src="<?php echo APPLICATION_URL?>#" class="sprite-1 three-sixty-days-small  periodicity <?php if($income->__get('income_periodicity') == 360) echo 'active-cal'?>">Trescientossenta días</a>	
												</div>
												<input type="hidden" value="<?php echo $income->__get('income_periodicity')?>" name="income_periodicity_<?php echo $count?>"	/>						
											</td>
											<td><input type="text" class="input-nice-2 sprite-1 dollar-icon income-value" value="<?php echo $income->__get('income_value')?>" name="income_value_<?php echo $count?>" /></td>
										  <td><a href="<?php echo APPLICATION_URL?>income.controller/delete_income/<?php echo $income->__get('income_id')?>.html" onclick="return confirm('¿Está seguro que desea borrar este item?');"  class="sprite-1 trash-icon right">Icon </a>
	
										  </td>
										</tr>
										<?php
										$incomeTotal += $income->__get('income_value');
										$count++;
									}
									if($count == 1)
									{
									?>
										<tr class="even">
											<td>
												<select name="income_category_id_<?php echo $count?>">
												<?php
												foreach($incomeCategories as $incomeCategory)
												{
													$selected = "";
													?>
													<option <?php echo $selected?> value="<?php echo $incomeCategory->__get('income_category_id')?>"><?php echo $incomeCategory->__get('income_category_name')?></option>
													<?php
												}
												?>
												</select>
											</td>
											<td><input type="text" name="income_name_<?php echo $count?>" class="input-nice-2 sprite-1 pencil-icon" value=""/></td>
											<td>
												<input type="text" name="income_day_<?php echo $count?>" class="calendar-input" value=""/>
											</td>
											<td>
												<div>
												<a title="7" src="<?php echo APPLICATION_URL?>#" class="sprite-1 seven-days-small  periodicity">Siete días</a>
												<a title="15" src="<?php echo APPLICATION_URL?>#" class="sprite-1 fifty-days-small  periodicity">Quince días</a>
												<a title="30" src="<?php echo APPLICATION_URL?>#" class="sprite-1 thirty-days-small  periodicity">Treinta días</a>
												<a title="60" src="<?php echo APPLICATION_URL?>#" class="sprite-1 sixty-days-small  periodicity">Sesenta días</a>
												<a title="180" src="<?php echo APPLICATION_URL?>#" class="sprite-1 one-eighty-days-small  periodicity ">Cientochenta días</a>
												<a title="360" src="<?php echo APPLICATION_URL?>#" class="sprite-1 three-sixty-days-small  periodicity ">Trescientossenta días</a>	
												</div>
												<input type="hidden" name="income_periodicity_<?php echo $count?>"	/>						
											</td>
											<td><input type="text" class="input-nice-2 sprite-1 dollar-icon income-value" name="income_value_<?php echo $count?>" /></td>
										  <td></td>
										</tr>
									<?php
									}
									?>
									<tr class="last-item" id="last-item">
										<td colspan="2">
										<input type="button" class="small pretty-btn add-income" value="Agregar ingreso" /> 
										</td>
									</tr>
									
									
								</table>

								</div>
							</div>
						</div><!-- /Row -->

						
						<div class="row"><!-- Row -->
							<div class="eleven columns centered">
								<div class="total-price clearfix">
								<table class="table-nude right">
									<tr>
										<td class="text-right"><strong class="greytxt">INGRESO<br />TOTAL</strong></td>
										<td><span class="price" id="income-total">$ <?php echo formatNumber($incomeTotal)?></span></td>
									</tr>
								</table>
								</div>
							</div>
						</div><!-- /Row -->
						
					</div>
					<!-- /Question 1 -->
					
					
					
										
					<div class="main-footer" /><!-- Main Footer -->
					<div class="shadow"><img src="images/shadow-1.png" alt="shadow-1" width="1024" height="20" /></div>
						<div class="text-center">
							<input type="submit" class="pretty-btn" value="Activar Ingresos" />
						</div>
					</div><!-- /Main Footer -->
				</form>
				</div> <!-- /panel -->
				<div class="blue-shadow"><img src="<?php echo APPLICATION_URL?>images/shadow.png" alt="" width="" height=""></div>
				
			</div><!-- /Main Panel Width -->
		</div>
		<!-- 2.2 /Row: Content -->
		
		
	</div><!-- /Container Padding 20px -->
</div>
<!--2. /MAIN--> 	

<?php	
include_once('footer.php');	
?>
<script language="javascript">
	var inputCount = <?php echo $count?> + 1;
	$(".add-income").click(function (event) {
		
		event.preventDefault();
		$('#last-item').before('<tr class="even"><td><select name="income_category_id_' + inputCount + '"><?php foreach($incomeCategories as $incomeCategory){ $selected = ""; ?><option <?php echo $selected?> value="<?php echo $incomeCategory->__get('income_category_id')?>"><?php echo $incomeCategory->__get('income_category_name')?></option><?php }	?></select></td><td><input type="text" name="income_name_' + inputCount + '" class="input-nice-2 sprite-1 pencil-icon" value=""/></td><td><input type="text" name="income_day_' + inputCount + '" class="calendar-input" value=""/></td><td><div><a title="7" src="<?php echo APPLICATION_URL?>#" class="sprite-1 seven-days-small  periodicity">Siete días</a><a title="15" src="<?php echo APPLICATION_URL?>#" class="sprite-1 fifty-days-small  periodicity">Quince días</a><a title="30" src="<?php echo APPLICATION_URL?>#" class="sprite-1 thirty-days-small  periodicity">Treinta días</a><a title="60" src="<?php echo APPLICATION_URL?>#" class="sprite-1 sixty-days-small  periodicity">Sesenta días</a><a title="180" src="<?php echo APPLICATION_URL?>#" class="sprite-1 one-eighty-days-small  periodicity ">Cientochenta días</a><a title="360" src="<?php echo APPLICATION_URL?>#" class="sprite-1 three-sixty-days-small  periodicity ">Trescientossenta días</a></div><input type="hidden" name="income_periodicity_' + inputCount + '"	/></td><td><input type="text" class="input-nice-2 sprite-1 dollar-icon income-value" name="income_value_' + inputCount + '" /></td><td></td></tr>');
		inputCount++;
		
		$(".income-value").unbind('blur');
		$(".income-value").blur(function () {
			var sum = 0;
			$(".income-value").each (function () {
				sum += Number($(this).val());
			});
			
			$("#income-total").html('$ ' + $.formatNumber(sum, {format:"###'###,###", locale:"es"}));
		});
		$(".calendar-input").datepicker({					
			dateFormat: "d" 		
		});
		$(".periodicity").unbind('click');
		$('.periodicity').each(function (index) {
			$(this).click(function (event) {
				event.preventDefault();
				$(this).siblings().removeClass('active-cal');
				$(this).addClass('active-cal');
				$(this).parent().next().attr("value", $(this).attr("title"));
			});
		});
	});
	
</script>
</body>
</html>
