var select=[];
var actors_selected=[];
var actor_phonelist=[];
var actor_data;
var count=0;
var sendsms=0;
$("#success_send").hide();
$("#failure_send").hide();  
$('#contactmodal').modal('hide');
//This function populates the table which lets the user to choose categories.
function populate_cat_table()
{
	var list=['Name','Age','Training','Facial-Attribute','Height','Sex','Physical-Attribute','Weight','Projects','Range','Skills','Auditions','Experience','Language','Education'];
	var counter=0;
	var rows=list.length/3;
	var div = document.getElementById('categories');
	var content="";
	div.innerHTML = div.innerHTML +  '<font class="info gray left padded left-align">Please select your categories that you would like to browse through.</font><font class="info-small gray"><i>(Any 5)</i></font>';
	for(i=0;i<list.length;i++)
	{
		if(counter%3==0)
		{	
			if(counter!=0)
			{
				content += '</div><div class="row">';	
			}
			else
			{
				content += '<div class="row">';	
			}
			 
		}
		content+='<div class="col-sm-4 vertical-padded"><button type="button" class="btn taga" aria-label="Left Align" id="'+list[i]+'" onclick=add_to_categories("'+list[i]+'")><font class="taga-text">'+list[i]+'</font><span class="glyphicon glyphicon-remove pull-right hidden no-top" aria-hidden="true" id="'+list[i]+'-remove" onclick=removes("'+list[i]+'")></span></button></div>';
        
        counter++;

	}
	div.innerHTML+=content;
	var after_content='</div><div class="row">'
					+'<div class="col-sm-6 vertical-padded">'
  			+'<input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox" onclick="checkboxed()" /><label for="checkboxG1" class="css-label">Default<br><font class="info-small"><i>(Name, Age, Sex, Language, Skills)</i></font></label>'
			  +'</div></div><div class="row vertical-padded">'
					+'<div class="col-sm-4 vertical-padded" id="cat-btn">'
  			+'<button type="submit" class="btn submit-btn firstcolor" onclick="send_data()" id="filter"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Start</button>'
			  +'</div></div>';
	div.innerHTML+=after_content;

}
function delete_actor(i)
{ 
    var r = confirm("Delete actor "+ actor_data[i].actor_name+" from the database.");
    if (r == true) {
        $.ajax({
    type: "POST",
    data: {actor_id:actor_data[i].actor_id},
    url: "resources/delete.php",
    success: function(res){
      //console.log(res);
      $('#datarow'+i).addClass("animated fadeOut");
      setTimeout(
        function() 
        {
          //do something special
           $('#datarow'+i).addClass("hidden");
        }, 1000);
   }
});

    } else {
        return 0;
    }
    
}
//This function adds selected categories to global_array variable selected
function add_to_categories(cat){
	if(count==5)
    {
    	alert("You have already selected 5 categories.Click on start to browse.");
    	//console.log(select);
    	return;
    }
	select.push(cat);
	var id='#'+cat+"-remove";
	var tagid='#'+cat;
	$(id).removeClass("hidden");
    $(tagid).addClass("taga-selected");
    count++;
//console.log(select);
}
//Removes a category from the selected list
function removes(cat)
{
	
	removeA(select,cat);
	var id='#'+cat+"-remove";
	var tagid='#'+cat;
    $(tagid).removeClass("taga-selected");
    $(id).addClass("hidden");
    count--;
    event.stopPropagation();
//console.log(select);

}
//Helper function to remove an element from an array
function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}
function checkboxed(){
    if(document.getElementById("checkboxG1").checked)
    {
      count=0;
      select=[];
    	select_default();
    }
    else
    {
    	unselect_default();
    }
} 
function select_default()
{	
	add_to_categories("Name");
	add_to_categories("Age");
	add_to_categories("Sex");
	add_to_categories("Language");
	add_to_categories("Skills");
}
function unselect_default()
{
	removes("Name");
	removes("Age");
	removes("Sex");
	removes("Language");
	removes("Skills");
  count=0;
}
function send_data()
{	
	if(count<5)
	{
		alert("Please select at least five fields");
		return;
	}
	if(count>5)
	{
		alert("You have selected more than 5 categories.Please select only 5");
		return;
	}
  //setting the cookie
  setCookie("catset","isset",0.05);
  setCookie("cat1",select[0],0.05);
  setCookie("cat2",select[1],0.05);
  setCookie("cat3",select[2],0.05);
  setCookie("cat4",select[3],0.05);
  setCookie("cat5",select[4],0.05);
  console.log(select);
	$.ajax({
   	type: "POST",
   	data: {data:select},
   	url: "fetch_actor.php",
   	success: function(res){
     $("#prelogin").addClass("hidden");
     $("#home").removeClass("hidden");
     var json = JSON.parse(res);
     console.log(json);
     if(json==null)
     {
        show_add_actor();
     }
     else
     {
        populate_browse_table(res);
     }  
     
   }
});
}
function show_add_actor()
{
 
  var div = document.getElementById('browse-table');
  content='<div class="showwelcome"><font class="info gray">Ola! It looks like you are new over here. <br>Why don\'t you start with inviting some actors?'
  +'<br><button type="submit" class="btn submit-btn firstcolor"  data-toggle="modal" data-target="#inviteActors" id="btn-login" ><span class="glyphicon glyphicon-plus"></span> &nbsp;Invite  Actor</button></div>';
  div.innerHTML = content; 
}
function sendsmstoo()
{
  
  if($('#checkboxsms').is(':checked'))
  {
    sendsms=1;
    $("#textsms").removeClass("hidden");
    //$("#textsms").addClass("animated fadeIn");
  }
  else
  {
    sendsms=0;
    //$("#textsms").addClass("animated fadeOut");
    $("#textsms").addClass("hidden");
  } 
}
function show_details(i)
{
  var div = document.getElementById('actor_detail');
  div.innerHTML="";
  collapse= '     <div class="center">'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Name :<span class="gray">'+ actor_data[i].actor_name +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Email : <span class="gray">'+ actor_data[i].actor_email +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Facial Attribute : <span class="gray">'+ actor_data[i]["actor_facial-attribute"] +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">DOB :<span class="gray">'+ actor_data[i].actor_dob +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Phone : <span class="gray">'+ actor_data[i].actor_contact_number +'</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Physical Attribute :<span class="gray"> '+ actor_data[i]["actor_physical-attribute"] +'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <div class="col-sm-6 " style="padding-left:0px">'
                       +'                     <font class="info-medium firstcolor">Height : <span class="gray">'+ actor_data[i].actor_height +'cms</font>'
                       +'                 </div>'
                       +'                <div class="col-sm-6">'
                       +'                    <font class="info-medium firstcolor">Weight :<span class="gray">'+ actor_data[i].actor_weight +'kgs</font>'
                       +'                 </div>'
                       +'             </div>'
                       +'             <div class="col-sm-4 scrolr">'
                       +'                 <font class="info-medium firstcolor">Experience :<span class="gray">'+ actor_data[i].actor_experience +'</font>'
                       +'             </div>'
                       +'            <div class="col-sm-4 scrolr">'
                       +'                 <font class="info-medium firstcolor">Projects : <span class="gray">'+ actor_data[i].actor_projects+'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row collapsedetail">'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Range :<span class="gray"> '+ actor_data[i].actor_range+' years</font>'
                       +'             </div>'
                       +'             <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Training :<span class="gray"> '+ actor_data[i].actor_training+'</font>'
                       +'             </div>'
                       +'            <div class="col-sm-4">'
                       +'                 <font class="info-medium firstcolor">Auditions :<span class="gray"> '+ actor_data[i].actor_auditions+'</font>'
                       +'             </div>'
                       +'         </div>'
                       +'         <div class="row" style="padding-right:15px;">'
                       +'             <div class="DocumentList">'
                       +'                 <ul class="list-inline">';

                       for(var k=0;k<actor_data[i].actor_images;k++)
                       {
                        var str = actor_data[i].actor_profile_photo;
                        var arr = str.split(".");
                        var ext = arr[2];
                        str1 = arr[0];
                        str2 = arr[1];
                        str2 = str2.substring(0, str2.length - 1);
                        str=str1+'.'+str2;
                        str+=k+'.'+ext;
                        //console.log(str);
                        collapse+='<li class="DocumentItem">'
                       +'<a href="'+str+'" data-lightbox="'+actor_data[i].actor_name+'"><img class="photo" src='+str+' height="100%" width=auto></img></a>' 
                       +'         </li>';
                      }
                        collapse+='                 </ul>'
                       +'             </div>'
                       +'         </div>'
                       +'     </div>'
                       +'</div> ';
                      div.innerHTML=collapse;
                      $('#detailsActor').modal('show');

}
function populate_browse_table(res)
{	
  console.log(res);
	var json = JSON.parse(res);
  console.log(json);
	actor_data=json;
	var div = document.getElementById('browse-table');
  div.innerHTML="";
	var collapse;
	var content='<table class="table table-curved display" id="actor_table">'
               +'<thead center>'
               +'<tr><th id="selectallcheckbox"><input type="checkbox" name="selectallactor" id="selectallactor" class="css-checkbox" onclick="selectallactor()" /><label for="selectallactor" class="css-label"></label></th><th>Profile</th>';
    for(i=0;i<select.length;i++)
    {
    	content+='<th data-sort="string">'+select[i]+' <font class="sortbuttons"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></font></th>';
    }
    content+="</tr></thead>";
    content+="<tbody>";
    var a=select[0].toLowerCase();
    a="actor_"+a;
    var b=select[1].toLowerCase();
    b="actor_"+b;
    var c=select[2].toLowerCase();
    c="actor_"+c;
    var d=select[3].toLowerCase();
    d="actor_"+d;
    var e=select[4].toLowerCase();
    e="actor_"+e;
    console.log(a);
    console.log(b);
    console.log(c);
	for(var i=0;i<json.length;i++)
	{
		content+='<tr id="datarow'+i+'">'
						  +'<td id="selectallcheckbox">'
						  +		'<input type="checkbox" name="checkactor" id="checkactor'+i+'" value='+i+' class="css-checkbox" onclick="actor_check('+i+')" /><label for="checkactor'+i+'" class="css-label"></label>'
                          +'</td>' 
                   		  +'<td style="vertical-align:middle-top;">'
                          +      '<div class="img-div center">'
						  +			'<img src="'+json[i].actor_profile_photo+'" onclick="show_details('+i+')" />'
						  +		 '</div>'
                          + '</td>' 
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i][a]+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i][b]+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i][c]+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray scrolr">'+json[i][d]+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          + 		'<span class="info gray scrolr">'+json[i][e]+'</span><font class="sortbuttons"><button onclick="show_details('+i+')"  class="btn submit-btn firstcolor toggle-btn" style="right:50px;" ><span class="glyphicon glyphicon-share"></span></button><button onclick="delete_actor('+i+')"  class="btn submit-btn firstcolor toggle-btn" ><span class="glyphicon glyphicon-trash"></span></button>'
                          +'</td></tr>';
                         

	}
	content+="</tbody></table>";
	div.innerHTML+=content;
   $(function(){
        $("table").stupidtable();
    });
   $("img").error(function () { 
    $(this).hide();
    // or $(this).css({visibility:"hidden"}); 
});
}
function selectallactor()
{
	if(document.getElementById("selectallactor").checked)
    {
    	checkboxes = document.getElementsByName('checkactor');
    	//actors_selected=[];
  		for(var i=0, n=checkboxes.length;i<n;i++)
  		{
    		checkboxes[i].checked = true;
    		add_actor(checkboxes[i].value);
    		
  		}
    }
    else
    {
    	checkboxes = document.getElementsByName('checkactor');
  		for(var i=0, n=checkboxes.length;i<n;i++)
  		{
    		checkboxes[i].checked = false;
    		remove_actor(checkboxes[i].value);
  		}
    }
    event.stopPropagation();
   // console.log(actors_selected);
}
function add_actor(i)
{
	actors_selected.push(actor_data[i].actor_email);
  actor_phonelist.push(actor_data[i].actor_contact_number);

}
function remove_actor(i)
{
	removeA(actors_selected,actor_data[i].actor_email);	
  removeA(actor_phonelist,actor_data[i].actor_contact_number);
}
function actor_check(i)
{	
	var id="checkactor"+i;
	if(document.getElementById(id).checked)
    {
		add_actor(i);
		//console.log(actors_selected);
	}
	else
	{
		remove_actor(i);
		document.getElementById("selectallactor").checked=false;
		//console.log("removeActor_check "+actors_selected);
	}
	event.stopPropagation();
}
$("#datarow").click(function(e) {
    if (e.target.type == "checkbox") {

        // stop the bubbling to prevent firing the row's click event
        e.stopPropagation();
    } 
});
function populatecontactform()
{
  $('#contactmodal').removeClass("hidden");
  var div=document.getElementById("receipents");
  var no_rec=actors_selected.length;
  if(no_rec>3)
  {
    other=no_rec-2;
    div.innerHTML='<br>'+actors_selected[0]+', '+actors_selected[1]+' and <br><font class="info-small gray">'+other+' others.'
  }
  else
  {
    var content="<br>";
    for(var i=0;i<no_rec;i++)
    {
      content+=actors_selected[i];
      if(no_rec-i!=1)
      {
        content+=", ";
      }
      else
      {
        content+=".";
      }
    }
    div.innerHTML=content;
  }


}
function search()
{
  $('#advancedSearch').modal('hide');
  show_spinner();
  var age_min = $("#aagemin").val();
  var age_max = $("#aagemax").val();
  var hmin = $("#heightmin").val();
  var hmax = $("#heightmax").val();
  var sex = $("#asex").val();
  var skills = $("#askills").val();
  var projects = $("#aprojects").val();
  $.ajax({
    type: "POST",
    data: {age_min:age_min, age_max:age_max, hmin:hmin, hmax:hmax, sex:sex, skills:skills, projects:projects},
    url: "resources/filter.php",
    success: function(res){
      
      console.log(res);
      if(res!="")
      {
        var json = JSON.parse(res);
     //console.log(json);
          if(json==null)
         {
            show_no_actor();
         }
          else
         {  
            populate_browse_table(res);
           //show_spinner();
         }  
      }
    else
    {
      show_no_actor();
    }
     
   }
});
  

}
function show_no_actor()
{
  var div = document.getElementById('browse-table');
  content='<div class="showwelcome"><font class="info gray">Oops! It looks like no actor match your criteria. <br>Why don\'t you try changing some of the filters?'
  +'<br><button type="button" class="btn submit-btn firstcolor" data-toggle="modal" data-target="#advancedSearch" id="btn-login" ><span class="glyphicon glyphicon-filter"></span> &nbsp; Change Filters</button></div>';
  div.innerHTML = content; 
}
function show_spinner()
{
  var div = document.getElementById('browse-table');
  content='</img><div class="showwelcome"><center><img src="img/logo.png" class="rotate-img center" width="80px" height="80px"/><br><font class="info gray">Crunching the latest data for you!</div>';
  div.innerHTML = content; 
}
function send_mail()
{
  var message=$("#message").val();
  var subject=$("#subject").val();
  var mailto=actors_selected.toString();
  var sendto="";
  //sendto+=",";
  console.log(sendto);
  var sms;
  if (sendsms==0)
  {
    sms:"";
    sendto="";
  }
  else
  {
    sms=$("#textsms").val();
    sendto=actor_phonelist.toString();

  }
  console.log(sendsms);
  console.log(sendto);
  $.ajax({
    type: "POST",
    data: {message:message, subject:subject, mailto:mailto, sms:sms, sendto:sendto},
    url: "resources/sendmail.php",
    success: function(res){
      console.log(res);
      if(res!=200)
    {
     $('#contactmodal').modal('hide');
     $("#success_send").show(); 
     $("#success_send").fadeTo(2000, 500).slideUp(500, function(){
        $("#success_send").alert('close');
                });
    }
    else
    {
      $("#failure_send").show();
      $("#failure_send").fadeTo(2000, 500).slideUp(500, function(){
        $("#failure_send").alert('close');
                });
    }
     
   }
});
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


if(checkCookie("catset")==0)
{
  console.log("Populating Categories Table");
  populate_cat_table();

}
else
{
  select.push(getCookie("cat1"));
  select.push(getCookie("cat2"));
  select.push(getCookie("cat3"));
  select.push(getCookie("cat4"));
  select.push(getCookie("cat5"));
  count=5;
  console.log("Calling Send Data");
  send_data();
}
//show_spinner();