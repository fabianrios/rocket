// @-----------------------------------------------------@
// |MGMD FORM VALIDATOR V 1.0					  _||_   |
// |MGMD LTDA 2008 TODOS LOS DERECHOS RESERVADOS |T\/T|  |
// |											 |I__I|  |
// |http://www.magdalenamedio.net				   ||    |
// @-----------------------------------------------------@

var validInst ; // VARIABLE DE INSTANCIACION DE LA CLASE

// VARIABLES GLOBALES POR DEFECTO
Validator.prototype.form           = '' ;
Validator.prototype.msgAlertType   = 1 ;
Validator.prototype.div            = '' ;
Validator.prototype.validables     = '' ;
Validator.prototype.button         = '' ;
Validator.prototype.valid          = true ;
Validator.prototype.validatorMsg   = '' ;
Validator.prototype.extra		   = true ;
Validator.prototype.defaultMessage = 'Los siguientes campos son requeridos o tienen datos invalidos:';

// CONSTRUCTOR
// RECEBE TIPOS DE ALERTA (INT, 1-2)
// RECIBE DIV (STRING, DIV ID)
function Validator(msgAlertType, div, extra)
{
	
	// INSTANCIACION DE VARIABLES GLOBALES
	this.msgAlertType  = msgAlertType ? msgAlertType : this.msgAlertType ;
	this.div           = div ? div : this.div ;
	this.validables    = new Array() ; // INSTANCIA DE ARREGLO DE CAMPOS VALIDABLES
	this.button        = document.getElementById('trigger') ;
	this.valid         = true ;
	this.validatorMsg  = '' ;
	this.extra         = extra ? extra : this.extra ;
	this.form          = this.getForm() ; // INSTANCIAMIENTO DE LA VARIABLE GLOBAL DEL FORMULARIO CON LA FUNCION LO BUSCA
	
	// VERIFICA SI HAY O NO HAY FORMULARIO
	if ( typeof this.form != "undefined" )
	{
		this.searchRequiredFields() ; // BUSCA CAMPOS REQUERIDOS
		
		this.addButtonEventHandler() ; // AGREGA EL HANDLER AL EVENTO CLICK DEL BOTON
	}
}

// BUSCA EL FORMULARIO QUE TENGA ID 'VALIDABLE' Y RETORNA EL FORMULARIO
Validator.prototype.getForm = function () {
	
									return document.getElementById('validable');
									
								 } ;
// BUSCA LOS CAMPOS REQUERIDOS
Validator.prototype.searchRequiredFields = function () {
											 
											 var count = 0 ;
											 
											 for ( i = 0 ; i < this.form.elements.length ; i++ )
											 {
												 //	SI EL NOMBRE DE LA CLASE DEL CAMPO ES 'REQUIRED', EL CAMPO ES REQUERIDO																						
												 if  ( this.form.elements[i].className != "" ) 
												 {
													// AGREGAMOS UN CAMPO VALIDABLE AL ARREGLO																							
													this.validables[count] = this.form.elements[i] ; 
													// ENVIAMOS EL CAMPO A LA FUNCION DE VERIFICACION DE HANDLERS REQUERIDOS	
													this.addNeededEventHandler(this.validables[count]) ;
													
													count++ ;
													
												 }
											 }												 
											   
										   } ;
// AGREGA EL HANDLER AL BOTON PARA EL EVENTO 'CLICK'										   
Validator.prototype.addButtonEventHandler = function () {
												this.button.onclick = function (e) {
																				return validInst.checkRequiredFields(e) ;
																				 };
											
											} ;
