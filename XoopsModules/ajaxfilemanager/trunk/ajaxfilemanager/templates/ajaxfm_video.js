<{*
extra assigned template variables:
$video_id           video object id
$video_url          video absolute url
$video_width
$video_height
$video_allowfullscreen
$video_autostart
$video_parsArray    array of parameters
*}>
xoopsOnloadEvent(function(){
    so = new SWFObject('<{$xoops_url}>/class/textsanitizer/video/jwplayer/player.swf', '<{$video_id}>', '<{$video_width}>', '<{$video_height}>', '9');
    so.addParam('allowfullscreen', '<{$video_allowfullscreen}>');
    so.addParam('allowscriptaccess', 'always');
    so.addVariable('file', '<{$video_url}>');
    so.addVariable('autostart', '<{$video_autostart}>');
    so.write('<{$video_id}>');
});