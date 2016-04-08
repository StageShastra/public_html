
$('document').ready(function()
{ 
     /* validation */
    /* validation */
    
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
        url  : '../resources/login_actor.php',
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
      $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").alert('close');
                });
    }

    /* login submit */
});