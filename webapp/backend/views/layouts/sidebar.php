<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dmstr\widgets\Menu;

AppAsset::register($this);
?>

<aside class="main-sidebar">
    <section class="sidebar">
       <?php
        /* Animals Menu Items*/
        $animalMenuItems = [];
        $animalMenuItems[] = [
            'url' => ['animal/index'],
            'icon' => 'paw',
            'label' => 'Animals',
        ];
        $animalMenuItems[] = [
            'url' => ['#'],
            'icon' => 'heart',
            'label' => 'Medical',
        ];
        /* End Animals Menu Items */

        $menuItems = [];
        $menuItems[] = [
            'url' => ['/site/index'],
            'icon' => 'home',
            'label' => 'Home',
        ];
        $menuItems[] = [
            'icon' => 'paw',
            'label' => 'Animals',
            'items' => $animalMenuItems,
        ];

        echo Menu::widget(['items' => $menuItems]);
        ?>
    </section>
</aside>