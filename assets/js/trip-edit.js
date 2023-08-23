function editTrip(object){
  console.log(object)
  console.log(object.id)
  console.log($('.trip-page').children())
  console.log($('.trip-page').children().length)
  var trip_button = $('#trip-but').html();
  if(trip_button != 'Cancel'){
  $('.new-trip').css('display','flex');
  $('#trip-but').html('Cancel')
  }
  else{
    hideTrip();
  }
}

//Hiding the create trip
function hideTrip(){
  $('.new-trip').css('display','none');
  $('#trip-but').html('Edit Trip');
}

function fade_out(){
  $('trip-title').css('display','none')
  $('.trip-title').fadeOut(.01)
}

function fade_in(){
  $('.trip-title').fadeIn(50)
  $('.trip-title').css('display','active')

}


function nextButton(id){
  console.log("Before handling input: ",id)


  var current_place_in_menu = $('div.new-trip .trip-title')


  var current_title = current_place_in_menu.attr('id')

  handle_input(current_title)

  //verify_first_data()

  if($(".new-trip").hasClass("apply-shake")){

    setTimeout(function() {
      $( ".new-trip" ).removeClass("apply-shake");
    }, 2000);

    return
  }

  fade_out()

  var order_dict = {
    'location':['Where are you going?','dates'],
    'dates': ['When is this happening?','description'],
    // 'links':['Dump Links Below','description'],
    'description':['Tell your group a bit more','attendees'],
    'attendees':["Maximum number of people",'end'],
    //'cost':['How much is this going to cost?','end']
}





  var next_item_id = order_dict[current_title][1]
  var next_item_question = order_dict[next_item_id][0]

   // Store it
  checkInputType(next_item_id)
  retrieve_input(next_item_id)
  current_place_in_menu.html(next_item_question)

  current_place_in_menu.attr("id",next_item_id)


  if(current_title == "description"){
    $('.next').css('display','none')
    $('.submit').show()
  }

  $('.back').show()


  fade_in()


}


//Back Button
function backButton(){
  fade_out()
  $('.submit').hide()
  var reverse_order_dict = {
    'location':['Where are you going?','end'],
    'dates': ['When is this happening?','location'],
    // 'links':['Dump Links Below','dates'],
    'description':['Tell your group a bit more','dates'],
    'attendees':['How many people are going as of now?','description'],
    //'cost':['How much is this going to cost?','attendees']
}
    var current_place_in_menu = $('div.new-trip .trip-title')
    var current_title = current_place_in_menu.attr('id')
    var prev_item_id = reverse_order_dict[current_title][1]
    var prev_item_question = reverse_order_dict[prev_item_id][0]
    handle_input(current_title) //Save what you currently have
    checkInputType(prev_item_id)
    retrieve_input(prev_item_id) //Get the old data
    current_place_in_menu.html(prev_item_question)
    current_place_in_menu.attr("id",prev_item_id)

    if(current_title == "dates"){
      $('.back').css('display','none')
    }
    $('.next').show()
  fade_in()


}


function verify_first_data(id){
  //var first_data = $('input[name="location"]').val()
  var location_data = $('input[name="location"]').val()
  if(!location_data){
    $( ".new-trip" ).addClass( "apply-shake" );
  }
}

function handle_input(id){
  // console.log($('textarea#linksinput'))
  // console.log($('textarea#linksinput').val())
  console.log($('textarea#descriptioninput'))
  console.log($('textarea#descriptioninput').val())
  if(id == 'dates'){
    var start_date = $("#trip-date-start").val()
    var end_date = $("#trip-date-end").val()
    $('#saved-date-start').val(start_date)
    $('#saved-date-end').val(end_date)
  }

  // if(id == 'links'){
  //   var links = $('textarea#linksinput').val()
  //   $(`input[name=${id}]`).val(filled_with)
  // }
  //

  var filled_with = $("div.new-trip input[name='creation']").val()
  if(id == 'description'){
    console.log("Get description")
    filled_with = $('textarea#descriptioninput').val()

  }

  $(`input[name=${id}]`).val(filled_with)
  $("div.new-trip input[name='creation']").val("")

}



