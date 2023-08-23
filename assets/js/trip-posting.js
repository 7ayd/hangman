///Fix the date format
console.log("IM HERE DOE")
function dateFix(date){
    var new_date = '';
    var date_range = date.split(',');
    for(date = 0;date < date_range.length;date++){
      var temp_date = date_range[date].split('-');
      new_date+=temp_date[1];new_date+='/';
      new_date+=temp_date[2];new_date+='/';
      new_date+=temp_date[0];
       }

    return new_date
  }

////Getting all the trip data
function submitTrip(){
  // check_links_data()
  // var location = $('input[name="location"]').val()
  // var date_start = dateFix($('input[name="date-start"]').val())
  // var date_end = dateFix($('input[name="date-end"]').val())
  // var pictures = $('input[name="pictures"]').val()
  //
  // var links = $('input[name="links"]').val()
  // var description = $('input[name="description"]').val()
  // var attendees = $('input[name="attendees"]').val()
  // var cost = $("div.new-trip input[name='creation']").val()
  // var groupid = $("input[type='hidden']").val()
  //
  //
  //
  // var combined_dates = date_start.concat('-',date_end)
  //
  //
  //
  // var trip_data = {'location':location,'dates':combined_dates,'links':links,
  // 'description':description,'attendess':attendees,'cost':cost,'groupid':groupid}

  var location = $('div.new-trip input[name="creation"]').val()
  console.log($('input[name="creation"]'))
  var publicstatus = $("input[name='publicid']").val()
  // console.log("THE GROUPID:",groupid)
  // if(!groupid){
  //   groupid = 0
  // }
  // console.log("THE GROUPID2:",groupid)

  var userid = $("input[name='useridhide']").val()


  var trip_data = {'location':location,'publicstatus':publicstatus,'userid':userid}

  console.log("trip_data", trip_data)


  return trip_data


}


function tripPost(something){
//HTML magic

  console.log("Something")
  my_form = new FormData();
  var trip_data = submitTrip()

  $.each(trip_data, function( k, v ) {
    //console.log( "Appending: " + k + ", With: " + v );
    my_form.append(k,v);});

    // $.each($("#file-upload")[0].files, function(i, file) {
    //   my_form.append('file[]', file);
    // });
    $.ajax({
      type: 'POST',
      url:'../../php/trip-start.php',
      crossDomain: true,
      contentType: false,
      processData: false,
      data: my_form,
      success: function(response){
        console.log("Cool it worked")
        console.log(response)
        window.location.replace(`trip-page.php/?tripid=${response}`);
      },
      error: function(){
        console.log('Failling like a puta');
      }

    });

  hideTrip();

  }


function tripPostWish(userid){

}
