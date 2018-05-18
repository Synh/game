@extends('layouts.master')

@section('content')
{{-- css map --}}
    {{-- <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>


    <h3>Edit your Map</h3>

    <input id="pac-input" class="control" type="text" placeholder="Start typing here...">
    <div id="map"></div>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP_-HropVYvFZQ2UzNThUaE3mB5McDB2g&callback=initMap"></script>
    <script>
        // Set the default bounds for the autocomplete search results.
        // This will bias the search results to Sydney, Australia.
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-33.8902, 151.1759),
            new google.maps.LatLng(-33.8474, 151.2631));

        var options = {
            bounds : defaultBounds
        };

        // Get the HTML input element for the autocomplete search box
        var input = document.getElementById('pac-input');
        map.control[google.maps.ControlPosition.TOP_LEFT].push(input);








      // In the following example, markers appear when the user clicks on the map.
      // Each marker is labeled with a single alphabetical character.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 5;
        // for (var labelIndex = 0; labelIndex < 20; labelIndex++) {
        //     console.log(labelIndex);
        // }

        function initialize() {
            var originPosition = { lat: -39.59, lng: -66.36 };
            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: originPosition
            });

            // This event listener calls addMarker() when the map is clicked.
            google.maps.event.addListener(map, 'click', function(event) {
            addMarker(event.latLng, map);
            });

            // Add a marker at the center of the map.
            addMarker(originPosition, map);
        }

        // Adds a marker to the map.
        function addMarker(location, map) {
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            var marker = new google.maps.Marker({
            position: location,
            label: labels[labelIndex++ % labels.length],
            map: map
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>


 --}}



    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    </style>


    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.60, lng: -58.38},
          zoom: 8,
          mapTypeId: 'terrain'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

// {{--
//       var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//       var labelIndex = 0;

//       function initialize() {
//         var bangalore = { lat: 12.97, lng: 77.59 };
//         var map = new google.maps.Map(document.getElementById('map'), {
//           zoom: 12,
//           center: bangalore
//         });

//         // This event listener calls addMarker() when the map is clicked.
//         google.maps.event.addListener(map, 'click', function(event) {
//           addMarker(event.latLng, map);
//         });

//         // Add a marker at the center of the map.
//         addMarker(bangalore, map);
//       }

//       // Adds a marker to the map.
//       function addMarker(location, map) {
//         // Add the marker at the clicked location, and add the next-available label
//         // from the array of alphabetical characters.
//         var marker = new google.maps.Marker({
//           position: location,
//           label: labels[labelIndex++ % labels.length],
//           map: map
//         });
//       }

//       google.maps.event.addDomListener(window, 'load', initialize); --}}


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP_-HropVYvFZQ2UzNThUaE3mB5McDB2g&libraries=places&callback=initAutocomplete"
         async defer></script>















@endsection
