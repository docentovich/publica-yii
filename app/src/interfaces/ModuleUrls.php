<?php

namespace app\interfaces;

interface ModuleUrls
{
    public static function frontUrls(): array;
    public static function backUrls(): array;
}