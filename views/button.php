<?php

$form_key = explode ( '-' , get_option( 'organization_uuid' ))[0] . '' . $instance['form_id'];

echo '<button class="'.$instance['class'].'" data-amount="'.$instance['amount'].'"data-toggle="modal" data-target="#donateModal-'.$form_key.'">'.$instance['text'].'</button>';

?>