<nav class="settings-sidebar">
    <div class="sidebar-body">
        <span type="button" class="settings-sidebar-toggler">
            <i data-feather="search"></i>
        </span>
        <div class="theme-wrapper">
            <h5 class="text-muted mb-2">Filter</h5>
            <hr>
            <form action="{{route('user.index')}}" method="GET">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <input id="search" class="form-control" type="text" name="search" placeholder="Enter Name Or Phone" value="{{$search}}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <select name="status" id="status" class="form-select">
                            <option value="">Select Status</option>
                            <option value="Active" {{$status=='Active' ? 'selected' : ''}}>Active</option>
                            <option value="Deactivate" {{$status=='Deactivate' ? 'selected' : ''}}>Deactivate</option>
                        </select>
                    </div>

                </div>
                <x-search-submit-btn />
                <x-search-clear-btn route="{{route('user.index')}}" />
            </form>
        </div>
    </div>
</nav>
<script>
    $( document ).ready(function() {
        @if ($search || $status)
            $("body").addClass("settings-open");
        @endif
    });
</script>
