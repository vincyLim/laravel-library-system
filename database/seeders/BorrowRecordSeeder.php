<?php

namespace Database\Seeders;

use App\Models\BorrowRecord;
use App\Models\Penalty;
use App\Models\User;
use Illuminate\Database\Seeder;

class BorrowRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $librarianId = User::whereHas("role", function ($query) {
            $query->where("name", "Librarian");
        })->first()->id;

        /* BorrowRecord::create(
            [
                'user_id' => 1,
                'book_id' => 1,
                'librarian_id' => $librarianId,
                'start_date' => null,
                'end_date' => null,
                'return_date' => null,
            ]
        )->each(function ($borrowRecord) {
            $borrowRecord->book->update([
                'status' => 'requested',
            ]);
        }); */

        $borrowingRecord = BorrowRecord::create(
            [
                'user_id' => 1,
                'book_id' => 2,
                'librarian_id' => $librarianId,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'return_date' => null,
            ]
        );
        
        $borrowingRecord->book->update(['status' => 'borrowed']);

        $returnedRecord = BorrowRecord::create(
            [
            'user_id' => 1,
            'book_id' => 3,
            'librarian_id' => $librarianId,
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'return_date' => now()->addDays(5),
            'return_librarian_id' => User::whereHas("role", function ($query) {
                    $query->where("name", "Librarian");
                })->first()->id,
            ]
        );

        $returnedRecord->book->update(['status' => 'available']);

        tap(BorrowRecord::create([
            'user_id' => 1,
            'book_id' => 4,
            'librarian_id' => $librarianId,
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'return_date' => now()->addDays(10),
            'return_librarian_id' => $librarianId,
        ]), function ($borrowRecord) {
            // Simulate return logic
            $borrowRecord->book->update([
                'status' => 'available',
            ]);
    
            // Create penalty only for this one
            Penalty::create([
                'borrow_record_id' => $borrowRecord->id,
                'amount' => 15, // 3 days late
                'status' => 'unpaid',
            ]);
        });

        tap(BorrowRecord::create([
            'user_id' => 1,
            'book_id' => 5,
            'librarian_id' => $librarianId,
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'return_date' => now()->addDays(10),
            'return_librarian_id' => $librarianId,
        ]), function ($borrowRecord) use ($librarianId) {
            // Update the book status
            $borrowRecord->book->update([
                'status' => 'available',
            ]);
    
            // Create a PAID penalty record
            Penalty::create([
                'borrow_record_id' => $borrowRecord->id,
                'amount' => 15, // 3 days late × 5 units
                'status' => 'paid',
                'pay_date' => $borrowRecord->return_date,
                'pay_method' => 'cash',
                'pay_librarian_id' => $librarianId,
            ]);
        });

    }
}
