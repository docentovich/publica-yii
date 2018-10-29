<?php

namespace app\modules\users\controllers;

class SecurityController extends \dektrium\user\controllers\SecurityController
{
    public $layout = "@current_template/layouts/login";
}