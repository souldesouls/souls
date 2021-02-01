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

}

