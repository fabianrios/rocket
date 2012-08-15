function getScrollPosition()
{
	var hscroll = (document.all ? document.scrollLeft : window.pageXOffset);
	var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
	
	return [hscroll, vscroll];
}
function setAttributValue(id, attribute, value)
{
	eval("document.getElementById('"+id+"')."+attribute+" = '" + value + "'");
}
function getStyle(el, style) {
   if(!document.getElementById) return;
   
     var value = el.style[toCamelCase(style)];
   
    if(!value)
        if(document.defaultView)
            value = document.defaultView.
                 getComputedStyle(el, "").getPropertyValue(style);
       
        else if(el.currentStyle)
            value = el.currentStyle[toCamelCase(style)];
     
     return value;
}

function setStyle(objId, style, value) {
    document.getElementById(objId).style[style] = value;
}

function toCamelCase( sInput ) {
    var oStringList = sInput.split('-');
    if(oStringList.length == 1)   
        return oStringList[0];
    var ret = sInput.indexOf("-") == 0 ?
       oStringList[0].charAt(0).toUpperCase() + oStringList[0].substring(1) : oStringList[0];
    for(var i = 1, len = oStringList.length; i < len; i++){
        var s = oStringList[i];
        ret += s.charAt(0).toUpperCase() + s.substring(1)
    }
    return ret;
}

function increaseWidth(addToWidth, whichDiv){
    var theDiv = document.getElementById(whichDiv);
    var currWidth = parseInt(getStyle(theDiv, "width"));
    var newWidth = currWidth + parseInt(addToWidth);
    setStyle(whichDiv, "width", newWidth + "px");
}
function getPageSize()
{
	 var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = window.innerWidth + window.scrollMaxX;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	
	if (self.innerHeight) {	// all except Explorer
		if(document.documentElement.clientWidth){
			windowWidth = document.documentElement.clientWidth; 
		} else {
			windowWidth = self.innerWidth;
		}
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = xScroll;		
	} else {
		pageWidth = windowWidth;
	}

	return [pageWidth,pageHeight];
}
function getWindowSize() {
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
	return [myWidth,myHeight];  
}
function centerWindow( object )
{
	container = document.getElementById(object);
	var size = getWindowSize();
	var spos = getScrollPosition();
	
	var width  = getStyle(container, 'width').replace(/px/g, '');
	var height = getStyle(container, 'height').replace(/px/g, '');
	
	//alert(width);
	
	//container.style.height = ((size[0] - round(width))/2) + "px";
//	container.style.width  = (((size[1] - round(height))/2) + spos[1]) + "px";
}
function setOverlayHeight() 
{
	var div = document.getElementById('TB_overlay');
	var pageSize = getPageSize();
	div.style.height = pageSize[1] + "px";
}

function showOverlay ( )
{
	document.getElementById('TB_overlay').style.display = '';
}

function showWindow(windowId)
{
	document.getElementById(windowId).style.display = '';
}

function hideOverlay()
{
	document.getElementById('TB_overlay').style.display = 'none';	
}

function hideWindow(windowId)
{
	document.getElementById(windowId).style.display = 'none';
}

function loadFormLayer ( resp, object )
{
	toggleFlashObjects('close');
	ElementStateChanged (resp, object );
	showOverlay();
	centerWindow( object )		
	showWindow(object);
	setOverlayHeight();
}
function closeFormLayer ( object )
{
	toggleFlashObjects('open');
	hideOverlay();
	hideWindow(object);
	document.getElementById(object).innerHTML = '';		
}
function customFormLayer( in_url, in_callback , in_method , in_container_id, in_style_array, in_center)
{
	container = document.getElementById(in_container_id);
	for(var key in in_style_array)
	{
		if(key != 'toJSONString')
		{	
			eval("container.style." + key + " = '" + in_style_array[key] + "'");
		}
	}
	SimpleAJAXCall(in_url, in_callback, in_method, in_container_id);
}
function verifyText(textareaObject, text)
{
	
	if(textareaObject.value == text)
		textareaObject.value = '';
	
	return true;
}

