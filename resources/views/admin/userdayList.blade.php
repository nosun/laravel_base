@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
    <link href="/assets/css/datepicker.css" rel="stylesheet"/>
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
            <div class="page-content">
                <div class="row" style="height:90px;">
                    <div class="col-sm-12">
                        <h4 class="header blue lighter smaller">
                            <i class="ace-icon fa fa-calendar-o smaller-90"></i>
                            选择日期
                        </h4>
                        <form class="form-inline" role="form" accept-charset="utf-8" id ="myform" action="/admin/usershowday" method="post">
                            <div class="form-group">
                                <div class="input-daterange input-group">
                                    <input type="text" name="start" value="{{$date['start']}}" class="input-sm form-control">
                                        <span class="input-group-addon">
                                            <i class="fa fa-exchange"></i>
                                        </span>
                                    <input type="text" name="end" value="{{$date['end']}}" class="input-sm form-control">
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <button class="btn btn-sm btn-info" type="submit" style="margin-left:10px;font-size:14px;">
                                确 定
                            </button>
                        </form>
                    </div>
                </div>
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
    <!-- Small modal -->
</div>

@endsection
@section('user_js')
    <script src="/assets/js/highcharts/highcharts.js"></script>
    <script src="/assets/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="/assets/js/date-time/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {

            $('.input-daterange').datepicker(
                    {
                        format: 'yyyy-mm-dd',
                        weekStart: 1,
                        autoclose: true,
                        todayBtn: 'linked',
                        language: 'zh-CN'
                    }
            );
            $('#line1').highcharts({
                title: {
                    text: '用户每日增量',
                    x: -20 //center
                },
                xAxis: {
                    categories: [<?php echo $user[1] ?>]
                },
                yAxis: {
                    title: {
                        text: false
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '人'
                },
                series: [
                    {
                        name: '用户增量',
                        data: [<?php echo $user[0] ?>]
                    }

                ]
            });
        });
    </script>
@endsection
