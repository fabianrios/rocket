<?php
class QuestionHelper
{
	public static function selectQuestions ( $extra = "", $extraTables = "", $prefix = 'iden_'  )
	{
		$connection  = Connection::getInstance();
		$retrieveQuestionsSql    = "SELECT question_id
							         FROM ".$prefix ."questions" . $extraTables . "
								     WHERE question_state <> 'D'
								     " . $extra;
		return $connection->query($retrieveQuestionsSql);		
	}
	public static function retrieveQuestions ( $extra  = "", $extraTables = "", $prefix = 'iden_' )
	{
		$questions = array();
		
		$retrieveQuestionsResult = self::selectQuestions ( $extra, $extraTables, $prefix  );
		
		while($questionRow = mysql_fetch_assoc($retrieveQuestionsResult["query"]))
			$questions[] = new Question($questionRow["question_id"], $prefix);
			
		return $questions;
	}
	public static function retrieveNextQuestion ($productId, $orderId = null, $answer = null)
	{
		// ANSWER IS NULL
		if($answer == null)
		{
			// NO PREVIOUS QUESTION DEFINED
			if($orderId == null)
			{
				$questionOrderArray = OrderHelper::retrieveOrders("AND product_id = " . $productId . " ORDER BY order_value");
				if(count($questionOrderArray) > 0)
				{
					$questionOrder 	=& $questionOrderArray[0];  
					
					$question		= new Question($questionOrder->__get('question_id'));
				}
				else
				{
					$questionOrder 	= new Order();
					$question 		= new Question();
				}
			}
			// PREVIOUS QUESTION DEFINED
			else
			{
				$pastQuestionOrder = new Order($orderId);
				$questionOrderArray = OrderHelper::retrieveOrders("AND product_id = " . $productId . " AND order_value > " . $pastQuestionOrder->__get('order_value') . " AND parent_id != " . $pastQuestionOrder->__get('order_id') . " ORDER BY order_value LIMIT 0,1");
				if(count($questionOrderArray) > 0)
				{
					$questionOrder 	=& $questionOrderArray[0];  
					
					$question		= new Question($questionOrder->__get('question_id'));
				}
				else
				{
					$questionOrder 	= new Order();
					$question 		= new Question();
				}	
			}
		}
		// ANSWER IS NOT NULL
		else
		{
			$questionOrderArray = OrderHelper::retrieveOrders("AND product_id = " . $productId . " AND  parent_id = " . $orderId . " AND order_conditional = '" . $answer . "' ORDER BY order_value LIMIT 0,1");
			if(count($questionOrderArray) > 0)
			{
				$questionOrder 	=& $questionOrderArray[0];  
				
				$question		= new Question($questionOrder->__get('question_id'));				
			}
			else
			{
				$questionOrderArray = OrderHelper::retrieveOrders("AND product_id = " . $productId . " AND  parent_id = " . $orderId . " AND order_conditional = 0 ORDER BY order_value LIMIT 0,1");
				if(count($questionOrderArray) > 0)
				{
					$questionOrder 	=& $questionOrderArray[0];  
					
					$question		= new Question($questionOrder->__get('question_id'));				
				}
				else
				{
					$pastQuestionOrder = new Order($orderId);
					$questionOrderArray = OrderHelper::retrieveOrders("AND product_id = " . $productId . " AND  order_value > " . $pastQuestionOrder->__get('order_value') . " AND parent_id != " . $orderId . " ORDER BY order_value LIMIT 0,1");
					if(count($questionOrderArray) > 0)
					{
						$questionOrder 	=& $questionOrderArray[0];  
						
						$question		= new Question($questionOrder->__get('question_id'));				
					}
					else
					{
						$questionOrder 	= new Order();
						$question 		= new Question();
					}				
				}
			}
		}
		$questionData = array('order' => $questionOrder, 'question' => $question);
		return $questionData;
	}

}
?>