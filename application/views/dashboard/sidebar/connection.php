<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(count($this->near_connections) > 0 && $this->info->type_id == 1) : ?>
            
<div class="people-more panel panel-flat reduced">
    <div class="panel-heading">
        <h5 class="panel-title"><a class="trans" href="<?= base_url('dashboard/related/conn') ?>">Connect with our Initiators</a></h5>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner" role="listbox">
                    <?php $bp_one = 9; $bp_two = 17; $count = 1; $stage = 1; for ($i = 0; $i < 3; $i++) : ?>
                    <div class='item <?= ($count == 1)? 'active' : ''; ?>'>
                        <?php $block = 1; foreach ($this->near_connections as $conn) : if($stage == 1 && $block == $bp_one) { $stage++; break; } if($stage == 2 && $block == $bp_two) { $stage++; break; } ?>
                        <?php if($stage == 1 && $block < 9): ?>
                        <div class="col-xs-3 col">
                            <a href="<?= base_url('dashboard/profile/'.$conn->main_id) ?>">
                                <img alt="<?= ($conn->type_id == 1) ? ucfirst($conn->firstname).' '.ucfirst($conn->lastname) : ucfirst($conn->name); ?>" src="<?= base_url(($conn->propic != '') ? "assets/userdata/dashboard/propic/".$conn->propic : "assets/img/".$this->hook->get_placeholder($conn->main_id)); ?>" class="img-rounded img-responsive" data-toggle="tooltip" title="<?= ($conn->type_id == 1) ? ucfirst(strtolower($conn->firstname)).' '.ucfirst(strtolower($conn->lastname)) : ucfirst(strtolower($conn->name)); ?>" data-placement="bottom">
                                <?php if($conn->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if($stage == 2 && $block > 8 && $block < 17): ?>
                        <div class="col-xs-3 col">
                            <a href="<?= base_url('dashboard/profile/'.$conn->main_id) ?>">
                                <img alt="<?= ($conn->type_id == 1) ? ucfirst($conn->firstname).' '.ucfirst($conn->lastname) : ucfirst($conn->name); ?>" src="<?= base_url(($conn->propic != '') ? "assets/userdata/dashboard/propic/".$conn->propic : "assets/img/".$this->hook->get_placeholder($conn->main_id)); ?>" class="img-rounded img-responsive" data-toggle="tooltip" title="<?= ($conn->type_id == 1) ? ucfirst(strtolower($conn->firstname)).' '.ucfirst(strtolower($conn->lastname)) : ucfirst(strtolower($conn->name)); ?>" data-placement="bottom">
                                <?php if($conn->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if($stage == 3 && $block > 16): ?>
                        <div class="col-xs-3 col">
                            <a href="<?= base_url('dashboard/profile/'.$conn->main_id) ?>">
                                <img alt="<?= ($conn->type_id == 1) ? ucfirst($conn->firstname).' '.ucfirst($conn->lastname) : ucfirst($conn->name); ?>" src="<?= base_url(($conn->propic != '') ? "assets/userdata/dashboard/propic/".$conn->propic : "assets/img/".$this->hook->get_placeholder($conn->main_id)); ?>" class="img-rounded img-responsive" data-toggle="tooltip" title="<?= ($conn->type_id == 1) ? ucfirst(strtolower($conn->firstname)).' '.ucfirst(strtolower($conn->lastname)) : ucfirst(strtolower($conn->name)); ?>" data-placement="bottom">
                                <?php if($conn->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php $block++; endforeach; ?>
                    </div>
                    <?php $count++; endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>