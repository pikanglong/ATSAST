@extends('layouts.app')

@section('template')

<style>
    logs{
        display: block;
        padding:0 1rem;
    }

    version {
        display: block;
        padding: 3em 2em 2em;
        position: relative;
        color: rgba(0, 0, 0, 0.7);
        border-left: 0.1rem solid rgba(0, 0, 0, 0.3);
    }

    version p {
        font-size: 1rem;
    }

    version::before {
        content: attr(data-date);
        position: absolute;
        left: 2rem;
        font-weight: bold;
        top: 1rem;
        display: block;
        font-family: 'Roboto', sans-serif;
        font-weight: 700;
        font-size: .785rem;
        line-height: 1rem;
    }

    version::after {
        width: 1rem;
        height: 1rem;
        display: block;
        top: 1rem;
        position: absolute;
        left: -0.55rem;
        border-radius: 10px;
        content: '';
        border: 0.1rem solid rgba(0, 0, 0, 0.3);
        background: white;
    }

    version[data-version="major"]::after {
        transform: scale(1.5);
    }

    version:last-child {
        border-image-source: linear-gradient(rgba(0, 0, 0, 0.3) 60%, rgba(0, 0, 0, 0));
        border-image-slice: 1 0 0 100%;
        border-image-outset: 0;
        border-image-repeat: stretch;
        border-image-width: 0.1rem;
    }

    /* Card Component */

    card {
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        padding-top: 3rem;
        padding-bottom: 2rem;
        padding-right: 2rem;
        padding-left: 2rem;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
    }

    card>tag {
        position: absolute;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        /* box-shadow: 0 10px 6px -6px #777; */
        color: #fff;
        display: block;
        font-size: 1rem;
        line-height: 2rem;
        height: 2rem;
        top: -1rem;
        left: 2rem;
        padding: 0 1rem;
        border-radius: 2px;
        font-family: "华文中宋",Roboto,Helvetica,Arial,sans-serif;
    }

    .tag-release {
        background: #32af24;
    }

    card>theme {
        display: block;
        font-size: 2rem;
        color: #7a8e97;
        font-weight: 900;
        margin: 0;
        font-family: "华文中宋",consolas,monospace;
    }

    card>sub-theme {
        display: block;
        font-size: 1rem;
        color: #c2c0c2;
        font-weight: normal;
        margin: 0;
        font-family: "华文中宋",consolas,monospace;
    }

    .atsast-card-release{
        margin-bottom: 0;
        background:transparent;
    }

    .atsast-card-release img-container {
        display: block;
        position: absolute;
        right: 0;
        left: 0;
        bottom: 0;
        top: 0;
        overflow: hidden;
        z-index: -1;
        background: #fff;
    }

    .atsast-card-release img-container i {
        position: absolute;
        right: -2rem;
        bottom: -3rem;
        font-size: 15rem;
        display: block;
        line-height: 1;
        color:rgba(50, 175, 36,0.5);
    }

    card info {
        margin-top: 1rem;
        font-size: 1rem;
        display: inline-block;
        padding-right: 1.5rem;
    }

    card info i {
        display: inline-block;
        transform: scale(1.2);
        padding-right: 0.5rem;
    }

    card:hover {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 40px;
    }
