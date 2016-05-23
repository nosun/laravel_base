<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title> Admin Center </title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    @yield('user_css')

    <link rel="stylesheet" href="/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="/assets/css/admin.css" class="ace-main-stylesheet"/>
    <!-- text fonts -->
    <link rel="stylesheet" href="/assets/css/ace-fonts.css" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/assets/css/ace-part2.css" />
    <![endif]-->
    <link rel="stylesheet" href="/assets/css/ace-rtl.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/assets/css/ace-ie.css" />
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default">
<script type="text/javascript">
    try{ace.settings.check('navbar' , 'fixed')}catch(e){}
</script>

<div class="navbar-container" id="navbar-container">
<!-- #section:basics/sidebar.mobile.toggle -->
<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
    <span class="sr-only">Toggle sidebar</span>

    <span class="icon-bar"></span>

    <span class="icon-bar"></span>

    <span class="icon-bar"></span>
</button>

<!-- /section:basics/sidebar.mobile.toggle -->
<div class="navbar-header pull-left">
    <!-- #section:basics/navbar.layout.brand -->
    <a href="/admin" class="navbar-brand">
        <small>
            <i class="fa fa-leaf"></i>
            Admin Center
        </small>
    </a>

    <!-- /section:basics/navbar.layout.brand -->

    <!-- #section:basics/navbar.toggle -->

    <!-- /section:basics/navbar.toggle -->
</div>

<!-- #section:basics/navbar.dropdown -->
<div class="navbar-buttons navbar-header pull-right" role="navigation">
<ul class="nav ace-nav">
    {{--@if (Auth::user()->hasRole('super')==true)--}}
        <li class="grey">
            <a href="/admin/role" title="角色">
                <i class="fa  fa-puzzle-piece" style="font-size: 15px;"></i>
            </a>
        </li>
        <li class="purple">
            <a href="/admin/permission" title="权限">
                <i class="glyphicon glyphicon-lock"></i>
            </a>
        </li>

        <li class="green">
            <a href="/admin/admin" title="用户">
                <i class="glyphicon glyphicon-user"></i>
            </a>
        </li>
    {{--@endif--}}
<!-- #section:basics/navbar.user_menu -->
<li class="light-blue">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img class="nav-user-photo" src="/assets/avatars/avatar2.png" alt="photo" />
        <span class="user-info">
            <small>您好,</small>
            {{ Auth::user()->name }}
        </span>
        <i class="ace-icon fa fa-caret-down"></i>
    </a>

    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
        <li>
            <a href="/admin/profile">
                <i class="ace-icon fa fa-user"></i>
                个人信息
            </a>
        </li>
        <li>
            <a data-toggle="modal" class="blue" role="button" href="#passwd-modal-form">
                <i class="ace-icon fa fa-lock"></i>
                修改密码
            </a>
        </li>
        <li class="divider"></li>

        <li>
            <a href="/logout">
                <i class="ace-icon fa fa-power-off"></i>
                退出系统
            </a>
        </li>
    </ul>
</li>

<!-- /section:basics/navbar.user_menu -->
</ul>
</div>

<!-- /section:basics/navbar.dropdown -->
</div><!-- /.navbar-container -->
</div>

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
<script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
</script>

<!-- #section:basics/sidebar -->
<div id="sidebar" class="sidebar responsive">
<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
</script>
    <ul class="nav nav-list">
         @include('_layouts.adminSideRoot')
    </ul>
<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
</div>

<!-- /section:basics/sidebar -->
<div class="main-content">
<div class="main-content-inner">
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="/admin">首页</a>
        </li>
        <li class="active">{{ $title }}</li>
    </ul><!-- /.breadcrumb -->
</div>
    @yield('content')
</div>
</div><!-- /.main-container -->
<div class="footer">
    <div class="footer-inner">
        <!-- #section:basics/footer -->
        <div class="footer-content">
                    <span class="small-120">
                        <span class="blue bolder">Powered By <a href="http://www.mingdabeta.com" target="_blank">mingdabeta.com</a></span>
                        &copy; 2014-2016
                    </span>

            &nbsp; &nbsp;
        </div>

        <!-- /section:basics/footer -->
    </div>
</div>
<div id="passwd-modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">修改密码</h4>
            </div>
            <form class="form-horizontal" role="form" accept-charset="utf-8" id="form_change_passwd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-10">
                            <fieldset>
                                <label class="block clearfix">
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" placeholder="Password" name="pass_new" class="form-control" ime-mode:disabled>
                                        <i class="ace-icon fa fa-lock"></i>
                                    </span>
                                </label>
                                <label class="block clearfix">
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" placeholder="Repeat password" name="pass_new2" class="form-control" ime-mode:disabled>
                                        <i class="ace-icon fa fa-retweet"></i>
                                    </span>
                                </label>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary"  type="submit">
                        <i class="ace-icon fa fa-check"></i>
                        确定
                    </button>

                    <button class="btn btn-sm "  type="reset">
                        <i class="ace-icon fa fa-check"></i>
                        重置
                    </button>
                </div>
            </form>
            <div id="msg" class="alert alert-block"></div>
        </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/assets/js/jquery.js'>"+"<"+"/script>");
    </script>

    <!-- <![endif]-->

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
    </script>
    <script>
        $(function(){
            //隐藏非超级管理员的搜索功能
            //$("#searchformdiv").remove();

            //隐藏非超级管理员的操作
            $(".dangerinput").remove();
            $(".seccessinput").remove();
            $(".buttoninput").remove();
            $(".insertinput").remove();
        });
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#<?php
        $name = explode('?', $_SERVER['REQUEST_URI']);
        $name = explode('/', $name[0]);
        echo !empty($name[2])?$name[2]:'';
        ?>").addClass('active').parent().parent().addClass('active').addClass('open');
    });
</script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/ace/ace.js"></script>
<script src="/assets/js/ace-extra.js"></script>
<!-- ace scripts -->
<script src="/assets/js/ace/ace.sidebar.js"></script>
<script src="/assets/js/ace/ace.sidebar-scroll-1.js"></script>
<script src="/assets/js/ace/ace.submenu-hover.js"></script>
<script src="/assets/js/ace/ace.widget-box.js"></script>
<script src="/assets/js/ace/ace.settings.js"></script>

<!-- page specific plugin scripts -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_change_passwd').submit(function(event) {
                var formData = {
                    'password':$("input[name='pass_new']").val(),
                    'password2':$("input[name='pass_new2']").val()
                }

                var res = checkpass(formData);
                if(res.res == false){
                    $('#msg').addClass('alert','alert-fail').html(res.msg);
                    event.preventDefault();
                }else{
                    // process the form
                    $.ajax({
                        type : 'PUT',
                        url  : '/admin/profile',
                        data : formData, // our data object
                        dataType : 'json', // what type of data do we expect back from the server
                        encode : true
                    })
                    // using the done promise callback
                        .done(function(data) {
                            $('#msg').addClass('alert-success').html(data.msg);
                            setInterval(reload,1000);
                        })
                }
            })

            function checkpass(formData){
                var res = {};
                if (formData['password'].length < 6){
                    res.res = false;
                    res.msg = '您输入的密码长度不能小于6';
                }else if (formData['password'] != formData['password2']){
                    res.res = false;
                    res.msg = '您的新密码两次输入不一致';
                }else{
                    res.res = true;
                    res.msg = '';
                }
                return res;
            }

            function reload(){
                window.location.reload();
            }
        })
        </script>
@yield('user_js')

</body>
</html>
