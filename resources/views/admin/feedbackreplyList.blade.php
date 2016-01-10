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

            <div class="col-sm-6" style="width: 80%;margin-left: 10%;">
                <div class="widget-box">
                    <div class="widget-header">
                        {{--<h4 class="widget-title lighter smaller">--}}
                            {{--<i class="ace-icon fa fa-comment blue"></i>--}}
                            {{--回复--}}
                        {{--</h4>--}}
                    </div>
                    <div class="widget-body">
                        <div class="profile-user-info profile-user-info-striped">
                            <div class="">
                                <div class="profile-info-name"> 主题 </div>
                                <div class="profile-info-value">
                                    <span id="title" class="editable">{{$list->title}}</span>
                                </div>
                            </div>
                            <div class="" style="width:40%;float:left;">
                                <div class="profile-info-name"> 添加时间 </div>
                                <div class="profile-info-value">
                                    <span id="addtime" class="editable">{{date('Y-m-d',$list->addtime)}}</span>
                                </div>
                            </div>
                            <div class="" style="width:40%;float:left;">
                                <div class="profile-info-name"> 状态 </div>
                                <div class="profile-info-value">
                                    <span id="age" class="editable"><?php echo $status[$list->status]; ?></span>
                                </div>
                            </div>

                            <div class="" style="width:20%;float:right;">
                                <div class="profile-info-value">
                                    @if($list->status == 4)
                                        <input class="btn btn-xs btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="{{ $list->id }}" type="button" value="重新打开反馈">
                                    @else
                                        <input class="btn btn-xs btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="{{ $list->id }}" type="button" value="关闭该反馈">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->

            <div id="delConfirmModal" class="modal fade bs-example-modal-sm" role="dialog" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">消息</h4>
                        </div>
                        <div class="modal-body" id="delMsg">
                        @if($list->status == 4)
                            确定要重新开启么？
                        @else
                            确定要关闭么?
                        @endif
                        </div>
                        <input type="hidden" id="modal-cont" value=''>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id = "deleteCancel">关闭</button>
                            <button type="button" class="btn btn-primary" id="deleteIt">确定</button>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <div class="col-sm-6" style="width: 80%;margin-left: 10%;">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-comment blue"></i>
                            回复
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <!-- #section:pages/dashboard.conversations -->

                            <div class="dialogs">
                                <div class="itemdiv">
                                    <div class="body" style="margin-left: 10px;">
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o"></i>
                                            <span class="green">{{date('Y-m-d H:i:s',$list->addtime)}}</span>
                                        </div>

                                        <div class="name">
                                            {{$list->user_name}}
                                        </div>
                                        <div class="text">{{$list->content}}</div>

                                    </div>
                                </div>
                            @foreach($reply as $row)
                                <div class="itemdiv">
                                    <div class="body" style="margin-left: 10px;">
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o"></i>
                                            <span class="green">{{date('Y-m-d H:i:d',$row->addtime)}}</span>
                                        </div>

                                        <div class="name">
                                            {{$row->user_name}}
                                        </div>
                                        <div class="text">{{$row->content}}</div>

                                    </div>
                                </div>
                            @endforeach
                            <!-- /section:pages/dashboard.conversations -->
                                @if($list->status != 4)
                                <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                                    <div class="form-actions">
                                        <div class="input-group">
                                            <input type="hidden" name="name" value="{{ Auth::user()->name }}管理员" />
                                            <input type="hidden" name="id" value="{{ $list->id }}" />
                                            <input placeholder="Type your message here ..." type="text" class="form-control" name="content" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm btn-info no-radius" type="submit" id="editSubmit">
                                                    <i class="ace-icon fa fa-share"></i>
                                                    Send
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="msg"></div>
                                </form>
                                @else
                                    <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                                        <div class="form-actions">
                                            <div class="input-group">
                                                该反馈以关闭，不再提供回复功能。
                                            </div>
                                        </div>
                                        <div id="msg"></div>
                                    </form>
                                @endif
                            </div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
@section('user_js')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var formData = {
                    'name':$('input[name=name]').val(),
                    'fid':$('input[name=id]').val(),
                    'content':$('input[name=content]').val()
                };
                // process the form
                $.ajax({
                    type : 'post',
                    url  : '/admin/feedback/reply',
                    data : formData, // our data object
                    dataType : 'json', // what type of data do we expect back from the server
                    encode : true
                })
                    // using the done promise callback
                        .done(function(data) {
                            $('#msg').addClass('alert','alert-success').html(data.msg);
                            setTimeout(reload,500);
                        })
                    // using the fail promise callback
                        .fail(function(data) {
                            $('#msg').addClass('alert','alert-success').html('格式不正确');
                            setTimeout(clear,1000);
                            event.preventDefault();
                        });
                event.preventDefault();
            })
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
                type : "get",
                url : "/admin/close/" + id,
                dataType:"json",
                success:function(data){
                    if (data.msg == 200){
                        $('#delMsg').html('您已经成功关闭该反馈')
                    }
                    if (data.msg == 201){
                        $('#delMsg').html('您已经成功重启该反馈')
                    }
                    setTimeout(reload,500);
                }
            })

        });

        $('#delConfirmModal').on('hide.bs.modal', function () {
            window.location.reload();
        });

        function clear(){
            $("#msg").empty();
        }

        function reload(){
            window.location.reload();
        }
    </script>

@endsection
