<li class="nav-header">WEB CONTENT</li>
<li class="nav-item">
    <a href="{{ route('index') }}" target="_blank" class="nav-link">
        <i class="nav-icon fas fa-globe-asia"></i>
        <p>Website</p>
    </a>
</li>

<li
class="nav-item has-treeview
{{ request()->is('nd-admin/slider*') || request()->is('nd-admin/feature*') || request()->is('nd-admin/blog*') || request()->is('nd-admin/tag*') ? 'menu-open' : '' }}">
<a href="#"
    class="nav-link
    {{ request()->is('nd-admin/slider*') || request()->is('nd-admin/feature*') || request()->is('nd-admin/blog*') || request()->is('nd-admin/tag*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-user-friends"></i>
    <p>
        CMS Content
        <i class="right fas fa-angle-left"></i>
    </p>
</a>
<ul class="nav nav-treeview">
    @canany(['slider-list', 'slider-create', 'slider-edit', 'slider-delete'])
        <li class="nav-item">
            <a href="{{ route('slider.index') }}"
                class="nav-link {{ request()->is('nd-admin/slider*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>Slider</p>
            </a>
        </li>
    @endcanany
    @canany(['feature-list', 'feature-create', 'feature-edit', 'feature-delete'])
        <li class="nav-item">
            <a href="{{ route('feature.index') }}"
                class="nav-link {{ request()->is('nd-admin/feature*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-star"></i>
                <p>Services</p>
            </a>
        </li>
    @endcanany

    @canany(['testimonial-list', 'testimonial-create', 'testimonial-edit', 'testimonial-delete'])
        <li class="nav-item">
            <a href="{{ route('testimonial.index') }}"
                class="nav-link {{ request()->is('nd-admin/testimonial*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Testimonials</p>
            </a>
        </li>
    @endcanany
    @canany(['partner-list', 'partner-create', 'partner-edit', 'partner-delete'])
        <li class="nav-item">
            <a href="{{ route('partners.index') }}"
                class="nav-link {{ request()->is('nd-admin/partners*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Partners</p>
            </a>
        </li>
    @endcanany
    {{-- @canany(['video-list', 'video-create', 'video-edit', 'video-delete'])
        <li class="nav-item">
            <a href="{{ route('video.index') }}"
                class="nav-link {{ request()->is('nd-admin/video*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-video"></i>
                <p>Multimedia</p>
            </a>
        </li>
    @endcanany --}}

    {{-- @canany(['faq-list', 'faq-create', 'faq-edit', 'faq-delete'])
        <li class="nav-item">
            <a href="{{ route('faq.index') }}"
                class="nav-link {{ request()->is('nd-admin/faq*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>Faq</p>
            </a>
        </li>
    @endcanany --}}

    <li
        class="nav-item has-treeview {{ request()->is('nd-admin/blog*') || request()->is('nd-admin/tag*') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ request()->is('nd-admin/blog*') || request()->is('nd-admin/tag*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-rss"></i>
            <p>
                Blogs
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            @canany(['blog-list', 'blog-create', 'blog-edit', 'blog-delete'])
                <li class="nav-item">
                    <a href="{{ route('blog.index') }}"
                        class="nav-link {{ request()->is('nd-admin/blog*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Blog List</p>
                    </a>
                </li>
            @endcanany

            {{-- @canany(['blog-create'])
                <li class="nav-item">
                    <a href="{{ route('tag.index') }}"
                        class="nav-link {{ request()->is('nd-admin/tag*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Blog Tags</p>
                    </a>
                </li>
            @endcanany --}}



        </ul>
    </li>
{{--
    @canany(['subscriber-list', 'subscriber-create', 'subscriber-edit', 'subscriber-delete'])
        <li class="nav-item">
            <a href="{{ route('subscriber.index') }}"
                class="nav-link {{ request()->is('nd-admin/subscriber*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-suitcase"></i>
                <p>Subscriber</p>
            </a>
        </li>
    @endcanany --}}

    @canany(['contact-list', 'contact-view', 'contact-edit', 'contact-delete'])
        <li class="nav-item">
            <a href="{{ route('contact.index') }}"
                class="nav-link {{ request()->is('nd-admin/contact*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-user-circle"></i>
                <p>Contact</p>
            </a>
        </li>
    @endcanany
{{--
    @canany(['mediaLibrary-list'])

        <li class="nav-item">
            <a href="{{ route('medialibrary.index') }}"
                class="nav-link {{ request()->is('nd-admin/contact*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-photo-video"></i>
                <p>Media Library</p>
            </a>
        </li>
    @endcanany --}}

    @canany(['information-list', 'information-create', 'information-edit', 'information-delete'])
        <li class="nav-item">
            <a href="{{ route('information.index') }}"
                class="nav-link {{ request()->is('nd-admin/information*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>Information</p>
            </a>
        </li>
    @endcanany

    @canany(['benefit-list', 'benefit-create', 'benefit-edit', 'benefit-delete'])
    <li class="nav-item">
        <a href="{{ route('benefit.index') }}"
            class="nav-link {{ request()->is('nd-admin/benefit*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card"></i>
            <p>Benefit</p>
        </a>
    </li>
@endcanany
    @canany(['gallery-list', 'gallery-create', 'gallery-edit', 'gallery-delete'])
        <li class="nav-item">
            <a href="{{ route('gallery.index') }}"
                class="nav-link {{ request()->is('nd-admin/gallery*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>Gallery</p>
            </a>
        </li>
    @endcanany




    @canany(['team-list', 'team-create', 'team-edit', 'team-delete'])

        <li
            class="nav-item has-treeview {{ request()->is('nd-admin/designation*') || request()->is('nd-admin/team*') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ request()->is('nd-admin/designation*') || request()->is('nd-admin/team*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                    Team Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            @canany(['designation-list', 'designation-create', 'designation-edit',
                'designation-delete'])
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('designations.index') }}"
                            class="nav-link {{ request()->is('nd-admin/designation*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Team Designation</p>
                        </a>
                    </li>
                @endcanany
                @canany(['designation-list', 'designation-create', 'designation-edit',
                    'designation-delete'])
                    <li class="nav-item">
                        <a href="{{ route('team.index') }}"
                            class="nav-link {{ request()->is('nd-admin/team*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Team List</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany
    @endcanany
</ul>
</li>
