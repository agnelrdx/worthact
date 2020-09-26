<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container terms adv-create">
    <div class="panel panel-flat clearfix">
        <div class="head">
            <h3>Advertisement Manager <i onclick="window.history.back()" class="ion-android-arrow-back" title="Go Back"></i></h3>
            <div class="country-block">
                <select data-placeholder="Select your country" class="form-control country-select" onchange="page_block(this.options[this.selectedIndex].value)">
                    <option></option>
                    <option value="global">Global</option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="page-block" data-country="">
                <select data-placeholder="Choose from the options below" class="form-control page-select" onchange="viewport_block(this.options[this.selectedIndex].value)">
                    <option></option>
                    <option value="home">Home</option>
                    <option value="worthact_initiatives">Initiatives</option>
                    <option value="blog">Blog</option>
                    <option value="joblisting">Jobs</option>
                    <option value="profile">Profile</option>
                </select>
            </div>
            <div class="view-block" data-page="">
                <select data-placeholder="Choose your view port" class="form-control view-select" onchange="ad_blocks(this.options[this.selectedIndex].value)">
                    <option value=""></option>
                    <option value="1">one</option>
                    <option value="2">two</option>
                </select>
            </div>
        </div>
        <div class="blocks v1">
            <div class="col-sm-3">
                <h4>Left</h4>
                <div data-id="block_1" class="box">
                    <div class="align">
                        <p class="size">300 x 200</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Timeline</h4>
                <div data-id="block_3" class="box">
                    <div class="align">
                        <p class="size">600 x 600</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h4>Right</h4>
                <div data-id="block_5" class="box">
                    <div class="align">
                        <p class="size">300 x 300</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div data-id="block_7" class="box">
                    <div class="align">
                        <p class="size">600 x 600</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="blocks v2">
            <div class="col-sm-3">
                <h4>Left</h4>
                <div data-id="block_2" class="box">
                    <div class="align">
                        <p class="size">300 x 200</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Timeline</h4>
                <div data-id="block_4" class="box">
                    <div class="align">
                        <p class="size">600 x 600</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h4>Right</h4>
                <div data-id="block_6" class="box">
                    <div class="align">
                        <p class="size">300 x 300</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div data-id="block_8" class="box">
                    <div class="align">
                        <p class="size">600 x 600</p>
                        <p class="avail">Available from <span></span></p>
                        <p class="booked"><i class="ion-alert"></i> Booked</p>
                        <p class="on">Available on <span></span></p>
                        <a class="buy_now" data-ripple data-id="" data-country="" data-page="" data-view="" data-name="">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('dashboard/modals/adv-add'); ?>
    </div>
</div>   