<{*
extra assigned template variables:
$gmap_id            gmap object id
$gmap_url           kml file absolute url
$gmap_lat
$gmap_lng
$gmap_zoom
$gmap_parsArray     array of parameters
*}>
xoopsOnloadEvent(function(){
    var myLatlng = new google.maps.LatLng(<{$gmap_lat}>, <{$gmap_lng}>);
    var myOptions = {
        zoom: <{$gmap_zoom}>,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('<{$gmap_id}>'), myOptions);
    var georssLayer = new google.maps.KmlLayer('<{$gmap_url}>');
    georssLayer.setMap(map);
});