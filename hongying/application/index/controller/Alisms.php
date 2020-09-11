<?php
namespace app\index\controller;

use think\Controller;
require_once '../extend/alisms/vendor/autoload.php';

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 加载区域结点配置
Config::load();

/**
 * Class SmsDemo
 *
 * 这是短信服务API产品的DEMO程序，直接执行此文件即可体验短信服务产品API功能
 * (只需要将AK替换成开通了云通信-短信服务产品功能的AK即可)
 * 备注:Demo工程编码采用UTF-8
 */
class Alisms
{

    static $acsClient = null;

    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public static function getAcsClient() {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
        $accessKeyId = "LTAI6PyOEFe8eHsv"; // AccessKeyId  (这里需要填写)

        $accessKeySecret = "0dHbGP7cngf2Q0El5cYvUJOAPwA6rT"; // AccessKeySecret (这里需要填写)

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";


        if(static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }

    /**
     * 发送短信
     * @return stdClass
     */
    public static function sendSms($mobile='') {


        //检测手机是否存在
        $userselect=db('Member')->where('mobile',$mobile)->find();
        //dump($userselect);die;
        if ($userselect != NUll){
            //$this->error('Sorry! The mailbox already exists');
            $msg=['status'=>1,'msg'=>'该手机号已经存在'];
            return json($msg);
        }

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        //可选-启用https协议
        //$request->setProtocol("https");

        $mobile=input('mobile');

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName("唐跃宗");

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode("SMS_140595071");

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $code=mt_rand(10000,99999);

        //session('checkcode',$code);

        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code"=>$code,
            
        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        //$request->setOutId("yourOutId");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        //$request->setSmsUpExtendCode("1234567");

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        if($acsResponse->Code == 'OK') {
            session('mobileCode',$code);
            session('mobileUser',$mobile);
            $msg=['status'=>0,'msg'=>'短信发送成功'];
            return json($msg);

        }else{
            $msg=['status'=>1,'msg'=>'短信发送失败'];
            return json($msg);
        }
        //return $acsResponse;

    }

}

// 调用示例：
//set_time_limit(0);
//header('Content-Type: text/plain; charset=utf-8');
//
//$response = SmsDemo::sendSms();
//echo "发送短信(sendSms)接口返回的结果:\n";
//print_r($response);
//
//sleep(2);
//
//$response = SmsDemo::sendBatchSms();
//echo "批量发送短信(sendBatchSms)接口返回的结果:\n";
//print_r($response);
//
//sleep(2);
//
//$response = SmsDemo::querySendDetails();
//echo "查询短信发送情况(querySendDetails)接口返回的结果:\n";
//print_r($response);
