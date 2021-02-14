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
//print_r(meterfeeder_get_intent());
$a = meterfeeder_get_intent();
$b = meterfeeder_get_intent();
$matchp = cross_correlation($a, $b);
?>
FOUND SOMEBODY TO LOVE @ <?php echo ($matchp*100); ?>%
<!-- 
    <center>
        <?= Button::primary(Yii::t('SoulsModule.views.matcher', 'MATCH'))->link(Url::toRoute(['find-and-match'])); ?>
    </center> -->

</div>

<?php \humhub\widgets\ModalDialog::end(); ?>
