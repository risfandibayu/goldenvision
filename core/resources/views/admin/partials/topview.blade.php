<!-- navbar-wrapper start -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="navbar__right">
        <ul class="navbar__action-list">
            <li class="dropdown">
                <button type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                    aria-expanded="false">

                    <span class="navbar-user">
                        <span class="navbar-user__thumb"><img
                                src="{{ getImage('assets/admin/images/profile/' .auth()->guard('admin')->user()->image) }}"
                                alt="@lang('image')"></span>

                        <span class="navbar-user__info">
                            <span class="navbar-user__name">{{ auth()->guard('admin')->user()->username }}</span>
                        </span>
                        <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">


                    <a href="{{ route('admin.logout') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->
