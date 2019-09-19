<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ResponseModel extends Model
{
    public static function success($statusCode=200, $desc=null, $data=null)
    {
        if (($statusCode>=1000)) {
            $statusCode=200;
        }
        $output=[
             'ret' => $statusCode,
            'desc' => is_null($desc) ? 'Successful!' : $desc,
            'data' => $data
        ];
        return response()->json($output);
    }

    public static function err($statusCode, $desc=null, $data=null)
    {
        if (($statusCode<1000)) {
            $statusCode=1000;
        }
        $output=[
             'ret' => $statusCode,
            'desc' => is_null($desc) ? self::desc($statusCode) : $desc,
            'data' => $data
        ];
        return response()->json($output);
    }

    private static function desc($errCode)
    {
        $errDesc=[
            '1000' => "Unspecified Error",  /** Under normal condictions those errors shouldn't displayed to end users unless they attempt to do so
                                             *  some submissions should be intercepted by the frontend before the request sended
                                             */
            '1001' => "Internal Sever Error : SECURE_VALUE 非法",
            '1002' => "内部服务器错误：操作失败",
            '1003' => "内部服务器错误：参数不全",
            '1004' => "内部服务器错误：参数非法",
            '1005' => "内部服务器错误：文件类型不被支持",
            '1006' => "内部服务器错误：输入过长",

            '2000' => "Account-Related Error",

            '2001' => "请先登录",
            '2002' => "未找到该用户",
            '2003' => "您的权限不足",
            '2004' => "用户名或密码错误",
            '2005' => "用户重复授权",
            '2006' => "无法撤销自己授权",
            '2007' => "激活邮件发送过于频繁",
            '2008' => "请不要皮这个系统",
            '2009' => "密码错误",
            '2010' => "请设置6位以上100位以下密码，只能包含字母、数字及下划线",
            '2011' => "密码两次输入不一致",
            '2012' => "密码至少为8个字符",

            '3000' => "Course-Related Error",

            '3001' => "请先注册本课程",
            '3002' => "课程未找到",
            '3003' => "课时未找到",
            '3004' => "作业未找到",
            '3005' => "乔波",  // Reserved for Copper in memory of OASIS and those who contributed a lot
            '3006' => "作业已截止提交",

            '4000' => "Contest-Related Error",

            '4001' => "学号已经被注册",
            '4002' => "队名已经被注册",
            '4003' => "学号重复",
            '4004' => "请填写所有应填项",
            '4005' => "数字格式不正确",
            '4006' => "邮箱格式不正确",

            '5000' => "Organization-Related Error",

            '5001' => "未找到该组织",
            '5002' => "未找到该部门",
            '5003' => "该部门不属于该组织",

            '6000' => "找不到该报销记录",
            '6001' => "200元以上的交易必须上传交易凭证",
            '6002' => "500元以上的交易必须上传申报单",
            '6003' => "电子发票必须是pdf文件",
            '6004' => "交易凭证必须是清晰的jpg或者png文件",
            '6005' => "申报单必须是docx文件",

            '7000' => "Handling-Related Error",

            '7001' => "请填写物品名称",
            '7002' => "找不到该物品",
            '7003' => "物品已下架",
            '7004' => "请填写物品位置",
            '7005' => "请填写物品描述",
            '7006' => "请填写物品数量",
            '7007' => "物品已上架",
        ];
        return isset($errDesc[$errCode]) ? $errDesc[$errCode] : $errDesc['1000'];
    }
}
