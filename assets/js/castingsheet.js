//list of variables
var project_id; //global variable for projectid
var roles=[]; //array to hold details of the roles
var role_names=[]; // just to populate the roles selector
var actor={}; // actor object
var attendees=[]; //list of attendees
var attendees_names=[]; //to populate the table
var todaysdate=$('#date_audition').val(); //today's date

//logic
$(document).ready(function(){

	//defining toggleEdit behaviour
	$(document).on("click", ".toggleEdit", function(){

			var unhide = $(this).attr("data-unhide-id");
			var hide = $(this).attr("data-hide-id");
			$(unhide).removeClass("hidden");
			$(hide).addClass("hidden");

			//console.log(hide, unhide);

		});
	$('#contact').keyup(function(e){
	    if(e.keyCode == 13)
	    {
	        get_actor_details();
	    }
	});
	$.dobPicker({
					daySelector: '#dobday', /* Required */
					monthSelector: '#dobmonth', /* Required */
					yearSelector: '#dobyear', /* Required */
					dayDefault: 'Day', /* Optional */
					monthDefault: 'Month', /* Optional */
					yearDefault: 'Year', /* Optional */
					minimumAge: 0, /* Optional */
					maximumAge:110 /* Optional */
				});

	//calling populating methods
	populate_roles();
	populate_attendees();

	//some project specific variables
	var shoot_start_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
	var shoot_end_date = new Date(0);
	shoot_start_date.setUTCSeconds(project_shoot_begins);
	shoot_end_date.setUTCSeconds(project_shoot_ends);

	//prnting the dates
	$(".shoot_begins").html(shoot_start_date.toDateString());
	$(".shoot_ends").html(shoot_end_date.toDateString());

	//casting sheet ready
});

