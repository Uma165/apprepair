<?php

namespace app\controllers;

use app\models\Applications;
use app\models\Category;
use app\models\Clothe;
use app\models\Comment;
use app\models\Post;
use app\models\Schedule;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        $query = Category::find();
        $count = clone $query;
        $pages = new Pagination(['totalCount'=>$count->count(), 'pageSize'=>3]);

        $categories = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $schedules = Schedule::find()->all();
        return $this->render('index', ['categories'=>$categories, 'pages'=>$pages, 'schedules' => $schedules,]);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->isAdmin()){
                return $this->redirect(['/admin']);
            }
            return $this->redirect(['/site/index']);
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $status = Comment::find()->where(['status'=>1])->all();

        $model = new Comment();
        $comments = Comment::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Комментарий у модератора');
            $model->save();
            return $this->refresh();
        }

        if(isset($_GET['id']) && $_GET['id']!=""){
        $categories = Category::find()->where(['id'=>$_GET['id']])->asArray()->one();
        $posts= Post::find()->where(['category_id'=>$_GET['id']])->asArray()->all();
        $clothes= Clothe::find()->where(['id'=>$_GET['id']])->asArray()->all();
            return $this->render('contact', [
                'categories'=>$categories,
                'posts' => $posts,
                'comments' =>$comments,
                'status'=>$status,
                'model'=>$model,
                'clothes' => $clothes


            ]);

       }
       else
            return $this->redirect(['site/index']);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if(isset($_GET['id']) && $_GET['id']!=""){
            $categories = Category::find()->where(['id'=>$_GET['id']])->asArray()->one();
            $clothes= Clothe::find()->where(['post_id'=>$_GET['id']])->asArray()->all();

            return $this->render('about', [
                'categories'=>$categories,
                'clothes' => $clothes,

            ]);

        }
        else
            return $this->redirect(['site/index']);
    }

    public function actionSchedule()
    {
        $schedules= Schedule::find()->all();
        return $this->render('schedule', ['schedules'=>$schedules]);
    }

    public function actionClothe(){
        if(isset($_GET['id']) && $_GET['id']!=""){
            $posts = Post::find()->where(['id'=>$_GET['id']])->asArray()->one();
            return $this->render('clothe', [
                'posts'=>$posts,

            ]);

        }
        else
            return $this->redirect(['site/index']);
    }

    public function actionApplication()
    {
        $model = new Applications();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Ваша заявка отправлена');
            if  ($model->save()) {
                return $this->refresh();
            }
            return $this->refresh();
        }
        return $this->render('application', [
            'model' => $model,
        ]);
    }


}
