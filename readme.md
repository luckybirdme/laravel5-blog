##laravel5-blog##

最近学习laravel框架，以此搭建了简单的博客！
演示地址：[Demo](http://laravel.luckybird.me)

**功能介绍**

* 用户注册、登录、忘记密码，支持多用户；
* 用户创建文章、分类、标签，以及评论文章

**前端使用组件**

1. 使用markdown编辑器，实时预览，支持图片上传；
2. 使用jquerytagit标签，输入即可创建，包含自动搜索；
3. 全站使用pjax提交请求，局部刷新，提升加载速度；

**后端使用类库**

> markdown to html 使用 [michelf/php-markdown](https://github.com/michelf/php-markdown)；

> html to markdown 使用 [league/html-to-markdown](https://github.com/thephpleague/html-to-markdown)；

> 表单输入过滤使用 [mews/purifier](https://github.com/mewebstudio/Purifier)；

> 图片处理使用 [intervention/image](https://github.com/Intervention/image)；

> pjax 请求响应使用 [jacobbennett/pjax](https://github.com/JacobBennett/pjax)；



##安装方法##

**下载源码**
```
git clone https://github.com/luckybirdme/laravel5-blog.git

```

**加载类库**
```
composer install
```

**新建数据库表**
```
php artisan migrate
```
**修改配置文件(.env)**
```

DB_HOST=localhost
DB_DATABASE=laravel
DB_USERNAME=mysql
DB_PASSWORD=123456

```

##备注##

* 如果对本项目有疑问，可查看我的学习记录，博客地址：[luckybird](http://www.luckybird.me)
