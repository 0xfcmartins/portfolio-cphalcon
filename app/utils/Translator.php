<?php

/** @noinspection PhpIncludeInspection */

namespace Fcmartins\Utils;

use Exception;
use Phalcon\Config;
use Phalcon\Di\Injectable;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;

/**
 *
 * @property Config $translation Translation file
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-01-20 23:8
 */
class Translator extends Injectable
{
    protected object $lang;
    protected $translation;

    private function getUserServerLang()
    {
        try {
            return explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];
        } catch (Exception $e) {
            return "";
        }
    }

    public function __construct()
    {
        $file = APP_PATH . 'app/lang/' . $this->getUserServerLang() . '.php';

        if (file_exists($file)) $this->translation = require $file;
        else $this->translation = require '../app/lang/pt-PT.php';

        $interpolator = new InterpolatorFactory();

        $this->lang = (object)array();
        foreach ($this->translation as $type => $value)
            $this->lang->$type = new NativeArray($interpolator, ['content' => $value->toArray()]);
    }

    public function getMessage($key): string
    {
        try {
            if ($this->lang->messages->exists($key))
                return $this->lang->messages->_($key);
            else
                return $key;
        } catch (Exception $e) {
            return $key;
        }
    }

    public function getPopupMessage($key): string
    {
        try {
            if ($this->lang->popups->exists($key))
                return $this->lang->popups->_($key);
            else
                return $key;
        } catch (Exception $e) {
            return $key;
        }
    }

    public function getPlaceHolder($key): string
    {
        try {
            if ($this->lang->placeholders->exists($key))
                return $this->lang->placeholders->_($key);
            else
                return $key;
        } catch (Exception $e) {
            return $key;
        }
    }

    public function getValidation($key): string
    {
        try {
            if ($this->lang->validations->exists($key))
                return $this->lang->validations->_($key);
            else
                return $key;
        } catch (Exception $e) {
            return $key;
        }
    }

    public function getConfig($key): string
    {
        try {
            if ($this->lang->config->exists($key))
                return $this->lang->config->_($key);
            else
                return $key;
        } catch (Exception $e) {
            return $key;
        }
    }

}