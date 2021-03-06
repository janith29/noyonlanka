<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Book_author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Illuminate\Support\Facades\DB;
use File;

use App;
use DateTime;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Book_authors=Book_author::all();
        return view('admin.author.index', compact('Book_authors'));
    }
    public function searchauthor(Request $request)
    {
        $Book_authors = DB::table('book_author')
        ->where('id', $request['search'])
        ->orWhere('name', 'like', '%' . $request['search'] . '%')
        ->get();
        return view('admin.author.index', compact('Book_authors'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Book_author $Book_author)
    {
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 18;
            return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
        
            // or the same using Carbon:
            // return Carbon\Carbon::now()->diff(new Carbon\Carbon($value))->y >= $minAge;
        });
        $validatedData = [
            'author_name' => 'required|regex:/^[a-zA-Z .]+$/u|max:255',
            'birthday' => 'required|before:now|olderThan:18',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'author_image' => 'required|image',
            'author_address' => 'required'
        ];
        
        $customMessages = [
             'birthday.older_than'=> 'Age older than 18',
             'contact.required' => 'Contact number is require',
            'author_name.required' => 'Name is require',
            'author_image.required' => 'Member Picture is require',
            'author_address.required' => 'Author address is require'
        ];

        $this->validate($request, $validatedData, $customMessages);
        $pic_name="panding";
        $file=$request ->file('author_image');

        $authorVals = DB::select('select * from book_author ORDER BY id DESC LIMIT 1');
        $type=$file->guessExtension();
        $lastid = 0;
        

        foreach($authorVals as $authorVal)
        {
            $lastid=$authorVal->id;
        }
        $lastid=$lastid+1;
        $pic_name=$lastid."author.".$type;
        $file->move('image/author/pic',$pic_name);

       $Book_author->name = $request->get('author_name');
       $Book_author->birthday = $request->get('birthday');
       $Book_author->address = $request->get('author_address');
       $Book_author->pic = $pic_name;
       $Book_author->email = $request->get('email');
       $Book_author->contact = $request->get('contact');
       $Book_author->save();
       
       return view('admin.author.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book_author $Book_author)
    {
        
        return view('admin.author.show',['Book_authors' => $Book_author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book_author $Book_author)
    {
        return view('admin.author.edit',['Book_authors' => $Book_author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book_author $Book_author)
    { 
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 18;
            return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
        
            // or the same using Carbon:
            // return Carbon\Carbon::now()->diff(new Carbon\Carbon($value))->y >= $minAge;
        });
        $validatedData = [
            'name' => 'required|regex:/^[a-zA-Z .]+$/u|max:255',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
        
        $customMessages = [
             'contact.required' => 'Contact number is require',
            'name.required' => 'Name is require',
        ];

        $this->validate($request, $validatedData, $customMessages);
        $name=NULL;
        $birthday=NULL;
        $address=NULL;
        $email=NULL;
        $contact=NULL;
        $file="panding";
        $lastid= "panding";

        $book_authorS = DB::select('select * from book_author where id ='.$request['id']);
        foreach($book_authorS as $book_author)
        {
        $name=$book_author->name;
        $birthday=$book_author->birthday;
        $address=$book_author->address;
        $email=$book_author->email;
        $contact=$book_author->contact;
        $file=$book_author->pic;
        $lastid= $book_author->id;
        }
        if ($request->hasFile('author_image'))
        {

            $filename= public_path().'/image/book/pic/'.$file;
            File::delete($filename);

            $file=$request ->file('author_image');

            $type=$file->guessExtension();
            $pic_name=$lastid."author.".$type;
            $file->move('image/author/pic',$pic_name);
    
          DB::table('book_author')
          ->where('id', $request['id'])
          ->update(['pic' => $pic_name,'name' =>$request->get('name'),'address' =>$request->get('author_address'),'email' =>$request->get('email'),'contact' =>$request->get('contact')]);
          return view('admin.author.success');
        }
        else if(($name==$request['name'] ) AND ($email==$request['email']) AND ($address==$request['author_address']) AND ($contact==$request['contact']) ) 
        {
        $message = 'Nothing to update';
        return redirect()->intended(route('admin.author.edit',[$request->id]))->with('message', $message);
        }
        else{
            DB::table('book_author')
            ->where('id', $request['id'])
            ->update(['name' =>$request->get('name'),'address' =>$request->get('author_address'),'email' =>$request->get('email'),'contact' =>$request->get('contact')]);
            return view('admin.author.success');
         
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book_author $Book_author)
    {
        return view('admin.author.delete',['Book_authors' => $Book_author]);
    }
    public function sedelete(Request $request)//Request $request, Employee $employee
    {
        DB::table('book_author')->where('id', $request['id'])->delete();
         return view('admin.author.success');
    }
}
