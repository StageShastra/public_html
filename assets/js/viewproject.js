var project_id;
var roles=[];
var dates={};
var days=[];
var city_names=[];
var cities={};
var actor=[];
var attendees=[];
var attendees_names=[];
var max_scenes=0;
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
	populate_roles();

	var shoot_start_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
	var shoot_end_date = new Date(0);
	shoot_start_date.setUTCSeconds(project_shoot_begins);
	shoot_end_date.setUTCSeconds(project_shoot_ends);
	$(".shoot_begins").html(shoot_start_date.toDateString());
	$(".shoot_ends").html(shoot_end_date.toDateString());
});

$(document).on("click", ".role-tab", function(e){

		var state = $(this).attr("data-state");
		var role_index = $(this).attr("data-name");
		if(state=="active")
		{
			roles[role_index].state=0;
			$(this).attr("data-state","inactive");
			$(this).addClass("inactive-tab");

		}
		else
		{
			roles[role_index].state=1;
			$(this).attr("data-state","active");
			$(this).removeClass("inactive-tab");
			
		}
		hide_show_rows(0,role_index) // 0 is for role, 1 is for days

});
$(document).on("click", ".date-tab", function(e){

		var state = $(this).attr("data-state");
		var date_name = $(this).attr("data-name");
		var state = $(this).attr("data-state");
		var day_index = $(this).attr("data-name");
		if(state=="active")
		{
			days[day_index].state=0;
			$(this).attr("data-state","inactive");
			$(this).addClass("inactive-tab");

		}
		else
		{
			days[day_index].state=1;
			$(this).attr("data-state","active");
			$(this).removeClass("inactive-tab");
			
		}
		hide_show_rows(1,day_index) // 0 is for role, 1 is for days

});
function hide_show_rows(c,index)
{	
	console.log(roles);
	if(c==0)
	{
		
		for(k=0;k<days.length;k++)
		{
			if(days[k].state*roles[index].state==0)
			{
				//console.log(days[k]);
				//console.log(roles[index]);
				$('.'+roles[index].StashRoles_role.split(' ').join('_')+'_role').addClass("hidden");
				//console.log("."+roles[index].StashRoles_role+"_role");

			}
			else
			{
				$('.'+roles[index].StashRoles_role.split(' ').join('_')+'_role.'+days[k].real_date.split(' ').join('_')+'_date').removeClass("hidden");
				
				
			}
		}
	}
	if(c==1)
	{
		for(k=0;k<roles.length;k++)
		{
			if(roles[k].state*days[index].state==0)
			{
				//$("."+days[index].real_date.split(' ').join('_')+"_date").addClass("animated fadeOut");
				$("."+days[index].real_date.split(' ').join('_')+"_date").addClass("hidden");

			}
			else
			{
				$('.'+days[index].real_date.split(' ').join('_')+'_date.'+roles[k].StashRoles_role.split(' ').join('_')+'_role').removeClass("hidden");
				//$("."+days[index].real_date.split(' ').join('_')+"_role").removeClass("animated fadeOut");
				//$("."+days[index].real_date.split(' ').join('_')+"_role").addClass("animated fadeIn");
				
			}
		}
	}
}
function populate_roles()
{	
	data = {request: "getRolesInProject",
	 		data: JSON.stringify({
	 								project_id: project_id, 
	 							 }
	 							)};
	 		change_loader_text("fetching roles...");

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{
					roles=JSON.parse(response.data);
					change_loader_text(roles.length+" roles fetched...");
					for(l=0;l<roles.length;l++)
					{
						roles[l].actor_in_role=0;
						roles[l].state = 1;
					}
					populate_questions(0);
					
					
				}
				else
				{
					console.log("no roles found. Please proceed");
				}

			}
		});

		
}

