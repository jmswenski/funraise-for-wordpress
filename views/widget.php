<!-- This file is used to markup the public-facing widget. -->
<?php

    if (! empty (get_option( 'organization_uuid' )) && ! empty ($instance['form_id'])) {

        $form_key = explode ( '-' , get_option( 'organization_uuid' ))[0] . '' . $instance['form_id'];

		$widget_html = 
				'<script id="funraise-form-'.$form_key.'" type="text/javascript">
				    var f = new Funraise({
				        id: "'. get_option( 'organization_uuid' ) .':'. $instance['form_id'] .'",
				        isPopup: true
				    });
				    f.init();
				</script>
				<div id="fc-'.$form_key.'"></div>';
		echo $widget_html;
	} else {
		echo __('Please enter your Organization UUID in the widgets options. Also make sure to provide a form ID as a parameter', 'funraise');
	}		
?>