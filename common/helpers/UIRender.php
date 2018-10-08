<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 26.09.2018
 * Time: 2:58
 */

namespace common\helpers;


use yii\helpers\Json;

class UIRender
{

    private $errors = [];
    private $error = false;
    private $successRedirect = '/';
    private $message = '';
    private $needRedirect = false;
    private $entityId = null;


    /**
     * UIRender constructor.
     * @param bool $needRedirect
     * @param string $successRedirect
     */
    public function __construct($needRedirect = false, $successRedirect = '/')
    {
        $this->successRedirect = $successRedirect;
        $this->needRedirect = $needRedirect;
    }


    /**
     * @param $message
     * @param $block
     * @return self
     */
    public function addError($message, $block = 'main')
    {
        $this->errors[$block][] = $message;
        $this->error = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->entityId = $id;
        return $this;
    }

    /**
     * @param string $text
     */
    public function showMessage($text)
    {
        $this->message = $text;
    }

    /**
     * @return string
     */
    public function run()
    {
        $result = [
            'status' => $this->error ? 'error' : 'ok',
            'message' => $this->message,
            'needRedirect' => !$this->error ? $this->needRedirect : false,
            'redirect' => $this->successRedirect,
            'errors' => $this->errors,
            'entityId' => $this->entityId ?? 0,
        ];

        return Json::encode($result);
    }
}