function populate_questions(i)
{
	change_loader_text("fetching questions...");
	
		if(roles[i].StashRoles_scenes>max_scenes)
		{
			max_scenes=roles[i].StashRoles_scenes;
		}
		data = {request: "getQuestionsByRoleId",
	 		data: JSON.stringify({
	 								role_id: roles[i].StashRoles_id, 
	 							 }
	 							)};
	 		
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{
					roles[i].questions=JSON.parse(response.data);
					if(++i<roles.length)
					{
						populate_questions(i);
					}
					else{
						populate_attendees();
					}
					//console.log(roles[i]);
					//change_loader_text("question "+ (i+1) + " of " + roles.length + " fetched...")
					
				}
				else
				{
					console.log("no questions found. Please proceed");
				}

			}
		});
	console.log("all questions fetched")
	
}
function populate_attendees()
{
	data = {request: "getActorsInARole",
	 		data: JSON.stringify({
	 								project_id: project_id, 
	 							 }
	 							)};
	 		change_loader_text("fetching actors...");
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					attendees=JSON.parse(response.data);
					change_loader_text(attendees.length +" actors fetched...");
					$("#attendeeslength").html(attendees.length);
					if(attendees.length==0)
					{

						$("#loader_gif").addClass("hidden");	
						$(".loader_text").addClass("bigger_text");
                    	change_loader_text("no actors here yet...");
                    	//$(".quote").addClass("hidden");
                    	return;
					}
					else
					{
						get_actors_answers(0);	
						populate_dates();
					}
					

				}
				else
				{
					change_loader_text("no actor found. Please proceed");
				}

			}
		});
}

function get_actors_answers(f)
{
	change_loader_text("fetching actor's answers...");
	if(attendees[f].StashRoleActorLink_date_of_audition==null)
	{
		attendees[f].StashRoleActorLink_date_of_audition = 1427333800;
	}
	if(!(attendees[f].StashRoleActorLink_date_of_audition in dates))
	{
		dates[attendees[f].StashRoleActorLink_date_of_audition]=1;
	}
	else
	{
		dates[attendees[f].StashRoleActorLink_date_of_audition]++;
	}
	if(!(attendees[f].StashActor_city in cities))
	{
		cities[attendees[f].StashActor_cities]=1;
	}
	else
	{
		cities[attendees[f].StashActor_cities]++;
	}
		if(get_question_details(f,attendees[f].StashRoleActorLink_role_id_ref)==1)
		{
			
			if(++f<attendees.length)
			{

				
				get_actors_answers(f);

			}
			else
			{
				populate_videos(0);
				//console.log(dates);
				change_loader_text("all actor's answers fetched");
			}

		}
	
}


function get_question_details(index,role_id)
{
    
	for(var ri=0;ri<roles.length;ri++)
	{	
		
		if(roles[ri].StashRoles_id==role_id)
		{
			attendees[index].questions=[];
			if(attendees[index].StashRoleActorLink_role_id_ref==role_id)
			{
				attendees[index].role_name=roles[ri].StashRoles_role;	
				roles[ri].actor_in_role++;
			}
		
			if(roles[ri].questions.length!=0){
				get_link_question_role(ri,index,0,role_id);
			}
			break;
			
		}
	}
	//console.log(roles);
	return 1;
}
function get_link_question_role(i,index,k,role_id)
{
			var questions_answers={};
			
			questions_answers.question=roles[i].questions[k];

				data = {request: "getActorsAnswers",
				 		data: JSON.stringify({
				 								actor_id: attendees[index].StashActor_actor_id_ref,
				 								question_id: roles[i].questions[k].StashQuestions_id 
				 							 }
				 							)};

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	
								(questions_answers.question).answer=JSON.parse(response.data);
								
								if(++k<(roles[i].questions).length && roles[i].questions.length!=0)
								{
									get_link_question_role(i,index,k,role_id);
								}
								return 1;
								
							}
							else
							{
								change_loader_text("no answers found. Please proceed");
							}

						}
					});
				
				attendees[index].questions[k]=questions_answers;
}
function populate_videos(i)
{
	change_loader_text("fetching videos...");
	
		data = {request: "getActorVideos",
				 		data: JSON.stringify({
				 								actor_id: attendees[i].StashActor_actor_id_ref,
				 								role_id: attendees[i].StashRoleActorLink_role_id_ref
				 							 }
				 							)};

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	
								attendees[i].videos=JSON.parse(response.data);
								if(++i<attendees.length)
								{
									console.log("calling recursion");
									populate_videos(i);
								}
								else
								{
									change_loader_text("all videos fetched.");
									populate_table();
								}
								//console.log("videos " + (i+1) + " of " + attendees.length + "linked...")
								
							}
							else
							{
								console.log("no videos found. Please proceed");
							}

						}
					});
	
	
}

