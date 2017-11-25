<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\TeamAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
TeamAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--    TEST JQUERY 3.*-->
    <!--    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>-->
    <!--    <script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>-->
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed page-content-white ">
<?php $this->beginBody() ?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?= Url::home() ?>">
                <img src="<?= Yii::getAlias('@web') . '/template/assets/layouts/layout/img/logo-big.png' ?>" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler"><span></span></div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <!--                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">-->
                <!--                    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">-->
                <!--                        <i class="icon-bell"></i>-->
                <!--                        <span class="badge badge-default"> 7 </span>-->
                <!--                    </a>-->
                <!--                    <ul class="dropdown-menu">-->
                <!--                        <li class="external">-->
                <!--                            <h3><span class="bold">12 pending</span> notifications</h3>-->
                <!--                            <a href="#">view all</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">-->
                <!--                                <li>-->
                <!--                                    <a href="javascript:">-->
                <!--                                        <span class="time">9 days</span>-->
                <!--                                        <span class="details">-->
                <!--                                                <span class="label label-sm label-icon label-danger">-->
                <!--                                                    <i class="fa fa-bolt"></i>-->
                <!--                                                </span> Storage server failed.-->
                <!--                                            </span>-->
                <!--                                    </a>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN LANGUAGE BAR -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-language">
                    <?php if (Yii::$app->language == 'vi'): ?>
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" src="<?= Yii::getAlias('@web') . '/template/assets/global/img/flags/vn.png' ?>">
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="javascript:" class="link-change-lang" data-lang="en"><img alt="" src="<?= Yii::getAlias('@web') . '/template/assets/global/img/flags/us.png' ?>"> English </a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" src="<?= Yii::getAlias('@web') . '/template/assets/global/img/flags/us.png' ?>">
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="javascript:" class="link-change-lang" data-lang="vi"><img alt="" src="<?= Yii::getAlias('@web') . '/template/assets/global/img/flags/vn.png' ?>"> Tiếng Việt </a>
                            </li>
                        </ul>
                    <?php endif ?>
                </li>
                <!-- END LANGUAGE BAR -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!--                        <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />-->
                        <span class="username username-hide-on-mobile"> <?= ! empty(Yii::$app->user->identity) ? Yii::$app->user->identity->fullname : '' ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= Url::to(['system/user/update', 'id' => Yii::$app->user->id]) ?>" id="link_profile">
                                <i class="icon-user"></i> <?= Yii::t('yii', 'My Profile'); ?>
                            </a>
                        </li>
                        <!--                        <li>-->
                        <!--                            <a href="#">-->
                        <!--                                <i class="icon-calendar"></i> My Calendar </a>-->
                        <!--                        </li>-->
                        <li class="divider"></li>
                        <!--                        <li>-->
                        <!--                            <a href="page_user_lock_1.html">-->
                        <!--                                <i class="icon-lock"></i> Lock Screen </a>-->
                        <!--                        </li>-->
                        <li>
                            <a href="javascript:void(0)" id="link_logout">
                                <i class="icon-key"></i> <?= Yii::t('yii', 'Logout'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <?= $this->renderAjax('_menu_left') ?>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <?php
                echo Breadcrumbs::widget([
                    'itemTemplate'       => "<li><em>{link}</em><i class='fa fa-circle'></i></li>\n", // template for all links
                    'activeItemTemplate' => "<li class=\"active\"><b>{link}</b></li>\n", // template for active link
                    'homeLink'           => [
                        'label'    => Yii::t('yii', 'Home'),
                        'url'      => Url::home(),
                        'template' => "<li><i class='fa fa-home'></i> <em>{link}</em><i class='fa fa-circle'></i></li>\n", // template for this link only
                    ],
                    'links'              => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options'            => [
                        'class' => 'page-breadcrumb'
                    ],
                ]);
                ?>
            </div>
            <!-- END PAGE BAR -->
            <?= $content ?>
            <!-- END PAGE HEADER-->
        </div>
        <!-- END CONTENT BODY -->
        <div class="modal modal-wide fade modal-scroll" id="modal_lg" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal modal-wide fade modal-scroll" id="modal_md" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal modal-wide fade" id="modal_sm" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<script>
    $(function() {
        //        let es = new EventSource('<?//= Yii::$app->request->baseUrl ?>//' + '/noti.php');
        //        let listener = function (event) {
        //            let type = event.type;
        //            console.log(type + ": " + (type === "message" ? event.data : es.url));
        //        };
        //        es.addEventListener("open", listener);
        //        es.addEventListener("message", listener);
        //        es.addEventListener("error", listener);
//                let run = function(){
//                    if (Offline.state === 'up')
//                        Offline.check();
//                };
//                setInterval(run, 5000);
        $('.top-menu').on('click', '.link-change-lang', function() {
            let lang = $(this).data('lang');
            $.get('<?= Url::to(['/site/change-lang']) ?>', {lang: lang}, function(result) {
                if (result === 'success') {
                    location.reload();
                }
            });
        });
        $('#link_logout').on('click', function() {
            $.post('<?= Url::to(['/site/logout']) ?>', function(result) {
                if (result === 'success') {
                    location.href = '<?= Url::to(['/site/']) ?>';
                }
            });
        });
//        $('#link_profile').on('click', function() {
//            Team.showModal({}, '<?php //echo Url::to(['/site/modal-change-info']) ?>//', $('#modal_lg'));
//        });
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
