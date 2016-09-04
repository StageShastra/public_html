var project_id;
var roles=[];
var actor=[];
var attendees=[];
var attendees_names=[];

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
			async:false,
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
	console.log("called with name "+name);
	var attendee_count=attendees_names.length;
	var newhtml='<div class="attendee_name last_inserted animated fadeInDown" id="attendee_id_'+attendee_count+'">'+name+'</div>';
	$("#list_of_attendees").prepend(newhtml);
	var second_last=attendee_count-1;
	console.log("attendee_id_"+second_last+" removed.");
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
			async:false,
			success: function(response){
				if(response.status==true)
				{	
					actor=JSON.parse(response.data);
					console.log(actor);
					$("#actor_name_ea").html(actor.StashActor_name);
					$("#3_years_experience").val(actor.StashActor_three_years_experience);
					$("#6_months_experience").val(actor.StashActor_six_months_experience);
					var src="http://localhost:8888/public_html/assets/img/actors/"+actor.StashActor_avatar;
					$("#pro_pic").attr("src",src)
					show_casting_sheet();
				}
				else
				{
					console.log("no actor found. Please proceed");
				}

			}
		});
}
function populate_roles()
{	console.log("here");
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
					populate_questions();
				}
				else
				{
					console.log("no actor found. Please proceed");
				}

			}
		});

		
}
function populate_questions()
{
	for(i=0;i<roles.length;i++)
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
			async:false,
			success: function(response){
				if(response.status==true)
				{
					roles[i].questions=JSON.parse(response.data);
				}
				else
				{
					console.log("no questions found. Please proceed");
				}

			}
		});
	}	
}
function show_casting_sheet(data)
{
	//$('#date_audition').val(new Date().toDateInputValue());
	var shoot_start_date = new Date(0); // The 0 there is the key, which sets the date to the epoch
	var shoot_end_date = new Date(0);
	shoot_start_date.setUTCSeconds(project_shoot_begins);
	shoot_end_date.setUTCSeconds(project_shoot_ends);
	
	//populating the forms
	$(".shoot_begins").html(shoot_start_date.toDateString());
	$(".shoot_ends").html(shoot_end_date.toDateString());
	$("#email_form").addClass("animated fadeOut");
	$("#email_form").addClass("hidden");
	$("#casting_sheet_form").addClass("animated fadeIn");
	$("#casting_sheet_form").removeClass("hidden");
	$("#casting_sheet_form").removeClass("fadeOut");
	

	var prehtml=$("#role_audition").html();
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
	console.log(roles);
	console.log(questions);
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
	insert_actor_answers();
	insert_role_actor();
	insert_project_actor();
	$("body").scrollTop(0);
	attendees_names.push(actor.StashActor_name);
	append_attendees(actor.StashActor_name);
	show_email_form();
	
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
	data = {request: "updateActorPastExperience",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								actor_recent_exp: actor.last_six_months_exp,
	 								actor_past_exp:actor.last_three_years_exp
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
					console.log(response);
				}
				else
				{
					console.log("no actor found. Please proceed");
				}

			}
		});
}
function insert_actor_answers()
{
	var actor_id=actor.StashActor_actor_id_ref;
	for(i=0;i<actor.questions_answers.length;i++)
	{
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
			async:false,
			success: function(response){
				if(response.status==true)
				{	
					console.log(response);
				}
				else
				{
					console.log("no actor found. Please proceed");
				}

			}
		});

	}
	
}
function insert_role_actor(){
	var index = $("#role_audition").val();
	var role_id = roles[index].StashRoles_id;
	var actor_id=actor.StashActor_actor_id_ref;
	
		data = {request: "linkRoleActor",
	 		data: JSON.stringify({
	 								actor_id: actor_id,
	 								role_id: role_id,
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
					console.log(response);
				}
				else
				{
					console.log("Role and actor linked");
				}

			}
		});


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
			async:false,
			success: function(response){
				if(response.status==true)
				{	
					console.log(response);
				}
				else
				{
					console.log("project and actor tagged");
				}

			}
		});


}