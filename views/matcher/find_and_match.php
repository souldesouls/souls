<?php

use yii\helpers\Html;
use humhub\widgets\Button;
use yii\helpers\Url;

?>

<?php \humhub\widgets\ModalDialog::begin([
    'header' => Html::tag('strong', Yii::t('SoulsModule.views.matcher', 'MATCH RESULTS')),
    'animation' => 'fadeIn'
]) ?>

<div class="modal-body">

 FOUND SOMEBODY TO LOVE....
<!-- 
    <center>
        <?= Button::primary(Yii::t('SoulsModule.views.matcher', 'MATCH'))->link(Url::toRoute(['find-and-match'])); ?>
    </center> -->

</div>

<?php \humhub\widgets\ModalDialog::end(); ?>
