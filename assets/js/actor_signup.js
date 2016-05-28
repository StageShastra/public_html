var actor={};
var toggle_wa=0;
   function showbio()
   {
    actor.name=$("#fullname").val();
    actor.email=$("#email").val();
    actor.contact=$("#contact").val();
    actor.whatsapp=$("#whatsapp").val();
    actor.password=$("#password").val();
    $("#form-div-personal").addClass("animated zoomOutUp");
    $("#form-div-bio").addClass("animated zoomInUp");
    $("#form-div-personal").addClass("hidden");
    $("#form-div-bio").removeClass("hidden");
    $("#pro-bio").removeClass("hidden");

   }
   function showwhatsapp()
   {
    if(toggle_wa%2==0)
    {
      var w = document.getElementById("whatsapp");
      w.type= "text";
      toggle_wa++;
    }
    else
    {
      var w = document.getElementById("whatsapp");
      w.type= "hidden";
      toggle_wa++;
    }
  
   }
   function useasWhatsapp()
   {
    var contact=$("#contact").val();
    $("#whatsapp").val(contact);
   }
   
$("input").tooltip({
 
      // place tooltip on the right edge
      position: "right",
 
      // a little tweaking of the position
      offset: [0, 0],
 
      // use the built-in fadeIn/fadeOut effect
      effect: "none",
 
      // custom opacity setting
      opacity: 0.7
 
      });
var type = ["Donor","Volunteer","Member","Resource","Follow-up","Friend"]; 
var elt = $('#lan > > input');
 elt.tagsinput({
  typeahead: {
    source: type
  }
});

function calculateAge() { // birthday is a date
    var dob = $("#dob").val();
    var Bday = +new Date(dob);
    var ageDifMs = Date.now() - Bday;
    //console.log(dob + "and " + ageDifMs);
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    $("#age").val(Math.abs(ageDate.getUTCFullYear() - 1970));

}



