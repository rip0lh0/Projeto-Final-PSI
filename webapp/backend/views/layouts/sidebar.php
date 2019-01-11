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
            'icon' => ' icofont-cat-face',
            'label' => 'Animais',
        ];
        $animalMenuItems[] = [
            'url' => ['adoption/index'],
            'icon' => 'book',
            'label' => 'Adoções',
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
            'label' => 'Animais',
            'items' => $animalMenuItems,
        ];

        // $menuItems[] = [
        //     'url' => ['animal/index'],
        //     'icon' => 'paw',
        //     'label' => 'Animais',
        // ];

        $menuItems[] = [
            'url' => ['/site/options'],
            'icon' => 'cog',
            'label' => 'Definições',
        ];

        echo Menu::widget(['items' => $menuItems]);
        ?>
    </section>
</aside>