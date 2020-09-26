<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="form-group">
    <label>Title</label>
    <input value="<?= $blog->title ?>" type="text" class="form-control" name="title" placeholder="Enter blog title">
</div>
<div class="form-group">
    <label>Content</label>
    <textarea name="editor_blog_update" class="form-control" id="editor_blog_update"><?= $blog->content; ?></textarea>
    <?php if($this->info->user_level == 0) : ?><p class="text-muted">P.S You are on a free account. Your content will be limited to 700 letters.</p><?php endif; ?>
</div>
<div class="form-group">
    <label>Tags</label>
    <select value="<?= $blog->tags ?>" data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control blog_tags">
    <?php if ($blog->tags != '') : $tags = explode(',', $blog->tags); foreach ($tags as $tag) : ?>
        <option value="<?= $tag; ?>" selected="selected"><?= $tag; ?></option>
    <?php endforeach; endif; ?>
    </select>
</div>
<?php if($this->info->user_level != 0) : ?>
<div class="form-group">
    <label>Add Banner image or video</label>
    <input type="file" name="blog_upload" id="blogupdate_upload">
    <p class="help-block">Only jpg | png | mp4 formats allowed. Add file to replace the previous uploaded file.</p>
</div>
<?php endif; ?>
<div class="form-group">
    <label class="main">Select Privacy</label>
    <div class="radio">
        <label>
            <input <?php if($blog->privacy == 0) { echo 'checked="checked"'; } ?> type="radio" name="privacy" value="0">
            <i class="ion-earth"></i> Public
        </label>
    </div>
    <div class="radio">
        <label>
            <input <?php if($blog->privacy == 1) { echo 'checked="checked"'; } ?> type="radio" name="privacy" value="1">
            <i class="ion-person-stalker"></i> Friends
        </label>
    </div>
    <div class="radio">
        <label>
            <input <?php if($blog->privacy == 2) { echo 'checked="checked"'; } ?> type="radio" name="privacy" value="2">
            <i class="ion-locked"></i> Only Me
        </label>
    </div>
</div>
<input type="hidden" value="<?= $blog->id ?>" name="blog_update_id" />