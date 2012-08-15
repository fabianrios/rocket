if(!ciBaseUrl)
	var ciBaseUrl = '';
	
function c(s){
	try{console.log(s)}catch(err){}
}


function goToTop() {
	try { FB.Canvas.scrollTo(0,150); } catch(err) {}
}

function initFBAuthorizeLink(){
	$('a.js-lnk-authorize').click(function(){

		lytic("Link-ConnectWithFacebook");

		checkFacebookLogin(function(fbData){
			if(fbData != null){
				var form = $('form[name=friends]');
				for(var i in fbData){
					form.append('<input type="hidden" name="' + i + '" value="' + fbData[i] + '" />');
				}
				form.submit();
			}
		}, {scope:'user_interests, user_likes, user_birthday, user_hometown, user_location, user_relationships, user_photo_video_tags, user_religion_politics, friends_birthday, friends_interests, friends_likes, friends_hometown, friends_location, friends_relationships, friends_photo_video_tags, friends_religion_politics, read_stream'});
		return false;
	})
}

function initValLabels(wrapper){
	if(!wrapper)
		var wrapper = $('body');
		
	var valLabelFields = wrapper.find('input.js-has-val-label, textarea.js-has-val-label');
	valLabelFields.each(function(){
		var field = $(this);
		if($.trim(field.val()) == ''){
			field.val(field.attr('title')).addClass('default');
		}
	});
	
	valLabelFields.focus(function(){
		var field = $(this);
		if($.trim(field.val()) == field.attr('title')){
			field.val('').removeClass('default');
		}
	});
	
	valLabelFields.blur(function(){
		var field = $(this);
		if($.trim(field.val()) == ''){
			field.val(field.attr('title')).addClass('default');
		}
	});
	
	valLabelFields.parents('form:first')
		.submit(function(){
			clearValLabels($(this));
		})
}

function clearValLabels(wrapper){
	if(!wrapper)
		var wrapper = $('body');
		
	wrapper.find('input.js-has-val-label, textarea.js-has-val-label')
		.each(function(){
			var field = $(this);
			if($.trim(field.val()) == field.attr('title')){
				field.val('').addClass('default');
			}
		});
}

function checkFacebookLogin(callback, perms){
	try{
		var appCallBack = callback;
		FB.login(function(response) {
		  if (response.authResponse) {
			if (response.status == 'connected') {
				FB.api('/me', function(userInfo) {
					  appCallBack($.extend(response.authResponse, userInfo));
				});
			  // user is logged in and granted some permissions.
			  // perms is a comma separated list of granted permissions
			} else {
				appCallBack(response.authResponse);
			  // user is logged in, but did not grant any permissions || already granted permissions
			}
		  } else {
			// user is not logged in
				appCallBack();
		  }
		}, perms);

	}catch(err){
		callback.call();
	}
}

function initPrefsSliders(){
	var pageFrm = $('#FiltersForm');
	if(pageFrm.size() > 0){
		if(pageFrm.hasClass('preferences-page')){
	
			var prefsInfo = readPrefsInfo();
		
			$(".slider-bar").each(function(i){
				var slider = $(this);
				var relatedFields = slider.find('input');
				
				slider.slider({ 
						value: getSliderValue(prefsInfo, relatedFields.eq(0).attr('name')),
						stop: function(event, ui){
							var slider;
							if(ui.value < 50){
								relatedFields.eq(0).click();
								updatePrefsInfo(prefsInfo, relatedFields.eq(0).attr('name'), ui.value);
							}else if(ui.value > 50){
								relatedFields.eq(1).click();
								updatePrefsInfo(prefsInfo, relatedFields.eq(1).attr('name'), ui.value);
							}else{
								relatedFields.attr('checked', false);
								updatePrefsInfo(prefsInfo, relatedFields.eq(0).attr('name'), 50);
							}
							
							
						}
					});
			})
		}
	}		    
}

function getSliderValue(prefsInfo, prefsFieldName){
	return prefsInfo[prefsFieldName];
}

