<?php

namespace app\traits;

/**
 * ErrorsMessageTrait class file.
 * 适用对象必须为 Model
 * @Author haoliang
 * @Date 07.07.2015 14:45
 */
trait ErrorsMessageTrait
{

    /**
     * @brief 获取字串格式的错误信息
     *
     * @param $errors
     *
     * @return string
     */
    public function getErrorsMessage(array $errors = [])
    {/*{{{*/

        if (empty($errors)) {

            if (!$this->hasErrors()) return '';

            $errors = $this->getErrors();
        }

        $message = '';

        foreach ($errors as $error) {
            $message .= implode(',', $error) . '; ';
        }

        return $message;
    }/*}}}*/

}
