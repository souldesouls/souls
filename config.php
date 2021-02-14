<?php

use energy\souls\modules\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\widgets\TopMenu;

return [
    'id' => 'souls',
    'class' => 'energy\souls\modules\Module',
    'namespace' => 'energy\souls\modules',
    'events' => [
        [TopMenu::class, TopMenu::EVENT_INIT, [Events::class, 'onTopMenuInit']],
        [AdminMenu::class, AdminMenu::EVENT_INIT, [Events::class, 'onAdminMenuInit']]
    ],
];
