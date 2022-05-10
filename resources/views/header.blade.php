<!-- Page Preloder -->
{{--<div id="preloder">--}}
{{--    <div class="loader"></div>--}}
{{--</div>--}}

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="/template/img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="/carts"><i class="fa fa-shopping-bag"></i> <span></span></a></li>
        </ul>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">Trang chủ</a></li>
            {!! \App\Helpers\Helper::categorys($categorys) !!}
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__auth">
                            <div class="dropdown">
                                <div class="header__top__right__auth__title">
                                    <div>
                                        <img style="width: 27px" src="/template/img/user_icon.png" alt="">
                                    </div>
                                    <div>
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <div class="content_dropdown">
                                    <a href="/order">Đơn hàng của tôi</a>
                                    <a href="/logout/store">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <nav class="ml-4 header__menu">
                    <ul>
                        <li class="active"><a href="/">Home</a></li>
                        {!! \App\Helpers\Helper::categorys($categorys) !!}
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2">
                <div class="header__cart">
                    <ul>
                            <li>
                                <a href="/carts"><i class="fa fa-shopping-bag"></i>
                                    <span>{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0}}</span>
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

