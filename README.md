# php sdk

## 使用简介

建议使用php 5.4+版本

libs下为引用的httpful库

示例文件见`src\alleria\test\SdkTest.php`

## 接入说明

### 初始化

```
$sdk = new \alleria\Sdk();
//私钥路径
$sdk->setPrivateKey(\alleria\util\CryptoUtil::getPrivateKey('/私钥路径/私钥文件名.pem'));
//公钥路径
$sdk->setPublicKey(\alleria\util\CryptoUtil::getPublicKey('/公钥路径/公钥文件名.pem'));
//api请求地址
$sdk->setBaseUrl("平台Api地址");
//appId
$sdk->setAppId("商户AppId");
```

### 发起交易

```
$request = new \alleria\pay\PayRequest();
$request->setMerchantId(10011123483);
$request->setOrderNo("7897897896767867868");
$request->setChannel("express_t1");
$request->setSubject("测试订单");
$request->setDesc("测试描述");
$request->setAmount(1060);
$request->setClientIp("127.0.0.1");
$extra = new \alleria\pay\ChannelExtra();
$extra->setName("张三");
$extra->setPhone("18671040587");
$extra->setIdCard("130201199006100428");
$extra->setBankCard("6268092397218372");
$extra->setExpirationDate("0422");
$extra->setCvn2("187");
$request->setExtra($extra);

$resp = $this->sdk->pay()->create($request);
```

### 交易确认

`快捷支付时需要发送短信验证码进行确认`

```
$request = new \alleria\pay\ConfirmRequest();
$request->setOrderNo(348318168287727962);
$request->setMerchantOrderNo("1501468474670181009");
$request->setSmsCode("123456");
$request->setPassword("123456");

$resp = $this->sdk->pay()->confirm($request);
```

### 交易订单查询

```
$request = new \alleria\pay\ConfirmRequest();
$request->setOrderNo(348318168287727962);
$request->setMerchantOrderNo("1501468474670181009");

$resp = $this->sdk->pay()->query($request);
```
