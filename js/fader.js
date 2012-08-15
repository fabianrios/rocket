sliderOptions = Object.extend({
	slideNumber: 3,
	slideSpeed: 1,
	slideDuration: 10000,
	clickeable: true,
	slideContainerClass: 'slides',
	slideNavContainerClass: 'wrapper-slider-nav',
	slideTextClass: 'slides-text',
	slideHrefClass: 'slides-href',	
	slideAttributesPrefix: 'slide'
	
}, window.sliderOptions || {});

var MMSlider = Class.create();

var nextPic;

var lastTimeout;

MMSlider.prototype = {
	currentPic: 1,
	initialize: function () {
		alert("hello");
		var objects = false;
		$$('.'+sliderOptions.slideNavContainerClass+' a').each(function(item) {
			   item.writeAttribute('href', 'javascript:void(0);');
			   item.observe('click', function() { 
			   MMSlider.prototype.showItem(this);
			})
			objects = true;
		});
		if(objects)
		{
			this.setTimer();
		}
	},
	showItem: function (item) {
		var img = new Image();
		var number = parseInt(item.title.replace(/slide/g, ''));
		img.src = $$('#'+item.title+'-image img')[0].readAttribute('src');
		var y = (img.height) - (img.height * number);
		new Effect.Morph(sliderOptions.slideAttributesPrefix+'1-image', {
			style: 'margin-top:'+y+'px',
			duration: sliderOptions.slideSpeed
		});
		$$('.'+sliderOptions.slideTextClass)[0].update($$('#'+item.title+'-text')[0].innerHTML);
		$$('.'+sliderOptions.slideHrefClass)[0].writeAttribute('href', $$('#'+item.title+'-href')[0].innerHTML);
		$$('.'+sliderOptions.slideHrefClass)[0].writeAttribute('title', $$('#'+item.title+'-image img')[0].readAttribute('alt'));
		$$('.'+sliderOptions.slideHrefClass)[0].writeAttribute('target', $$('#'+item.title+'-href-target')[0].innerHTML);
		this.setTimer();
		return false;	
	},
	setTimer: function () {
		clearTimeout(lastTimeout);
		this.calculateNextPic();
		lastTimeout = setTimeout('MMSlider.prototype.showItem($$(\'#\'+sliderOptions.slideAttributesPrefix+nextPic+\'-nav\')[0])', sliderOptions.slideDuration
	)},
	calculateNextPic: function() {
		if(this.currentPic >= sliderOptions.slideNumber)
		{
			this.currentPic = 1;
		}
		else
		{
			this.currentPic++;
		}
		nextPic = this.currentPic;
	}
}
document.observe('dom:loaded', function () { new MMSlider(); });