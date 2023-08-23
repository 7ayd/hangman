
var div_count = 0;
$(document).ready(function(){
  //make an ajax call when its ready

  GroupGet();


})



////////Trips JS//////////
function GroupGet(){
  console.log('We are out indeed here');
  $.ajax({
    type: 'GET',
    url:'../../php/new-groups.php',
    crossDomain: true,
    complete: function(response){
      var response = response.responseText;
      console.log(response)
      var cleanedResponse = tripResponse(response);
      tripPopulate(cleanedResponse);
    },
    error: function(){
      console.log('Failling like a puta');
    }
});
}


function tripResponse(dbResponse){
  console.log(dbResponse)
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








function tripPopulate(content_array){
  console.log('INFO',content_array)
      for(el = content_array.length-1; el >= 0; el--){
        var groupid = content_array[el][0];
        var name = content_array[el][1];
        var description = content_array[el][2];
        console.log(name,name.length)
        console.log('name:',name,'groupid:',groupid,'description:',description)

        // <div class = 'indie-trips' id = 'atrip'>
        //   <div class = 'trip-info'>
        //     <h2 class = 'location'>Oregon</h2>
        //   </div>
        //   <div class = 'bottom-info' id = "China">
        //     <progress value=100 max=10000></progress>
        //     <span class = 'total-val'>100 of 10000</span>
        //     <span class = 'pledge'> <input type = 'button' value = 'Pledge' class = 'pledge-b' id = 'noidea' onclick = "makeDonation(this)"> </input> </span>
        //   </div>
        // </div>

        $('div.trips').append(`
        <div class = 'group-box' id = ${name}>

          <div class = 'trip-info'>
            <h2 class = 'location' id = '${groupid}' onclick = "pullupgroup(document.getElementById('${groupid}').id)"> ${name} </h2>

          <p class = "blurb"> ${description} </p>


          </div>

        </div>`)

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
  function pullupgroup(id){

      var group_name = $(`#${id}`).html()
  
      window.open(`http://localhost:8000/group-template.php?name=${group_name}`);

    }
