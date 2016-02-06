@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
<div class="page-content">
    <div class="widget-body" id="searchformdiv">
        <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
            <form class="form-search" name="searchform" method="get" action="/site/product" >
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
                </table>
            </div>
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
@endsection
