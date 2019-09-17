<?php

namespace app\common\helpers;

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
     * @param $useCache
     * @param $duration 仅新添加入缓存时有效,默认10分钟
     *
     * @return  kv.array
     */
    public static function kv($key, $value, array $condition = [], $useCache = true, $duration = 600)
    {/*{{{*/

        # 是否使用缓存, 函数调用级别的限制
        $enableKVCache = isset(Yii::$app->params['enableKVCache']) ? Yii::$app->params['enableKVCache'] : false;
        if ($useCache && $enableKVCache) {
            # 确保是该函数完全同样的使用
            $params = func_get_args();
            $params[] = __CLASS__ . __METHOD__ ;
            $cacheKey = md5(json_encode($params));
            $cache = Yii::$app->cache;
            if ( ($cacheValue = $cache->get($cacheKey)) !== false)
                return $cacheValue;
        }

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

        if ($useCache && $enableKVCache) {
            $cache->set($cacheKey, $value, $duration);
        }

        return $value;
    }/*}}}*/

    public static function kv_v($key, $value1, $value2, array $condition = [])
    {/*{{{*/
        $query = static::find()->select([$key, $value1, $value2]);

        if (!empty($condition)) {

            foreach ($condition as $property => $v) {

                if ( ! method_exists($query, $property))
                    throw new InvalidConfigException(" {$query::className()} does not has property: {$property}");
                $query->$property($v);
            }
        }
        $raws = $query->asArray()->all();
        $value = [];
        foreach($raws as $row) {
            $value[$row[$key]] = $row[$value1].'-'.$row[$value2];
        }

        return $value;
    }/*}}}*/
}
