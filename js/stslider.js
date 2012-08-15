// JavaScript Document
var STSlider = Class.create();

var locked = false;
var container1;
var timeout;

STSlider.prototype = {
	settings: {
		'slideWidth': 661,
		'slideDuration': 8000,
		'lastPositionInt': 0,
		'duration': 1,
		'linkPositions': {}
	},
	initialize: function () {
		container1 	   		  			 = $$('.track')[0];
		var container1Width 		  	 = container1.getStyle('width');
		var widthInt 	   		  		 = parseInt(container1Width.replace(/px/g, ''));
		var lastPositionInt   	  		 = widthInt - this.settings['slideWidth'];
		this.settings['lastPositionInt'] = lastPositionInt * -1;
		var links 						 = $$('.stage-nav');
		var first						 = true;
		var count						 = 1;
		links.each(function(item) {
			if(first)
				item.toggleClassName('stage-selected');
			STSlider.prototype.settings['linkPositions'][item.identify()] = count;
			item.observe('click', STSlider.prototype.handleClick);
			count++;
			first = false;
		});
		locked 							 = false;		
		timeout = setTimeout('STSlider.prototype.slideToNext()', this.settings['slideDuration']);		
	},
	slideToNext: function() {
		if(!locked)
		{
			locked = true;
			var currentPositionInt = this.getCurrentPositionInt();
			var nextPositionInt	   = currentPositionInt - this.settings['slideWidth'];
			this.slideTo(nextPositionInt);
		}
	},
	handleClick: function(event) {
		event.stop();
		if(!locked)
		{
			locked = true;
			var element = Event.element(event);
			STSlider.prototype.slideTo(((STSlider.prototype.settings['linkPositions'][element.identify()] * STSlider.prototype.settings['slideWidth']) - STSlider.prototype.settings['slideWidth']) * -1);
		}
		
	},
	slideTo: function (nextPositionInt) {
		if(nextPositionInt < this.settings['lastPositionInt'])
			nextPositionInt = '0';
		this.toggleNavClasses(nextPositionInt);		
		new Effect.Morph(container1, {
			duration: this.settings['duration'],
			style: 'left:' + nextPositionInt + 'px',
			afterFinish: function () {
				locked = false;
			}
		});	
		clearTimeout(timeout);
		timeout = setTimeout('STSlider.prototype.slideToNext()', this.settings['slideDuration']);		
	},
	getCurrentPositionInt: function () {
		var left = container1.getStyle('left');
		return parseInt(left.replace(/px/g, ''))
	},
	toggleNavClasses: function (nextPositionInt) {
		var links = $$('.stage-selected');
		links.each(function(item) {
			item.toggleClassName('stage-selected');
		});
		nextLinkNumber = ((nextPositionInt*-1) + this.settings['slideWidth']) / this.settings['slideWidth'];		
		var count = 1;
		var links = $$('.stage-nav');
		links.each(function(item) {
			if(count == nextLinkNumber) 
				item.toggleClassName('stage-selected');
			count++;
		});
	}
}
document.observe('dom:loaded', function () { 
	new STSlider(); 
});