function updatePrefsInfo(prefsInfo, prefsFieldName, prefsFieldValue){
	
	prefsInfo[prefsFieldName] = prefsFieldValue;
	
	$.cookie('Prefs', JSON.stringify(prefsInfo), {expires: 365, path: '/'});
	
}

function readPrefsInfo(){
	var prefs = $.cookie('Prefs');
	
	if(prefs == null){
		var result = {};
		$(".slider-bar").each(function(){
			var slider = $(this);
			var prefsFields = slider.find('input');
			result[prefsFields.eq(0).attr('name')] = 50;
		});
	}else{
		var result = JSON.parse(prefs);
	}

	return result;
}

function initPhotoGallerySelect(){
	var pageFrm = $('#FiltersForm');
	if(pageFrm.size() > 0){
		if(pageFrm.hasClass('photos-page')){
			var photoLabels = pageFrm.find('.photo label');
			var fields = photoLabels.find('input:checkbox');
			
			if(photoLabels.size() > 0){
				var maxAllowed = parseInt($('input[name=MaxPhotos]').val());
				
				fields.click(function(){
						return false;
					});
				
				
				photoLabels.click(function(){
					var label = $(this);
					var chk = label.find('input:checkbox');
					
					if(chk.filter(':checked').size() == 0){
						
						var fields_selected = fields.filter(':checked');
						
						if(fields_selected.size() == maxAllowed){
							alert('Please select a number of maximum ' + maxAllowed + ' photos');
						}else{
							chk.attr('checked', true);
							label.addClass('selected');
						}
						
					}else{
						chk.attr('checked', false);
						label.removeClass('selected');
					}
					
					return false;
				})
			}
		}
	}
}

function initAJAXOverlays(wrapper){
	if(!wrapper)
		var wrapper = $('body');
		
	var triggers = wrapper.find('a.js-lnk-overlay-trigger, area.js-lnk-overlay-trigger');
	triggers.click(function(){
				clearTimeout(shareOverlayTimer);
				var lnk = $(this);
				var target = $(lnk.attr('rel'));
				target.find('.js-overlay-content').html('<div class="overlay-content"><div class="loading">processing request...</div></div>');
				target.find('.js-hide-on-load').css('display', 'block');
				lnk.overlay({
					    api: true, top: 200, 
					    close: '.btn-close', 
					    fixed: false, 
					    oneInstance: false, 
					    mask: {color: '#000', loadSpeed: 10, opacity: 0.72},
					    onClose:  function(){
								var overlay = $(this.getOverlay());
								overlay.css({
									'width': '',
									'marginLeft': 0
								});
								
								overlay.find('.js-hide-on-load').css('display', 'block');
							}
					    
					    }).load();
				//target.center(); // show pending message
				
				$.ajax({
						url: lnk.attr('href'),
						success: function(HTMLResponse)
							{	
								var overlayContent = target.find('.js-overlay-content'); // append new content to popup
								target.find('.js-hide-on-load').css('display', 'none');
								overlayContent.html(HTMLResponse); // append new content to popup
								
								var overlayForm = overlayContent.find('form');
								if(overlayForm.size() > 0){
									initOverlayForm(overlayForm.attr('id'));
								}
								
								lnk.overlay({target: target, api: true, top: 200, close: '.btn-close', fixed: false, oneInstance: false}).load(); // re-display overlay
								
								initAJAXOverlays(overlayContent);
								initShareLinks(overlayContent);
								initLytics(overlayContent);
							},
						error: function(err)
							{
								
							}
					});
				
				if(lnk.hasClass('js-lnk-overlay-share'))
					$.cookie('share-overlay-displayed', '1', {expires: 30, path: '/'});
					
				return false;
			});
}

