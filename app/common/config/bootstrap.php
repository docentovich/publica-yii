<?php
require_once "bootstrap-projects-constants.php";
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/src/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/src/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/src/console');
Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/src/modules');
Yii::setAlias('@models', dirname(dirname(__DIR__)) . '/src/models');
Yii::setAlias('@components', dirname(dirname(__DIR__)) . '/src/components');
Yii::setAlias('@templates', dirname(dirname(__DIR__)) . '/src/templates');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/src/frontend/web/uploads');