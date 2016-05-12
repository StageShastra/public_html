
$('document').ready(function()
{ 
     
    $("#gotcodediv").hide();
    $("#error-alert").hide();



    $("#forgot-form").submit(function(event){
    // cancels the form submission
    event.preventDefault();
    submitForm();
    });



    $("#btn-gotcode").click(function(event){
    event.preventDefault();
    $("#getcodediv").hide();  
    $("#gotcodediv").show();
    });


    /* login submit */
    function submitForm()
    {  
      var data = $("#forgot-form").serialize();
      $.ajax({
        type : 'POST',
        url  : 'resources/forgot.php',
        data : data,
        success :  function(response)
        {  
          console.log(response) ;
          if(response=="200")
          {
            console.log("Success");
            $("#getcodediv").hide();  
            $("#gotcodediv").show();
          }
          else if(response=="404")
          {
            console.log("No one found");
          }
          else{ 
            showAlert();
          }
     }
     });
   
    return false;
  }
  
  //password change
  $("#pwd-form").submit(function(event){
    // cancels the form submission
    event.preventDefault();
    pwdForm();
    });
    /* login submit */
    function pwdForm()
    {  
      var data = $("#pwd-form").serialize();
     // console.log(data);
      $.ajax({
        type : 'POST',
        url  : 'resources/forgot.php',
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
      $("#error-alert").show();
      $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").alert('close');
                });
    }

    /* login submit */
});