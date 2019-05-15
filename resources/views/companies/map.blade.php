@extends('templates.map')

@section('content')


<br><br><br><br>

<!-- <form> -->

<!-- </form> -->

<div class="w3-sidebar w3-bar-block" style="width:25%">

  <div class="form-group">
  <label for="userText"></label>
  <textarea class="form-control" rows="2" id="userText"></textarea>
  </div>
  <button onclick="initMap()">Send</button>


<fieldset id="form">

    <br>
    <p>

    <input class="checkbox" id="kinh-doanh" name="kinh-doanh" type="checkbox" value="kinh-doanh" />

    <label for="kinh-doanh">Kinh doanh</label>

    </p>

    <p>

    <input class="checkbox" id="cho-thue" name="cho-thue" type="checkbox" value="cho-thue" />

    <label for="cho-thue">Cho thuê</label>

    </p>

    <p>

    <input class="checkbox" id="cong-ty" name="cong-ty" type="checkbox" value="cong-ty" />

    <label for="cong-ty">Công ty</label>

    </p>



    <p>

    <input class="checkbox" id="nha-o" name="nha-o" type="checkbox" value="nha-o" />

    <label for="nha-o">Nhà ở</label>

    </p>

    <p>

    <input class="checkbox" id="dau-tu" name="dau-tu" type="checkbox" value="dau-tu" />

    <label for="dau-tu">Đầu tư</label>

    </p>

</fieldset>
</div>

  <div style="margin-left:25%">
  <div id="map" style="width: 1000px; height: 500px"></div>
  </div>

