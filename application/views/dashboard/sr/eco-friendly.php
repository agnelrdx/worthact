<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'facts') : ?>

<img class="shadow trans wi_img" src="<?= base_url('assets/img/sos/home.jpg'); ?>" alt="Eco friendly Homes">
<h2 class="text-center">Eco friendly Homes</h2>
<p>Concrete is the most widely used building material today as a result of its strength and its durability. It is used in homes, airports, skyscrapers, tunnels and pretty much every other type of construction you can think of. Cement is an ingredient that makes up concrete, along with water, sand and gravel. Cement acts as a hydraulic binding material, hardening with water and tying together all the aggregate materials.</p>
<p>After coal-powered electricity, cement manufacture is the next biggest emitter of greenhouse gases. Concrete causes damage to the most fertile layer of the earth- the topsoil, and it is used to create hard surfaces which contribute to surface runoff causing soil erosion, water erosion, water pollution and flooding.</p>
<p>Concrete dust released by building demolition and natural disasters can be a major source of dangerous air pollution.  Concrete recycling and better practices are increasing in response to improved environmental awareness, legislation, and economic considerations in developed world, but how about developing nations without awareness, strong legislations etc.? The impact is unfathomable.</p>
<p>Here comes the necessity of Eco Friendly building or Green buildings which refers to a structure that is environmental friendly and regulates resource efficiency throughout the building's life cycle.</p>
<p>Green building or eco-friendly building is an idea set with several goals that can improve human life style and also improve the environment's current situation.</p>
<p>Eco friendly living is an act of living with an intention of not harming the environment we live in. An eco-friendly lifestyle extends far beyond switching off lights and separating garbage, it is about changing the purpose of lifestyle, conserving energy, preventing pollution and promoting a green living which is a boon for the environment and all the while preventing health hazards. It’s high time for the humanity to adopt the technologies used by our forefathers in constructions and their way of living.</p>
<p>The first step should be about acting immediately to bring the change in how we live our lives depending on the natural resources and using materials and methods that cause minimal damage to the environment, followed by responsible use of unavoidable facilities such as houses, vehicles and survival items to lessen that imprint to the best of your ability.</p>
<p>The final step we can take is to spread the message and connect with eco-friendly communities and organizations to create a network and lead a sustainable life. It's a way of living, change of perspective. Worthact platform would be a part of this change to make our earth last a little more long for many more generations to come.</p>
<p>Interested worth actors in eco-friendly homes and living are requested to take the next step by exploring the opportunities and possibilities to do a worthy act of your own. Invite like-minded parties and form groups to bring a positive change in your preferred locality. Write blogs, Share your thoughts, actions, experiences, contributions and ideas about Eco-friendly building practices in your society.</p>
<p>Associations, organizations that include engineers and architects, solution providers who work for improving Eco-friendly building practices may post their innovations, expertize and functions to keep our planet clean and healthy.</p>
<?php endif; if($type == 'poss') : ?>
<div class="sos_pos">
    <p>It's the need of the hour for every individual to turn towards Eco-friendly homes and living. We have to live comfortably, but it doesn't have to be in a structure that could harm the environment at every stage.</p>
    <div class="panel-group accordion" id="accordion1">
        <?php if($this->session->userdata('user_type') == '1') : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">As an Individual</a></h5>
            </div>
            <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Could choose to improve their home making it more Eco-friendly, consulting an Eco-friendly Architect.</li>
                        <li>New constructions could be strictly environmental friendly by an Eco-friendly Architect, reducing cement, concrete and other harmful materials.</li>
                        <li>Rooftop farming or kitchen farming.</li>
                        <li>Applying solar and Bio-gas technologies at home or office premises for saving energy.</li>
                        <li>Pledge that your lifestyle wouldn't harm the sustainability of this planet in any way and by choosing to live according to Eco-friendly standards.</li>
                        <li>Pledge to inculcate the same to the next generation.</li>
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
                        <li>Influence and encourage communities or regions to follow the above essential requirements to reduce the impact of drought.</li>
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
                        <li>Enactment of laws providing benefits like tax exemption for Eco-friendly home owners with effective and efficient code of practices.</li>
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
                        <li>Adopt an Eco-friendly construction method for office wherever possible.</li>
                        <li>Making the office eco-friendly by consulting a specialist architect or an engineer.</li>
                        <li>Provide awareness to employees on the importance of adapting Eco-friendly structures and living, through trainings, campaigns, newsletters etc.</li>
                        <li>Fund/Sponsor/Donate only for Eco-friendly constructions, institutions or organizations that build homes for underprivileged.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif;
        $this->load->view('dashboard/sr/sr-scope', $type) ?>
</div>
<?php endif; ?>