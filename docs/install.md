## 安装 laravel

### 安装composer 略
### 全局安装 laravel
```
	composer global require "laravel/installer"
```

### 将laravel 设置为环境变量

```
	export PATH = ~/.composer/vendor/bin:$PATH
```

### 安装laravel

前往web目录,进行安装

cd /www
laravel new lwork.app

### 设置目录权限

 chown -R nosun.www-data lwork.app
 chmod -R 777 lwork.app/storage
 chmod -R 777 lwork.app/bootstrap/cache

### 生成app key
If the application key is not set, your user sessions and other encrypted data will not be secure!
```
	php artisan key:generate
```

### 配置项目
配置文件位于 /config/app.php
```
    timezone：PRC
    cache:file
    session:file
    database:lwork
    locate:en
    url:lwork.app
```

### 配置nginx
```
server {
    listen       80;
    server_name  lwork.app;
    index index.html index.htm index.php;
    root  /data/www/lwork.app/public;

    rewrite_log on;
    error_log /data/logs/nginx/lwrok_nginx_error.log info;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php($|/) {
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
```

### 修改hosts表
```
	vi /etc/hosts
	add 127.0.0.1 lwork.app
```

### 修改composer.json

在require 部分，增加
```
   "zizaco/entrust": "dev-laravel-5",
   "predis/predis": "~1.0",
   "barryvdh/laravel-ide-helper": "~2.0"
```

### 安装依赖

```
composer update

```

### 安装必要的类库

#### debugbar

```
composer require barryvdh/laravel-debugbar
```

增加配置文件

debugbar是官方推出的debug工具条，便于开发调试使用
github地址：https://github.com/barryvdh/laravel-debugbar
```
php artisan vendor:publish
```

vi config/debugbar.php && set enabled => ture

vi config/app.php && add below to providers

```
Barryvdh\Debugbar\ServiceProvider::class,
```

If you want to use the facade to log messages, add this to your facades in app.php:

```
'Debugbar' => Barryvdh\Debugbar\Facade::class,
```

#### entrust
entrust 是第三方提供的用户，角色，权限系统，非常适合后台的用户，权限，角色的设定
github地址：https://github.com/Zizaco/entrust

> issue： 因为安装的是laravel 5.2 entrust的默认版本有问题，暂时安装的是一个分支版本。


添加 service provider && facade
```
php artisan vendor:publish
```

#### ide helper

entrust 是官方提供的php helper https://github.com/barryvdh/laravel-ide-helper
github地址：https://github.com/Zizaco/entrust
增加 to service provider
```
Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
```
生成 helper 文件

php artisan ide-helper:generate

增加自动生成

You can configure your composer.json to do this after each commit:
```
"scripts":{
    "post-update-cmd": [
        "php artisan clear-compiled",
        "php artisan ide-helper:generate",
        "php artisan optimize"
    ]
},
```

#### 文档生成工具
```
composer require doctrine/dbal
```
### 安装 ace template

将 ace template 文件夹 拷贝到 public 目录下

### 管理后台 数据库安装
```
artisan entrust:migration
```
```
artisan migrate:install
artisan migrate
```

### 管理后台 model
```
artisan make:model Role
artisan make:model Permission
```

分别设置 user,permission,role model

> 参考：https://github.com/Zizaco/entrust Model 小节

