    @hasanyrole('Super Admin|Admin|AWB admin|Super Account')

    @include('admin.section.header')

    @include('admin.section.top-nav')
    @include('admin.section.sidebar')

    <div class="content-wrapper">
        @include('admin.section.notify')
        {{-- @include('admin.section.extra-menu') --}}
        @yield('content')
    </div>
    @include('admin.section.copy')
    @include('admin.section.footer')
    @endhasallroles

    @hasanyrole('Agent|Staff')
    @include('admin.section.header')
<div class="customer-navbar">
    @include('admin.section.top-nav')
</div>
    {{-- @include('admin.section.sidebar') --}}

    <div class="content-wrapper dashnew" style="margin-left: 0;">
            @include('admin.section.notify')
            {{-- @include('admin.section.extra-menu') --}}
            @yield('content')
        </div>
    @include('admin.section.copy')
    @include('admin.section.footer')
    @endhasallroles
