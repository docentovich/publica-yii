<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/src/modules');
Yii::setAlias('@app', dirname(dirname(__DIR__)) . '/src');
Yii::setAlias('@models', dirname(dirname(__DIR__)) . '/src/models');
Yii::setAlias('@components', dirname(dirname(__DIR__)) . '/src/components');
Yii::setAlias('@templates', dirname(dirname(__DIR__)) . '/src/templates');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');