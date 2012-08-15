// JavaScript Document
var HSlider = Class.create();

var timeout;
var container;
var locked;

HSlider.prototype = {
	settings: {
		'slideWidth': 990,
		'lastPositionInt': 0,
		'duration': 0.6
	},
	initialize: function () {
		if($$('.track1')[0])
		{
			container 	   		  			 = $$('.track1')[0];
			var containerWidth 		  	 	 = container.getStyle('width');
			var widthInt 	   		  		 = parseInt(containerWidth.replace(/px/g, ''));
			var lastPositionInt   	  		 = widthInt - this.settings['slideWidth'];
			this.settings['lastPositionInt'] = lastPositionInt * -1;
			var linkPrev 					 = $$('.back-nav-large')[0];
			var linkNext 					 = $$('.forward-nav-large')[0];	
			locked 							 = false;		
			linkPrev.observe('click', function (event) {
				event.stop();
				HSlider.prototype.slideToPrevious();
			});		
			linkNext.observe('click', function (event) {
				event.stop();
				HSlider.prototype.slideToNext();
			});
		}
	},
	slideToNext: function() {
		if(!locked)
		{
			locked = true;
			if(container.getStyle('left') == this.settings['lastPositionInt'] + 'px')
			{
				new Effect.Morph(container, {
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
				new Effect.Morph(container, {
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
			if(container.getStyle('left') == '0px')
			{
				new Effect.Morph(container, {
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
				new Effect.Morph(container, {
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
		var left = container.getStyle('left');
		return parseInt(left.replace(/px/g, ''))
	}
}
document.observe('dom:loaded', function () { 
	new HSlider(); 
});