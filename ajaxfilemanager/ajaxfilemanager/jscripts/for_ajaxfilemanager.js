function selectFile(url) {
    var extension;
    var ret;
    extension = url.split('.').pop();
    switch(extension) {
        case 'mp3':
            ret = '[mp3]' + url + '[/mp3]';
            break;
        case 'flv':
            ret = '[video]' + url + '[/video]';
            break;
        case 'kml':
            ret = '[gmap]' + url + '[/gmap]';
            break;
        case 'png':
        case 'jpg':
        case 'gif':
            ret = '[img]' + url + '[/img]';
            break;
        default:
            ret = url;
       }
    window.opener.document.getElementById(elementId).value = window.opener.document.getElementById(elementId).value + ret;
    window.close() ;
}



function cancelSelectFile()
{
    // close popup window
    window.close() ;
}

