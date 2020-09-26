<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row listing">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <div class="panel panel-flat panel-lisitng" id="acc_listing">
                <div class="panel-heading">
                    <h5 class="panel-title">WorthAct Initiatives</h5>
                </div>
                <div class="panel-body">
                    <ul class="list-group clearfix">
                        <li class="list-group-item"><a data-cat-id="1" class="sub-cat-item trans">Afforestation</a></li>
                        <li class="list-group-item"><a data-cat-id="2" class="sub-cat-item trans">Animal Care</a></li>
                        <li class="list-group-item"><a data-cat-id="4" class="sub-cat-item trans">Drought Resistance</a></li>
                        <li class="list-group-item"><a data-cat-id="5" class="sub-cat-item trans">Eco friendly Homes</a></li>
                        <li class="list-group-item"><a data-cat-id="7" class="sub-cat-item trans">Preservation of Water Bodies</a></li>
                        <li class="list-group-item"><a data-cat-id="10" class="sub-cat-item trans">Waste Management</a></li>
                        <li class="list-group-item"><a data-cat-id="9" class="sub-cat-item trans">Rural Development</a></li>
                        <li class="list-group-item"><a data-cat-id="3" class="sub-cat-item trans">Cancer Care</a></li>
                        <li class="list-group-item"><a data-cat-id="6" class="sub-cat-item trans">Organ Donation</a></li>
                        <li class="list-group-item"><a data-cat-id="11" class="sub-cat-item trans">Women Empowerment &amp; Child Welfare</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="panel panel-flat post-search">
                <div class="panel-heading">
                    <h5 class="panel-title">Search by location</h5>						
                </div>
                <div class="panel-body">
                    <div class="form-group country_search_box">
                        <select class="country-search" onchange="filter_post(this.options[this.selectedIndex].value)">
                            <option value='0'>Choose Country</option>
                            <?php foreach($countries as $country) : ?>
                            <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>
                </div>     
            </div>
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-left">
            <div class="panel panel-flat panel-lisitng" id="acc_listing">
                <div class="panel-heading">
                    <h5 class="panel-title">WorthAct Initiatives</h5>
                </div>
                <div class="panel-body">
                    <ul class="list-group clearfix">
                        <?php foreach ($allcat as $cat) : ?>
                        <li class="list-group-item"><a data-cat-id="<?= $cat->id; ?>" class="sub-cat-item trans"><?php echo $cat->category; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <div class="panel panel-flat post-search">
                <div class="panel-heading">
                    <h5 class="panel-title">Search by location</h5>						
                </div>
                <div class="panel-body">
                    <div class="form-group country_search_box">
                        <select class="country-search" onchange="filter_post(this.options[this.selectedIndex].value)">
                            <option value='0'>Choose Country</option>
                            <?php foreach($countries as $country) : ?>
                            <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>
                    <a id="reset-post" class="trans">Reset all</a>
                </div>     
            </div>
        </div>
        <?php endif; ?>
        
        <div class="col-sm-6 row-center">
            <?= $this->session->flashdata('msg'); ?>
            <?php $cat_array = array(1, 2, 3, 4, 5, 6, 7, 9, 10, 11); if(in_array($open, $cat_array)) { echo '<img class="load_wi_loader" src="'.base_url('assets/img/reload.svg').'" id="loader_main" alt="loader" />'; } ?>
            <div class="top-nav-tab" <?php if(in_array($open, $cat_array)) { echo 'style="display: none"'; } ?>>
                <ul class="nav nav-tabs nav-tabs-solid nav-justified nav-lg shadow">
                    <li class="<?php if($open == '') { echo 'active'; } ?> info"><a href="#info" data-toggle="tab"><i class="ion-android-globe"></i> Facts</a></li>
                    <li class="actions"><a href="#actions" data-toggle="tab"><i class="ion-flag"></i> <span></span></a></li>
                    <li class="<?php if($open == 'create') { echo 'active'; } ?>"><a <?php if($this->session->userdata('sos') == 1) { echo 'onclick="sos_message()"'; $this->session->set_userdata('sos', 2); } ?> href="#ad_tab" data-toggle="tab"><i class="fa fa-star"></i> SOS</a></li>
                </ul>
                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader_main" alt="loader" />
            </div>
            
            <div class="social tabbable" <?php if(in_array($open, $cat_array)) { echo 'style="display: none"'; } ?>>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane <?php if($open == '') { echo 'active'; } ?>" id="info">
                        <div class="info_cover shadow">
                            <div class="main_data"></div>
                            <a class="trans" id="read_less_info">Read Less</a>
                            <div class="readmore clearfix">
                                <a class="trans" id="read_more_info">Read More</a>
                                <a class="trans" id="read_full_info">Read Full</a>
                            </div>
                        </div>
                        <div id="user">
                            <h4 class="head">Related Users</h4>
                            <div class="row main"></div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane <?php if($open == 'create') { echo 'active'; } ?>" id="ad_tab">
                        <p class="sos shadow text-justify">Become a Healer. Our planet would be more beautiful if every human being can take care of it. Extinction is not so far away. Time has come for us to begin an Eco-friendly lifestyle and to contribute. Be the reason for change. Perform any initiatives of your interests from WorthAct Initiatives.</p>
                        <p class="sos shadow clearfix" data-count="0">Post your <span onclick="sos_message('yes')">SOS Actions or Ads</span> about a need, to inspire or to spread awareness for the ones who wish to support.<br/><a class="trans sos-adbtn shadow" data-toggle="modal" data-target="#add_listing">Post Now</a></p>
                        <div id="listing_table" data-cat-id="" data-subcat-id="" data-country=""></div>
                        <a onclick="load_more_post()" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg'); ?>" id="loader" alt="loader" /></a>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane shadow" id="actions">
                        <div class="main">
                            <p>The possibilities here, enlists various methods on how one can contribute in each areas of WorthAct initiatives to bring changes and create a better world.</p>
                            <div class="panel-group accordion" id="accordion1">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">Technical Solutions</a></h5>
                                    </div>
                                    <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To provide technical solutions or guidance for a member or a group involved in any of the WorthAct Initiatives areas.</p>
                                            <p>E.g.: A solution provider can advise about technologies available to help from severe drought scenarios.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group2" aria-expanded="true" class="collapsed trans">Financial Support</a></h5>
                                    </div>
                                    <div id="accordion-group2" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To support directly the individuals or groups involved in reinvigorating the nature or weaker section of society.</p>
                                            <p>E.g.:  Financial supports to individuals and groups involved in genuine causes or projects such as child welfare, cancer care, afforestation etc.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group3" aria-expanded="true" class="collapsed trans">Public Awareness and Training</a></h5>
                                    </div>
                                    <div id="accordion-group3" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To conduct trainings and awareness sessions about global environmental or social challenges and how one individual at a time can create changes for good. </p>
                                            <p>E.g.: Conduction of seminar and trainings for communities residing near riverbanks about preservation of water bodies, afforestation and soil erosion etc. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group4" aria-expanded="true" class="collapsed trans">Legal Solutions</a></h5>
                                    </div>
                                    <div id="accordion-group4" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To identify the legal loop holes that compromises environmental or ecological values and to work for legal frameworks to preserve these values.</p>
                                            <p>E.g.: In some parts of the world the legal loop holes in demolition of buildings and disposal of construction wastes leads to serious soil pollutions. Such loop holes must be put to an end by raising the matter to authorities.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group5" aria-expanded="true" class="collapsed trans">Reporting of an Ecological Exploitation</a></h5>
                                    </div>
                                    <div id="accordion-group5" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To report any human action that adversely effects the socio- environmental values.</p>
                                            <p>E.g.: Reporting or spreading awareness of communities that practice crimes such as river sand mining, quarrying in mountain regions, sandalwood mafia etc.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group6" aria-expanded="true" class="collapsed trans">Volunteering</a></h5>
                                    </div>
                                    <div id="accordion-group6" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To volunteer spearheading environmental and social causes and bring changes in any of the WorthAct Initiatives in your preferred locality. </p>
                                            <p>E.g.: Volunteering for the process of afforestation in respective regions.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group7" aria-expanded="true" class="collapsed trans">Sponsorships</a></h5>
                                    </div>
                                    <div id="accordion-group7" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To sponsor individuals, families, communities or even causes, as a helping hand to benefit the environment and social values.</p>
                                            <p>E.g.: Sponsoring tree saplings to plant in respective regions or to sponsor the expense to clean the pollution from static or flowing water bodies.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group8" aria-expanded="true" class="collapsed trans">Reporting of Best Practices</a></h5>
                                    </div>
                                    <div id="accordion-group8" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To appreciate the good deeds and to create inspirations of those who bring changes in any of the WorthAct Initiatives areas.</p>
                                            <p>E.g.: Sharing about the best waste management system that is successful in a specific region.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group9" aria-expanded="true" class="collapsed trans">Adoption</a></h5>
                                    </div>
                                    <div id="accordion-group9" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To take responsibility selflessly and improve the lifestyle of both social and environment.</p>
                                            <p>Eg: Adoption of a needy family or a village complying the local laws.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group10" aria-expanded="true" class="collapsed trans">Highlight Scope for improvement</a></h5>
                                    </div>
                                    <div id="accordion-group10" class="panel-collapse collapse" aria-expanded="true">
                                        <div class="panel-body">
                                            <p>To support our movement for the betterment of world and the all the ecologies in it, the least one can provide is honest feedbacks and suggestions in how we can improve our platform and help us reach our intentions the farthest.</p>
                                            <p>E.g.: Feedbacks and reports about functionalities and quality of WorthAct Initiatives.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ?>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/ads/block_5', $this->adv) ?>
            
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            
            <?php $this->load->view('dashboard/ads/block_6', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>

        <?php $this->load->view('dashboard/modals/add-delete-post', $countries); ?>
        
        <?php $this->load->view('dashboard/modals/likes'); ?>
        
        <?php $this->load->view('dashboard/modals/share'); ?>
    </div>
</div>
