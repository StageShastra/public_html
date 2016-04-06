var skills=[];
var skillstoadd=[];
var languages=[];
var languagestoadd=[];
var phyattributes=[];
var phyattributestoadd=[];
var facattributes=[];
var facattributestoadd=[];
var projects=[];
//Dropzone code
$("#successful").hide();
$("#unsuccessful").hide();
  Dropzone.options.photoUpload={ 
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    addRemoveLinks:true,
    maxFiles: 100,
    acceptedFiles:'image/*',
    paramName:'file',
    dictInvalidFileType:'Please stick to image files.',
    // The setting up of the dropzone
    init: function()
    {
      var myDropzone = this;
      $("#upload-btn").click(function(e)
      {
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });

      // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
      // of the sending event because uploadMultiple is set to true.
      this.on("sendingmultiple", function(file, xhr, formData)
      {

       formData.append("name", $('#aname').val());
       formData.append("email", $('#aemail').val());
       formData.append("dob", $('#adob').val());
       formData.append("facattr", $('#afacattr').val());
       formData.append("phyattr", $('#aphyattr').val());
       formData.append("weight", $('#aweight').val());
       formData.append("height", $('#aheight').val());
       formData.append("phone", $('#aphone').val());
       formData.append("age", $('#aage').val());
       formData.append("sex", $('#asex').val());
       formData.append("experience", $('#aexperience').val());
       formData.append("project", $('#aproject').val());
       formData.append("range", $('#arange').val());
       formData.append("training", $('#atraining').val());
       formData.append("auditions", $('#aauditions').val());
       formData.append("language", $('#alanguage').val());
       formData.append("skills", $('#askills').val());
       //console.log($('#afacattr').val());
      });
      this.on("successmultiple", function(files, response)
      { 
        //console.log(files);
        console.log(response);
        $("#upload-btn").hide();
        if(response != "401")
        {
          $("#successful").show();
          
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
function retrieveData(datatype)
{ 
  $.ajax({
    type: "POST",
    data: {type:datatype},
    url: "resources/getdata.php",
    success: function(res){
     // console.log(res);
      if(res!="")
    {
     if(datatype=="skills")
      {
      
        fill_Skills(res);
      }

    }
    else
    {
      return 0;
    }
     
   }
});
}

function fillModel()
{ 
  var skillsres=retrieveData("skills");
  skills=skillsres;

  var languageres=retrieveData("languages");
  languages=languageres;
 
  var facattributesres=retrieveData("facial_attribute");
  facattributes=facattributesres;

  var phyattributesres=retrieveData("physical_attribute");
  phyattributes=phyattributesres;

}
function fill_Skills(res)
{ var skills=[];
  res=JSON.parse(res);
  for(i=0;i<res.length;i++)
      {
        skills.push(res[i].skill_name);
      }

      console.log(skills);

}
//fillModel();