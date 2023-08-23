
var div_count = 0;
$(document).ready(function(){
  //make an ajax call when its ready

  tripGet();


})





//Setting if image url or file for bulletin board page
function image_select(clicked_id){

    if(clicked_id=='image-url'){
      $('#my-file').hide();
      $('.cheese').hide();
      $('#my-image').show();
      $('#image-file').removeClass('image-clicked');
      $('#image-url').addClass('image-clicked');
      $('#my-file').val('');
      $('#output').hide();
    }
    if(clicked_id=='image-file'){
      $('#my-image').hide();
      $('#my-file').show();
      $('.cheese').show();
      $('#image-url').removeClass('image-clicked');
      $('#image-file').addClass('image-clicked');
      $('#my-image').val('');
      $('#output').show();


    }
}

//Dynamically add the new div
function takeitfromthetop(){
  $('div.forum-post').empty()
  makeGet();
  $('.navbut').hide();
}

//Get data from DB to populate bulletin board page
function makeGet(){
  console.log('Coming from front page');
  $.ajax({
    type: 'GET',
    url: 'response.php/main',
    crossDomain: true,
    complete: function(response){
      var parsedResponse = parseResponse(response.responseText);
      contentPopulate(parsedResponse);
      div_count = parsedResponse.length;
    },
    error: function(){
      console.log('Failling like a puta');
    }
});
}

