@extends('_layouts.admin')

@section('content')
        <div class="page-content">
            <div class="page-header">
                <div class="alert alert-block alert-success">
                    <button data-dismiss="alert" class="close" type="button">
                        <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-check green"></i>

                        @if($list['notice'])
                            通知：{{$list['notice']}}
                        @else
                        您好，{{$u_data['admin']->name}}，今天是：<?php echo date('Y年m月d日', time())?>，欢迎您使用 Skylink 云平台！
                        @endif
                </div>
            </div><!-- /.page-header -->
            @if ($u_data['admin']->hasRole(['super','admin']))
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="space-6"></div>
                        <div class="col-sm-12 infobox-container">
                            <!-- #section:pages/dashboard.infobox -->
                            <div class="infobox infobox-blue">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-male"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">@if(isset($list['new_num'])){{$list['new_num']}}@else无@endif</span>
                                    <div class="infobox-content">今日新增用户</div>
                                </div>
                            </div>

                            <div class="infobox infobox-green">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-male"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">@if(isset($list['all_num'])){{$list['all_num']}}@else无@endif</span>
                                    <div class="infobox-content">累计用户</div>
                                </div>
                            </div>



                        </div>

                        <div class="vspace-12-sm"></div>
                    </div><!-- /.row -->
                    <div class="hr hr32 hr-dotted"></div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            @endif
        </div><!-- /.page-content -->

@endsection