@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
    <div class="page-content" id="productShow">
        <div class="page-header" style="position: relative">
            <h1>
                {{ $title }}
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    &nbsp;<a href="/admin/productmodel">返回</a>
                </small>
            </h1>
        </div>
        <div class="row">

            <div class="col-sm-10 col-sm-offset-1">
                <!-- #section:pages/invoice -->
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-leaf green"></i>
                            基本信息
                        </h4>
                        <!-- /section:pages/invoice.info -->
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <ul class="list-unstyled spaced" style="font-size:14px;">
                                            <li class="col-xs-12 col-sm-12" style="width: 90%;">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                型号：<span class="blue">{{$model->model_name}}</span>
                                            </li><br>

                                            <li class="col-xs-12 col-sm-12" style="width: 90%;">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                规则：<span class="blue" id="product_mcu_rule">{{$model->product_mcu_rule}}</span>
                                            </li>
                                            <button style="float: left;" id="edit" class="btn btn-sm" >修改</button>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>

                <div class="widget-body" id="mcu_rule" style="display: none;">
                    <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                        <form class="form-search" name="searchform" method="post" action="/admin/productmodel/{{$model->model_id}}" >
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="model" value="{{$model->model_name}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <ul class="nav nav-tabs padding-16">
                                <li class="active">
                                    <a data-toggle="tab" href="#edit-image" aria-expanded="true">
                                        <i class="green ace-icon fa fa-cog bigger-125"></i>
                                        规则
                                    </a>
                                </li>
                            </ul>
                            <div id="encode_type_delimiter" style="width:100%;float:left;">
                                <div style="width:45%;float:left;">
                                    <div class="profile-info-name"> encode_type </div>
                                    <div class="profile-info-value">
                                        <input type="text" name="encode_type" placeholder="encode_type" value="" autocomplete="off" class="search-query">
                                    </div>
                                </div>
                                <div style="width:45%;float: left;">
                                    <div class="profile-info-name"> delimiter </div>
                                    <div class="profile-info-value">
                                        <input type="text" name="delimiter" placeholder="delimiter" value="" autocomplete="off" class="search-query">
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix form-actions" id="button">
                                <div class="col-md-offset-5 col-md-6">
                                    <button class="btn btn-primary " type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        保存
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- /section:pages/invoice -->
            </div>
        </div>

    </div>
        <!-- PAGE CONTENT BEGINS -->