function set_videos(actor_id,role_id,index)
{
	data = {request: "setActorSceneVideo",
				 		data: JSON.stringify({
				 								actor_id: actor_id,
				 								role_id: role_id,
				 								index: index,
				 								video: video 
				 							 }
				 							)};

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	
							//	console.log("actor video set");
							}
							else
							{
								console.log("no answers found. Please proceed");
							}

						}
					});
}


function populate_dates()
{
	var tmp_days=[];
	tmp_days=Object.keys(dates);
	
	var pre_html="";
	for(k=0;k<tmp_days.length;k++)
	{
		var day_obj={};
		var aud_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
		aud_date.setUTCSeconds(tmp_days[k]);
		day_obj.real_date = tmp_days[k];
		day_obj.state=1;
		day_obj.date = aud_date.toDateString();
		day_obj.day = "Day "+inWords(k+1);
		days[k]=day_obj;
		pre_html+='<span class="toggle-tab date-tab" data-name="'+k+'" data-state="active">'+day_obj.day+' <span class="badge">'+dates[tmp_days[k]]+' </span></span>';
	}
	
	$(".date-tabs").html(pre_html);
	var pre_html="";
	for(var i=0;i<roles.length;i++)
	{
		
		pre_html+='<span class="toggle-tab role-tab" data-name='+i+' data-state="active">'+roles[i].StashRoles_role+' <span class="badge">'+roles[i].actor_in_role+' </span></span>';
                  
	}

	$(".role-tabs").html(pre_html);
}

function populate_table()
{

    change_loader_text("painting the big picture...");        
	var dyn_html='<thead>'
             +' <th class="star"><i class="fa fa-star-o" id="shortlist_all" data-tooltip="Click to sort." aria-hidden="true" onclick="show_shortlisted()"></i></th>'
             +' <th>Profile</th>'
             +' <th>Name </th>'
             +' <th>Role </th>'
             +'	<th>Notes</th>';
             dyn_html+=' <th class="video_col">Intro</th>';
             for(i=0;i<max_scenes;i++)
             {
             	dyn_html+='<th class="video_col">Scene '+ (i+1) +'</th>';
             }
             dyn_html+=' <th>City</th>'
             +'<th><span class="fa fa-newspaper-o" title="Casting Sheet response"></span></th>';
             dyn_html+=' <th><span class="fa fa-trash-o" title="Delete record"></span></th>';
             dyn_html+='</thead>';
             dyn_html+='<tbody>';
             change_loader_text("hold on...");
	for(i=0;i<attendees.length;i++)
	{
		
             var shortlist_string=shortlist_star(attendees[i]);
             //console.log(shortlist_string);
             dyn_html+= shortlist_string+''
             +'  <td class="profile" style="vertical-align:middle-top;">'
             +'    <div class="center" ><img src="http://www.castiko.com/assets/img/actors/'+attendees[i].StashActor_avatar+'" class="showDetailscs pro_pic" data-id='+i+' ></div>'
             +'  </td>'
             +'  <td class="role_name">'
             +		attendees[i].StashActor_name
             +'  </td>'
             +'  <td class="role_name">'
             +		attendees[i].role_name
             +'  </td>';
             var notes_string=show_notes(attendees[i],i);
             //console.log(shortlist_string);
             dyn_html+= notes_string+'';
             var video_string=video_embed(attendees[i]);
             //console.log(video_string);
             var aud_date = new Date(0);
				aud_date.setUTCSeconds(attendees[i].StashRoleActorLink_date_of_audition);
             dyn_html+= video_string+''
             +'<td>'+attendees[i].StashActor_city+'<td><span class="fa fa-newspaper-o" onclick="open_casting_response('+i+')"></span></td>'
             +'<td><span class="fa fa-trash-o" onclick="delete_record_response('+i+')"></span></td>'
             +'</tr>';
	}
	change_loader_text("almost there...");
	 dyn_html+='</tbody>';
	$(".actors").html(dyn_html);
	$("#loader").addClass("hidden");
	$(".role-tabs").removeClass("hidden");
	if(isPublic==1)
	{
		$("#bs-example-navbar-collapse-1").html("");
		$(".fa").addClass("public_disabled");
		$(".fa").attr("onclick" ,'none');
		show_shortlisted();
	}

	console.log(attendees);
}

