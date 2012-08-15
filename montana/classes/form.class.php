<?php
class Form
{

	var $fields_count; 
	var $method;
	var $action;
	var $form_class;
	var $form_id;
	var $name;
	var $id;

	public function __construct($action, $method, $id, $form_class='', $name='', $form_id='')
	{
		$this->fields_count 	= 0;
		$this->method 			= $method;
		$this->action 			= $action;
		$this->form_class		= $form_class;
		$this->form_id			= $form_id;
		$this->name				= $name;
		$this->id				= $id;		
	}
	public function startForm()
	{
		echo '<form action="'. $this->action . '" method="'. $this->method . '" class="'. $this->form_class . '"	name="'. $this->name . '" id="'. $this->form_id . '">';  
	}
	public function endForm()
	{
		echo '</form>';  
	}
	public function putField($type, $name, $value="", $options="", $field_id = '', $field_class='', $required='')
	{
		$this->fields_count++;
		$field_id = ($field_id == '') ? $name : $field_id;
		switch ($type):
			case 'text':
				$this->put_textfield($name, $value, $field_id, $field_class,$options, $required);
			break;
			case 'editor_complete':
				$this->put_editor($name, 'Default');
			break;
			case 'editor_simple':
				$this->put_editor($name, 'Basic');
			break;
			case 'date':
				$this->put_textfield_date($name, $value, $field_id, $field_class);
			break;		
			case 'checkbox':
				$this->put_checkbox($name, $value, $options, $field_id, $field_class);
			break;												
			case 'gallery':
				$this->put_gallery($name, $field_id, $field_class, $options);
			break;		
			case 'link':
				$this->put_link($name, $field_id, $field_class, $value);
			break;		
			case 'content_link':
				$this->put_content_link($name, $field_id, $field_class, $value);
			break;	
			case 'select':
				$this->put_select($name, $value, $options, $field_id, $field_class);
			break;
			case 'text_area':
				$this->put_textarea($name, $value, $options, $field_id, $field_class);
			break;
			case 'content_gallery':
				$this->put_content_gallery($name, $value, $options, $field_id, $field_class);
			break;
			case 'coords':
				$this->put_coords($name, $value, $options, $field_id, $field_class);
			break;		
			case 'cities':
				$this->put_city($name, $value, $options, $field_id, $field_class);
			break;					
			case 'google_maps':
				$this->put_google_maps($name, $value, $options, $field_id, $field_class);
			break;	
			default;
				echo $value;
			break;							
		endswitch;
	}
	public static function put_NC_gallery(&$objectResources, $options, $fieldName, $objectId, $fieldPrefix, $object, $resourceObject, $expandPage)
	{
		$objectVars = array('field_prefix' 	  => $fieldPrefix,
							'object' 	   	  => $object,
							'resource_object' => $resourceObject,
							'expand_page'	  => $expandPage);
		// opciones del campo (cantidad_de_contenidos|tipo_de_contenido)
		$options = explode('|', $options);
		// menu de acciones
		$actions   = '<div class="pages01"> <a href="javascript:void(0)" onclick="SimpleAJAXCall(\'index.php?form_popup.control/addNCResource/' . $objectId . '/' . $options[0] . '/' . $options[1] . '/' . $fieldName . '/' . urlencode(serialize($objectVars)) . '\', loadFormLayer, \'GET\', \'window2\')">Agregar Archivo</a>';
		if(count($objectResources) > 0)
			$actions .= '|<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?form_popup.control/updateNCResource/\'+document.getElementById(\'' . $fieldName . 'value\').value+\'/' . $fieldName . '/' . $objectId . '/' . urlencode(serialize($objectVars)) . '\', loadFormLayer, \'GET\', \'window2\');">Editar</a>
			|<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?control_resource.controller/deleteNCResourceRelation1/\' +document.getElementById(\'' . $fieldName . 'value\').value+ \'/' . $objectId . '/' . $fieldName . '/' . 1 . '/' . urlencode(serialize($objectVars)) . '\', doNothing, \'GET\', \'\'); SimpleAJAXCall(\'index.php?control_resource.controller/refreshNCResourceList/' . $objectId . '/' . $fieldName . '/' . $options[0] . '/' . $options[1] . '/' . urlencode(serialize($objectVars)) . '\', ElementStateChanged, \'GET\', \'' . $fieldName . '\'); ">Eliminar</a>
			|<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?form_popup.control/thumbFormNC/\'+document.getElementById(\'' . $fieldName . 'value\').value+\'/' . urlencode(serialize($objectVars)) . '\', loadFormLayer, \'GET\', \'window2\');">Editar Thumbs</a>
			|<a href="javascript:void(0);" onclick="ParamsAJAXCall(\'index.php?form_popup.control/resourceOrderPopupNC/' . $objectId . '/' . $fieldName . '/' . urlencode(serialize($objectVars)) . '\', createSortablePopup, \'GET\', \'window2\', \'orderContents\');">Ordenar</a>';
		$actions  .= '</div>';
		
		// div contenedor
		echo '<div class="rad_group">
                    ' . $actions;
		$firstId = 0;
		$first 	 = true;
        foreach($objectResources as $objectResource)
		{
			$checked 	  = '';
			$resource;
			eval('$resource = new ' . $resourceObject . '(' . $objectResource->__get('resource_id') . ');');
			if($first)
			{
				$firstId = $objectResource->__get($fieldPrefix . '_resource_id');
				$checked = 'checked';
			}
			$resourceType = new ResourceType($resource->__get('resource_type_id'));
			if($resourceType->__get('resource_type_name') == 'Image')
			{
				$imgSrc 	 = 'resources/images/50x50/' . $resource->__get('resource_file');
				$aAttributes = 'rel="lightbox[' . $fieldName . ']" href="resources/images/' . $resource->__get('resource_file') . '"';
			}
			else
			{
				$imgSrc 	 = 'imgcontrol/iconos_sistema/' . $resourceType->__get('resource_type_icon');
				$aAttributes = 'target="_blank" href="resources/' . $resourceType->__get('resource_type_directory') . '/' . $resource->__get('resource_file') . '"';
			}
			echo '<label>
			<input onclick="document.getElementById(\'' . $fieldName . 'value\').value = this.value" type="radio" ' . $checked . ' name="imageGroup' . $fieldName . '" value="' . $objectResource->__get($fieldPrefix . '_resource_id') . '" id="imageGroup' . $resource->__get('resource_id') . '" />
			<a ' . $aAttributes . '><img src="' . $imgSrc . '" alt="' . $resource->__get('resource_name') . '"  /></a>' . $resource->__get('resource_name') . '</label>';
			$first = false;
		}
        echo $actions . '<input type="hidden" name="' . $fieldName . 'value" id="' . $fieldName . 'value" value="' . $firstId . '" />
                  </div>';		
	}
	public function put_textfield($name, $value, $id, $field_class,$options, $required)
	{
		if ($required == 1) 
			$field_class .= ' notValidable';
		$disable = ($options == 'disable') ? 'disabled="disabled"' : '';
		echo '<input type="text" "' . $disable . '" name="' . $name . '" id="' . $id . '" class="' . $field_class . '" value="'.$value.'" />';  
	} 
	public function put_editor($name, $type)
	{  
		$action = "SimpleAJAXCall('index.php?form_popup.control/fck/".$this->id."/".$name."/".$type."', loadFormLayer, 'GET', 'window2');";
		echo '<a onClick="'.$action.'" href="javascript:void(0)"><img height="25" width="113" border="0" alt="Editar" src="imgcontrol/M_editar.gif"/></a>';
	} 
	public function put_coords($name, $type)
	{  
		$action = "SimpleAJAXCall('index.php?form_popup.control/setCoords/".$this->id."/".$name."/".$type."', loadFormLayer, 'GET', 'window2');";
		echo '<a onClick="'.$action.'" href="javascript:void(0)"><img height="25" width="113" border="0" alt="Editar" src="imgcontrol/M_editar.gif"/></a>';
	}	
	public function put_textfield_date($name, $value, $id, $field_class)
	{
		if($value == '0000-00-00 00:00:00')
			$value = date('Y-m-d');
		else
			$value = date('Y-m-d', strtotime($value));
		$action = "displayDatePicker('".$id."')";
		echo '<input onClick="'.$action.'" name="'.$name.'" id"'.$id.'" value="'.$value.'" class="' . $field_class . '" />';
	}
	public function put_checkbox($name, $value, $options, $field_id, $field_class)
	{
		echo '<div class="rad_group">';
		$i	= 0;
		foreach (explode('|', $options) as $option)
		{
			if(trim($option) != '')
			{
				$option 	= explode("=>", $option);
				$selected 	= (strpos($value, ','.$option[0].',') !== false) ? 'checked' : '';
				echo '<label>';
				echo '<input type="checkbox" name="' . $name . '_'. $i .'" id="' . $name . '_'. $i .'" class="' . $field_class . '" value="'.$option[0].'" '.$selected.'/>';  	
				echo $option[1];
				echo '</label>';
			}
			$i++;
		}	
	}
	public function put_gallery($name, $field_id, $field_class, $options)
	{
		// opciones del campo (cantidad_de_contenidos|tipo_de_contenido)
		$options = explode('|', $options);
		// recursos del contenido
		$contentResources = ContentResourceHelper::retrieveContentResources("AND content_id = " . $this->id . " 
																	  AND content_resource_field_name = '" . $name . "' ORDER BY content_resource_order");
		// menu de acciones
		$actions   = '<div class="pages01"> <a href="javascript:void(0)" onclick="SimpleAJAXCall(\'index.php?form_popup.control/addResource/' . $this->id . '/' . $options[0] . '/' . $options[1] . '/' . $name . '\', loadFormLayer, \'GET\', \'window2\')">Agregar Archivo</a>';
		if(count($contentResources) > 0)
			$actions .= '|<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?form_popup.control/updateResource/\'+document.getElementById(\'' . $name . 'value\').value+\'/' . $name . '/' . $this->id . '\', loadFormLayer, \'GET\', \'window2\');">Editar</a>
			|<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?control_resource.controller/deleteResourceRelation1/\' +document.getElementById(\'' . $name . 'value\').value+ \'/' . $this->id . '/' . $name . '/' . 1 . '\', doNothing, \'GET\', \'\'); SimpleAJAXCall(\'index.php?control_resource.controller/refreshResourceList/' . $this->id . '/' . $name . '/' . $options[0] . '/' . $options[1] . '\', ElementStateChanged, \'GET\', \'' . $name . '\'); ">Eliminar</a>
			|<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?form_popup.control/thumbForm/\'+document.getElementById(\'' . $name . 'value\').value, loadFormLayer, \'GET\', \'window2\');">Editar Thumbs</a>
			|<a href="javascript:void(0);" onclick="ParamsAJAXCall(\'index.php?form_popup.control/resourceOrderPopup/' . $this->id . '/' . $name . '\', createSortablePopup, \'GET\', \'window2\', \'orderContents\');">Ordenar</a>';
		$actions  .= '</div>';
		
		// div contenedor
		echo '<div class="rad_group">
                    ' . $actions;
		$firstId = 0;
		$first 	 = true;
        foreach($contentResources as $contentResource)
		{
			$checked 	  = '';
			$resource 	  = new Resource($contentResource->__get('resource_id'));
			if($first)
			{
				$firstId = $contentResource->__get('content_resource_id');
				$checked = 'checked';
			}
			$resourceType = new ResourceType($resource->__get('resource_type_id'));
			if($resourceType->__get('resource_type_name') == 'Image')
			{
				$imgSrc 	 = 'resources/images/50x50/' . $resource->__get('resource_file');
				$aAttributes = 'rel="lightbox[' . $name . ']" href="resources/images/' . $resource->__get('resource_file') . '"';
			}
			else
			{
				$imgSrc 	 = 'imgcontrol/iconos_sistema/' . $resourceType->__get('resource_type_icon');
				$aAttributes = 'target="_blank" href="resources/' . $resourceType->__get('resource_type_directory') . '/' . $resource->__get('resource_file') . '"';
			}
			echo '<label>
			<input onclick="document.getElementById(\'' . $name . 'value\').value = this.value" type="radio" ' . $checked . ' name="imageGroup' . $name . '" value="' . $contentResource->__get('content_resource_id') . '" id="imageGroup' . $resource->__get('resource_id') . '" />
			<a ' . $aAttributes . '><img src="' . $imgSrc . '" alt="' . $resource->__get('resource_name') . '"  /></a>' . $resource->__get('resource_name') . '</label>';
			$first = false;
		}
        echo $actions . '<input type="hidden" name="' . $name . 'value" id="' . $name . 'value" value="' . $firstId . '" />
                  </div>';
	}
	public function put_link($name, $field_id, $field_class, $value)
	{
		echo '<input readonly type="text" name="' . $name . '" id="input_' . $field_id . '" class="' . $field_class . '" value="'.$value.'" /><a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?form_popup.control/setLinkModule/input_' . $field_id . '\', loadFormLayer, \'GET\', \'window2\');"><img src="imgcontrol/magnify.gif"/></a>';  
	}
	public function put_content_link($name, $field_id, $field_class, $value)
	{
		echo '<input readonly type="text" name="' . $name . '" id="input_' . $field_id . '" class="' . $field_class . '" value="'.$value.'" /><a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?form_popup.control/setLinkContent/input_' . $field_id . '\', loadFormLayer, \'GET\', \'window2\');"><img src="imgcontrol/magnify.gif"/></a>';  
	}
	public function put_select($name, $value, $options, $field_id, $field_class)
	{
		$onchange 	= '';
		$div_1 		= '';
		$div_2 		= '';
		if($options == 'departments')
		{
			$states = StateHelper::retrieveStates ();
			$options = '';
			foreach($states as $state)
			{
				if($options == '')
					$options =  $state->__get('state_id') . '=>' . $state->__get('state_name');
				else
					$options .=  '|' . $state->__get('state_id') . '=>' . $state->__get('state_name');
			}
		
		}
		if(count(explode('->', $options)) > 1)
		{
			$explodedOptions = explode('->', $options);
			foreach(range($explodedOptions[0], $explodedOptions[1]) as $number)
			{
				if($number != $explodedOptions[1])
					$options .= $number . '=>' . $number . '|';
				else
					$options .= $number . '=>' . $number;				
			}
		}
		
		if($options == 'country_c')
		{
			$onchange = "onchange=\"SimpleAJAXCall('index.php?control_field.controller/countryChange/' + this.value + '/" . $name . "' + '/content_varchar_5', ElementStateChanged, 'GET', 'states');";
			$countries = CountryHelper::retrieveCountries ();
			$options = '';
			foreach($countries as $country)
			{
				if($options == '')
					$options =  $country->__get('country_id') . '=>' . $country->__get('country_name');
				else
					$options .=  '|' . $country->__get('country_id') . '=>' . $country->__get('country_name');
			}
		
		}
		
		if($options == 'departments_c')
		{
			
			$div_1 = '<div id="states">';
			$div_2 = '</div>';
			$onchange = "onchange=\"SimpleAJAXCall('index.php?control_field.controller/departmentChange/' + this.value + '/" . $name . "' + '/content_varchar_5', ElementStateChanged, 'GET', 'cities');";
			$states = StateHelper::retrieveStates ();
			$options = '';
			foreach($states as $state)
			{
				if($options == '')
					$options =  $state->__get('state_id') . '=>' . $state->__get('state_name');
				else
					$options .=  '|' . $state->__get('state_id') . '=>' . $state->__get('state_name');
			}
		
		}
		
		if($options == 'cities')
		{
			$div_1 = '<div id="cities">';
			$div_2 = '</div>';
			$cities = CityHelper::retrieveCities();
			$options = '';
			foreach($cities as $city)
			{
				if($options == '')
					$options =  $city->__get('city_id') . '=>' . $city->__get('city_name');
				else
					$options .=  '|' . $city->__get('city_id') . '=>' . $city->__get('city_name');
			}
		}
		
		echo $div_1;
		echo '<select name="' . $name . '" class="' . $field_class . '" id="' . $field_id . '" ' . $onchange . '">';
		echo '<option value="NULL">-Seleccione-</option>';
		foreach (explode('|', $options) as $option)
		{
			$options = '';
			if(trim($option) != '')
			{
				$option = explode("=>", $option);
				$selected = "";
				if ($value == $option[0]) 
						$selected = 'selected="selected"';
				echo '<option value="' . $option[0] . '" ' . $selected . '>';
				echo $option[1];
				echo '</option>';
			}
		}		
		echo '</select>';
		echo $div_2;		
	}
	public function put_textarea($name, $value, $id, $field_class)
	{
		echo '<textarea name="' . $name . '" id="' . $id . '" class="' . $field_class . '" >'.$value.'</textarea>';  
	} 	
	
	public function put_content_gallery($name, $value, $options, $field_id, $field_class)
	{
		// opciones del campo (cantidad_de_contenidos|tipo_de_contenido)
		$options 			= explode('|', $options);
		$type    			= $options[0];
		$module_id 			= $options[1];
		$type_relationship 	= $options[2];
		$level				= (isset($options[3])) ? $options[3] : 0;
		// recursos del contenido
		$related_contents		= ContentRelationHelper::selectContentRelations($this->id,$type_relationship);
		
		// menu de acciones
		$actions   = '<div class="pages01"> <a href="javascript:void(0)" onclick="SimpleAJAXCall(\'index.php?form_popup.control/listRelationContents/' . $type . '/'  . $module_id . '/' . $type_relationship . '/' . $name . '/' . $field_id . '/' . $this->id  . '/' . $level  . '\', loadFormLayer, \'GET\', \'window2\'); ">Agregar Contenidos</a>';
		
		if(count($related_contents) > 0)
		{
			$actions .= '<a href="javascript:void(0);" onclick="SimpleAJAXCall(\'index.php?control_content_related.controller/deleteContentRelation1/\' +document.getElementById(\'' . $name . 'value\').value+ \'/' . $this->id . '/' . $type_relationship . '/\', doNothing, \'GET\', \'\'); SimpleAJAXCall(\'index.php?control_content_related.controller/refreshContentList//' . $this->id . '/' . $type . '/' . $field_id . '/' . $name . '/' . $module_id . '/' . $type_relationship . '\', ElementStateChanged, \'GET\', \'' . $name . '\'); ">Eliminar</a>';
		}
		$actions  .= '</div>';
		
		// div contenedor
		echo '<div class="rad_group">
                    ' . $actions;
		$firstId = 0;
		$first 	 = true;
        foreach($related_contents as $related_content)
		{
			$content = new Content($related_content);
			$checked 	  = '';
			
			if($first)
			{
				$firstId = $content->__get('content_id');
				$checked = 'checked';
			}
			
			echo '<label>
			<input onclick="document.getElementById(\'' . $name . 'value\').value = this.value" type="radio" ' . $checked . ' name="imageGroup' . $name . '" value="' . $content->__get('content_id') . '" id="imageGroup' . $content->__get('content_id') . '" />
			' . $content->__get('content_varchar_1') . '</label>';
			$first = false;
		}
        echo $actions . '<input type="hidden" name="' . $name . 'value" id="' . $name . 'value" value="' . $firstId . '" />
                  </div>';
	}
	public function put_city($name, $value, $id, $field_class)
	{
		$cities	= cityHelper::retrieveCities(" AND city_activated = 1");
		echo '<select name="' . $name . '" id="' . $id . '" class="' . $field_class . '">';
		foreach ($cities as $city)
		{
			$selected	=	($city->__get('city_name') == $value) ? 'selected' : '';
			echo '	<option value="'.$city->__get('city_name').'" '.$selected.' >'.$city->__get('city_name').'</option>';
		}
		echo '</select>';
	} 
	public function put_google_maps($name, $value, $options, $field_id, $field_class)
	{
		$center 	= '4.626440,-74.124784';
		$zoom		= '5';
		$coords = explode(',',$value);
		if (count($coords) == 3)
		{
			$center = $coords[0].','.$coords[1];
			$zoom	= $coords[2];
		}
        echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';

		$action = "ParamsAJAXCall('index.php?form_popup.control/setGogleMaps/".$this->id."/".$name."/".$options."/".$value."', loadGoogleMaps, 'GET', 'window2', '" . $center . "');";
		echo '<a onClick="'.$action.'" href="javascript:void(0)"><img height="25" width="113" border="0" alt="Editar" src="imgcontrol/M_editar.gif"/></a>';
	}		
}
?>