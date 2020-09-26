<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'facts') : ?>
<img class="shadow trans img-responsive wi_img" src="<?= base_url('assets/img/sos/plant.jpg'); ?>" alt="Afforestation">
<h2 class="text-center">Afforestation</h2>
<p>We have had in a bountiful supply, thick forests and plantations that has helped us maintain our world since the time of beginning. It is the cosmic law to give and take. If the balance is not maintained things can go wrong in many levels.</p>
<p>We humans have only created as much as to emit carbon dioxides and chemicals to the atmosphere; but not to revert this process. This is where the forests and the plants play their role. Forests helps in absorbing the carbon dioxide and give out oxygen for the rest of species of living beings.</p>
<p>Forests are cleared at an alarming rate on meeting the demand of global communities. Agriculture, urbanization, mining and forest fires are some of the main reasons why we face an environmental crisis as forests and trees form the backbone in holding all the other ecology factors together.</p>
<p>Trees and forests not only purifies the air we breathe but also provide sufficient shade that cools the earth, regulating regional temperature.</p>
<p>Forests are can be compared to sponges that absorb pollutants. Purifying air is what we all are aware about, but trees that are thrive along river banks and areas that receive heavy rainfall, can block chemicals or wastes with its roots much similar to preventing soil erosion.</p>
<p>The very exposure to forests can boost creativity, speed up recovery of some diseases, encourage meditation, mindfulness and even helps us live longer.</p>
<p>Last but not least the natural beauty which is an obvious benefit convinces us to appreciate and preserve forests for generations to come.</p>
<p>So as you can see, it is impossible for humans to survive without forests and greenery, however it is up to us to make sure we never have to try.</p>
<p>A chain of events can take place locally and around the world by degradation of forests that are complex ecosystems which will affect almost every species on the planet. In order to restore ecological balance of all ecosystems, natural plantation or artificial seeding process to restructure the forest cover is the only remedy; Afforestation- even though it is not a binding solution for the damage caused by the never ending emission of carbon dioxide into the atmosphere – courtesy humans..!!</p>
<p>Interested worth actors on Afforestation are requested to take the next step by exploring the opportunities and possibilities to do a worthy act of your own. Invite like-minded parties and form groups to bring a positive change in your preferred localities by planting trees anywhere possible and make our areas green. Write blogs, Share your thoughts, actions, experiences, contributions and ideas for Afforestation.</p>
<p>Organizations/associations and individuals who work for afforestation may post ads on your activities and requirements where other interested parties can join and contribute respectively.</p>
<img src="<?= base_url('assets/img/graphs/deforestation.jpg'); ?>" class="img-responsive" />
<?php endif; if($type == 'poss') : ?>
<div class="sos_pos">
    <p>Stop complaining! Talks will not yield results. Do an SOS action and post it.</p>
    <div class="panel-group accordion" id="accordion1">
        <?php if($this->session->userdata('user_type') == '1') : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">As an Individual</a></h5>
            </div>
            <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Plant trees; 'Earth's Lungs', around your home premises or anywhere legally possible. It gives you shade, reduces the heat, supplies pure oxygen etc. apart from all, you are becoming a creator not a destroyer.</li>
                        <li>Pledging to inculcate to the next generation the preservation of greenery and planting of trees wherever possible.</li>
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
                        <li>Can go that extra mile by taking initiatives to afforest a selected area or barren lands in preferred locality, legally, with the support of local bodies and authorities.</li>
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
                        <li>The respected personal is supposed to realize the potential threat the Environment may face and take actions to protect the remaining trees, afforest barren lands, influence people to cultivate trees wherever possible and work towards enacting laws to protect the ecology of your area of responsibility.</li>
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
                        <li>Plant trees around the boundaries and make office premises green.</li>
                        <li>Employee awareness on the importance of trees, its role in nature and related topics through newsletters, campaigns, trainings etc.</li>
                        <li>Fund/Donate Green Organizations to afforest and nurture trees.</li>
                        <li>Initiatives to afforest barren lands and public places with the support of local authority.</li>
                        <li>Sponsor/Volunteer any organization that involves in afforestation.</li>
                        <li>Permission to interested staff members to plant trees in respective public places as part of any environmental movement.</li>
                        <li>Sponsoring tree saplings to employees encouraging them to create a greener home premise.</li>
                        <li>Form and lead local forestry clubs for youngsters to inculcate the values of trees, plants and forests, through camping and eco-tourisms.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif;
        $this->load->view('dashboard/sr/sr-scope', $type) ?>
</div>
<?php endif; ?>
