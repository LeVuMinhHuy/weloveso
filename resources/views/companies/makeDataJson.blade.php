@extends('templates.map')

@section('content')

<br><br><br><br>

<!--     <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"
        async defer></script> -->
<script>

   var request = new XMLHttpRequest();
        request.open("GET", "../../../public/json/mogiExtract_1000.json", false);
        request.send(null)
        var jsonMogiData_0 = JSON.parse(request.responseText);


  var sizejsonMogiData_0 = jsonMogiData_0.length;

  // document.write(sizejsonMogiData_0);

  var dataExtract = [];
  var price = [];
  var dataEachSearch = [];
  var dataEachPrice = [];
  var content = [];
  var latitude = [];
  var longitude = [];

  var i;
  var j;
  var k;

  for (i = 0 ; i < sizejsonMogiData_0 ; i++){
      var sizeExtract = jsonMogiData_0[i].extract.length;
      var c = jsonMogiData_0[i].c;
      content.push(c);


      for(j = 0 ; j < sizeExtract ; j++){
          var sizeTags = jsonMogiData_0[i].extract[j].tags.length;
          for (k=0 ; k < sizeTags ; k++) {


              if (jsonMogiData_0[i].extract[j].tags[k].type == "price") {
                  var dataPrice = jsonMogiData_0[i].extract[j].tags[k].content;
                  price.push(dataPrice);
              }

              // if (jsonMogiData_0[i].extract[j].tags[k].type == "position") {
              //     var dataPosition = jsonMogiData_0[i].extract[j].tags[k].content;
              //     dataExtract.push(dataPosition);
              // }
              
              if (jsonMogiData_0[i].extract[j].tags[k].type == "addr_street") {
                  var dataStreet = jsonMogiData_0[i].extract[j].tags[k].content;
                  dataExtract.push(dataStreet);
              }
              
              if (jsonMogiData_0[i].extract[j].tags[k].type == "addr_ward") {
                  var dataAddrWard = jsonMogiData_0[i].extract[j].tags[k].content;
                  dataExtract.push(dataAddrWard);
              }
              
              if (jsonMogiData_0[i].extract[j].tags[k].type == "addr_district") {
                  var dataAddrDistrict = jsonMogiData_0[i].extract[j].tags[k].content;
                  dataExtract.push(dataAddrDistrict);
              }
              
              if (jsonMogiData_0[i].extract[j].tags[k].type == "surrounding_name") {
                  var dataSurroundingName = jsonMogiData_0[i].extract[j].tags[k].content;
                  dataExtract.push(dataSurroundingName);
              }
          }
      }
      // document.write(price.length);
      // document.write("\n");
      // document.write(price);
      // document.write("<br>");

      var priceText = "";
      var text = "";
      for (var q = 0; q < dataExtract.length ; q++){
          text  += dataExtract[q] + " ";
      }

      for (var q = 0; q < price.length ; q++){
          priceText  += price[q] + " ";
      }

      dataEachSearch.push(text);
      // // document.write(dataExtract.length)

      document.write(i);
      document.write('<br>');
      document.write(text);
      document.write('<br><br>');

      // document.write(text);
      // document.write(" || ");
     

      // document.write(priceText);
      // document.write("<hr>");

      price = [];
      dataExtract = [];

  }


var dataNew = [];


for(var i = 0 ; i < dataNew.length ; i++){
          


    $.get('https://maps.googleapis.com/maps/api/geocode/json?&address='+dataNew[i].contentdata+'&key=AIzaSyAmp0BXpbpC-iPPrEaYxTskw3rKkHKjlZM',function(data){

          // document.write(data.results[0].geometry.location.lat);
          // document.write("<br>");

          // document.write(data.results[0].geometry.location.lng);
          // document.write("<br>");
      },'json');
  
}


// for(var i = 0 ; i < dataJSONExtract.length ; i++){
//     dataJSONExtract[i].contentdata = content[i];
// }

// for(var i = 0 ; i < dataJSONExtract.length ; i++){
//     document.write("{\"contentdata\": " + "\"" +  dataJSONExtract[i].contentdata + "\"" + ",<br>\"lat\": " + dataJSONExtract[i].lat + ",<br>\"lng\": " + dataJSONExtract[i].lng + "}," + "<br><br>" );







</script>





@stop
