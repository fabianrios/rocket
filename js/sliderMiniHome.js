// JavaScript Document
var MSlider = Class.create();

var timeout;
var container1;
var locked;

MSlider.prototype = {
	settings: {
		'slideWidth': 467,
		'lastPositionInt': 0,
		'duration': 0.6
	},
	initialize: function () {
		if($$('#miniSliderClients')[0])
		{
			container1 	   		  			 = $$('#miniSliderClients')[0];
			var container1Width 		  	 = container1.getStyle('width');
			var widthInt 	   		  		 = parseInt(container1Width.replace(/px/g, ''));
			var lastPositionInt   	  		 = widthInt - this.settings['slideWidth'];
			this.settings['lastPositionInt'] = lastPositionInt * -1;
			var linkPrev1 					 = $$('.back-nav-brand')[0];
			var linkNext1 					 = $$('.forward-nav-brand')[0];
			locked 							 = false;		
			linkPrev1.observe('click', function (event) {
				event.stop();
				MSlider.prototype.slideToPrevious();
			});		
			linkNext1.observe('click', function (event) {
				event.stop();
				MSlider.prototype.slideToNext();
			});
		}
	},
	slideToNext: function() {
		if(!locked)
		{
			locked = true;
			if(container1.getStyle('left') == this.settings['lastPositionInt'] + 'px')
			{
				new Effect.Morph(container1, {
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
				new Effect.Morph(container1, {
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
			if(container1.getStyle('left') == '0px')
			{
				new Effect.Morph(container1, {
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
				new Effect.Morph(container1, {
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
		var left = container1.getStyle('left');
		return parseInt(left.replace(/px/g, ''))
	}
}
document.observe('dom:loaded', function () { 
	new MSlider(); 
});