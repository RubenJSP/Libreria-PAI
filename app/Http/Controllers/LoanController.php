<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans =Loan::with('users','books.Category')->get();
        return view('vistaAqui',compact('loans'));
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
     * Return the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $loans = DB::table('loans')
        ->select('loan_date as date', DB::raw('count(*) as loans'))
        ->groupBy('loan_date')
        ->get();
        $returns = DB::table('loans')
        ->select('loan_date as date', DB::raw('count(*) as returned'))->where('state',"=",0)
        ->groupBy('loan_date')
        ->get();
        return Response::json(array(
            'loans' => $loans,
            'returns' => $returns,
        ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar los datos del request
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);
        //En caso de no ser válidos, se regresa con una respuesta de error
        if ($validator->fails()) {
            return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
        } 
        //Se verifica que el libro solicitado existe
        if(Book::find($request['id'])){
            $user_id = Auth::user()->id;
            $loan = new Loan();
            $loan->user_id = $user_id;
            $loan->book_id = $request['id'];
            $loan->state = true;
            $loan->save();
            return  redirect()->back()->with('success', 'Loan has been completed');
        }
        return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
              //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric',
            ]);
            //En caso de no ser válidos, se regresa con una respuesta de error
            if ($validator->fails()) {
                return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
            } 
            $loan = Loan::find($request['id']);
            if($loan->Update(['state' => 0]))
                return  redirect()->back()->with('success', 'Thank you!, you have returned the book');

            return redirect()->back()->with('error', 'Sorry, book not returned, please try again'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        if($loan){
            if($loan->delete()){
                return response()->json([
                    'message' => 'Loan deleted successfully', 
                    'code' => '200'
                ]);
            }
            return response()->json([
                    'message' => "Sorry, coudn't delete loan", 
                    'code' => '400'
                ]);
        }
    }
}
