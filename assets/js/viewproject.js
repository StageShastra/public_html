var project_id;
var roles=[];
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
	populate_roles();
	

	var shoot_start_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
	var shoot_end_date = new Date(0);
	shoot_start_date.setUTCSeconds(project_shoot_begins);
	shoot_end_date.setUTCSeconds(project_shoot_ends);
	$(".shoot_begins").html(shoot_start_date.toDateString());
	$(".shoot_ends").html(shoot_end_date.toDateString());
});


function populate_roles()
{	
	data = {request: "getRolesInProject",
	 		data: JSON.stringify({
	 								project_id: project_id, 
	 							 }
	 							)};
	 		console.log("fetching roles...");

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{
					roles=JSON.parse(response.data);
					console.log("Roles fetched");
					populate_questions();
					
				}
				else
				{
					console.log("no roles found. Please proceed");
				}

			}
		});

		
}
function populate_questions()
{
	console.log("fetching questions...");
	for(i=0;i<roles.length;i++)
	{
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
			async:false,
			success: function(response){
				if(response.status==true)
				{
					roles[i].questions=JSON.parse(response.data);
					console.log(roles[i]);
					console.log("question "+ (i+1) + " of " + roles.length + " fetched...")
					
				}
				else
				{
					console.log("no questions found. Please proceed");
				}

			}
		});
	}
	console.log("all questions fetched")
	populate_attendees();	
}
function populate_attendees()
{
	data = {request: "getActorsInARole",
	 		data: JSON.stringify({
	 								project_id: project_id, 
	 							 }
	 							)};
	 		console.log("fetching actors...");
		$.ajax({
			url: url,
			type: type,
			data: data,
			async:false,
			success: function(response){
				if(response.status==true)
				{	
					attendees=JSON.parse(response.data);
					console.log(attendees.length +" actors fetched.");
					get_actors_answers();
				}
				else
				{
					console.log("no actor found. Please proceed");
				}

			}
		});
}

function get_actors_answers()
{
	console.log("fetching actor's answers...");
	for(f=0;f<attendees.length;)
	{
		if(get_question_details(f,attendees[f].StashRoleActorLink_role_id_ref)==1)
		{
			
			f++;

		}
	}	
	console.log("all actor's answers fetched");
	populate_videos();
}

function get_question_details(index,role_id)
{

	for(var i=0;i<roles.length;i++)
	{	
		if(roles[i].StashRoles_id==role_id)
		{
			attendees[index].questions=[];
			insert_actor_scenes(role_id,attendees[index].StashActor_actor_id_ref,roles[i].StashRoles_scenes);
			if(attendees[index].StashRoleActorLink_role_id_ref==role_id)
			{
				attendees[index].role_name=roles[i].StashRoles_role;	
			}
			var questions_answers={};
			console.log("linking actor's answer with questions... " +roles[i].questions.length);
			for(k=0;k<(roles[i].questions).length && roles[i].questions.length!=0;k++)
			{
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
						async:false,
						success: function(response){
							if(response.status==true)
							{	
								(questions_answers.question).answer=JSON.parse(response.data);
								console.log("question " + (k+1) + " of " + roles[i].questions.length + "linked...")
								return 1;
								
							}
							else
							{
								console.log("no answers found. Please proceed");
							}

						}
					});
				
				attendees[index].questions[k]=questions_answers;
			}
			console.log("all question and answers mapped for actor " + (index+1));
			
		}
	}
	return 1;
}
function populate_videos()
{
	console.log("fetching videos...");
	for(i=0;i<attendees.length;i++)
	{
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
						async:false,
						success: function(response){
							if(response.status==true)
							{	
								attendees[i].videos=JSON.parse(response.data);
								console.log("videos " + (i+1) + " of " + attendees.length + "linked...")
								
							}
							else
							{
								console.log("no videos found. Please proceed");
							}

						}
					});
	}
	console.log("all videos fetched.");
	console.log(attendees);
	populate_table();
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
						async:false,
						success: function(response){
							if(response.status==true)
							{	
								console.log("actor video set");
							}
							else
							{
								console.log("no answers found. Please proceed");
							}

						}
					});
}



function populate_table()
{

                
	var dyn_html='<thead>'
             +' <th class="star"><i class="fa fa-star-o" id="shortlist_all" aria-hidden="true" onclick="show_shortlisted()"></i></th>'
             +' <th>Profile</th>'
             +' <th data-sort="string">Name <font class="sortbuttons"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></font></th>'
             +' <th data-sort="string">Role <font class="sortbuttons"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></font></th>'
             +'	<th>Intro</th>';
             for(i=0;i<max_scenes;i++)
             {
             	dyn_html+='<th>Scene '+ (i+1) +'</th>';
             }
             dyn_html+=' <th>Notes</th>'
             +'</thead>';
             dyn_html+='<tbody>';
	for(i=0;i<attendees.length;i++)
	{
		
             var shortlist_string=shortlist_star(attendees[i]);
             console.log(shortlist_string);
             dyn_html+= shortlist_string+''
             +'  <td class="profile" style="vertical-align:middle-top;">'
             +'    <div class="center"><img src="http://localhost:8888/public_html/assets/img/actors/'+attendees[i].StashActor_avatar+'" class="showDetails pro_pic" ></div>'
             +'  </td>'
             +'  <td class="role_name">'
             +		attendees[i].StashActor_name
             +'  </td>'
             +'  <td class="role_name">'
             +		attendees[i].role_name
             +'  </td>';
             var video_string=video_embed(attendees[i]);
             //console.log(video_string);
             dyn_html+= video_string+''
             var notes_string=show_notes(attendees[i]);
             console.log(shortlist_string);
             dyn_html+= notes_string+''
             +'</tr>';
	}
	 dyn_html+='</tbody>';
	$(".actors").html(dyn_html);

}

