<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/2/28
 * Time: 下午3:42
 */

return [
    'type_options' => array(
        'article' => '文章',
        'image' => '图片',
        'video' => '视频',
        'voice' => '声音'
    ),
    'state_options' => array(
        '0' => '等待审核',
        '1' => '可供阅读',
        '-1' => '审核不过'
    ),
    'post title required' => '文章标题不能为空',
    'post title must a string' => '文章标题必须是一个字符串',
    'post save success' => '文章保存成功',
    'post save failed' => '文章保存失败',
    'post update success' => '文章更新成功',
    'post delete success' => '文章删除成功',
    'the post has been deleted' => '文章未审核或已被删除'
];
