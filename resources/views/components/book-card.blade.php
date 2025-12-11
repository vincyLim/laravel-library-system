@if(Str::contains($attributes->get('class'), 'result'))
    <div class="card mb-3 shadow-sm" style="border-radius: 10px; overflow: hidden;">
        <div class="row g-0">
            <div class="col-md-3 align-items-center p-2" style=" background-color: #f8f9fa;">
                <div style="height: 15em;">
                    <img src="{{ $bookCover }}" alt="{{ $bookTitle }}" class="img-fluid rounded-start mx-auto d-block" style="max-height: 100%; max-width: 100%;">
                </div>
            </div>

            <div class="col-md-9">
                <div class="card-body">
                    <h2 class="card-title mb-4"><strong>{{ $bookTitle }}</strong></h2>
                    <p class="card-text"><strong>Author:</strong> {{ $bookAuthor }}</p>
                    <p class="card-text"><strong>Category:</strong> {{ $bookCategory }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ Str::limit($bookDescription, 150, '...') }}</p>

                  
                    <button
                        class="book-card text-center btn btn-primary w-100 d-block mt-4"
                        data-bs-toggle="modal" 
                        data-bs-target="#book_details" 
                        data-book-title="{{ $bookTitle }}" 
                        data-book-author="{{ $bookAuthor }}" 
                        data-book-category="{{ $bookCategory }}" 
                        data-book-description="{{ $bookDescription }}" 
                        data-book-cover="{{ $bookCover }}" 
                        data-book-request-link="{{ $bookRequestLink }}"
                        data-book-status="{{ $bookStatus }}"
                    >
                        view details
                    </button>
                 
                </div>
            </div>
        </div>
    </div>
@else

    {{-- for menu book card --}}
    @if(Str::contains($attributes->get('class'), 'menu'))
    <div class="col-md-3 col-sm-6 mb-4 d-flex justify-content-center">
    @endif


<div
    class="book-card"
    style="height:20em"
    data-bs-toggle="modal" 
    data-bs-target="#book_details" 
    data-book-title="{{ $bookTitle }}" 
    data-book-author="{{ $bookAuthor }}" 
    data-book-category="{{ $bookCategory }}" 
    data-book-description="{{ $bookDescription }}" 
    data-book-cover="{{ $bookCover }}" 
    data-book-request-link="{{ $bookRequestLink }}"
    data-book-status="{{ $bookStatus }}"
>
    <div style="height: 15em; margin: 10px; display: flex; justify-content: center; align-items: center;">
        <img src="{{ $bookCover }}" alt="{{ $bookTitle }}" class="h-100">    
    </div>
    <h4 class="book-title text-center">{{ Str::limit($bookTitle , 25, '...') }}</h4>
</div>

    {{-- for menu book card --}}
    @if(Str::contains($attributes->get('class'), 'menu'))
    </div>
    @endif

@endif


<!-- Modal -->
{{-- <div class="modal fade" id="book_details" tabindex="-1" aria-labelledby="bookDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookDetailsLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" alt="" id="modalBookImage" class="img-fluid mb-3" style="max-height: 200px;">
                </div>
                <p><strong>Author:</strong> <span id="modalBookAuthor"></span></p>
                <p><strong>Category:</strong> <span id="modalBookCategory"></span></p>
                <p><strong>Description:</strong> <span id="modalBookDescription"></span></p>
            </div>
            <div class="modal-footer">
                <a href="#" id="modalRequestLink" class="btn btn-primary">Request to Borrow</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('[data-bs-toggle="modal"]').on('click', function () {
            const bookName = $(this).data('book-name');
            const author = $(this).data('author');
            const category = $(this).data('category');
            const description = $(this).data('description');
            const imageUrl = $(this).data('image-url');
            const requestLink = $(this).data('request-link');

            $('#bookDetailsLabel').text(bookName);
            $('#modalBookImage').attr('src', imageUrl).attr('alt', bookName);
            $('#modalBookAuthor').text(author);
            $('#modalBookCategory').text(category);
            $('#modalBookDescription').text(description);
            $('#modalRequestLink').attr('href', requestLink);
        });
    });
</script> --}}