function retrieve_input(id){


  if(id == 'dates'){

    var start_fill = $('#saved-date-start').val()
    var end_fill = $('#saved-date-end').val()
    $("input[name = 'start-creation']").val(start_fill)
    $("input[name = 'end-creation']").val(end_fill)

  }

  if(id != 'dates'){
  var fill_with = $(`input[name=${id}]`).val()
  $("div.new-trip input[name='creation']").val(fill_with)
}
}




function checkInputType(id){

  $('#date-to').remove()
  console.log(id)
  var current_input_type = $("div.new-trip input[name='creation']")
  if(id == "dates"){
    var new_input_type = $("<input type='date' />").attr({ name: 'start-creation',id:'trip-date-start'})
    new_input_type.insertBefore(current_input_type);
    $("<p>To<p>").attr({id: 'date-to'}).insertAfter(new_input_type)

    $("<input type='date' />").attr({ name: 'end-creation',id:'trip-date-end'}).insertBefore(current_input_type);
    current_input_type.remove()
  }
  if(id != "dates"){
    current_input_type.remove()
    $("input[name='start-creation']").remove()
    $("input[name='end-creation']").remove()
    $("<input type='text' /> ").attr({ name: 'creation',class:'trip-input',id:`${id}input`}).insertAfter($('.trip-title'))
  }



  if(id == 'description' ){ //id == 'links' || ){
    $('input[name="creation"]').hide();
    $("<textarea name='Text1' cols='40' rows='5'></textarea>").attr({style: 'height:200px', name: 'creation',class:'text-input',id:`${id}input`}).insertAfter($('.trip-title'))
  }
  // if(id != 'links'){
  //   $("#linksinput").remove()
  //
  // }

  if(id != 'description'){
    $("#descriptioninput").remove()

  }

}



// function check_links_data(){
//   console.log("Whats inside: ",$('input[name="links"]').val())
// }

function check_date_data(){
  console.log("What's saved",$('#saved-date-start').val(),$('#saved-date-end').val())
}



function editAll(){



}


function editLocation(){

}

function editDates(){

}

function editAttendees(){

}

function editCost(){
  //load up a trip cost calculator
  //when top div is closed, close this one as well

}

function editDescription(){

}


//TRIP SUBMITTING

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
function submitTrip(tripid){
  // check_links_data()
  var location = $('input[name="location"]').val()
  var date_start = dateFix($('input[name="date-start"]').val())
  var date_end = dateFix($('input[name="date-end"]').val())
  // var links = $('input[name="links"]').val()
  var description = $('input[name="description"]').val()
  var attendees = $('input[name="creation"]').val()
  //var cost = $("div.new-trip input[name='creation']").val()
  //var groupid = $("input[type='hidden']").val()



  var combined_dates = date_start.concat('-',date_end)



  var trip_data = {'location':location,'dates':combined_dates,//'links':links,
  'description':description,'attendess':attendees,'tripid':tripid}



  console.log("trip_data", trip_data)


  return trip_data


}

function tripPost(tripid){
//HTML magic

  my_form = new FormData();
  var trip_data = submitTrip(tripid)

  $.each(trip_data, function( k, v ) {
    console.log( "Appending: " + k + ", With: " + v );
    my_form.append(k,v);});

    // $.each($("#file-upload")[0].files, function(i, file) {
    //   my_form.append('file[]', file);
    // });




    //
    $.ajax({
      type: 'POST',
      url:'../../php/trip-edit.php/updateData',
      crossDomain: true,
      contentType: false,
      processData: false,
      data: my_form,
      success: function(response){
        console.log("Cool it worked")
        window.location.replace(`trip-page.php?tripid=${tripid}`);

      },
      error: function(){
        console.log('Failling like a puta');
      }

    });

  hideTrip();

  }

//Adding links

function toggleInput(object){
  var obj_id = object
  if(obj_id == 'linksinputsubmit'){
    $('#linksinputs').toggle()
    $('#linksubmit').toggle()
  }
  if(obj_id == 'peopleinputsubmit'){
    $('#peoplesinput').toggle()
    $('#peoplesubmit').toggle()
  }
}


