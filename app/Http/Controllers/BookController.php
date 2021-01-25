<?php

namespace App\Http\Controllers;

use App\Book;
use App\Exports\BookExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use function Symfony\Component\String\b;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::paginate(5);
        return view('book.index',compact('data'));
    }

    public function isshowupdate(Request $request){
        //思路
        //增加一列字段 is_show，点击获取书籍id和当前状态  根据当前书籍id 更改 相反的状态。
       if ($request->get('is_show') == 1){
            Book::where('id',$request->get('id'))->update(['is_show'=>'0']);
       }else{
           Book::where('id',$request->get('id'))->update(['is_show'=>'1']);
       }
       return redirect(route('book.index'));
    }

    /**
     * 导出excel
     */
    public function excel(){
        // 思路
        //使用 excel的扩展，使用excel类中的download方法下载
        return Excel::download(new BookExport(),'图书.xlsx');
    }

    public function homeindex(){
       $data =   Book::where('is_show',1)->get();
       return view('home.index',compact('data'));
    }

    public function homeprice(){
        $data = Book::where('is_show',1)->orderBy('price','desc')->get();
        return view('home.index',compact('data'));
    }

    public function hometime(){
        $data = Book::where('is_show',1)->orderBy('created_at','desc')->get();
        return view('home.index',compact('data'));
    }
    public function homepic(){
        $data = Book::where('is_show',1)->get();
        return view('home.pic',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * 异步上传图片
     */
    public function upload(Request $request)
    {
            $dat = $request->all();//接收所有的
            $file = $request->file("file");//接前台图片
            $fil = $file->getClientOriginalName();//图片路径
            $data = $file->move("uploads/book", $fil);//移动至框架图片文件夹
                  $ret =   '/uploads/book/'.$fil;
            return ['code'=>200,'path'=>$ret];

    }

    /**
     * 验证图书名称唯一性
     */
    public function unique(Request $request)
    {
        //思路
        //采用jquery的失焦时间发送ajax 去数据表里查询是否有相同的图书名称。有代表重复，无代表不重复
        if (empty($request->get('bookname'))){
            return ['code'=>500,'msg'=>'图书名称不能为空'];
        }
       $res =  Book::where('book_name',$request->get('bookname'))->first();
       if ($res){
           return ['code'=>500,'msg'=>'图书名称重复'];
       }else{
           return ['code'=>200,'msg'=>'验证通过'];
       }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $postData = $request->except(['_token','file']);
       if (empty($postData['pic'])){
           $postData['pic'] = 'uploads/book/111.jpeg';
       }
      if ( Book::create($postData)){
          return redirect(route('book.index'));
      }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
