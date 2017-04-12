<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.01.2017
 * Time: 19:23
 */

namespace app;
require_once "/vendor/traits/ValidationMethods.php";

class Validator
{
    use \ValidationMethods;
    protected function rules()
    {

        return [];
    }

    public function validate($array)
    {
        $rules = $this->rules();
        foreach ($rules as $val) {
            if (method_exists($this, $val[1])) {
                if (is_array($val[0])) {
                    foreach ($val[0] as $value) {
                        if (!$this->$val[1]($array[$value], $val['message'])) {
                            return false;
                        }
                    }
                } else {
                    if (!$this->$val[1]($array[$val[0]], $val['message'])) {
                        echo "false";
                        return false;
                    }
                }
            }
        }
        return true;

    }
}