﻿function CreatePopUp(d,c,b){if(b=="undefined"){b=0}var a;a="<div style=\"width:15px; height:15px; cursor:pointer; margin-left:245px; margin-top:15px;\" onclick=\"$('.popup_cart').css('visibility','hidden')\"></div>";a+="<h4 >Item added to your shopping cart</h4>";if(d=="1"){a+="<p>You have <b> "+d+" item </b> in your shopping cart</p>"}else{a+="<p>You have <b> "+d+" items </b> in your shopping cart</p>"}a+="<p><strong>Total cost: "+c+"</strong></p>";a+='<div style="padding-left:5px; margin-top:10px;">';a+='<a href="'+RootPath+'/shoppingcart.aspx"><img src="'+RootPath+'/images/buttons/button-cart.gif" border="0" height="20px" width="74px" alt="Checkout"/></a> ';a+='<img src="'+RootPath+'/images/buttons/button-continue-shopping.gif" onclick="$(\'.popup_cart\').css(\'visibility\',\'hidden\')"  align="top" causesvalidation="false"/></div>';return a}function ClosePopUp(a){if(a==0){document.getElementById("divCartPopup").style.visibility="hidden"}else{document.getElementById("divCartPopup"+a).style.visibility="hidden"}};