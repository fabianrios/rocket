// JavaScript Document
var MMSlider = Class.create();

var container2;
var locked2;
var widthInt2;

MMSlider.prototype = {
	settings: {
		'slideWidth': 560,
		'slideDuration': 8000,
		'lastPositionInt': 0,
		'duration': 1
	},
	initialize: function () {
		container2 	   		  			 = $$('.slide-nav-track')[0];
		var container2Width 		  	 = container2.getStyle('width');
		widthInt2 	   		  		 	 = parseInt(container2Width.replace(/px/g, ''));
		var lastPositionInt   	  		 = widthInt2 - this.settings['slideWidth'];
		this.settings['lastPositionInt'] = lastPositionInt * -1;
		var linkPrev 					 = $$('.prev-slide');
		var linkNext 					 = $$('.next-slide');
		locked2 							 = false;		
		linkPrev [0].observe('click', function (event) {
			event.stop();
			MMSlider.prototype.slideToPrevious();
		});		
		linkNext[0].observe('click', function (event) {
			event.stop();
			MMSlider.prototype.slideToNext();
		});
		//timeout = setTimeout('MMSlider.prototype.slideToNext()', this.settings['slideDuration']);
	},
	slideToNext: function() {
		if(!locked2)
		{
			locked2 = true;
			if((container2.getStyle('left') != this.settings['lastPositionInt'] + 'px') && (parseInt(container2.getStyle('left').replace(/px/, "")) + widthInt2) > (this.settings['lastPositionInt'] * -1))
			{
				var currentPositionInt = this.getCurrentPositionInt();
				var nextPositionInt	   = currentPositionInt - this.settings['slideWidth'];
				new Effect.Morph(container2, {
					duration: this.settings['duration'],
					style: 'left:' + nextPositionInt + 'px',
					afterFinish: function () {
						locked2 = false;
					}
				});	
			}
			else
			{
				locked2 = false;
			}
			clearTimeout(timeout);
			//timeout = setTimeout('MMSlider.prototype.slideToNext()', this.settings['slideDuration']);
		}
	},
	slideToPrevious: function() {
		if(!locked2)
		{		
			locked2 = true;		
			if(container2.getStyle('left') != '0px')
			{
				var currentPositionInt = this.getCurrentPositionInt();
				var nextPositionInt	   = currentPositionInt + this.settings['slideWidth'];
				new Effect.Morph(container2, {
					duration: this.settings['duration'],
					style: 'left:' + nextPositionInt + 'px',
					afterFinish: function () {
						locked2 = false;
					}
				});	
			}
			else
			{
				locked2 = false;		
			}
			clearTimeout(timeout);
			//timeout = setTimeout('MMSlider.prototype.slideToNext()', this.settings['slideDuration']);
		}
	},	
	getCurrentPositionInt: function () {
		var left = container2.getStyle('left');
		return parseInt(left.replace(/px/g, ''))
	}
}
document.observe('dom:loaded', function () { 
	new MMSlider(); 
});