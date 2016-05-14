<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Log;

class WechatController extends Controller
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $wechat = app('wechat');
        $user = $wechat->user;
        $wechat->server->setMessageHandler(function ($message) use ($user) {
            switch ($message->MsgType) {
                case 'event':
                    if ($message->Event == 'subscribe') {
                        return '感谢你的订阅!!@#$%^&*';
                    }
                    # 事件消息...
                    break;
                case 'text':
                    # 文字消息...
                    $nickname = $user->get($message->FromUserName)->nickname;
                    return '我是小黄鸭，一直再重复！！！' . $message->Content . '!!!我的昵称是：' . $nickname;
                    break;
                case 'image':
                    # 图片消息...
                    return '你发的图片地址：' . $message->PicUrl;
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                case 'video':
                    # 视频消息...
                    break;
                case 'location':
                    # 坐标消息...
                    break;
                case 'link':
                    # 链接消息...
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}