//ancillary functions
function isEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function video_embed(actor)
{
	//console.log("video embed called");
	var string='';
	for(t=0;t<actor.videos.length;t++)
	{ 
		if(actor.videos[t].StashSceneVideo_video=="")
		{
			string+='<td class="video video_col"><div id="video_"'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit" data-hide-id="#cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"data-unhide-id="#input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"><span id="cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="click_to_add">Click to add video</span>'
					   +'<div class="embed-responsive embed-responsive-4by3 hidden" id="embed_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'">'
	                   +'</div>'
					   +'<input class="input_cs hidden" id="input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" placeholder="Paste youtube video link" onpaste="setTimeout(function(){ show_video('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)">'
					   +'</div></td>' ;


		}
		else
		{
			string+='<td class="video video_col">'
	                +'    <div class="embed-responsive embed-responsive-4by3">'
	                +'      <iframe id="iframe_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="embed-responsive-item" src="'+actor.videos[t].StashSceneVideo_video+'" allowfullscreen></iframe>'
	                +'    </div>'
	                +'<button id="edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-unhide-id="#input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit go_button">Edit</button>'
	                +'<input class="input_cs hidden" value="'+actor.videos[t].StashSceneVideo_video+'" id="input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" onpaste="setTimeout(function(){ show_video('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)">'
	                +'<button id="update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="button" onclick="setTimeout(function(){ show_video('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)" class="go_button toggleEdit hidden" data-unhide-id="#edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" >Go</button>'
	                +' </td>';
		}
	}
	//console.log("max_scenes are_"+max_scenes);
	var actor_Scenes=actor.videos.length - 1;
	if(actor_Scenes<max_scenes)
	{
		//console.log("in max scenes");
		for(h=actor_Scenes;h<max_scenes;h++)
		{
			string+='<td class="video video_col hidden">'
	                +'<span class="click_to_add">Not applicable</span>'    
	                +' </td>';
		}
	}
	return string;
}
function show_notes(actor,i)
{
		var t=0;
		var string="";
		if(actor.StashRoleActorLink_notes==null)
		{
			string+='<td class="notes" style="text-align:left;">'
					   +'<div id="notes_"'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit" data-hide-id="#notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"data-unhide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'">'
					   +'<span id="notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="click_to_add">Click to add notes</span>'
					   +'<input class="input_cs hidden" id="notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" placeholder="Add notes here" onfocusout="setTimeout(function(){ save_notes('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)">'
					   +'</div></td>' ;


		}
		else
		{
			string+='<td class="notes" style="text-align:left;"><div id="notes_"'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit" data-hide-id="#notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"data-unhide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"><span id="notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="click_to_add">'+actor.StashRoleActorLink_notes+'</span>'
					   +'<input class="input_cs hidden" id="notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" placeholder="Add notes here" value="'+actor.StashRoleActorLink_notes+'" ><br>'
			
	                +'<button id="notes_edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#notes_edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-unhide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#notes_update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit go_button">Edit</button>'
	               
	                +'<button id="notes_update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="button" onclick="setTimeout(function(){ save_notes('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)" class="go_button toggleEdit hidden" data-unhide-id="#notes_edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#notes_update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" >Go</button>'
	                +'</div></td>';
		}
	
	return string;
}
function open_casting_response(id)
{
	$("#m_actor_name").html(attendees[id].StashActor_name);
	$("#m_actor_email").html(attendees[id].StashActor_email);
	$("#m_actor_mobile").html(attendees[id].StashActor_mobile);
	var height_feet = Math.floor(attendees[id].StashActor_height/30.48);
	var height_inches = Math.round((attendees[id].StashActor_height%30.48)/2.54);
	$("#m_actor_height").html(height_feet+" ft " + height_inches+" inches");
	$("#m_actor_weight").html(attendees[id].StashActor_weight+" kgs");
	var t = attendees[id].StashActor_dob;
	var d = new Date(t * 1000);
	var age=_calculateAge(d);
	$("#m_actor_age").html(age+ " years");
	var prehtml='';
	for(n=0;n<attendees[id].questions.length;n++)
	{	var questions_obj=attendees[id].questions[n];
	 	var question_q=questions_obj.question.StashQuestions_question;
	 	if(questions_obj.question.answer!=null)
	 	{
	 		var question_a=questions_obj.question.answer.StashAnswers_answer;

		 prehtml+='<div class="col-sm-5 firstcolor">'+question_q+'</div>'
        
                  +'<div class="col-sm-7">'+question_a+'</div>';
        }

	}
	$(".m_questions").html(prehtml);

	$("#m_actor_tvc").html(attendees[id].StashActor_tvc_experience);
	$("#m_actor_tv").html(attendees[id].StashActor_series_experience);
	$("#m_actor_web").html(attendees[id].StashActor_web_experience);
	$("#m_actor_films").html(attendees[id].StashActor_films_experience);
	$("#m_actor_theatre").html(attendees[id].StashActor_theatre_experience);
	//$("#m_actor_3_experience").html(attendees[id].StashActor_three_years_experience);
	$("#castingsheetresponse").modal("show");
}
function delete_record_response(id)
{
	var role_id = attendees[id].StashRoleActorLink_role_id_ref;
	var actor_id =  attendees[id].StashActor_actor_id_ref;
	var r = confirm("Are you sure you want to remove "+attendees[id].StashActor_name+" from "+ attendees[id].role_name+"'s role");
	if (r == true) {
		data = {request: "deleteActorRoleLink",
				 		data: JSON.stringify({
				 								actor_id: attendees[id].StashActor_actor_id_ref,
				 								role_id: attendees[id].StashRoleActorLink_role_id_ref

				 							 }
				 							)};

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	
								$("#tr_"+actor_id+"_"+role_id).addClass("animated fadeOut");
								$("#tr_"+actor_id+"_"+role_id).addClass("hidden");

								//console.log("videos " + (i+1) + " of " + attendees.length + "linked...")
								
							}
							else
							{
								console.log("could not be deleted. Please proceed");
							}

						}
					});
	   
	} else {
	    txt = "You pressed Cancel!";
	}
	
}
function shortlist_star(actor)
{
	var string='';
	
		if(actor.StashRoleActorLink_shortlist_status=="0")
		{
			string+= '  <tr id="tr_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" class="'+actor.role_name.split(' ').join('_')+'_role '+actor.StashRoleActorLink_date_of_audition+'_date unshortlisted "><td class="star">'
             		+'    <i class="fa fa-star-o" id="star_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" onclick="shortlist_actor('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+1+')" aria-hidden="true"></i>'
             		+'  </td>' ;


		}
		else
		{
			string+= '  <tr id="tr_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" class="'+actor.role_name.split(' ').join('_')+'_role '+actor.StashRoleActorLink_date_of_audition+'_date shortlisted "><td class="star">'
             		+'    <i class="fa fa-star" id="star_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" onclick="shortlist_actor('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+0+')" aria-hidden="true"></i>'
             		+'  </td>' ;
		}

	
	return string;
}
function shortlist_actor(actor_id,role_id,status)
{
	data = {request: "setActorShortlistStatus",
				 		data: JSON.stringify({
				 								actor_id: actor_id,
				 								role_id: role_id,
				 								status: status
				 							 }
				 							)};
				 		//console.log(data);

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	
								if(status==1)
								{
									
									var id="star_"+actor_id+'_'+role_id+'';
									var tr_id="tr_"+actor_id+'_'+role_id+'';
									$('#'+tr_id).removeClass("unshortlisted");
									$('#'+tr_id).addClass("shortlisted");
									$('#'+id).removeClass("fa-star-o");
									$('#'+id).attr("onclick",'shortlist_actor('+actor_id+','+role_id+','+0+')');
									$('#'+id).addClass("fa-star");
									console.log("Actor Shortlisted");
								}
								else
								{
									
									var tr_id="tr_"+actor_id+'_'+role_id+'';
									$('#'+tr_id).removeClass("shorlisted");
									$('#'+tr_id).addClass("unshortlisted");
									var id="star_"+actor_id+'_'+role_id+'';
									$('#'+id).addClass("fa-star-o");
									$('#'+id).removeClass("fa-star");
									$('#'+id).attr("onclick",'shortlist_actor('+actor_id+','+role_id+','+1+')');
									console.log("Actor removed from shortlist");
								}
							}
							else
							{
								console.log("Actor could not be shortisted");
							}

						}
					});
}

