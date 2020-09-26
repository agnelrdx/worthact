<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($this->info->type_id != 3 && ($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata')) : ?>

<div class="panel panel-flat post-num meter">
    <a title="Offers" href="<?= base_url('dashboard/seso') ?>"><img src="<?= base_url('assets/img/seso_modal.jpg') ?>" class="img-responsive" alt="offer" /></a>
</div>    
<?php endif; ?>