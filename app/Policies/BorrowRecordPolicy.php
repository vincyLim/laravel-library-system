<?php

namespace App\Policies;

use App\Models\BorrowRecord;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BorrowRecordPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->permissions->contains('name', 'viewAny-borrow-record');
    }

    public function view(User $user, BorrowRecord $borrowRecord)
    {
        return $borrowRecord->user_id === $user->id;
    }

    public function approve_borrow_and_return_book(User $user)
    {
        return $user->permissions->contains('name', 'approve-borrow-and-return-book');
    }

    public function delete(User $user, BorrowRecord $borrowRecord)
    {
        return $borrowRecord->user_id == $user->id && $borrowRecord->isRequested();
    }
}