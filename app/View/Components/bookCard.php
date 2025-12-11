<?php

namespace App\View\Components;

use Illuminate\View\Component;

class bookCard extends Component
{
    public $bookId;
    public $bookTitle;
    public $bookAuthor;
    public $bookCategory;
    public $bookDescription;
    public $bookCover;
    public $bookRequestLink;

    public $bookStatus;
    /* public $image; */

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $bookId, $bookTitle, $bookAuthor, $bookCategory, $bookDescription, $bookCover, $bookRequestLink, $bookStatus)
    {
        $this->bookId = $bookId;
        $this->bookTitle = $bookTitle;
        $this->bookAuthor = $bookAuthor;
        $this->bookCategory = $bookCategory;
        $this->bookDescription = $bookDescription;
        $this->bookCover = $bookCover;
        $this->bookRequestLink = $bookRequestLink;
        $this->bookStatus = $bookStatus;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.book-card');
    }
}
