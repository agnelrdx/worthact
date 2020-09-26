<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'facts') : ?>

<img class="shadow trans img-responsive wi_img" src="<?= base_url('assets/img/sos/drought.jpg'); ?>" alt="Afforestation">
<h2 class="text-center">Drought Resistance</h2>
<p>We hear a lot about drought, water scarcity - main stream media reports and speeches; however we see grocery stores lining up freshly packed water in shiny transparent plastic bottles in shelves, clean water flowing and dashing in fountains at city centres and public squares, beautiful lakes and ponds, and many more.</p>
<p>So what exactly is this 'drought' they have been mentioning and how bad is it? Drought is a continuous dry weather effect on a region that receives less rain than its normal quantity for a very long period of time.. And it’s dreadful!</p>
<p>Drought is the single most horrific and least understood natural crisis that the world must realize.</p>
<p>Drought is not an easy task to respond to; for one thing, predicting and foreseeing the crisis and hazards have to be improved. Events can turn into disasters without improved forecasts. Globally, actions taken against drought were ineffective as the figures and forecasts are unclear and not reliable; this makes it uncertain what drought has in store for us to take a preventive measure.</p>
<p>Whatever the sources or figures are, attention and action is required immediately without waiting for improved statistics and calculations.</p>
<p>It is the responsibility of each one of us to take matters into our own hands without further delay.</p>
<p>Why? One of the main causes for drought are none other than human activities itself like deforestation, excessive irrigation, unnatural effects on soil by chemical products we use, concreting, tiling of grounds preventing rain water absorption to the earth and soil erosions due to the cutting down of trees are some of the exacerbating factors that impact the ability of the land from holding water.</p>
<p>In nature, ecosystems are interconnected with each other. If ever we take advantage of one minor factor thinking it wouldn't make a change, in reality it can simply cause a dominos effect to affect rest of the ecosystems causing a global crisis.</p>
<p>Human activities that cause deforestation, affects earth's atmospheric temperature that directly impacts the rainfall quantity, leading to more temperature rise which vaporizes the natural water bodies to maintain the humidity, causing water wells and water sources for all living beings to diminish.</p>
<p>So you see, it all comes back to us, what you give is what you get. Do we still need a reason for why we shouldn't fight for our right to live a healthy environmental life? It is our fault and now it is our responsibility! We still have a chance to fix it. Do it!</p>
<p>Interested worth actors to work on the drought resistance are requested to take the next step by exploring the opportunities and possibilities to do a worthy act of your own. Invite like-minded parties and form groups to bring a positive change in your preferred locality. Write blogs, Share your thoughts, actions, experiences, contributions and ideas to resist drought in your society.</p>
<p>Associations, organizations, solution providers who work for drought resistance may post their innovations, expertize and functions to keep our planet safe from thirst.</p>
<img src="<?= base_url('assets/img/graphs/drought.jpg'); ?>" class="img-responsive" />
<?php endif; if($type == 'poss') : ?>
<div class="sos_pos">
    <p>Drought, a dreadful after effect man himself has caused following his pursuance for luxurious living. It is not easy to replenish the earth's resources as human activities have impacted drastically due to uncontrolled population growth. However, nothing is impossible, though hardly we have any topsoil left where modern man inhabits.</p>
    <div class="panel-group accordion" id="accordion1">
        <?php if($this->session->userdata('user_type') == '1') : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">As an Individual</a></h5>
            </div>
            <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Should ensure at least 80-90% of earth surface around your home or office premises are open and terraced to contain and absorb the rain water.</li>
                        <li>Existing concreted or tiled surfaces (80-90%) around your home or office premises to be removed and replaced with Eco-friendly solutions meeting both rain water absorption and individual needs.</li>
                        <li>Apply rain water harvesting methods at your home and office premises.</li>
                        <li>Plant drought resistant lawns.</li>
                        <li>Pledge that you wouldn’t block the top soil around you anywhere from rain water absorption and would inculcate the same to the next generation.</li>
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
                        <li>Influence and encourage others in the community or area to follow the above essential requirements to reduce the impact.</li>
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
                        <li>The respected personal is supposed to realize the adverse impact on the soil due to population growth.</li>
                        <li>Enactment of law if required, or use of the existing law if sufficient, to prevent encroachment of public land and any constructions on it.</li>
                        <li>Enactment of the law, implementing construction code of practice through Eco-friendly solutions, where it would only allow about 10-20% of ground around the house plan to be covered, if necessary.</li>
                        <li>Maximum awareness and publicity to educate the public about the need for preservation of our soil and rain water.</li>
                        <li>Strict and effective enforcement of rain water harvesting methods for new construction permits.</li>
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
                        <li>Creating a greener office atmosphere or surrounding.</li>
                        <li>Reduction on concreting or tiling soil surfaces and creating terraced surfaces to increase rain water absorption by the soil.</li>
                        <li>Influence and encourage the employees to adopt drought resistance measures (like above), through training campaigns and newsletters etc.</li>
                        <li>Drought resistance lawns at available office premises.</li>
                        <li>Adopt rain water harvesting methods in office premises.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif;
        $this->load->view('dashboard/sr/sr-scope', $type) ?>
</div>
<?php endif; ?>