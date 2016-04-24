<div class="col col-sm-12 text-right">
    Hi, {{ Auth::user()->name }}. |
    <a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
</div>