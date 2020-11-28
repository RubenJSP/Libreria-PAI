<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use Carbon\Carbon;
class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) { 
            $loans = rand(1,7);
            $loan_date = Carbon::create(rand(2017,2020),rand(1,12),rand(1,20));
            for ($j=0; $j < $loans; $j++) {    
                $loan = new Loan();
                $loan->user_id = 1;   
                $loan->book_id = rand(1,2);
                $loan->loan_date = Carbon::parse($loan_date);
                $loan->return_date = Carbon::parse($loan->loan_date)->addDays(3);
                $loan->state = 0;
                $loan->save();
            }
        }

        
    }
}