function cleanInnerHTML(response, elementId)
{
	document.getElementById(elementId).innerHTML = '';
}

function doNothing()
{
}

function displayLoading(elementId)
{
	
	if((typeof document.getElementById(elementId) != 'undefined') && (elementId != ''))
	{
		if(elementId == 'window2')
		{
			showOverlay();
			showWindow(elementId);
		}
		document.getElementById(elementId).innerHTML = '<img src="' + ApplicationUrl + 'images/loading.gif" style="margin:0 auto" />';
	}
}
function toggleFlashObjects()
{
	var elements = document.getElementsByTagName("embed");
	var length   = elements.length;
	for(i=0;i<length;i++)
	{
		if(elements[i].style.display == '')
		{
			elements[i].style.display = 'none';
			elements[i].hidden = 'true';
		}
		else
		{
			elements[i].style.display = ''
			elements[i].hidden = 'false';
		}
	}
}
function switchState(principalObj, secondaryObjId)
{
	principalObj.style.display = 'none';
	document.getElementById(secondaryObjId).style.display = '';
	document.getElementById(secondaryObjId).focus();
}
function saveStates(form, object, enter)
{
	var elements = form.elements;
	for(i=0; i<elements.length; i++)
	{
		if(((elements[i].type == 'text') && (elements[i] != object)) || (enter))
		{
			if(elements[i].title != '')
			{
				document.getElementById('span'+elements[i].title).innerHTML = elements[i].value;
				switchState(elements[i], 'span'+elements[i].title);
				if((enter) && (elements[i] == object))
					SimpleAJAXCall ( 'index.php?country.controller/update/'+elements[i].title+'/'+object.value, doNothing, 'GET', '' );
				
			}
		}
		else
		{
			if(elements[i].type == 'text')
			{
				SimpleAJAXCall ( 'index.php?country.controller/update/'+elements[i].title+'/'+elements[i].value, doNothing, 'GET', '' );
			}
		}
	}
}
function checkEnter(e, form, object){ //e is event object passed from function invocation
	var characterCode; //literal character code will be stored in this variable
	
	if(e && e.which){ //if which property of event object is supported (NN4)
		e = e;
		characterCode = e.which; //character code is contained in NN4's which property
	}
	else{
		e = event;
		characterCode = e.keyCode; //character code is contained in IE's keyCode property
	}
	
	if(characterCode == 13){ //if generated character code is equal to ascii 13 (if enter key)
		saveStates(form, object, true);
	}
}
function submitForm(formId)
{
	document.getElementById(formId).submit();
}
function toggleObject(objectId)
{
	var target = document.getElementById(objectId);
	if(target.style.display == 'none')
		showWindow(objectId);
	else
		hideWindow(objectId);
}
function changePartner (num)
{
	var length = $('sociosContainer').childElements().length;
	if((num - 1) == length)
		num = 1;
	$('partnerImg').fade({ afterFinish: function(){
	   $('partnerImg').src = $('sociosContainer').childElements()[num - 1].innerHTML;

       $('partnerImg').appear();

	new PeriodicalExecuter(function (pe) { 
		changePartner(num + 1);
		pe.stop();
		}, 
		5);
     }
   }); 
	
}
function setLinkValue(prefix, inputId, url)
{
	url 	= url.replace(/prefix/, '');
	url 	= prefix + url;
	document.getElementById(inputId).value = url;
	closeFormLayer('window2');
}
function createSortable (containerId)
{
	Sortable.create(containerId, {
		tag:'li',
		ghosting:false,
		constraint:false,
		hoverclass:'over',
		onUpdate:function(sortable){
			var form = document.getElementById('serializeForm');
			form.serializedArray.value = Sortable.serialize(sortable);
		}
	});
}
function createSortablePopup (resp, windowId, containerId)
{
	loadFormLayer(resp, windowId);
	createSortable(containerId);
}
function onEndCrop( coords, dimensions ) {
	$('sourceXY').value = coords.x1 + ',' + coords.y1;
	$('size').value 	= dimensions.width + ',' + dimensions.height;
}

