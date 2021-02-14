<?php

namespace energy\souls\modules;

use yii\helpers\Url;

class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';    
    
    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/souls/admin']);
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }
}
