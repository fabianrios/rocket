function getFormValues(fobj,valFunc) 
{ 
   var str = ""; 
   var valueArr = null; 
   var val = ""; 
   var cmd = ""; 
   for(var i = 0;i < fobj.elements.length;i++) 
   { 
       switch(fobj.elements[i].type) 
       {   
	       case "hidden":
		                str += fobj.elements[i].name + 
                 "=" + escape(fobj.elements[i].value) + "&"; 
		        break;
		   case "textarea":
		                str += fobj.elements[i].name + 
                 "=" + escape(fobj.elements[i].value) + "&"; 
		        break;
           case "text": 
                /*if(valFunc) 
                { 
                    //use single quotes for argument so that the value of 
                    //fobj.elements[i].value is treated as a string not a literal 
                    cmd = valFunc + "(" + 'fobj.elements[i].value' + ")"; 
                    val = eval(cmd) 
                }*/
                str += fobj.elements[i].name + 
                 "=" + fobj.elements[i].value + "&"; 
                 break; 
           case "select-one": 
                str += fobj.elements[i].name + 
                "=" + fobj.elements[i].options[fobj.elements[i].selectedIndex].value + "&"; 
                break; 
		   case "password":
                str += fobj.elements[i].name + 
                 "=" + escape(fobj.elements[i].value) + "&"; 
				 break;
		   case "checkbox":
		   		if(fobj.elements[i].checked == true) {
					str += fobj.elements[i].name + 
                 	
					"=" + 1 + "&";
				}
				 break;
		   case "radio":
		   		if(fobj.elements[i].checked == true) {
					str += fobj.elements[i].name + 
                 	
					"=" + fobj.elements[i].value + "&";
				}
				 break;
} 
   } 
   str = str.substr(0,(str.length - 1)); 
   return str; 
}