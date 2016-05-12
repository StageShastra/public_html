$('document').ready(function()
{  
   $("#success").hide();
   console.log("should be hidden");
     /* validation */
    /* validation */
    $("#signup-form").submit(function(event){
    // cancels the form submission
    event.preventDefault();
    submitForm();
    });
    /* signup submit */
    function submitForm()
    {  
      var data = $("#signup-form").serialize();
      $("#sign-upbtn").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sending...');
      $.ajax({
        type : 'POST',
        url  : 'resources/signup.php',
        data : data,
        success :  function(response)
        {  
          console.log(response);
          if(response=="200"){
            console.log("Success");
          $("#form-div").hide();
          $("#success").show();
          }
          else{ 
            console.log("Faliure");
          $("#sign-upbtn").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Please Try Again');
          }
     }
     });
   
    return false;
  }

    /* login submit */
});
function alerst(){
  alert("i am clicked");
}