// VERIFICA EL VALOR Y EL ESTADO DE LOS CAMPOS REQUERIDOS LUEGO DEL EVENTO 'CLICK' DEL BOTON
Validator.prototype.checkRequiredFields = function (e) {
												var actualElement = '' ;
												this.validatorMsg = '' ;
												this.valid        = true ; // FORMULARIO VALIDO POR DEFECTO
												
												// RECORRE EL ARREGLO DE CAMPOS REQUERIDOS 
												for(field in this.validables)
												{
													actualElement   = this.validables[field] ; // DEFINE EL ELEMENTO ACTUAL
													var actualValid = true ; // CAMPO ACTUAL POR DEFECTO VALIDO
													var extra       = '' ; // VARIABLE VACIA PARA DATO EXTRA DEL CAMPO NO VALIDO
													// SWITCH POR TIPO DE CAMPO
													switch (actualElement.type){
														case 'text':
															// VERIFICAR SI EL CAMPO ESTA VACIO
															if(actualElement.value == "")
															{
																this.valid = false ; // CAMBIA EL ESTADO DEL FORMULARIO 
																					 // A INVALIDO
																
																actualValid = false ; // CAMBIA EL ESTADO DEL CAMPO ACTUAL
																					  // A INVALIDO
																
																extra = 'Campo Vacio' ; // INFORMACION EXTRA DEL CAMPO INVALIDO
																
															}
															// VERIFICAR SI EÑ CAMPO TIENE DATO EXTRA DE EMAIL
															else if(actualElement.class == "email")
															{
																// VERIFICA SI LA FUNCION VERIFICADORA DE ESTRUCTURA DE MAIL
																// RETORNA VERDADERO O FALSO
																if(!this.checkEmail(actualElement.value))
																{
																	this.valid = false ; 
																						 
																	actualValid = false ; 
																						  
																	extra = 'Formato Invalido' ;
																}
															}
														break;
														case 'select-one':
															// RECORRE CADA OPCION DEL CAMPO SELECT
															for(i=0;i<actualElement.options.length;i++)
															{	
																// ENTRA SI EL CAMPO ESTA SELECCIONADO
																if(actualElement.options[i].selected == true)
																{
																	// VERIFICA SI EL VALOR DEL CAMPO ACTUAL ES 'NULL'
																	if(actualElement.options[i].value == 'NULL')
																	{
																		this.valid = false ;
																		actualValid = false ;
																		extra = 'Opcion no Seleccionada' ;
																	}
																	break;
																}
															}
														break;
														case 'textarea':
															// VERIFICAR SI EL CAMPO ESTA VACIO
															if(actualElement.value == "")
															{
																this.valid = false ;
																actualValid = false ;
																extra = 'Campo Vacio' ;
															}
														break;
														case 'password':
															if((actualElement.className != 'confirm') && (actualElement.className != 'low'))
															{
																if(actualElement.value == "")
																{
																	this.valid = false ;
																	actualValid = false ;
																	extra = 'Campo Vacio' ;
																}
																else
																{
																	var valid = this.validatePassword(actualElement);
																	if(valid != true)
																	{
																		this.valid = false ;
																		actualValid = false ;
																		extra = valid ;																		
																	}
																}
															}
														break;
													}
													// ENTRA SI EL CAMPO ACTUAL NO ES VALIDO
													if(!actualValid)
													{
														// CONSTRUYE EL MENSAJE QUE SALE SI EL FORMULARIO NO ES VALIDO
														this.validatorMsg += '- ' + actualElement.title ;
														
														// VERIFICA SI TIENE QUE SACAR LA INFORMACION EXTRA DEL CAMPO ACTUAL
														if(this.extra)
															this.validatorMsg += ' (' + extra + ') ' ;
														
														this.validatorMsg += '{linebreak}' ;
													}
												}
												// ENTRA SI EL FORMULARIO NO ES VALIDO
												if(!this.valid) 
												{
													// TIRA LA ALERTA
													this.throwAlert() ;
													return false;
												}
												
											} ;
 // FUNCION QUE VERIFICA LA ESTRUCTURA DEL MAIL	
 Validator.prototype.checkEmail = function(elementValue) {

									var at="@"
									var dot="."
									var lat=elementValue.indexOf(at)
									var lstr=elementValue.length
									var ldot=elementValue.indexOf(dot)
									if (elementValue.indexOf(at)==-1){
									   return false
									}
									if (elementValue.indexOf(at)==-1 || elementValue.indexOf(at)==0 || elementValue.indexOf(at)==lstr){
									   return false
									}
									if (elementValue.indexOf(dot)==-1 || elementValue.indexOf(dot)==0 || elementValue.indexOf(dot)==lstr){
									   return false
									}
                                    if (elementValue.indexOf(at,(lat+1))!=-1){
									   return false
									}
									if (elementValue.substring(lat-1,lat)==dot || elementValue.substring(lat+1,lat+2)==dot){
									   return false
									}
								    if (elementValue.indexOf(dot,(lat+2))==-1){
									   return false
									}
									
									if (elementValue.indexOf(" ")!=-1){
									   return false
									}
								
									return true					
								} ;
								
