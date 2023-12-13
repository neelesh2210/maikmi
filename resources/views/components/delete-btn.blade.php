<form action="{{$route}}" method="POST" style="display:inline">
    @method('Delete')
    @csrf
    <button type="submit" class="btn btn-icon btn-danger btn-sm deleteBtn" title="Delete"><i class="bi bi-trash"></i></button>
</form>