function initOverlayForm(formID){
	if(formID){
		
		if(formID == 'share'){
			initFBShareForm(formID);
			return;
		}
		
		overlayForm = $('#' + formID);
		
		initErrorsOverlay(overlayForm.parents('.js-overlay-content:first'));
		
		initValLabels(overlayForm);
		
		overlayForm.submit(function(){
			var frm = $(this);
			
			if(frm.hasClass('preventSubmit'))
				return false;
			
			var frmWrapper = frm.parents('.js-overlay-content:first');
			$.ajax({
					url: frm.attr('action'),
					data: frm.serialize(),
					type: frm.attr('method'),
					success: function(HTML){
							frmWrapper.parent().find('.js-hide-on-load').css('display', 'none');
							frmWrapper.html(HTML);
							
							var overlayForm = frmWrapper.find('form');
							if(overlayForm.size() > 0){
								initOverlayForm(overlayForm.attr('id'));
							}
							
							initShareLinks(frmWrapper);
							initLytics(frmWrapper);
						}
			 });
			
			frm.remove();
			frmWrapper.html('<div class="overlay-content"><div class="loading">processing request...</div></div>');
			frmWrapper.parent().find('.js-hide-on-load').css('display', 'block');
			return false;
		})
	}
}

function initFBShareForm(formID){
	if(formID){
		overlayForm = $('#' + formID);
		initValLabels(overlayForm);
		
		overlayForm.submit(function(){
			var frm = $(this);
			
			checkFacebookLogin(function(fbData){
				if(fbData != null){
					
					for(var i in fbData){
						if(overlayForm.find('input[name=' + i + ']').size() == 0){
							overlayForm.append('<input type="hidden" name="' + i + '" value="' + fbData[i] + '" />');
						}
					}
					
					var frmWrapper = frm.parents('.js-overlay-content:first');
					$.ajax({
							url: frm.attr('action'),
							data: frm.serialize(),
							type: frm.attr('method'),
							success: function(HTML){
									frmWrapper.parent().find('.js-hide-on-load').css('display', 'none');
									frmWrapper.html(HTML);
									
									var overlayForm = frmWrapper.find('form');
									if(overlayForm.size() > 0){
										initOverlayForm(overlayForm.attr('id'));
									}
									
									initShareLinks(frmWrapper);
									initLytics(frmWrapper);
								}
					 });
					
					frm.remove();
					frmWrapper.html('<div class="overlay-content"><div class="loading">processing request...</div></div>');
					frmWrapper.parent().find('.js-hide-on-load').css('display', 'block');
				}
			}, {scope: 'publish_stream'});
			
			
			return false;
		})
	}
}

function initSignUpForm(){
	var frmWrapper = $('#SignUpWrapper');
	if(frmWrapper.size() > 0){
		var regFrm = frmWrapper.find('form');
		
	        initValLabels(regFrm);
	
		var msgWrapper = frmWrapper.find('.frm-message');
	
		if(msgWrapper.size() == 0){
			msgWrapper = $('<div></div>');
			msgWrapper
				.attr('class', 'frm-message')
				.css('display', 'none')
				.prependTo(frmWrapper);
		}
	
		regFrm.submit(function(){
			var frm = $(this);
	
			msgWrapper.empty();
	
			frmWrapper.css('height', frmWrapper.height() + 'px');
	
			frm.css('visibility', 'hidden');
	
			//frmWrapper.append('<div class="loading">loading...</div>');
	
			$.ajax({
			   url: frm.attr('action'),
			   type: frm.attr('method'),
			   data: frm.serialize(),
			   success: function(HTML){
	
					msgWrapper.html(HTML);
	
					if(msgWrapper.find('.notice_error, .notice-error').size() > 0){
						msgWrapper.css('display', 'block');
						frm.css('visibility', 'visible');
						initErrorsOverlay(frmWrapper, 400);
					}
					else if(msgWrapper.find('.notice_success, .notice-success').size() > 0){
						msgWrapper.css('display', 'block');
						frm.css('visibility', 'hidden');
					}
	
					//frmWrapper.find('.loading').remove();
					frmWrapper.css('height', 'auto');
					
					initValLabels(frmWrapper);
				   }
			});
	
			return false;
	
		})
	}
}


