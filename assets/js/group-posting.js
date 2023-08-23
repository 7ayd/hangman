////Getting all the trip data
function submitGroup(){
  var name = $('input[name="Name"]').val()
  var purpose = $('input[name="creation"]').val()



  var group_data = {'Name':name,'Purpose':purpose}


  console.log("group_data", group_data)


  return group_data


}

function groupPost(){
//HTML magic


  my_form = new FormData();
  var group_data = submitGroup()

  $.each(group_data, function( k, v ) {
    //console.log( "Appending: " + k + ", With: " + v );
    my_form.append(k,v);});

    // $.each($("#file-upload")[0].files, function(i, file) {
    //   my_form.append('file[]', file);
    // });





    $.ajax({
      type: 'POST',
      url:'../../php/new-groups.php',
      crossDomain: true,
      contentType: false,
      processData: false,
      data: my_form,
      success: function(response){
        console.log("Cool it worked")
      },
      error: function(){
        console.log('Failling like a puta');
      }

    });

  hideTrip();

  }
