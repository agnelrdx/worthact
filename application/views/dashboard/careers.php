<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container careers">
    <div class="row">
        <div class="panel panel-flat clearfix outer">
            <div class="col-sm-12">
                <h2>WorthAct Careers</h2>
            </div>
            <div class="col-sm-6">
                <div class="head">
                    <h3><i class="ion-person-stalker"></i>Regional Coordinators</h3>
                </div>
                <p>WorthAct is looking for volunteers who wish to make a change for a better world by taking responsibility in preferred localities through areas of WorthAct Initiatives.</p>
                <div class="panel-group accordion" id="accordion1">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="false" class="collapsed">Who we want!</a></h5>
                        </div>
                        <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <ul>
                                    <li>Some one genuinely interested about environmental protection and social care.</li>
                                    <li>Some one eager to bring a change in your preferred region.</li>
                                    <li>Some one capable of uplifting valuable citizens with as much awareness as possible.</li>
                                    <li>Some one with a sense of responsibility towards nature and people.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group2" aria-expanded="false" class="collapsed">Age limit!</a></h5>
                        </div>
                        <div id="accordion-group2" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <p>Any one above 18 years.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group3" aria-expanded="false" class="collapsed">Location</a></h5>
                        </div>
                        <div id="accordion-group3" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <p>No geographical limitations. Wherever you wish and can influence to bring a positive change.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group4" aria-expanded="false" class="collapsed">Time limit!</a></h5>
                        </div>
                        <div id="accordion-group4" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <p>Before it's too late!</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group5" aria-expanded="false" class="collapsed">Skills!</a></h5>
                        </div>
                        <div id="accordion-group5" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <ul>
                                    <li>Leadership.</li>
                                    <li>Organizing.</li>
                                    <li>Training skill.</li>
                                    <li>Good Communication.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group6" aria-expanded="false" class="collapsed">Experience!</a></h5>
                        </div>
                        <div id="accordion-group6" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <p>Anyone passionate enough to address environmental and social challenges are welcome. However, experienced candidates are preferred.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title"><a class="trans" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group7" aria-expanded="false" class="collapsed">Roles and Responsibilities!</a></h5>
                        </div>
                        <div id="accordion-group7" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <ul>
                                    <li>Execute WorthAct Campaigns and update the credentials in WorthAct website.</li>
                                    <li>Coordinate with organisations and individuals on behalf of WorthAct.</li>
                                    <li>Network development in the region.</li>
                                    <li>To create groups and upload activities in the areas of initiatives with a measurable performance.</li>
                                    <li>Find local sponsors for regional events.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="last">Interested well wishers can forward your bio-data with a description reflecting your passion and goal. </p>
            </div>
            <div class="col-sm-6">
                <div class="head">
                    <h3><i class="ion-email"></i>Apply Now</h3>
                    <form id="career_submit" class="shadow">
                        <div class="form-group">
                            <input class="form-control" name="subject" type="text" placeholder="Enter subject" />
                        </div>
                        <div class="form-group">
                            <textarea name="cover" placeholder="Cover letter" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload your CV</label>
                            <input type="file" name="cv_upload" id="cv_upload">
                            <p class="help-block">Only pdf | doc | docx formats allowed.</p>
                        </div>
                        <div class="form-group text-right last">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button type="submit" data-ripple class="btn btn-primary">Submit</button>
                        </div>
                        <div class="alert alert-danger" role="alert"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  