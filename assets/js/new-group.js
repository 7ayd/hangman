
//Bringing up the creating trip
function makeGroup(){

  var trip_button = $('#trip-but').html();
  console.log(trip_button)
  if(trip_button != 'Cancel'){


  $('.new-group').css('display','flex');
  $('#trip-but').html('Cancel')
  }
  else{
    hideTrip();
  }
}



//Hiding the create trip
function hideTrip(){
  $('.new-group').css('display','none');
  $('#trip-but').html('New Group');
}



function fade_out(){
  $('trip-title').css('display','none')
  $('.trip-title').fadeOut(.01)
}


function fade_in(){
  $('.trip-title').fadeIn(50)
  $('.trip-title').css('display','active')

}
//next button - will replace content inside the div with new contentType



function nextButton(object){
  console.log("Before handling input")
  //check_links_data()
  var current_place_in_menu = $('.trip-title')
  var current_title = current_place_in_menu.attr('id')
  console.log(current_place_in_menu,current_title)
  handle_input(current_title)

  // if($(".new-trip").hasClass("apply-shake")){
  //
  //   setTimeout(function() {
  //     $( ".new-trip" ).removeClass("apply-shake");
  //   }, 2000);
  //
  //   return
  // }

  // fade_out()

  console.log(current_place_in_menu,current_title)
  var order_dict = {
    'Name':['Group Name?','Purpose'],
    'Purpose': ['What brings you together?','end'],
}

  var next_item_id = order_dict[current_title][1]
  var next_item_question = order_dict[next_item_id][0]

   // Store it
  //checkInputType(next_item_id)
  retrieve_input(next_item_id)
  current_place_in_menu.html(next_item_question)

  current_place_in_menu.attr("id",next_item_id)
  console.log(current_place_in_menu,current_title)

  if(current_title == "Name"){
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
    'Name':['Group Name','end'],
    'Purpose': ['What Brings You Together?','Name'],
}
    var current_place_in_menu = $('.trip-title')
    var current_title = current_place_in_menu.attr('id')
    var prev_item_id = reverse_order_dict[current_title][1]
    var prev_item_question = reverse_order_dict[prev_item_id][0]
    handle_input(current_title) //Save what you currently have
    checkInputType(prev_item_id)
    retrieve_input(prev_item_id) //Get the old data
    current_place_in_menu.html(prev_item_question)
    current_place_in_menu.attr("id",prev_item_id)

    if(current_title == "Purpose"){
      $('.back').css('display','none')
    }
    $('.next').show()
  fade_in()


}


function verify_name_data(){
  var name_data = $('input[name="Name"]').val()
  if(!name_data){
    $( ".new-group" ).addClass( "apply-shake" );
  }
}

function handle_input(id){
  console.log("Handling input of: ",id)
  //check_links_data()
  // if(id == 'dates'){
  //   var start_date = $("#trip-date-start").val()
  //   var end_date = $("#trip-date-end").val()
  //   $('#saved-date-start').val(start_date)
  //   $('#saved-date-end').val(end_date)
  // }
  // if(id == 'pictures'){
  //
  //   var full_file = $('#file-upload')[0].files
  //   console.log(full_file)
  //
  // }
  console.log("In here")

  //if(id != 'links'){
    console.log("In everything but links")
    var filled_with = $("input[name='creation']").val()
    console.log(filled_with)


    $(`input[name=${id}]`).val(filled_with)

  //}
  $("input[name='creation']").val("")


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
  $("input[name='creation']").val(fill_with)
}
}




function checkInputType(id){

  $('#date-to').remove()

  var current_input_type = $("input[name='creation']")
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

  if(id == 'pictures'){
    $('.custom-file-upload').show()
  }
  if(id != 'pictures'){
    $('.custom-file-upload').hide()
  }

  if(id == 'links'){
    $('.another').show()
  }
  if(id != 'links'){
    $('.another').hide()
  }

}

function add_another(){

  var current_link = $('#linksinput').val()
  var saved_links = $('input[name="links"]').val()
  if(saved_links.length > 0){
    saved_links+= " "; saved_links += current_link
  }
  else{
    saved_links+=current_link
  }
  $('input[name="links"]').val(saved_links)

}

function check_links_data(){
  console.log("Whats inside: ",$('input[name="links"]').val())
}

function check_date_data(){
  console.log("What's saved",$('#saved-date-start').val(),$('#saved-date-end').val())
}
