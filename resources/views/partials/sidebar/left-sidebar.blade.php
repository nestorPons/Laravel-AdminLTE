<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
        
        {{-- Reactive nav-links --}}
        @if(config('adminlte.sidebar_reactive_nav_links'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const container = this.getElementsByClassName("sidebar")[0];
                const navLinks = container.getElementsByClassName("nav-link");

                for (const link of navLinks) {
                    link.addEventListener("click", function(event) {
                        event.preventDefault();

                        const url = link.getAttribute("href");
                        if (url) {
                            const contentSection = document.querySelector(".content");
                            axios
                                .get(url)
                                .then((response) => {
                                    contentSection.innerHTML = response.data;
                                    if (Livewire) Livewire.restart();
                                })
                                .catch((error) => {
                                    contentSection.innerHTML = error;

                                    console.error("Error al cargar el contenido:", error);
                                });
                        }
                    });
                }
            });

        </script>
        @endif
    </div>

</aside>
