<?php

namespace app\widgets\alert;

use yii\base\Widget;

class Alert extends Widget
{
    const MESSAGE_SUCCESS = 'success';
    const MESSAGE_DANGER = 'danger';
    const MESSAGE_WARNING = 'warning';
    const MESSAGE_INFO = 'info';
    public $position;

    public function init()
    {
        parent::init();
    }

    private function checkType($type)
    {
        return in_array($type, [
            self::MESSAGE_SUCCESS,
            self::MESSAGE_DANGER,
            self::MESSAGE_WARNING,
            self::MESSAGE_INFO,
        ]);
    }

    public function run()
    {
        if (\Yii::$app->session->getAllFlashes()) { ?>
            <div class="my-alert">
                <?php foreach (\Yii::$app->session->getAllFlashes() as $type => $message) {
                    if(is_array($message)){
                        if($message['position'] !== $this->position){
                            break;
                        }
                        $message = $message['message'];
                    }elseif(isset($this->position)){
                        break;
                    }
                    ?>
                    <?php if ($this->checkType($type)) { ?>
                        <?= \yii\bootstrap\Alert::widget([
                            'options' => ['class' => 'alert-dismissible alert-' . $type],
                            'body' => $message
                        ]) ?>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php }
    }
}