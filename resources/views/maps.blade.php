@extends('intellitrace::layouts.app');

@section('content')
    <h2>{{ __('intellitrace::tracing.dashboard') }}</h2>
    <div id="map-canvas" class="google-maps-holder">
    </div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}"></script>

<script type="text/javascript">

    var markers = {!! $visitors !!}

    function initMap() {
      
      var mapOptions = {
        center: new google.maps.LatLng(43.0000, 25.0000),
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById("map-canvas"),
          mapOptions);
          
              // Create the markers ad infowindows.
  for (index in markers) addMarker(markers[index]);
  function addMarker(data) {
    // Create the marker
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(data.latitude, data.longitude),
      map: map,
      title: data.ip
    });
  
    var infowindow = new google.maps.InfoWindow({
      content:  '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h5 id="firstHeading" class="firstHeading">' + data.ip + '</h5>'+
            '<div id="bodyContent">'+
            '<div>{{ __("intellitrace::tracing.city") }}: <b>' + data.city + '</b></div>' +
            '<div>{{ __("intellitrace::tracing.timestamp") }}: <b>' + data.timestamp +'</b></div>' +
            '</div>'+
            '</div>'
    });

    // Open the infowindow on marker click
    google.maps.event.addListener(marker, "click", function() {
      infowindow.open(map, marker);
    });
  
    // Handle the DOM ready event to create the StreetView panorama
    // as it can only be created once the DIV inside the infowindow is loaded in the DOM.
    google.maps.event.addListenerOnce(infowindow, "domready", function() {
      var panorama = new google.maps.StreetViewPanorama(streetview, {
          navigationControl: false,
          enableCloseButton: false,
          addressControl: false,
          linksControl: false,
          visible: true,
          position: marker.getPosition()
      });
    });
  }
    }
    google.maps.event.addDomListener(window, 'load', initMap);
</script>
@endpush