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
 * Time: 15:59
 */

namespace App\Validators;

class PhoneValidaotr implements ValidatorInterface
{
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        // TODO: Implement validator() method.
        return preg_match('/^1[3|4|5|6|7|8|9]\d{9}$/', $value);
    }
}
