<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 25.05.17
 * Time: 17:55
 */

namespace modules\tosee\widgets\pagination;

/**
 * Class Pagination Вывод пагинации на страницах
 * @package modules\tosee\widgets\pagination
 */
class Pagination
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


    public function init()
    {
        parent::init();

        //лимит страниц должно быть не четным
        $this->pages_limit = ($this->display_dots % 2) ? $this->display_dots : $this->display_dots + 1;

        //сколько стр всего
        $this->max_pages = round(($this->total_items / $this->items_limit), 0, PHP_ROUND_HALF_UP);
    }

    public function run()
    {
        //первая ссылка для отображения
        $start = 0;

        //последняя отображаемая страница
        $end = $this->max_pages;

        //отображаем левые точки
        $display_start_dots = false;

        //отображаем праве точки
        $display_end_dots = false;

        //половина от диапазона
        $half_of_pglimit = round(($this->pages_limit / 2), 0, PHP_ROUND_HALF_DOWN);

        if ($this->display_dots) {

            //левый край
            if ($this->current_page - $half_of_pglimit > 0) {

                //определям отображаемый старт
                $star = $this->current_page - $half_of_pglimit;

                $display_start_dots = true;
            }

            //правй край
            if ($this->current_page + $half_of_pglimit < $this->max_pages) {

                //определям отображаемый end
                $end = $this->current_page + $half_of_pglimit;

                $display_end_dots = true;

            }
        }

        $current_page = $this->current_page;
        $max_pages = $this->max_pages;

        return $this->render("view", compact('display_start_dots', 'display_end_dots', 'current_page', 'star', 'end', 'max_pages'));
    }
}