<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\User;

?>
<div class="breadcumb_area bg-img" style="background-image: url('<?= Url::base(true) ?>/images/bg_1.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>Menu</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-wrapper section-padding-80">
    <div class="container">
        <div class="row">
            
            <!-- Single Blog Area -->
            <div class="col-12 col-lg-6">
                <div class="single-blog-area mb-50">
                    <img src="<?= Url::base(true) ?>/images/bg_2.jpg" alt="">
                    <!-- Post Title -->
                    <div class="post-title">
                        <a href="#">Utilizador</a>
                    </div>
                    <!-- Hover Content -->
                    <div class="hover-content">
                        <!-- Post Title -->
                        <div class="hover-post-title">
                        <?= Html::a('Pretende adotar um animal?', ['user/registration', 'signupType' => User::TYPE_ADOPTER]); ?>
                        </div>
                        <p>Muitos cães e gatos estão à sua espera, cheios de afetividade para lhe dar.</p>
                        <?= Html::a('Criar conta <i class="fas fa-angle-right"></i>', ['user/registration', 'signupType' => User::TYPE_ADOPTER], ['class' => 'btn btn-blue btn-large btn-block btn-flat']); ?>
                    </div>
                </div>
            </div>

            <!-- Single Blog Area -->
            <div class="col-12 col-lg-6">
                <div class="single-blog-area mb-50">
                    <img src="<?= Url::base(true) ?>/images/bg_3.jpg" alt="">
                    <!-- Post Title -->
                    <div class="post-title">
                        <a href="#">Associção</a>
                    </div>
                    <!-- Hover Content -->
                    <div class="hover-content">
                        <!-- Post Title -->
                        <div class="hover-post-title">
                            <?= Html::a('Criar conta <i class="fas fa-angle-right"></i>', ['user/registration', 'signupType' => User::TYPE_KENNEL]); ?>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis fringilla tortor. Phasellus purus dignissim convallis.</p>
                        <?= Html::a('Criar conta <i class="fas fa-angle-right"></i>', ['user/registration', 'signupType' => User::TYPE_KENNEL], ['class' => 'btn btn-orange btn-large btn-block btn-flat']); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    
