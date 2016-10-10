<!-- This file is used to markup the public-facing widget. -->
<?php

    if (! empty (get_option( 'organization_uuid' )) && ! empty ($instance['form_id'])) {

        $form_key = explode ( '-' , get_option( 'organization_uuid' ))[0] . '' . $instance['form_id'];
        $popup = !empty ($instance['popup'] ) ? $instance['popup'] : 'true';
        $default_button = !empty ($instance['default_button'] ) ? $instance['default_button'] : 'true';
        $state_country = !empty ($instance['structured_state_country'] ) ? $instance['structured_state_country'] : 'false';


		$widget_html = 
				'<script id="funraise-form-'.$form_key.'" type="text/javascript">
				    var f = new Funraise({
				        id: "'. get_option( 'organization_uuid' ) .':'. $instance['form_id'] .'",
				        isPopup: '.$popup.',
				        useDefaultButton: '.$default_button.',
				        structuredStateCountry: '.$state_country.'
				    });
				    f.init();
				</script>
				<div id="fc-'.$form_key.'"></div>';
		echo $widget_html;
	} else {
		echo __('Please enter your Organization UUID in the widgets options. Also make sure to provide a form ID as a parameter', 'funraise');
	}		
?>