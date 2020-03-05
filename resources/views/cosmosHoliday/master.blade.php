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






{{--    chosen start--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">--}}
{{--    chosen end--}}





    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-skins.min.css" />
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/chosen.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('cosmosHoliday/new-assets/')}}/css/ace-ie.min.css" />

    <![endif]-->




    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{asset('cosmosHoliday/new-assets/')}}/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{asset('cosmosHoliday/new-assets/')}}/js/html5shiv.min.js"></script>
    <script src="{{asset('cosmosHoliday/new-assets/')}}/js/respond.min.js"></script>



    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <![endif]-->
</head>

<body class="no-skin">
<div id="app">
    @include('cosmosHoliday.includes.header')
    <div class="main-container ace-save-state" id="main-container">
{{--        <script type="text/javascript">--}}
{{--            try{ace.settings.loadState('main-container')}catch(e){}--}}
{{--        </script>--}}

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




<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('cosmosHoliday/new-assets/')}}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/jquery.dataTables.bootstrap.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/dataTables.buttons.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/buttons.flash.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/buttons.html5.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/buttons.print.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/buttons.colVis.min.js"></script>--}}
{{--<script src="{{asset('cosmosHoliday/new-assets/')}}/js/dataTables.select.min.js"></script>--}}

<!-- ace scripts -->
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/ace-elements.min.js"></script>
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/ace.min.js"></script>
<script src="{{asset('cosmosHoliday/new-assets/')}}/js/chosen.jquery.min.js"></script>
<script src="{{asset('/js/app.js')}}"></script>

<!-- inline scripts related to this page -->



<script>
    var date = new Date();
    document.getElementById("year").innerHTML = date.getFullYear();
</script>
<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("myDiv");
    var btns = header.getElementsByClassName("btn_cos");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>

</body>
</html>
