@extends('layout.index')

@include('layout.navbar')

@section('styles')
<style>
    /* Book card styles */
    .book-card{
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        background-color: #fff;
        margin-bottom: 20px;
        transition: transform 0.5s ease;
    }

    .book-card:hover img{
        transform: translateY(-5px) ;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) ;
    }

    .book-cover-container {
        overflow: hidden;
        height: 15em;
        position: relative;
    }

    .book-cover-container img {
        transition: transform 0.5s ease;
        height: 100%;
        margin: auto;
        object-fit: cover;
    }

    .book-card:hover .book-cover-container img {
        transform: scale(1.05);
    }

    .book-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 10px;
        text-align: center;
        padding: 0 10px 10px;
    }

    /* Modal styles */
    .modal-content {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eaeaea;
    }

    .modal-title {
        font-weight: 700;
        color: #333;
    }

    .book-cover-modal {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .book-meta {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .book-category-badge {
        background-color: #6c757d;
        color: white;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 20px;
        display: inline-block;
        margin-top: 5px;
    }

    .book-author-text {
        color: #6c757d;
        font-style: italic;
        margin-bottom: 0;
    }

    .book-desc-container {
        max-height: 200px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .request-btn {
        background-color: #4361ee;
        border-color: #4361ee;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .request-btn:hover {
        background-color: #3a56d4;
        border-color: #3a56d4;
        transform: translateY(-2px);
    }

    /* Modal animation */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
        transform: scale(0.95);
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>
@endsection

@yield('content')

@include('layout.footer')

<!-- Enhanced Modal -->
<div class="modal fade" id="book_details" tabindex="-1" aria-labelledby="bookDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img src="" alt="" id="bookCover" class="img-fluid book-cover-modal" style="max-height: 230px;">
                        <div class="mt-3">
                            <span class="book-category-badge" id="bookCategory"></span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="book-meta mb-3">
                            <p class="book-author-text mb-0">By <span id="bookAuthor"></span></p>
                            <div class="d-flex align-items-center mt-2">
                                <div class="rating"></div>
                                <small class="text-muted" id="bookRatingText">4.5 rating</small>
                            </div>
                        </div>
                        <h6 class="fw-bold">About this book</h6>
                        <div class="book-desc-container">
                            <p id="bookDescription"></p>
                        </div>
                    </div>
                </div>

                <div class="p-3 border  rounded-bottom" id="bookTabContent">
                    <!-- Reviews Tab -->
                    <div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div id="reviewsList">
                            <!-- Reviews will be loaded dynamically here -->
                            <div class="text-center py-3" id="noReviewsMessage">
                                <p class="text-muted">No reviews yet. Be the first to review this book!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @can("allowToBorrow")
                <a href="#" id="bookRequestLink" class="btn btn-primary request-btn">
                    <i class="bi bi-bookmark-plus me-1"></i> Request to Borrow
                </a>
                @elsecannot("allowToBorrow")
                <button class="btn btn-secondary request-btn">
                    <i class="bi bi-bookmark-plus me-1"></i> You have borrowed another book
                </button>
                @endcan
                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}

@push('script')
<script>
    $(document).ready(function () {
        // Add Bootstrap Icons if not already included
        if (!$('link[href*="bootstrap-icons"]').length) {
            $('head').append('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">');
        }

        // Book card click handler
        $('.book-card').on('click', function () {
            const bookTitle = $(this).data('book-title');
            const bookAuthor = $(this).data('book-author');
            const bookCategory = $(this).data('book-category');
            const bookDescription = $(this).data('book-description');
            const bookCover = $(this).data('book-cover');
            const bookRequestLink = $(this).data('book-request-link');
            const bookStatus = $(this).data('book-status');

            $('#bookTitle').text(bookTitle);
            $('#bookCover').attr('src', bookCover).attr('alt', bookTitle);
            $('#bookAuthor').text(bookAuthor);
            $('#bookCategory').text(bookCategory);
            $('#bookDescription').text(bookDescription);
            $('#bookRequestLink').attr('href', bookRequestLink);

            // Check book status
            if (bookStatus !== 'available') {
                $('#bookRequestLink')
                    .addClass('disabled btn-secondary')
                    .removeClass('btn-primary')
                    .attr('aria-disabled', 'true')
                    .text('Not Available');
            } else {
                $('#bookRequestLink')
                    .removeClass('disabled btn-secondary')
                    .addClass('btn-primary')
                    .removeAttr('aria-disabled')
                    .text('Request to Borrow');
            }
            // Add fade-in animation to the modal body
            $('.modal-body').css('opacity', 0);
            setTimeout(function() {
                $('.modal-body').animate({opacity: 1}, 300);
            }, 300);
        });

        // Initialize star rating
        $('.rating').starRating({
            totalStars: 5,
            starSize: 25,
            initialRating: 4.5,
            readOnly: true,
            emptyColor: '#e4e4e4',
            hoverColor: '#f39c12',
            activeColor: '#f39c12',
            useGradient: false,
            callback: function(currentRating, $el){
                $('#bookRatingText').text(currentRating + ' rating');
            }
        });

    });
</script>
@endpush
