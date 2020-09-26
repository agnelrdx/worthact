<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container offers seso">
    <div class="row">
        <img src="<?= base_url('assets/img/seso.jpg'); ?>" class="img-responsive offer-banner"  alt="offer" />
        <div class="col-sm-12 col">
            <div class="row type">
                <div class="col-sm-12">
                    <div class="offer_modal">
                        <div class="modal-content shadow">
                            <?php if($this->session->flashdata('seso_success') == 1) : ?>
                            <div class="alert alert-success alert-dismissible seso_alert" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Thank you for your participation. You are now officially a "Green Warrior". We will be back with you soon with the results. <strong>All the best</strong>
                            </div>
                            <?php endif; ?>
                            <div class="modal-header">
                                <h4 class="modal-title text-center">Greetings!!</h4>
                                <h4 class="text-center title-two">Welcome to WorthAct SESO...Save the Earth - Save Ourselves</h4>
                            </div>
                            <div class="modal-body top_zero">
                                <p class="entry">The beginning of a new academic year.....young's minds fresh and rejuvenated from the vacation, on the lookout for new experiences and in search of advanced courses to move up in life, to find the road to prosperity. To instil in them a touch of nature, a realisation that mankind depends wholly on nature for existence, we have to get them more involved in eco-friendly activities and awareness programmes.</p>
                                <p class="entry">WorthAct introduces a talent search competition <strong>"WorthAct SESO"</strong>  aimed at School students where they can showcase their expertise, win prizes and at the same time learn to be more environment friendly and responsible. Each candidate has to  upload their entries below. All eligible candidates will be awarded a certification of participation. The school with most participants wins a trophy.</p>
                                <h4 class="text-center how main">What you can do</h4>
                                <h5 class="text-center">Starting from July 1st</h5>
                                <div class="row how_action text-center">
                                    <div class="box col-sm-6">
                                        <div <?= ($status != 'null' && $status->essay_content != '')? 'class="shadow opp"' : 'class="shadow cursor essay_box" data-toggle="modal" data-target="#essay"'; ?>>
                                            <img src="<?= base_url('assets/img/quil.png') ?>" alt="Plant Trees" />
                                            <h3>ESSAY COMPETITION</h3>
                                            <p>The Contestants shall choose a topic from those enlisted below and write an essay that shall be in a minimum of 700 words and not exceeding 800.</p>
                                            <button class="btn btn-default">Submit Now</button>
                                        </div>
                                    </div>
                                    <div class="box col-sm-6">
                                        <div <?= ($status != 'null' && $status->sketch != '')? 'class="shadow opp"' : 'class="shadow cursor drawing_box" data-toggle="modal" data-target="#drawing"'; ?>>
                                            <img src="<?= base_url('assets/img/draw.png') ?>" alt="Refer members" />
                                            <h3>DRAWING COMPETITION</h3>
                                            <p>The Contestants are expected to produce original drawings/paintings depicting topics/situations relevant to our Environment, selecting from the topics below.</p>
                                            <button data-ripple class="btn btn-default">Submit Now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="how">Above competitions shall be centered around the following topics</h4>
                                        <ul>
                                            <li>Eco-friendly lifestyle, to support our planet</li>
                                            <li>Domestic eco-friendly rain water harvesting</li>
                                            <li>Waste management at home</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="win" src="<?= base_url('assets/seso/win.png') ?>" alt="prize" />
                                            </div>
                                            <div class="col-sm-6 details">
                                                <p>Submit your essay entries from</p>
                                                <h4><span>1 - 15</span> July 2017</h4>
                                                <h4>Classes <span>IX - XII</span> only</h4>
                                                <h4>Group 1 - classes <span>IX - X</span></h4>
                                                <h4>Group 2 - classes <span>XI - XII</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="offer_action text-center">
                                    <h3>Join...Win...Spread the Word...Save the World</h3>
                                </div>
                                <div class="text-center">
                                    <a class="link" data-toggle="modal" data-target="#seso_terms">Terms & Conditions</a>
                                    <a class="link" onclick="printPoster()" data-toggle="tooltip" data-placement="top" title="Considering the impact on Environment, we chose not to print brochures and leaflets. However to display details on the School notice board, this e-brochure can be printed and posted or circulated to students through e-mails or other Social Media Platforms.">Print Brochure</a>
                                    <a class="link" id="seso_contact" data-toggle="tooltip" data-placement="top" title="For any queries email us at getintouch@worthact.com or call us on 0471 424 9665">Contact Us</a>
                                </div>
                                <div id="poster">
                                    <img src="<?= base_url('assets/seso/poster.jpg') ?>" alt="poster" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('dashboard/modals/seso_terms'); ?>

<div id="essay" class="seso_modal modal fade blog_add" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_seso_blog_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Submit your Essay</h4>
                </div>
                <div class="modal-body">
                    <?php if($status == 'null') : ?>
                    <div class="form-group">
                        <label>School / College</label>
                        <input type="text" class="form-control" name="school" placeholder="Enter school / college name">
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select data-placeholder="Select Class" class="form-control class_select" name="class">
                            <option></option>
                            <option value="9">IX</option>
                            <option value="10">X</option>
                            <option value="11">XI</option>
                            <option value="12">XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" class="form-control" name="age" placeholder="Enter age">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" name="number" maxlength="150" placeholder="Enter contact number of Parent/Guardian">
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Topic</label>
                        <select data-placeholder="Select Topic" class="form-control class_select" name="topic">
                            <option></option>
                            <option value="1">Eco-friendly lifestyle, to support our planet</option>
                            <option value="2">Domestic eco-friendly rain water harvesting</option>
                            <option value="3">Waste management at home</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" maxlength="150" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="editor_blog" class="form-control" id="editor_blog"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Add Banner image</label>
                        <input type="file" name="blog_upload" id="blog_upload">
                        <p class="help-block">Only jpg | png formats allowed</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="drawing" class="seso_modal modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_drawing">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Submit your Drawing</h4>
                </div>
                <div class="modal-body">
                    <?php if($status == 'null') : ?>
                    <div class="form-group">
                        <label>School / College</label>
                        <input type="text" class="form-control" name="school" placeholder="Enter school / college name">
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select data-placeholder="Select Class" class="form-control class_select" name="class">
                            <option></option>
                            <option value="9">IX</option>
                            <option value="10">X</option>
                            <option value="11">XI</option>
                            <option value="12">XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" class="form-control" name="age" placeholder="Enter age">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" name="number" maxlength="150" placeholder="Enter contact number of Parent/Guardian">
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Topic</label>
                        <select data-placeholder="Select Topic" class="form-control class_select" name="topic">
                            <option></option>
                            <option value="1">Eco-friendly lifestyle, to support our planet</option>
                            <option value="2">Domestic eco-friendly rain water harvesting</option>
                            <option value="3">Waste management at home</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Caption</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter caption">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" placeholder="Enter description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="timeline_photo_upload[]" id="timeline_photo_upload" multiple="multiple">
                        <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>


