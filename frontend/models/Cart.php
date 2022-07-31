<?php

namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


/**
 * Login form
 */
class Cart extends ActiveRecord

/**
 * Cart model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity

 */
{
    /**
     * {@inheritdoc}
     */
	 

    public static function tableName()
    {
       return '{{%Cart}}';
    }

  

    /**
     * {@inheritdoc}
     */
	 

	public function get_all(){
			 		return Cart::find()->asArray()->all();

			 
		 }

   }
