var $j = jQuery.noConflict();
function call_media_library() {
    var media_uploader;
    $j(document).on('click', '.video_media_btn', function(e){
        e.preventDefault();
        var btn_uploader = $j(this);
        if (media_uploader) {
            media_uploader.open();
            return;
        }
        media_uploader = wp.media({ 
            title: 'Upload media',
            //you can change type of media 
            library : { type : 'video'},
            multiple: false
        }).on('select', function(e){
            // This will return the selected media from the Media Uploader, the result is an object
            var uploaded_media = media_uploader.state().get('selection').first();
            // Convert uploaded_media to a JSON object to make accessing it easier
            var media_url = uploaded_media.toJSON().url;
            // Assign the url value to the input field
            //this is the element where u will put the url, I give example for video
            btn_uploader.parent().closest('.input-group.input-group-xs').siblings( '.input-media-display' ).find('.mp4-media-src').attr("src", media_url);
            //this is to run video again after change
            btn_uploader.parent().closest('.input-group.input-group-xs').siblings( '.input-media-display' ).find('video')[0].load();
        }).open();
    });
}
