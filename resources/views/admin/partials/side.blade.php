<div>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="sidebar-user-panel active">
                    <div class="user-panel">
                        <div class=" image">
                            <img src="{{ asset('uploads/'.auth()->user()->image) }}" class="user-img-style" alt="User Image" />
                        </div>
                    </div>
                    <div class="profile-usertitle">
                        <div class="sidebar-userpic-name"> {{ auth()->user()->name }} </div>
                        <div class="profile-usertitle-job ">{{ auth()->user()->role }} </div>
                    </div>
                </li>
                {{-- <li class="active">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i data-feather="monitor"></i>
                        <span>Home</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="active">
                            <a href="index.html">Dashboard 1</a>
                        </li>
                        <li>
                            <a href="pages/dashboard/dashboard2.html">Dashboard 2</a>
                        </li>
                        <li>
                            <a href="pages/dashboard/dashboard3.html">Dashboard 3</a>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="monitor"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>
                @if(auth()->user()->hasRole('اداري'))
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i data-feather="user"></i>
                        <span>المستخدمين</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('users.index') }}">جميع المستخدمين</a>
                        </li>
                        <li>
                            <a href="{{ route('users.create') }}l">اضف مستخدم جديد</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i data-feather="command"></i>
                        <span>الفروع</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('brancehs.index') }}">جميع الفروع</a>
                        </li>
                  
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i data-feather="shopping-cart"></i>
                        <span>المخزون</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('products.index') }}"> جميع المنتجات </a>
                        </li>
                        

                        <li>
                            <a href="{{ route('products.create') }}"> اضف منتج</a>
                        </li>
                      
                    </ul>
                </li>
                @endif
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i data-feather="shopping-cart"></i>
                        <span>المنتجات</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('all_item') }}"> جميع المنتجات </a>
                        </li>
                        

                        <li>
                            <a href="{{ route('products.create') }}"> اضف منتج</a>
                        </li>
                      
                    </ul>
                </li>
               
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i data-feather="copy"></i>
                        <span>الطلبات</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('orders.index') }}">جميع الطلبات</a>
                        </li>
                       
                    </ul>
             
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation">
                <a href="#skins" data-bs-toggle="tab" class="active">SKINS</a>
            </li>
            <li role="presentation">
                <a href="#settings" data-bs-toggle="tab">SETTINGS</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active in active stretchLeft" id="skins">
                <div class="demo-skin">
                    <div class="rightSetting">
                        <p>SIDEBAR COLOR</p>
                        <div class="selectgroup selectgroup-pills sidebar-color mt-3">
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="1"
                                    class="btn-check selectgroup-input select-sidebar" checked>
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="2"
                                    class="btn-check selectgroup-input select-sidebar">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="rightSetting">
                        <p>THEME COLORS</p>
                        <div class="btn-group theme-color mt-3" role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" value="1" id="btnradio1"
                                autocomplete="off" checked>
                            <label class="radio-toggle btn btn-outline-primary" for="btnradio1">Light</label>
                            <input type="radio" class="btn-check" name="btnradio" value="2" id="btnradio2"
                                autocomplete="off">
                            <label class="radio-toggle btn btn-outline-primary " for="btnradio2">Dark</label>
                        </div>
                    </div>
                    <div class="rightSetting">
                        <p>SKINS</p>
                        <ul class="demo-choose-skin choose-theme list-unstyled">
                            <li data-theme="black">
                                <div class="black-theme"></div>
                            </li>
                            <li data-theme="white">
                                <div class="white-theme white-theme-border"></div>
                            </li>
                            <li data-theme="purple">
                                <div class="purple-theme"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue-theme"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan-theme"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green-theme"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange-theme"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="rightSetting">
                        <p>RTL Layout</p>
                        <div class="switch mt-3">
                            <label>
                                <input type="checkbox" class="layout-change">
                                <span class="lever switch-col-red layout-switch"></span>
                            </label>
                        </div>
                    </div>
                    <div class="rightSetting">
                        <p>DISK SPACE</p>
                        <div class="sidebar-progress">
                            <div class="progress m-t-20">
                                <div class="progress-bar l-bg-cyan shadow-style width-per-45" role="progressbar"
                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-description">
                                <small>26% remaining</small>
                            </span>
                        </div>
                    </div>
                    <div class="rightSetting">
                        <p>Server Load</p>
                        <div class="sidebar-progress">
                            <div class="progress m-t-20">
                                <div class="progress-bar l-bg-orange shadow-style width-per-63" role="progressbar"
                                    aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-description">
                                <small>Highly Loaded</small>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                        <button type="button"
                            class="btn btn-outline-primary btn-border-radius btn-restore-theme">Restore
                            Default</button>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane stretchRight" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-green"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever switch-col-blue"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-purple"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-cyan"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-red"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever switch-col-lime"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</div>