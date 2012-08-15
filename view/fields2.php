<?php
$userData				= unserialize($user->__get('user_data'));
$questionOrders			= QuestionHelper::retrieveQuestions(" AND question_group = ".$tab." ORDER by question_order ", "", "salu_");
$i						= 1;
foreach($questionOrders as $question)
{
	$value		= (isset($userData[$question->__get('question_field')])) ? $userData[$question->__get('question_field')] : '';	
	if(trim($question->__get('question_content')) != '')
	{
		?>
        <div class="row-question" style="position:relative;"><!-- Question cuatro Preguntas -->
        	<a href="#" class="sprite-1 more-info">Info</a>
		   	<div class="tooltip-info" style="display:none;">
		   	<a href="#" class="sprite-1 close-icon">1</a>
		    	<h6 class="whitetxt"><strong>¿Porqué te preguntamos esto?</strong></h6>
		    	<hr class="white" />
		    	<p class="whitetxt"><strong><?php echo utf8_encode($question->__get('question_content'))?></strong><br />
		    	<?php echo utf8_encode($question->__get('question_tooltip'))?>						    	
		    	</p>
	 		</div>
	 		
				<br />
        			<h4 class="text-center greytxt no-margin"><span class="question-number"><?php echo $i;?></span><strong><?php echo utf8_encode($question->__get('question_content'))?>
        			</h4> 
			
				
                <div class="row"> <!-- row -->
                    <?php
                    $questionForm = new QuestionForm($question, $tablePrefix, 0, $value);
                    $questionForm->printQuestion();
                    ?>
                </div> <!-- END row -->

        </div>
		<?php
	}
	$i++;
}
?>
<script type="text/javascript">
function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
	
}

$(document).ready(function(){ 
<?php
foreach($questionOrders as $questionOrder)
{
	$question 	= new Question($questionOrder->__get('question_id'), $tablePrefix);
	$field	 	= $question->__get('question_field');
	$options 	= explode('|', $question->__get('question_options'));
	$value		= (isset($userData[$question->__get('question_field')])) ? str_replace(".", "", $userData[$question->__get('question_field')]) : '';


	switch($question->__get('question_type')):
		case 'radio':
			$count = 0;
			foreach($options as $option)
			{
				$value = explode('=>', $option);
				?>
				//document ready
				
					// toggle panel1	
					$('#<?php echo $field?>-<?php echo $count?>').click(function(){
						$('.<?php echo $field?>').removeClass("bubble-on");		
						$('.<?php echo $field?>').addClass("bubble-off");
						$(this).removeClass("bubble-off");							
						$(this).addClass("bubble-on");
						//SimpleAJAXCall('/question.controller/save_answer/<?php echo $value[0]?>.html', ElementStateChanged, 'GET', 'featured');
					});// end toggle panel1

		     	<?php
		     	$count++;
			}
	
			break;
		case 'slider':
			$min	  = explode('=>', $options[0]);
			$max	  = explode('=>', $options[1]);
			$step	  = explode('=>', $options[2]);
			?>
			$(function() {
				$( "#slider<?php echo $field?>" ).slider({
					value:0,
					min: <?php echo $min[1]?>,
					max: <?php echo $max[1]?>,
					step: <?php echo $step[1]?>,
					slide: function( event, ui ) {
						$( ".amount<?php echo $field?>" ).val( addCommas(ui.value) );
					},
					stop: function ( event, ui ) {
						
						answeredInputs["<?php echo $field?>"] = "<?php echo $field?>";
						recordAnswered($('#<?php echo $field?>'));
					}
				});
				$( ".amount<?php echo $field?>" ).val( addCommas($( "#slider<?php echo $field?>" ).slider( "value" )) );
			
			
			});
			<?php
			break;
		case 'complex':
			break;
		case 'select':
			$count = 0;
			foreach($options as $option)
			{
				$value = explode('=>', $option);
				?>
				//document ready
				
					// toggle panel1	
					$('#<?php echo $field?>-<?php echo $count?>').click(function(){
						$('.<?php echo $field?>').removeClass("bubble-on");		
						$('.<?php echo $field?>').addClass("bubble-off");
						$(this).removeClass("bubble-off");							
						$(this).addClass("bubble-on");
						//SimpleAJAXCall('/question.controller/save_answer/<?php echo $value[0]?>.html', ElementStateChanged, 'GET', 'featured');
						$('#<?php echo $field?>').val(<?php echo $value[0]?>);
					});// end toggle panel1

		     	<?php
		     	$count++;
			}
			break;
		case 'text':
			break;
	endswitch;
}
?>
});//END document ready
</script><!-- END hall -->