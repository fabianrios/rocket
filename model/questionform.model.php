<?php
class QuestionForm
{
	private $question;
	private $tablePrefix;
	private $imageDir;
	private $orderId;
	private $value;
	private $user;
	
	public function __construct (&$question, $tablePrefix, $orderId = 0, $value = '', &$user = false)
	{
		$this->question			= $question;
		$this->tablePrefix		= $tablePrefix;
		$this->value			= str_replace(".", "", $value);
		$this->imageDir	= APPLICATION_URL . 'images';
		$this->orderId = $orderId;
		$this->user 	= $user;
		/*if($answer != null)
			$this->setUserData($answer);*/
		
	}
	public function printQuestion()
	{
		switch($this->question->__get('question_type')):
			case 'radio':
				$this->printRadio();
				break;
			case 'checkbox':
				$this->printCheckbox();
				break;
			case 'text':
				$this->printText();
				break;
			case 'slider':
				$this->printSlider();
				break;
			case 'select':
				$this->printSelect();
				break;
			case 'complex':
				eval($this->question->__get('question_function'));
				break;
			default:
				$this->printEndResponse();
				break;
		endswitch;
	}
	private function setUserData($answer)
	{
		$order		= new Order($this->orderId);
		$question	= new Question($order->__get('question_id'));
		if(trim($question->__get('question_function')) != '')
		{
			//eval('$answer = ' . $question->__get('question_function') . "(" . $answer . ");");
		}
		$userData 	= UserHelper::setData($this->user->__get('user_id'), $question->__get('question_field'), $answer);
	}
	private function printRadio()
	{
		$question = $this->question->__get('question_content');
		$field	  = $this->question->__get('question_field');
		$tooltip  = $this->question->__get('question_tooltip');
		$options = explode('|', $this->question->__get('question_options'));
		$min	  = explode('=>', $options[0]);
		$max	  = explode('=>', $options[1]);
		$order = new Order($this->orderId);
		$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
		$orderWeight = $order->__get('order_peso');

		$count = 0;
		$columnClosed = false;
		$rowClosed = false;
		$secondCount = 0;
		$closed = false;
		$first = true;

		if(count($options) < 6)
		{
			
			switch (count($options)):
				case 1:
					$number = 'one';
					break;
				case 2:
					$number = 'two';
					break;
				case 3:
					$number = 'three';
					break;
				case 4:
					$number = 'four';
					break;
				case 5:
					$number = 'five';
					break;
			endswitch;
			echo <<<INPUT
				<ul class="block-grid $number-up">
INPUT;
			$count = 0;
			foreach($options as $option)
			{
				$value = explode('=>', $option);
				$value[1]	= explode('\\', utf8_encode($value[1]));
				
				if(!isset($value[1][1]))
				{
					$value[1][1] = '';
				}
				$questionValue=$value[1];
				echo <<<INPUT
						<li><!-- Answer 1 -->
				    		    <div class="bubble-off text-center  $field" id="$field-$count">
				    		    	<div class="bubble-txt">
				    		    		<h4 class="whitetxt txt-shadow-black assertion">$questionValue[0]</h4>
				    		    		<p class="small whitetxt txt-shadow-black">$questionValue[1]</p>
				    		    	</div>
				    		    </div>
			    		</li><!-- /Answer 1 -->
INPUT;
				$count++;
			}
			$inputTitle = utf8_encode($question);
			echo <<<INPUT
				</ul>
				<input type="hidden" id="$field" name="$field" title="$inputTitle" class="$validable" value="$this->value" />
				<input class="precision-data" type="hidden" id="$field-weight" name="$field-weight" value="$orderWeight" />
INPUT;
		}
		else
		{
			$his->printSelect();
		}

	}
	private function printText()
	{
		/*$question = $this->questionData['question']->__get('question_content');
		$field	  = $this->questionData['question']->__get('question_field');
		$tooltip  = $this->questionData['question']->__get('question_tooltip');
		$options = explode('|', $this->questionData['question']->__get('question_options'));

		$userId	  = $this->user->__get('user_id');
		$orderId  = $this->questionData['order']->__get('order_id');
		echo <<<DIV
		0|||0|||$field|||$userId|||$this->productId|||$orderId|||text|||<div class="question"><!-- INPUT QUESTION -->
			<p class="question-large">$question</p>
			<div class="row">
				<div class="twelve columns"><!-- Column 1/2 -->
					<input name="$field" type="text" class="input-nice" title="Text Field" value="Valor de la Respuesta" /><br />
				</div>  
			</div>
			<!-- Important -->
			<div class="important">
				<span class="has-tip left" id="tipRight4" data-width="250" title="$tooltip">Es importante porque</span>
			</div>
			<!-- End Important -->
		<hr />
		</div><!-- END INPUT QUESTION --><div id="question_form$field"></div>
DIV;*/
	}
	private function printSlider()
	{
		$question = $this->question->__get('question_content');
		$field	  = $this->question->__get('question_field');
		$tooltip  = $this->question->__get('question_tooltip');
		$options  = $this->question->__get('question_options');
		$options  = explode('|', $options);
		$min	  = explode('=>', $options[0]);
		$max	  = explode('=>', $options[1]);
		$order = new Order($this->orderId);
		$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
		$orderWeight = $order->__get('order_peso');
		switch($this->question->__get('question_format')):
			case 'money':
				$label = "Cantidad";
				$sign  = "$";
				break;
			case 'years':
				$label = "A&ntilde;os";
				$sign  = "";
				break;
			case 'percentage':
				$label = "Porcentaje";
				$sign  = "%";
				break;
			default:
				$label = "Cantidad";
				$sign  = "";
				break;
		endswitch;
		echo <<<DIV
			<table width="90%" class="centered table-questions">
					<tr>
						<td>
							<div class="slider $field" id="slider$field"></div>
							<label for="amount" class="cantidad text-center">$sign<input type="text" class="amount amount$field userdata $validable" name="$field" id="$field" value="$this->value"/></label>
						</td>									
					</tr>
			</table>
				<input class="precision-data" type="hidden" id="$field-weight" name="$field-weight" value="$orderWeight" />
DIV;
	}
	private function printSelect()
	{
		$question = $this->question->__get('question_content');
		$field	  = $this->question->__get('question_field');
		$tooltip  = $this->question->__get('question_tooltip');
		$options = explode('|', $this->question->__get('question_options'));
		$min	  = explode('=>', $options[0]);
		$max	  = explode('=>', $options[1]);
		$order = new Order($this->orderId);
		$validable = ($order->__get('order_skip') == '0') ? "validable" : "notValidable"; 
		$orderWeight = $order->__get('order_peso');
		if(count($options) < 6)
		{
			switch (count($options)):
				case 1:
					$number = 'one';
					break;
				case 2:
					$number = 'two';
					break;
				case 3:
					$number = 'three';
					break;
				case 4:
					$number = 'four';
					break;
				case 5:
					$number = 'five';
					break;
			endswitch;
			echo <<<INPUT
				<ul class="block-grid $number-up">
INPUT;
			$count = 0;
			foreach($options as $option)
			{

				$value = explode('=>', $option);
				$value[1]	= explode('\\', utf8_encode($value[1]));
				if(!isset($value[1][1]))
				{
					$value[1][1] = '';
				}
				if ($this->value == $value[0]) 
					$class = 'bubble-on';
				else
					$class = 'bubble-off';				
				$questionValue=$value[1];
				echo <<<INPUT
						<li><!-- Answer 1 -->
				    		    <div class="$class text-center  $field" id="$field-$count">
				    		    	<div class="bubble-txt">
				    		    		<h4 class="whitetxt txt-shadow-black assertion">$questionValue[0]</h4>
				    		    		<p class="small whitetxt txt-shadow-black">$questionValue[1]</p>
				    		    	</div>
				    		    </div>
			    		</li><!-- /Answer 1 -->
INPUT;
				$count++;
			}
			$inputTitle = utf8_encode($question);
			echo <<<INPUT
				</ul>
				<input type="hidden" id="$field" class="$validable" name="$field" title="$inputTitle" value="$this->value" />
				<input class="precision-data" type="hidden" id="$field-weight" name="$field-weight" value="$orderWeight" />
INPUT;
		}
		else
		{
		echo <<<FIELD
				<table width="50%" class="centered table-questions">
					<tr>		
						<td>
							<div class="box">
								<a class="bluebox-1">
									<div class="box-select text-center">						
									<select name="$field" id="$field" class="userdata $validable">
									<option>Seleccione</option>
FIELD;

			foreach($options as $option)
			{
				$value = explode('=>', $option);
				$value[1] = utf8_encode($value[1]);
				echo <<<INPUT
					<!-- Radio Item -->
						<option value="$value[0]">$value[1]</option>
INPUT;
				
			}
			echo <<<DIV
								</select>
								</div>
												</a>
												<div class="blue-shadow"><img src="$this->imageDir/shadow-bluebox.png" alt="" width="" height=""></div>
											</div>
										</td>
									</tr>
									</table>
				<input class="precision-data" type="hidden" id="$field-weight" name="$field-weight" value="$orderWeight" />
DIV;
		}
	}
	private function printEndResponse()
	{
		//echo "Done";
	}
}
?>