function initValLabels(wrapper){
	if(!wrapper)
		var wrapper = $('body');

	var valLabelFields = wrapper.find('input.js-has-val-label, textarea.js-has-val-label');
	valLabelFields.each(function(){
		var field = $(this);
		if($.trim(field.val()) == ''){
			field.val(field.attr('title')).addClass('default');
		}
	});

	valLabelFields.focus(function(){
		var field = $(this);
		if($.trim(field.val()) == field.attr('title')){
			field.val('').removeClass('default');
		}
	});

	valLabelFields.blur(function(){
		var field = $(this);
		if($.trim(field.val()) == ''){
			field.val(field.attr('title')).addClass('default');
		}
	});

	valLabelFields.parents('form:first')
		.submit(function(){
			clearValLabels($(this));
		})
}

function clearValLabels(wrapper){
	if(!wrapper)
		var wrapper = $('body');

	wrapper.find('input.js-has-val-label, textarea.js-has-val-label')
		.each(function(){
			var field = $(this);
			if($.trim(field.val()) == field.attr('title')){
				field.val('').addClass('default');
			}
		});
}

var profileUrlRedirectWhenReady = '';
function redirectProfileReady() {
	d = new Date();
	window.location.href = profileUrlRedirectWhenReady;
}

function checkProfileReady() {

	d = new Date();
	 $.ajax({
		url: ciBaseUrl + 'ready/' + d.getTime(),
		cache: false,
		type: 'GET',
		success: function(JSON){
			var resp = eval('(' + JSON + ')');
				if (resp.curr == 'Done') {
					$.ajax({url: profileImageUrl, success: function(data){
						window.location.href = profileUrlRedirectWhenReady;					
					}});

					
				} else {
					setTimeout("checkProfileReady()",2000);
				}
			}
		
		});

}

function waitUntilProfileReady() {

	d = new Date();

	var lnk = $('#lnk-wait-overlay');
	var target = $(lnk.attr('rel'));
	target.find('.js-overlay-content').html('<img src="' + ciBaseUrl + 'assets/common/img/PleaseWait_Animation_lc_loop.gif?id=cb' + d.getTime() + '" />');


	var wrapper = $('body');	
	var leftOffset = 0;		
	var topOffset = 0;
	
	var frm = $('div.photos');
	target.css({
				left: (Math.round(frm.offset().left) + Math.round(frm.width()/2) + leftOffset) + 'px',
				top: (Math.round(frm.offset().top) + Math.round(frm.height()/2) + topOffset) + 'px'
			  });
	
		
	target.css('margin-top', (440/2) + 'px')
	target.css('margin-left', '145px')

	

	lnk.overlay({
			api: true, 
			close: '.js-btn-close', 
			fixed: false, 
			oneInstance: false, 
			closeOnClick: false,
			closeOnEsc: false,
			mask: {color: '#FFF', loadSpeed: 10, opacity: 0.8},
			onClose:  function(){}					    
			}).load();


	setTimeout("checkProfileReady()",500);

	

}

