<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-flat profile-about">
    <div class="panel-heading">
        <h4 class="panel-title">Profile Intro</h4>
    </div>					
    <div class="panel-body">
        <?php if ($user->type_id == 1) : if($user->user_about != '') : ?>
        <h4>About</h4>
        <p><?= $user->user_about; ?></p>
        <?php endif; if ($profile_id == $this->session->userdata('user_id') || $privacy->address == 0 || ($privacy->address == 1 && $type == 'friend')) : if($user->user_address != '') : ?>
        <h4>Address</h4>
        <p><?= $user->user_address; ?></p>
        <?php endif; if($user->user_city != '' && $user->user_state != '') : ?>
        <h4>Location</h4>
        <p><?= $user->user_city . ', ' . $user->user_state . ', ' . $user->user_country_name; ?></p>
        <?php endif; endif; ?>
        <h4>Gender</h4>
        <p><?= ($user->gender == 1) ? 'Male' : 'Female'; ?></p>
        <?php if($user->profession != '') : ?>
        <h4>Profession</h4>
        <p><?= $user->profession ?></p>
        <?php endif; if ($profile_id == $this->session->userdata('user_id') || $privacy->email == 0 || ($privacy->email == 1 && $type == 'friend')) : ?>
        <h4>Email</h4>
        <p><?= $user->email ?></p>
        <?php endif; if ($profile_id == $this->session->userdata('user_id') || $privacy->phone == 0 || ($privacy->phone == 1 && $type == 'friend')) : if ($user->mobile != '') : ?>
        <h4>Mobile</h4>
        <p><?= $user->mobile ?></p>
        <?php endif; endif; if ($user->hobbies != '') : ?>
        <h4>Hobbies</h4>
        <p><?php $hobs = explode(',', $user->hobbies); foreach ($hobs as $hob) { echo "<span class='label shadow'>$hob</span>"; } ?></p>
        <?php endif; if ($profile_id == $this->session->userdata('user_id') || $privacy->dob == 0 || ($privacy->dob == 1 && $type == 'friend')) : if ($user->birthday != '') : ?>
        <h4>Birthday</h4>
        <p><?= $user->birthday ?></p>
        <?php endif; endif; ?>
        <h4>Area of Interest</h4>
        <p><?php foreach ($cat as $c) { echo "<span class='label shadow'>$c->category</span>"; } ?></p>
        <?php if ($profile_id == $this->session->userdata('user_id') || $privacy->social == 0 || ($privacy->social == 1 && $type == 'friend')) : ?>
        <?php if ($user->facebook != '') : ?><a data-ripple href="<?= $user->facebook ?>" target="_blank" class="social trans facebook"><i class="ion-social-facebook"></i> Facebook</a><?php endif; ?>
        <?php if ($user->linkedin != '') : ?><a data-ripple href="<?= $user->linkedin ?>" target="_blank" class="social trans linkedin"><i class="ion-social-linkedin"></i> Linkedin</a><?php endif; ?>
        <?php if ($user->twitter != '') : ?><a data-ripple href="<?= $user->twitter ?>" target="_blank" class="social trans twitter"><i class="ion-social-twitter"></i> Twitter</a><?php endif; ?>
        <?php if ($user->google_plus != '') : ?><a data-ripple href="<?= $user->google_plus ?>" target="_blank" class="social trans last googleplus"><i class="ion-social-googleplus"></i> Google Plus</a><?php endif; ?>
        <?php endif; else : if($user->or_about != '') : ?>
        <h4>Info</h4>
        <p><?= $user->or_about; ?></p>
        <?php endif; if ($profile_id == $this->session->userdata('user_id') || $privacy->address == 0 || ($privacy->address == 1 && $type == 'friend')) : if($user->or_address != '') : ?>
        <h4>Address</h4>
        <p><?= $user->or_address; ?></p>
        <?php endif; if($user->or_city != '' && $user->or_state != '') : ?>
        <h4>Location</h4>
        <p><?= $user->or_city . ', ' . $user->or_state . ', ' . $user->org_country_name; ?></p>
        <?php endif; endif; if ($profile_id == $this->session->userdata('user_id') || $privacy->phone == 0 || ($privacy->phone == 1 && $type == 'friend')) : if ($user->tel != '') : ?>
        <h4>Tel</h4>
        <p><?= $user->tel ?></p>
        <?php endif; if ($user->fax != '') : ?>
        <h4>Fax</h4>
        <p><?= $user->fax ?></p>
        <?php endif; endif; ?>
        <h4>Website</h4>
        <p><a class="trans website" href="<?= $user->website ?>" target="_blank"><?= ($user->website != '') ? $user->website : 'None'; ?></a></p>
        <h4>Area of function</h4>
        <p><?php foreach ($cat as $c) { echo "<span class='label shadow'>$c->category</span>"; } ?></p>
        <?php if ($user->facebook != '') : ?><a data-ripple href="<?= $user->facebook ?>" target="_blank" class="social trans facebook"><i class="ion-social-facebook"></i> Facebook</a><?php endif; ?>
        <?php if ($user->linkedin != '') : ?><a data-ripple href="<?= $user->linkedin ?>" target="_blank" class="social trans linkedin"><i class="ion-social-linkedin"></i> Linkedin</a><?php endif; ?>
        <?php if ($user->twitter != '') : ?><a data-ripple href="<?= $user->twitter ?>" target="_blank" class="social trans twitter"><i class="ion-social-twitter"></i> Twitter</a><?php endif; ?>
        <?php if ($user->google_plus != '') : ?><a data-ripple href="<?= $user->google_plus ?>" target="_blank" class="social trans googleplus"><i class="ion-social-googleplus"></i> Google Plus</a><?php endif; ?>
        <?php endif; ?>
    </div>
</div>