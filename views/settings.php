<div class="wrap">
<h1>Funraise for Wordpress</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'funraise-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'funraise-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Organization UUID</th>
        <td><input type="text" name="organization_uuid" value="<?php echo esc_attr( get_option('organization_uuid') ); ?>" /></td>
        </tr>
       
    </table>
    
    <?php submit_button(); ?>

</form>
</div>

