<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-5 16:41
 * @Github: https://github.com/Hzhihua
 */

require __DIR__ . '/../../../../common/config/bootstrap.php';
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../../../backend/config/test-local.php',
    []
);
