<?php

use yii\helpers\HTML;
use yii\helpers\Url;

$menuItems[] = [
    'url' => ['site/index'],
    'label' => 'Home',
    'icon' => ''
];

$menuItems[] = [
    'url' => ['animal/index'],
    'label' => 'Animal',
    'icon' => ''
];

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
                <!-- <div class="favourite-area">
                    <a href="#" style="line-height: 103px;"><i class="fa fa-heart fa-2x"></i></a>
                </div> -->
                <!-- User Login Info -->
                <div class="user-login-info">
                    <?= Html::a('<i class="fa fa-user fa-2x"></i>', ['user/authentication'], ['style' => 'line-height: 90px;']); ?>
                    <!-- <a href="#" style="line-height: 103px;"><i class="fa fa-user fa-2x"></i></a> -->
                </div>
            </div>

        </div>
    </header>