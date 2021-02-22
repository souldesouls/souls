<?php

use yii\helpers\Html;
use humhub\widgets\Button;
use yii\helpers\Url;

include("protected/modules/souls/meterfeeder/MeterFeeder.php");

?>

<?php \humhub\widgets\ModalDialog::begin([
    'header' => Html::tag('strong', Yii::t('SoulsModule.views.matcher', 'MATCH RESULTS')),
    'animation' => 'fadeIn'
]) ?>

    <div class="modal-body">

        <?php 
        $a = meterfeeder_get_intent();
        $b = meterfeeder_get_intent();
        $matchp = cross_correlation($a, $b);
        ?>

        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'A soul was found with a ') ?>
        
            <strong><?php echo number_format (($matchp*100), 2); ?>%</strong>
            
            match.

            <right>
                <?php $url = Url::to(['/souls/matcher/find-and-match']); ?>
                <a href="<?= $url; ?>" data-target="#globalModal">
                    <i class="fa fa-refresh"></i>
                </a>
            </right>
        </p>

        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'Start chatting around a topic suggestion that\'s based on both your measured intents.') ?>
        </p>

        <center>
            <?php $url = Url::to(['/souls/matcher/topic-chat']); ?>
            <a href="<?= $url; ?>" class="btn btn-primary" data-target="#globalModal">
                <i class="fa fa-line-chart"></i> <?= Yii::t('SoulsModule.views.matcher', 'TOPIC CHAT'); ?>
            </a>
        </center>

        <br>

        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'Or just start chatting!') ?>
        </p>

        <center>
            <?php $url = Url::to(['/souls/matcher/free-chat']); ?>
            <a href="<?= $url; ?>" class="btn btn-primary" data-target="#globalModal">
                <i class="fa fa-random"></i> <?= Yii::t('SoulsModule.views.matcher', 'FREE CHAT'); ?>
            </a>
        </center>

    </div>

<?php \humhub\widgets\ModalDialog::end(); ?>