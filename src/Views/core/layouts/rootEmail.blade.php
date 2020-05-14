
<div style="user-select: none; max-width: 100vw;background-color:rgba(246,246,246,0.9);font-family:arial,sans-serif;color:#474747;padding:2%;">
<div class="header">
    @include('MS::core.layouts.Email.Static.Header')
    @yield('header')
</div>
<div class="body" style="padding: 2%;background-color: rgba(255,255,255,0.9);border:1px solid rgba(28,28,28,0.1);">
    @yield('body')
</div>
<div class="footer">
    @include('MS::core.layouts.Email.Static.Footer')
    @yield('footer')
</div>
</div>
