<?php

namespace backend\controllers;


use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use backend\models\SignupForm;
use backend\models\Dashboard;
use common\models\LoginForm;
use backend\models\CategoryForm;
use common\models\Category;
use backend\models\ProductForm;
use common\models\Product;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
					[
                        'actions' => ['signup', 'dashboard', 'add_product','add_category','edit_category','edit_product'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

	/**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    /**
     * Login action.
     *
     * @return string|Response
     */
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->redirect(['/site/dashboard']);
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

/**
     * Dashboard action.
     *
     * @return Response
     */
    public function actionDashboard()
    {
		$this->layout = 'layout_with_logout';

		$model = new Dashboard();
       
        return $this->render('dashboard', [
            'model' => $model,
        ]);    
		}

	public function actionAdd_category()
    {      
		$this->layout = 'layout_with_logout';
		$model = new CategoryForm();
        if ($model->load(Yii::$app->request->post()) && $model->add_category()) {
            Yii::$app->session->setFlash('success', 'The category has been added.');
        }
		 $model->name = '';

        return $this->render('category', [
            'model' => $model,
			'categories' => $model->get_categories()
        ]);
	
    }
	public function actionEdit_category()
    {		$this->layout = 'layout_with_logout';
			$model = new CategoryForm();
			
			if ($model->load(Yii::$app->request->post()) && $model->edit_category($_GET['id'])) {
            Yii::$app->session->setFlash('success', 'The category has been edited.');
			return $this->render('category', [
            'model' => $model,
			'categories' => $model->get_categories()
        ]);
        }
		
			return $this->render('edit_category', [
			            'model' => $model
        ]);
		
    }	
	public function actionAdd_product()
    {   
		$this->layout = 'layout_with_logout';
		$categories = new CategoryForm();
		$model = new ProductForm();
		$products = new Product();
		
        if ($model->load(Yii::$app->request->post())) {
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->add_product()) {
                // file is uploaded successfully
			Yii::$app->session->setFlash('success', 'The product has been added.');            }
		}
		
		$list = ($categories->get_categories());
        return $this->render('product', [
            'model' => $model,
			'list'=>$list,
			'products' => $products->get_products()

        ]);
	
    }
	
	public function actionEdit_product()
    {		$this->layout = 'layout_with_logout';
			$model = new ProductForm();
			
			if ($model->load(Yii::$app->request->post())) {
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->edit_product($_GET['id'])) {
				Yii::$app->session->setFlash('success', 'The product has been edited.');
			}				
			return $this->render('product', [
            'model' => $model,
			'products' => $model->get_products()
        ]);
        }
		
			return $this->render('edit_product', [
			            'model' => $model
        ]);
		
    }	
}
