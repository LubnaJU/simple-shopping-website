<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\CartForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use frontend\models\Cart;
use frontend\models\CartForm;
$total_amount = 0;
$this->title = 'My Cart';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['site/user_home_page']];

?>
<div class="site-Products">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

                <?php
					if (!empty($user_products)) { 
						foreach($user_products as $product){

					?>

					<div class='btn' style="cursor: context-menu; background-color:#E6E6FA ; margin-bottom:25px; width:350px">
						<div class="product-image"><img src="<?php echo $product["imageFile"]; ?>"></div>

						<div class="product-name"><?php echo "name : ".$product["name"]; ?></div>
						<div class="product-price"><?php echo "Price : $".$product["price"]; ?></div>
						<div class="product-category-name"><?php echo "category : ".$product["category_name"]; ?></div>
						<div class="product-quantity"><?php echo "quantity : ".$product["quantity"]; ?></div>
						<?php $total_amount = $product["price"]*$product['quantity']+$total_amount ?>
					</div>
					<br>
					<?php
						}
					}
					?>

					<h2><b>Total amount = $<?php echo $total_amount?></b></h2>
        </div>
    </div>
</div>

