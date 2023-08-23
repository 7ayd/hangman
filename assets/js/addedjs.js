function login_box(){
  close_sign()
  $('.login-box').css('display','block')
}
function forgot_pass(){
  close_out()
  $('.pass-box').css('display','block')
};

function open_sign(){
  close_out()
  $('.card-body').css('display','block')
}

function close_out(){
  $('.login-box').css('display','none');
}

function close_sign(){
  $('.card-body').css('display','none')
}

function close_pass(){
  $('.pass-box').css('display','none');
}


function checkPassword(){
  console.log("Check password and Redirect to users page")
  event.preventDefault();
  $.ajax({
        url:'php/login.php',
        type:'post',
        data:$('#signin').serialize(),
        success:function(data){
            //whatever you wanna do after the form is successfully submitted
            console.log("Form submitted")
            console.log(data,typeof(data))
            //if data == grant_access push to new state using someID
            console.log(data,data.split(";"))
            var cleaned_data = data.split(";")
            if(cleaned_data[0] == 'True'){
              console.log("Redirect to users page")

              window.location.replace("userpage.php");

            }
            else(
              console.log("Password msitmatch")
            )
        }
    });
}


function betaLogIn(){
  console.log("Check password and Redirect to users page")
  var email = "guest@guest.guest";
  var password = "guest";
  my_form = new FormData;
  my_form.append("email",email);
  my_form.append("pass",password);
  event.preventDefault();
  $.ajax({
        url:'php/login.php',
        type:'post',
        crossDomain: true,
        processData: false,
        contentType: false,
        data:my_form,
        success:function(data){
            //whatever you wanna do after the form is successfully submitted
            console.log("Form submitted")
            console.log(data,typeof(data))
            //if data == grant_access push to new state using someID
            console.log(data,data.split(";"))
            var cleaned_data = data.split(";")
            if(cleaned_data[0] == 'True'){
              console.log("Redirect to users page")

              window.location.replace("userpage.php");

            }
            else(
              console.log("Password msitmatch")
            )
        }
    });
}


function signUp(){
  event.preventDefault();
  console.log("Here we are")
  if(true){
    $.ajax({
          url:'php/signup.php',
          type:'post',
          data:$('#sign-up').serialize(),
          success:function(data){
              if(data != 'False'){
                window.location.replace("userpage.php");
              }
              else(
                console.log("Password mismatch")
              )
          }
      });
}
else{
  alert("Passwords dont match")
}
}

function forgotmyPass(){
  console.log("Send an email to this address with a link to a forgot pass page")
}

function newPassword(){
  event.preventDefault();
  var pass = $('input[name = "pass"]').val()
  var pass2 = $('input[name="pass-confirm"]').val()
  var user_email_link = $('input[name="email"]').val()
  if(user_email_link){
    user_email_link = user_email_link.split('/');
    var email = user_email_link[user_email_link.length - 1];
  }

  console.log(pass,pass2,email)
  my_form = new FormData();
  my_form.append("email",email)
  my_form.append("pass",pass)
  my_form.append("pass-confirm",pass2)
  if(pass === pass2){
    console.log("passwords match")
    $.ajax({
          url:'php/forgotpass.php',
          type:'POST',
          data:my_form,
          crossDomain: true,
          processData: false,
          contentType: false,
          success:function(data){
            console.log("Success")
              // if(data != 'False'){
              //   window.location.replace("userpage.php");
              // }
              // else(
              //   console.log("Password mismatch")
              // )
          },
          error: function (request, error) {
            console.log("ERROR");
            alert(" Can't do because: " + error);
          },
      });
  }
  else{
    alert("Passwords dont match")
  }



}


function forgotPass(){

  var user_email = $('input[name="passf-email"]').val()
  my_form = new FormData();
  my_form.append("email",user_email)

  console.log(user_email)
  console.log(my_form)
  $.ajax({
    url:'php/sendmail.php',
    data: my_form,
    type: 'post',
    crossDomain: true,
    processData: false,
    contentType: false,
    success: function(data){
      console.log("great success")
      close_pass();
    }
  })

};
