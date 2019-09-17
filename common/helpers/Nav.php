<?php

namespace app\common\helpers;

class Nav extends \yii\bootstrap\Nav
{

    public $dropDownCaret = '<i class="fa fa-angle-left pull-right"></i>';

    protected function renderDropdown($items, $parentItem)
    {/*{{{*/
        return Dropdown::widget([
            'items'         => $items,
            'encodeLabels'  => $this->encodeLabels,
            'clientOptions' => false,
            'view'          => $this->getView(),
        ]);
    }/*}}}*/

}