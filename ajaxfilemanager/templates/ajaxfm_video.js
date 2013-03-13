<{*
extra assigned template variables:
$video_id               Video object id.
$video_url              Video absolute url.
$video_width            Width of the player in pixels. We recommend setting this to at least 320. On smaller players, certain UI elements may not fit. Defaults to 480.
$video_height           Height of the player in pixels. We recommend setting this to at least 180, so all UI elements will fit. However, it can be set to a small size (e.g. 40) for audio-only playback. Defaults to 270.
$video_allowfullscreen
$video_autostart        Automatically start playing the video on page load. Can be true or false (default). Autostart does not work on mobile devices like iOS and Android.
$video_repeat           Whether to loop playback of the playlist or not. Can be true (keep playing forever) or false (stop playback when completed). Defaults to false.
$video_image            URL to a JPG/PNG poster image to display before playback is started. For audio-only media, the poster image stays visible during playback.
$video_parsArray        Array of parameters.
*}>
xoopsOnloadEvent(function(){
    jwplayer('<{$video_id}>').setup({
        file: '<{$video_url}>',
        width: '<{$video_width}>',
        height: '<{$video_height}>',
        skin: '<{$video_skin}>',
        autostart : '<{$video_autostart}>',
        repeat : '<{$video_repeat}>',
        image : '<{$video_image}>',
    });
});
