<?php defined('BASEPATH') OR exit('No direct script access allowed'); $total_results = $xml->totalresults; $total_pages = floor($total_results / 5); foreach($xml->results->result as $item) : ?>
    <div class="job shadow job_indeed">
        <div class="content">
            <h3><?= (string)$item->jobtitle; ?></h3>
            <div class="meta">
                <span><i class="fa fa-address-card" aria-hidden="true"></i><?= (string)$item->company; ?></span>
                <span><i class="fa fa-map-marker" aria-hidden="true"></i><?= (string)$item->formattedLocation; ?></span>
                <span><i class="ion-calendar" aria-hidden="true"></i>Posted: <?= (string)$item->date; ?></span>
            </div>
            <p class="job-description"><?= (string)$item->snippet; ?></p>
            <ul class="quick-actions">
                <li><i class="ion-paper-airplane"></i><a class="contactbtn" target="_blank" href="<?= (string)$item->url; ?>">View Job</a></li>
            </ul>
            <a href="https://www.indeed.com" target="_blank" title="Indeed">
                <img class="indeed_logo" src="<?= base_url("assets/img/indeed.png"); ?>" alt="Indeed Jobs" />
            </a>
        </div>
    </div>
<?php endforeach; ?>
<a onclick="load_more_indeed_jobs()" id="load_more" data-country="<?= $country; ?>" data-cat="<?= $cat; ?>" data-page="1" data-pages="<?= $total_pages; ?>" style="display: block;">Load More <img src="https://www.worthact.com/assets/img/reload.svg" id="loader" alt="loader"></a>