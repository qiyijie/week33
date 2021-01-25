<!DOCTYPE html>
<html>
<head>
    <title>后台新书添加</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <!--SWF在初始化的时候指定，在后面将展示-->
</head>
<body>

<div class="container">
    <h2>添加新书</h2>
    <form action="{{route('book.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">图书名称:</label>
            <input type="text" class="form-control" id="bookname" name="book_name">
            <span id="span"></span>
        </div>
        <div class="form-group">
            <label for="email">作者:</label>
            <input type="text" class="form-control" id="email" name="author">
        </div>
        <div class="form-group">
            <label for="email">价格:</label>
            <input type="text" class="form-control" id="email" name="price">
        </div>
        <div class="form-group">
            <label for="email">图片:</label>
            <div id="pic">选择文件</div>
            <img  alt="" width="100" height="100" id="img">
            <input type="hidden" value="" name="pic" id="pic">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
<script>
    $(function () {
       var uploader = WebUploader.create({

            // 自动上传。
            auto: true,

            // swf文件路径
            swf:  'webuploader/Uploader.swf',

            // 文件接收服务端。
            server: 'http://books.bawei.com/index.php/upload',

            // [默认值：'file']  设置文件上传域的name。
            fileVal:'file',
            formData:{
                _token: '{{csrf_token()}}',
            },
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#pic',

            //   图片压缩配置参数列表
            compress:{
                width: 100,
                height: 100,

                // 图片质量，只有type为`image/jpeg`的时候才有效。
                quality: 100,

                // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
                allowMagnify: false,

                // 是否允许裁剪。
                crop: false,

                // 是否保留头部meta信息。
                preserveHeaders: true,

                // 如果发现压缩后文件大小比原来还大，则使用原来图片
                // 此属性可能会影响图片自动纠正功能
                noCompressIfLarger: false,

                // 单位字节，如果图片大小小于此值，不会采用压缩。
                compressSize: 0
            },

            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'jpeg,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'uploadSuccess', function( file,result ) {
            // console.log();
            // return false;
            // 图片显示出来
           $('#img').attr('src',result.path);
           // 图片 放到隐藏域中
            $('#pic').val(result.path);

        });
        $('#bookname').blur(function () {
           var name = $(this).val();
           $.ajax({
               url:'http://books.bawei.com/index.php/unique?bookname='+ name,
               type:'get',
               success:function (result) {
                    $('#span').html(result.msg);
               }
           })
        })
    })


</script>
