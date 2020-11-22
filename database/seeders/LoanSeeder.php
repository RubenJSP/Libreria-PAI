<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan = new Loan();
        $loan->user_id = 1;
        $loan->book_id = 1;
        $loan->save();

        $loan = new Loan();
        $loan->user_id = 2;
        $loan->book_id = 2;
        $loan->save();
    }
}
