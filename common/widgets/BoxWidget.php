<?php

namespace app\common\widgets;

use yii\base\Widget;
use yii\helpers\Html;


class BoxWidget extends Widget
{

//    public $wraperTheme = 'box-success';
    public $wraperTheme = 'box-primary';
    public $wraperClass = 'box';
    public $headerClass = 'box-header with-boder';
    public $bodyClass = 'box-body';
    public $footerClass = 'box-footer';

    public $removable = false;

    public $headerHtml = null;
    public $footerHtml = null;

    public function init()
    {/*{{{*/
        parent::init();

        ob_start();

        echo Html::beginTag('div',
            $this->getClassOption($this->wraperClass . ' ' . $this->wraperTheme)
        );
        echo $this->renderHeader();
        echo Html::beginTag('div', $this->getClassOption($this->bodyClass) );
    }/*}}}*/

    public function run()
    {/*{{{*/
        echo Html::endTag('div');
        echo $this->renderFooter();
        echo Html::endTag('div');

        return ob_get_clean();
    }/*}}}*/

    public function renderHeader()
    {/*{{{*/
        if ($this->headerHtml === null)
            return '';

        $html = Html::beginTag('div', $this->getClassOption($this->headerClass) );
        $html .= $this->headerHtml;

        if ($this->removable)
            $html .= $this->getRemoveButton();

        $html .= Html::endTag('div');

        return $html;
    }/*}}}*/

    public function renderFooter()
    {/*{{{*/
        if ($this->footerHtml === null)
            return '';

        return Html::beginTag('div', $this->getClassOption($this->footerClass) )
            . $this->footerHtml
            . Html::endTag('div');
    }/*}}}*/

    public function getClassOption($class)
    {/*{{{*/
        return ['class' => $class];
    }/*}}}*/

    public function getRemoveButton()
    {/*{{{*/
        return <<<HTML
<div class="box-tools pull-right">
    <button data-widget="remove" class="btn btn-box-tool">
        <i class="fa fa-times"></i>
    </button>
</div>
HTML;
    }/*}}}*/
}
