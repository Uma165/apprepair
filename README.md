Сайт начинаю с создании бд app там создаю таблице user, application, category, comment, post, date, time
Далее перехожу на gii там создаю модели и контроллеры так же создаю админ страницу
Далее перехожу в sitecontroller и записываю код:
$status = Comment::find()->where(['status'=>1])->all(); Передает все комментарии с установленным статусом "1" в переменную $status.

        $model = new Comment();Создает новый объект модели Comment.
        $comments = Comment::find()->all(); Передает все комментарии в переменную $comments.
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Комментарий у модератора');
            $model->save();
            return $this->refresh(); Если данные были отправлены через POST-запрос, то сохраняет комментарий, устанавливает flash-сообщение "Комментарий у модератора" и осуществляет перезагрузку страницы.
        }

        if(isset($_GET['id']) && $_GET['id']!=""){
        $categories = Category::find()->where(['id'=>$_GET['id']])->asArray()->one();
        $posts= Post::find()->where(['category_id'=>$_GET['id']])->asArray()->all();
        $clothes= Clothe::find()->where(['id'=>$_GET['id']])->asArray()->all(); Если в URL присутствует параметр 'id' и этот параметр не пустой, то находит категорию с указанным 'id' и передает ее в переменную $categories. Также находит все посты с указанной категорией и передает их в переменную $posts. Аналогично для переменной
            return $this->render('contact', [
                'categories'=>$categories,
                'posts' => $posts,
                'comments' =>$comments,
                'status'=>$status,
                'model'=>$model,
                'clothes' => $clothes
                Выводит страницу 'contact' с переданными переменными $categories, $posts, $comments, $status, $model и $clothes.


            ]);

       }
       else
            return $this->redirect(['site/index']);Если в URL нет параметра 'id' или этот параметр пустой, то перенаправляет пользователя на страницу 'site/index'.

             public function actionIndex()
    {
        $query = Category::find(); Создает запрос на выборку данных из таблицы "Category" с помощью метода "find" модели "Category". Результат запроса сохраняется в переменную "$query".
        $count = clone $query; Клонирует переменную "$query" в переменную "$count", чтобы сохранить оригинальный запрос на выборку без изменений.
        $pages = new Pagination(['totalCount'=>$count->count(), 'pageSize'=>3]); Создает объект пагинации "Pagination" с указанием общего количества записей (количество записей в переменной "$count") и размера страницы (3 элемента).

        $categories = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();Используя пагинацию, выбирает категории с помощью методов "offset" (смещение) и "limit" (лимит) из переменной "$query". Результат выборки сохраняется в переменной "$categories".
        $schedules = Schedule::find()->all();Создает запрос на выборку данных из таблицы "Schedule" с помощью метода "find" модели "Schedule". Результат запроса сохраняется в переменную "$schedules".

        return $this->render('index', ['categories'=>$categories, 'pages'=>$pages, 'schedules' => $schedules,]);Возвращает результат вызова метода "render" для отображения шаблона "index" и передает в него массив данных, содержащий категории ("categories"), обьект пагинации ("pages") и расписания ("schedules").

    }
     public function actionApplication() В начале функции создается новый объект модели "Applications".
    {
        $model = new Applications();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Ваша заявка отправлена');
            if  ($model->save()) {
                return $this->refresh();
            }
            return $this->refresh();
        }
        происходит проверка, были ли данные отправлены методом POST. Если да, то происходит сохранение модели, установка сообщения об успехе во флеш-сообщение и возврат обновленной страницы с помощью метода "refresh()". Если сохранение прошло успешно, также вызывается метод "refresh()".
        return $this->render('application', [
            'model' => $model,
        ]);Если данные не были отправлены методом POST, происходит отображение страницы "application" с помощью метода "render()", передавая объект модели в виде параметра "model".
    }
    Далее создаю в папке viws файлы с помощью бустрапа 5 создаю дизайн для сайта использую цикл
     <? foreach ($categories as $category): ?>
     <?php echo $category['name']; ?>
     <?php echo Url::toRoute(['site/contact', 'id' => $category['id']]); ?>
     Данный код представляет собой цикл foreach, который проходит по массиву $categories и для каждого элемента выводит значение поля 'img' в HTML-коде. После вывода значения 'img' с помощью функции Url::toRoute формируется URL-ссылка на страницу контактов с передачей параметра 'id', равного значению поля 'id' текущего элемента массива $category.

<?php echo LinkPager::widget([
                'pagination' => $pages,]);?> 
                Данный код отображает виджет LinkPager, который предоставляет навигацию по страницам. В параметре 'pagination' задается объект пагинации $pages, который содержит информацию о количестве страниц и текущей выбранной странице.

В итоге на странице будет отображено элементы управления для перехода на предыдущую и следующую страницу, а также список доступных страниц. При клике на номер страницы произойдет переход на соответствующую страницу.