function initAJAXPagination(){
	var contentWrapper = $('#main-content');
	
	var mainContentForm = contentWrapper.find('#FiltersForm');
	
	if(mainContentForm.size() > 0){
		// update navigation type param so the pages load in ajax mode (no header, no footer)
		mainContentForm.find('input[name=isIncluded]').val(1);
		
		var nextPageTrigger = mainContentForm.find('input.btn-submit');
		var prevPageTrigger = mainContentForm.find('a.btn-back');
		
		var sidebar = contentWrapper.find('.sidebar');
		var sidebarWrapper = $('#sidebar-wrapper');
		
		var content = contentWrapper.find('.content');
		var contentWrapper = $('#content-wrapper');
		var contentAnimationWrapper = $('#content-animation-wrapper');
		
		if(contentAnimationWrapper.size() == 0){ // create a dynamic animation wrapper for the content if not already created		
			var contentAnimationWrapper = $('<div></div>');
			contentAnimationWrapper.attr('id', 'content-animation-wrapper');
			
			content.wrap(contentAnimationWrapper);
		}
		
		mainContentForm // set the form ('next') to submit by ajax
			.submit(function(){
					 var frm = $(this);
					 $.ajax({
						url: frm.attr('action'),
						type: frm.attr('method'),
						data: frm.serialize(),
						success: function(HTML){
								var tmpWrapper = $('<div></div>'); // create a temp hidden wrapper for parsing the ajax response
								tmpWrapper.css('display', 'none').appendTo('body');
								
								tmpWrapper.html(HTML);
								
								var redirectURL = tmpWrapper.find('input[name=RedirectURL]'); // if redirect field encountered, redirect to page (from photos to profile)
								if(redirectURL.size() > 0){
									profileUrlRedirectWhenReady = redirectURL.val();
									waitUntilProfileReady();
									return;
								}


								var asyncUrl = tmpWrapper.find('input[name=AsyncUrl]'); // if async url is present call it
								if(asyncUrl.size() > 0){
									$.ajax({url: asyncUrl.val(), success: function(data){}});
									
								}


								
								var newContent = tmpWrapper.find('.content');
								var newSidebar = tmpWrapper.find('.sidebar');
								var newForm = tmpWrapper.find('#FiltersForm');
								
								content.css('float', 'left');
								newContent.css('float', 'left');
								
								if(newForm.attr('class') != frm.attr('class')){ // different page returned
								
									lytic(frm.attr('lytic'));
									
									content.find('.steps').css('visibility', 'hidden'); // hide current page steps
									tmpWrapper.find('.steps, input.btn-next, a.btn-back').css('visibility', 'hidden'); // hide new page steps and page nav
									
									$('#content-animation-wrapper').css('width', 2*content.outerWidth() + 'px').append(tmpWrapper.find('.content')); // resize animation wrapper so two content areas fit next to each other
									content.animate( 
												{'margin-left': '-' + content.outerWidth() + 'px'}, // move old content to the left (and slide in the new one )
												'slow',
												function(){ // animation ended
													$(this).remove(); // remove old content
													$('#content-animation-wrapper').find('.steps, input.btn-next, a.btn-back').css('visibility', 'visible'); // redisplay steps and page nav
													
													$('#content-animation-wrapper')
														.css('width', content.outerWidth() + 'px')
														
													initAJAXPagination(); // init pagination for the new content
													initErrorsOverlay($('#main-content'));
													initPage($('#main-content')); // init new page events (other than pagination)
												}
											);
									
									tmpWrapper.find('.sidebar').css('display', 'none');
									$('#sidebar-wrapper').append(tmpWrapper.find('.sidebar')); // add new sidebar (hidden)
									sidebar.fadeOut('slow', // hide old sidebar
												function(){// animation ended
													sidebar.remove(); // remove old sidebar
													$('#sidebar-wrapper .sidebar').fadeIn('slow'); // fade in new sidebar
												}
											);
									
								}else{ // page returned is same as the current one, error mode

									lytic(frm.attr('lytic')+"-TryAgain");

									$('#main-content .content').html(tmpWrapper.find('.content').html()); // replace old content with new one
									initAJAXPagination(); // init pagination for the new content
									initErrorsOverlay($('#main-content'));
									initPage($('#main-content'));// init new page events (other than pagination)
								}
								
								tmpWrapper.remove(); // remove temp wrapper
							}
					})
					 
					 return false;
				});
			
		prevPageTrigger.click(function(){
			var lnk = $(this);
			if(!isAjaxLink(lnk))
				return true;
				
			var frm = mainContentForm;
			$.ajax({
				url: lnk.attr('href'),
				success: function(HTML){
								var tmpWrapper = $('<div></div>'); // create a temp hidden wrapper for parsing the ajax response
								tmpWrapper.css('display', 'none').appendTo('body');
								
								tmpWrapper.html(HTML);
								
								var redirectURL = tmpWrapper.find('input[name=RedirectURL]'); // if redirect field encountered, redirect to page
								if(redirectURL.size() > 0){
									location = redirectURL.val();
									return;
								}
								
								var newContent = tmpWrapper.find('.content');
								var newSidebar = tmpWrapper.find('.sidebar');
								var newForm = tmpWrapper.find('#FiltersForm');
								
								content.css('float', 'right');
								newContent.css('float', 'right');								
								
								if(newForm.attr('class') != frm.attr('class')){ // different page returned

									lytic(frm.attr('lytic')+"-Back");

									content.find('.steps').css('visibility', 'hidden'); // hide current page steps
									tmpWrapper.find('.steps, input.btn-next, a.btn-back').css('visibility', 'hidden'); // hide new page steps and page nav
									
									$('#content-animation-wrapper').css('width', 2*content.outerWidth() + 'px').css('margin-left', '-' + content.outerWidth() + 'px').append(tmpWrapper.find('.content')); // resize animation wrapper so two content areas fit next to each other
									content.animate( 
												{'margin-right': '-' + content.outerWidth() + 'px'}, // move old content to the left (and slide in the new one )
												'slow',
												function(){ // animation ended
													$(this).remove(); // remove old content
													$('#content-animation-wrapper').find('.steps, input.btn-next, a.btn-back').css('visibility', 'visible'); // redisplay steps and page nav
													$('#content-animation-wrapper')
														.css('width', newContent.outerWidth() + 'px')
														.css('margin-left', 0)
													
													initAJAXPagination(); // init pagination for the new content
													initPage($('#main-content')); // init new page events (other than pagination)
												}
											);
									
									tmpWrapper.find('.sidebar').css('display', 'none');
									$('#sidebar-wrapper').append(tmpWrapper.find('.sidebar')); // add new sidebar (hidden)
									sidebar.fadeOut('slow', // hide old sidebar
												function(){// animation ended
													sidebar.remove(); // remove old sidebar
													$('#sidebar-wrapper .sidebar').fadeIn('slow'); // fade in new sidebar
												}
											);
									
								}else{ // page returned is same as the current one, error mode

									lytic(frm.attr('lytic')+"-TryAgain");

									$('#main-content .content').html(tmpWrapper.find('.content').html()); // replace old content with new one
									initAJAXPagination(); // init pagination for the new content
									initPage($('#main-content'));// init new page events (other than pagination)
								}
								
								tmpWrapper.remove(); // remove temp wrapper
					}
				});
			return false;
		})
	}
}

