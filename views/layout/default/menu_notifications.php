
<div class="content-wrapper">
    <nav id="toolbar" class="fixed-top bg-white">
        <div class="row no-gutters align-items-center flex-nowrap">
            <div class="col">
                <div class="row no-gutters align-items-center flex-nowrap">

                    <button type="button" class="toggle-aside-button btn btn-icon d-block d-lg-none"
                            data-fuse-bar-toggle="aside">
                        <i class="icon icon-menu"></i>
                    </button>

                    <div class="toolbar-separator d-block d-lg-none"></div>

                    <div class="shortcuts-wrapper row no-gutters align-items-center px-0 px-sm-2">

                       <!--<div class="shortcuts row no-gutters align-items-center d-none d-md-flex">
                            <a href="apps-chat.html" class="shortcut-button btn btn-icon mx-1">
                                <i class="icon icon-hangouts"></i>
                            </a>
                            <a href="apps-contacts.html" class="shortcut-button btn btn-icon mx-1">
                                <i class="icon icon-account-box"></i>
                            </a>
                            <a href="apps-mail.html" class="shortcut-button btn btn-icon mx-1">
                                <i class="icon icon-email" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on bottom"></i>
                            </a>
                        </div>-->

                        <div class="add-shortcut-menu-button dropdown px-1 px-sm-3">
                            <div class="dropdown-toggle btn btn-icon" role="button"
                                 id="dropdownShortcutMenu"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="list-group-item two-line">
                                    <div class="list-item-content">
                                        <h3 class="mb-h3-title">Switch Website store</h3>
                                        <p class="mb-title-website">
                                            <span>El universo</span> 
                                            <i class="icon icon-arrow-down-drop"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">

                                <a class="dropdown-item" href="#">
                                    <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                        <div class="row no-gutters align-items-center flex-nowrap">
                                            <i class="icon icon-calendar-today"></i>
                                            <span class="px-3" >APP Mobile Site UV</span>
                                        </div>
                                        <i class="icon icon-pin s-5 ml-2"></i>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                        <div class="row no-gutters align-items-center flex-nowrap">
                                            <i class="icon icon-folder"></i>
                                            <span class="px-3">Reviste Vistazo</span>
                                        </div>
                                        <i class="icon icon-pin s-5 ml-2"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="toolbar-separator"></div>

                </div>
            </div>

            <div class="col-auto">
                <div class="row no-gutters align-items-center justify-content-end">
                    <div class="user-menu-button dropdown">
                        <div class="dropdown-toggle ripple row align-items-center no-gutters px-2 px-sm-4" role="button"
                             id="dropdownUserMenu"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-wrapper">
                                <img class="avatar" src="<?php echo $_layoutParams['root_img']; ?>avatars/profile.jpg">
                                <i class="status text-green icon-checkbox-marked-circle s-4"></i>
                            </div>
                            <span class="username mx-3 d-none d-md-block"><?php echo Session::get('user'); ?></span>
                        </div>

                        <div class="dropdown-menu" aria-labelledby="dropdownUserMenu">

                            <a class="dropdown-item" href="#">
                                <div class="row no-gutters align-items-center flex-nowrap">
                                    <i class="icon-account"></i>
                                    <span class="px-3">My Profile</span>
                                </div>
                            </a>
                            
                            <?php if(Session::strictViewAccess(array('admin'))): ?>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item fuse-ripple-ready" href="<?php echo BASE_URL . 'setting_users'; ?>">
                                <div class="row no-gutters align-items-center flex-nowrap">
                                    <i class="icon-account-settings-variant"></i>
                                    <span class="px-3">Setting User</span>
                                </div>
                            </a>
                            <?php endif;?>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="<?php echo BASE_URL . 'login/close'; ?>">
                                <div class="row no-gutters align-items-center flex-nowrap">
                                    <i class="icon-logout"></i>
                                    <span class="px-3">Logout</span>
                                </div>
                            </a>

                        </div>
                    </div>

                    <!--<div class="toolbar-separator"></div>
                    
                    <div class="language-button dropdown">

                        <div class="dropdown-toggle ripple row align-items-center justify-content-center no-gutters px-0 px-sm-4 fuse-ripple-ready" role="button" id="dropdownSettingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="row no-gutters align-items-center">
                                <i class="icon icon-settings s-6"></i>
                            </div>
                        </div>

                        <div class="dropdown-menu" aria-labelledby="dropdownSettingMenu">

                            <a class="dropdown-item fuse-ripple-ready" href="<?php echo BASE_URL . 'setting_users'; ?>">
                                <div class="row no-gutters align-items-center flex-nowrap">
                                    <i class="icon icon-account-settings-variant s-4"></i>
                                    <span class="px-3">Setting User</span>
                                </div>
                            </a>

                        </div>
                    </div>-->

                    <div class="toolbar-separator"></div>

                    <button type="button" class="quick-panel-button btn btn-icon"
                            data-fuse-bar-toggle="quick-panel-sidebar">
                        <i class="icon icon-format-list-bulleted"></i>
                    </button>

                </div>
            </div>
        </div>
    </nav>

    <div class="content">
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #3c4252!important; border-radius: 0px !important; height: 5.8rem;">
        <i class="logo-icon icon-chart-line mr-2" style="color: #fff;"></i>
        <a class="navbar-brand" href="#" style="font-weight: bold;"><?php echo $this->page_title ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Overviews <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div>
    </nav>




