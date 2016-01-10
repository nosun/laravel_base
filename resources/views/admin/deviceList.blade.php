@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
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

    <div class="widget-body" id="searchformdiv">
        <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
            <form class="form-search" name="searchform" method="get" action="/admin/device" >
                <div class="" style="width:100%;float:left;">
                    <div class="" style="width:260px;float:left;">
                        <div class="profile-info-name"> 产品名称 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchproname" placeholder="请输入产品名称" value="<?php echo isset($_GET['searchproname'])?
                                    $_GET['searchproname']:''; ?>" autocomplete="off" class="search-query">
                        </div>
                    </div>
                    <div class="" style="width:250px;float: left;">
                        <div class="" style="width:250px;float: left;">
                            <div class="profile-info-name"> 设备状态 </div>
                            <div class="profile-info-value">
                                <select name="searchselectstatus" id="searchselectstatus">
                                    <option value="0">请选择状态</option>
                                    <option value="1" <?php echo isset($_GET['searchselectstatus'])?($_GET['searchselectstatus']=='1'?'selected':''):''; ?>>
                                        设备在线状态</option>
                                    <option value="2" <?php echo isset($_GET['searchselectstatus'])?($_GET['searchselectstatus']=='2'?'selected':''):''; ?>>
                                        设备锁定状态</option>
                                    <option value="3" <?php echo isset($_GET['searchselectstatus'])?($_GET['searchselectstatus']=='3'?'selected':''):''; ?>>
                                        设备滤网状态</option>
                                    <option value="4" <?php echo isset($_GET['searchselectstatus'])?($_GET['searchselectstatus']=='4'?'selected':''):''; ?>>
                                        设备报警状态</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="searchstatus" style="float:left;">
                        <div class="">
                            <div class="profile-info-value">
                                <input type="radio" name="searchstatus" value="1" <?php echo isset($_GET['searchstatus'])?
                                        ($_GET['searchstatus']=='1'?'checked':''):''; ?> autocomplete="off"><span id="searchstatusval1"></span>
                                <input type="radio" name="searchstatus" value="0" <?php echo isset($_GET['searchstatus'])?
                                        ($_GET['searchstatus']=='0'?'checked':''):''; ?> autocomplete="off"><span id="searchstatusval2"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="" style="width:100%;float:left;">
                    <div class="" style="width:260px;float:left;">
                        <div class="profile-info-name"> 产品地区 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchprovince" placeholder="请输入省份" value="<?php echo isset($_GET['searchprovince'])?
                                    $_GET['searchprovince']:''; ?>" autocomplete="off" class="search-query">
                        </div>
                    </div>
                    <div class="" style="width:260px;float:left;">
                        <div class="profile-info-name"> 产品地区 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchcity" placeholder="请输入市区" value="<?php echo isset($_GET['searchcity'])?
                                    $_GET['searchcity']:''; ?>" autocomplete="off" class="search-query">
                        </div>
                    </div>
                </div>
                <div class="" style="width:100%;float:left;">
                    <div class="" style="width:260px;float:left;">
                        <div class="profile-info-name"> 添加时间 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchaddtime" placeholder="请输入时间" value="<?php echo isset($_GET['searchaddtime'])?
                                    $_GET['searchaddtime']:''; ?>" autocomplete="off" data-date-format="yyyy-mm-dd" class="search-query">
                        </div>
                    </div>
                </div>
                <div class="" style="width:100%;float:left;">
                    <div class="" style="width: 260px;float:left;">
                        <div class="profile-info-name"> 设备信息 </div>
                        <div class="profile-info-value" style="width: 220px;">
                            <select name="searchselectdevice" id="searchselectdevice">
                                <option value="0">请选择查询内容</option>
                                <option value="1" <?php echo isset($_GET['searchselectdevice'])?($_GET['searchselectdevice']=='1'?'selected':''):''; ?>>
                                    设备名称查询</option>
                                <option value="2" <?php echo isset($_GET['searchselectdevice'])?($_GET['searchselectdevice']=='2'?'selected':''):''; ?>>
                                    设备mac查询</option>
                                <option value="3" <?php echo isset($_GET['searchselectdevice'])?($_GET['searchselectdevice']=='3'?'selected':''):''; ?>>
                                    设备sn查询</option>
                            </select>
                        </div>
                    </div>
                    <div id="searchdevice" style="width:260px;float:left;">
                        <div class="profile-info-name" id="searchdevicename"></div>
                        <div class="profile-info-value">
                            <input type="text" name="searchdeviceval" id="searchdeviceval" value="<?php echo isset($_GET['searchdeviceval'])?
                                    $_GET['searchdeviceval']:''; ?>" autocomplete="off" class="search-query">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm" style="margin-top:6px;margin-left:20px;float: left;">搜索</button>
                </div>

            </form>
        </div>
    </div>
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box " style="margin:0px">
                <div class="table-header">单页设备列表</div>
                <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                <thead>
                <tr>
                    <th width="10%">sn</th>
                    <th width="10%">mac</th>
                    <th width="10%">产品名称</th>
                    <th width="10%">设备名称</th>
                    <th width="10%">协议版本</th>
                    <th width="5%">在线状态</th>
                    <th width="5%">锁定状态</th>
                    <th width="10%">省</th>
                    <th width="10%">市</th>
                    <th width="10%">添加时间</th>
                    <th width="10%">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $row )
                    <?php //var_dump($row); ?>
                    <tr>
                        <td>{{ $row->device_sn }}</td>
                        <td>{{ $row->device_mac }}</td>
                        <td>@if(isset($u_data['product'][$row->product_id])){{ $u_data['product'][$row->product_id] }}@endif</td>
                        <td>{{ $row->device_name }}</td>
                        <td>{{ $row->device_protocol_ver }}</td>
                        <td>@if($row->device_online == '1')在线@else不在线@endif</td>
                        <td>@if($row->device_lock == '1')未锁定@elseif($row->device_lock == '0')已锁定@endif</td>
                        <td>{{ $row->province }}</td>
                        <td>{{ $row->city }}</td>
                        <td>{{ date('Y-m-d',$row->add_time) }}</td>
                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <a class="btn btn-xs btn-warning" href="/admin/device/{{ $row->device_id }}" title="设备详情">
                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                </a>
                                <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                        data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->device_id }}">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle buttoninput" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a class="tooltip-info" href="/admin/device/{{ $row->device_id }}" title="查看日志">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-search-plus bigger-110"></i>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="tooltip-danger" data-toggle="modal"
                                               data-target=".bs-example-modal-sm" title="delete" data-id="{{ $row->device_id }}">
                                                <span class="red">
                                                    <i class="ace-icon fa fa-trash-o icon-only bigger-110"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            <?php echo $list->render(); ?>
        </div>
        <!-- /.span -->

    </div>
    <!-- /.row -->
    <!-- Small modal -->
    <div id="delConfirmModal" class="modal fade bs-example-modal-sm" role="dialog" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">消息</h4>
                </div>
                <div class="modal-body" id="delMsg">
                    确定要删除么?
                </div>
                <input type="hidden" id="modal-cont" value=''>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id = "deleteCancel">关闭</button>
                    <button type="button" class="btn btn-primary" id="deleteIt">确定</button>
                </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

