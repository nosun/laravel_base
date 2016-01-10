@extends('_layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="widget-box ">
            <!-- #section:custom/widget-box.options -->
            <div class="widget-header">
                <h5 class="widget-title bigger lighter">
                    <i class="ace-icon fa fa-table"></i>
                    管理员管理
                </h5>
            </div>

            <!-- <div class="table-responsive"> -->
            <!-- <div class="dataTables_borderWrap"> -->
            <div>
                <div role="grid" class="dataTables_wrapper form-inline" id="mytable_wrapper">

                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable"
                           aria-describedby="mytable">
                        <thead>
                        <tr role="row">
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="mytable" rowspan="1"
                                colspan="1">用户名
                            </th>
                            <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="mytable"
                                rowspan="1"
                                colspan="1">公司
                            </th>
                            <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="mytable"
                                rowspan="1"
                                colspan="1">角色
                            </th>
                            <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="mytable"
                                rowspan="1"
                                colspan="1">操作
                            </th>
                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach ($list as $user )
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->company->company_name }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name}}
                                @endforeach
                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="blue" href="#">
                                        <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                    </a>

                                    <a class="green" href="#">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" href="#">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('user_js')

<script src="../assets/js/dataTables/jquery.dataTables.js"></script>
<script src="../assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        var oTable1 =
            $('#mytable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    //"bAutoWidth": true,
                    "ordering": false,
                    //"paging": false,
                    "info":false
                });

    })
</script>
@endsection
