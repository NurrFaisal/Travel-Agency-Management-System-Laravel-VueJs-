<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Cosmos Holiday</title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .chosen-container{
            width: 100%!important;
        }
        .chosen-single{
            background: #dff0d8!important;
        }
    </style>
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-- page specific plugin styles -->

    <!-- text fonts -->

    <!-- ace styles -->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-skins.min.css" />
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-rtl.min.css" />
{{--    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/chosen.min.css" />--}}

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-ie.min.css" />

    <![endif]-->




    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{asset('cosmosHoliday/new-assets/')}}/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
{{--    <script src="{{asset('cosmosHoliday/new-assets/')}}/js/html5shiv.min.js"></script>--}}
{{--    <script src="{{asset('cosmosHoliday/new-assets/')}}/js/respond.min.js"></script>--}}



    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <![endif]-->
</head>

<body class="no-skin">
<div id="app">
    @include('cosmosHoliday.includes.header')
    <div class="main-container ace-save-state" id="main-container">
        @include('cosmosHoliday.includes.sidebar')

        <div class="main-content">
            <admin-master></admin-master>
        </div><!-- /.main-content -->

        @include('cosmosHoliday.includes.footer')

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->
</div>


<script src="{{asset('cosmosHoliday/new-assets/')}}/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('cosmosHoliday/new-assets/')}}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/bootstrap.min.js"></script>

{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/chosen.jquery.min.js"></script>--}}
<script src="{{asset('/js/app.js')}}"></script>

<!-- inline scripts related to this page -->


<script type="text/javascript">

</script>
<script>
    var date = new Date();
    document.getElementById("year").innerHTML = date.getFullYear();
</script>

</body>
</html>
