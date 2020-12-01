<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Auth;
use Response;
class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo('view loans')){
            $query = '';
            if(Auth::user()->role_id == 1) //Si es administrador
                $query = Loan::with('users','books.Category')
                ->orderBy('state','DESC') //Ordernar por estado (No devuelto a devuelto)
                ->orderBy('loan_date','DESC')->paginate(10); //Y ordenar por fecha (Actual a antiguos)
            else //Si es cliente
                $query =Loan::with('users','books.Category')
                ->where('user_id',Auth::user()->id)
                ->orderBy('state','DESC')
                ->orderBy('loan_date','DESC')->paginate(10);

                $loans = $query;
                foreach($query as $index=>$loan){
                    if(Carbon::now()->gt(Carbon::parse($loan->return_date)))
                        $loans[$index]['on_time'] = "0";
                }
                if(Auth::user()->role_id == 1)
                    return view('loans.admin',compact('loans'));
                else
                    return view('loans.index',compact('loans'));
        }
        return redirect()->back()->with("error","You don't have permissions");  
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
        if(Auth::user()->hasPermissionTo('view dashboard')){
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
        return redirect()->back()->with("error","You don't have permissions"); 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo('create loans')){
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
                $loan->state = 1;
                $loan->save();
                return  redirect()->back()->with('success', 'Loan has been completed');
            }
            return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
        }
        return redirect()->back()->with("error","You don't have permissions"); 
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::user()->hasPermissionTo('edit loans')){
              //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric',
            ]);
            //En caso de no ser válidos, se regresa con una respuesta de error
            if ($validator->fails()) {
                return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
            } 
            $loan = Loan::find($request['id']);
            $data = ['state' => 0,
                    'return_date' => Carbon::now()];
            if($loan->Update($data)){
                return  redirect()->back()->with('success', 'Thank you!, you have returned the book');
            }
            return redirect()->back()->with('error', 'Sorry, book not returned, please try again'); 
        }
        return redirect()->back()->with("error","You don't have permissions");  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        if(Auth::user()->hasPermissionTo('delete loans')){
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
        return redirect()->back()->with("error","You don't have permissions");  
    }
}
