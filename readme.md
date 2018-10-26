# 点餐系统

## 项目介绍

整个系统分为三个不同的网站，分别是 

- 平台：网站管理者 
- 商户：入住平台的餐馆 
- 用户：订餐的用户

## Day01

### 开发任务

#### 平台端 

- 商家分类管理 
- 商家管理 
- 商家审核

#### 商户端 

- 商家注册

#### 要求 

- 商家注册时，同步填写商家信息，商家账号和密码 
- 商家注册后，需要平台审核通过，账号才能使用 
- 平台可以直接添加商家信息和账户，默认已审核通过

## 步骤

1.下载laravel到项目目录

2.在项目public目录下创建虚拟主机 绑定三个域名：

shop.mt.com  商家后台

admin.mt.com 管理大后台

user.mt.com 用户后台

3.把laravel扩展装上

4.建立数据库 mt

5.数据迁移

6.设置三个平台：前端    商家后台   大后台

7.设置视图分类：前端    商家后台   大后台

8.设置路由：前端    商家后台   大后台

9.项目开始

## day_1

### 商家后台

#### 商家用户

1.编辑个人资料

2.登录

3.注销

4.修改密码

#### 商铺

1.添加商铺

1.2有商铺的不能添加

2.编辑商铺

3.自己商铺列表

4.没有通过审核的不能登录后台

## day_2

### 大平台

#### 商家分类管理

1.添加分类

2.删除分类

3.显示分类

4.编辑分类

#### 商家用户管理

1.后台添加商户

2.后台编辑商户

​	2.1密码重置

​	2.2审核

3.后台显示所有商户

4.后台删除商户

​	4.1删除商户会一同删除商铺

#### 管理员账户管理

1.添加管理员

2.编辑管理员

​	2.1密码重置

3.删除管理员

4.显示管理员列表

5.管理员登录

6.管理员注销

#### 商铺管理

1.添加商铺

2.编辑商铺

​	2.1审核

​	2.2信息修改

3.删除商铺

4.显示所有商铺

## day_3

### 商家后台

#### 菜品分类

1. 一个商户只能有且仅有一个默认菜品分类 
2. 只能删除空菜品分类
3. 必须登录才能管理商户后台
4. 按菜品分类显示该分类下的菜品列表
5. 根据条件（按菜品名称和价格区间）搜索菜品

#### 菜品

1.添加菜品

2.编辑菜品

3.删除菜品

4.查看菜品

5.上架/下架











