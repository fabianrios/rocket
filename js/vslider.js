// JavaScript Document
var VSlider = Class.create();

var locked = false;
var container1;

VSlider.prototype = {
	settings: {
		'slideHeight': 270,
		'slideDuration': 8000,
		'lastPositionInt': 0,
		'duration': 1
	},
	initialize: function () {
		container1 	   		  			 = $$('.mascara-pista')[0];
		var container1Height 		  	 = container1.getStyle('height');
		var heightInt 	   		  		 = parseInt(container1Height.replace(/px/g, ''));
		var lastPositionInt   	  		 = heightInt - this.settings['slideHeight'];
		this.settings['lastPositionInt'] = lastPositionInt * -1;
		var links 						 = $$('.slide-link');
		locked 							 = false;		
		links[0].observe('click', function (event) {
			event.stop();
			VSlider.prototype.slideToPrevious();
		});		
		links[1].observe('click', function (event) {
			event.stop();
			VSlider.prototype.slideToNext();
		});
	},
	slideToNext: function() {
		if(!locked)
		{
			locked = true;
			if(container1.getStyle('top') != this.settings['lastPositionInt'] + 'px')
			{
				var currentPositionInt = this.getCurrentPositionInt();
				var nextPositionInt	   = currentPositionInt - this.settings['slideHeight'];
				new Effect.Morph(container1, {
					duration: this.settings['duration'],
					style: 'top:' + nextPositionInt + 'px',
					afterFinish: function () {
						locked = false;
					}
				});	
			}
			else
			{
				locked = false;
			}
		}
	},
	slideToPrevious: function() {
		if(!locked)
		{		
			locked = true;		
			if(container1.getStyle('top') != '0px')
			{
				var currentPositionInt = this.getCurrentPositionInt();
				var nextPositionInt	   = currentPositionInt + this.settings['slideHeight'];
				new Effect.Morph(container1, {
					duration: this.settings['duration'],
					style: 'top:' + nextPositionInt + 'px',
					afterFinish: function () {
						locked = false;
					}
				});
			}
			else
			{
				locked = false;
			}
		}
	},	
	getCurrentPositionInt: function () {
		var top = container1.getStyle('top');
		return parseInt(top.replace(/px/g, ''))
	}
}
document.observe('dom:loaded', function () { 
	new VSlider(); 
});