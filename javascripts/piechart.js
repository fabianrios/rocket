function c(o){
	try{console.log(o)}catch(err){};
}

function noCanvasSupport(){
	return ($.browser.msie && (Math.floor($.browser.version) < 9));
}

function initPieChart(stageID, stageWidth, stageHeight, chartInfo){
	if(noCanvasSupport())
		return false;
	
	var stage = new Kinetic.Stage(stageID, stageWidth, stageWidth);
	
	stage['x0'] = stageWidth/2;
	stage['y0'] = stageHeight/2;
	stage['r'] = stageHeight/2 - 80;
	stage['r2'] = stage['r'] + 12;
	stage['chartInfo'] = chartInfo;
	
	var chartLayer = new Kinetic.Layer('chart');
	var anchorsSliderLayer = new Kinetic.Layer('anchors-slider');
	var anchorsLayer = new Kinetic.Layer('anchors');
	
	stage.add(anchorsSliderLayer);
	stage.add(chartLayer);
	stage.add(anchorsLayer);
	
	drawPieChartAnchors(stage);
	//drawPieChartAnchorsSlider(stage);
	drawPieChart(stage);

	
	updatePieChartRelatedData(stage);
}

function updatePieChartRelatedData(stage){
	var chartInfo = stage['chartInfo'];
	
	var arrValues = getPieChartValues(stage);
	
	for (var i=0; i< chartInfo.length; i++){
		var saveField = document.getElementById(chartInfo[i]['fieldID']);
		saveField.value = arrValues[i];
	}
	
	updatePieChartLabels(stage);
}

function drawPieChartAnchors(stage){

	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];
	var r2 = stage['r2'];
	var chartInfo = stage['chartInfo'];
	
	var anchorsLayer = stage.getLayer('anchors');
	anchorsLayer.clear();
	
	var t = getSliceAngleByPercent(chartInfo[0]['percentage']);
	
	var firstPieCoords = getFirstPieSliceCoords(x0, y0, r2, t);
	
	for (var i=0; i<2; i++){
		buildPieChartAnchor(stage, firstPieCoords[i].x, firstPieCoords[i].y, 'anchor' + (i+1), i);
	}
	
	for (var i=2; i<chartInfo.length; i++){
		var prevAnchor = anchorsLayer.getShape('anchor' + i);
		
		var anchorCoords = getPieSliceCoords(x0, y0, r2, prevAnchor['x'], prevAnchor['y'], getSliceAngleByPercent(chartInfo[i-1]['percentage']));
		buildPieChartAnchor(stage, anchorCoords['x'], anchorCoords['y'], 'anchor' + (i+1), i);
	}
}

function buildPieChartAnchor(stage, x, y, anchorName, anchorIndex){

	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];
	
	var anchorsLayer = stage.getLayer('anchors');
	
	var anchor = new Kinetic.Shape(function(){
		var context = this.getContext();
		
		context.beginPath();
			context.lineWidth = 2;
			context.strokeStyle = "#666";
			context.fillStyle = "#fff";
			context.arc(0, 0, 7, 0, 2 * Math.PI, false);
		context.closePath();
		
		context.fill();
		context.stroke();
	}, anchorName);
	
	anchor.index = anchorIndex;
	anchor.prevX = x;
	anchor.prevY = y;
	anchor.dragging = false;
	anchor.lineWidth = 1;
	anchor.setPosition(x, y);
	anchor.draggable(true);
	anchor.permitDrag = true;
	anchor.relatedPreviousPercentage = 200;	
	anchor.itemPreviousPercentage = 200;	
	
	anchor.on("dragmove", function(){
		updatePieChartAnchorPosition(stage, this);
	});
	
	anchor.on("dragstart", function(){
	
		anchor.dragging = true;
		
		document.body.style.cursor = "pointer";
		this.lineWidth = 2;
		this.strokeStyle = "#000";
		anchorsLayer.draw();
	});
	
	anchor.on("dragend", function(){
	
		anchor.dragging = false;
		
		document.body.style.cursor = "default";
		this.lineWidth = 1;
		this.strokeStyle = "#000";
		anchorsLayer.draw();
	});
	
	anchor.on("mouseover", function(){
		document.body.style.cursor = "pointer";
		this.setFill('black');
		anchorsLayer.draw();
	});
	
	anchor.on("mouseout", function(){
	
		if(this.dragging == false){
			document.body.style.cursor = "default";
			this.lineWidth = 1;
			this.strokeStyle = "#666";
			anchorsLayer.draw();
		}
	});
	/*anchor.on("click", function(){
		var context = this.getContext();
		if(this.permitDrag)
		{
			this.permitDrag = false;
			this.draggable(false);
			
			context.lineWidth = 2;
			anchorsLayer.draw();
		}
		else
		{
			this.permitDrag = true;
			this.draggable(true);
			context.lineWidth = 1;
			anchorsLayer.draw();
		}
	});*/
	anchorsLayer.add(anchor);
	anchorsLayer.draw();
	return anchor;
}

