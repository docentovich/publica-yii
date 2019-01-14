<?php
require_once "env.php";
define("TOSEE", 1);
define("PROBANK", 2);
define("PUBLICA", 3);
define("SHOOTME", 4);

switch ($_SERVER['SERVER_NAME']) {
    case  TOSEE_SITE:
        define("PROJECT", TOSEE);
        break;
    case PROBANK_SITE:
        define("PROJECT", PROBANK);
        break;
    case PUBLICA_SITE:
        define("PROJECT", PUBLICA);
        break;
    case SHOOTME_SITE:
        define("PROJECT", SHOOTME);
        break;
}
