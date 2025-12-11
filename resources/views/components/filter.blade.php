<div class="dropdown">
    <button class="btn btn-outline-dark d-flex align-items-center gap-2 shadow-sm rounded-pill px-3 py-2" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-sliders"></i>
        <span>Filters</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="filterDropdown" style="min-width: 350px;">
        {{$slot}}
    </div>
</div>