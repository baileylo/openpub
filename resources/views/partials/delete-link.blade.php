<form method="POST" action="{{ $url }}" style="display: inline;">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="delete" />
    <button type="submit" class="label round alert"><i class="fa fa-trash"></i></button>
</form>