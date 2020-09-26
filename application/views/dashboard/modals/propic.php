<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="update_propic" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm btns-robocrop2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= ($this->info->propic == '')? 'Add' : 'Update'; ?> Profile Picture</h4>
            </div>
            <div class="modal-body btns-robocrop2">						
                <div class="form-group">
                    <p class="help-block">Only jpg | png formats allowed. Crop the image to flip them.</p>
                    <div class="btn-open btn btn-default btn-sm">
			<span><i class="fa fa-folder-open-o"></i>&nbsp;Open Image</span>  
			<input class="upload" type="file">
                    </div>
                    <button type="button" class="btn-crop btn btn-default btn-sm"><i class="fa fa-scissors"></i>&nbsp;CROP</button>
                    <button type="button" class="btn-flip-x btn btn-default btn-sm"><i class="fa fa-arrow-right"></i>&nbsp;Flip X</button>
                    <button type="button" class="btn-flip-y btn btn-default btn-sm"><i class="fa fa-arrow-up"></i>&nbsp;Flip Y</button>
                </div>    
                <div id="crop"></div>
            </div>
            <div class="modal-footer">
                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit_propic" data-ripple class="btn btn-primary"><?= ($this->info->propic == '')? 'Add' : 'Update'; ?></button>
                <div class="alert alert-danger" role="alert"></div>
            </div>
        </div>
    </div>
</div>

<div id="delete_propic" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_propic_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Propic</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete your profile picture ?</p>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button data-ripple type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="update_banner" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= ($this->info->wall == '')? 'Add' : 'Update'; ?> Profile Banner</h4>
            </div>
            <div class="modal-body btns-robocrop2">						
                <div class="form-group">
                    <p class="help-block">Only jpg | png formats allowed. Crop the image to flip them.</p>
                    <div class="btn-open btn btn-default btn-sm">
			<span><i class="fa fa-folder-open-o"></i>&nbsp;Open Image</span>  
			<input class="upload" type="file">
                    </div>
                    <button type="button" class="btn-crop btn btn-default btn-sm"><i class="fa fa-scissors"></i>&nbsp;CROP</button>
                    <button type="button" class="btn-flip-x btn btn-default btn-sm"><i class="fa fa-arrow-right"></i>&nbsp;Flip X</button>
                    <button type="button" class="btn-flip-y btn btn-default btn-sm"><i class="fa fa-arrow-up"></i>&nbsp;Flip Y</button>
                </div>    
                <div id="crop_banner"></div>
            </div>
            <div class="modal-footer">
                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit_banner" data-ripple class="btn btn-primary"><?= ($this->info->wall == '')? 'Add' : 'Update'; ?></button>
                <div class="alert alert-danger" role="alert"></div>
            </div>
        </div>
    </div>
</div>

<div id="delete_banner" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_banner_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Profile Banner</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete your profile banner ?</p>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button data-ripple type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>