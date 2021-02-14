<?php

namespace energy\souls\modules\assets;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@souls/resources';

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        // TIPP: Change forceCopy to true when testing your js in order to rebuild
        // this assets on every request (otherwise they will be cached)
        'forceCopy' => false
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/souls.js'
    ];

}