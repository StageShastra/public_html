var actor_data;
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
	actor_data=json;
  //console.log(json);
	var div = document.getElementById('browse-table');
  div.innerHTML="";
  var i=0;
 // console.log(json[i].actor_name);
	var content="";
  content+='<table class="table table-curved display" id="actor_table"><tr id="datarow">' 
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
                          +     '<span class="info gray scrolr">'+json[i].actor_skills+'</span>'
                          +'<font class="sortbuttons"><button  class="btn submit-btn firstcolor contact-btn" onclick="populate_edit_form()" data-target="#editprofile" data-toggle="modal">'
                          +'<span class="glyphicon glyphicon-pencil"></span><span class="info-small"></span></button>'
                          +'</td></tr></table>';
	content+='<div class="col-sm-12">'
                       +' <div class="row">'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Name :<span class="gray">'+ json[i].actor_name +'</span></font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor ">Email : <span class="gray">'+ json[i].actor_email +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Sex: <span class="gray">'+ json[i].actor_sex +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">DOB :<span class="gray">'+ json[i].actor_dob +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Phone : <span class="gray">'+ json[i].actor_contact_number +'</font>'
                       +'             </div>';
                        var ac, pp;
                       if(json[i].actor_card==1){ ac="Yes";}else{ ac="No";}
                       if(json[i].actor_passport==1){ pp="Yes";}else{ pp="No";}
                        content+='             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Actor\'s Card :<span class="gray">'+ac
                       +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <div class="col-sm-6 " style="padding-left:0px">'
                       +'                     <font class="info-medium firstcolor">Height : <span class="gray">'+ json[i].actor_height +'cms</font>'
                       +'                 </div>'
                       +'                <div class="col-sm-6">'
                       +'                    <font class="info-medium firstcolor">Weight :<span class="gray">'+ json[i].actor_weight +'kgs</font>'
                       +'                 </div>'
                       +'             </div>'
                       +'             <div class="col-sm-4 scrolr">'
                       +'                 <font class="info-medium firstcolor">Experience :<span class="gray">'+ json[i].actor_experience +'</font>'
                       +'             </div>'
                       +'            <div class="col-sm-4 scrolr">'
                       +'                 <font class="info-medium firstcolor">Passport : <span class="gray">'+  pp +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Range : <span class="gray">'+ json[i].actor_range+' years</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Training : <span class="gray">'+ json[i].actor_training+'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row" style="padding-right:15px;">'
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
                       +'<a href="'+str+'" data-lightbox="'+json[i].actor_name+'"><img class="photo"src='+str+' height="100%" width=auto></img></a>' 
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
function populate_edit_form()
{
  var i=0;
  $("#name").val(actor_data[i].actor_name);
  $("#phone").val(actor_data[i].actor_contact_number);
  $("#language").val(actor_data[i].actor_language);
  $("#email").val(actor_data[i].actor_email);
  $("#whatsapp").val(actor_data[i].actor_whatsapp_number);
  $("#weight").val(actor_data[i].actor_weight);
  $("#height").val(actor_data[i].actor_height);
  $("#dob").val(actor_data[i].actor_dob);
  $("#sex").val(actor_data[i].actor_sex);
  $("#password").val(actor_data[i].actor_password);
  $("#experience").val(actor_data[i].actor_experience);
  $("#agemin").val(actor_data[i].actor_age_range_min);
  $("#agemax").val(actor_data[i].actor_age_range_max);
  $("#training").val(actor_data[i].actor_training);
  if(actor_data[i].actor_passport==1)
  {
    $('#passport').attr('checked', true); // Checks it
  }
  if(actor_data[i].actor_card==1)
  {
    $('#actorcard').attr('checked', true); // Checks it
  }
  calculateAge();
  
}
function updateactor()
{
   calculateAge();
   var formData={};
   formData.name=$("#name").val();
   formData.email=$("#email").val();
   formData.password=$("#password").val();
   formData.dob= $("#dob").val();
   formData.weight=$("#weight").val();
   formData.height=$("#height").val();
   formData.phone=$("#phone").val();
   formData.whatsapp=$("#whatsapp").val();
   formData.age=$("#age").val();
   formData.sex=$("#sex").val();
   formData.experience=$('#experience').val();
   formData.training=$('#training').val();
   formData.agemin=$('#agemin').val();
   formData.agemax=$('#agemax').val();
   formData.language=$('#language').val();
   formData.directorid=$('#director').val();
   formData.skills=$('#skills').val();
   var actorcard,passport;
   if($('#passport').is(":checked"))
       {
          passport=1;
       }
       var actorcard=0; 
       if($('#actorcard').is(":checked"))
       {
          actorcard=1;
       }
   formData.passport=passport;
   formData.actorcard=actorcard;
   console.log(formData);
   $.ajax({
    type: "POST",
    data: formData,
    url: "../resources/update_actor_profile.php",
    success: function(res){
    console.log(res);
     //var json = JSON.parse(res);
     //console.log(json);
     if(res!='401')
     {
        $("#successful").removeClass("hidden");
     }
     else
     {
       $("#unsuccessful").removeClass("hidden");
     }  
     
   }
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
$("input").tooltip({
 
      // place tooltip on the right edge
      position: "right",
 
      // a little tweaking of the position
      offset: [0, 0],
 
      // use the built-in fadeIn/fadeOut effect
      effect: "none",
 
      // custom opacity setting
      opacity: 0.7
 
      });
send_data();
function calculateAge() { // birthday is a date
    var dob = $("#dob").val();
    var Bday = +new Date(dob);
    var ageDifMs = Date.now() - Bday;
    //console.log(dob + "and " + ageDifMs);
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    $("#age").val(Math.abs(ageDate.getUTCFullYear() - 1970));

}