function updatePieChartAnchorPosition(stage, anchor){
	
	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];	
	
	var computedCoords = getCircleComputedCoords(x0, y0, r2, anchor.x, anchor.y);
	
	anchor.x = anchor.prevX;
	anchor.y = anchor.prevY;
	
	var relatedAnchors = getPieChartRelatedAnchors(stage, anchor);
	
	var t1 = getSlicePercentByAngle(getSliceAngle(x0, y0, relatedAnchors[0]['x'], relatedAnchors[0]['y'], computedCoords['x'], computedCoords['y']));
	
	c("t1 Percent = " + t1);
	
	if((t1 >= 1) && (t1 < 100)){
	
		if ((t1 > 20) && (anchor.itemPreviousPercentage < 10)) {
			// user is going past, don't move pie any more
	
		} else {	
			var t2 = getSlicePercentByAngle(getSliceAngle(x0, y0, computedCoords['x'], computedCoords['y'], relatedAnchors[1]['x'], relatedAnchors[1]['y']));

			if ((t2 > (100/$('.piechart-input').length)) && (anchor.relatedPreviousPercentage < 10)) {
				// user is going past, don't move pie any more
		
			} else {	
	
	
	
			c("t2 Percent = " + t2);
				if((t2 >= 1) && (t2 < 100)) {
					anchor.x = computedCoords.x;
					anchor.y = computedCoords.y;
					
					anchor.prevX = anchor.x;
					anchor.prevY = anchor.y;
					
					anchor.relatedPreviousPercentage = t2;	
					anchor.itemPreviousPercentage = t1;	
				}
			}
		}
	}
	
	var layer = anchor.getLayer();
	layer.draw();
	
	drawPieChart(stage);
	updatePieChartRelatedData(stage);

}
/*function updatePieChartAnchorPosition(stage, anchor){
	
	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];	
	
	var computedCoords = getCircleComputedCoords(x0, y0, r2, anchor.x, anchor.y);
	
	anchor.x = anchor.prevX;
	anchor.y = anchor.prevY;
	
	//var relatedAnchors = getPieChartRelatedAnchors(stage, anchor);
	var anchorsLayer = stage.getLayer('anchors');
	var relatedAnchors = anchorsLayer.getShapes();
	
	var anchorPercentage = getSlicePercentByAngle(getSliceAngle(x0, y0, relatedAnchors[anchor.index]['x'], relatedAnchors[anchor.index]['y'], computedCoords['x'], computedCoords['y']));

	anchor.x = computedCoords.x;
	anchor.y = computedCoords.y;
	
	anchor.prevX = anchor.x;
	anchor.prevY = anchor.y;
	
	//anchor.relatedPreviousPercentage = t2;	
	anchor.itemPreviousPercentage = anchorPercentage;		
	
	var anchorCurrentPercentage = getSlicePercentByAngle(getSliceAngle(x0, y0, relatedAnchors[anchor.index]['x'], relatedAnchors[anchor.index]['y'], computedCoords['x'], computedCoords['y']));
	c(anchorCurrentPercentage);
	var anchorPercentageChange = anchorPercentage / anchorCurrentPercentage;
	for (var i=0; i<relatedAnchors.length; i++){
		
		if(i != anchor.index)
		{
			var relatedAnchorComputedCoords = getCircleComputedCoords(x0, y0, r2, relatedAnchors[i].x, relatedAnchors[i].y);
			var anchorPercentage = getSlicePercentByAngle(getSliceAngle(x0, y0, relatedAnchors[i]['x'], relatedAnchors[i]['y'], relatedAnchorComputedCoords['x'], relatedAnchorComputedCoords['y']));
			/*relatedAnchors[i].x = relatedAnchorComputedCoords.x * anchorPercentageChange;
			relatedAnchors[i].y = relatedAnchorComputedCoords.y * anchorPercentageChange;
			
			relatedAnchors[i].prevX = relatedAnchors[i].x;
			relatedAnchors[i].prevY = relatedAnchors[i].y;
			
			//anchor.relatedPreviousPercentage = t2;	
			relatedAnchors[i].itemPreviousPercentage = anchorPercentage;	
		}
	}	
	
	var layer = anchor.getLayer();
	layer.draw();
	
	drawPieChart(stage);
	updatePieChartRelatedData(stage);

}*/

