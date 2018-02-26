# Yii2-articles module

## 安装
```php
php composer.phar require hzhihua/yii2-articles
php composer.phar migrate --migrationPath=@vendor/hzhihua/yii2-articles/migration
```

## 简单使用
```php
'articles' => [
    'class' => 'hzhihua\articles\Module',
 ],
```

## 访问
> www.yourweb.com/artilces/article/index  
> or  
> www.yourweb.com?r=artilces/article/index

## 详细配置
> [@see Module.php](Module.php)