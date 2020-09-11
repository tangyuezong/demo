<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * @param $type 1:短连接 2：长连接
 * @param $url 0.网址
 * Code:0：正常返回短网址,-1：短网址生成失败,-2：长网址不合法,-3：长网址存在安全隐患,-4：长网址插入数据库失败,-5：长网址在黑名单中，不允许注册;
 * ShortUrl:短网址
 * LongUrl:长网址（原网址）
 * ErrMsg:错误信息
 */
function baiduUrlAPI($type,$url){
    header("Content-type: text/html; charset=utf-8");
    if($type==1){
        $baseurl = "http://dwz.cn/admin/create";
        $param = ["url"=>$url];
    }else{
        $baseurl = "http://dwz.cn/admin/query";
        $param = ["shortUrl"=>$url];
    }
	//dump($baseurl);
    //dump($param);
    $ch = curl_init();
	//dump( $ch);
    curl_setopt($ch, CURLOPT_URL, $baseurl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ret = curl_exec($ch);//执行cURL会话
	dump($ret);
    $retInfo = curl_getinfo($ch); //获取cURL连接资源句柄的信息
    if($retInfo['http_code'] == 200){
        $data = json_decode($ret, true);
        if($data['Code'] != 0){
            //return json(['code'=>0,'msg'=>$data['ErrMsg']]);
            //return json();
            $result=['code'=>0,'msg'=>$data['ErrMsg']];
        }else{
            //return json(['code'=>1,'ShortUrl'=>$data['ShortUrl'],'LongUrl'=>$data['LongUrl'],'msg'=>$data['ErrMsg']]);
            $result=['code'=>1,'ShortUrl'=>$data['ShortUrl'],'LongUrl'=>$data['LongUrl'],'msg'=>$data['ErrMsg']];
        }
    }else{
        $result=['code'=>0,'msg'=>'获取失败'];
    }
    return $result;
}


























