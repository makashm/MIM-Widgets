(function($){

	$(document).ready(function(){
		$( 'button#mim_widgets_img_id' ).live( 'click', function(e){
			e.preventDefault()
			var image_upload = wp.media({
			      title: 'Select or Upload Media Of Your Chosen Persuasion',
			      button: {
			        text: 'Use this media'
			      },
			      multiple: false  // Set to true to allow multiple files to be selected
			    })
			image_upload.open()

			image_upload.on( 'select', function(){
				// Get media attachment details from the frame state
      			var attachment = image_upload.state().get('selection').first().toJSON();
      			var attachment_link = attachment.url
      			$( 'input.mim_widgets_img_link' ).val( attachment_link )
      			$( '.upload_img_class img' ).attr( 'src', attachment_link )
			} )
		})
	})

}(jQuery))