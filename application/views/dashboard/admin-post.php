<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="letter shadow">
    <img class="letter-logo" src="<?= base_url('assets/img/logo-bold.png'); ?>" alt="Admin" />
    <?php if($this->session->userdata('user_type') == '1') : ?>
    <h4 class="letter-head">Dear Sibling,</h4>
    <div class="content">
        <p>Hope you are not surprised by being addressed as sibling. When we come out of our socio, religious, geographical limitations, we would realize our planet Earth as our home and all living beings around us as part of the same family. Hence the address.</p>
        <p>We all are mortal beings for a limited period in this planet. We have great inventions and discoveries which helped the humanity to evolve in to its present. But it seems like there were no impact assessments conducted, to determine its control measures during this evolutionary process. Had it been done, we wouldn't have been facing global warming and its threat, whopping population growth, carbon foot prints, extreme weathers breaking all records periodically, droughts, nuclear threats etc.</p>
        <p>Recently we are becoming more aware about these environmental threats but most of us prefer to neglect these threats to nature and move on as if it is no concern of ours, which is absolutely suicidal.</p>
        <p>Yes it is our Business. We have to preserve our planet for our progeny. Worthact platform is intended with that goal in mind with tremendous opportunity for all to play their role, spreading the message of love and compassion.</p>
        <p>This e-platform is a humble start with continuous scope for improvement which can be achieved through your participation, valuable suggestions and inputs. You are an extraordinary human being who understands the situation, decided to be part of this platform and do something better for this planet.</p>
        <p>There are options given under the WorthAct Initiatives for possible worthy actions. However even by bringing your known people to WorthAct itself, is a great worthy action as everything starts from awareness.</p>
        <p><strong>Let's make this planet better by doing our bit.</strong></p>
        <p>Regards,</p>
        <p>Manoj Nair <br />Founder - WorthAct</p>
    </div>
    <?php else : ?>
    <h4 class="letter-head">Dear Green partner,</h4>
    <div class="content">
        <p>Planet earth is for all and humans are just a part of it. If we can equally procure from it we must make sure about equally giving back too.</p>
        <p>WorthAct is concerned about the potential threat of Climate change, Global warming, decline of Non-renewable sources and the insecure social lifestyle which makes all of us deeply concerned about the sustainability of the planet earth. There are two things that can be done: either turn blind eye towards it or take an initiative and do something for the betterment of our World. We chose the second option.</p>
        <p>It is only when we take it as each one of our business, changes for good emerge. WorthAct platform is intended with that goal in mind with tremendous opportunity for all to play their role, spreading the message of love and compassion. This e-platform is a humble start with continuous scope for improvement which can be achieved through your participation.</p>
        <p>Adopting sustainability and implementing strategic CSR into the core of the business is, we believe, the model of the firm of the future. A successful company is not defined by its profits, as you know. Especially today, with resources becoming more finite, companies need to re-evaluate the core of their business purposes – is it simply just profits that matter, or is it finding a win-win solution that would correspond with the triple bottom line 'people, planet, profit?'</p>
        <p>Furthermore, social responsibility can improve employee commitment, loyalty and work satisfaction too, which can lead to increased work performance that would have an impact on production and the volume of sales. It is a cycle – one that leads to another.</p>
        <p><strong>So, come start the journey with us and let's make this planet better by doing our bit. It's not only about profits anymore...</strong></p>
        <p>Regards,</p>
        <p>Manoj Nair <br />Founder - WorthAct</p>
    </div>
    <?php endif; ?>
    <a id="letter_more" class="trans">Read More</a>
    <a id="letter_less" class="trans">Read Less</a>
</div>