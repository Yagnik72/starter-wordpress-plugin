jQuery(document).ready(function($){
    jQuery('#mens_concerns .add,#womens_concerns .add').on('click',function(){
        let _container = jQuery(this).closest('[data-concern]');
        let _concerns = _container.find('.concerns');
        
        let sex = _container.parent().attr('data-sex');
        let part = _container.attr('data-concern');

        _concerns.append(`<span class="concern-item"><input name="${sex}_${part}[]" value=""/><p class="delete">&times;</p></span>`);
    });

    jQuery('#mens_concerns,#womens_concerns').on('click','.delete',function(){
        jQuery(this).parent().remove();
    });
   
    
    jQuery('.image-picker').click(function(e) {
        e.preventDefault();
        var mediaUploader = wp.media({
            title: 'Select Media',
            multiple: false,
            libraryType: 'image'
        });
    
        mediaUploader.on('select', function() {
            let attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
            jQuery('.image-thumbnail_container').append(`<img src="${attachment.url}" />`);
            jQuery('#first_screen_left_image').val(attachment.id);
            //console.log(attachment);
            //jQuery('#my-media-input').val(attachment.url);        
        });    
        mediaUploader.open();
    });

    jQuery('.nav-tab-wrapper .nav-tab').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            jQuery('.nav-tab-wrapper .nav-tab,.nav-tab_item').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(`${jQuery(this).attr('data-tab')}`).addClass('active');           
            jQuery('[name="active_tab"]').val( jQuery(`${jQuery(this).attr('data-tab')}`).attr('id') );
    });
    
});