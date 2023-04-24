 <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                               
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{ asset('control_assets/images/icon/avatar-01.jpg') }}" alt="{{ ucwords(auth()->user()->name) }}" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ ucwords(auth()->user()->name) }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ asset('control_assets/images/icon/avatar-01.jpg') }}" alt="{{ ucwords(auth()->user()->name) }}" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ ucwords(auth()->user()->name) }}</a>
                                                    </h5>
                                                    <span class="email">{{ ucwords(auth()->user()->email) }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">

                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                               
                                                
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-default btn-flat">
                                                        <i class="zmdi zmdi-power"></i> Logout
                                                       
                                                    </button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->