<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formgooglemap', 'xaddresses');

class FormGoogleMap extends XoopsFormElementTray
{
    /**
     * FormGoogleMap::FormGoogleMap()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param array('lat'=> ,'lng' =>, 'zoom'=>) $value 
     */
    function FormGoogleMap($caption, $name, $value = NULL, $style = 'width:100%;height:200px;border:1px solid black;')
    {
        static $isGoogleMapJsLoaded = false;
        if(!$isGoogleMapJsLoaded ) {
            $isGoogleMapJsLoaded = true;
            $js = "<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>";
        
        }
        $this->XoopsFormElementTray($caption, '<br />');

        $lat = (is_array($value) && isset($value['lat'])) ? $value['lat'] : 45; // default lat
        $lng = (is_array($value) && isset($value['lng'])) ? $value['lng'] : 10; // default lng
        $zoom = (is_array($value) && isset($value['zoom'])) ? $value['zoom'] : 8; // default lat
        $search = '';
        //$kml = (is_array($value) && isset($value['kml'])) ? $value['kml'] : ''; // default kml


        $html = "<div id='{$name}GoogleMap' style='{$style}'>GOOGLE MAP HERE</div>";
           
        $html.= "
    <script type='text/javascript'>
    var map;
    var geocoder = new google.maps.Geocoder();
    var homeLatLng = new google.maps.LatLng({$lat}, {$lng});
    var homeZoomLevel = {$zoom};
    var newLatLng = homeLatLng;

    /**
     * The HomeControl adds a control to the map that simply  returns the user to homeLatLng. 
     * This constructor takes the control DIV as an argument.
     */
    function HomeControl(controlDiv, map) {
        // Set CSS styles for the DIV containing the control
        // Setting padding to 5 px will offset the control from the edge of the map
        controlDiv.style.padding = '5px';
        
        // Set CSS for the control border
        var controlUI = document.createElement('DIV');
        controlUI.style.backgroundColor = 'white';
        controlUI.style.borderStyle = 'solid';
        controlUI.style.borderWidth = '2px';
        controlUI.style.cursor = 'pointer';
        controlUI.style.textAlign = 'center';
        controlUI.title = '" . _FORMGOOGLEMAP_RESET_DESC . "';
        controlDiv.appendChild(controlUI);
        
        // Set CSS for the control interior
        var controlText = document.createElement('DIV');
        controlText.style.fontFamily = 'Arial,sans-serif';
        controlText.style.fontSize = '12px';
        controlText.style.paddingLeft = '4px';
        controlText.style.paddingRight = '4px';
        controlText.innerHTML = '" . _FORMGOOGLEMAP_RESET . "';
        controlUI.appendChild(controlText);
        
        // Setup the click event listeners: simply reset the map to initial values
        google.maps.event.addDomListener(controlUI, 'click', function() {
            setMapPosition(homeLatLng, homeZoomLevel);
        });
    }

    function MarkerControl(controlDiv, map) {
        // Set CSS styles for the DIV containing the control
        // Setting padding to 5 px will offset the control from the edge of the map
        controlDiv.style.padding = '5px';
        
        // Set CSS for the control border
        var controlUI = document.createElement('DIV');
        controlUI.style.backgroundColor = 'white';
        controlUI.style.borderStyle = 'solid';
        controlUI.style.borderWidth = '2px';
        controlUI.style.cursor = 'pointer';
        controlUI.style.textAlign = 'center';
        controlUI.title = '" . _FORMGOOGLEMAP_MARKER_DESC . "';
        controlDiv.appendChild(controlUI);
        
        // Set CSS for the control interior
        var controlText = document.createElement('DIV');
        controlText.style.fontFamily = 'Arial,sans-serif';
        controlText.style.fontSize = '12px';
        controlText.style.paddingLeft = '4px';
        controlText.style.paddingRight = '4px';
        controlText.innerHTML = '" . _FORMGOOGLEMAP_MARKER . "';
        controlUI.appendChild(controlText);
        
        // Setup the click event listeners: simply set the map to Chicago
        google.maps.event.addDomListener(controlUI, 'click', function() {
            map.setCenter(newLatLng);
        });
    }

    function googlemapinitialize(id) {
        var myOptions = {
            zoom: homeZoomLevel,
            center: homeLatLng,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
            navigationControl: true,
            navigationControlOptions: {
                style: google.maps.NavigationControlStyle.SMALL
                },
            mapTypeId: google.maps.MapTypeId.ROADMAP
            };
        map = new google.maps.Map(document.getElementById(id),
            myOptions);
        
        // Create the DIV to hold the control and call the HomeControl() constructor passing in this DIV.
        var homeControlDiv = document.createElement('DIV');
        var homeControl = new HomeControl(homeControlDiv, map);
        homeControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

        // Create the DIV to hold the control and call the MarkerControl() constructor passing in this DIV.
        var markerControlDiv = document.createElement('DIV');
        var markerControl = new MarkerControl(markerControlDiv, map);
        markerControlDiv.index = 2;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(markerControlDiv);

        google.maps.event.addListener(map, 'zoom_changed', function() {
            zoomLevel = map.getZoom();
            document.getElementById('" . $name . '[zoom]' . "').value = zoomLevel;
            });

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: homeLatLng
            });
        google.maps.event.addListener(marker, 'dragend', function() {
            newLatLng = marker.getPosition();
            document.getElementById('" . $name . '[lat]' . "').value = newLatLng.lat();
            document.getElementById('" . $name . '[lng]' . "').value = newLatLng.lng();
            });
    }

    function setMapPosition(LatLng, zoomLevel) {
        map.setCenter(LatLng);
        marker.setPosition(LatLng);
        map.setZoom(zoomLevel);
        document.getElementById('" . $name . '[lat]' . "').value = LatLng.lat();
        document.getElementById('" . $name . '[lng]' . "').value = LatLng.lng();
        document.getElementById('" . $name . '[zoom]' . "').value = zoomLevel;
        }

    function geocodeAddress(id) {
        var address = document.getElementById(id).value;
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                newLatLng = results[0].geometry.location;
                map.setCenter(newLatLng);
                marker.setPosition(newLatLng);
                document.getElementById('" . $name . '[lat]' . "').value = newLatLng.lat();
                document.getElementById('" . $name . '[lng]' . "').value = newLatLng.lng();
            } else {
                alert('" . _FORMGOOGLEMAP_SEARCHERROR . "' + status);
            }
        });
    }

    xoopsOnloadEvent(googlemapinitialize('{$name}GoogleMap')); // onload
    </script>";

        $this->addElement(new XoopsFormLabel('', $js . $html));

            $latlonzoomelementtray = new XoopsFormElementTray(_FORMGOOGLEMAP_LATLNGZOOM_DESC . '<br />', '&nbsp;');
            $lattextarea = new XoopsFormText(_FORMGOOGLEMAP_LAT, $name . '[lat]', 10, 255, $lat);
            $lngtextarea = new XoopsFormText(_FORMGOOGLEMAP_LNG, $name . '[lng]', 10, 255, $lng);
            $zoomtextarea = new XoopsFormText(_FORMGOOGLEMAP_ZOOM, $name . '[zoom]', 2, 255, $zoom);
            $latlonzoomelementtray->addElement($lattextarea);
            $latlonzoomelementtray->addElement($lngtextarea);
            $latlonzoomelementtray->addElement($zoomtextarea);
        $this->addElement($latlonzoomelementtray);
            $searchelementtray = new XoopsFormElementTray(_FORMGOOGLEMAP_SEARCH_DESC . '<br />', '&nbsp;');
            $searchtextarea = new XoopsFormText(_FORMGOOGLEMAP_SEARCH, $name . '[search]', 100, 255, $search);
            $searchelementtray->addElement($searchtextarea);
            $searchbutton = new XoopsFormButton ('', $name . 'button', _FORMGOOGLEMAP_SEARCHBUTTON, "button");
                $searchbutton->setExtra ("onclick=\"geocodeAddress('". $name . '[search]'. "');\"");
            $searchelementtray->addElement($searchbutton);
        $this->addElement($searchelementtray);
    }
}
?>