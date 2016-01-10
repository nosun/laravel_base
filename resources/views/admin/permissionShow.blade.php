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
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <form id="myform">
                    <ul id="permission_edit" class="clear">
                        @foreach ($list as $row )
                            <li class="clear">
                                <div class="checkbox f_left">
                                    <label>
                                        <input type="checkbox" id="perm_'{{$row->id}}'" name="permission"
                                               value="{{$row->id}}"
                                        @if (in_array($row->id,$perms))
                                               checked="true"
                                                @endif
                                                >
                                        {{$row->display_name}}
                                    </label>
                                </div>
                                @if (count($row->children) != 0)
                                    <ul class="child_box f_left">
                                        @foreach( $row->children as $child)
                                            <li class="child f_left">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="perm_'{{$child->id}}'"
                                                               name="permission" value="{{$child->id}}"
                                                        @if (in_array($child->id,$perms))
                                                               checked="true"
                                                                @endif
                                                                >
                                                        {{$child->display_name}}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="col-sm-1 col-md-12 center">
                        <button class="btn btn-primary" type="submit"> 保 存</button>
                    </div>

                </form>
            </div>
            <!-- /.span -->
        </div>
        <!-- /.row -->
    </div>

@endsection
@section('user_js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#myform').submit(function (event) {
                var formData = {
                    'permission': jqchk()
                };
                // process the form
                $.ajax({
                    type: 'PUT',
                    url: '/admin/role/permission/<?php echo $id?>',
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                    // using the done promise callback
                        .done(function (data) {
                            alert(data.msg);
                            //$('#msg').addClass('alert', 'alert-success').html(data.msg);
                        })
                    // using the fail promise callback
                        .fail(function (data) {
                            alert(data.responseJSON.name[0])
                            //$('#msg').addClass('alert', 'alert-success').html(data.responseJSON.name[0]);
                        });
                event.preventDefault();
            })
        });

        function jqchk(){ //jquery获取复选框值
            var chk_value =[];
            $('input[name="permission"]:checked').each(function(){
                chk_value.push($(this).val());
            });
            return chk_value;
        }

    </script>
@endsection
