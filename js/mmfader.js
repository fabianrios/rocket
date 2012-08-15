var MMFader = Class.create();
var fader;
var nextPic;
var lastTimeout;
var currentOffset = 0;
var positions = Array;
var defaultLinkClassName = 'item-slider-nav';
var selectedLinkClassName = 'item-slider-nav selected';
var slides;
var navLinks;
var fadeEffect = null;
var appearEffect = null;
var timer;

MMFader.prototype = {
	initialize: function (container) {
		if(container) {
			slides = $$('a[class="item-slider"]');	
			navLinks = $$('a[title="nav_link"]');
			this.setHandlers(container);
			this.hideSlides();
		    this.setTimer();
		}
	},
	setHandlers: function (container) {
		navLinks.each(function (item) {
			var offset = item.positionedOffset()
			positions[offset[0]] = currentOffset;
			item.observe('click', function(event) { 
				event.stop();
				var offset = this.positionedOffset();
				itemOffset = positions[offset[0]];
				this.className = selectedLinkClassName;
				fader.deselectSiblings(this);
				fader.fadeTo(itemOffset);
				fader.setTimer();
			});
			currentOffset++;
		});
		currentOffset = 0;
	},
	hideSlides: function () {
		var first = true;
		slides.each(function (item) {
			if(!first)
			{
				item.hide();
			}
			else
			{
				first = false;
			}
		});
	},	
	fadeTo: function (itemOffset) {
		if(fadeEffect != null)
		{
			fadeEffect.cancel();
		}
		if(appearEffect != null)
		{
			appearEffect.cancel();
		}
		fadeEffect = new Effect.Fade(slides[currentOffset]);
		appearEffect = new Effect.Appear(slides[(itemOffset)]);
		currentOffset = itemOffset;
	},
	fadeToNext: function () {
		slideCount = slides.length;
		var nextOffset;
		if((currentOffset + 1) >= slideCount)
		{
			nextOffset = 0;
		}
		else
		{
			nextOffset = (currentOffset + 1);
		}
		this.fadeTo (nextOffset);
		navLinks.each(function (item) {
			var offset = item.positionedOffset()
			itemOffset = positions[offset[0]];
			if(itemOffset == nextOffset)
			{
				fader.deselectSiblings(item);
				item.className = selectedLinkClassName;
			}
		});
		this.setTimer();
	},
	deselectSiblings: function (item) {
		siblings = item.siblings();
		siblings.each(function (el) {
			el.className = defaultLinkClassName;
		});
	},
	setTimer: function () {
		clearTimeout(timer);
		timer = setTimeout("fader.fadeToNext()", 10000);
	}
}
document.observe('dom:loaded', function () { 
	fader = new MMFader($$(".stage_home")); 
});
