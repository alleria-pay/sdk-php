<?php
/**
 * Created by PhpStorm.
 * Date: 2017/8/1
 * Time: 12:44
 */

namespace alleria\test;

include_once '../../../libs/httpful.phar';
include_once '../util/CryptoUtil.php';

include_once "../pay/Pay.php";
include_once "../pay/PayRequest.php";
include_once "../pay/ConfirmRequest.php";
include_once "../pay/ChannelExtra.php";
include_once "../AppRequest.php";
include_once "../Sdk.php";
///

use PHPUnit\Framework\TestCase;


class SdkTest extends TestCase
{
    private $sdk;
    private $baseUrl = "替换为测试资料中的url";
    private $appId = '替换为测试资料中的AppId';

    public function __construct()
    {
        if(!$this->sdk){
            $appId = $this->appId;
            $baseUrl = $this->baseUrl;
            $sdk = new \alleria\Sdk();
            //私钥路径
            $sdk->setPrivateKey(\alleria\util\CryptoUtil::getPrivateKey('/私钥路径/私钥文件名.pem'));
            //公钥路径
            $sdk->setPublicKey(\alleria\util\CryptoUtil::getPublicKey('/公钥路径/公钥文件名.pem'));
            //api请求地址
            $sdk->setBaseUrl($baseUrl);
            //appId
            $sdk->setAppId($appId);
            $this->sdk = $sdk;
        }
    }

    public function testCreatePay(){

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

        $r = $this->sdk->pay()->create($request);
        var_dump($r);

    }

    public function testConfirmPay(){

        $request = new \alleria\pay\ConfirmRequest();
        $request->setOrderNo(348318168287727962);
        $request->setMerchantOrderNo("1501468474670181009");
        $request->setSmsCode("123456");
        $request->setPassword("123456");

        $r = $this->sdk->pay()->confirm($request);
        var_dump($r);

    }

    public function testQueryOrder(){

        $request = new \alleria\pay\ConfirmRequest();
        $request->setOrderNo(348318168287727962);
        $request->setMerchantOrderNo("1501468474670181009");

        $r = $this->sdk->pay()->query($request);
        var_dump($r);

    }



}