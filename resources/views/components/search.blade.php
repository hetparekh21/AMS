<form action="{{$action}}" method="POST">
    @csrf
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <button type="submit" class="btn rounded-pill btn-icon"><span class="bx bx-search fs-4 lh-0"></span></button>
            <input type="text" id="filter" class="form-control border-0 shadow-none" placeholder="Search..." value="{{$query}}" aria-label="Search..."
                name="query" />

        </div>
        <a class="btn text-primary" href="{{$action}}">Clear</a>
    </div>
</form>
