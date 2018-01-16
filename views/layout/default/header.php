
<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo $this->title;?></title>

        <!-- STYLESHEETS -->
        <style type="text/css">
            [fuse-cloak],
            .fuse-cloak {
                display: none !important;
            }
        </style>
        <link id="page_favicon" href="<?php echo $_layoutParams['root_img']; ?>favicon.ico" rel="icon" type="image/x-icon" />
        <!-- Icons.css -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>icons/fuse-icon-font/style.css">
        <!-- Animate.css -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>animate.css/animate.min.css">
        <!-- PNotify -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>pnotify/pnotify.custom.min.css">
        <!-- Nvd3 - D3 Charts -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>nvd3/build/nv.d3.min.css"/>
        <!-- Perfect Scrollbar -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>perfect-scrollbar/css/perfect-scrollbar.min.css"/>
        <!-- Fuse Html -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>fuse-html/fuse-html.min.css"/>
        <!-- Main CSS -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>main.css">
        
        <link rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>bootstrap-select/dist/css/bootstrap-select.css">
        <!-- Style MB CSS -->
        <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>mb-style.css">
        <!-- / STYLESHEETS -->

        <!-- JAVASCRIPT -->
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>jquery/dist/jquery.min.js"></script>
        <!-- Mobile Detect -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>mobile-detect/mobile-detect.min.js"></script>
        <!-- Perfect Scrollbar -->
        <script type="text/javascript"
                src="<?php echo $_layoutParams['root_js']; ?>perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
        <!-- Popper.js -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>popper.js/index.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>bootstrap/bootstrap.min.js"></script>

        <!-- Nvd3 - D3 Charts -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>d3/d3.min.js"></script>
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>nvd3/build/nv.d3.min.js"></script>
        <!-- PNotify -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>pnotify/pnotify.custom.min.js"></script>
        <!-- Fuse Html -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>fuse-html/fuse-html.min.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>bootstrap-select/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>datatables.net/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>datatables-responsive/js/dataTables.responsive.js"></script>
        <!-- Main JS -->
        <script type="text/javascript" src="<?php echo $_layoutParams['root_js']; ?>main.js"></script>

        <?php if( isset($_layoutParams['js']) && count($_layoutParams['js']) ): ?>
            <?php for($i=0; $i < count($_layoutParams['js']); $i++): ?>
                <script type="text/javascript" src="<?php echo $_layoutParams['js'][$i]; ?>"></script>
            <?php endfor; ?>
        <?php endif; ?>
    </head>
