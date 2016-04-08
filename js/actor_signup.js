var actor={};

   function showbio()
   {
    actor.name=$("#fullname").val();
    actor.email=$("#email").val();
    actor.contact=$("#contact").val();
    actor.password=$("#password").val();
    $("#form-div-personal").addClass("animated zoomOutUp");
    $("#form-div-bio").addClass("animated zoomInUp");
    $("#form-div-personal").addClass("hidden");
    $("#form-div-bio").removeClass("hidden");
   }
   function showwork()
   {
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
   }
   Dropzone.options.photoUpload={ 
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFilesize:2,
    addRemoveLinks:true,
    maxFiles: 100,
    dictDefaultMessage:'Drag or Click here to upload your pictures.<span class="info-small gray">(Please keep image size <1.5mb for faster upload)',
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
       formData.append("age", actor.age);
       formData.append("sex", actor.sex);
       formData.append("experience", $('#experience').val());
       formData.append("range", $('#age-range').val());
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
