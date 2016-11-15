var project_id;
var projects=[];

/*
steps: 
1. Fetch all the roles and store in an array;
2. Fetch all actors in a project
3. fetch their questions and answers
4. 

actor {
	other_details
	roles:[], //fetch roles of an actor
	questions:[], // fetch actor question answers based on role
	scenes:videos, //fetch videos
}
*/
$(document).ready(function(){
	$(document).on("click", ".toggleEdit", function(){

			var unhide = $(this).attr("data-unhide-id");
			var hide = $(this).attr("data-hide-id");
			$(unhide).removeClass("hidden");
			$(hide).addClass("hidden");

			//console.log(hide, unhide);

		});
	show_loader_gif("#loader");
	populate_projects();
	
	//hadnles clicks on the cards
	$(document).on("click",".card",function(e) { 
		var id=$(this).attr("data");
		//console.log(id);
		window.location.assign('./project/'+id);
	});  

	//handles clicks on the onoffswitch
	$(document).on("click",".onoffswitch",function(e) { 
		e.stopPropagation();
		var id=$(this).attr("data");

		if($("#myonoffswitch_"+id).is(":checked"))
		{
			$("#myonoffswitch_"+id).prop('checked', false);
			change_project_status(id,0);
		}
		else
		{
			$("#myonoffswitch_"+id).prop('checked', true);
			change_project_status(id,1);
		}
	

	}); 
	
});


function populate_projects()
{	
	data = {request: "getProjectsInDirector"}
	 		
	 		console.log("fetching projects...");

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{
					projects=JSON.parse(response.data);
					console.log("Project fetched");
					console.log(projects);
					populate_cards();
					
				}
				else
				{
					console.log("no projects found. Please proceed");
				}

			}
		});

		
}
function populate_cards()
{
	console.log("fetching questions...");
	var dyn_html='';
	for(i=0;i<projects.length;i++)
	{
		if(projects[i].StashProject_name!="")
		{
		var shoot_start_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
		var shoot_end_date = new Date(0);
		var project_date = new Date(0);
		shoot_start_date.setUTCSeconds(projects[i].StashProject_shoot_begins);
		shoot_end_date.setUTCSeconds(projects[i].StashProject_shoot_ends);
		project_date.setUTCSeconds(projects[i].StashProject_date);
dyn_html+='<div class="col-lg-3 col-xs-12 card-marginbottom">'
    			+'<div class="card" data='+projects[i].StashProject_id+'>'
        		+'<div style="width:100%; height:100px; text-align:center; background-color:'+project_background(projects[i].StashProject_name)+'"><span class="one_letter">'+projects[i].StashProject_name[0]+'</span></div>'
        		+'<div class="card-block" style="min-width:100% !important;">'         
          	+'<div class="row">'
	            +'<div class="col-lg-8"> <p class="card-title">'+projects[i].StashProject_name+'</p></div>'
	            +'<div class="col-lg-4">'
	            +'<div class="onoffswitch" data='+i+' style="padding-top:10px;">'
	            +'<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch_'+i+'" '+checkedornot(i)+'>'
	            +'<label class="onoffswitch-label center" for="myonoffswitch"></label>'
	            +'</div>'
	            +'</div>'
            +'</div>'
          +'<div class="card-subtitle"> Project Date:'+ project_date.toDateString() +'</div>'
          +'<div class="card-text">'
            +'<table class="card-table">'
            +  '<tr>'
            +    '<td class="card-table-element">Client</td>'
            +    '<td class="card-table-element-data">'+ projects[i].StashProject_client+'</td>'
            +  '</tr>'
            +  '<tr>'
            +    '<td class="card-table-element">Shoot Start</td>'
            +    '<td class="card-table-element-data"><span class="shoot_begins">'+ shoot_start_date.toDateString() + '</span></td>'
            +  '</tr>'
            +  '<tr>'
            +    '<td class="card-table-element">Shoot End</td>'
            +    '<td class="card-table-element-data"><span class="shoot_ends">'+ shoot_end_date.toDateString()+'</span></td>'
            +  '</tr>'
            +'</table>'
          +'</div>'
        +'</div>'
    +'</div></div>';
	}
}
	$("#loader").addClass("hidden");
	$("#list_projects").html(dyn_html);
	console.log("all questions fetched")
	//populate_attendees();	
}
function project_background(str)
{

    // str to hash
    str.toUpperCase();
    var colours_array=["#009688","#2196f3","#ffc107","#f44336","#e91e63","#ff9800","#5ace5f","#673ab7","#3f51b5"];
    var c_index=str.charCodeAt(0);
    c_index=c_index%8;
    return colours_array[c_index];

}
  
function change_project_status(id,status)
{
	data = {request: "changeProjectStatus",
	 		data: JSON.stringify({
	 								project_id: projects[id].StashProject_id,
	 								status:status 
	 							 }
	 							)};
	 		

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{
					return 1;
					
				}
				else
				{
					return 0;
				}

			}
		});

}
function checkedornot(i)
{
	if(projects[i].StashProject_status==1)
	{
		return "checked";
	}
	else
	{
		return "unchecked";
	}
}
function show_loader_gif(id){
	var text = '"for good things, we wait must!"<br><span><i>- Master Yoda</i></span>';
	var content = '<div class="loader"><img id="loader_gif" src="'+base+'assets/img/spinner.gif" height="300"/><br><span class="quote" style="font-family: "Roboto";font-weight: 800;">'+text+'</span><br><div class="loader_text">'+text+'</div></div>';
	$(id).html(content);
	//console.log(content);
}
function change_loader_text(text)
{	
	$(".loader_text").addClass("animated fadeInUp");
	$(".loader_text").html(text);

	
	//$(".loader_text").addClass("animated fadeOutUp");
}