<!-- Footer -->
<footer class="footer bg-dark text-light py-3 mt-4">
  <div class="container mt-4">
    <div class="row text-center text-md-start">
      <!-- Library Info -->
      <div class="col-md-4 mb-4 mt-0">
        <h5 class="text-uppercase fw-bold mb-1">Library</h5>
        <p class="small">Your gateway to knowledge and discovery since 2025.</p>
        <div class="d-flex justify-content-center justify-content-md-start gap-2">
          <a href="#" class="text-light fs-6"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-light fs-6"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-light fs-6"><i class="bi bi-instagram"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4 mt-0">
        <h5 class="text-uppercase fw-bold mb-1">Quick Links</h5>
        <ul class="list-unstyled small">
          <li class="mb-1"><a href="{{ route('home') }}" class="text-decoration-none text-light">Home</a></li>
          <li class="mb-1"><a href="{{ route('menu') }}" class="text-decoration-none text-light">Book Catalog</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-4 mt-0">
        <h5 class="text-uppercase fw-bold mb-1">Contact Us</h5>
        <address class="small">
          <p class="mb-1"><i class="bi bi-geo-alt me-1"></i>123 Reading Avenue, Booktown, LB 12345</p>
          <p class="mb-1"><i class="bi bi-telephone me-1"></i>(123) 456-7890</p>
          <p><i class="bi bi-envelope me-1"></i><a href="mailto:info@library.com" class="text-light text-decoration-none">info@library.com</a></p>
        </address>
      </div>
    </div>

    <!-- Copyright -->
    <div class="row">
      <div class="col-12">
        <hr class="bg-secondary mt-0">
        <p class="text-center small mb-0">&copy; {{ date('Y') }} Library Name. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer -->
