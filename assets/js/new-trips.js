function flipcard(object){
  console.log("Here",object)
  var class_name = object.className
  console.log(class_name)
  // console.log(object.className)
  // console.log($('.indie-trips .back-card'))
  // console.log($('.indie-trips .front-card'))
   console.log($(`.back-card#${class_name}`))
   console.log($(`.front-card#${class_name}`))
  // $(`.indie-trips .back-card#${class_name}`).show()
  // $(`.indie-trips .front-card#${class_name}`).hide()
  $(`.back-card#${class_name}`).toggleClass('hidden')
  //$(`.back-card#${class_name}`).toggle()
  $(`.front-card#${class_name}`).toggle()
  // var other_card = $(`.indie-trips .back-card${object.className}`)
  // var card = $(`.indie-trips .front-card#${object.className}`)

  // $('.indie-trips .front-card').toggle()
  // $('.indie-trips .back-card').toggle()

  //console.log(card,other_card)
  // other_card.toggle();
  // card.toggle();





}

// function tripPage(object){
//   console.log("HERE")
//   var tripid = object.id
//   //Create a big div that takes up entire page
//   console.log(tripid)
//   $.ajax({
//     type: 'POST',
//     url:'/trip-page.php',
//     data: tripid,
//     success: function(response){
//       console.log('We back')
//       tripReset()
//     },
//     error: function(){
//       console.log('Failling like a puta');
//     }
//
//   });
// }

function showMore(object){
  var class_name = object.className
  $(`.more-info#${class_name}`).toggle()
}




//Bringing up the creating trip
function makeTrip(){

  console.log("IM ALIVE")
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
  $('#trip-but').html('New trip');
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



function nextButton(id){
  console.log("Before handling input: ",id)
  //check_links_data()
  // console.log($('div.new-trip .trip-title'))

  var current_place_in_menu = $('div.new-trip .trip-title')
  //console.log(current_place_in_menu)
  // Select different h4's, get its ID as well
  console.log($("input[name='location']").val())
  console.log($("input[name='creation']").val())
  console.log("Right here",$(`input[name=${id}]`).val())

  var current_title = current_place_in_menu.attr('id')
  console.log(current_place_in_menu, current_title)
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
     'dates': ['When is this happening?','links'],
    // 'pictures':['Add pictures!','links'],
    // 'links':['Any links to add?','description'],
     'description':['Tell your group a bit more','attendees'],
     'attendees':["Who's commmitted so far?",'end'],
    //'cost':['How much is this going to cost?','end']
}





  var next_item_id = order_dict[current_title][1]
  var next_item_question = order_dict[next_item_id][0]

   // Store it
  checkInputType(next_item_id)
  retrieve_input(next_item_id)
  current_place_in_menu.html(next_item_question)

  current_place_in_menu.attr("id",next_item_id)


  if(current_title == "attendees"){
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
    //'pictures':['Add pictures!','dates'],
    'links':['Any links to add?','dates'],
    'description':['Tell your group a bit more','links'],
    'attendees':['Whos commmitted so far? <p class = "trip-format"> John; Abdul; Othman </p>','description'],
    'cost':['How much is this going to cost?','attendees']
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
  //if id from trips or if id from groups
  console.log("Handling input for: ",id)
  // console.log($(`input[name=${id}]`).val())
  // console.log($("input[name='creation']").val())
  // console.log($(".new-trip input[name='creation']").val())
  // console.log($(".new-group input[name='creation']").val())
  //check_links_data()
  if(id == 'dates'){
    var start_date = $("#trip-date-start").val()
    var end_date = $("#trip-date-end").val()
    $('#saved-date-start').val(start_date)
    $('#saved-date-end').val(end_date)
  }
  if(id == 'pictures'){

    var full_file = $('#file-upload')[0].files
    console.log(full_file)

  }
  console.log("In here")

  if(id != 'links'){
    var filled_with = $("div.new-trip input[name='creation']").val()


    $(`input[name=${id}]`).val(filled_with)
  }
  $("div.new-trip input[name='creation']").val("")
  console.log($("input[name='location']").val())
  console.log($("div.new-trip input[name='creation']").val())
  console.log("Right here",$(`input[name=${id}]`).val())

  //console.log($("input[name='creation']").val())

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
