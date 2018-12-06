<?php
use yii\helpers\HTML;

?>

<header>
    <!-- navigation -->
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= Html::a(Html::img('images/logo_500x150.png', ['class' => 'navbar-brand ']), ['site/index']); ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="hvrcenter"><?= Html::a('Login', ['site/login']) ?></li>
                        <li class="hvrcenter"><?= Html::a('Signup', ['site/menu']) ?></li>
                        <?php 
                    } else { ?>
                        <li class="hvrcenter"><?= Html::a('Logout', ['site/logout'], ['data-method' => 'post']); ?></li>
                        <?php 
                    } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
            
        </div><!-- /.container-fluid -->
    </nav><!-- /navigation -->
</header>