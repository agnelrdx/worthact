<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(count($this->thoughts) > 0) : ?>

<div class="panel panel-group thoughts">
    <div class="panel-body">
        <div class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $count = 0; foreach ($this->thoughts as $thought) : ?>
                <div class='item <?= ($count === 0)? 'active' : ''; ?>'>
                    <p><i class="ion-quote"></i><?= $thought->content ?></p>
                    <h4><i class="ion-leaf"></i><?= $thought->author ?></h4>
                </div>
                <?php $count++; endforeach; ?>
            </div>
        </div>
    </div>     
</div>
<?php endif; ?>