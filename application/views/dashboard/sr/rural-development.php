<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'facts') : ?>

<img class="shadow trans wi_img" src="<?= base_url('assets/img/sos/rural.jpg'); ?>" alt="Rural Development">
<h2 class="text-center">Rural Development</h2>
<p>Rural development is the process of improving the quality of life and economic well-being of people living in relatively isolated and sparsely populated areas.</p>
<p>Quality of living and economic well-being of people are the core values for a developed area/region.</p>
<p>In general, rural development is considered similar to charity where we simply donate money and raise an awareness. Yes, we can help the development financially but development is not always based on money alone. In Many countries the major drawback is lack of information and availability. Setting a major example; India, which has its glorious and powerful stand on World politics and defense matters to flaunt, also has a huge 22 percentage of population that is below poverty line. A country with the second largest population in the world, 22 percentage is undoubtedly huge.</p>
<p>Like India, there are many other nations which face similar scenarios.</p>
<p>But wait! Does this mean rural areas are being urbanized completely?</p>
<p>This is another misconception people are fed with. Rural regions are still the backbone of the nation or the world. There comes a time in our life when we rush ahead towards the urban side of the country to grow, work and earn a living. After achieving all that, reality hits and we realize happiness and satisfaction is back where we are from.</p>
<p>The imbalance caused due to ignorance and purposeful avoidance of rural areas has not only affected a loss of integrity but also a degradation in standard of lifestyle. So what can be done for this change? What do we have in much quantity and quality that we can share to the rural area and altruistically benefit from it</p>
<p>Let's go through it</p>
<ul>
    <li>Education to the farmers to protect their rights</li>
    <li>Establishment of night schools for adults</li>
    <li>Improvement of sanitation </li>
    <li>Provisions for cheap medical aid </li>
    <li>Construction of eco-friendly infrastructure facilities</li>
    <li>Establishment of co-operative credit societies</li>
</ul>
<p>We only help ourselves by helping the society and the people who live in this world. Setting aside a small portion of our time and wealth can help a lot of lives, we encourage you to use our platform to create a network with similar minded people and make changes happen.</p>
<p>Interested worth actors in Rural development are requested to take the next step by exploring the opportunities and possibilities to do a worthy act of your own. Invite like-minded parties and form groups to bring a positive change in your preferred Rural Areas. Write blogs, Share your thoughts, actions, experiences, contributions and ideas for Rural Development.</p>
<p>Organizations/associations and individuals who work for rural development may post ads on your activities and requirements where interested parties can join and contribute respectively.</p>
<?php endif; if($type == 'poss') : ?>
<div class="sos_pos">
    <p>Healthy village - healthy world. Villages are our food factory. Taking care of our farmers, their agricultural lands and their well-beings are our social responsibility.</p>
    <div class="panel-group accordion" id="accordion1">
        <?php if($this->session->userdata('user_type') == '1') : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">As an Individual</a></h5>
            </div>
            <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Could adopt a farm or assist an underprivileged farmer.</li>
                        <li>Support medical expenses or sponsor medical insurance.</li>
                        <li>Support or sponsor a farmer's children's education.</li>
                        <li>Pledge to respect the farmers and work for their basic infrastructure and well-being and inculcate that habit of respect to the next generation.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group2" aria-expanded="true" class="collapsed trans">As a Leader</a></h5>
            </div>
            <div id="accordion-group2" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Could possibly form a group to protect farmer's interests in a region.</li>
                        <li>Training and awareness on cleanliness and health.</li>
                        <li>Strategies for better facilities to farmers and its execution with the support of local communities and authorities.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group3" aria-expanded="true" class="collapsed trans">As an elected representative of a locality or a region or province for any law making bodies</a></h5>
            </div>
            <div id="accordion-group3" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Devise strategies to protect farmer's life and their interests in their respective locality and execute it.</li>
                        <li>Challenges that cannot be resolved locally should be taken to a higher legislative branch to ensure a solution.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php else : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group3" aria-expanded="true" class="collapsed trans">As a Company</a></h5>
            </div>
            <div id="accordion-group3" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Could adopt a farm or support one or a group of underprivileged farmers in a locality.</li>
                        <li>Support Medical expenses or sponsor medical insurance for a group of farmers.</li>
                        <li>Sponsor farmer's children's education.</li>
                        <li>Influence and provide awareness to the employees about the need of protecting and supporting poor farmers in rural areas, through campaigns, trainings, newsletters etc.</li>
                        <li>Sponsor programs for the benefit of the farmers and rural areas like, cleanliness and health.</li>
                        <li>Adopt a village and make it smart through best technology available.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif;
        $this->load->view('dashboard/sr/sr-scope', $type) ?>
</div>
<?php endif; ?>