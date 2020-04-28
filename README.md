# luke/uc-sdk
禄可统一认证中心

## 安装

`composer require luke/uc-sdk -vvv`

## 使用

```php
$uc = new \Luke\Uc\Application([
    'base_url' => 'http://127.0.0.1:8001',
    'app_id' => 'test',
    'secret' => 'test'
]);

// 发送短信验证码
$response = $uc->sms->sendCode('10000000000', 'register');



```