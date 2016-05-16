<form method="POST" action="{{ $url }}" style="display: inline;">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="delete" />
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
</form>