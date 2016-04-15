var sa_params='';
function contact(){
var sa_frm=document.sa_htmlform;
for(i=0; i<sa_frm.elements.length; i++){
var sa_el=sa_frm.elements[i];if(sa_frm.elements[i].name){sa_params+='&'+sa_frm.elements[i].name+'='+encodeURIComponent(sa_frm.elements[i].value);}
if(!sa_el.value && sa_el.getAttribute('required')=='true'){alert('Please complete all required fields');sa_el.focus();return false;}
}
var s = document.createElement('script');
s.setAttribute('type','text/javascript');
s.setAttribute('src','');
document.body.appendChild(s);
return false;
}
function contact(){
if(typeof sa_sent_text=='undefined'){sa_sent_text='Thank you for contacting us. We will get back to you soon.';}
document.getElementById('sa_contactdiv').innerHTML=sa_sent_text+'<br><br>Contact Form provided by SmartAddon.com';
}