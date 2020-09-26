<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container page-content">
    <?php if($this->info->is_complete <= 0): ?>
        <ul class="breadcrumb">
            <li><a class="trans" href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="active">Help</li>
        </ul>
        <?php endif; ?>
    <div class="row guidelines">
        <div class="entry">
            <h3>How can we help you?</h3>
            <h4>Explore our Help center to learn more about WorthAct</h4>
        </div>
        <div class="row brief">
            <div class="col col-sm-5 col-sm-offset-1">
                <div class="box shadow">
                    <h4 class="trans">General Faq</h4>
                    <div class="questions">
                        <div class="panel-group accordion" id="accordion1">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group1" aria-expanded="true" class="collapsed trans">Q: What is WorthAct Initiatives and the platform?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>'WorthAct initiatives' is a humble effort to join forces of conscientious people who work for sustainability of this planet. Our planet Earth, without which we cannot exist is in disaster mode.
                                        <br/>With a mission to create a generation of selfless world conscious about their social responsibility to preserve the natural resources, protect the environment and support the needy, we have decided to create a platform to unite likeminded people to take initiatives to bring the changes.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group2" aria-expanded="true" class="collapsed trans">Q: Why should I join WorthAct?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group2" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                    <p>
                                        When we come out of our socio, religious, geographical limitations, we would realize our planet Earth as our home and all living beings around us as part of the same family.
                                        We all are mortal beings for a limited period in this planet. We have to preserve our planet for our progeny. WorthAct platform is intended with that goal in mind with tremendous opportunity for all to play their role, spreading the message of love, care and compassion.
                                        <br/>This e-platform is a humble start with continuous scope for improvement which can be achieved through your participation, valuable suggestions and inputs. You are an extraordinary human being who understands the situation, decided to be part of this platform and do something better for this planet. There are options given under the WorthAct Initiatives for possible worthy actions. However even by bringing your known people to WorthAct itself, is a great worthy action as everything starts from awareness.
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group11" aria-expanded="true" class="collapsed trans">Q: How can I utilize this platform to spread the message of love, care and compassion?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group11" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>With your selfless ambition, your role in making differences are limitless. Kindly click on the tab 'opportunities' on your homepage and follow the advices.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group3" aria-expanded="true" class="collapsed trans">Q: How can I contribute to WorthAct initiatives listed on the site?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group3" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>
                                            You may find the 'possibilities' tab on your WorthAct Initiatives page. All you have to do is click and follow the clear instructions we have formulated for you.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group4" aria-expanded="true" class="collapsed trans">Q: Do I have to implement all the activities from the tab 'possibilities' to become a Worthy member of WorthAct Initiatives?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group4" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>
                                            One step at a time. We believe in the ripple effect, one action that contributes for another. By implementing at least one of the possibilities would add value to the WorthAct mission.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('dashboard/general_faq'); ?>" class="see_all trans">View all Articles</a>
                </div>
            </div>
            <div class="col col-sm-5">
                <div class="box shadow">
                    <h4 class="trans">Payment Faq</h4>
                    <div class="questions">
                        <div class="panel-group accordion" id="accordion3">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#accordion-group23" aria-expanded="true" class="collapsed trans">Q: The payment has been successful and yet I am seen as a basic member. Why?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group23" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>This could be due to one of the reasons mentioned below. Payment is under process or verification by the payment processor or bank. In this case you will get payment status as pending. Once the payment is confirmed you will be updated as premium member. In case payment processor or bank rejects the transaction, the amount will be credited back to your account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#accordion-group24" aria-expanded="true" class="collapsed trans">Q: Is it possible to cancel the registration for any reason and get the refund?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group24" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>You have registered with us after agreeing to all the terms and conditions and registration fee is non-refundable. However, as we value your esteemed presence in our platform, kindly contact us at getintouch@worthact.com and we can clear your uncertainties to prolong our relation.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#accordion-group25" aria-expanded="true" class="collapsed trans">Q: Can I pay more for WortAact initiatives after registration?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group25" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>Currently there is no such option to pay after registration, direct to WorthACT Initiatives. We would need your support when we come up with our own social and environmental projects announced through our website. However, you can pay more during the registration process, if you wish, as it would be a support to meet our operational cost and planned environmental projects in near future.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#accordion-group26" aria-expanded="true" class="collapsed trans">Q: I have not received confirmation mail but the amount has been deducted from my bank account. What do I do?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group26" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>You will not lose your money, all your transaction details will be available with our payment processor/ bank and we are also tracking your payment. As soon as payment formalities are over, we will be intimated and you will then receive your confirmation mail. . In any case you will receive an acknowledgement email from the payment processor or bank with transaction status.  You can always post your queries/suggestions/complaints to getintouch@worthact.com.</p>     
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#accordion-group27" aria-expanded="true" class="collapsed trans">Q: There was a power failure when I was making the payment. How can I be guided?</a>
                                    </h5>
                                </div>
                                <div id="accordion-group27" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <p>There will be no loss of money, all your transaction details will be available with our payment processor /bank and we will also be tracking your payment. If the transaction is successful you will definitely be upgraded to premium membership.</p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <a href="<?= base_url('dashboard/payment_faq'); ?>" class="see_all trans">View all Articles</a>
                </div>
            </div>
        </div>
        <div class="foot">
            <ul>
                <li><a data-toggle="modal" data-target="#report">Report a Problem</a></li>
                <li><a data-toggle="modal" data-target="#contact">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>  