function getPieChartRelatedAnchors(stage, anchor){
	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];
	
	var anchorsLayer = stage.getLayer('anchors');
	var anchors = anchorsLayer.getShapes();
	
	var anchorIndex = anchor.index;
	
	var relatedAnchor1 = (anchorIndex == 0)?anchors[anchors.length -1]:anchors[anchorIndex - 1];
	var relatedAnchor2 = (anchorIndex == anchors.length -1)?anchors[0]:anchors[anchorIndex + 1];
	
	
	return [relatedAnchor1, relatedAnchor2];
}


function getPieChartValues(stage){
	var result = [];
	
	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];
	
	var anchorsLayer = stage.getLayer('anchors');

	var anchors = anchorsLayer.getShapes();
	
	for (var i=0; i<anchors.length; i++){
		var currentAnchor = anchors[i];
		var nextAnchor = (i!= anchors.length -1)?anchors[i+1]:anchors[0];
		
		result[i] = getSlicePercentByAngle(getSliceAngle(x0, y0, currentAnchor['x'], currentAnchor['y'], nextAnchor['x'], nextAnchor['y']));
	}
	
	return result;
}

function updatePieChartLabels(stage){
	var chartInfo = stage['chartInfo'];
	var arrValues = getPieChartValues(stage);
	for (var i=0; i<chartInfo.length; i++){
			
		var label = document.getElementById(chartInfo[i]['percentageLabelID']);
		label.innerHTML = arrValues[i];				
	}
}


function drawPieChart(stage){

	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];
	var chartInfo = stage['chartInfo'];
	
	var chartLayer = stage.getLayer('chart');
	chartLayer.clear();
	
	var anchorsLayer = stage.getLayer('anchors');
	var anchors = anchorsLayer.getShapes();

	var context = chartLayer.getContext();
	
	var strokeSettings = {
				lineWidth: 2,
				strokeStyle: '#FFF'
			};
	
	var fillSettings = {fillStyle: 'red'};
	
	for (var i=0; i<anchors.length; i++){
		fillSettings['fillStyle'] = chartInfo[i]['color'];
		
		var startAnchor = anchors[i];
		var endAnchor = (i<anchors.length-1)?anchors[i+1]:anchors[0];
		
		drawSlice(chartLayer, x0, y0, r, startAnchor['x'], startAnchor['y'], endAnchor['x'], endAnchor['y'], strokeSettings, fillSettings);
	}
}

function drawPieChartAnchorsSlider(stage){
	var x0 = stage['x0'];
	var y0 = stage['y0'];
	var r = stage['r'];
	var r2 = stage['r2'];
	var chartInfo = stage['chartInfo'];
	
	var anchorsSliderLayer = stage.getLayer('anchors-slider');
	
	var sliderCircle = new Kinetic.Shape(function(){
		var context = this.getContext();
		
		context.beginPath();
			context.lineWidth = this.lineWidth;
			context.strokeStyle = "#EEE";
			context.arc(x0, y0, r2, 0, 2 * Math.PI, false);
		context.closePath();
		
		context.stroke();
	}, 'slider-circle');
	
	anchorsSliderLayer.add(sliderCircle);
	anchorsSliderLayer.draw();
}

