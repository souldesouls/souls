<?php

namespace one\souls\modules\controllers;

use humhub\components\Controller;

class MatcherController extends Controller
{
    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('matcher');
    }

    public function actionSetIntention()
    {
        return $this->renderAjax('set_intention', [
            'actionUrl' => \yii\helpers\Url::to([
                '/souls/matcher/set-intention',
            ]),
        ]);
    }

    public function actionFindAndMatch()
    {
        return $this->renderAjax('find_and_match', [
            'actionUrl' => \yii\helpers\Url::to([
                '/souls/matcher/find-and-match',
            ]),
        ]);
    }
}