<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<script>


  // $(window).load(
    function initMap(){
    var inputUser = document.getElementById("userText").value;
    var markers = new Array();

    var iconSrc = {};
    iconSrc['dau-tu'] = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
    iconSrc['cong-ty'] = 'http://labs.google.com/ridefinder/images/mm_20_green.png';
    iconSrc['cho-thue'] = 'http://labs.google.com/ridefinder/images/mm_20_yellow.png';
    iconSrc['nha-o'] = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
    iconSrc['kinh-doanh'] = 'http://labs.google.com/ridefinder/images/mm_20_gray.png';
    var request = new XMLHttpRequest();
        request.open("GET", "./dataMogi_98.json", false);
        request.send(null)
        var locations = JSON.parse(request.responseText);
    var request = new XMLHttpRequest();
        request.open("GET", "./mapstyle.json", false);
        request.send(null)
        var jsonStyleMap = JSON.parse(request.responseText);
        var HoChiMinh = {lat: 10.7867246, lng: 106.6735853};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: HoChiMinh,
          zoom: 13,
          styles: jsonStyleMap,
        });
    var infowindow = new google.maps.InfoWindow();
      var features = [];
      var request = new XMLHttpRequest();
      var url = "http://35.240.240.251/api/v1/real-estate-extraction";
      request.open("POST", url, false);
      request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      var responseText = document.getElementById('response');
      request.onload = (res) => {
              data = res['target']['response'];
              // document.write(typeof(data));
              data = JSON.parse(data);
              // document.write(data[0].tags);
              for (var i = 0 ; i < data[0].tags.length ; i++){
                    if (data[0].tags[i].type == "addr_street"){
                      features.push(data[0].tags[i].content);
                    }
                    if (data[0].tags[i].type == "addr_ward"){
                      features.push(data[0].tags[i].content);
                    }
                    if (data[0].tags[i].type == "addr_district"){
                      features.push(data[0].tags[i].content);
                    }
                    // if (data[0].tags[i].type == "surrounding_name"){
                    //   features.push(data[0].tags[i].content);
                    // }
                    // if (data[0].tags[i].type == "transaction_type"){
                    //   features.push(data[0].tags[i].content);
                    // }
                    // if (data[0].tags[i].type == "realestate_type"){
                    //   features.push(data[0].tags[i].content);
                    // }
                    if (data[0].tags[i].type == "position"){
                      features.push(data[0].tags[i].content);
                    }
                    if (data[0].tags[i].type == "potential"){
                      features.push(data[0].tags[i].content);
                    }
                    // if (data[0].tags[i].type == "area"){
                    //   features.push(data[0].tags[i].content);
                    // }
                    // if (data[0].tags[i].type == "price"){
                    //   features.push(data[0].tags[i].content);
                    // }
                  }
              // document.write(features);
              // responseText.innerHTML = message;
          };
      // var input = prompt("Input:");
      request.send(JSON.stringify([inputUser]));
      /**
       *
       */
       var request = new XMLHttpRequest();
           request.open("GET", "./dataMogi_98.json", false);
           request.send(null)
           var JSONdata = JSON.parse(request.responseText);
       // document.write(JSON.stringify(JSONdata[0]));
       var matchLocations = [];
       var checkInclude = false;
       var count = 0;
       // alert(features);
       for(var i = 0 ; i < JSONdata.length ; i++){
           for(var j = 0 ; j < features.length ; j++){
               contentInfo = JSONdata[i].contentdata;
               contentInfo = contentInfo.toLowerCase();
               if(contentInfo.includes(features[j])){
                   count++;
               }
           }

           // alert(count);
           if (count == (features.length)){
                checkInclude = true;
           }
           count = 0;
           if(checkInclude == true){
               matchLocations.push(JSON.stringify(JSONdata[i]));
               checkInclude = false;

           }
       }
       var matchLocationsData = "";
       matchLocationsData = "[" + matchLocations + "]"
       matchLocationsData = JSON.parse(matchLocationsData);
       /**
        * Show Match Markers
        */
       var matchMarkers = new Array();
       var matchMarker, i;
       // document.write(locations[0].typeBDS);
       for (i = 0; i < matchLocationsData.length; i++) {
         matchMarker = new google.maps.Marker({
           position: new google.maps.LatLng(matchLocationsData[i].lat, matchLocationsData[i].lng),
           map: map,
           icon: iconSrc[matchLocationsData[i].typeBDS],
           // setVisible: true,
         });
         matchMarkers.push(matchMarker);
         google.maps.event.addListener(matchMarker, 'click', (function(matchMarker, i) {
           return function() {
             infowindow.setContent(matchLocationsData[i].contentdata);
             infowindow.open(map, matchMarker);
           }
         })(matchMarker, i));
       }
    var marker, i;
    // document.write(locations[0].typeBDS);
    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
        map: map,
        icon: iconSrc[locations[i].typeBDS],
      });
      markers.push(marker);
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i].contentdata);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    // == shows all markers of a particular category, and ensures the checkbox is checked ==
      function show(category) {
        for (var i=0; i<locations.length; i++) {
          if (locations[i].typeBDS == category) {
            markers[i].setVisible(true);
          }
        }
         for (var j = 0; j < matchMarkers.length; j++){
               matchMarkers[j].setVisible(false);
          }
      }
      // == hides all markers of a particular category, and ensures the checkbox is cleared ==
      function hide(category) {
        for (var i=0; i<locations.length; i++) {
          if (locations[i].typeBDS == category) {
            markers[i].setVisible(false);
            // matchMarkers[i].setVisible(false);
          }
        }
      }
      function toggleBounce(category) {
        for (var i=0; i<locations.length; i++) {
          if (locations[i].special == 0) {
            markers[i].setAnimation(google.maps.Animation.BOUNCE);
          }
        }
      }
      // == show or hide the categories initially ==
        hide("dau-tu");
        hide("kinh-doanh");
        hide("nha-o");
        hide("cho-thue");
        hide("cong-ty");
        $(".checkbox").click(function(){
            var cat = $(this).attr("value");
            // If checked
            if ($(this).is(":checked"))
            {
                show(cat);
                toggleBounce(cat);
            }
            else
            {
                hide(cat);
            }
          });
      //]]>
      /**
       * Get input type from Users through Mr.JaLong API
       */
    }
    // );
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
        async defer></script>


@stop