function initAudioPlayers() {
	if (birthdayUrl != '') {
		$("#jquery_jplayer_1").jPlayer({
			ready: function (event) {
				$(this).jPlayer("setMedia", { m4a:birthdayUrl });
			},
			swfPath: ciBaseUrl + "assets/common/jQuery.jPlayer.2.1.0",
			supplied: "m4a",
			wmode: "window"
		});
	}

	if (anniversaryUrl != '') {
		$("#jquery_jplayer_2").jPlayer({
			ready: function (event) {
				$(this).jPlayer("setMedia", { m4a:anniversaryUrl });
			},
			swfPath: ciBaseUrl + "assets/common/jQuery.jPlayer.2.1.0",
			supplied: "m4a",
			wmode: "window",
			cssSelectorAncestor: "#jp_container_2"
		});
	}
}

function initAsync() {
	if (asyncUrl != '') {
		$.ajax({url: asyncUrl, success: function(data){}});
	}
}

function isAjaxLink(lnk){
	var lnkUrl = lnk.attr('href');
	return (lnkUrl.search('ajax') != -1)
}

document.write('<style type="text/css" rel="stylesheet" id="errors-stylesheet">.notice_error, .notice-error{display: none} #errors-overlay .notice_error, #errors-overlay .notice-error{display: block; color: #F00}</style>');

