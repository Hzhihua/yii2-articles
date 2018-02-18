# 注意
> 单元测试会清空数据库，请建立一个新的测试数据库用于测试

# 配置数据库
> common/config/test-local.php

# 常用命令
@vendor 代表vendor目录路径
```php
@vendor/bin/codecept help
@vendor/bin/codecept run unit
@vendor/bin/codecept run unit ./
@vendor/bin/codecept run unit --debug # 打印codecept_debug()信息
@vendor/bin/codecept run unit --steps
```

# 参考
[codeception](https://codeception.com/for/yii)