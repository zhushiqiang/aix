<h1 align="center"> aix-api </h1>

<p align="center"> 基于信产教育第三方应用接口的组件</p>


## Installing

```shell
$ composer require xinchan/aix
```

## 配置

在 .env 中配置 AIX-URL（接口URL地址，测试为https://aiapi-dev.xinchanedu.com/） ：

```php
AIX-URL=xxxxxxxxxxxxxxxxxxxxx
```

## 如何使用

```php

//引入
use Xinchan\Aix\AccessToken;
use Xinchan\Aix\Company;

//参数为client_id和client_secret
$obj = new AccessToken('xxxxx', 'xxxxxxxxxx');
//获取access_token
$obj->getToken()

//创建商家

$array = [
            'fullname' => '测试商家3',
            'nickname' => '测试商家3',
            'qywx_qrcode' => 'https://img.cdn.xinchanedu.com/uploadImg/admin_ai/2018/Nov/6ab57dcc-e9d5-11e8-9fe4-0242246ab6bc.png',
            'contact' => '商家3',
            'phone' => '18931845552',
            'description' => '测试商家而已3',
            'address' => '测试商家地址3',
        ];
$company->create($array)

//更新商家信息 第一个参数为创建商家时返回的uuid

$company->update('uuid', $array)

//商家详情
$company->detail('uuid')

//商家 企业微信授权 第二个参数为授权类型 1为AI情报官 2为AIBoss
$company->authorization('uuid', 1));
 
//商家同步员工
$company->synchronousWxDepAndPerson('uuid')

//商家部门列表 参数2 为部门id 默认为1为全部
$company->departmentList('uuid', '1'));

//添加部门
$company->department('uuid', 1, '测试部门2332'));

//添加话术

$reply = [
    'reply_group_id' => 0,
    'content' => '您还在吗',
    'keywords' => ''
];
$company->replyCreate('uuid', $reply));
        
//话术列表
$company->replyList('uuid', '分页id', '分组id'));

//删除话术
$company->replyDelete('uuid', 话术id)

//雷达权限 与boss权限开启or关闭

$company->modify_radar('uuid', ‘ids 员工id’, 'status 状态', 'type 类型')
```