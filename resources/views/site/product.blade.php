@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
<div class="page-content">

    <div class="row">
        <ul>
            <li>product url find pid</li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>

        </ul>

    </div>
</div>

@endsection
@section('user_js')
    @if(!isset($list[0]) && isset($_GET['searchproname']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/site/product";
            });
        </script>
    @endif
    <script src="../assets/js/date-time/bootstrap-datepicker.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
@endsection
