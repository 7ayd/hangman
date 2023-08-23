function build_user_greeting(name){
  $('.user-hello').val("Hello, "+name)
}
$( document ).ready(function() {
    console.log( "ready!" );
    console.log($('.user-hello'))

});


function log_out(){
  $.ajax({
        url:'php/logout.php',
        type:'get',
        success:function(){
            //whatever you wanna do after the form is successfully submitted
            //if data == grant_access push to new state using someID
              console.log("Redirect to home page")
              window.location.replace("/index.php");


        }
    });
}

function edit_profile(){
  //loop through
  console.log($('input.form-control'))
  console.log()
  var length = $('input.form-control').length
  $('.form-control').toggle()
  $('.user-control').toggle()

}

function update_profile(){
  event.preventDefault();
  var form_control = $('input.form-control')
  var form_group = $('.form-group label')
  var my_form = new FormData();
  for(i=0; i < form_control.length; i++){
    console.log(form_group[i].textContent)
    console.log(form_control[i].value)
    my_form.append(form_group[i].textContent,form_control[i].value)
  }

  my_form.append('About_Me',$('textarea.form-control').val())
   $.ajax({
     url:'php/updateprofile.php',
     type:'post',
     processData: false,
    contentType: false,
     data: my_form,
      success:function () {
        console.log("Profile Updated")
        window.location.replace("userpage.php");
      }
   });
}


function expand_image(){
  console.log("Ready to upload picture");
  console.log($('.avatar'))
  $('.other-pic').toggle()
  $('.big-avatar').toggle()
  $('.image-hide').toggle()

}

//Click Functions

$('#imgFile').click(function() {
   if($('#imgFile').is(':checked')) {
     $('.custom-file-upload').toggle()
     $('#url-upload').toggle()
   }
});


$('#urlRadio').click(function() {
   if($('#urlRadio').is(':checked')) {
     $('.custom-file-upload').toggle()
     $('#url-upload').toggle()
    }
});


//Image SUBMITTING

function submitImage(){
  console.log("Submit that image");
  var user_id = $('#userid').val()
  my_form = new FormData();
  var image_file = $("#file-upload")[0].files[0];
  var image_url = $('#url-upload').val();
  if(image_file){
    var passin_image = image_file
    my_form.append('passin_file_image',passin_image)
  }
  if(image_url){
    var passin_image = image_url
    my_form.append('passin_url_image',passin_image)
    if(image_url.slice(0,4) != 'http'){
      alert('Check Image URL and Try Again')
      throw Exception;
    }
  }
  my_form.append('userid',user_id)

  $.ajax({
    type: 'POST',
    url:'.../../php/upload-image.php/profile-pic',
    crossDomain: true,
    processData: false,
    contentType: false,
    data: my_form,
    success: function(response){
      console.log(response)
      console.log("Something happened")
      window.location.replace("userpage.php");


    },
    error: function(){
      console.log('Failling like a puta');
    }

  });

}
