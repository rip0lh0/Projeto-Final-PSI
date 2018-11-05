<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-paw"></i> <span>Animals</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-paw"></i> Animals</a></li>
                    <li><a href="#"><i class="fa fa-book"></i> Adoptions</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-file"></i> <span>Reports</span></a></li>
            <li><a href="#"><i class="fa fa-bar-chart"></i> <span>Statistics</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
<!-- /.sidebar -->
</aside>