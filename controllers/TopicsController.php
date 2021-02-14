<?php

namespace energy\souls\modules\controllers;

use humhub\components\Controller;

class TopicsController extends Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('topics');
    }

}

