<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\OwlCarouselAsset;
use frontend\widgets\Shop\CartWidget;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
OwlCarouselAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <link href="<?= Yii::getAlias('@web/image/cart.png') ?>" rel="icon"/>
    <?php $this->head() ?>
</head>
<body class="common-home">
<?php $this->beginBody() ?>
<nav id="top">
    <div class="container">
        <div class="pull-left">
            <form action="/index.php?route=common/currency/currency" method="post"
                  enctype="multipart/form-data" id="form-currency">
                <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <strong>$</strong>
                        <span class="hidden-xs hidden-sm hidden-md">Currency</span> <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro
                            </button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound
                                Sterling
                            </button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US
                                Dollar
                            </button>
                        </li>
                    </ul>
                </div>
                <input type="hidden" name="code" value=""/>
                <input type="hidden" name="redirect" value="/index.php?route=common/home"/>
            </form>
        </div>
        <div id="top-links" class="nav pull-right">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Active</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Аккаунт</a>
                    <ul class="dropdown-menu">
                        <?php if (Yii::$app->user->isGuest): ?>
                        <li><a class="dropdown-item" href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Login</a></li>
                        <li><a class="dropdown-item" href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">SignUp</a></li>
                        <?php else: ?>
                        <li><a class="dropdown-item" href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>">Cabinet</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>">LogOut</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" id="wishlist-total" href="<?= Url::to(['/cabinet/wishlist/index']) ?>">Wish list</a></li>
                        <li><a class="dropdown-item" id="wishlist-total" href="<?= Url::to(['/shop/cart/index']) ?>">Shopping Cart</a></li>
                        <li><a class="dropdown-item" id="wishlist-total" href="/index.php?route=checkout/checkout">Checkout</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo">
                    <a href="<?= Url::home() ?>"><img
                                src="<?= Yii::getAlias('@web/image/logo.png') ?>" title="Your Store" alt="Your Store"
                                class="img-responsive"/></a>
                </div>
            </div>
            <div class="col-sm-5">
                <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>
                <div id="search" class="input-group">
                    <input type="text" name="text" value="" placeholder="Search" class="form-control input-lg"/>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <?= Html::endForm() ?>
            </div>
            <div class="col-sm-3">
<!--                --><?php //= CartWidget::widget() ?>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <?php
    NavBar::begin([
        'options' => [
            'screenReaderToggleText' => 'Menu',
            'id' => 'menu',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Catalog', 'url' => ['/shop/catalog/index']],
            ['label' => 'Blog', 'url' => ['/blog/post/index']],
            ['label' => 'Contact', 'url' => ['/contact/index']],
        ],
    ]);
    NavBar::end();
    ?>
</div>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Information</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/information&amp;information_id=4">About
                            Us</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=6">Delivery
                            Information</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=3">Privacy
                            Policy</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=5">Terms
                            &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/contact">Contact Us</a></li>
                    <li><a href="/index.php?route=account/return/add">Returns</a></li>
                    <li><a href="/index.php?route=information/sitemap">Site Map</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Extras</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=product/manufacturer">Brands</a></li>
                    <li><a href="/index.php?route=account/voucher">Gift Certificates</a></li>
                    <li><a href="/index.php?route=affiliate/account">Affiliates</a></li>
                    <li><a href="/index.php?route=product/special">Specials</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>My Account</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=account/account">My Account</a></li>
                    <li><a href="/index.php?route=account/order">Order History</a></li>
                    <li><a href="/index.php?route=account/wishlist">Wish List</a></li>
                    <li><a href="/index.php?route=account/newsletter">Newsletter</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p>Powered By <a href="http://www.opencart.com">OpenCart</a><br/> Your Store &copy; 2017</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