//ancillary functions
function isEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function video_embed(actor)
{
	console.log("video embed called");
	var string='';
	for(t=0;t<actor.videos.length;t++)
	{
		if(actor.videos[t].StashSceneVideo_video=="")
		{
			string+='<td class="video"><div id="video_"'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit" data-hide-id="#cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"data-unhide-id="#input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"><span id="cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="click_to_add">Click to add video</span>'
					   +'<div class="embed-responsive embed-responsive-4by3 hidden" id="embed_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'">'
	                   +'	<iframe class="embed-responsive-item" id="iframe_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" src=""></iframe>'
	                   +'</div>'
					   +'<input class="input_cs hidden" id="input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" placeholder="Paste youtube video link" onpaste="setTimeout(function(){ show_video('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)">'
					   +'</div></td>' ;


		}
		else
		{
			string+='<td class="video">'
	                +'    <div class="embed-responsive embed-responsive-4by3">'
	                +'      <iframe id="iframe_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="embed-responsive-item" src="'+actor.videos[t].StashSceneVideo_video+'" allowfullscreen></iframe>'
	                +'    </div>'
	                +'<button id="edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-unhide-id="#input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit go_button">Edit</button>'
	                +'<input class="input_cs hidden" value="'+actor.videos[t].StashSceneVideo_video+'" id="input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" onpaste="setTimeout(function(){ show_video('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)">'
	                +'<button id="update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="button" onclick="setTimeout(function(){ show_video('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)" class="go_button toggleEdit hidden" data-unhide-id="#edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" >Go</button>'
	                +' </td>';
		}
	}
	if(actor.videos.length<max_scenes)
	{
		for(h=actor.videos.length;h<=max_scenes;h++)
		{
			string+='<td class="video">'
	                +'<span class="click_to_add">Not applicable</span>'    
	                +' </td>';
		}
	}
	return string;
}
function show_notes(actor)
{
		var t=0;
		var string="";
		if(actor.StashRoleActorLink_notes==null)
		{
			string+='<td class="notes">'
					   +'<div id="notes_"'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit" data-hide-id="#notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"data-unhide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'">'
					   +'<span id="notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="click_to_add">Click to add notes</span>'
					   +'<input class="input_cs hidden" id="notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" placeholder="Add notes here" onfocusout="setTimeout(function(){ save_notes('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)">'
					   +'</div></td>' ;


		}
		else
		{
			string+='<td class="notes"><div id="notes_"'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit" data-hide-id="#notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"data-unhide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'"><span id="notes_cta_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="click_to_add">'+actor.StashRoleActorLink_notes+'</span>'
					   +'<input class="input_cs hidden" id="notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="text" placeholder="Add notes here" value="'+actor.StashRoleActorLink_notes+'" ><br>'
			
	                +'<button id="notes_edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#notes_edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-unhide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#notes_update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" class="toggleEdit go_button">Edit</button>'
	               
	                +'<button id="notes_update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" type="button" onclick="setTimeout(function(){ save_notes('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+t+'); },4)" class="go_button toggleEdit hidden" data-unhide-id="#notes_edit_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" data-hide-id="#notes_input_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+',#notes_update_btn_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'_'+t+'" >Go</button>'
	                +'</div></td>';
		}
	
	return string;
}
function shortlist_star(actor)
{
	var string='';
	
		if(actor.StashRoleActorLink_shortlist_status=="0")
		{
			string+= '  <tr id="tr_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" class="unshortlisted"><td class="star">'
             		+'    <i class="fa fa-star-o" id="star_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" onclick="shortlist_actor('+actor.StashActor_actor_id_ref+','+actor.StashRoleActorLink_role_id_ref+','+1+')" aria-hidden="true"></i>'
             		+'  </td>' ;


		}
		else
		{
			string+= '  <tr id="tr_'+actor.StashActor_actor_id_ref+'_'+actor.StashRoleActorLink_role_id_ref+'" class="shortlisted"><td class="star">'
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
				 		console.log(data);

					$.ajax({
						url: url,
						type: type,
						data: data,
						async:false,
						success: function(response){
							if(response.status==true)
							{	
								if(status==1)
								{
									console.log(response);
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
									console.log(response);
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
	console.log(youtube_link);
	var video_id = getId(youtube_link);
	var embed_string = "https://www.youtube.com/embed/"+video_id;
	var iframe_id='iframe_'+actor_id+'_'+role_id+'_'+index+'';
	var embed_id= 'embed_'+actor_id+'_'+role_id+'_'+index+'';
	$('#'+iframe_id).attr("src",embed_string);

	console.log('#'+iframe_id);
	$('#'+embed_id).removeClass("hidden");
	data = {request: "setActorVideo",
				 		data: JSON.stringify({
				 								actor_id: actor_id,
				 								role_id: role_id,
				 								index: index,
				 								video: embed_string
				 							 }
				 							)};
				 		console.log(data);

					$.ajax({
						url: url,
						type: type,
						data: data,
						async:false,
						success: function(response){
							if(response.status==true)
							{	console.log(response);
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
						async:false,
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
function insert_actor_scenes(role_id,actor_id,scenes)
{
	
	for(i=0;i<=scenes;i++)
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
			async:false,
			success: function(response){
				if(response.status==true)
				{	
					console.log("Scene and actor linked");
					
				}
				else
				{
					console.log("Scene and actor could not be linked");
				}

			}
		});
	}
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

