<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<?php
/** @noinspection HtmlUnknownTarget */
use yii\helpers\Url;
use yii\widgets\Menu;

echo Menu::widget([
    'options'         => [
        'class'              => 'page-sidebar-menu page-sidebar-menu-closed page-header-fixed',
        'data-keep-expanded' => 'false',
        'data-slide-speed'   => 200,
        'data-auto-scroll'   => 'true'
    ],
    'items'           => [
        [
            'label'    => Yii::t('yii', 'Home'),
            'url'      => [Url::home()],
            'template' => '<a href="{url}" class="nav-link"><i class="icon-home"></i><span class="title">{label}</span></a>',
            'active'   => $this->context->route == 'site/index'
        ],
        [

            'visible'  => Yii::$app->permission->isAdmin(),
            'template' => '<a href="javascript:void(0)" class="nav-link nav-toggle"><i class="fa fa-first-order"></i><span class="title">' . Yii::t('yii', 'Quản lý món ăn') . '</span><span class="arrow"></span></a>',
            'items'    => [
                [
                    'label'    => Yii::t('yii', 'Quản lý đặt món'),
                    'url'      => ['/order-food/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="fa fa-product-hunt"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'order-food')),
                ],
                [
                    'label'    => Yii::t('yii', 'Món ăn'),
                    'url'      => ['/product/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="fa fa-product-hunt"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'product')),
                ],
                [
                    'label'    => Yii::t('yii', 'Menu'),
                    'url'      => ['/product-type/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="fa fa-bars"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'product-type')),
                ],
                [
                    'label'    => Yii::t('yii', 'Thông tin thiết bị'),
                    'url'      => ['/imme-device/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="fa fa-bars"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'imme-device')),
                ],
                [
                    'label'    => Yii::t('yii', 'Quản lý bàn ăn'),
                    'url'      => ['/tables/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="fa fa-bars"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'tables')),
                ],
            ],
        ],
        [
            'visible'  => Yii::$app->permission->isAdmin(),
            'template' => '<a href="javascript:void(0)" class="nav-link nav-toggle"><i class="fa fa-gears"></i><span class="title">' . Yii::t('yii', 'System') . '</span><span class="arrow"></span></a>',
            'items'    => [
                [
                    'label'    => Yii::t('yii', 'User'),
                    'url'      => ['/system/user/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-user"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'system/user')),
                ],
                [
                    'label'    => Yii::t('yii', 'Role'),
                    'url'      => ['/system/role/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-lock"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'system/role')),
                ],
                [
                    'label'    => Yii::t('yii', 'System log'),
                    'url'      => ['/system/syslog/'],
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-doc"></i><span class="title"> {label}</span></a>',
                    'active'   => is_int(strpos($this->context->route, 'system/syslog')),
                ],
            ]
        ],
    ],
    'submenuTemplate' => "\n<ul class='sub-menu' style='display: none'>\n{items}\n</ul>\n",
    'itemOptions'     => [
        'class' => 'nav-item'
    ],
    'activateParents' => true
]);
