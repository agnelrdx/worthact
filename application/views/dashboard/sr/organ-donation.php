<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'facts') : ?>

<img class="shadow trans wi_img" src="<?= base_url('assets/img/sos/organ.jpg'); ?>" alt="Organ Donation">
<h2 class="text-center">Organ Donation</h2>
<p>We have a tendency of not taking something into consideration unless it matters to us. There are moments in our life when we wish miracles could happen; medical science has reached out so far that lives can be improved or saved miraculously by transplantation of tissue and organs. Organ donation is a selfless act of transplanting organs from one human body to the other. Mostly the donor chooses to donate after death, however there are organs that can be transplanted from a living body as well.  There are instances when few individuals lose their vital body organs due to some ailments. In such cases, organs are transmitted to the patient’s body if the replacement for the failed body organ is available. With a single whole- body donation, eight to fifty lives can be saved or improved.</p>
<p>Saving a life is considered as the noblest act in one's lifetime. It gives us a chance to act selflessly. Choosing to donate an organ is a voluntary step that an individual can take by himself or herself without any age limits. The fact that you will be able to do something good towards mankind is a hugely gratifying feeling in itself.</p>
<p>A blind individual will see for the rest of his life if a donor decides to donate his eyes after death. Kidney transplant has become one of the highest successful rated transplant. With the fact an individual can live with one kidney has increased the rate of donation.</p>
<p>Religious oppositions, healthy organs, black market for organs, controversies about false medical practices are some of the challenges organ donation faces, however the biggest challenge is <strong>shortage of organs</strong> and we want to help raise the figures by connecting with you and your friends using our platform.</p>
<p>Interested worth actors on this subject are requested to take the next step by exploring the opportunities and possibilities to do a worthy act of your own. Invite like-minded parties and form groups to bring a positive change in your preferred locality. Write blogs, Share your thoughts, actions, experiences, contributions and ideas about organ donation in your society.</p>
<img src="<?= base_url('assets/img/graphs/organ.jpg'); ?>" class="img-responsive" />
<?php endif; if($type == 'poss') : ?>
<div class="sos_pos">
    <p>Any day can be a fall day. We never know what happens the next moment. There are too many people in this world who are not fortunate enough to live a healthy life like us. Pledging our organs would be one of the noble deeds to do for humanity.</p>
    <div class="panel-group accordion" id="accordion1">
        <?php if($this->session->userdata('user_type') == '1') : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">As an Individual</a></h5>
            </div>
            <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Obtain a donor card through authorized organizations expressing the willingness to donate organs after one's demise</li>
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
                        <li>Influence and encourage your acquaintances to obtain a donor card through conveying the preciousness and importance of the deed.</li>
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
                        <li>Encourage employees to pledge their organs on their demise.</li>
                        <li>Influence and provide awareness to the employee through newsletters, campaigns, trainings etc.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif;
        $this->load->view('dashboard/sr/sr-scope', $type) ?>
</div>
<?php endif; ?>