function drawSlice(layer, x0, y0, r, x1, y1, x2, y2, strokeSettings, fillSettings){
	
	var context = layer.getContext();
	
	var t1 = getAngle(x0, y0, x1, y1);
	var t2 = getAngle(x0, y0, x2, y2);
	
	context.beginPath();
	
		context.moveTo(x0, y0);
		context.lineTo(x1, y1);
		
		drawArc(layer, x0, y0, r, t1, t2);
		
		context.moveTo(x0, y0);
		context.lineTo(x2, y2);
	
	context.closePath();
	
	if(strokeSettings != null){
		for (var i in strokeSettings){
			context[i] = strokeSettings[i];
		}
		context.stroke();
	}
	
	if(fillSettings != null){
		for (var i in fillSettings){
			context[i] = fillSettings[i];			
		}
		context.fill();
	}
}

function drawArc(layer, x0, y0, r, t1, t2){
	var context = layer.getContext();
	
	if(Math.abs(t2-t1) < 0.01){
		context.arc(x0, y0, r, t1, t2 + 2*Math.PI);
	}else{
		context.arc(x0, y0, r, t1, t2);
	}
}

function getCircleComputedCoords(x0, y0, r, x, y){
	
	var result = {x: null, y: null};
	
	if ((x >= x0 - r/2) && (x <= x0 + r/2)) {
		result.x = x;
		
		if(x < x0 - r){
			result.x = x0 - r
		}else if(x > x0 + r){
			result.x = x0 + r;
		}
		
		var f = (y < y0)?-1:1;
		
		result.y = f*Math.sqrt(Math.pow(r,2) - Math.pow((result.x - x0), 2)) + y0;
	}else{
		result.y = y;
		
		if(y < y0 - r){
			result.y = y0 - r
		}else if(y > y0 + r){
			result.y = y0 + r;
		}

		var f = (x < x0)?-1:1;
		
		result.x = f*Math.sqrt(Math.pow(r,2) - Math.pow((result.y - y0), 2)) + x0;
	}
	
	return result;
}


function getAngle(x1, y1, x2, y2){

	var dx = x2 - x1;
	var dy = y2 - y1;
	
	if(dx == 0){
		if(dy > 0){
			return Math.PI/2
		}else{ // dy < 0
			return 3*Math.PI/2
		}
	}else if(dy == 0){
		if(dx > 0){
			return 0
		}else{ // dx < 0
			return Math.PI
		}
	}else{
		var m = dy/dx;
		
		if(m > 0){ // (dx > 0, dy > 0) || (dx < 0, dy < 0)
			if(dx > 0){  //c('q IV')
				return Math.atan(m);
			}else{  //c('q II')
				return Math.PI + Math.atan(m);
			}
		}else{
			if(dx > 0){  //c('q III')
				return 2*Math.PI + Math.atan(m);
			}else{  //c('q I')
				return Math.PI + Math.atan(m);
			}
		}
		
	}			
}

function getSliceAngle(x0, y0, x1, y1, x2, y2){

	var t1 = getAngle(x0, y0, x1, y1);
	var t2 = getAngle(x0, y0, x2, y2);
	
	return (t2 >= t1)?(t2 - t1):(2*Math.PI + t2 - t1);
}

function getSliceAngleByPercent(percent){
	return percent*(2*Math.PI/100);
}

function getSlicePercentByAngle(angle){
	return Math.round(angle*100/(2*Math.PI));
}

function getPieSliceCoords(x0, y0, r, x1, y1, t){

	var t1 = getAngle(x0, y0, x1, y1);
	var t2 = t1 + t;
	
	return {
			x: x0 + r*Math.cos(t2),
			y: y0 + r*Math.sin(t2)
		}
}

function getFirstPieSliceCoords(x0, y0, r, t){			
	return [{
			x: x0 + r * Math.cos(t/2),
			y: y0 - r * Math.sin(t/2)
		},
		{
			x: x0 + r * Math.cos(2*Math.PI - t/2),
			y: y0 - r * Math.sin(2*Math.PI - t/2)
		}]
}