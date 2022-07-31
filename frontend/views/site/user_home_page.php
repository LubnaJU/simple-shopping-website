<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Products';
?>
<div class="site-Products">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

                <?php
					if (!empty($products_list)) { 
						foreach($products_list as $product){

					?>

					<div class='btn' style="cursor: context-menu; background-color:#E6E6FA ; margin-bottom:25px; width:350px">
						<div class="product-image"><img src="<?php echo $product["imageFile"]; ?>"></div>

						<?php echo Html::tag('div',Html::a('Product : '.$product["name"],['/site/view_product','id' =>$product['id']],['class' => ['btn btn-link']]));
							?>
						<div class="product-price"><?php echo "Price : $".$product["price"]; ?></div>
						<div class="product-category-name"><?php echo "category : ".$product["category_name"]; ?></div>
					</div>
					<br>
					<?php
						}
					}
					?>

        </div>
    </div>
</div>
