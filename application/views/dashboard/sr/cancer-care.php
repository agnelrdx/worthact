<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'facts') : ?>

<img class="shadow trans wi_img" src="<?= base_url('assets/img/sos/cancer.jpg'); ?>" alt="Cancer Care">
<h2 class="text-center">Cancer Care</h2>
<p>Hazardous chemicals that enter the body can cause our cells to regenerate rapidly than normal; tumour in other words. The food we eat, the clothes we use, the materials we use to build our homes, burning of fossil fuels etc. are filled with chemicals to satisfy human greed.</p>
<p>These chemicals does not necessarily have to effect the body they enter, it can be carried forward genetically or just spread with contact.</p>
<p>Despite advancement in medical science, we must know that it is difficult to make healthy people better than they already are. Preventions and cure must not only work but also not cause more harm than good.</p>
<p>There are various types of cancers and many of them can be prevented, others can be detected at an early stage, treated and cured. Even the last stage can be treated to ease the pain to a great extent.</p>
<p>Environmental pollution, Tobacco use, Alcohol consumption, Physical inactivity, addictiveness and obesity, Radiation etc. are some of the main causes for Cancer. If we can contemplate on each point we may realize that with systematic consultation and awareness, suffering can be avoided or prevented.</p>
<p>We want your help to get connected, join hands and help us raise awareness and conduct campaigns.</p>
<p>Interested worth actors to work on Cancer care are requested to take the next step by exploring the opportunities and possibilities to do a worthy act of your own. Invite like-minded parties and form groups to bring a positive change in your preferred locality. Write blogs, Share your thoughts, actions, experiences, contributions and ideas about cancer care.</p>
<p>Associations and organizations who work on Cancer care may post their ads on their activities and requirements where interested parties can join and contribute respectively.</p>
<?php endif; if($type == 'poss') : ?>
<div class="sos_pos">
    <p>Diseases like cancer can devour anyone, anytime due to the modern day food habits, sedentary life style and various pollutions. It could be one of us, so let's take care of the needy.</p>
    <div class="panel-group accordion" id="accordion1">
        <?php if($this->session->userdata('user_type') == '1') : ?>
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">As an Individual</a></h5>
            </div>
            <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <ul>
                        <li>Financially support an underprivileged cancer patient through the hospital or concerned organizations.</li>
                        <li>Hair donation for cancer patients through concerned organizations.</li>
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
                        <li>Could possibly form and lead groups to support underprivileged cancer patients financially and mentally, and spread awareness for precautions in preferred locality.</li>
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
                        <li>Formulate strategies to support the underprivileged cancer patients financially and mentally and implement it.</li>
                        <li>Formulate strategies and implement them to reduce the percentage of cancer patients in preferred region through various scientific methods for precautions and early detections, and measure it.</li>
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
                        <li>Consistent awareness on topics related to cancer and cancer care among employees through newsletter, campaigns, trainings etc.</li>
                        <li>Free Health check-ups and campaigns for the employees.</li>
                        <li>Encourage employees to donate their hair for cancer patients through Cancer Care organizations.</li>
                        <li>Adopt/Fund/Sponsor underprivileged cancer patient(s) to meet their treatment expenses.</li>
                        <li>Sponsor/Run counselling centres to mentally support cancer patients and help them through the phase.</li>
                        <li>Sponsor/ Fund/Donate Cancer care centres.</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; 
        $this->load->view('dashboard/sr/sr-scope', $type) ?>
</div>
<?php endif; ?>