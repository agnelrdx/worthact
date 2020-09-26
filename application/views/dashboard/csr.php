<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container csr_landing">				
    <div class="row">
        <div class="col-sm-12">
            <div class="head">
                <div class="block shadow">
                    <h2>Nurturing People and Planet along with Profits - The only blend for a thriving business and a better world.</h2>
                    <a class="trans" data-ripple data-toggle="modal" data-target="#wi_listing" href="">Take Action</a>
                </div>
            </div>
            <div class="steps">
                <h2>Corporate Social Responsibility</h2>
                <div class="row">
                    <div class="col-sm-9">
                        <p class="ppp">True leaders have realized that championing people and planet along with profit will result in much stronger and successful businesses. Their goal would be not just to make profit – but to make a difference. <b>Triple bottom line approach</b> is a unique perspective to sustain business growth, emphasizing on three interesting dimensions: (PPP) Planet, People, Profit. It encourages businesses to look beyond profit and give equal importance to the planet and people which is badly the need of the hour.
                            <br /><br />Success of the business is judged through the environment and social values achieved, not just based on the economic values. 3BL, hence, is a practical approach towards the solution of Environmental and social challenges and it’s not just good for the environment and society, but for the business as well. Time has come, to give back to the planet in return for what we have procured all these years and business leaders can play a big role in solving world problems, along with governments and civil societies.
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <img class="bl" src="<?= base_url('assets/img/3bl.png'); ?>" alt="3bl" title="PPP" />
                    </div>
                </div>
                <h2>Why CSR ?</h2>
                <div class="tabbable">
                    <ul class="nav nav-pills nav-justified">
			<li class="active trans"><a href="#one" data-toggle="tab" aria-expanded="false">Community Regeneration</a></li>
                        <li class="trans"><a href="#two" data-toggle="tab" aria-expanded="true">Professional/Personal Buildout</a></li>
                        <li class="trans"><a href="#three" data-toggle="tab" aria-expanded="true">Client Bonding</a></li>
                        <li class="trans"><a href="#four" data-toggle="tab" aria-expanded="true">Benevolent Authorities</a></li>
                        <li class="trans"><a href="#five" data-toggle="tab" aria-expanded="true">Capital Influx</a></li>
                    </ul>									
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="one">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="shadow" src="<?= base_url('assets/img/community.jpg'); ?>" alt="Community Regeneration" />
                                </div>
                                <div class="col-sm-7">
                                    <p>Businesses can be encouraged to act ethically and to consider the social and environmental impacts of their activities, by keeping social responsibilities in mind. This can help organisations to minimize detrimental impacts of their business on the community.</p>
                                    <p>A sound and strong CSR framework and organisational mindset can help companies deliver public value outcomes by focussing on how their services can make a difference in the community. This can happen indirectly, when an organisation's services enable others to contribute to the community, or directly, through the organisation's own activities.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="two">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="shadow" src="<?= base_url('assets/img/professional.jpg'); ?>" alt="Professional/Personal Buildout" />
                                </div>
                                <div class="col-sm-7">
                                    <p>Becoming an employer of choice requires wide range of approach including work-life balance, positive working conditions and work place flexibility.</p>
                                    <p>A strong CSR framework can help a business become more attractive to potential future employees who are in search for workplaces with socially responsible practices, community mindedness and strong ethics.</p>
                                    <p>Giving access to employees the opportunity to be involved in a company's social activities can have the benefit of teaching new skills to staff, which can in turn be applied in the workplace. By taking part in activities outside of their usual work responsibilities, employees have the chance to feel passionate about, or learn something entirely new which can help enrich their own perspectives.</p>
                                    <p>Supporting these activities can encourage growth and support for employees.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="three">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="shadow" src="<?= base_url('assets/img/client.jpg'); ?>" alt="Client Bonding" />
                                </div>
                                <div class="col-sm-7">
                                    <p>To build and maintain trust between a company and its clients, a strong CSR framework is without a doubt essential, in strengthening ties, building alliances, and encouraging strong working relationships with both existing and new clients.</p>
                                    <p>One of the ways this can be achieved is by offering pro-bono services where a company can partner with Non-profit organisations to support their social and environmental activities, where funds may be limited, but will help the growth of public value outcomes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="four">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="shadow" src="<?= base_url('assets/img/capital.jpg'); ?>" alt="Benevolent Authorities" />
                                </div>
                                <div class="col-sm-7">
                                    <p>A strong CSR framework can benefit a company by being perused to a limit by regulatory authorities, compared to companies that operate without a CSR framework. The authorities will be lenient in their regulations as they see the company complying with all regulations and supporting the welfare of the community.</p>
                                    <p>A company with strong CSR programs will always work within the regulations and obtain more benefits, apart from the profits.</p>
                                    <p>The authorities may not only offer high preference to a company with strong CSR framework, they also waive complicated paperwork considering the fact the company is offering support to the community for social and environmental upliftment.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="five">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="shadow" src="<?= base_url('assets/img/money.jpg'); ?>" alt="Capital Influx" />
                                </div>
                                <div class="col-sm-7">
                                    <p>A Company's public value plays a huge role in attracting investors. If the company adopts a strong CSR framework, it will positively affect the investments in its operations. Being the core purpose of every business, gaining trust, can be achieved with much less effort and investments from not just neighbouring firms and industries but even from global regions can be harnessed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
		</div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('dashboard/modals/csr'); ?>

<?php if($status == 'incomplete') { $this->load->view('dashboard/modals/add_info'); } ?>