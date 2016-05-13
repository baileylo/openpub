<nav class="col-sm-2 sidebar">
    <div class="sidebar-header text-center">
        <h1>Open Pub</h1>
    </div>

    <ul class="nav nav-stacked">
        <li>
            <a href="#">
                <i class="fa fa-desktop ico-label" aria-hidden="true"></i>
                Content
                <i class="fa fa-caret-down arrow" aria-hidden="true" style="float: right"></i>
            </a>
            <ul class="sub-nav nav nav-stacked">
                <li><a href="{{ route('admin.page.index') }}" @if(Request::is('admin/page*')) class="active" @endif>Pages</a></li>
                <li><a href="{{ route('admin.post.index') }}" @if(Request::is('admin/post*')) class="active" @endif>Posts</a></li>
            </ul>
        </li>
        <li><a href="#">Media</a></li>
        <li><a href="{{ route('admin.settings') }}" @if(Request::is('admin/settings*')) class="active" @endif>Account Settings</a></li>
    </ul>
</nav>