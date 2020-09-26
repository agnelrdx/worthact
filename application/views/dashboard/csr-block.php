<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(count($companies) > 0) : foreach ($companies as $comp) : ?>

<div class="col-sm-4 col" data-id="<?= $comp->csr_time ?>">
    <div class="inner shadow">
        <div class="thumb">
            <img src="<?= base_url(($comp->propic != '') ? 'assets/userdata/dashboard/propic/'.$comp->propic : 'assets/img/company_placeholder.png'); ?>" class="shadow" />
        </div>
        <div class="desc">
            <h4><?= ucfirst(strtolower($comp->name)); ?></h4>
            <div class="stars">
                <i class="ion-android-star"></i>
                <i class="ion-android-star"></i>
                <i class="ion-android-star"></i>
                <i class="ion-android-star-half"></i>
                <i class="ion-android-star-outline"></i>
            </div>
        </div>
    </div>
</div>

<?php endforeach; endif;
