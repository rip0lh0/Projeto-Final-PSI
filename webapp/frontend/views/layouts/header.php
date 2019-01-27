<?php

use yii\helpers\HTML;
use yii\helpers\Url;

$menuItems[] = [
    'url' => Url::home(),
    'label' => '<i class="fas fa-home fa-2x"></i>',
    'icon' => ''
];

// $menuItems[] = [
//     'url' => ['animal/index'],
//     'label' => '<i class="fas fa-paw fa-2x"></i>',
//     'icon' => '',
//     'id' => 'menuAdotar'
// ];

?>
 <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="<?= Url::home() ?>" style="height: 100%;"><?= Html::img(Url::home() . 'images/main_logo.png', ['style' => 'height: 100%;', 'alt' => 'My logo']) ?></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                        <?= Html::a('Adotar', ['animal/index'], ['id'=>'menuAdotar'], ['class' => 'fas fa-paw fa-2x']) ?>
                            <?php foreach ($menuItems as $key => $item) {
                                if (!array_key_exists('items', $item)) {
                                    echo '<li>' . Html::a($item['label'], $item['url']) . '</li>';
                                } else {
                                    echo '<li>' . Html::a($item['label'], '#') . '<ul class="dropdown">';
                                    foreach ($item['items'] as $key => $subItem) {
                                        echo '<li>' . Html::a($subItem['label'], $subItem['url']) . '</li>';
                                    }
                                    echo '</li></ul>';
                                }
                            } ?>


                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <!-- <div class="search-area">
                    <form action="#" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div> -->
                <!-- Favourite Area -->
                <!-- <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><i class="fas fa-heart"></i></a>
                </div> -->
                <!-- User Login Info -->
                <div class="user-login-info">
                    <?= Html::a('<i class="fas fa-user"></i>', ((Yii::$app->user->isGuest) ? ['user/authentication'] : '#'), ['class' => 'nav-profile-btn', 'style' => 'vertical-align: middle; font-size: 1.6em; color: #787878;', 'id' => 'btn-login']); ?>
                    <!-- <a href="#" style="line-height: 103px;"><i class="fa fa-user fa-2x"></i></a> -->
                </div>
            </div>

        </div>
    </header>