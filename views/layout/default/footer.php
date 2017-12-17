           </div>
        </div>

        <div class="quick-panel-sidebar" fuse-cloak data-fuse-bar="quick-panel-sidebar" data-fuse-bar-position="right">
            <div class="list-group" class="date">
                <div class="list-group-item subheader">TODAY</div>
                <div class="list-group-item two-line">
                    <div class="text-muted">
                        <div class="h1"> Monday</div>
                        <div class="h2 row no-gutters align-items-start">
                            <span> 18</span>
                            <span class="h6">th</span>
                            <span> Sep</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="list-group">
                <div class="list-group-item subheader">Events</div>
                <div class="list-group-item two-line">
                    <div class="list-item-content">
                        <h3>Group Meeting</h3>
                        <p>In 32 Minutes, Room 1B</p>
                    </div>
                </div>
                <div class="list-group-item two-line">
                    <div class="list-item-content">
                        <h3> Session</h3>
                        <p>20:30 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var start_calendar_day, end_calendar_day = null;
        start_calendar_day = <?php if(isset($this->date_calendar['start_date'])) { echo $this->date_calendar['start_date']; } else { echo 30; }  ?>;
        end_calendar_day   = <?php if(isset($this->date_calendar['start_date'])) { echo $this->date_calendar['end_date']; } else { echo 1; }  ?>;
    </script>

        
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>jquery.dcjqaccordion.2.7.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>jquery.scrollTo.min.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>jquery.nicescroll.js"></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>skycons/skycons.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>jquery.scrollTo/jquery.scrollTo.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>calendar/clndr.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>calendar/moment-2.2.1.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>evnt.calendar.init.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>gauge/gauge.js"></script>
        <!--clock init-->
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>css3clock/js/css3clock.js"></script>
        <!--Easy Pie Chart-->
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>easypiechart/jquery.easypiechart.js"></script>
        <!--Sparkline Chart-->
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>sparkline/jquery.sparkline.js"></script>
        

        <!--Morris Chart-->
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>morris-chart/morris.js"></script>
        <script src="<?php echo $_layoutParams['root_js']; ?>morris-chart/raphael-min.js"></script>
-->
        <!--jQuery Flot Chart-->
        <!--<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>-->


        <!--<script src="<?php echo $_layoutParams['root_js']; ?>highcharts/highcharts.js"></script>-->
        <!--<script src="https://code.highcharts.com/modules/exporting.js"></script>
        
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>jquery.customSelect.min.js" ></script>-->
        <!--common script init for all pages-->
        <!--<script src="<?php echo $_layoutParams['root_js']; ?>scripts.js"></script>-->




        

        <!-- / JAVASCRIPT -->
    </body>
</html>