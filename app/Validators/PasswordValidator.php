<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-12
 * Time: 16:13
 */

namespace App\Validators;

class PasswordValidator implements ValidatorInterface
{
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        // TODO: Implement validator() method.
        if (strlen($value) > 5 && strlen($value) < 21) {
            return true;
        }
        return false;
    }
}
