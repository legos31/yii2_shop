<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Blog\LastPostsWidget;
use frontend\widgets\Shop\FeaturedProductsWidget;

\frontend\assets\OwlCarouselAsset::register($this);

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-12">
        <div id="slideshow0" class="owl-carousel" style="opacity: 1;">
            <div class="item">
                <a href="index.php?route=product/product&amp;path=57&amp;product_id=49"><img
                            src="http://localhost:8080/slider/phone_1140.jpg"
                            alt="iPhone 6" class="img-responsive"/></a>
            </div>
            <div class="item">
                <img src="http://localhost:8080/slider/mac_1140.jpg"
                     alt="MacBookAir" class="img-responsive"/>
            </div>
        </div>
        <h3>Featured</h3>

<!--        --><?php //= FeaturedProductsWidget::widget([
//            'limit' => 4,
//        ]) ?>

        <h3>Last Posts</h3>

<!--        --><?php //= LastPostsWidget::widget([
//            'limit' => 4,
//        ]) ?>

        <div id="carousel0" class="owl-carousel">
            <div class="item text-center">
                <img src="http://localhost:8080/slider/mac.jpg" alt="NFL"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/iphone.jpg"
                     alt="RedBull" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/mac.jpg" alt="Sony"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/iphone.jpg"
                     alt="Coca Cola" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/mac.jpg"
                     alt="Burger King" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/iphone.jpg" alt="Canon"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/mac.jpg"
                     alt="Harley Davidson" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/iphone.jpg" alt="Dell"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/mac.jpg"
                     alt="Disney" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/iphone.jpg"
                     alt="Starbucks" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://localhost:8080/slider/mac.jpg"
                     alt="Nintendo" class="img-responsive"/>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa-solid fa-arrow-right"></i>\'],
    dots: true
});') ?>

<?php $this->registerJs('
$(\'#carousel0\').owlCarousel({
    items: 6,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa-solid fa-arrow-right"></i>\'],
    dots: true
});') ?>

<?php $this->endContent() ?>