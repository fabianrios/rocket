// JavaScript Document
var SSlider = Class.create();

var timeout;
var container2;
var locked;

SSlider.prototype = {
	settings: {
		'slideWidth': 573,
		'lastPositionInt': 0,
		'duration': 0.6
	},
	initialize: function () {
		if($$('#sliderDetail')[0])
		{
			container2 	   		  			 = $$('#sliderDetail')[0];
			var container2Width 		  	 = container2.getStyle('width');
			var widthInt 	   		  		 = parseInt(container2Width.replace(/px/g, ''));
			var lastPositionInt   	  		 = widthInt - this.settings['slideWidth'];
			this.settings['lastPositionInt'] = lastPositionInt * -1;
			var linkPrev1 					 = $$('.back2')[0];
			var linkNext1 					 = $$('.forward2')[0];
			locked 							 = false;		
			linkPrev1.observe('click', function (event) {
				event.stop();
				SSlider.prototype.slideToPrevious();
			});		
			linkNext1.observe('click', function (event) {
				event.stop();
				SSlider.prototype.slideToNext();
			});
		}
	},
	slideToNext: function() {
		if(!locked)
		{
			locked = true;
			if(container2.getStyle('left') == this.settings['lastPositionInt'] + 'px')
			{
				new Effect.Morph(container2, {
					duration: this.settings['duration'],
					style: 'left:0px',
					afterFinish: function () {
						locked = false;
					}
				});
			}
			else
			{
				var currentPositionInt = this.getCurrentPositionInt();
				var nextPositionInt	   = currentPositionInt - this.settings['slideWidth'];
				new Effect.Morph(container2, {
					duration: this.settings['duration'],
					style: 'left:' + nextPositionInt + 'px',
					afterFinish: function () {
						locked = false;
					}
				});			
			}
		}
	},
	slideToPrevious: function() {
		if(!locked)
		{		
			locked = true;		
			if(container2.getStyle('left') == '0px')
			{
				new Effect.Morph(container2, {
					duration: this.settings['duration'],
					style: 'left:' + this.settings['lastPositionInt'] + 'px',
					afterFinish: function () {
						locked = false;
					}
				});
			}
			else
			{
				var currentPositionInt = this.getCurrentPositionInt();
				var nextPositionInt	   = currentPositionInt + this.settings['slideWidth'];
				new Effect.Morph(container2, {
					duration: this.settings['duration'],
					style: 'left:' + nextPositionInt + 'px',
					afterFinish: function () {
						locked = false;
					}
				});			
			}
		}
	},	
	getCurrentPositionInt: function () {
		var left = container2.getStyle('left');
		return parseInt(left.replace(/px/g, ''))
	}
}
document.observe('dom:loaded', function () { 
	new SSlider(); 
});