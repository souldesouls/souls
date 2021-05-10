<?php

use yii\helpers\Html;
use humhub\widgets\Button;
use yii\helpers\Url;

?>
<script>
    var sendEntropyFromYourSoul = function(hex) {
        window.location.href = '/index.php?r=souls%2Fmatcher%2Ffind-and-match&entropy=' + hex;
    }
</script>

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
            <div id="findMatch_withCamRNG" style="display: none">
                <a href="" class="btn btn-primary" data-target="#globalModal" data-ui-loader onclick="flutterChannel_loadCamRNG.postMessage('null');">
                    <i class="fa fa-search"></i> <?= Yii::t('SoulsModule.views.matcher', 'FIND A MATCH!'); ?>
                </a>
            </div>
            <div id="findMatch_withoutCamRNG" style="display: none">
                <a href="<?= $url; ?>" class="btn btn-primary" data-target="#globalModal" data-ui-loader>
                    <i class="fa fa-search"></i> <?= Yii::t('SoulsModule.views.matcher', 'FIND A MATCH!'); ?>
                </a>
            </div>
            <script>
                if (typeof(flutterChannel_loadCamRNG) != "undefined") {
                    document.getElementById('findMatch_withCamRNG').style.display = "block";
                } else {
                    document.getElementById('findMatch_withoutCamRNG').style.display = "block"
                }
            </script>
        </center>

    </div>

<?php \humhub\widgets\ModalDialog::end(); ?>
