<?php

namespace app\traits;

/**
 * RequiredLabelTrait class file.
 * for model
 * @Author haoliang
 * @Date 13.05.2015 15:03
 */
trait RequiredLabelTrait
{

    public function requiredLabel($attr)
    {/*{{{*/
        return $this->getAttributeLabel($attr)
            . $this->requiredLabelStyle();
    }/*}}}*/

    public function requiredLabelStyle()
    {/*{{{*/
        return ' *';
    }/*}}}*/

}
