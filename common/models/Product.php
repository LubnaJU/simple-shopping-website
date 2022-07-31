<?php

namespace common\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


/**
 * Login form
 */
class Product extends ActiveRecord

/**
 * Product model
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property string $category_name
 * @property string $imageFile

 */
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Product}}';
    }

  

    /**
     * {@inheritdoc}
     */
	 
	 public function get_products()
    {
		
		return Product::find()->asArray()->all();

    }
	 public function get_product_by_id($id)
    {
		
		return Product::find()->where(['id'=>$id])->asArray()->all()[0];

    }
   }
