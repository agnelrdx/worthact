<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container terms about">
    <div class="row">
        <?php if($this->info->is_complete <= 0): ?>
        <ul class="breadcrumb">
            <li><a class="trans" href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="active">About</li>
        </ul>
        <?php endif; ?>
        <div class="panel panel-flat clearfix">
            <div class="col-sm-6">
                <h2>About WorthAct</h2>
                <?php if($this->session->userdata('timezone') == 'Asia/Kolkata' || $this->session->userdata('timezone') == 'Asia/Calcutta'): ?>
                <p>WorthAct Enterprise is a humble effort to join forces of conscientious people who work for sustainability of this planet. Our planet Earth, without which we cannot exist is in disaster mode. In fact, human intelligence could not muster enough maturity to consider Environment sustenance before any inventions or discoveries were made for so called humanity.</p>
                <p>Now when we realize the Impact, enough damage has been done. Whopping population growth influenced by various socio, religious reasons are adding fuel to the fire. The disaster is too close as majority of the population reacts emotionally to socio economic and related issues with access to latest technologies and gadgets. Our planet Earth, is the only heaven we know. It's our home, and all the living beings around co-exist with us as one family. WorthAct Enterprise was formed to explore ways to sustain an eco-friendly existence and to do our bit for our planet. 'WorthAct – For a better world' the e-platform is for all those who can relate to the situation and wish to contribute their efforts and time on building a better environment.</p>
                <p>WorthAct resulted out of intense pain observing the ecological ruins and utter negligence to the environment around the planet. It is being launched with great hope, connecting with some fascinating people around the globe, who are intelligent enough to understand the reality and together to make a change.</p>
                <p>Getting inspired from great visionary leaders like His Excellency Sheikh Mohammad Bin Rashid Al Maktoum – Vice President and Prime Minister of UAE and Ruler of Dubai, Honourable PM of India Mr. Narendra Modi and world renowned mystic -Sadhguruji, we are starting our mission in India in very humble surroundings but with truly great vision.</p>
                <?php else : ?>
                <p>WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet. Our planet Earth, without which we cannot exist is in disaster mode. In fact, human intelligence could not muster enough maturity to consider Environment sustenance before any inventions or discoveries were made for so called humanity.</p>
                <p>Now when we realize the Impact, enough damage has been done. Whopping population growth influenced by various socio, religious reasons are adding fuel to the fire. The disaster is too close as majority of the population reacts emotionally to socio economic and related issues with access to latest technologies and gadgets. Our planet Earth, is the only heaven we know. It's our home, and all the living beings around co-exist with us as one family. WorthAct initiatives was formed to explore ways to sustain an eco-friendly existence and to do our bit for our planet. 'WorthAct – For a better world' the e-platform is for all those who can relate to the situation and wish to contribute their efforts and time on building a better environment.</p>
                <p>WorthAct resulted out of intense pain observing the ecological ruins and utter negligence to the environment around the planet. It is being launched with great hope, connecting with some fascinating people around the globe, who are intelligent enough to understand the reality and together to make a change.</p>
                <p>Getting inspired from great visionary leaders like His Excellency Sheikh Mohammad Bin Rashid Al Maktoum – Vice President and Prime Minister of UAE and Ruler of Dubai, Honorable PM of India Mr. Narendra Modi and Sadhguruji – A world renowned mystic, we started our mission in Aspin Tower, Sheikh Zayed Road, Dubai in January 2017 in very humble surroundings but with a truly great vision.</p>
                <?php endif; ?>
            </div>
            <div class="col-sm-6">
                <h2>Our Mission</h2>
                <p>To create a generation of selfless world conscious about their social responsibility to preserve the natural resources, protect the environment and support the needy through worthy actions.</p>
                <h2 class="vision">Our Vision</h2>
                <p>Play a major role to influence the societies in large for actions to protect the Environment, preserve the natural resources, support the needy and sustain this planet better.</p>
                <iframe style="width: 100%; height: 315px; margin-top: 25px;" src="https://www.youtube.com/embed/Y2Uthq_0Iv4?rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>      