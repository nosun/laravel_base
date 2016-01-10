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
    <div class="row" style="height:90px;">
        <div class="col-sm-12">
            <h4 class="header blue lighter smaller">
                <i class="ace-icon fa fa-calendar-o smaller-90"></i>
                条件筛选
            </h4>

            <form class="form-inline" role="form" method="post" action="">
                <div class="form-group">
                    <div class="input-daterange input-group">
                        <input type="text" name="start" value="{{$data['start']}}" class="input-sm form-control">
                                        <span class="input-group-addon">
                                            <i class="fa fa-exchange"></i>
                                        </span>
                        <input type="text" name="end" value="{{$data['end']}}" class="input-sm form-control">
                    </div>
                </div>
                <input type="hidden" name="search" value="1">
                <div class="form-group">
                    <div class="input-group" style="padding-top:4px;">
                        <input type="text" name="num" id="spinner1" class="input-mini spinner-input form-control" style="height: 29px;text-align: center;" maxlength="3">
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
        <div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
            <div class="widget-box " style="margin:0px">
                <!-- #section:custom/widget-box.options -->
                <div class="widget-header">
                    <h6 class="widget-title bigger lighter">
                        <i class="ace-icon fa fa-table"></i>
                        用户分布（Top{{$data['num']}}）
                    </h6>
                </div>

                <!-- <div class="table-responsive"> -->
                <!-- <div class="dataTables_borderWrap"> -->
                <div>
                    <div role="grid" class="dataTables_wrapper form-inline" id="mytable_wrapper">

                        <table class="table table-striped table-bordered table-hover dataTable" id="mytable"
                               aria-describedby="mytable">
                            <thead>
                            <tr role="row">

                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="mytable" rowspan="1" colspan="1">排序
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="mytable" rowspan="1" colspan="1">城市
                                </th>
                                <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="mytable" rowspan="1"
                                    colspan="1" >数量
                                </th>
                            </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php $i=1; ?>
                            @foreach ($user as $row )
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row['city'] }}</td>
                                    <td>{{ $row['sum'] }}</td>
                                </tr>
                            <?php $i++;?>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="widget-box" style="margin:0px">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        用户分布（{{$data['start']}} 至 {{$data['end']}} Top {{$data['num']}} ）
                    </h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="pie1" style="min-width: 310px; height: 496px; max-width: 600px; margin: 0 auto"></div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->


    </div>

</div>

@endsection
@section('user_js')
    @if(count($user) == 0 && $search == 1)
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/devicearea";
            });
        </script>
    @endif
    <script src="/assets/js/highcharts/highcharts.js"></script>
    <script src="/assets/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="/assets/js/fuelux/fuelux.spinner.min.js"></script>
    <script src="/assets/js/ace-elements.min.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        jQuery(function($) {
            $('.input-daterange').datepicker(
                    {
                        format: 'yyyy-mm-dd',
                        weekStart: 1,
                        autoclose: true,
                        todayBtn: 'linked',
                        language: 'zh-CN'
                    }
            );

            $('#pie1').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    spacingTop:0,spacingBottom:0,
                    renderTo: 'container',
                    // 图表宽度
                    width: 450,
                    // 图表高度
                    hight: 300,
                    reflow: true
                },
                title: {
                    text: false
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: '用户数量',
                    data: <?php echo $str;?>
                }]
            });
            $('#spinner1').ace_spinner({
                value: {{ $data['num'] }},
                min:0,
                max:100,
                step:10,
                btn_up_class:'btn-info' ,
                btn_down_class:'btn-info'
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('#mytable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        null, null, null
                    ],
                    "oLanguage": {//下面是一些汉语翻译
                        "sSearch": "当前页搜索",
                        "sLengthMenu": "每页显示 _MENU_ 条记录",
                        "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                        "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                        "sZeroRecords": "没有检索到数据",
                        "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                    }
                });
        })
    </script>
@endsection