</style>
<div class="container mundb-standard-container">
    <section class="mb-5">
        <card class="atsast-card-release">
            <tag class="tag-release">当前版本</tag>
            <theme id="version">{{version()}}</theme>
            <sub-theme id="subversion">开发版</sub-theme>
            <img-container>
                <i class="MDI check-circle-outline"></i>
            </img-container>
        </card>
        <logs>
            <version data-date='2019-01-28' data-version="sub">
                <h1>1.1.3 Stable</h1>
                <p>
                    功能性的更新<br>
                </p>
            </version>
            <version data-date='2018-12-7' data-version="sub">
                <h1>1.1.2 Stable</h1>
                <p>
                    修复了找回密码及激活邮件发送在主域名下异常的问题<br>其他功能性的更新<br>
                </p>
            </version>
            <version data-date='2018-12-5' data-version="sub">
                <h1>1.1.1 Stable</h1>
                <p>
                    修复了一个1.1.0造成的Markdown渲染问题<br>修复了多个早期版本对于Markdown渲染的污染问题<br>更新了代码高亮的渲染方式<br>其他功能性的更新<br>
                </p>
            </version>
            <version data-date='2018-12-5' data-version="major">
                <h1>1.1.0 Stable</h1>
                <p>
                    增加了多处对可视化Markdown的预览支持<br>修复了早期版本对于Markdown可能的一些污染问题<br>其他功能性的更新<br>
                </p>
            </version>
            <version data-date='2018-12-4' data-version="sub">
                <h1>1.0.2 Stable</h1>
                <p>
                    现在ATSAST作业功能增加了对可视化Markdown的支持<br>其他功能性的更新<br>
                </p>
            </version>
            <version data-date='2018-12-3' data-version="sub">
                <h1>1.0.1 Stable</h1>
                <p>
                    PasteBin现在支持过期清理啦<br>其他功能性的更新<br>
                </p>
            </version>
            <version data-date='2018-12-1' data-version="major">
                <h1>1.0.0 Stable</h1>
                <p>
                    我们新增了PasteBin，这是全新的功能<br>我们提供了更加细致化的课程管理工具<br>修复了作业提交不了的BUG<br>我们将不会在后续版本日志中使用“修复巨量BUG”<br>
                </p>
            </version>
            <version data-date='2018-11-17' data-version="sub">
                <h1>0.9.7 Pre-Release</h1>
                <p>
                    我们新增了验证邮箱与修改密码的功能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-17' data-version="sub">
                <h1>0.9.6 Pre-Release</h1>
                <p>
                    我们新增了SAST课表工具<br>移除了某个影响系统性能的feature<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-17' data-version="sub">
                <h1>0.9.5 Pre-Release</h1>
                <p>
                    我们修正了邮件库多处代码，现在重置密码变成了可能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-12' data-version="sub">
                <h1>0.9.4 Pre-Release</h1>
                <p>
                    我们为登录增加了提示<br>我们修正了逻辑的一些问题<br>我们修改了核心库<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-11' data-version="sub">
                <h1>0.9.3 Pre-Release</h1>
                <p>
                    我们迁移了服务器到新加坡<br>我们上线了安全检查功能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-09' data-version="sub">
                <h1>0.9.2 Pre-Release</h1>
                <p>
                    现在我们使用了canvas背景来提升<s>逼格</s>用户体验<br>我们修复了登录注册还有反代链接处理的一些BUG<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-09' data-version="sub">
                <h1>0.9.1 Pre-Release</h1>
                <p>
                    我们上线用户卡片<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-08' data-version="major">
                <h1>0.9.0 Pre-Release</h1>
                <p>
                    我们上线了分页<br>我们还增加了报名相关的一些处理，包括管理中心许多新的工具<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-08' data-version="sub">
                <h1>0.8.1 Pre-Release</h1>
                <p>
                    我们上线了新增课程和其他的系统工具<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-07' data-version="major">
                <h1>0.8.0 Pre-Release</h1>
                <p>
                    现在管理后台作业编辑功能已经上线<br>我们上线了系统情况分析和其他的系统工具<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-07' data-version="sub">
                <h1>0.7.4 Beta</h1>
                <p>
                    现在已经支持添加讲师权限了<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-06' data-version="sub">
                <h1>0.7.3 Beta</h1>
                <p>
                    现在已经支持创建课时了，讲师权限仍然需要手动添加<br>修复了API的一个回显BUG<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-06' data-version="sub">
                <h1>0.7.2 Beta</h1>
                <p>
                    管理后台新增管理员工具<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-06' data-version="sub">
                <h1>0.7.1 Beta</h1>
                <p>
                    管理后台除作业编辑功能外均已完成，准备发布完整版管理后台<br>现在课程的讲师权限仍然需要手动添加<br>现在仍然没有新建课时功能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-05' data-version="major">
                <h1>0.7.0 Beta</h1>
                <p>
                    管理后台新增了授课笔记编辑、签到管理功能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-11-05' data-version="sub">
                <h1>0.6.4 Beta</h1>
                <p>
                    新增课程后台签到查看<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-11-04' data-version="sub">
                <h1>0.6.3 Beta</h1>
                <p>
                    新增校园网部署服务<br>为新生杯提供登录接口支持<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-11-04' data-version="sub">
                <h1>0.6.2 Beta</h1>
                <p>
                    新增管理活动功能<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-11-04' data-version="sub">
                <h1>0.6.1 Beta</h1>
                <p>
                    现在我们修复了反代的一些问题<br>现在我们修复了签到的一个问题<br>现在我们修复了注册设置密码的一个问题<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-11-02' data-version="major">
                <h1>0.6.0 Beta</h1>
                <p>
                    视频功能、课堂反馈正式上线<br>现在我们修复了一些页面重复提交的BUG<br>解决了找回密码的多个问题<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-10-31' data-version="sub">
                <h1>0.5.6 Beta</h1>
                <p>
                    找回密码功能正式上线<br>现在我们修复了一些UI不统一的BUG<br>解决了登录的一个问题<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-10-31' data-version="sub">
                <h1>0.5.5 Beta</h1>
                <p>
                    新增找回密码功能<br>修复了一些手机无法报名的BUG<br>修复巨量BUG<br>
                </p>
            </version> 
            <version data-date='2018-10-31' data-version="sub">
                <h1>0.5.4 Beta</h1>
                <p>
                    新增邮件激活功能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-30' data-version="sub">
                <h1>0.5.3 Beta</h1>
                <p>
                    UI修复<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-30' data-version="sub">
                <h1>0.5.2 Beta</h1>
                <p>
                    新增邮件认证功能<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-30' data-version="sub">
                <h1>0.5.1 Beta</h1>
                <p>
                    增加更多人性化提示<br>修复巨量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-29' data-version="major">
                <h1>0.5.0 Beta</h1>
                <p>
                    优化了赛事（团体）模块<br>修正了多个团体报名及个人报名的BUG<br>活动的报名修改等权限更加细分<br>我们将不会在后续版本日志中使用“修复大量BUG”<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-29' data-version="major">
                <h1>0.4.0 Beta</h1>
                <p>
                    增加了赛事（团体）模块<br>针对404页面的UI做出了较大调整<br>现在可以在个人中心查看报名的活动了<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-29' data-version="sub">
                <h1>0.3.1 Beta</h1>
                <p>
                    新增云存储空间<br>修复了报名的一个BUG<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-28' data-version="major">
                <h1>0.3.0 Beta</h1>
                <p>
                    增加了赛事报名模块<br>针对UI做出了较大调整<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-27' data-version="sub">
                <h1>0.2.3 Beta</h1>
                <p>
                    增加了管理员后台<br>现在讲师可以批改作业了<br>针对UI做出了一些调整<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-26' data-version="sub">
                <h1>0.2.2 Beta</h1>
                <p>
                    增加了文件上传功能，现在作业布置可以上传文档了<br>图片上传及文件上出修复了一些安全性及应用性BUG<br>针对UI做出了一些调整<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-26' data-version="sub">
                <h1>0.2.1 Beta</h1>
                <p>
                    增加了设置中心，现在用户可以上传头像等等啦<br>后端修复了一个安全性BUG<br>现在后端使用ERR类来处理错误了<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-25' data-version="major">
                <h1>0.2.0 Beta</h1>
                <p>
                    增加了对Markdown的支持，现在大纲和作业布置都可以使用Markdown了<br>修复了手机端不能报名的问题<br>将所有站外资源移至static.1cf.co<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-25' data-version="sub">
                <h1>0.1.6 Beta</h1>
                <p>
                    修改了作业布置逻辑，现在支持多作业了<br>修复了Monaco Editor的Worker的一些问题<br>修复大量BUG<br>
                </p>
            </version>
            <version data-date='2018-10-25' data-version="sub">
                <h1>0.1.5 Beta</h1>
                <p>
                    新增全套Material色盘(Credit WEMD)<br>新增BUG汇报及版本日志功能<br>修复大量BUG<br>
                </p>
            </version>

            <version data-date='2018-10-23' data-version="sub">
                <h1>0.1.4 Beta</h1>
                <p>
                    新增作业功能<br>新增用户中心查看所有报名课程功能<br>修复大量BUG<br>
                </p>
            </version>

            <version data-date='2018-10-21' data-version="sub">
                <h1>0.1.3 Beta</h1>
                <p>
                    新增教学大纲功能<br>新增签到功能<br>修复大量BUG<br>
                </p>
            </version>
        </logs>

    </section>
</div>

@endsection