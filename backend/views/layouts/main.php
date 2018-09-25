<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en"/>

    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">

    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="/v1/dist/assets/js/require.min.js"></script>
    <script>
        requirejs.config({
            baseUrl: '/v1/dist/',
            paths: {
                'core': 'assets/js/core',
                'jquery': 'assets/js/vendors/jquery-3.2.1.min',
                'bootstrap': 'assets/js/vendors/bootstrap.bundle.min',
                'sparkline': 'assets/js/vendors/jquery.sparkline.min',
                'selectize': 'assets/js/vendors/selectize.min',
                'tablesorter': 'assets/js/vendors/jquery.tablesorter.min',
                'circle-progress': 'assets/js/vendors/circle-progress.min',
                'dropzone': 'assets/js/dropzone',
            }
        });
    </script>

    <link href="/v1/dist/assets/css/dashboard.css" rel="stylesheet"/>
    <link href="/v1/dist/dropzone.css" rel="stylesheet"/>
    <script src="/v1/dist/assets/plugins/input-mask/plugin.js"></script>
    <script src="/v1/dist/assets/plugins/datatables/plugin.js"></script>


</head>
<body class="">
<?php $this->beginBody() ?>
<div class="page">
    <div class="page-main">

        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="/">
                        <img src="/v1/logo-w.png" class="header-brand-img"
                             alt="tabler logo">
                    </a>

                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="nav-item d-none d-md-flex">
                            <a href="/bug" class="btn btn-icon btn-sm btn-outline-primary"><i class="fa fa-bug"></i></a>
                        </div>
                        <div class="dropdown" style="margin-left: -7px;">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar avatar-placeholder"></span>
                                <span class="ml-2 d-none d-lg-block">
							<span class="text-default"><?= Yii::$app->user->identity->username ?></span>
							<small class="text-muted d-block mt-1">на балансе 22 руб</small>
						</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="/logout">
                                    <i class="dropdown-icon fe fe-log-out"></i> Выйти
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                       data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 ml-auto text-right">
                        <?php if($this->context->saveButton || $this->context->backButton): ?>
                            <?php if($this->context->backButton): ?>
                                <a id="back" href="<?= $this->context->backButton ?>" class="btn btn-secondary">Назад</a>
                            <?php endif; ?>
                            <?php if($this->context->saveButton): ?>
                                <a id="save" href="#" class="btn btn-primary"><i class="fe fe-check mr-2"></i><?= $this->context->saveButton ?></a>
                            <?php endif; ?>
                        <?php else: ?>
                        <form class="input-icon my-3 my-lg-0">
                            <input type="search" class="form-control header-search" placeholder="Найти товар" tabindex="1">
                            <div class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link <?= $this->context->menu == 'main' ? 'active' : '' ?>"><i class="fe fe-home"></i> Домашняя</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link <?= $this->context->menu == 'product' ? 'active' : '' ?>" data-toggle="dropdown"><i class="fe fe-box"></i> Товары</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="./cards.html" class="dropdown-item ">Cards design</a>
                                    <a href="./charts.html" class="dropdown-item ">Charts</a>
                                    <a href="./pricing-cards.html" class="dropdown-item ">Pricing cards</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0)" class="nav-link <?= $this->context->menu == 'provider' ? 'active' : '' ?>" data-toggle="dropdown"><i class="fe fe-truck"></i> Поставщики</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/provider/new" class="dropdown-item ">Добавить нового</a>
                                    <a href="/provider" class="dropdown-item ">Список поставщиков</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Выгрузка</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="./profile.html" class="dropdown-item ">Profile</a>
                                    <a href="./login.html" class="dropdown-item ">Login</a>
                                    <a href="./register.html" class="dropdown-item ">Register</a>
                                    <a href="./forgot-password.html" class="dropdown-item ">Forgot password</a>
                                    <a href="./400.html" class="dropdown-item ">400 error</a>
                                    <a href="./401.html" class="dropdown-item ">401 error</a>
                                    <a href="./403.html" class="dropdown-item ">403 error</a>
                                    <a href="./404.html" class="dropdown-item ">404 error</a>
                                    <a href="./500.html" class="dropdown-item ">500 error</a>
                                    <a href="./503.html" class="dropdown-item ">503 error</a>
                                    <a href="./email.html" class="dropdown-item ">Email</a>
                                    <a href="./empty.html" class="dropdown-item ">Empty page</a>
                                    <a href="./rtl.html" class="dropdown-item ">RTL mode</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="my-3 my-md-5">
            <div class="container">
                <?= $content ?>
            </div>
        </div>


    </div>


    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">First link</a></li>
                                <li><a href="#">Second link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Third link</a></li>
                                <li><a href="#">Fourth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Fifth link</a></li>
                                <li><a href="#">Sixth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Other link</a></li>
                                <li><a href="#">Last link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    Сервис для управления продажами в Авито Магазине
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="/docs">Помощь</a></li>
                                <li class="list-inline-item"><a href="/api">API</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="/bug" class="btn btn-outline-primary btn-sm">Задать вопрос</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href="/">VITOPRICE</a>. Разработан в <a href="#" target="_blank">intdigit.</a> Все права защищены
                </div>
            </div>
        </div>
    </footer>


</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>