//Parse data from messages DB
function parseResponse(dbResponse){

  var responseArray = dbResponse.split(';');

  responseArray = responseArray.slice(0,-1);
  let subVal = [];
  for(i = 0; i < responseArray.length; i++){
    responseArray[i] = responseArray[i].replace(/{|}|"/gm,'');
    subVal.push(responseArray[i].split(','));
  }
  return subVal;

  }



function contentPopulate(content_array){


    for(el = content_array.length-1; el >= 0; el--){

      var content = content_array[el].slice(0,-1);

      var text = content_array[el][0]
      var date = content_array[el][1]
      var image_path = content_array[el][2]


      if(image_path!='noimage'){
      $('div.forum-post').append(`<div class = 'post'>
      <div class = 'post-info'>
      <span class = 'post-id'>  </span><span class = 'post-date'>${date}</span>
      </div>
      <div class = 'post-content' id = 'div-${el}'></div>
      <img src = ${image_path} class = 'nice-pic' id = 'div-${el}'> </img>
      </div>`)

    }
      else{
        $('div.forum-post').append(`<div class = 'post'>
        <div class = 'post-info'>
        <span class = 'post-id'>  </span><span class = 'post-date'>${date}</span>
        </div>
        <div class = 'post-content' id = 'div-${el}'></div>
        </div>`)

      }

      for(entry = 1; entry < content.length; entry++){
        $(`div.post-content#div-${el}`).append(text)
      }
  }

}

function makePost(){

  var post_status = $('.navbut').html();
  if(post_status != 'Minimize'){

  $('.new-file').css('display','flex');
  $('.new-file').css('flex-direction','column');
  $('.navbut').html('Minimize')
  }
  else{
    hidePost();
  }
}

function hidePost(){
  $('.new-file').css('display','none');
  $('.navbut').html('New Post');
}



function makeAjax(){
//HTML magic
  var text_content = $('div.new-post').html();
  text_content = text_content.replace(/["']/g, '');
  text_content = text_content.replace(/&nbsp;/g, '')


  var image_file = $("#my-file")[0].files[0];

  var image_url = $('#my-image').val();

  if(image_file){
    var passin_image = image_file

  }
  if(image_url){
    var passin_image = image_url
    if(image_url.slice(0,4) != 'http'){
      alert('Check Image URL and Try Again')
      throw Exception;
    }
  }


  my_form = new FormData();
  my_form.append('text_content',text_content)
  my_form.append('passin_image',passin_image)


  var pass_data = [text_content,passin_image]


  $.ajax({
    type: 'POST',
    url:'response.php/main',
    crossDomain: true,
    processData: false,
    contentType: false,
    data: my_form,
    success: function(response){
      takeitfromthetop();


    },
    error: function(){
      console.log('Failling like a puta');
    }

  });

hidePost();

}

////////Trips JS//////////
function tripGet(){
  console.log('We are out here');
  $.ajax({
    type: 'GET',
    url:'../../php/new-trips.php',
    crossDomain: true,
    complete: function(response){
      var response = response.responseText;
      console.log(response)
      var cleanedResponse = tripResponse(response);
      console.log(cleanedResponse)
      tripPopulate(cleanedResponse);
    },
    error: function(){
      console.log('Failling like a puta');
    }
});
}


function tripResponse(dbResponse){

  var responseArray = dbResponse.split('\n').slice(0,-1);

  let subVal = [];
  for(i = 0; i < responseArray.length; i++){
    responseArray[i] = responseArray[i].replace(/["'*+?^${}()|[\]\\]/gm,'');
    subVal.push(responseArray[i].split('!'));
    }


  return subVal;

  }

  function infoButt(info,place){

      if (!text){
        var text = $(`.summary-div#${place}`).html()
        console.log('Do we come back here',text)
        $(`.indie-trips#${place}`).prepend(`<div class = summary-div id = ${place}><strong> More Info:</strong> ${info}</div>`);
        $(`.summary-div#${place}`).css('display','active')
    }
      if(text){
        console.log('It\'s already up',text)
        $(`.summary-div#${place}`).empty()
      }
  }


function makeDonation(origin){

  var object_origin = `.pledge-b#${origin.id}`
  if($(object_origin).attr('type') == 'button'){
  $(object_origin).attr('type','text').attr('value','').attr('placeholder','Amount:Your Name')
  $(object_origin).css('background','none')
  $(`.bottom-info#${origin.id}`).append(`<input type = "button" value = "Contribute" onclick = "valUpdate('${object_origin}','${origin.id}')">`)
}

}





function tripPopulate(content_array){
  console.log('INFO',content_array)
  // content_array = content_array.reverse();
      for(el = content_array.length-1; el >= 0; el--){
        var place = content_array[el][0];
        var date = content_array[el][1];
        var links = content_array[el][2];
        var summary = content_array[el][3];
        var attendees = content_array[el][4];

        var total = content_array[el][5];
        var tripid = content_array[el][6];
        var numimages = content_array[el][7];
        var min = 0
        var random_front = Math.floor(Math.random() * (numimages - min)) + min;
        var random_back = Math.floor(Math.random() * (numimages - min)) + min;


        // var img_path = content_array[el][5];
        // var sub_total = content_array[el][6];
        console.log('TripID:',tripid,'Date:',date,'Place:',place,'Links: ',links,'Attendees:',attendees,'Summary:',summary,'Total:',total,'NumImages:',numimages)


        var count = 1;
        var tripid_mod = 'trip-' + tripid
        $('div.trips').append(`
          <div class = 'indie-trips'>
            <div class = 'front-card' id = ${tripid_mod}>
              <div class = 'trip-info'>
                <div class='squish'>
                  <span onclick = showMore(this) class = ${tripid_mod}> <i class="fa fa-info-circle info-butt"></i></span>
                  <h2 class = 'location'><a class = 'center' href = /trip-page.php?tripid=${tripid}> ${place} </a></h2>
                </div>
                <span class = 'date'>${date}</span>
              <div id = ${tripid_mod} class = 'more-info'>
                <p>${summary} </p>
                <span class = 'total-val'> Trip Cost: ${total}</span>
                <br>
                <span class = 'people-going'>Capacity: ${attendees}</span>
              </div>
                <img class = 'display-image' src = "trip-images/${tripid}/trip-image${random_front}.png"  onerror='this.style.display = "none"'">
              </div>
            </div>
          <!--  <div class = 'back-card hidden' id = ${tripid_mod}>
              <div class = 'trip-info'>
                <span class = 'date'>${date}</span>
                <span onclick = flipcard(this) class = ${tripid_mod}> <i class="fa fa-info-circle info-butt"></i></span>
              </div> -->
        <!--  <img class = 'back-image' src = "trip-images/${tripid}/trip-image${random_back}.png"  onerror='this.style.display = "none"'"> -->
          <!--    <p> Description: ${summary} </p>
              <span class = 'total-val'> Trip Cost: ${total}</span>
              <span class = 'people-going'>Capacity: ${attendees}</span>
            </div> -->
          </div>
          `)
          count = count + 1;

        }
    }


  function dateFix(date){
    var new_date = '';
    var date_range = date.split(',');
    for(date = 0;date < date_range.length;date++){
      var temp_date = date_range[date].split('-');
      new_date+=temp_date[1];new_date+='-';
      new_date+=temp_date[2];new_date+='-';
      new_date+=temp_date[0];
      if(new_date.length<=10){new_date+=' to '}
    }
    return new_date
  }




  function tripReset(){

      $('div.trips').empty()
      tripGet();
    }



    function valUpdate(origin,loc){
      var info = $(origin).val()
      console.log('Place: '+loc)
      console.log('Need to add: '+info)

      var amount = info.match(/\d+/g)
      var person = info.match(/[a-z]+/gi);


      $(origin).val('')
      //make query to update amount in
      var query_vals = [amount[0],person[0],loc]
      $.ajax({
        type: 'POST',
        url:'response.php/valAdd',
        data: {queryArray: query_vals},
        success: function(response){
          console.log('We back')
          tripReset()
        },
        error: function(){
          console.log('Failling like a puta');
        }

      });


    }
