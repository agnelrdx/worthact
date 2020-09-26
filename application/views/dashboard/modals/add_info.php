<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="add_info" class="modal show" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <?php if ($this->session->userdata('user_type') == '1') : ?>
        <form id="add_user_info">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Basic Information</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="Enter your first name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Enter your last name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group gender_box">
                                <label>Gender</label>
                                <select data-placeholder="Select Gender" name="gender" class="form-control gender-select">
                                    <option></option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>    
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group country_box">
                                <label>Country</label>
                                <select data-placeholder="Select country" name="country" class="form-control country-select">
                                    <option></option>
                                    <?php foreach ($countries as $country) { ?>
                                    <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Reference</label>
                                <input type="text" name="reference" class="form-control" placeholder="How did you hear about us ?" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-12 select_box">
                            <div class="form-group">
                                <label>Area of interest in WorthAct Initiatives</label>
                                <select data-placeholder="Select Initiatives" multiple="multiple" name="interest[]" class="form-control select_area">
                                    <?php foreach ($cat_main as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= $cat->category ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="submit" class="btn trans" name="submit" value="submit" />
                    <div class="alert alert-danger" role="alert"></div>
                </div>
            </div>
        </form>
        <?php else : ?>
        <form id="add_org_info" class="add_info" enctype="multipart/form-data" method="post"  action="<?= base_url('dashboard/add_info') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Basic Information</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="<?= $type_name; ?> name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group country_box">
                                <label>Country</label>
                                <select data-placeholder="Select country" name="country" class="form-control country-select">
                                    <option></option>
                                    <?php foreach ($countries as $country) { ?>
                                    <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Reference</label>
                                <input type="text" name="reference" class="form-control" placeholder="How did you hear about us ?" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 select_box">
                            <div class="form-group">
                                <label>Area of Function in WorthAct Initiatives</label>
                                <select data-placeholder="Select Initiatives" multiple="multiple" name="interest[]" class="form-control select_area">
                                    <?php foreach ($cat_main as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= $cat->category ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="submit" class="btn trans" name="submit" value="submit" />
                    <div class="alert alert-danger" role="alert"></div>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>    