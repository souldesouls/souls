<?php

use yii\helpers\Html;
use humhub\widgets\Button;
use yii\helpers\Url;

?>

<i class="fa fa-search"></i>
<?php \humhub\widgets\ModalDialog::begin([
    'header' => Html::tag('strong', Yii::t('SoulsModule.views.matcher', 'SET YOUR INTENT')),
    'animation' => 'fadeIn'
]) ?>

    <div class="modal-body">
        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'What\'s the reason you are looking for someone? (Anything goes here:)') ?>
        </p>

        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'Give some thought to that reason, and try and imagine what kind of person they may be.') ?>
        </p>

        <p class="lead">    
            <?= Yii::t('SoulsModule.views.matcher', 'Focus those thoughts into your intent as you press the button below. The system will try and measure your intent and match you with someone.') ?>
        </p>

        <center>
            <?php $url = Url::to(['/souls/matcher/find-and-match']); ?>
            <a href="<?= $url; ?>" class="btn btn-primary" data-target="#globalModal" data-ui-loader>
                <i class="fa fa-search"></i> <?= Yii::t('SoulsModule.views.matcher', 'FIND A MATCH!'); ?>
            </a>
        </center>

    </div>

<?php \humhub\widgets\ModalDialog::end(); ?>
