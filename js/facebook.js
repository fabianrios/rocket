 		    window.fbAsyncInit = function() {
                FB.init({appId: '108997815854151', status: true, cookie: true, xfbml: true});

                /* All the events registered */
                FB.Event.subscribe('auth.login', function(response) {
                    // do something with response
                    login();
                });
                FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });

                FB.getLoginStatus(function(response) {
                    if (response.session) {
                        // logged in and connected user, someone you know
                        login();
                    }
                });
            };
            (function() {
                var e = document.createElement('script');
                e.type = 'text/javascript';
                e.src = document.location.protocol +
                    '//connect.facebook.net/es_LA/all.js';
                e.async = true;
				if(document.getElementById('fb-root'))
                	document.getElementById('fb-root').appendChild(e);
            }());

            function login(){
				fqlQuery();
                FB.api('/me', function(response) {
						if(document.getElementById('user_names'))
							document.getElementById('user_names').value = response.first_name;
						if(document.getElementById('user_surnames'))
							document.getElementById('user_surnames').value = response.last_name;
						if(document.getElementById('facebook_id'))
							document.getElementById('facebook_id').value = response.id;	
						if(document.getElementById('user_state'))
							document.getElementById('user_state').value = 'A';		
						//document.getElementById('names').innerHTML = response.name;
						//document.getElementById('facebook').innerHTML = response.id;
                    //document.getElementById('login').innerHTML = response.email + response.name + " succsessfully logged in!";
                });
				setStatus();
            }
            function logout(){
                //document.getElementById('login').style.display = "none";
				//document.getElementById('idfacebook').value = "";
				//document.getElementById('userActive').value = "I";
				SimpleAJAXCall(ApplicationUrl+'connect.controller/facebookDesConnect.html', ElementStateChanged, 'GET', 'connection');
				setStatus();
            }

            //stream publish method
            /*function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
                FB.ui(
                {
                    method: 'stream.publish',
                    message: '',
                    attachment: {
                        name: name,
                        caption: '',
                        description: (description),
                        href: hrefLink
                    },
                    action_links: [
                        { text: hrefTitle, href: hrefLink }
                    ],
                    user_prompt_message: userPrompt
                },
                function(response) {

                });

            }
            function showStream(){
                FB.api('/me', function(response) {
                    //console.log(response.id);
                    streamPublish(response.name, 'Thinkdiff.net contains geeky stuff', 'hrefTitle', 'http://thinkdiff.net', "Share thinkdiff.net");
                });
            }*/

            function share(){
                var share = {
                    method: 'stream.share',
                    u: 'http://thinkdiff.net/'
                };

                FB.ui(share, function(response) { console.log(response); });
            }

            /*function graphStreamPublish(){
                var body = 'Reading New Graph api & Javascript Base FBConnect Tutorial';
                FB.api('/me/feed', 'post', { message: body }, function(response) {
                    if (!response || response.error) {
                        alert('Error occured');
                    } else {
                        alert('Post ID: ' + response.id);
                    }
                });
            }*/

            function fqlQuery(){
				FB.api('/me', function(response) {
                     var query = FB.Data.query('select first_name,middle_name,last_name,pic_big,email from user where uid={0}', response.id);
					var images = '';
					query.wait(function(rows) {
						if(rows[0].pic_big == null)
						{
							images = '';
						}
						else
						{
							images = rows[0].pic_big;
						}
						//alert(images);
	 					images = images.replace(/\//gi,'|');
						SimpleAJAXCall(ApplicationUrl+'connect.controller/facebookConnect/'+rows[0].first_name+'/'+response.id+'/'+ images +'/'+response.email+'/'+rows[0].last_name+'/'+rows[0].middle_name+'.html', ElementStateChanged, 'GET', 'connection');
					});
                });
            }

            function setStatus(){
                FB.api(
                  {
                    method: 'status.set'
                    //status: 'status.get'
                  },
                  function(response) {
					if(response == true)
					{
						if(document.getElementById('facebookIdConnect'))
							document.getElementById('facebookIdConnect').checked=true;
						//alert('CONECTADO');
						//location.reload();
					}
					else
					{
						if (response.request_args[5].value == 0)
						{
							if(document.getElementById('facebookIdConnect'))
								document.getElementById('facebookIdConnect').checked=true;
						}
						else{
							//alert('Your facebook status updated');
							/*var objets = '';
							alert(response);
							 for (var x in response.request_args) {
								   objets += x + ' ->>> ';
							   }
							  // error_code ->>> error_msg ->>> request_args ->>> */
							// alert('NO CONECTADO') ;
							SimpleAJAXCall(ApplicationUrl+'connect.controller/facebookDesConnect.html', ElementStateChanged, 'GET', 'connection');
							if(document.getElementById('facebookIdConnect'))
								document.getElementById('facebookIdConnect').checked=false;
							//location.reload();
						}
					}
                  }
                );
            }
			
	