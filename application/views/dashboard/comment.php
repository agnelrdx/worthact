<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ($comment_type === 'child') : if (count($comments) > 0) : foreach ($comments as $comment) : ?>

<div id="comment_<?= $comment->comment_id ?>" class="comments media media-list media-list-bordered" data-id="<?= $comment->comment_id ?>">
    <?php $this->hook->check_user_comment($comment->comment_id, ''); ?>
    <div class = "media-left">
        <a href="<?= base_url('dashboard/profile/' . $comment->comment_user_id) ?>"><img alt = "<?= ($comment->user_type == 1) ? ucfirst(strtolower($comment->firstname)) . ' ' . ucfirst(strtolower($comment->lastname)) : ucfirst(strtolower($comment->name)); ?>" src="<?= base_url(($comment->propic != '') ? "assets/userdata/dashboard/propic/" . $comment->propic : "assets/img/".$this->hook->get_placeholder($comment->comment_user_id)) ?>" class="shadow"></a>
    </div>
    <div class = "media-body">
        <a href="<?= base_url('dashboard/profile/' . $comment->comment_user_id) ?>"><h4 class = "media-heading"><?= ($comment->user_type == 1) ? ucfirst(strtolower($comment->firstname)) . ' ' . ucfirst(strtolower($comment->lastname)) : ucfirst(strtolower($comment->name)); ?></h4></a>
        <p><?= $comment->comment ?></p>
        <div class = "media-annotation">
            <a onclick="comment_like(<?= $comment->comment_id ?>)" <?php $this->hook->user_like_comment_status($comment->comment_id); ?> data-id="<?= $comment->comment_id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $comment->likes ?></span>)</a>
        </div>
    </div>
</div>

<?php endforeach; endif; else :

if (count($comments) > 0) : foreach ($comments as $comment) : ?>

<div id="comment_<?= $comment->comment_id ?>" class="comments media media-list media-list-bordered" data-id="<?= $comment->comment_id ?>">
    <?php $this->hook->check_user_comment($comment->comment_id, $type_id); ?>
    <div class = "media-left">
        <a href="<?= base_url('dashboard/profile/' . $comment->comment_user_id) ?>"><img alt = "<?= ($comment->user_type == 1) ? ucfirst($comment->firstname) . ' ' . ucfirst($comment->lastname) : $comment->name; ?>" src="<?= base_url(($comment->propic != '') ? "assets/userdata/dashboard/propic/" . $comment->propic : "assets/img/".$this->hook->get_placeholder($comment->comment_user_id)) ?>" class="shadow"></a>
    </div>
    <div class = "media-body">
        <a href="<?= base_url('dashboard/profile/' . $comment->comment_user_id) ?>"><h4 class = "media-heading"><?= ($comment->user_type == 1) ? ucfirst(strtolower($comment->firstname)) . ' ' . ucfirst(strtolower($comment->lastname)) : ucfirst(strtolower($comment->name)); ?></h4></a>
        <p><?= $comment->comment ?></p>
        <div class = "media-annotation">
            <?php $this->hook->comment_replies($comment->comment_id); ?>
            <a class="trans" onclick="comment_reply(<?= $comment->comment_id ?>)"><i class="ion-reply"></i> Reply</a>
            <a onclick="comment_like(<?= $comment->comment_id ?>)" <?php $this->hook->user_like_comment_status($comment->comment_id); ?> data-id="<?= $comment->comment_id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $comment->likes ?></span>)</a>
            <?php if($comment->likes > 0) : ?> <a title="View Likes" class="view_like trans" data-type="comment" data-id="<?= $comment->comment_id ?>"><i class="ion-arrow-down-b"></i></a> <?php endif; ?>
        </div>
    </div>
    <div class="comment-child"></div>
    <div class="comment-reply"></div>
</div>

<?php endforeach; endif; endif; ?>