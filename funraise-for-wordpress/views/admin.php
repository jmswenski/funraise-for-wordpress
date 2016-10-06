<!-- This file is used to markup the administration form of the widget. -->
<p>
	<label for="<?php echo $this->get_field_id( 'form_id' ); ?>"><?php _e( 'Form ID:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'form_id' ); ?>" name="<?php echo $this->get_field_name( 'form_id' ); ?>" type="text" value="<?php echo esc_attr( $form_id ); ?>" />
						
</p>