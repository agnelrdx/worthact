<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (count($blogs) > 0) : foreach ($blogs as $blog) : if($this->hook->check_blog_view($blog->id)) : $file = explode('.', $blog->file); $file_type = end($file); ?>

<div class="grid-item shadow" data-id="<?= $blog->time ?>">
    <div class="blog-post">
        <?php if ($blog->file != '' && $file_type != 'mp4') : ?>
        <div class="blog-img-thumb">
            <?php if ($file_type == 'png' || $file_type == 'jpg') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/blog/' . $blog->file); ?>" alt="<?= $blog->title ?>" title="<?= $blog->title ?>" />
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="blog-post-desc">
            <h4><a class="trans" href="<?= base_url('dashboard/blog/' . $blog->id); ?>"><?= ucfirst(strtolower($blog->title)); ?></a></h4>
            <?= substr($blog->content, 0, 200) . '...'; ?>
        </div>
        <div class="blog-post-foot">
            <a onclick="like_dislike('blog', <?= $blog->id ?>)" <?php $this->hook->user_like_status($blog->id, 'blog'); ?> data-id="<?= $blog->id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $blog->likes ?></span>)</a>
            <?php if($blog->likes > 0) : ?> <a title="View Likes" class="view_like trans" data-type="blog" data-id="<?= $blog->id ?>"><i class="ion-arrow-down-b"></i></a> <?php endif; ?>
            <a><i class="ion-ios-chatboxes"></i> Comment (<?php $this->hook->comment_count($blog->id ,'blog') ?>)</a>
            <a><i class="ion-android-calendar"></i> <?= $blog->date; ?></a>
        </div>
        <?php if($this->session->userdata('user_id') == $blog->user_id) : ?>
        <ul class="fab-menu fab-menu-absolute fab-menu-bottom-right" data-fab-toggle="hover">
            <li>
                <a class="fab-menu-btn btn bg-success btn-float btn-rounded btn-icon"><i class="ion-android-settings"></i></a>
                <ul class="fab-menu-inner">
                    <li>
                        <div class="fab-label-visible update_blog" data-fab-label="Edit">
                            <a onclick="update_blog(<?= $blog->id; ?>)" data-ripple class="btn btn-default btn-rounded btn-icon btn-float"><i class="ion-edit"></i></a>														
                        </div>
                    </li>
                    <li>
                        <div class="fab-label-visible delete_blog" data-fab-label="Delete" data-toggle="modal" data-target="#modal_delete">
                            <a onclick="delete_blog(<?= $blog->id; ?>)" data-ripple class="btn btn-default btn-rounded btn-icon btn-float"><i class="ion-trash-a"></i></a>														
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php endif; endforeach; else : if($load_type == 'single') : ?>
<h4 class="zero-result grid-item shadow">No Blog posts added.</h4>
<?php endif; endif; ?>