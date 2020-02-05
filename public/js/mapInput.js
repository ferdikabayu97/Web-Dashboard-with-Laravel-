function initialize() {
    window.sessionStorage;
    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    
    const locationInputs = document.getElementsByClassName("map-input");
    var a;
    var b;
    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;
    
    
        
    for (let i = 0; i < locationInputs.length; i++) {
        var cookie = document.cookie;

        const input = locationInputs[i];
        const fieldKey = input.id.replace("-input", "");
        const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';
        // alert(a);
        if((!sessionStorage.getItem('lat'))){
            a = -6.914744;
            b = 107.609810;
        // alert("cccc");

        } else
        if((typeof(sessionStorage.getItem('lat'))==='undefined')){
            a = -6.914744;
            b = 107.609810;
        // alert("aaaaa");

        }else{
            
            a = parseFloat(sessionStorage.getItem('lat'));
            b = parseFloat(sessionStorage.getItem('lng'));
        // alert("bbbbb");
            
        }

        const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || a;
        // alert(a);
        const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) ||b;
        sessionStorage.setItem('lat', latitude);
        sessionStorage.setItem('lng', longitude);
        document.cookie = "lat="+sessionStorage.getItem('lat')+";path=/";
        document.cookie = "lng="+sessionStorage.getItem('lng')+";path=/";
        const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 17
        });
        
        const marker = new google.maps.Marker({
            map: map,
            position: {lat: latitude, lng: longitude},
        });

        marker.setVisible(isEdit);

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.key = fieldKey;
        autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
        
       
        
    }

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;
        
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setVisible(false);

            // alert(event.latLng.lat() + ", " + event.latLng.lng());
            var newlat = event.latLng.lat();
            var newlng = event.latLng.lng();
            var newlatlng = event.latLng;
            sessionStorage.setItem('lat', newlat);
            sessionStorage.setItem('lng', newlng);
            document.cookie = "lat="+sessionStorage.getItem('lat')+";path=/";
        document.cookie = "lng="+sessionStorage.getItem('lng')+";path=/";
            setLocationCoordinates("address", newlat,newlng );
            // marker.setVisible(true);
            marker.setPosition(newlatlng);
            marker.setVisible(true);
            // alert("set");
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            marker.setVisible(false);
            const place = autocomplete.getPlace();
            
            geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();
                    sessionStorage.setItem('lat', lat);
                    sessionStorage.setItem('lng', lng);
                    document.cookie = "lat="+sessionStorage.getItem('lat')+";path=/";
        document.cookie = "lng="+sessionStorage.getItem('lng')+";path=/";
                    setLocationCoordinates(autocomplete.key, lat, lng);
                    
                }
                // alert("set");
            });

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                input.value = "";
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            // alert(place.geometry.location);

        });
        
    }
    
}

function setLocationCoordinates(key, lat, lng) {
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
    document.cookie = "lat="+lat+";path=/";
    document.cookie = "lng="+lng+";path=/";
   
}