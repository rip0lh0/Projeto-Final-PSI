<?php
use yii\helpers\HTML;
?>

<div id="wrapper">
        <div class="overlay"></div>
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                </li>
                
                <li>
                    <?=Html::a('User Profile', ['site/userprofile'])?>
                </li>
                <li>
                    <!-- <a href="#"><i class="fa fa-fw fa-folder"></i> Canil</a> -->
                    <?=Html::a('Canil',['site/canil'])?>
                </li>
                <li>
                    <?=Html::a('Animal Magazine', ['site/animalmagazine'])?>
                </li>
                <li>
                    <?=Html::a('Animal Search', ['site/animalsearch'])?>
                </li>
                <li>
                    <a href="#"><i class="twitter"></i> Last page</a>
                </li>
                    <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Help <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Dropdown heading</li>
                    <li> <?=Html::a('FAQ', ['site/faq'])?> </li>
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                  </ul>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->
        <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
          </div>