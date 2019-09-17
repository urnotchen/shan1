<?php

namespace app\common\helpers;

use Yii;
use yii\base\Object;
use yii\helpers\Url;
use yii\helpers\Html;

class SidebarItems extends Object
{

    private static $_items = [];

    public $defaultItem = [];

    public function init()
    {/*{{{*/
        parent::init();

        $this->_items = $this->defaultItem;
    }/*}}}*/

    public static function getItems()
    {/*{{{*/
        return array_filter(self::$_items, function ($item) {
            return ! empty($item);
        });
    }/*}}}*/

    public static function push(array $items)
    {/*{{{*/
        $this->_items[] = $items;
    }/*}}}*/

    public static function unshift(array $item)
    {/*{{{*/
        $itemArr = $this->_items;
        array_unshift($itemArr, $item);
        $this->_items = $itemArr;
    }/*}}}*/

    public static function setItems($items)
    {/*{{{*/
        self::$_items = $items;
    }/*}}}*/

}