// with a supplied ratio
function createCropper(ratioX, ratioY) { 
	new Cropper.Img( 
		'imagen', 
		{ 
			ratioDim: { x: ratioX, y: ratioY }, 
			displayOnInit: true, 
			onEndCrop: onEndCrop,
			previewWrap: 'previewArea'
		} 
	) 
}
function createCropperPopup (resp, windowId, xy)
{
	loadFormLayer(resp, windowId);
	size = xy.split('x');
	createCropper(size[0], size[1]);
}
function showBox(element_id)
{
	document.getElementById(element_id).style.display 	  = '';
	document.getElementById(element_id+'_link').className = 'active';
}
function hideBox(element_id)
{
	document.getElementById(element_id).style.display 	  = 'none';
	document.getElementById(element_id+'_link').className = '';
}
function getScreen( url, size )
{
  if(url === null){ return ""; }

  size = (size === null) ? "big" : size;
  var vid;
  var results;

  results = url.match("[\\?&]v=([^&#]*)");

  vid = ( results === null ) ? url : results[1];

  if(size == "small"){
    return "http://img.youtube.com/vi/"+vid+"/2.jpg";
  }else {
    return "http://img.youtube.com/vi/"+vid+"/0.jpg";
  }
}

function toggleDiv(div)
{
	if(document.getElementById(div).style.display == 'none')
		document.getElementById(div).style.display = '';
	else
		document.getElementById(div).style.display = 'none';
	
}
function setCoords(flashInput)
{
	document.getElementById('coords').value = flashInput;
}
function bringToFront(itemId)
{
	document.getElementById('itemServices1').style.zIndex = 0;
	document.getElementById('itemServices2').style.zIndex = 0;
	document.getElementById('itemServices3').style.zIndex = 0;	
	document.getElementById(itemId).style.zIndex = 100;
}
function callSendMap(url, id)
{
	document.getElementById('pestana_0').className='pestanas-presencia-off';
	document.getElementById('pestana_1').className='pestanas-presencia-off';
	document.getElementById('pestana_2').className='pestanas-presencia-off';
	document.getElementById('pestana_'+id).className='pestanas-presencia-on';	
	SimpleAJAXCall(url, ElementStateChanged, 'GET', 'mapa-presencia');
}
function setActiveService(itemNum, itemCount, prefix)
{
	for(i = 1; i <= itemCount; i++)
	{
		document.getElementById('itemServices'+i).className = prefix+'off';
	}
	document.getElementById('itemServices'+itemNum).className = prefix+'on';
}
function changeImage(img)
{
	document.getElementById('imageBig').src = '../resources/images/363x283/'+img;
}

function togglecomments (postid, imageid, idext) { 

   var whichbar	 = document.getElementById(idext); //Barra
   var whichpost = document.getElementById(postid); //Texto
   var wichimage = document.getElementById(imageid); //imagen (+) (-)
   
   if (whichpost.style.display=="none") { 
      whichbar.className="date";
	  wichimage.className="expand-link-plus expand-less";
	  whichpost.style.display="";
   } 
   else { 
   	  whichbar.className="date expanded";	
      wichimage.className="expand-link-plus"; 
	  whichpost.style.display="none";
   } 
} 

function toggleitems (postid) { 

   var whichpost = document.getElementById(postid); //Texto
   
   if (whichpost.style.display=="none") { 
	  whichpost.style.display="";
   } 
   else { 
	  whichpost.style.display="none";
   } 
} 

