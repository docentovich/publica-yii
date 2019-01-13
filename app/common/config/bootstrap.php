<?php

\Yii::setAlias('@common', dirname(__DIR__));
//\Yii::setAlias('@app', dirname(dirname(__DIR__)) . '/src');
\Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');
\Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
\Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
\Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
\Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/src/modules');
\Yii::setAlias('@src', dirname(dirname(__DIR__)) . '/src');
\Yii::setAlias('@models', dirname(dirname(__DIR__)) . '/src/models');
\Yii::setAlias('@components', dirname(dirname(__DIR__)) . '/src/components');
\Yii::setAlias('@templates', dirname(dirname(__DIR__)) . '/src/templates');
\Yii::setAlias('@DateTimePlanner', \Yii::getAlias('@modules') . '/date-time-planner' );
\Yii::setAlias('@tosee', \Yii::getAlias('@modules') . '/tosee' );
\Yii::setAlias('@probank', \Yii::getAlias('@modules') . '/probank' );
\Yii::setAlias('@users', \Yii::getAlias('@modules') . '/users' );
\Yii::setAlias('@orders', \Yii::getAlias('@modules') . '/orders' );
\Yii::setAlias('@ImageAjaxUpload', \Yii::getAlias('@components') . '/image-ajax-upload' );
\Yii::setAlias('@userPanelTemplate', \Yii::getAlias('@templates') . '/userPanel' );


\Yii::$container->setSingletons([
    'SearchService' => [
        'class' => \app\services\BaseSearchService::class
    ],
    'ImagesService' => [
        'class' => \app\services\BaseImagesService::class
    ]
]);
