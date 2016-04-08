
function send_data()
{	
	
	$.ajax({
   	type: "POST",
   	data: {},
   	url: "../resources/fetch_actor_profile.php",
   	success: function(res){
     //console.log(res);
     var json = JSON.parse(res);
     //console.log(json);
     if(json==null)
     {
        show_add_actor();
     }
     else
     {
      populate_profile(res);
     }  
     
   }
});
}

function populate_profile(res)
{	
	var json = JSON.parse(res);
	var actor_data=json;
  console.log(json);
	var div = document.getElementById('browse-table');
  div.innerHTML="";
  var i=0;
  console.log(json[i].actor_name);
	var content="";
  content+='<div class="container col-sm-8 center marginTop"><center><font class="info firstcolor">Hello '+json[i].actor_name +'! </font><br><font class="info-small gray">Welcome to Stage<b>Shastra</b>! Below are your profile details.You can edit them anytime you like.</font></center></div><table class="table table-curved display" id="actor_table"><tr id="datarow">' 
                        +'<td style="vertical-align:middle-top;">'
                          +      '<div class="img-div center">'
              +     '<img src="'+json[i].actor_profile_photo+'" data-toggle="collapse" data-target="#collapse'+i+'" />'
              +    '</div>'
                          + '</td>' 
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i].actor_name+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i].actor_email+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i].actor_age+' years</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i].actor_contact_number+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +     '<span class="info gray scrolr">'+json[i].actor_skills+'</span><font class="sortbuttons"><button  class="btn submit-btn firstcolor contact-btn disabled" disabled><span class="glyphicon glyphicon-edit"></span></button>'
                          +'</td></tr></table>';
	content+='<div class="col-sm-12">'
                       +' <div class="row">'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Name :'+ json[i].actor_name +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Email : '+ json[i].actor_email +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Sex: '+ json[i].actor_sex +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">DOB :'+ json[i].actor_dob +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Phone : '+ json[i].actor_contact_number +'</font>'
                       +'             </div>';
                        var ac, pp;
                       if(json[i].actor_card==1){ ac="Yes";}else{ ac="No";}
                       if(json[i].actor_passport==1){ pp="Yes";}else{ pp="No";}
                        content+='             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Actor\'s Card :'+ac
                       +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <div class="col-sm-6 " style="padding-left:0px">'
                       +'                     <font class="info-medium gray">Height : '+ json[i].actor_height +'cms</font>'
                       +'                 </div>'
                       +'                <div class="col-sm-6">'
                       +'                    <font class="info-medium gray">Weight :'+ json[i].actor_weight +'kgs</font>'
                       +'                 </div>'
                       +'             </div>'
                       +'             <div class="col-sm-4 scrolr">'
                       +'                 <font class="info-medium gray">Experience :'+ json[i].actor_experience +'</font>'
                       +'             </div>'
                       +'            <div class="col-sm-4 scrolr">'
                       +'                 <font class="info-medium gray">Passport : '+  pp +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Range : '+ json[i].actor_range+' years</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium gray">Training : '+ json[i].actor_training+'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row">'
                       +'             <div class="DocumentList">'
                       +'                 <ul class="list-inline">';

                       for(var k=0;k<json[i].actor_images;k++)
                       {
                        var str = json[i].actor_profile_photo;
                        var arr = str.split(".");
                        var ext = arr[2];
                        str1 = arr[0];
                        str2 = arr[1];
                        str2 = str2.substring(0, str2.length - 1);
                        str=str1+'.'+str2;
                                                            str+=k+'.'+ext;
                        //console.log(str);
                        content+='<li class="DocumentItem">'
                       +'<a href="'+str+'" data-lightbox="'+json[i].actor_name+'"><img src='+str+' height="100%" width=auto></img></a>' 
                       +'         </li>';
                      }
                        content+='                 </ul>'
                       +'             </div>'
                       +'         </div>'
                       +'     </div>'
                       +'</div> ';
                       div.innerHTML=content;
                        $("img").error(function () { 
                          $(this).hide();
                        });

}

function show_spinner()
{
  var div = document.getElementById('browse-table');
  content='</img><div class="showwelcome"><center><img src="img/logo.png" class="rotate-img center" width="80px" height="80px"/><br><font class="info gray">Crunching the latest data for you!</div>';
  div.innerHTML = content; 
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function checkCookie(cookie) {
    var flag=getCookie(cookie);
    if (flag=="") {
        return 0;

    }else{
        return 1;
        }
    }

send_data();