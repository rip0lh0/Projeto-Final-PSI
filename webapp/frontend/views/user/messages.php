<?php 

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Mensagens';
$this->params['breadcrumbs'][] = $this->title;

$script = '
    $(".show-details").on("click", function(){
        var adoptionid = $(this).attr("adoption-id");

        console.log(adoptionid);

        $("#message-modal-container").empty();
        $("#message-modal-container").load("' . Url::to(['user/message']) . '?id_adoption=" + adoptionid);
    });

    
';


$this->registerJs($script);
?>

<div class="breadcumb_area bg-img" style="background-image: url('<?= Url::base(true) ?>/images/bg_1.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2><?= $this->title ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-wrapper section-padding-80">
    <div class="container">
        <div class="row">
            
            <?php foreach ($adoptions as $key => $adoption) { ?>
                
                <!-- Single Blog Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-blog-area mb-50">
                        <img src="data:image/jpeg;base64, <?= $adoption->kennelAnimal->animal->getImage('0.jpg'); ?>" alt="">
                        <!-- Post Title -->
                        <div class="post-title">
                            <a href="#"><?= $adoption->kennelAnimal->animal->name ?></a>
                        </div>
                        <!-- Hover Content -->
                        <div class="hover-content">
                            
                            <!-- Post Title -->
                            <div class="hover-post-title">
                                <a href="#"><?= ($adoption->recentMessage->user->kennel) ? $adoption->recentMessage->user->kennel->name : $adoption->recentMessage->user->adopter->name ?></a>
                            </div>
                            <p><?= $adoption->recentMessage->message ?></p>
                            <a href="#" class="show-details" adoption-id="<?= $adoption->id ?>">Detalhes <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <?php 
            } ?>
            
        </div>
    </div>
</div>


<div id="message-modal-container">

</div>