@endsection
@section('user_js')
    @if(!isset($list[0]) && isset($_GET['searchproname']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/device";
            });
        </script>
    @endif
    <script src="../assets/js/date-time/bootstrap-datepicker.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#delConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('id'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#modal-cont').val(recipient);
        });

        $("#deleteIt").on('click',function(event){
            var id= $('#modal-cont').val();
            $.ajax({
                type : "DELETE",
                url : "/admin/device/" + id,
                dataType:"json",
                success:function(data){
                    if (data.msg == 200){
                        $('#delMsg').html('您已经成功删除该信息')
                    }
                    setTimeout(reload,500);
                }
            })

        });

        $('input[name=searchaddtime]').datepicker({
            autoclose: true,
            todayHighlight: true
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        $('#delConfirmModal').on('hide.bs.modal', function () {
            window.location.reload();
        });

        function reload(){
            window.location.reload();
        }

        jQuery(function ($) {
            $('#mytable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        null, null, null,null,null,null,null,null,null,null,{ "bSortable": false }
                    ],
                    "oLanguage": {//下面是一些汉语翻译
                        "sSearch": "当前页搜索",
                        "sLengthMenu": "每页显示 _MENU_ 条记录",
                        "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                        "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                        "sZeroRecords": "没有检索到数据",
                        "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                    },
                    "aaSorting": [[9, "desc"]],
                    "iDisplayLength": 50,
                    "bPaginate": false,
                    "bFilter": false
            });
        });
        jQuery(function ($) {
            $("#searchstatus").hide();
            @if(isset($_GET['searchselectstatus'])) searchstatus({{$_GET['searchselectstatus']}});@endif
            $("#searchselectstatus").change(function(){
                var val = parseInt($("#searchselectstatus").val());
                searchstatus(val);
            });

            $("#searchdevice").hide();
            @if(isset($_GET['searchselectdevice'])) searchdevice({{$_GET['searchselectdevice']}});@endif
            $("#searchselectdevice").change(function(){
                        var val = parseInt($("#searchselectdevice").val());
                        searchdevice(val);
                    });
        });

        function searchstatus(val){
            switch(val){
                case 0:
                    $("#searchstatus").hide();
                    $('input:radio[name=searchstatus]').attr('checked',false);
                    break;
                case 1:
                    $("#searchstatus").show();
                    $("#searchstatusval1").html("在线");
                    $("#searchstatusval2").html("不在线");
                    break;
                case 2:
                    $("#searchstatus").show();
                    $("#searchstatusval1").html("锁定");
                    $("#searchstatusval2").html("未锁定");
                    break;
                case 3:
                    $("#searchstatus").show();
                    $("#searchstatusval1").html("过期");
                    $("#searchstatusval2").html("未过期");
                    break;
                case 4:
                    $("#searchstatus").show();
                    $("#searchstatusval1").html("报警");
                    $("#searchstatusval2").html("未报警");
                    break;
                default :
                    break;
            }
        }

        function searchdevice(val){
            switch(val){
                case 0:
                    $("#searchdevice").hide();
                    $("#searchdeviceval").val('');
                    break;
                case 1:
                    $("#searchdevice").show();
                    $("#searchdevicename").html("设备名称");
                    $("#searchdeviceval").attr("placeholder","请输入设备名称");
                    break;
                case 2:
                    $("#searchdevice").show();
                    $("#searchdevicename").html("设备mac");
                    $("#searchdeviceval").attr("placeholder","请输入设备mac");
                    break;
                case 3:
                    $("#searchdevice").show();
                    $("#searchdevicename").html("设备sn");
                    $("#searchdeviceval").attr("placeholder","请输入设备sn");
                    break;
                default :
                    break;
            }
        }
    </script>

@endsection
