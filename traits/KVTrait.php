<?php

namespace app\traits;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

trait KVTrait
{

    /**
     * @brief 获取kv数组
     * @param $key
     * @param $value
     * @param $condition => ['where' => [], 'orderBy' => mixed ]
     *
     * @return  kv.array
     */
    public static function kv($key, $value, array $condition = [])
    {/*{{{*/

        $query = static::find()->select([$key, $value]);

        if (!empty($condition)) {

            foreach ($condition as $property => $v) {

                if ( ! method_exists($query, $property))
                    throw new InvalidConfigException(" {$query::className()} does not has property: {$property}");

                $query->$property($v);
            }

        }

        $raw = $query->asArray()->all();

        $value = empty($raw) ? [] : ArrayHelper::map($raw, $key, $value);

        return $value;
    }/*}}}*/

}
