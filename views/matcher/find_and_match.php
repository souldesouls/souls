<?php

use yii\helpers\Html;
use humhub\widgets\Button;
use yii\helpers\Url;
use humhub\modules\mail\models\forms\CreateMessage;
use yii\widgets\ActiveForm;
use humhub\widgets\ModalButton;
use humhub\modules\User\models\User;

include("protected/modules/souls/meterfeeder/MeterFeeder.php");

/* @var $model CreateMessage */
?>

<?php \humhub\widgets\ModalDialog::begin([
    'header' => Html::tag('strong', Yii::t('SoulsModule.views.matcher', 'MATCH RESULTS')),
    'animation' => 'fadeIn'
]) ?>

    <div class="modal-body">

        <?php 
        $you = meterfeeder_get_intent("match");
        $other = find_closest_intent($you);
        $matchUsername = $other[0]['username'];
        $matchUserGuid = User::findOne(['username' => $matchUsername])->guid;
        $matchp = $other[1];
        ?>

        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'A <strong>{percent}%</strong> match was found.', ['percent' => number_format(($matchp*100), 2)]) ?>
            
            <!-- <?= Yii::t('SoulsModule.views.matcher', 'A <strong>{percent}%</strong> match was found. Try again:', ['percent' => number_format(($matchp*100), 2)]) ?>

            <right>
                <?php $url = Url::to(['/souls/matcher/find-and-match']); ?>
                <a href="<?= $url; ?>" data-target="#globalModal">
                    <i class="fa fa-refresh"></i>
                </a>
            </right> -->
        </p>

        <div id="cross_correlation_chart" style="margin: auto;">

                <?php
                    $dataPoints = array();
                    $dataPoints2 = array();

                    for ($i = 1; $i <= count($you); $i++) {
                        $dataPoints[$i-1] = array("x" => $i, "y" => $you[$i-1]);
                    }

                    for ($i = 1; $i <= count($other[0]["entropy"]); $i++) {
                        $dataPoints2[$i-1] = array("x" => $i, "y" => $other[0]["entropy"][$i-1]);
                    }
                ?>

                <script type="text/javascript">

                    $(function () {
                        var chart = new CanvasJS.Chart("cross_correlation_chart", {
                            theme: "light2",
                            zoomEnabled: false,
                            animationEnabled: true,
                            height: 200,
                            width: 600,
                            data: [
                                {
                                    type: "line",
                                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
                                    name: "You",
                                    showInLegend: true,
                                },
                                {
                                    type: "line",
                                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>,
                                    name: "Someone",
                                    showInLegend: true,
                                },
                            ]
                        });
                        chart.render();
                    });
                </script>

        </div>
        
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <?= Yii::t('SoulsModule.views.matcher', 'The lines show your measured intention alongside the closest matching member. Matches range from -100% to 100% and are based on how similar both of your measurements are.') ?>
        <br><br>

        <!-- <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'Start chatting with a topic suggestion that\'s based on both your measurements.') ?>
        </p>

        <center>
            <?php $url = Url::to(['/souls/matcher/topic-chat']); ?>
            <a href="<?= $url; ?>" class="btn btn-primary" data-target="#globalModal">
                <i class="fa fa-line-chart"></i> <?= Yii::t('SoulsModule.views.matcher', 'SUGGESTED TOPIC CHAT'); ?>
            </a>
        </center>

        <br>

        <p class="lead">
            <?= Yii::t('SoulsModule.views.matcher', 'Or just start chatting!') ?>
        </p> -->

        <?php
        $model = new CreateMessage();
        $form = ActiveForm::begin(['enableClientValidation' => false]);
        echo $form->field($model, 'recipient[]')->hiddenInput(['value' => "$matchUserGuid"])->label(false);
        echo $form->field($model, 'title')->hiddenInput(['value'=> Yii::t('SoulsModule.views.matcher', 'You two have a {percent}% match. Happy chatting!', ['percent' => number_format(($matchp*100), 2)])])->label(false);
        echo $form->field($model, 'message')->hiddenInput(['value'=> Yii::t('SoulsModule.views.matcher', 'Hello, nice to meet you!')])->label(false);
        ?>

        <center>
            <?= ModalButton::submitModal("/index.php?r=mail%2Fmail%2Fcreate", Yii::t('SoulsModule.views.matcher', 'START CHATTING'))?>
        </center>

        <?php ActiveForm::end(); ?>

    </div>

<?php \humhub\widgets\ModalDialog::end(); ?>