<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch ($action):
	case 'load_categories':
		header('Content-Type: text/html; charset=iso-8859-1');
		$userEnvelopeId = escape($_GET[1]);
		$userEnvelope 	= new UserEnvelope($userEnvelopeId);
		$envelopeCategories = EnvelopeCategoryHelper::retrieveEnvelopeCategories("AND envelope_id = '" . $userEnvelope->__get('envelope_id') . "'");
		?>
		<select name="envelope_category_id">
			<option>Seleccione</option>
			<?php
			foreach($envelopeCategories as $envelopeCategory)
			{
				?>
				<option value="<?php echo $envelopeCategory->__get('envelope_category_id')?>"><?php echo $envelopeCategory->__get('envelope_category_name')?></option>
				<?php
			}
			?>
		</select>
		<?php
		break;
endswitch;
?>