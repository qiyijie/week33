<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 悬停表格</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-hover">
    <caption>后台图书展示</caption>
    <caption>
        <a href="{{route('book.excel')}}">导出excel</a>
    </caption>
    <captain>
        <a href="{{route('book.homeindex')}}">去前台查看</a>
    </captain>
    <thead>
    <tr>
        <th>ID</th>
        <th>图书名称</th>
        <th>作者</th>
        <th>价格</th>
        <th>是否上下架</th>
        <th>封面</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $val)
    <tr>
        <td>{{$val->id}}</td>
        <td>{{$val->book_name}}</td>
        <td>{{$val->author}}</td>
        <td>{{$val->price}}</td>
        <td>
            @if($val->is_show == 1)
                <a href="{{route('book.isshowupdate',['is_show'=>$val->is_show,'id'=>$val->id])}}" where="{{$val->id}}">上架</a>
            @else
                <a href="{{route('book.isshowupdate',['is_show'=>$val->is_show,'id'=>$val->id])}}" where="{{$val->id}}">下架</a>
                @endif
        </td>
        <td>
            <img src="http://books.bawei.com/{{$val->pic}}" alt="" style="width: 100px;height: 100px">
        </td>

    </tr>
    @endforeach
    </tbody>
</table>
{{$data->links()}}
</body>
</html>
