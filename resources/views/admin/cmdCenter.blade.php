@extends('_layouts.admin')

@section('content')
        <div class="page-content">
            <div class="page-header">
                <div class="alert alert-block alert-success">
                    <i class="ace-icon fa fa-check green"></i>

                    <?php echo $title ?>
                    <span id="msg" style="padding-left: 10px; "></span>

                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                        <div class="form-group">
                            <label for="device_mac" class="col-sm-2 control-label">设备Mac</label>
                            <div class="col-xs-12 col-sm-6">
                                <input type="text" name="device_mac" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">命令</label>
                            <div class="col-xs-12 col-sm-6">
                                <textarea class="form-control" rows="4" name="message" id="message" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary"  type="submit" id="editSubmit">
                                <i class="ace-icon fa fa-check"></i>确定
                            </button>
                        </div>
                    </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->

@endsection
@section('user_js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#myform').submit(function(event) {
        var formData = {
            'device_mac':$('input[name=device_mac]').val(),
            'message':$("#message").val()
        };
        // process the form
        $.ajax({
            type : 'POST',
            url  : 'cmd',
            data : formData, // our data object
            dataType : 'json', // what type of data do we expect back from the server
            encode : true
        })
        .done(function(data) {
            $('#msg').html(data.msg).fadeIn(100).fadeOut(2000);
        })
        .fail(function(data) {
            $('#msg').html(data.responseJSON.name[0]).fadeIn(100).fadeOut(2000);
        });
        event.preventDefault();
    });
</script>
@endsection