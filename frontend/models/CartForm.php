<?php


namespace frontend\models;


use Yii;
use yii\base\Model;
use frontend\models\Cart;
use common\models\Product;

/**
 * Cart form
 */
class CartForm extends Model
{
	public $quantity;
	public $user_id;
	public $product_id;

    /**
     * {@inheritdoc}
     */
	 
	public function rules()
    {
        return [
            [['quantity' ,'product_id'] , 'required'],
        ];
    }
    public static function tableName()
    {
        return '{{%Cart}}';
    }

    
	public function add_to_cart()
    {
		if(!($cart = Cart::find()->where(['product_id' => $this->product_id])->one()))
		{
			$cart = new Cart();
            $cart->quantity = $this->quantity;
			$cart->user_id = $_SESSION['user_id'];
            $cart->product_id = $this->product_id;

            return $cart->save();
		}

		else
		{
			$cart->updateCounters(['quantity' =>$this->quantity ]);
			//Yii::$app->session->setFlash('success', 'The item has been added.');
			return true;
		}
    }
		 public function get_all(){
			 		return Cart::find()->asArray()->all();

			 
		 }
		 public function get_user_cart(){
			 			 		$test =  Cart::find()->where(['user_id'=>$_SESSION['user_id']])->asArray()->all();
			 		return Cart::find()->select('Product.*, Cart.*')->leftJoin('Product', '`Product`.`id` = `Cart`.`product_id`')->where(['user_id'=>$_SESSION['user_id']])->asArray()->all();

			 
		 }
}
