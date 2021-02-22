<?php

use humhub\widgets\Button;
use yii\helpers\Url;

?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-users"></i> <strong><?= Yii::t('SoulsModule.views.matcher', 'SOULS MATCHER') ?></strong>
            <hr>
        </div>
        <div class="panel-body">
            <center>

                <p class="lead">
                    <?= Yii::t('SoulsModule.base', 'Matching begins with intention.') ?>
                </p>

                <?php $url = Url::to(['/souls/matcher/set-intention']); ?>
                <a href="<?= $url; ?>" class="btn btn-primary" data-target="#globalModal">
                    <i class="fa fa-hand-o-right"></i> <?= Yii::t('SoulsModule.views.matcher', 'BEGIN'); ?>
                </a>

            </center>
        </div>
    </div>
</div>