function togglePanel(linkElement)
{
	var extendedElement = $(linkElement);
	var panel			= extendedElement.next();
	if(extendedElement.hasClassName('sobrepanel'))
	{
		extendedElement.toggleClassName('sobrepanel2');
	}
	else
		extendedElement.toggleClassName('sobrepanel');
	panel.toggle();
}

function setImageSpecie(file, title)
{
	document.getElementById('captionTitle').innerHTML = title;
	document.getElementById('bigImage').src = file;
}
if(document.observe)
{
	document.observe('dom:loaded', function () { 
		$$(".sobrepanel").each(function (item) {
			item.observe('click', function (event) {
				event.stop();
				togglePanel(this);
			})
		});
		$$('.panel02').each(function (item) {
			item.hide();
		});
	});
}

function daysBetween(date1, date2){
   if (date1.indexOf("-") != -1) { date1 = date1.split("-"); } else if (date1.indexOf("/") != -1) { date1 = date1.split("/"); } else { return 0; }
   if (date2.indexOf("-") != -1) { date2 = date2.split("-"); } else if (date2.indexOf("/") != -1) { date2 = date2.split("/"); } else { return 0; }
   if (parseInt(date1[0], 10) >= 1000) {
       var sDate = new Date(date1[0]+"/"+date1[1]+"/"+date1[2]);
   } else if (parseInt(date1[2], 10) >= 1000) {
       var sDate = new Date(date1[2]+"/"+date1[0]+"/"+date1[1]);
   } else {
       return 0;
   }
   if (parseInt(date2[0], 10) >= 1000) {
       var eDate = new Date(date2[0]+"/"+date2[1]+"/"+date2[2]);
   } else if (parseInt(date2[2], 10) >= 1000) {
       var eDate = new Date(date2[2]+"/"+date2[0]+"/"+date2[1]);
   } else {
       return 0;
   }
   var one_day = 1000*60*60*24;
   var daysApart = Math.abs(Math.ceil((sDate.getTime()-eDate.getTime())/one_day));
   return daysApart;
}

function calculateMonth(f1,f2,id)
{
  aF1 = f1.split("-");
  aF2 = f2.split("-");
  
  numMeses = aF2[0]*12 + aF2[1] - (aF1[0]*12 + aF1[1]);
  if (aF2[2]<aF1[2]){
    numMeses = numMeses - 1;
  }
  if(numMeses<=0)
  {
	result = daysBetween(f1,f2)
  	if(result==1)
		numberDate = result+' Dia';
	else
		numberDate = result+' Dias';
  }
  else	
  {
	if(numMeses==1)
		numberDate = numMeses+' Mes';
	else
		numberDate = numMeses+' Meses';
  }
  if(document.getElementById(id))
  	document.getElementById(id).innerHTML =  numberDate;
  //return numberDate;	
}

function loadGoogleMaps(resp, object, center)
{
	loadFormLayer(resp, object);	
	initialize(center);
}

function initialize(center)
{
	
	var coords = center.split(",");
	
	var latlng = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
    var myOptions = {
      zoom: 5,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	 var marker = new google.maps.Marker({
		  position: latlng, 
		  map: map,
		  draggable: true,
		  title: 'Defina la posici&oacute;n'	
	  });
	  
	  var coordInfoWindow = new google.maps.InfoWindow({
		  content: "Seleccione la ubicaci&oacute;n o arrastre el marcador",
		  position: latlng
	  });
		
	  coordInfoWindow.open(map,marker);
	 
	  google.maps.event.addListener(map, 'click', function(event) {
		coordInfoWindow.close();  
		marker.setPosition(event.latLng);
		var markerLang = event.latLng;
		document.getElementById('by_value').value = markerLang.lat() + ',' + markerLang.lng() + ',' + map.getZoom();
	  });
	  
	  google.maps.event.addListener(marker, 'drag', function() {
		coordInfoWindow.close();
		var markerLang = marker.getPosition();
		document.getElementById('by_value').value = markerLang.lat() + ',' + markerLang.lng() + ',' + map.getZoom();
      });
}