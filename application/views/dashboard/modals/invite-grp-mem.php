<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="form-group">
    <label>Select your connection and send invitation to invite them to your group.</label>
    <select data-placeholder="Select connection" multiple="multiple" name="invites[]" class="form-control invites">
        <?php foreach ($conn as $c) { 
                if($c->user_one == $this->session->userdata('user_id')) {
                    $this->hook->invite_user_details($c->user_two, $grp_id);
                } else {
                    $this->hook->invite_user_details($c->user_one, $grp_id);
                }  
            } ?>
    </select>
    <input type="hidden" value="<?= $grp_id ?>" name="grp_id" />
</div>
