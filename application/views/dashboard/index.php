<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container home_sos">
    <div class="row">
        <div class="banner">
            <div class="col-sm-6 background">
                <div class="content">
                    <div class="valign">
                        <h2>Take your first step with faith</h2>
                        <p>WorthACT is a belief that sustainability of the Earth comes first, and a practice that puts our beliefs into action. WorthACT is a movement, developing solutions and skills for a lifestyle to sustain the Earth, as our actions are tied to changes in ecology and essential values of all living beings.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="home_sos_carousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#home_sos_carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#home_sos_carousel" data-slide-to="1"></li>
                        <li data-target="#home_sos_carousel" data-slide-to="2"></li>
                        <li data-target="#home_sos_carousel" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?= base_url('assets/img/inner_one.jpg'); ?>" alt="banner1">
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets/img/inner_two.jpg'); ?>" alt="banner2">
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets/img/inner_three.jpg'); ?>" alt="banner3">
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets/img/inner_four.jpg'); ?>" alt="banner3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading clearfix">
            <div class="col-sm-5 col">
                <div class="content clearfix">
                    <img src="<?= base_url('assets/img/globe.gif'); ?>" alt="banner1">
                    <h2>Let the small changes make a <span>big difference</span></h2>
                </div>
            </div>
            <div class="col-sm-7 col">
                <div class="content">
                    <p>WorthACT is different. Our initiatives are our concerns. Select your area of interest, explore your possibilities on how to make a change, perform a good deed and post them as your SOS action under the SOS tab.</p>
                </div>
            </div>
        </div>
        <div class="w_sos clearfix">
            <a href="<?= base_url('dashboard/worthact_initiatives/1'); ?>">
                <div class="col">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/aff_banner.jpg'); ?>" alt="Afforestation">
                        </div>
                        <h4 class="trans">Afforestation</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/2'); ?>">
                <div class="col">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/animal_banner.jpg'); ?>" alt="Animal Care">
                        </div>
                        <h4 class="trans">Animal Care</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/4'); ?>">
                <div class="col">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/drought_banner.jpg'); ?>" alt="Drought Resistance">
                        </div>
                        <h4 class="trans">Drought Resistance</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/5'); ?>">
                <div class="col">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/eco_banner.jpg'); ?>" alt="Eco friendly Homes">
                        </div>
                        <h4 class="trans">Eco friendly Homes</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/3'); ?>">
                <div class="col last">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/cancer_banner.jpg'); ?>" alt="Cancer Care">
                        </div>
                        <h4 class="trans">Cancer Care</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/10'); ?>">
                <div class="col lvl_2">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/waste_banner.jpg'); ?>" alt="Waste Management">
                        </div>
                        <h4 class="trans">Waste <br/>Management</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/9'); ?>">
                <div class="col lvl_2">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/rural_banner.jpg'); ?>" alt="Rural Development">
                        </div>
                        <h4 class="trans">Rural <br/>Development</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/7'); ?>">
                <div class="col lvl_2">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/water_banner.jpg'); ?>" alt="Preservation of Water Bodies">
                        </div>
                        <h4 class="trans">Preservation of <br/>Water Bodies</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/6'); ?>">
                <div class="col lvl_2">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/organ_banner.jpg'); ?>" alt="Organ Donation">
                        </div>
                        <h4 class="trans">Organ <br/>Donation</h4>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('dashboard/worthact_initiatives/11'); ?>">
                <div class="col lvl_2 last">
                    <div class="valign">
                        <div class="img">
                            <img class="shadow trans" src="<?= base_url('assets/img/sos/women_banner.jpg'); ?>" alt="Women Empowerment & Child Welfare">
                        </div>
                        <h4 class="trans">Women Empowerment & Child Welfare</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="action clearfix">
            <div class="col-sm-7">
                <div class="background_2">
                    <h4>Explore for more information</h4>
                </div>
            </div>
            <div class="col-sm-5 action_button">
                <div class="content">
                    <a href="" data-ripple data-toggle="modal" data-target="#aim">Aim</a>
                    <a href="" data-ripple data-toggle="modal" data-target="#oppor">Opportunities</a>
                    <a href="" data-ripple data-toggle="modal" data-target="#poss">Possibilities</a>
                </div>
            </div>
        </div>
        <div class="timeline_home clearfix">
            <div class="col-sm-6">
                <iframe style="width: 100%; height: 270px;" src="https://www.youtube.com/embed/sOVjSrXQwT4?rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-6">
                <div class="block">
                    <a href="<?= base_url('dashboard/timeline'); ?>"><h4 class="block_title">Timeline</h4></a>
                    <div id="timeline" class="nano">
                        <div class="main nano-content"><div class="overlay"></div><?php if($status != 'incomplete') { echo $feed; } ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('dashboard/modals/opportunities'); ?>
    
    <?php $this->load->view('dashboard/modals/possibilities'); ?>
    
    <?php $this->load->view('dashboard/modals/aim'); ?>
    
    <?php if($status != 'incomplete' && $this->session->userdata('user_type') == '1' && $this->session->userdata('offer_modal') == 1) : ?>
    <div class="modal fade" id="offer_home" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <a href="<?= base_url('dashboard/seso') ?>"><img src="<?= base_url('assets/img/seso_modal.jpg') ?>" alt="offer" /></a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->session->set_userdata('offer_modal', 2); endif; ?>
    
    <?php if($status == 'incomplete') { $this->load->view('dashboard/modals/add_info'); } ?>
</div>