// AGREGA LOS HANDLERS NECESARIOS A CAMPOS DE VERIFICACION
Validator.prototype.addNeededEventHandler = function(element) {
												// SWITCH CON EL TAG 'ALT' DEL CAMPO
												switch (element.class){
													case 'text':
														// AGREGA LA FUNCION DE VERIFICACION DE SOLO TEXTO AL EVENTO 'KEYPRESS'
														element.onkeypress = function (e) {
																				return	validInst.validateText(e) ;
																	};
	
																
													break;
													case 'number':
													    // AGREGA LA FUNCION DE VERIFICACION DE SOLO NUMEROS AL EVENTO 'KEYPRESS'
														element.onkeypress =	function (e) {
																				 return	validInst.validateNumber(e) ;
																				};
													break;
												}
											} ;
											
// VALIDA QUE EL CAMPO TENGA SOLO TEXTO
Validator.prototype.validateText = function (e) {
		
									// REVISA QUE TECLA SE PRESIONO UTILIZANDO EL EVENTO LANZADO
									var key = (e) ? e.which : window.event.keyCode;
									
									// ENTRA SI LA TECLA NO ES SOLO TEXTO
									if ((key < 65 && key != 32 && key != 46 & key != 8 & key != 0) || key > 122 || (key > 90 && key < 97)) 
											return false;

									return true;  
									} ;

// VALIDA QUE EL CAMPO TENGA SOLO NUMEROS
Validator.prototype.validateNumber = function (e) {
									
									// REVISA QUE TECLA SE PRESIONO UTILIZANDO EL EVENTO LANZADO
									var key = (e) ? e.which : window.event.keyCode;

									// ENTRA SI LA TECLA NO ES SOLO NUMEROS
									if (key > 31 && (key < 48 || key > 57))	
											return false;
	
									return true;  
									} ;

// VALIDA EL PASSWORD SEGUN PARAMETROS ESTABLECIDOS
Validator.prototype.validatePassword = function (element) { 									   
										var password = element.value;
										var confirmPassName = element.name + 'Confirm';
										var confirmPassObject = eval('this.form.'+confirmPassName);
										var len = password.length; 
										var fail = false;
										if(typeof confirmPassObject != 'undefined')
										{
											var confirmPass = confirmPassObject.value;
											if (!fail&&(password != confirmPass)) fail = 1;
										}
										if (!fail&&(len < element.alt)) fail = 2;
										last = '';
										if(element.className == 'high')
										{
											if (!fail) {
												for (i=0; i<len; i++) {
													char = password.substring(i , i+1);
													if (last == char) fail=3;
													last = char;
												}
											}
											if (!fail&&((password.search(/[A-Z]+/)==-1) || (password.search(/[0-9]+/)==-1) || (password.search(/[a-z]+/)==-1))) fail = 4;
										}
										switch (fail) 
										{
											case 1:
												return "The password don't match";
											case 2:
												return "The password must be " + element.alt + " characters at least";
											case 3:
												return "There must be no consecutive letters or numbers";
											case 4:
												return "The password must contain one upper-case letter, one lower-case letter and one number";
											default:
												return true;
											break;	
										}
									};

// FUNCION QUE TIRA LA ALERTA
Validator.prototype.throwAlert = function()
								{
									
									// INSTANCIA LA VARIABLE MENSAJE CON UN TEXTO
									var messageObject = document.getElementById('message'); 
									var msg = (typeof defaultMessageObject != 'undefined') ? defaultMessageObject.innerHTML : this.defaultMessage;
									
									// HACE UN SWITCH CON EL TIPO DE ALERTA QUE SE HAYA ESTABLECIDO (1 - HTML, 2 - ALERTA)
									switch(this.msgAlertType) 
									{
										case 1:
												// CONSTRUYE EL MENSAJE CON LOS CAMPOS INVALIDOS 
												// Y REMPLZA EL {LINEBREAK} POR \R\N
												msg += '\r\n' + this.validatorMsg.replace(/{linebreak}/g, "\r\n");					
												alert(msg) ;
										break;
										case 2:
											var target = document.getElementById(this.div);
											
											// MUESTRA EL DIV SI ESTA ESCONDIDO
											if(target.style.display == 'none')
											{
												target.style.display = '';
											}

											// CONSTRUYE EL MENSAJE CON LOS CAMPOS INVALIDOS 
											// Y REMPLZA EL {LINEBREAK} POR <BR/>	
											target.innerHTML = msg + '<br/>' + this.validatorMsg.replace(/{linebreak}/g, "<br/>");	
											
										break;
									}
								} ;
								
// FUNCION INICIADORA DEL VALIDADOR
// RECIBE EL TIPO DE ALERTA Y EL ID DEL DIV SI EL TIPO DE ALERTA ES 2
function validatorStart(msgAlertType, div, extra)
{
	// INTANCI LA CLASE CON LOS PARAMETROS ESTABLECIDOS
	
}