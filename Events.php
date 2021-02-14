<?php

namespace energy\souls\modules;

use humhub\modules\admin\permissions\ManageModules;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\modules\ui\menu\MenuLink;
use humhub\widgets\TopMenu;
use Yii;
use yii\base\Event;

class Events
{
    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onTopMenuInit($event)
    {
        /** @var TopMenu $topMenuWidget */
        $topMenuWidget = $event->sender;

        // Matcher
        $topMenuWidget->addEntry(new MenuLink([
            'label' => Yii::t('SoulsModule.base', 'Matcher'),
            'icon' => 'users',
            'url' => ['/souls/matcher'],
            'sortOrder' => 1,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'souls' && Yii::$app->controller->id == 'matcher'),
        ]));

        // Topics
        $topMenuWidget->addEntry(new MenuLink([
            'label' => Yii::t('SoulsModule.base', 'Topics'),
            'icon' => 'comments',
            'url' => ['/souls/topics'],
            'sortOrder' => 2,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'souls' && Yii::$app->controller->id == 'topics'),
        ]));
    }

    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param $event Event
     */
    public static function onAdminMenuInit($event)
    {
        /** @var AdminMenu $adminMenuWidget */
        $adminMenuWidget = $event->sender;

        $adminMenuWidget->addEntry(new MenuLink([
            'label' => Yii::t('SoulsModule.base', 'Souls'),
            'url' => ['/souls/admin'],
            'icon' => 'users',
            'sortOrder' => 1,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'souls' && Yii::$app->controller->id == 'admin'),
            'isVisible' => Yii::$app->user->can(ManageModules::class)
        ]));
    }
}
