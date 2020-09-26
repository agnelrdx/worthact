<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-flat profile-about">
    <div class="panel-heading">
        <h4 class="panel-title">Group Intro</h4>
    </div>					
    <div class="panel-body">
        <h4>Created by</h4>
        <p><a class="user trans" href="<?= base_url('dashboard/profile/'.$group->main_user_id) ?>"><?= ($group->type_id == 1) ? ucfirst($group->firstname).' '.ucfirst($group->lastname) : ucfirst($group->name); ?></a></p>
        <h4>Description</h4>
        <p><?= $group->description; ?></p>
        <?php if($group->tags != '') : ?>
        <h4>Tags</h4>
        <p><?php $tags = explode(',', $group->tags); foreach($tags as $tag) { echo "<span class='label shadow'>$tag</span>"; } ?></p>
        <?php endif; ?>
    </div>
</div>    