function initErrorsOverlay(wrapper, leftOffset, topOffset){
	if(!wrapper)
		var wrapper = $('body');
		
	if(!leftOffset)
		var leftOffset = 0;
		
	if(!topOffset)
		var topOffset = 0;
		
	var errorsOverlay = $('#errors-overlay');
	if(errorsOverlay.size() == 0){
		var errorsOverlay = $('<div></div>');
		errorsOverlay.attr('id', 'errors-overlay').css('display', 'none');
		
		var closeBtn = $('<a></a>');
		closeBtn.attr({
			     id: 'errorsOverlayCloseBtn',
			     title: 'close'
		}).text('close');
		
		closeBtn.appendTo(errorsOverlay).click(function(){
				$('#errors-overlay').css('display', 'none');
				return false;
			});
			
		errorsOverlay.appendTo($('body'));
	}
	
	var frm = wrapper.find('form');
	if(frm.size() > 0){
		//frm.css('position', 'relative');
		errorsOverlay.css({
					left: (frm.offset().left + frm.width()/2 + leftOffset) + 'px',
					top: (frm.offset().top + frm.height()/2 + topOffset) + 'px'
				  });
	}else{
		errorsOverlay.css({
					left: (wrapper.offset().left + wrapper.width()/2 + leftOffset) + 'px',
					top: (wrapper.offset().top + wrapper.height()/2 + topOffset) + 'px'
				  });
	}
	
	errorsOverlay.find('.notice_error, .notice-error').remove();
	var noticeErrors = wrapper.find('.notice_error, .notice-error');
	
	if(noticeErrors.size() > 0){
		noticeErrors.appendTo(errorsOverlay);
		
		errorsOverlay.css('display', 'block');
		errorsOverlay.css('margin-top', -errorsOverlay.outerHeight()/2 + 'px')
		errorsOverlay.css('margin-left', -errorsOverlay.outerWidth()/2 + 'px')
	}
}

function initFBShareLinks(wrapper){
	if(wrapper == null)
		var wrapper = $('body');
		
	wrapper.find('a.fb-share, a.js-fb-share')
		.click(function(){
			var shareLink = $(this);
			var data = eval('(' + shareLink.attr('data') + ')');
			try{
				FB.ui(data,
				   function(response) {
					 if (response && response.post_id) {
						 if(shareLink.attr('track')){
							 trackThis(shareLink.attr('track').replace('FB', 'FB-Published'));
						}
						    // post was published
					 } else {
						 if(shareLink.attr('track')){
							 trackThis(shareLink.attr('track').replace('FB', 'FB-Cancelled'));
						}
						   // post was not published
					 }
				   } );
			}catch(err){}
				
				
			return false;
		})
}

function initTWShareLinks(wrapper){	
	if(wrapper == null)
		var wrapper = $('body');
		
	wrapper.find('a.tw-share, a.js-tw-share')
		.click(function(){
					var shareLink = $(this);
					window.open(shareLink.attr('href'),'TwitterShare','toolbar=0,status=0,width=626,height=436');
					return false
				});
}

function initShareLinks(wrapper){
	if(wrapper == null)
		var wrapper = $('body');
		
	initFBShareLinks(wrapper);		
	initTWShareLinks(wrapper);
}

var pieChartLoaded = false;

function initDisplayHelpers(){
	var sidebar = $('#sidebar-wrapper');
	if(sidebar.size() > 0){
//		sidebar.css('height', $('.content').outerHeight() -37 + 'px');
	}
}

function initPage(page){
	pieChartLoaded = false;
	
	initGenderButtons();
	initPrefsSliders();
	initPhotoGallerySelect();
        initSignUpForm();
	initAJAXOverlays(page);
	initLytics(page);

	if(($('#pie-chart-container').size() > 0) && (pieChartLoaded == false)){
		console.log('pasara');
		stage = null;
		initPPChart();
	}
}

