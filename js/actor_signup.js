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
   function showwork()
   {
    calculateAge();
    actor.dob=$("#dob").val();
    actor.age=$("#age").val();
    actor.sex=$("#sex").val();
    actor.weight=$("#weight").val();
    actor.height=$("#height").val();
    // actor.healthissues=$("#health").val();
    $("#form-div-bio").addClass("animated zoomOutUp");
    $("#form-div-work").addClass("animated zoomInUp");
    $("#form-div-bio").addClass("hidden");
    $("#form-div-work").removeClass("hidden");
    $("#pro-work").removeClass("hidden");
   }
   Dropzone.options.photoUpload={ 
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFilesize:2,
    addRemoveLinks:true,
    maxFiles: 100,
    dictDefaultMessage:'Drag or click here to upload <span style="color:#FFAA3A;">at least one picture</span>.<span class="info-small gray"><li>Ideally, keep the image size less than 1.5MB</li><li>You can add more later</li></span>',
    acceptedFiles:'image/*',
    paramName:'file',
    dictInvalidFileType:'Please stick to image files.',
    // The setting up of the dropzone
    init: function()
    {
      var myDropzone = this;
      $("#save-btn").click(function(e)
      {
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });

      // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
      // of the sending event because uploadMultiple is set to true.
      this.on("sendingmultiple", function(file, xhr, formData)
      {

       formData.append("name", actor.name);
       formData.append("email", actor.email);
       formData.append("password",actor.password);
       formData.append("dob", actor.dob);
       formData.append("weight", actor.weight);
       formData.append("height",actor.height);
       formData.append("phone", actor.contact);
       formData.append("whatsapp", actor.whatsapp);
       formData.append("age", actor.age);
       formData.append("sex", actor.sex);
       formData.append("experience", $('#experience').val());
       formData.append("training", $('#training').val());
       formData.append("agemin",$('#agemin').val());
       formData.append("agemax",$('#agemax').val());
       formData.append("language", $('#language').val());
       formData.append("directorid", $('#director').val());
       formData.append("skills", $('#skills').val());
       var passport=0; 
       console.log(actor);
       if($('#passport').is(":checked"))
       {
          passport=1;
       }
       var actorcard=0; 
       if($('#actorcard').is(":checked"))
       {
          actorcard=1;
       }
       formData.append("passport",passport);
       formData.append("actorcard",actorcard);
       console.log(formData);
      });
      this.on("successmultiple", function(files, response)
      { 
        //console.log(files);
        console.log(response);
        $("#save-btn").hide();
        if(response != "401")
        {
          $("#form-div-work").addClass("animated zoomOutUp");
          $("#success").removeClass("hidden");
          $("#form-div-work").addClass("hidden");
          $("#pro-bar").addClass("hidden");
          $("#success").addClass("animated fadeIn");

          
        }
        else
        { 
          $("#unsuccessful").show();
        }
        // Gets triggered when the files have successfully been sent.
        // Redirect user or notify of success.
      });
      this.on("errormultiple", function(files, response)
      {
        // Gets triggered when there was an error sending the files.
        // Maybe show form again, and notify user of error
      });
  }

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



