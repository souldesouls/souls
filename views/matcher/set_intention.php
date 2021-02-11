<?php

use yii\helpers\Html;
use humhub\widgets\Button;
use yii\helpers\Url;

?>

<?php \humhub\widgets\ModalDialog::begin([
    'header' => Html::tag('strong', Yii::t('SoulsModule.views.matcher', 'MATCHING BEGINS WITH INTENTION')),
    'animation' => 'fadeIn'
]) ?>

<div class="modal-body">
    <p class="lead">
        <?= Yii::t('SoulsModule.views.matcher', 'What\'s the reason you are looking for people?<br>To chat idly with? A potential boy/girlfriend? Marriage minded?<br>(Anything goes here)') ?>
    </p>

    <p class="lead">
        <?= Yii::t('SoulsModule.views.matcher', 'Give some thought to that reason, and try and imagine what kind of person they may be.') ?>
    </p>

    <p class="lead">    
        <?= Yii::t('SoulsModule.views.matcher', 'Focus those thoughts as you press the MATCH! button. The system will measure that intent and do some searching to try and match you with another Souls member.') ?>
    </p>

    <center>
        <?= Button::primary(Yii::t('SoulsModule.views.matcher', 'GO & MATCH!'))->link(Url::toRoute(['find-and-match'])); ?>
    </center>

</div>

<?php \humhub\widgets\ModalDialog::end(); ?>
