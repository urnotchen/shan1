<?php

namespace app\common\helpers;
use yii\base\Object;

class StrHelper extends Object{

    /*
     * 说明 : 根据宽度截取字符串,大于N个中文字符的宽度就截取N个中文字符的宽度,小于不变
     * 参数 : (string)字符串
     * 返回 : (string)处理后的字符串
     * */
    public static function cutNChar($str,$len){
        if(mb_strwidth($str, 'utf8') > $len * 2){
            return mb_strimwidth($str, 0, $len * 2, '', 'utf8');
        }
        return $str;
    }
}
