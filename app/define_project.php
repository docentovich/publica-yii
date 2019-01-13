<?php
require_once "env.php";
define("TOSEE", 1);
define("PROBANK", 2);

switch ($_SERVER['SERVER_NAME']) {
    case  TOSEE_SITE:
        define("PROJECT", TOSEE);
        break;
    case PROBANK_SITE:
        define("PROJECT", PROBANK);
        break;
}
