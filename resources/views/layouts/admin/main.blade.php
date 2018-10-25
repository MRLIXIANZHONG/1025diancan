<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield("title","博客")</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>
<body>
{{--引入页头--}}
@include("layouts.user._header")

<div class="container container-fluid">
    {{--错误提示--}}
@include("layouts.user._error")
    {{--操作提示--}}
    @include("layouts.user._msg")
    {{--定一个内容标记--}}
    @yield("content")
</div>

{{--@include("layouts._footer")--}}
{{--引入页脚--}}





<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>


<script type="text/javascript">

    {{--//浏览商品加1--}}
        {{--function show() {--}}

                {{--var data =$('#brow').val();--}}
                {{--var id =$('#id').val();--}}
                {{--data =Number(data);--}}
                {{--data +=1;--}}
                {{--//console.dir(data);--}}
            {{--$.post('/brow',{'_token':'{{csrf_token()}}','browse':data,'id':id},function (value) {--}}
                {{--console.dir(value);--}}
            {{--});--}}

        {{--}--}}
//找到id
    function show(id){

        //找到模态框按钮
        $('.xxx').attr('href','/brow/'+id);

       //找到所有表单隐藏域
        var input = $("input").filter(":hidden");
        //console.dir(input);
        $.each(input,function (k,v) {
            if(v.id == id){
                //找到p
                $("#contents").text(v.defaultValue
                );
            }
        })

    }




</script>

</body>
</html>