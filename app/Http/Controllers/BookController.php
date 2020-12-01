<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Auth;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookData = Book::paginate(10);
        //$loans =Loan::where('state',1)->with('users','books.Category')->get();
        $loans = Loan::with('books')->where('state',1)->get();
        $books = $bookData;
        $categories = Category::all();
        foreach($bookData as $index=>$bookdata){
            $books[$index]['status'] = "0";
            foreach($loans as $loan){ 
               if($bookdata->id == $loan->books->id)
                    $books[$index]['status'] = "1";
           }
        }
        //return view('info',compact('books','categories','loans'));
        //dd($books);
        if(Auth::user()->role_id == 1)
            return view('books.admin',compact('books','categories'));
        else
            return view('books.index',compact('books','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo('create books')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
              'title'=>'required|max:255',
              'description'=>'required',
              'year'=>'required|numeric',
              'pages'=>'required|numeric',
              'isbn'=>'required|unique:books',
              'editorial'=>'required',
              'edition'=>'required|numeric',
              'autor'=>'required',
              'cover'=>'mimes:jpeg,jpg,png,gif',
              'category_id' => 'required',
          ]);
          //En caso de no ser válidos, se regresa con una respuesta de error
          if ($validator->fails()) {
              return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
          } 
          if($book = Book::create($request->all())){
              if ($request->hasFile('cover')) {
                  $file = $request->file('cover');
                  $fileName = 'book_cover'.$book->id.'.'.$file->getClientOriginalExtension();
                  $path = $request->file('cover')->storeAs('img/books',$fileName);
                  $book->cover = $fileName;
                  $book->save();
              }
              return  redirect()->back()->with('success', 'Book created successfully');
          }
          return  redirect()->back()->with('error', "Sorry, couldn't create book");
        }
        return redirect()->back()->with("error","You don't have permissions"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        if(Auth::user()->hasPermissionTo('edit books')){
            $loans = Loan::with('users','books')->where('book_id',$book->id)->orderBy('loan_date','DESC')->paginate(15);
            $book = Book::with('Category')->where('id',$book->id)->get();
            return view('books.details',compact('book','loans'));
        }
        return redirect()->back()->with("error","You don't have permissions"); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    { 
        if(Auth::user()->hasPermissionTo('edit books')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
               'id' => 'required|numeric',
               'title'=>'required|max:255',
               'description'=>'required',
               'year'=>'required|numeric',
               'pages'=>'required|numeric',
               'isbn'=>'required',
               'editorial'=>'required',
               'edition'=>'required|numeric',
               'autor'=>'required',
               'cover'=>'mimes:jpeg,jpg,png,gif',
               'category_id' => 'required',
           ]);
           //En caso de no ser válidos, se regresa con una respuesta de error
           if ($validator->fails()) {
               dd($validator);
               return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
           } 
           $book = Book::find($request['id']);
           if($book->Update($request->all())){
               if ($request->hasFile('cover')) {
                   $file = $request->file('cover');
                   $fileName = 'book_cover'.$book->id.'.'.$file->getClientOriginalExtension();
                   $path = $request->file('cover')->storeAs('img/books',$fileName);
                   $book->cover = $fileName;
                   $book->save();
               }
               return  redirect()->back()->with('success', 'The book has been updated');
           }
           return redirect()->back()->with('error', 'Sorry, book not updated, try again'); 
         }
         return redirect()->back()->with("error","You don't have permissions");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if(Auth::user()->hasPermissionTo('delete books')){
            if($book){
                //Se elimian TODOS los préstamos ligados al libro
                Loan::where('book_id',$book->id)->delete();
                //Se elimina el libro 
                if($book->delete()){
                    return response()->json([
                        'message' => 'Book deleted successfully', 
                        'code' => '200'
                    ]);
                }
                return response()->json([
                        'message' => "Sorry, coudn't delete the book", 
                        'code' => '400'
                    ]);
            }
        }
        return response()->json([
            'message' => "You don't have permissions", 
            'code' => '403'
        ]);
    }
    
}
