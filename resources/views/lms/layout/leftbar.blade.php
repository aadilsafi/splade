<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item ">
                <a class=" d-flex align-items-center navbar-brand" href="#">
                    {{-- <img src="{{asset('lms/app-assets/images/logo.svg')}}" style="object-fit:contain; height:55px;width:45px"> --}}
                    {{-- <h2 class="brand-text" style="font-variant: small-caps">Unili</h2> --}}
                    <img src="{{asset('lms/app-assets/images/logo/logo_2.png')}}" style="object-fit:cover;height: 35px;width: 180px;">
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc">
                    </i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('dashboard')}}">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate">{{ __('lang.leftbar.dashboard') }}</span>
                </a>
            </li>
            @auth
                <li class="">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="user-check"></i>
                        <span class="menu-item text-truncate" data-i18n="Account Settings">Account Settings</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{request()->routeIs('profile.edit.account')? 'active' : null}}">
                            <a class="d-flex align-items-center" href="{{route('profile.edit.account')}}">
                                <span class="menu-item text-truncate" data-i18n="Account">Account</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('profile.edit.security') ? 'active' : null}}">
                            <a class="d-flex align-items-center" href="{{route('profile.edit.security')}}">
                                <span class="menu-item text-truncate" data-i18n="Security">Security</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endauth

            @if(auth()->user()->isAdmin)
                {{-- header --}}
                 <li class="navigation-header">
                    <span>{{ __('lang.leftbar.management') }}</span>
                    <i data-feather="more-horizontal"></i>
                 </li>
                <li class="nav-item {{ request()->routeIs('question-banks.index')? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{route('question-banks.index')}}">
                        <i data-feather='server'></i>
                        <span class="menu-title text-truncate">{{ __('lang.leftbar.question-banks')}}</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{route('user.index')}}">
                        <i data-feather="users"></i>
                        <span class="menu-title text-truncate">{{ __('lang.leftbar.users') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('category.index') | request()->routeIs('category.show') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{route('category.index')}}">
                        <i data-feather='menu'></i>
                        <span class="menu-title text-truncate">{{ __('lang.leftbar.categories')}}</span>
                    </a>
                </li>
            @else
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{route('home')}}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">{{ __('lang.leftbar.home') }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
<script>
    function fetchSubCategories(ele,parent_id){
        let content = $(ele).next('.menu-content');
        if(content.length > 0){

            $.ajax({
                url: '/category/'+parent_id+"/subcategories",
                method: "GET",
                success: (res) => {
                    $(content).empty();
                    res.subcategories.forEach((subcategory)=>{
                        $(content).append(createLi(subcategory.name,subcategory.id));
                    });
                    let lis = ``;
                    if(res.category && res.category.courses){
                        res.category.courses.forEach((course)=>{
                            lis += `
                                <li class="">
                                    <a class="d-flex align-items-center" href="#">
                                        <i data-feather='circle'></i>
                                        <span class="menu-item text-truncate" >${course.title}</span>
                                    </a>
                                </li>
                            `;
                        });
                        $(content).append(lis);
                    }
                }
            });
        }
    }

    function createLi(name,id){
        return `
                <li>
                    <a class="d-flex align-items-center" href="#" onclick="fetchSubCategories(this,${id})">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate">${name}</span>
                    </a>
                    <ul class="menu-content">
                    </ul>
                </li>
        `;
    }
</script>
<!-- END: Main Menu-->
