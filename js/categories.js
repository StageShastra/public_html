var select=[];
var count=0;

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
					+'<div class="col-sm-4 vertical-padded">'
  			+'<button type="submit" class="btn submit-btn firstcolor" onclick="send_data()" id="filter"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Start</button>'
			  +'</div></div>';
	div.innerHTML+=after_content;

}
//This function adds selected categories to global_array variable selected
function add_to_categories(cat){
	if(count==5)
    {
    	alert("You have already selected 5 categories.Click on start to browse.");
    	console.log(select);
    	return;
    }
	select.push(cat);
	var id='#'+cat+"-remove";
	var tagid='#'+cat;
	$(id).removeClass("hidden");
    $(tagid).addClass("taga-selected");
    count++;

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
}
function send_data()
{	
	if(count<2)
	{
		alert("Please select at least two fields");
		return;
	}
	if(count>5)
	{
		alert("You have selected more than 5 categories.Please select only 5");
		return;
	}
	$.ajax({
   	type: "POST",
   	data: {data:select},
   	url: "fetch_actor.php",
   	success: function(res){
     $("#prelogin").addClass("hidden");
     $("#home").removeClass("hidden");
     populate_browse_table(res);
     
   }
});
}
function populate_browse_table(res)
{	
	var json = JSON.parse(res);
	var div = document.getElementById('browse-table');
	var content='<table class="table table-curved">'
               +'<thead center>'
               +'<tr><th id="selectallcheckbox"><input type="checkbox" name="checkboxall" id="checkboxall" class="css-checkbox" onclick="checkboxed()" /><label for="checkboxall" class="css-label"></label></th><th>Profile</th>';
    for(i=0;i<select.length;i++)
    {
    	content+='<th>'+select[i]+' <font class="sortbuttons"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></font></th>';
    }
    content+="</tr></thead>";
    content+="<tbody>";
	for(var i=0;i<json.length;i++)
	{
		content+="<tr>"	  +'<td id="selectallcheckbox">'
						  +		'<input type="checkbox" name="checkboxall" id="checkboxall" class="css-checkbox" onclick="checkboxed()" /><label for="checkboxall" class="css-label"></label>'
                          +'</td>' 
                   		  +'<td style="vertical-align:middle-top;">'
                          +      '<div class="img-div center">'
						  +			'<img src="'+json[i].actor_profile_photo+'"/>'
						  +		 '</div>'
                          + '</td>' 
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray">'+json[i].actor_name+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray">'+json[i].actor_sex+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray">'+json[i].actor_age+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray">'+json[i].actor_language+'</span>'
                          + '</td>'
                          +'<td style="vertical-align:middle;">'
                          +      '<span class="info gray">'+json[i].actor_skills+'</span>'
                          + '</td>'
                          +'</tr>'; 

	}
	content+="</tbody></table>";
	div.innerHTML+=content;
        
}


populate_cat_table();