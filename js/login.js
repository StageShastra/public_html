function show_casting()
{
  $("#actor").addClass("hidden");
  $("#castingdirector").removeClass("hidden");
}
function show_actor()
{
  $("#castingdirector").addClass("hidden");
  $("#actor").removeClass("hidden");
}
$('document').ready(function()
{ 
     /* validation */
    /* validation */
    $("#error-alert").hide();
    $("#login-form").submit(function(event){
    // cancels the form submission
    event.preventDefault();
    submitForm();
    });
    /* login submit */
    function submitForm()
    {  
      var data = $("#login-form").serialize();
      $.ajax({
        type : 'POST',
        url  : 'resources/login.php',
        data : data,
        success :  function(response)
        {  
          console.log(response) ;
          if(response=="200"){
            console.log("Success");
          setTimeout(' window.location.href = "home.php"; ',1000);
          }
          else{ 
            showAlert();
          }
     }
     });
   
    return false;
  }
    function showAlert() 
    {
      $("#error-alert").removeClass("hidden");
      $("#error-alert").show();
      $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").addClass("hidden");
                });
      
    }
    $("#actor_login-form").submit(function(event){
      var url = "resources/ajax.php",
      type = "POST",
      data = {},
      formdata = {};

    // cancels the form submission
    //console.log("Called");
    var that = this;
    var email = $("input[name='email']").val();
    var password = $("input[name='actor_password']").val();

    data = {request: "ActorLogin", data: JSON.stringify({ email: email, password: password })};
    console.log(data);
    $.ajax({
      url: url,
      type: type,
      data: data,
      success: function(response){
        if(response.status){
          $("#signup-error").removeClass("text-danger").addClass("text-success");
          $("input", $(that)).val("");

          window.location.href = "actor/act.php";
        }
        console.log(response.status);
        $("#signup-error").html(response.message).show(500).delay(3000).hide(500);
        //console.log(response);
      }
    });

    return false;
  });
    function showAlert() 
    {
     $("#error-alert").removeClass("hidden");
      $("#error-alert").show();
      $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").addClass("hidden");
                });
    }

    /* login submit */
});