//populates the roles
function populate_roles()
{	
	data = {
			request: "getRolesInProject",
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
					console.log(roles);
					populate_questions(0);
					//calling populate questions
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
	    role_names[i]=roles[i].StashRoles_role;
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
					if(attendees.length>0)
					{
						for(i=0;i<attendees.length;i++)
						{
							attendees_names[i]=attendees[i].StashActor_name;
							append_attendees(attendees_names[i]);
							$('#loader_atten').fadeOut('fast');
						}
					}
					else
					{
						$('#loader_atten').html('<span class="loader_atten_text">No actor has auditioned yet...</span>');
						console.log("no actor found. Please proceed");	
					}
				}
				else
				{
					
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
	$('#loader_atten').fadeOut('fast');

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
					if(actor.StashActor_import_status==1)
					{
						var import_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
						import_date.setUTCSeconds(actor.StashActor_last_update);
						$("#import_date").html(import_date.toDateString());
						$("#imported_message").removeClass("hidden");
					}
					$("#actor_name_ea").html(actor.StashActor_name);
					$("#tvc_experience").val(actor.StashActor_tvc_experience);
					$("#series_experience").val(actor.StashActor_series_experience);
					$("#web_experience").val(actor.StashActor_web_experience);
					$("#film_experience").val(actor.StashActor_film_experience);
					$("#theatre_experience").val(actor.StashActor_theatre_experience);
					$("#actor_feet").val(Math.floor(actor.StashActor_height/30.48));
					$("#actor_inches").val(Math.round((actor.StashActor_height%30.48)/2.54));
					var utcSeconds = actor.StashActor_dob;
					var date = new Date(utcSeconds*1000);
					//console.log(date);
					var formattedDate = date.getUTCFullYear() + '-' + leftPad((date.getUTCMonth() + 1),2)+ '-' + leftPad((date.getUTCDate()+1),2);
					$("#actor_dob").val(formattedDate);
					$("#dobday").val(leftPad((date.getUTCDate()+1),2));
					$("#dobmonth").val(leftPad((date.getUTCMonth() + 1),2));
					$("#dobyear").val((date.getUTCFullYear()).toString());
					$("#actor_sex").val(actor.StashActor_gender);
					$("#actor_city").val(actor.StashActor_city);
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
	$("#role_audition").addClass("animated infinite pulse");
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
	/*$('select').selectize({					
					sortField: {
						field: 'text',
						direction: 'asc'
					}
					});*/
}
function show_dynamic_questions()
{
	$("#role_audition").removeClass("animated infinite pulse");
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
        	prehtml+='<select class="input_cs answer_dropdown" id="question_'+i+'">'
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
	$('.answer_dropdown').selectize({					
					sortField: {
						field: 'text',
						direction: 'asc'
					}
					});


}
function submit_answers()
{	
	//console.log("called================================================================");
	//changes to the view
	$("#save_actor_response").attr('disabled', 'disabled');
	$("#save_actor_response").html('Saving...');
	$("#not_registered_last_message").removeClass("animated fadeOut");

	//setting variabes in the actor object
	actor.audition_date = todaysdate;
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
			$("#save_actor_response").removeAttr('disabled');
			$("#save_actor_response").html('Submit');
			return;
		}
		question_answer_obj.answer = $("#question_"+i).val();
		actor.questions_answers[i] = question_answer_obj;
	}
	actor.tvc_exp=$("#tvc_experience").val();
	actor.series_exp=$("#series_experience").val();
	actor.film_exp=$("#film_experience").val();
	actor.theatre_exp=$("#theatre_experience").val();
	actor.web_exp=$("#web_experience").val();
	actor.location_city=$("#actor_city").val();

	//validation check 
	if(actor.last_three_years_exp=="" || actor.last_six_months_exp=="" || $("#actor_city").val()=="")
	{
		alert("Please fill in the experiences and location");
		$("#save_actor_response").removeAttr('disabled');
		$("#save_actor_response").html('Submit');
		return;
	}

	//method call to update actors_experience
	update_actor_experience();

	//method call to check whether he has already filled for the same role or not, if not it will insert.
	insert_role_actor();
	
	
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
	var actor_id = actor.StashActor_actor_id_ref;
	var actor_location = actor.location_city;
	var actor_dob = $("#actor_dob").val();
	actor_dob = $("#dobyear").val() + '-' + $("#dobmonth").val()+ '-' + $("#dobday").val();
	var actor_height = Math.round(($("#actor_feet").val()*30.48)+($("#actor_inches").val()*2.54));
	var actor_sex = $("#actor_sex").val();
	data = {request: "updateActorPastExperience",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								actor_tvc_exp: actor.tvc_exp,
	 								actor_series_exp:actor.series_exp,
	 								actor_film_exp: actor.film_exp,
	 								actor_theatre_exp:actor.theatre_exp,
	 								actor_web_exp:actor.web_exp,
	 								actor_dob:actor_dob,
	 								actor_sex:actor_sex,
	 								actor_height:actor_height,
	 								actor_location:actor_location
	 							 }
	 							)};
	 //		console.log(data);

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status==true)
				{	
		//			console.log(response);
				}
				else
				{
		//			console.log("Could not update experience. Please proceed");
				}

			}
		});
}
function insert_actor_answers(i,actor)
{
	var actor_id=actor.StashActor_actor_id_ref;
	//console.log(actor);
	var quest_length=actor.questions_answers.length;
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
	//				console.log(actor);
					if(++i<(quest_length))
					{
						insert_actor_answers(i,actor);
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
	console.log("role_actor");
	var index = $("#role_audition").val();
	var role_id = roles[index].StashRoles_id;
	var actor_id=actor.StashActor_actor_id_ref;
	var actor_name=actor.StashActor_name;
		data = {request: "linkRoleActor",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								role_id: role_id,
	 								project_id: project_id,
	 								audition_date: todaysdate
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
					insert_actor_scenes(index,actor_id);
					hasnotfilled();
					attendees_names.push(actor_name);
					append_attendees(actor_name);
					return 0;
				}
				else
				{
					console.log("Role and actor could not be linked");
					hasfilled();
					return 1;
					
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
function insert_project_actor(id){

	var actor_id=id;
	console.log("here it id"+ actor_id);
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
	if(!isEmail(actor_email))
	{
		alert("Please fill in email address properly.");
		return;
	}
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
					console.log(response);
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
$("#role_based_questions").html("");
//$("#role_audition").html("<option disabled selected value> Select a Role</option>");

$(".input_cs").val("");
$("#save_actor_response").removeAttr('disabled');
$("#save_actor_response").html('Submit');
setTimeout(function(){ 
	$("#not_registered_last_message").addClass("animated fadeOut");
	 }, 9000);
$(".photo_name").removeClass("hidden");
$("#imported_message").addClass("hidden");
}
$("#save_actor_response").removeAttr('disabled');
document.getElementById("date_audition").valueAsDate = new Date();
	
function leftPad(number, targetLength) {
    var output = number + '';
    while (output.length < targetLength) {
        output = '0' + output;
    }
    return output;
}
function hasnotfilled()
{
	if(actor.questions_answers.length>0)
		{
			insert_actor_answers(0,actor);
		}
		//insert_role_actor();
		insert_project_actor(actor.StashActor_actor_id_ref);
		$("body").scrollTop(0);
		show_email_form();
		//$("#contact").addClass("hidden");
		$("#not_registered_last_message").html("Your response has been recorded<br>Note : If you haven't completed your profile on Castiko, please do so as soon as possible.");
		$("#not_registered_last_message").removeClass("hidden");
		$("#not_connected_message").addClass("hidden");
		clean_slate_protocol();
}
function hasfilled()
{
	show_email_form();
	//$("#contact").addClass("hidden");
	$("#not_registered_last_message").html("We found that you had already filled the casting sheet for this role, so your response has been updated.");
	$("#not_registered_last_message").removeClass("hidden");
	$("#not_connected_message").addClass("hidden");
	clean_slate_protocol();
	return ;
}

