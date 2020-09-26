<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="form-group">
    <label>Title</label>
    <input value="<?= $group->title ?>" type="text" class="form-control" name="title" placeholder="Enter group title">
</div>
<div class="form-group">
    <label>Content</label>
    <textarea name="desc" class="form-control" placeholder="Enter brief description about your group"><?= $group->description; ?></textarea>
</div>
<div class="form-group">
    <label>Tags</label>
    <select value="<?= $group->tags ?>" data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control group_tags">
    <?php if ($group->tags != '') : $tags = explode(',', $group->tags); foreach ($tags as $tag) : ?>
        <option value="<?= $tag; ?>" selected="selected"><?= $tag; ?></option>
    <?php endforeach; endif; ?>
    </select>
</div>
<div class="form-group">
    <label>Add Banner image</label>
    <input type="file" name="group_upload" id="groupupdate_upload">
    <p class="help-block">Only jpg | png formats allowed. Add file to replace the previous uploaded file.</p>
</div>
<input type="hidden" value="<?= $group->id ?>" name="group_update_id" />