function clean_slate_protocol(){
setTimeout(function(){ location.reload(); }, 9000);
}
	
function leftPad(number, targetLength) {
    var output = number + '';
    while (output.length < targetLength) {
        output = '0' + output;
    }
    return output;
}
function show_video(actor_id,role_id,index)
{
	var input_id='input_'+actor_id+'_'+role_id+'_'+index+'';
	var youtube_link=$('#'+input_id).val();
	//youtube_link=$('#pakla').val();
	//console.log(youtube_link);
	var video_id = getId(youtube_link);
	var embed_string = "https://www.youtube.com/embed/"+video_id;
	var iframe_id='iframe_'+actor_id+'_'+role_id+'_'+index+'';
	var embed_id= 'embed_'+actor_id+'_'+role_id+'_'+index+'';
	var prehtml="";
	prehtml = '<iframe class="embed-responsive-item" id="iframe_'+actor_id+'_'+role_id+'_'+index+'" src="'+embed_string+'"></iframe>'
	$('#'+embed_id).html(prehtml);

	//console.log('#'+iframe_id);
	$('#'+embed_id).removeClass("hidden");
	data = {request: "setActorVideo",
				 		data: JSON.stringify({
				 								actor_id: actor_id,
				 								role_id: role_id,
				 								index: index,
				 								video: embed_string
				 							 }
				 							)};
				 		//console.log(data);

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	//console.log(response);
								console.log("video added");
								
							}
							else
							{
								console.log("no videos found. Please proceed");
							}

						}
					});

}
function save_notes(actor_id,role_id,index)
{
	console.log(actor_id);
	var input_id='notes_input_'+actor_id+'_'+role_id+'_'+index+'';
	var note=$('#'+input_id).val();
	var note_span='notes_cta_'+actor_id+'_'+role_id+'_'+index+''
	//youtube_link=$('#pakla').val();
	console.log(note);
	data = {request: "setActorNotes",
				 		data: JSON.stringify({
				 								actor_id: actor_id,
				 								role_id: role_id,
				 								notes:note
				 							 }
				 							)};
				 		console.log(data);

					$.ajax({
						url: url,
						type: type,
						data: data,
						success: function(response){
							if(response.status==true)
							{	console.log(response);
								console.log("note added");
								$('#'+input_id).addClass("hidden");
								$('#'+note_span).html(note);
								$('#'+note_span).removeClass("hidden");
							}
							else
							{
								console.log("notes could not be added. Please proceed");
							}

						}
					});

}
function show_shortlisted(){
	setTimeout($(".unshortlisted").addClass("animated fadeOut"),2000);
	$(".unshortlisted").addClass("hidden");
	$("#shortlist_all").attr("onclick","show_all()");
	$("#shortlist_all").removeClass("fa-star-o");
	$("#shortlist_all").addClass("fa-star");
}
function show_all(){
	$(".unshortlisted").removeClass("animated fadeOut");
	$(".unshortlisted").addClass("animated fadeIn");
	$(".unshortlisted").removeClass("hidden");
	$("#shortlist_all").attr("onclick","show_shortlisted()");
	$("#shortlist_all").addClass("fa-star-o");
	$("#shortlist_all").removeClass("fa-star");
}
function insert_actor_scenes(role_id,actor_id,scenes,index)
{
	
	
		data = {
			request: "insertRoleActorScenes",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								project_id:project_id,
	 								role_id: role_id,
	 								scene_index:i,
	 								scene:""
	 							 }
				)};
	 		
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					console.log("Scene and actor linked");
					if(++index<=scenes)
					{
						insert_actor_scenes(role_id,actor_id,scenes,index);
					}
				}
				else
				{
					console.log("Scene and actor could not be linked");
					if(++index<=scenes)
					{
						insert_actor_scenes(role_id,actor_id,scenes,index);
					}
				}

			}
		});
	
}
function getId(url) {
	console.log(url);
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 'error';
    }
}
$(document).on("click", ".showDetailscs", function(){
		var id = $(this).attr("data-id");
		console.log(id);
		var str = '';
		var t = attendees[id].StashActor_dob;
		var d = new Date(t * 1000);
		var age=_calculateAge(d);
		content = '<div class="modal-header">'
 		   +'		<button type="button" class="close" data-dismiss="modal">&times;</button>'
		   +'			<a class="firstcolor actormodaltitle" href="'+ base+attendees[id].StashActor_username +'"><div class="modal-title info" style="">' + attendees[id].StashActor_name + '</a></div>'
		   +'	   </div>'
		   +'      <div class="modal-body" style="height:100%;">'
		   +'      		<div class="row">'
           +'      			<div class="DocumentList">'
	           +'           	<ul class="list-inline">';
	           						images = JSON.parse(attendees[id].StashActor_images);
	           						for(var k = 0;k < images.length; k++){
		            				image = images[k];
		            				str = base + "assets/img/actors/" + image;
		            				content += '<li class="DocumentItem">'
		   +'						<a href="'+str+'" data-lightbox="'+attendees[id].StashActor_name+'"><img class="photo" src='+str+' height="100%" width=auto></img></a>' 
		   +'         				</li>';
		        }
		        content += '                 </ul>'
               +'             </div>'
               +'       </div>'

           +'		<div class="row light-padded">'
           +'			<div class="col-lg-5" style="text-align: left;">'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Age:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ age +' yrs</font>'
           +'           	</div>'
           +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Height:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ attendees[id].StashActor_height +' cms</font>'
           +'           	</div>'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Weight:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ attendees[id].StashActor_weight +' kgs</font>'
           +'           	</div>'
           +'             	<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Email:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ attendees[id].StashActor_email +'</font>'
           +'           	</div>'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Phone:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ attendees[id].StashActor_mobile +'</font>'
           +'           	</div>'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">WhatsApp:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ attendees[id].StashActor_whatsapp +'</font>'
           +'           	</div>'
           +'			</div>'
           +'			<div class="col-lg-7"  style="text-align: left;">'
           +'          		<div class="col-lg-12">'
           +'               	<font class="info-medium firstcolor">Recent Experience:</div>' 
           +'				<div class="col-lg-12">'
           +'					<span class="gray">'+ attendees[id].StashActor_tvc_experience +'</font>'
           +'           	</div>'
           +'			</div>'
           +'		</div>'

          

                       +'     </div><!--modal body end -->'
                       
        $("#actor_detail").html(content);
        $('#detailsActor').modal('show');

        
	});

function _calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
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
Array.prototype.contains = function(v) {
    for(var i = 0; i < this.length; i++) {
        if(this[i] === v) return true;
    }
    return false;
};

Array.prototype.unique = function() {
    var arr = [];
    for(var i = 0; i < this.length; i++) {
        if(!arr.contains(this[i])) {
            arr.push(this[i]);
        }
    }
    return arr; 
}
var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
    return str;
}
