<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-21
 * Time: 14:51
 */

namespace App\Validators;

class UserNameValidator implements ValidatorInterface
{
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        // TODO: Implement validate() method.
        if (strlen($value) > 2 && strlen($value) < 20) {
            return true;
        }
        return false;
    }
}
