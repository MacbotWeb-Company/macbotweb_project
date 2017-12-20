<body class="layout layout-vertical layout-left-navigation layout-below-toolbar">
    <div id="wrapper">
        <aside id="aside" class="aside aside-left"
               data-fuse-bar="aside" data-fuse-bar-media-step="md"
               data-fuse-bar-position="left">
            <div class="aside-content-wrapper">
                <div class="aside-content bg-primary-500 text-auto">
                    <div class="aside-toolbar">
                        <div class="logo">
                            <span class="logo-icon" style="background-color: transparent;">
                                <a href="/">
                                    <img src="<?php echo $_layoutParams['root_img']; ?>engranaje-robot-32x32.png" class="gear" alt="gear">
                                </a>
                            </span>

                            <span class="logo-text" style="color: #00adef; font-family: 'Roboto', sans-serif; display: block; font-weight: bold;">MACBOT<span style="color: #fff">WEB</span>
                            </span>
                        </div>
                     

                        <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block"
                                data-fuse-aside-toggle-fold>
                            <i class="icon icon-backburger"></i>
                        </button>
                    </div>

                    <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item">
                        
                        <?php if(isset($_layoutParams['menu_left'])): ?>
                        <?php foreach($_layoutParams['menu_left'] as $key => $val): ?>
                            <li class="subheader fixed-subheader-nav" style="height: 5.1rem !important;">
                                <span><?php echo $key;?></span>
                            </li>
                            <?php foreach($val as $sub_key => $sub_val): ?>
                                <?php

                                if(!is_array($sub_val['id'])){
                                    if($item && $sub_val['id'] == $item)
                                    {
                                      $_item_style_active = 'active';
                                    }
                                    else
                                    {
                                      $_item_style_active = '';
                                    }
                                }else{
                                    if(in_array($item , $sub_val['id']))
                                    {
                                      $_item_style_active = 'active';
                                    }
                                    else
                                    {
                                      $_item_style_active = '';
                                    }
                                }

                                ?>
                                    <?php if(!isset($sub_val['sub-menu'])): ?>
                                    <li class="nav-item fixed-bg-nav">
                                        <a class="nav-link ripple " href="<?php echo $sub_val['url']; ?>"
                                           data-page-url="/apps-dashboards-project.html">
                                            <i class="icon s-4 <?php echo $sub_val['icon']; ?>"></i>
                                            <span><?php echo $sub_val['title']; ?></span>
                                        </a>
                                    </li>
                                    <?php else: ?>
                                    <li class="nav-item fixed-bg-nav" role='tab' id="heading-<?php echo $sub_val['id'][0]; ?>">
                                        <a class="nav-link ripple with-arrow "
                                           data-toggle="collapse"
                                           data-target="#collapse-<?php echo $sub_val['id'][0]; ?>"
                                           href="<?php echo $sub_val['url']; ?>"
                                           aria-expanded="true"
                                           aria-controls="collapse-<?php echo $sub_val['id'][0]; ?>">
                                            <i class="icon s-4 <?php echo $sub_val['icon']; ?>"></i>
                                            <span><?php echo $sub_val['title']; ?></span>
                                        </a>
                                        <?php if(isset($sub_val['sub-menu'])): ?>
                                        <ul id="collapse-<?php echo $sub_val['id'][0]; ?>"
                                            class="collapse <?php if($_item_style_active == "active") echo "show" ?>"
                                            role="tabpanel"
                                            aria-labelledby="heading-<?php echo $sub_val['id'][0]; ?>"
                                            data-children=".nav-item">
                                            <?php 
                                            foreach($sub_val['sub-menu'] as $val_menu): 
                                                if($item && $val_menu['id'] == $item)
                                                {
                                                  $_sub_item_style_active = 'active';
                                                }
                                                else
                                                {
                                                  $_sub_item_style_active = '';
                                                }    
                                            ?>                                    
                                            <li class="nav-item fixed-bg-nav">
                                                <a class="nav-link ripple <?php echo $_sub_item_style_active; ?>" href="<?php echo $val_menu["url"];?>"
                                                   data-page-url="/apps-dashboards-project.html" >
                                                    
                                                    <span style="font-weight: bold; color: #FFF; font-size: 13px">
                                                    <?php echo $val_menu["title"];?>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>                                
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?> 
                        <?php endforeach; ?>
                        <?php endif; ?> 

                    </ul>
                </div>
            </div>
        </aside>
        
        <?php if(isset($this->error)): ?>
        <div class="alert alert-block alert-danger fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <?php echo $this->error;?>
        </div>

        <?php endif; ?>


        <?php if(isset($this->iscorrect)): ?>
        <div class="alert alert-success alert-block fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <h4>
                <i class="icon-ok-sign"></i>
                Success!
            </h4>
            <p><?php echo $this->iscorrect;?></p>
        </div>

        <?php endif; ?>

