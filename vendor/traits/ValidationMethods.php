<?php

trait ValidationMethods
{
    public $errors;



    protected function numeric($array, $message)
    {
        if (is_array($array)) {
            foreach ($array as $value) {
                if (!is_numeric($value) && $value > 2) {
                    $this->errors[] = $message;
                    return false;
                }
            }
        } else {
            if (!is_numeric($array)) {
                $this->errors[] = $message;
                return false;
            }
        }

        return true;
    }

    public function required($value, $message)
    {
        if ($value == "") {
            $this->errors[] = $message;
            return false;
        } else {
            return true;
        }
    }

    protected function date($value, $message)
    {
        $array = explode('-', $value);
        if (!count($array) != 3 && !@checkdate($array[2], $array[1], $array[0])) {
            $this->errors[] = $message;
            return false;
        }
        return true;
    }


}