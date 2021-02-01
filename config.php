<?php

use one\souls\modules\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\widgets\TopMenu;

return [
    'id' => 'souls',
    'class' => 'one\souls\modules\Module',
    'namespace' => 'one\souls\modules',
    'events' => [
        [TopMenu::class, TopMenu::EVENT_INIT, [Events::class, 'onTopMenuInit']],
        [AdminMenu::class, AdminMenu::EVENT_INIT, [Events::class, 'onAdminMenuInit']]
    ],
];