@endsection
@section('user_js')
    <script type="text/javascript">
        var keys = 0;
        $(document).on('click','.addattr',function(){
            k=keys;

            $("#button").before('<div class="space-10" id="hr_'+k+'" style="margin-left: 1%"></div>' +
                ' <h5 class="header blue bolder smaller" id="mcuattrdiv_'+k+'" style="margin-left: 1%">attr'+k+
                ' <i id="delattr_'+k+'" class="ace-icon glyphicon glyphicon-minus blue bigger-110 delattr"></i></h5>');
            $("#mcuattrdiv_"+k).after('<div id="mcuattr_'+k+'"></div>');

            $("#mcuattr_"+k).append('<div style="width:100%;float:left;">' +
                ' <div style="width:45%;float:left;"> <div class="profile-info-name"> key </div> <div class="profile-info-value"> ' +
                '<input type="text" name="key['+k+']" placeholder="key" value="" autocomplete="off" class="search-query">' +
                ' </div></div>' +
                ' <div style="width:45%;float:left;"> <div class="profile-info-name"> type </div> <div class="profile-info-value">' +
                ' <input type="text" name="type['+k+']" placeholder="type" value="" autocomplete="off" class="search-query">' +
                ' </div> </div>' +
                ' <div style="width:45%;float:left;"> <div class="profile-info-name"> name </div> <div class="profile-info-value">' +
                ' <input type="text" name="name['+k+']" placeholder="name" value="" autocomplete="off" class="search-query">' +
                '</div> </div>' +
                ' <div style="width:45%;float:left;"> <div class="profile-info-name"> bytes </div> <div class="profile-info-value">' +
                ' <input type="text" name="bytes['+k+']" placeholder="bytes" value="" autocomplete="off" class="search-query">' +
                '</div> </div>' +
                ' <div style="width:45%;float:left;"> <div class="profile-info-name"> num_type </div> <div class="profile-info-value">' +
                ' <input type="text" name="num_type['+k+']" placeholder="num_type" value="" autocomplete="off" class="search-query">' +
                ' </div> </div>' +
                ' <div style="width:45%;float:left;"> <div class="profile-info-name"> value_map </div> <div class="profile-info-value">' +
                ' <input type="text" name="value_map['+k+']" placeholder="value_map" value="" autocomplete="off" class="search-query">' +
                '</div> </div> </div>');
            keys=keys+1;
        });

        $(document).on('click','.delattr',function(){
            arr = $(this).attr('id').split('_');
            $("#hr_"+arr[1]).remove();
            $("#mcuattrdiv_"+arr[1]).remove();
            $("#mcuattr_"+arr[1]).remove();
        });

        $("#edit").click(function(){
            $("#mcu_rule").show();
            if($("#mcuattr_0").html() == undefined) {
                if ($("#product_mcu_rule").html() != '') {
                    mcu = JSON.parse($("#product_mcu_rule").html());
                    $("input[name=encode_type]").val(mcu.encode_type);
                    $("input[name=delimiter]").val(mcu.delimiter);

                    for (var k in mcu.attr) {
                        if (mcu.attr[k].key != undefined) {
                            a = k - 1;
                            if ($("#mcuattr_" + a).html() == undefined) {
                                $("#encode_type_delimiter").after('<div class="space-10" id="hr_' + k + '" style="margin-left: 1%"></div>' +
                                ' <h5 class="header blue bolder smaller" id="mcuattrdiv_' + k + '" style="margin-left: 1%">attr' + k +
                                ' <i id="addattr_' + k + '" class="ace-icon glyphicon glyphicon-plus blue bigger-110 addattr"></i>' +
                                ' </h5>');

                            } else {
                                $("#mcuattr_" + a).after('<div class="space-10" id="hr_' + k + '" style="margin-left: 1%"></div>' +
                                ' <h5 class="header blue bolder smaller" id="mcuattrdiv_' + k + '" style="margin-left: 1%">attr' + k +
                                ' <i id="delattr_' + k + '" class="ace-icon glyphicon glyphicon-minus blue bigger-110 delattr"></i></h5>');
                            }

                            $("#mcuattrdiv_" + k).after('<div id="mcuattr_' + k + '"></div>');

                            $("#mcuattr_" + k).append('<div style="width:100%;float:left;">' +
                            ' <div style="width:45%;float:left;"> <div class="profile-info-name"> key </div> <div class="profile-info-value"> ' +
                            '<input type="text" name="key[' + k + ']" placeholder="key" value="' + mcu.attr[k].key + '" autocomplete="off" class="search-query">' +
                            ' </div></div>' +
                            ' <div style="width:45%;float:left;"> <div class="profile-info-name"> type </div> <div class="profile-info-value">' +
                            ' <input type="text" name="type[' + k + ']" placeholder="type" value="' + mcu.attr[k].type + '" autocomplete="off" class="search-query">' +
                            ' </div> </div>' +
                            ' <div style="width:45%;float:left;"> <div class="profile-info-name"> name </div> <div class="profile-info-value">' +
                            ' <input type="text" name="name[' + k + ']" placeholder="name" value="' + mcu.attr[k].name + '" autocomplete="off" class="search-query">' +
                            '</div> </div>' +
                            ' <div style="width:45%;float:left;"> <div class="profile-info-name"> bytes </div> <div class="profile-info-value">' +
                            ' <input type="text" name="bytes[' + k + ']" placeholder="bytes" value="' + mcu.attr[k].bytes + '" autocomplete="off" class="search-query">' +
                            '</div> </div>' +
                            ' <div style="width:45%;float:left;"> <div class="profile-info-name"> num_type </div> <div class="profile-info-value">' +
                            ' <input type="text" name="num_type[' + k + ']" placeholder="num_type" value="' + mcu.attr[k].num_type + '" autocomplete="off" class="search-query">' +
                            ' </div> </div>' +
                            ' <div style="width:45%;float:left;"> <div class="profile-info-name"> value_map </div> <div class="profile-info-value">' +
                            ' <input type="text" name="value_map[' + k + ']" id="value_map_' + k + '" placeholder="value_map" value="" autocomplete="off" class="search-query">' +
                            '</div> </div> </div>');
                            $("#value_map_" + k).val(JSON.stringify(mcu.attr[k].value_map));
                            keys = keys + 1;
                        }
                    }
                } else {
                    if ($("#mcuattr_0").html() == undefined) {
                        $("#encode_type_delimiter").after('<div class="space-10" id="hr_0" style="margin-left: 1%"></div>' +
                        ' <h5 class="header blue bolder smaller" id="mcuattrdiv_0" style="margin-left: 1%">attr0' +
                        ' <i id="addattr_0" class="ace-icon glyphicon glyphicon-plus blue bigger-110 addattr"></i>' +
                        ' </h5>');
                        $("#mcuattrdiv_0").after('<div id="mcuattr_0"></div>');
                        $("#mcuattr_0").append('<div style="width:100%;float:left;">' +
                        ' <div style="width:45%;float:left;"> <div class="profile-info-name"> key </div> <div class="profile-info-value"> ' +
                        ' <input type="text" name="key[0]" placeholder="key" value="" autocomplete="off" class="search-query">' +
                        ' </div></div>' +
                        ' <div style="width:45%;float:left;"> <div class="profile-info-name"> type </div> <div class="profile-info-value">' +
                        ' <input type="text" name="type[0]" placeholder="type" value="" autocomplete="off" class="search-query">' +
                        ' </div> </div>' +
                        ' <div style="width:45%;float:left;"> <div class="profile-info-name"> name </div> <div class="profile-info-value">' +
                        ' <input type="text" name="name[0]" placeholder="name" value="" autocomplete="off" class="search-query">' +
                        ' </div> </div>' +
                        ' <div style="width:45%;float:left;"> <div class="profile-info-name"> bytes </div> <div class="profile-info-value">' +
                        ' <input type="text" name="bytes[0]" placeholder="bytes" value="" autocomplete="off" class="search-query">' +
                        ' </div> </div>' +
                        ' <div style="width:45%;float:left;"> <div class="profile-info-name"> num_type </div> <div class="profile-info-value">' +
                        ' <input type="text" name="num_type[0]" placeholder="num_type" value="" autocomplete="off" class="search-query">' +
                        ' </div> </div>' +
                        ' <div style="width:45%;float:left;"> <div class="profile-info-name"> value_map </div> <div class="profile-info-value">' +
                        ' <input type="text" name="value_map[0]" placeholder="value_map" value="" autocomplete="off" class="search-query">' +
                        ' </div> </div> </div>');
                        keys = keys + 1;
                    }
                }
            }
        });



    </script>
@endsection