function initGenderButtons(){
	var pageFrm = $('#FiltersForm');
	if(pageFrm.size() > 0){
		if(pageFrm.hasClass('confirm-information-page')){
			var radioBtns = pageFrm.find('label.btn-radio-gender');
			
			radioBtns.click(function(){
				var btn = $(this);
				btn.parents('form:first').find('label.btn-radio-gender').removeClass('btn-radio-gender-selected');
				btn.addClass('btn-radio-gender-selected');
				btn.find('input').attr('checked', true);
			});
			
			var selection = pageFrm.find('label.btn-radio-gender input:checked');
			if(selection.size() > 0){
				selection.parents('label:first').click();
			}
		}
	}
}

function initTextOverlays(wrapper){
	if(!wrapper)
		var wrapper = $('body');
	
	
	var triggers = wrapper.find('a.js-text-overlay');
	if(triggers.size() > 0){
		triggers.attr('rel', '#ajax-text-overlay');
		
		var ajaxOverlay = $('#ajax-text-overlay');
		if(ajaxOverlay.size() == 0){
			ajaxOverlay = $('<div></div>');
			ajaxOverlay
				.attr({
				      	'class': 'ajax-text-overlay',
					'id': 'ajax-text-overlay'
				      })
				.css('display', 'none')
				.html('<div class="top-cap"></div><div class="overlay-content js-overlay-content"></div><div class="bottom-cap-box"></div><a title="Close" class="btn-close js-btn-close">[x] close</a>')
				.appendTo('body');
		}
		
		triggers.click(function(){
					
				var lnk = $(this);
				var target = $(lnk.attr('rel'));
				target.find('.js-overlay-content').html('<div class="loading">processing request...</div>');
				lnk.overlay({
					    api: true, 
					    close: '.js-btn-close', 
					    fixed: false, 
					    oneInstance: false, 
					    mask: {color: '#000', loadSpeed: 10, opacity: 0.29},
					    onClose:  function(){
								var overlay = $(this.getOverlay());
								overlay.css({
									'width': '',
									'marginLeft': 0
								})
							}
					    
					    }).load();
				
				$.ajax({
						url: lnk.attr('href'),
						success: function(HTMLResponse)
							{	
								var overlayContent = target.find('.js-overlay-content'); // append new content to popup
								overlayContent.html(HTMLResponse); // append new content to popup
								initScrollableContent(overlayContent);
							initLytics(overlayContent);

								lnk.overlay({
									    	target: target, 
										api: true, 
										close: '.js-btn-close', 
										fixed: false, 
										oneInstance: false
									}).load(); // re-display overlay
							},
						error: function(err)
							{
								
							}
					});
				return false;
		})
	}
	
}

function initScrollableContent(wrapper){

	if(!wrapper)
		var wrapper = $('body');
	
	var scrollableContent = wrapper.find('.js-scrollable-content');
	if(scrollableContent.data('jsp')){
		scrollableContent.data('jsp', null);
		scrollableContent.css('overflow', 'auto');
	}
	
	scrollableContent.jScrollPane({
		verticalDragMinHeight		: 10,
		verticalDragMaxHeight		: 10,
		showArrows: true
	});
	
}

var shareOverlayTimer = null;

function displayDefaultShareOverlay(){
	var shareCookie = $.cookie('share-overlay-displayed');
	if(shareCookie != '1'){
		$('a.js-lnk-overlay-share').click();
	}
}

function lytic(evt) {
	try {  _gaq.push(['_trackPageview',evt+'.html']); } catch(err){}
	$.ajax({url: ciBaseUrl + 'track/' + evt});
}


function initLytics(wrapper){
	if(!wrapper)
		var wrapper = $('body');
		
	var trigger = wrapper.find('a[lytic]');
	trigger.click(function(){
			lytic($(this).attr('lytic'))
		})
	
}



$(function(){
	//initAsync();
	initFBAuthorizeLink();
	initPage();
	initAJAXPagination();
	initDisplayHelpers();
	//initAudioPlayers();
	initTextOverlays();
	initErrorsOverlay();
	initShareLinks();
	initLytics();
	var shareOverlayTimer = setTimeout(displayDefaultShareOverlay, 12000);
})