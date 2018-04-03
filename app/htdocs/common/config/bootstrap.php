<?php
// define("TOSEE", 1);
// define("TOSEE_DEV", "tosee.loc");
// define("TOSEE_PROD", "tosee.shablonkin.shn-host.ru");
//
// define("PROBANK", 2);
// define("PROBANK_DEV", "probank.loc");
// define("PROBANK_PROD", "publicayii-probank.shablonkin.shn-host.ru");
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/modules');
Yii::setAlias('@models', dirname(dirname(__DIR__)) . '/models');
Yii::setAlias('@components', dirname(dirname(__DIR__)) . '/components');
Yii::setAlias('@templates', dirname(dirname(__DIR__)) . '/templates');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');