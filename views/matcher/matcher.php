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

                <?= Button::primary(Yii::t('SoulsModule.views.matcher', 'BEGIN'))->link(Url::toRoute(['set-intention'])); ?>

            </center>
        </div>
    </div>
</div>


