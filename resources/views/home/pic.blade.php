<style>
    .div{
        float: left;
        margin: 30px 30px;
    }
</style>

@foreach($data as $val)
<div class="div">
    <img src="http://books.bawei.com/{{$val->pic}}" alt=""style="width: 100px;height: 100px">
</div>
@endforeach
