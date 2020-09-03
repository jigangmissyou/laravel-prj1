<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/pagination.css" />
    <title>用户列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
        <input type="text" name="" id="" placeholder=" 用户名" style="width:250px" class="input-text">
        <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="javascript:;" onclick="delAll()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" href="{{route('admin.user.create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="40"><input name="" type="checkbox" value=""></th>
                <th width="20">ID</th>
                <th width="100">正式名称</th>
                <th width="80">用户名</th>
                <th width="20">性别</th>
                <th width="150">手机</th>
                <th width="150">邮箱</th>
                <th width="60">加入时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
            <tr class="text-c">
                <td><input name="id[]" type="checkbox" value="{{$item->id}}"></td>
                <td>{{$item->id}}</td>
                <td>{{$item->truename}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->sex}}</td>
                <td class="text-c">{{$item->phone}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->created_at}}</td>
                <td class="td-manage">
                    @if(auth()->user()->deleted_at > 0 )
                        <a style="text-decoration:none" onClick="userRestore()" href="javascript:;" title="恢复"><i class="Hui-iconfont">&#xe6de;</i></a>
                    @else
                        <a style="text-decoration:none" class="ml-5 delUser" href="{{route('admin.user.del',['id'=>$item->id])}}" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    @endif
                    <a style="text-decoration:none" onClick="userEdit()" href="{{route('admin.user.edit',['id'=>$item->id])}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a></td>
            </tr>
                 @endforeach>
            </tbody>
        </table>
        {{$data->links()}}
    </div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    const _token = "{{ csrf_token() }}";
    $('.delUser').click(function(){
        layer.confirm('确认要删除吗？',()=>{
            const url = $(this).attr('href');
            $.ajax({
                url,
                data: {
                    '_token': _token
                },
                type: 'DELETE',
                dataType: 'json'
            }).then(({status,msg}) => {
                if(status == 0){
                    layer.msg(msg, {icon: 1, time: 2000}, ()=>{
                        location.reload();
                    })
                }else{
                    layer.alert(msg);
                }
            });
        });

       return false;

   });

    function delAll(){
        let ids = $('input[name="id[]"]:checked');
        let id = [];
        $.each(ids, (key, val)=>{
            id.push(val.value);
        });

        if(id.length > 0 ){
            $.ajax({
                url: '{{route('admin.user.delAll')}}',
                data:{
                    '_token': _token,
                    'id': id
                },
                type:'DELETE'
            }).then(({status, msg})=>{
                if(status == 0){
                    layer.msg(msg,{time:2000, icon: 1}, ()=>{
                        location.reload();
                    });
                }else{
                    layer.alert(msg);
                }
            })
        }

    }

    /*图片-添加*/
    function picture_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*图片-查看*/
    function picture_show(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*图片-审核*/
    function picture_shenhe(obj,id){
        layer.confirm('审核文章？', {
                btn: ['通过','不通过'],
                shade: false
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布', {icon:6,time:1000});
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                $(obj).remove();
                layer.msg('未通过', {icon:5,time:1000});
            });
    }

    /*图片-下架*/
    function picture_stop(obj,id){
        layer.confirm('确认要下架吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!',{icon: 5,time:1000});
        });
    }

    /*图片-发布*/
    function picture_start(obj,id){
        layer.confirm('确认要发布吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!',{icon: 6,time:1000});
        });
    }

    /*图片-申请上线*/
    function picture_shenqing(obj,id){
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
    }

    /*图片-编辑*/
    function picture_edit(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*图片-删除*/
    function picture_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
</body>
</html>