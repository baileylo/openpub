<nav class="top-bar hidden-for-small" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name"><h1><a href="{{ route('home') }}">My Blog</a></h1></li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>
    <section class="top-bar-section"> <!-- Right Nav Section -->
        <ul class="right">
            <li class="has-dropdown"><a href="#">Hello, Logan</a>
                <ul class="dropdown">
                    <li><a href="{{ route('settings') }}">Settings</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Left Nav Section -->
        <ul class="left">
            <li><a href="{{ route('admin') }}">Admin</a></li>
            <li><a href="{{ route('post.create') }}">Write Post</a></li>
        </ul>
    </section>
</nav>
