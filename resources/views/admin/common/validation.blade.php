@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="Huialert Huialert-danger"><i class="Hui-iconfont">&#xe6a6;</i> {{$error}}</div>
    @endforeach
@endif