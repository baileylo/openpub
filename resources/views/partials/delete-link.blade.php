<form method="POST" action="{{ $url }}" style="display: inline;" @if(isset($confirm)) onsubmit="return confirm('Are you sure you want to delete this?')" @endif>
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="delete" />
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
</form>