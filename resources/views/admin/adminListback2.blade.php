@extends('_layouts.admin')
@section('content')
<div class="container">
    <div class="page-header" style="position: relative">
        <h1>
            管理员
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                &nbsp; 管理
            </small>

        </h1>
        <button data-toggle="modal" class="btn btn-xs btn-success" href="#modal-form" style="position: absolute;right: 0;bottom:5px;">
                <i class="ui-icon ace-icon fa fa-plus bigger-120"></i>
        </button>

    </div>
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <table id="simple-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>用户名</th>
                    <th>电子邮件</th>
                    <th>公司</th>
                    <th>角色</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
        <tbody>
            @foreach ($list as $user )
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->company->company_name }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role->name}}
                    @endforeach
                </td>

                <td>
                    @if ($user->status === 0)
                        <span class="label label-sm label-warning">过期</span>
                    @else
                        <span class="label label-sm label-sucess">正常</span>
                    @endif
                </td>
                <td>
                <div class="hidden-sm hidden-xs btn-group">
                    <button class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </button>

                    <button class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </button>
                </div>

                <div class="hidden-md hidden-lg">
                    <div class="inline pos-rel">
                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
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
    <!-- /.span -->
    </div>
    <!-- /.row -->
</div>

<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">修改用户密码</h4>
            </div>

            <form class="form-horizontal" role="form" method="post" accept-charset="utf-8" action="admin/change_passwd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7">
                            <fieldset>
                                <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="password" placeholder="old Password" name="old_pass" class="form-control">
                                    <i class="ace-icon fa fa-lock"></i>
                                </span>
                                </label>
                                <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="password" placeholder="Password" name="new_pass" class="form-control">
                                    <i class="ace-icon fa fa-lock"></i>
                                </span>
                                </label>
                                <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="password" placeholder="Repeat password" name="new_pass2" class="form-control">
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
        </div>
    </div>
</div>
@endsection
@section('user_js')
    <script type="text/javascript">

        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('shown.bs.modal', function () {
            $(this).find('.chosen-container').each(function(){
                $(this).find('a:first-child').css('width' , '210px');
                $(this).find('.chosen-drop').css('width' , '210px');
                $(this).find('.chosen-search input').css('width' , '200px');
            });
        })
    </script>
@endsection
