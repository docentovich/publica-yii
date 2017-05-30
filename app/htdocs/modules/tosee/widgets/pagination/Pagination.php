<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 25.05.17
 * Time: 17:55
 */

namespace modules\tosee\widgets\pagination;
use yii\base\Widget;

/**
 * Class Pagination Вывод пагинации на страницах
 * @package modules\tosee\widgets\pagination
 */
class Pagination extends Widget
{
    /**
     * @var Колличество элементов
     */
    public $total_items;

    /**
     * @var int Кол-во отображаемых на странице элементов
     */
    public $items_limit = 20;

    /**
     * @var int Текущая страница
     */
    public $current_page = 1;

    /**
     * @var int Кол-во отображаемых страниц.
     */
    public $pages_limit = 5;

    /**
     * @var bool Отображение точек
     */
    public $display_dots = true;

    /**
     * @var Страниц всего
     */
    public $max_pages;

    /**
     * @var Урл
     */
    public $url;


    public function init()
    {
        parent::init();

        //лимит страниц должно быть не четным
        $this->pages_limit = ($this->pages_limit % 2) ? $this->pages_limit : $this->pages_limit + 1;

        //сколько стр всего
        $this->max_pages = ceil ($this->total_items / $this->items_limit);
    }

    public function run()

    {
        if($this->total_items == 0) return;
        //первая ссылка для отображения
        $start = 1;

        //последняя отображаемая страница
        $end = $this->max_pages;

        //отображаем левые точки
        $display_start_dots = false;

        //отображаем праве точки
        $display_end_dots = false;

        //половина от диапазона
        $a = ($this->pages_limit / 2);
        $half_of_pglimit = round($a, 0, PHP_ROUND_HALF_DOWN);

        if ($this->display_dots) {

            //левый край
            if (($this->current_page - $half_of_pglimit) > 0) {

                //определям отображаемый старт
                $start = $this->current_page - $half_of_pglimit;

                $display_start_dots = true;
            }

            //правй край
            if ($this->current_page + $half_of_pglimit < $this->max_pages) {

                //определям отображаемый end
                $end = $this->current_page + $half_of_pglimit;

                $display_end_dots = true;

            }
        }

        return $this->render("view", [
            'display_start_dots'    => $display_start_dots,
            'display_end_dots'      => $display_end_dots,
            'current_page'          => $this->current_page,
            'start'                 => $start,
            'end'                   => $end,
            'url'                   => $this->url,
            'max_pages'             => $this->max_pages
        ]);
    }
}