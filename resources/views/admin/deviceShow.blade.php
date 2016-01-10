@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
<link rel="stylesheet" href="/css/index.css" />
{{--<link rel="stylesheet" href="/assets/css/bootstrap.css">--}}
<link rel="stylesheet" href="/css/remodal.css">
<link rel="stylesheet" href="/css/remodal-default-theme.css">
<div class="page-content">
        <div class="page-header" style="position: relative">
        <h1>
            {{ $title }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                &nbsp;
            </small>
        </h1>

    </div>
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="profile-user-info profile-user-info-striped" style="width: 33%;float: left;">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备id </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_id}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备mac </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_mac}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备sn </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_sn}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备名称 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_name}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 产品名称 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$u_data['product'][$device->product_id]}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> pid </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->pid}}</span>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped" style="width: 33%;float: left;">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 协议版本 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_protocol_ver}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> wifi固件版本 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_wifi_firmware_version}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> wifi版本 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_wifi_version}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> mcu版本 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_mcu_version}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备添加时间 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{date('Y-m-d',$device->add_time)}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备更新时间 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{date('Y-m-d',$device->update_time)}}</span>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped" style="width: 33%;">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备锁定状态 </div>
                    <div class="profile-info-value">
                        <span class="editable">@if($device->device_lock==0)已锁定@else未锁定@endif</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备所在省 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->province}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备所在市 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->city}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备所在区 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->district}}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 设备地址 </div>
                    <div class="profile-info-value">
                        <span class="editable">{{$device->device_address}}</span>
                    </div>
                </div>
            </div>
            <hr>


            <div class="container" id="container" style="height: 400px;width: 500px;float: left;">
                @include('socketcmd.ap500')
            </div>



            <div style="width: 20%;margin-top: 3%;float: left;">
                <div class="profile-user-info profile-user-info-striped" >
                    <div class="profile-info-row">
                        <div class="profile-info-name"> 设备在线状态 </div>
                        <div class="profile-info-value">
                            <span class="editable">@if(isset($redis['online']))
                                    @if($redis['online'] == 1) 在线 @else 不在线 @endif @else 不在线 @endif</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> 地区当前风速 </div>
                        <div class="profile-info-value">
                            <span class="editable">@if(isset($redis['filter'])) {{ $redis['filter'] }} @else 无 @endif</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> 地区当前pm </div>
                        <div class="profile-info-value">
                            <span class="editable">@if(isset($redis['pm'])) {{ $redis['pm'] }} @else 无 @endif</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> 地区当前风向 </div>
                        <div class="profile-info-value">
                            <span class="editable">@if(isset($redis['humidity'])) {{ $redis['humidity'] }} @else 无 @endif</span>
                        </div>
                    </div>
                </div>

                <div class="profile-user-info profile-user-info-striped" style="margin-top: 10%;">
                    <div class="profile-info-row">
                        <div class="profile-info-name">升级的固件版本</div>
                        <div class="profile-info-value">
                            <select id="firwareurl">
                                @if(!empty($model))
                                    @foreach($model as $v)
                                    <option value="{{$v['firmware_w_url']}}">{{$v['firmware_version']}}</option>
                                    @endforeach
                                @else
                                    <option>无可升级固件</option>
                                @endif
                            </select>
                            <button type="button" class="btn btn-xs btn-success" style="float: right;margin:0 10px 0 0; width:50px;height: 30px;"
                                    data-toggle="modal" data-target=".bs-example-modal-sm" @if(empty($model)){{'disabled'}}@endif>
                                升级
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6" style="margin-top: 25px;" >
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-comment blue"></i>
                            cmd
                        </h4>
                        <button type="button" class="btn btn-xs btn-danger" style="float: right;margin:5px 10px 0 0;" onclick="delall();">
                            清空
                        </button>
                    </div>

                    <div class="widget-body" style="height: 320px;">
                        <div class="widget-main no-padding">
                            <!-- #section:pages/dashboard.conversations -->
                            <div class="dialogs">
                                <div class="scroll-content" id="scroll-content">
                                </div>
                            </div>

                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div>

            <table id="gird" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="30%">login_id</th>
                    <th width="30%">user_name</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($users))
                @foreach($users as $v)
                    <tr>
                        <td>@if(Auth::user()->hasRole('test')){{ $v['loginid'] }}@else<a href="/admin/user/{{ $v['userid'] }}">{{ $v['loginid'] }}</a>@endif</td>
                        <td>{{ $v['username'] }}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td align="center" colspan="2">该设备没有绑定用户</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-content">
                <!-- #section:custom/extra.hr -->
                <div class="hr hr32 hr-dotted"></div>
                <div class="row">
                    <div class="space-6"></div>
                    <div id="line1"></div>
                </div>
            </div>
        </div>
        <!-- /.span -->
    </div>

    <!-- /.row -->
</div>

<div id="delConfirmModal" class="modal fade bs-example-modal-sm" role="dialog" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">消息</h4>
            </div>
            <div class="modal-body" id="delMsg">
                确定要进行升级么?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id = "deleteCancel">关闭</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="deleteIt">确定</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('user_js')
    <script src="/js/zepto.js"></script>
    <script src="/js/remodal.js"></script>
    <script src="/js/cmd.js"></script>
    <script src="/assets/js/highstock/highstock.js"></script>
    <script src="/assets/js/ace/elements.scroller.js"></script>
    <script src="/assets/js/ace/ace.sidebar-scroll-1.js"></script>
    <script type="text/javascript">
        Highcharts.setOptions({ global: { useUTC: false } });
    </script>
    <script type="text/javascript">
        var mac = "{{$device->device_mac}}";
        $('.dialogs,.comments').ace_scroll({
            size: 300
        });

        $(function () {
            $.getJSON('/admin/devicejson/<?php echo $id; ?>?callback=?', function (data) {
                $('#line1').highcharts('StockChart', {
                    rangeSelector : {
                        buttons: [{
                            type: 'day',
                            count: 1,
                            text: '1天'
                        }, {
                            type: 'day',
                            count: 3,
                            text: '3天'
                        }, {
                            type: 'day',
                            count: 5,
                            text: '5天'
                        }, {
                            type: 'all',
                            text: '所有'
                        }],
                        selected : 0,
                        inputEnabled: $('#line1').width() > 480
                    },
                    title : {
                        text : '设备pm'
                    },
                    series : [{
                        name : '设备pm',
                        data : data,
                        tooltip: {
                            valueDecimals: 0
                        }
                    }]

                });
            });

        });
    </script>
@endsection
