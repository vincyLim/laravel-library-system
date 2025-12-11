@extends('layout.main')

@section("content")
@push('style')
<style>

    .history-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #333;
    }

    .book-thumbnail {
        width: auto;
        height: 12em;
        background-color: #555;
        margin-right: 1rem;
        border-radius: 4px;
        object-fit: cover;
    }

    .history-details p {
        color: #bbb;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .content-wrapper {
        min-height: calc(100vh - 80px); /* Adjust the 80px based on your navbar height */
        display: flex;
        align-items: center;
        padding-top: 2rem; /* Ensures space after navbar */
        padding-bottom: 2rem;
    }
    .w-5{
        display: none
    }


    .pagination .page-item {
    margin: 0 5px; /* Add spacing between items */
    }

    .pagination .page-item .page-link {
        font-size: 14px; /* Adjust font size */
        color: #007bff; /* Default link color */
        border: 1px solid #ddd; /* Add border */
        border-radius: 4px; /* Rounded corners */
        padding: 0.5rem 0.75rem; /* Adjust padding */
        transition: all 0.3s ease; /* Smooth transition */
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff; /* Active background color */
        color: #fff; /* Active text color */
        border-color: #007bff; /* Active border color */
    }

    .pagination .page-item .page-link:hover {
        background-color: #f8f9fa; /* Hover background */
        color: #0056b3; /* Hover text color */
        border-color: #ddd; /* Hover border color */
    }

    .dashed-hr {
        border-top: 1px dashed #6c757d; /* same as Bootstrap's border-secondary */
        border-width: 1px;
        border-style: dashed;
        color: #6c757d;
    }
</style>
@endpush
<!-- Wrapper div for vertical centering -->
<div class="content-wrapper">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 mt-5 mt-lg-2">
            <div class="card history-card mb-5 mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>📚 Borrow History</h4>

                    <x-filter>
                        <form method="GET" action="{{-- {{ route('borrowHistory') }} --}}">
                            <div class="mb-3">
                                <label for="book_name" class="form-label">Book Name</label>
                                <input type="text" id="book_name" name="book_name" class="form-control" value="{{ request('book_name') }}" placeholder="Search by book title">
                            </div>
                            
                            {{-- <div class="mb-3">
                                <label class="form-label">Borrow Date Range</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="date" id="borrow_date_start" name="borrow_date_start" class="form-control" value="{{ request('borrow_date_start') }}" placeholder="From">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" id="borrow_date_end" name="borrow_date_end" class="form-control" value="{{ request('borrow_date_end') }}" placeholder="To">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Return Date Range</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="date" id="return_date_start" name="return_date_start" class="form-control" value="{{ request('return_date_start') }}" placeholder="From">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" id="return_date_end" name="return_date_end" class="form-control" value="{{ request('return_date_end') }}" placeholder="To">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Due Date Range</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="date" id="due_date_start" name="due_date_start" class="form-control" value="{{ request('due_date_start') }}" placeholder="From">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" id="due_date_end" name="due_date_end" class="form-control" value="{{ request('due_date_end') }}" placeholder="To">
                                    </div>
                                </div>
                            </div> --}}
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Filter by Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="">All</option>
                                    <option value="requesting" {{ request('status') == 'requesting' ? 'selected' : '' }}>Requesting</option>
                                    <option value="borrowing" {{ request('status') == 'borrowing' ? 'selected' : '' }}>Borrowing</option>
                                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                                    <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                </select>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                <button type="submit" class="btn btn-success">Apply Filters</button>
                            </div>
                        </form>
                    </x-filter>

                    
                </div>

                <div class="card-body p-0">
                    @foreach($borrowRecords as $borrowRecord)
                    @can("view", $borrowRecord)
                        <div class="history-item d-flex flex-column flex-md-row align-items-start align-items-md-center">

                            <div class="col-12 col-md-3 d-flex justify-content-center align-items-center border">
                                <img src="{{ asset("storage/".$borrowRecord->book->book_cover) ?? 'https://via.placeholder.com/100x60?text=Book' }}" 
                                    alt="Book Cover" 
                                    class="book-thumbnail m-0"
                                >
                            </div>
                            

                            <div class="col-12 col-md-9" style="min-height: 12em;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $borrowRecord->book->title }}</h5>
                                    <div class="card-text">
                                        <div class="row mb-1">
                                            <div class="col-4 col-sm-3">⏲️ Borrow:</div>
                                            <div class="col-8 col-sm-9">{{ $borrowRecord->start_date }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-4 col-sm-3">📅 Return:</div>
                                            <div class="col-8 col-sm-9">{{ $borrowRecord->return_date ?? "-" }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-sm-3">🚨 Due:</div>
                                            <div class="col-8 col-sm-9">{{ $borrowRecord->end_date }}</div>
                                        </div>


                                        @if($borrowRecord->isOverdue())
                                            <hr class="dashed-hr my-2">

                                            <div class="row mt-2">
                                                <div class="col-4 col-sm-3">⚠️ Status:</div>
                                                <div class="col-8 col-sm-9 text-danger">Overdue</div>
                                            </div>
                                        @endif

                                        @if($borrowRecord->penalty)
                                            <div class="row mt-2">
                                                <div class="col-4 col-sm-3">💰 Penalty:</div>
                                                <div class="col-8 col-sm-9 text-danger">{{ $borrowRecord->penalty->amount }}</div>
                                                @if($borrowRecord->penalty->status === 'unpaid')
                                                    <div class="row mt-1">
                                                        <div class="col-4 col-sm-3">📊 Status:</div>
                                                        <div class="col-8 col-sm-9 text-warning">Unpaid</div>
                                                    </div>
                                                @elseif($borrowRecord->penalty->status === 'paid')
                                                    <div class="row mt-1">
                                                        <div class="col-4 col-sm-3">📊 Status:</div>
                                                        <div class="col-8 col-sm-9 text-success">Paid on {{ $borrowRecord->penalty->payment_date }}</div>
                                                    </div>
                                                @endif

                                            </div>
                                        @endif

                                        {{-- @if ($borrowRecord->isRequested()) --}}
                                        @can("delete", $borrowRecord)
                                        <form method="POST" action="{{ route('borrowRecord.cancelRequest', $borrowRecord->id) }}" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Request</button>
                                        </form>
                                        
                                        @endcan

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endcan
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
    <div class="d-flex justify-content-center">
        {{ $borrowRecords->links("pagination::bootstrap-4") }}
    </div>
</div>
</div>
@endsection


