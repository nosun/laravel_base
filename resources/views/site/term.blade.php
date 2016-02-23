@extends('_layouts.admin')
@section('user_css')
    <style>
        #tool_tab .nav{
            height:35px;
        }
        #tool_tab .tab-content{
            min-height:80px;
        }

    </style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="tabbable" id="tool_tab">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#home" aria-expanded="true">
                        <i class="green ace-icon fa fa-home bigger-120"></i>
                        TermInfo
                    </a>
                </li>

                <li class="">
                    <a data-toggle="tab" href="#messages" aria-expanded="false">
                        ProductInfo
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade active in" style="padding:20px;">
                    <div class="row" style="height:60px;margin-bottom:20px">
                        <form action="javascript:void(0)" >
                            <div class="col-xs-6">
                                <label for="form-field-mask-1">
                                    Url:
                                    <small class="text-success">http://www.newadoringdress.com/plus-size-wedding-dresses.html</small>
                                </label>
                                <!-- #section:plugins/input.masked-input -->
                                <div class="input-group">
                                    <input class="form-control input-mask-date" type="text" name="url" id="termUrl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-blue" type="button" id="termSearch">
                                            Search It!
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="messages" class="tab-pane fade">
                    <div class="row" style="height:60px;margin-bottom:20px">
                        <form action="javascript:void(0)" >
                            <div class="col-xs-6">
                                <label for="form-field-mask-1">
                                    Url:
                                    <small class="text-success">http://www.newadoringdress.com/es/Exquisito-mangas-blusa-acanalada-gasa-falda-con-abalorios-correas-y-cintura-pZP_311773.html</small>
                                </label>
                                <!-- #section:plugins/input.masked-input -->
                                <div class="input-group">
                                    <input class="form-control input-mask-date" type="text" name="url" id="productUrl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-blue" type="button" id="productSearch">
                                            Search It!
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10">
                    <h3>Result</h3>
                    <div class="col-xs-12 well" id="msgWall">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('user_js')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#myTab li").on('click',function(){
        $("#msgWall").html('');
    });

    $("#termSearch").on('click',function(e){
        var formData ={
            url:$('#termUrl').val()
        };

        $.ajax({
            type : "post",
            url : "/site/searchTerm/",
            dataType:"json",
            data: formData,
            success:function(data){
                var result = JSON.stringify(data, null, 4);
                $("#msgWall").html($("<pre>").text(result));
            }
        })
    });

    $("#productSearch").on('click',function(e){
        var formData ={
            url:$('#productUrl').val()
        };

        $.ajax({
            type : "post",
            url : "/site/searchProductByUrl/",
            dataType:"json",
            data: formData,
            success:function(data){
                var result = JSON.stringify(data, null, 4);
                $("#msgWall").html($("<pre>").text(result));
            }
        })
    });

</script>

@endsection
