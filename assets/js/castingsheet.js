var project_id;
var roles=[];
var actor=[];
var attendees=[];
var attendees_names=[];
var repopulate=true;
$(document).ready(function(){
$(document).on("click", ".toggleEdit", function(){

		var unhide = $(this).attr("data-unhide-id");
		var hide = $(this).attr("data-hide-id");
		$(unhide).removeClass("hidden");
		$(hide).addClass("hidden");

		//console.log(hide, unhide);

	});
	populate_roles();
	populate_attendees();

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

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{
					roles=JSON.parse(response.data);
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
					else
					{
						return;
					}
					
				}
				else
				{
					console.log("no questions found. Please proceed");
				}

			}
		});
		
}
function populate_attendees()
{
	data = {request: "getActorsInAProject",
	 		data: JSON.stringify({
	 								project_id: project_id, 
	 							 }
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					attendees=JSON.parse(response.data);
					for(i=0;i<attendees.length;i++)
					{
						attendees_names[i]=attendees[i].StashActor_name;
						append_attendees(attendees_names[i]);
					}
				}
				else
				{
					console.log("no actor found. Please proceed");
				}

			}
		});
}
function append_attendees(name){

	var attendee_count=attendees_names.length;
	var newhtml='<div class="attendee_name last_inserted animated fadeInDown" id="attendee_id_'+attendee_count+'">'+name+'</div>';
	$("#list_of_attendees").prepend(newhtml);
	var second_last=attendee_count-1;
	if(second_last>0)
	{
		$('#attendee_id_'+second_last).removeClass("last_inserted");	
	}

}
function get_actor_details()
{
	var contact = $("#contact").val();
	if(contact=="" )
	{
		alert("Please put in your contact details");
		return;
	}
	data = {request: "getActorDetailsByContact",
	 		data: JSON.stringify({
	 								contact: contact, 
	 							 }
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					actor=JSON.parse(response.data);
					$("#actor_name_ea").html(actor.StashActor_name);
					$("#3_years_experience").val(actor.StashActor_three_years_experience);
					$("#6_months_experience").val(actor.StashActor_six_months_experience);
					$("#actor_feet").val(Math.floor(actor.StashActor_height/30.48));
					$("#actor_inches").val(Math.round((actor.StashActor_height%30.48)/2.54));
					var utcSeconds = actor.StashActor_dob;
					var date = new Date(utcSeconds*1000);
					console.log(date);
					var formattedDate = date.getUTCFullYear() + '-' + leftPad((date.getUTCMonth() + 1),2)+ '-' + leftPad((date.getUTCDate()+1),2);
					$("#actor_dob").val(formattedDate);
					console.log(formattedDate);
					$("#actor_sex").val(actor.StashActor_gender);
					var src="http://castiko.com/assets/img/actors/"+actor.StashActor_avatar;
					$("#pro_pic").attr("src",src);
					show_casting_sheet();
					console.log(response);
				}
				else
				{	
					show_new_casting_sheet();
					console.log(response);
					
				}

			}
		});
}