function submitLink(object,userid){
  var new_data
  console.log("HEY:",userid)
  var tripid = $('#tripid').val()
  var userid = $('#uname').val()

  if(object.id == 'peoplesubmit'){
    var new_data = $('#peoplesinput').val()
    var people = $('#peoplesinput').val()
    $('#peoplesinput').val("")
    toggleInput('peopleinputsubmit')


  }
  if(object.id == 'linksubmit'){
    var new_data = $('#linksinputs').val()
    var links = $('#linksinputs').val()
    $('#linksinputs').val("")
    toggleInput('linksinputsubmit')
  }


  if(new_data){
    console.log(new_data)
    console.log('closing')
    toggleInput(object)
    my_form = new FormData();
    my_form.append('tripid',tripid)
    my_form.append('links',links)
    my_form.append('people',people)
    my_form.append('username',userid)



    // Make Ajax query
    // refresh the page?
    $.ajax({
      type: 'POST',
      url:'../../php/trip-edit.php/peoplelinks',
      crossDomain: true,
      contentType: false,
      processData: false,
      data: my_form,
      success: function(response){
        console.log("Cool it worked")
        window.location.replace(`trip-page.php?tripid=${trip_id}`);
      },
      error: function(){
        console.log('Failling like a puta');
      }

    });

  }
}

function addPeople(){
  console.log()
}

function submitPeople(){

}

function addPictures(){
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

//Image submit
function submitImage(){
  console.log("Submit that image");
  var trip_id = $('#tripid').val()
  my_form = new FormData();

  var image_file = $("#image-upload")[0].files;
  var image_url = $('#url-upload').val();

  if(image_file){
    console.log("Handling files")
    $.each($("#image-upload")[0].files, function(i, file) {
      console.log("hey")
      console.log(i,file)
      my_form.append('file[]', file);
    });
  }
  if(image_url){
    var passin_image = image_url
    my_form.append('passin_url_image',passin_image)
    if(image_url.slice(0,4) != 'http'){
      alert('Check Image URL and Try Again')
      throw Exception;
    }
  }
  console.log(passin_image)
  my_form.append('tripid',trip_id)


  $.ajax({
    type: 'POST',
    url:'.../../php/upload-image.php/trip-image',
    crossDomain: true,
    processData: false,
    contentType: false,
    data: my_form,
    success: function(response){
      console.log(response)
      console.log("Something happened")
      window.location.replace(`trip-page.php?tripid=${trip_id}`);


    },
    error: function(){
      console.log('Failling like a puta');
    }

  });

}


function displayEdits(){
  $('.editable').toggle()
}

function calcCost(){
  $('.cost-calc').toggle()

}



var activity_dict = {}
$( ".cost-input" )
  .focusout(function() {

    console.log($(`#${this.id}`).val())
    var id = this.id
    var val = $(`#${this.id}`).val()
    console.log(id,val)
    var int_to_add = parseInt(val)
    var string_rep = int_to_add.toString()
    console.log(int_to_add,string_rep)
    if(string_rep =='NaN'){
      var total = 0
      delete activity_dict[id]
    }
    if(string_rep != 'NaN'){
      var total = 0
      activity_dict[id] = val
      for (var key in activity_dict){

        console.log(key,activity_dict[key])
        total += parseInt(activity_dict[key])


        console.log(total)
        $('#calc-total').html(`Total: ${total}`)
  }
    }
    console.log("Starting for loop with",activity_dict)





  })


function calcSubmit(){
  var total = $('#calc-total').html()
  var actual_total = total.split(" ")[1]
  var tripid = $('#tripid').val()
  console.log("Works here",actual_total,tripid)

  my_form = new FormData();
  my_form.append('total',actual_total)
  my_form.append('tripid',tripid)




  $.ajax({
    type: 'POST',
    url:'../../php/trip-edit.php/calcsubmit',
    crossDomain: true,
    contentType: false,
    processData: false,
    data: my_form,
    success: function(response){
      console.log("Cool it worked")
      window.location.replace(`trip-page.php?tripid=${tripid}`);
    },
    error: function(){
      console.log('Failling like a puta');
    }

  });
  $('.cost-calc').toggle()
}