function show_casting_sheet(data)
{
	//$('#date_audition').val(new Date().toDateInputValue());
	var shoot_start_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
	var shoot_end_date = new Date(0);
	shoot_start_date.setUTCSeconds(project_shoot_begins);
	shoot_end_date.setUTCSeconds(project_shoot_ends);
	if(actor.isLinkedWithDirector==0)
	{
		$("#save_actor_response").html("Save and Connect")
		$("#not_connected_message").html("We found that you are not connected with the Casting Director.<br> By filling in the casting sheet you will automatically be added to his database.");
		$("#not_connected_message").removeClass("hidden");
	}
	//populating the forms
	$(".shoot_begins").html(shoot_start_date.toDateString());
	$(".shoot_ends").html(shoot_end_date.toDateString());
	$("#email_form").addClass("animated fadeOut");
	$("#email_form").addClass("hidden");
	$("#casting_sheet_form").addClass("animated fadeIn");
	$("#casting_sheet_form").removeClass("hidden");
	$("#casting_sheet_form").removeClass("fadeOut");
	

	var prehtml="<option disabled selected value> Select a Role</option>";
	for(i=0;i<roles.length ;i++)
	{	
		prehtml+='<option value="'+i+'">'+roles[i].StashRoles_role+'</option>';
	}
	$("#role_audition").html(prehtml);
}
function show_dynamic_questions()
{
	var index=$("#role_audition").val();
	$("#save_actor_response").removeAttr("disabled");
	var role_id=roles[index].StashRoles_id;
	var questions=roles[index].questions;
	var prehtml='';
	for(i=0;i<questions.length ;i++)
	{	
		prehtml+='<div class="row"><div class="label_cs col-sm-6">'
                 +questions[i].StashQuestions_question
                 +'</div>'
                 +'<div class="col-sm-6">';
        if(questions[i].StashQuestions_type==1)
        {
        	prehtml+='<select class="input_cs" id="question_'+i+'">'
        			+'<option disabled selected value> Select a response</option>'
        			+'<option value="Yes">Yes</option>'
        			+'<option value="No">No</option>'
        			+'<option value="Maybe">Maybe</option>'
        			+'</select></div></div>';
        }
        else
        {
        	prehtml+='<input type="text" id="question_'+i+'" class="input_cs"  placeholder="Enter response here"/></div></div>';
        }

                         
	}
	$("#role_based_questions").html(prehtml);


}
function submit_answers()
{	
	$("#save_actor_response").attr('disabled', 'disabled');
	$("#save_actor_response").html('Saving...');
	$("#not_registered_last_message").removeClass("animated fadeOut");
	actor.audition_date = $('#date_audition').val();
	var index = $("#role_audition").val();
	var role_id = roles[index].StashRoles_id;
	actor.audition_role = role_id;
	actor.questions_answers = [];
	var role_questions = roles[index].questions
	for(i=0;i<role_questions.length;i++)
	{	
		var question_answer_obj = {};
		question_answer_obj.question_id = role_questions[i].StashQuestions_id;
		
		if($("#question_"+i).val()=="" || $("#question_"+i).val()==null)
		{
			alert("Please fill all the answers");
			return;
		}
		question_answer_obj.answer = $("#question_"+i).val();
		actor.questions_answers[i] = question_answer_obj;
	}
	actor.last_three_years_exp=$("#3_years_experience").val();
	actor.last_six_months_exp=$("#6_months_experience").val();
	if(actor.last_three_years_exp=="" || actor.last_six_months_exp=="" )
	{
		alert("Please fill in the experiences");
		return;
	}
	update_actor_experience();
	if(actor.questions_answers.length>0)
	{
		insert_actor_answers(0);
	}
	insert_role_actor();
	insert_project_actor();
	$("body").scrollTop(0);
	attendees_names.push(actor.StashActor_name);
	append_attendees(actor.StashActor_name);
	show_email_form();
	//$("#contact").addClass("hidden");
	$("#not_registered_last_message").html("Your response has been recorded<br>Note : If you haven't completed your profile on Castiko, please do so as soon as possible.");
	$("#not_registered_last_message").removeClass("hidden");
	$("#not_connected_message").addClass("hidden");
	clean_slate_protocol();
	
}
function show_email_form(){
	$("#casting_sheet_form").addClass("animated fadeOut");
	$("#casting_sheet_form").addClass("hidden");
	$("#email_form").addClass("animated fadeIn");
	$("#email_form").removeClass("hidden");
	$("#email_form").removeClass("fadeOut");
}
function update_actor_experience()
{
	var actor_id=actor.StashActor_actor_id_ref;
	var actor_dob = $("#actor_dob").val();
	var actor_height = Math.round(($("#actor_feet").val()*30.48)+($("#actor_inches").val()*2.54));
	var actor_sex = $("#actor_sex").val();
	data = {request: "updateActorPastExperience",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								actor_recent_exp: actor.last_six_months_exp,
	 								actor_past_exp:actor.last_three_years_exp,
	 								actor_dob:actor_dob,
	 								actor_sex:actor_sex,
	 								actor_height:actor_height
	 							 }
	 							)};
	 		console.log(data);

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					console.log(response);
				}
				else
				{
					console.log("Could not update experience. Please proceed");
				}

			}
		});
}
function insert_actor_answers(i)
{
	var actor_id=actor.StashActor_actor_id_ref;
	
		data = {request: "linkActorQuestionAnswer",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								question_id: actor.questions_answers[i].question_id,
	 								question_answer:actor.questions_answers[i].answer
	 							 }
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					if(++i<actor.questions_answers.length)
					{
						insert_actor_answers(i);
					}
					console.log(response);
				}
				else
				{
					console.log("Actor answers could not be inserted. Please proceed");
					return;
				}

			}
		});
}
function insert_role_actor(){
	var index = $("#role_audition").val();
	var role_id = roles[index].StashRoles_id;
	var actor_id=actor.StashActor_actor_id_ref;
	
		data = {request: "linkRoleActor",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								role_id: role_id,
	 								project_id: project_id
	 							 }
	 							)};
	 	console.log(data);

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					console.log(response);
					insert_actor_scenes(index,actor_id);
				}
				else
				{
					console.log("Role and actor could not be linked");
				}

			}
		});


}
function insert_actor_scenes(index,actor_id)
{
	var role_id=roles[index].StashRoles_id;
	for(i=0;i<=roles[index].StashRoles_scenes;i++)
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
function insert_project_actor(){

	var actor_id=actor.StashActor_actor_id_ref;
	
		data = {request: "insertActorProject",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								project_id: project_id,
	 							 }
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
					console.log("project and actor tagged");
				}
				else
				{
					console.log("project and actor could not be tagged");
				}

			}
		});


}
function show_new_casting_sheet(){
	$("#new_actor").removeClass("hidden");
	$(".photo_name").addClass("hidden");
	$("#save_actor_response").attr("onclick","submit_new_actor_answers()");
	show_casting_sheet();
	var contact = $("#contact").val();
	if(isEmail(contact)){
		$("#email_new_actor").val(contact);

	}
	else{
		$("#phone_new_actor").val(contact);
	}
}
function submit_new_actor_answers(){
	var actor_name = $("#name_new_actor").val();
	var actor_email = $("#email_new_actor").val();
	var actor_phone = $("#phone_new_actor").val();
	var actor_password = $("#password_new_actor").val();
	var confirm_password = $("#confirm_password_new_actor").val();
	if(actor_name =="" || actor_email =="" || actor_phone=="" || actor_password == "")
	{
		alert("Please fill all the fields");
		return;
	}
	if(actor_password != confirm_password)
	{
		alert("Passwords don't match. Please re-confirm your password");
		return;
	}
	data = {request: "insertNewActor",
	 		data: JSON.stringify({
	 								actor_name: actor_name,
	 								actor_email: actor_email,
	 								actor_phone: actor_phone,
	 								actor_password: actor_password 

	 							 }
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response)
				{	
					actor.StashActor_actor_id_ref=response.data;
					actor.StashActor_name=actor_name;
					actor.last_six_months_exp = $("#6_months_experience").val();
					actor.last_three_years_exp = $("#3_years_experience").val();
					$("#save_actor_response").attr("onclick","submit_answers()");
					$("#new_actor").addClass("hidden");
					submit_answers();
					$("#not_registered_last_message").removeClass("hidden");
				}
				else
				{
					console.log("new actor could not be added");
				}

			}
		});

}
function isEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function clean_slate_protocol(){

//
actor=[];
$("#role_based_questions").html('<option disabled selected value> Select a Role</option>');
$(".input_cs").val("");

setTimeout(function(){ 
	$("#not_registered_last_message").addClass("animated fadeOut");
	 }, 9000);
}
$("#save_actor_response").removeAttr('disabled');
$("#save_actor_response").html('Submit');


	
function leftPad(number, targetLength) {
    var output = number + '';
    while (output.length < targetLength) {
        output = '0' + output;
    }
    return output;
}
