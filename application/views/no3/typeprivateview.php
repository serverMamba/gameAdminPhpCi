<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <body>
        <script id="headmodel1" type="text/html" >
        <tr>
            <th class="center blue  header-color-green">项目</th>
            <th class="center blue  header-color-green"><a href="javascript:void"><i class="icon-double-angle-left choosedataleft"></i></a></th>
            {{each titles}}
            <th  id="mmid${tt}"  status="1"  onclick="javascript:dotimeclick_p('${kk}')" class="center blue header-color-green" style="cursor: pointer;">${tt}</th>
            {{/each}}
            <th class="center blue  header-color-green"> <a href="javascript:void"><i class="icon-double-angle-right choosedataright"></i></a></th>
        </tr>
    </script>


    <script id="datamodel1" type="text/html" >
        {{each rowtitles}}
        <tr class="${key}cls">
            <td class=""><div style="margin-left: 20px;">${value}</div></td>
            <td class="center"><a href="javascript:void"><i class="icon-hospital" onclick="javascript:dotimeclick_q('${key}')"></i></a></td>
            {{each titles}}
            <td class="center" style="padding: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px;">{{tmpl(0) getsumdata(kk,key)}}</td>
            {{/each}}
            <td class="center"> <a href="javascript:void"><i class="icon-beer" onclick="javascript:dotimeclick_w('${key}')"></i></a></td>
        </tr>
        {{/each}}
    </script>


    <?php $this->load->view('no3/common/message', $message); ?>

    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {
            }
        </script>

        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>

            <div class="sidebar" id="sidebar">
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <?php $this->load->view('no3/common/nav_shortcut'); ?>

                <?php $this->load->view('no3/common/nav_left1', $systemconfig, $choose,$menucheck); ?>

                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                </div>

                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
            </div>

            <div class="main-content">
                <?php $this->load->view('no3/common/nav_top', $header1); ?>

                <div class="page-content">
                    <?php $this->load->view('no3/common/nav_top1', $header2); ?>

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->

                            <!--   <?php $this->load->view('no3/common/nav_top2', $header3); ?>   -->



                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-green2">
                                            <h5>
                                                <i class="icon-arrow-left"></i><button onclick="javascript:reflesk()" class="btn btn-xs btn-success " style="margin-top:3px;margin-left:10px;">
                                                    <i class="icon-star-half icon-on-left"></i>
                                                    <span class="bigger-110">刷新</span>
                                                </button>

                                                <button onclick="javascript:saveflesh()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                    <span class="bigger-110">保存</span>
                                                    <i class="icon-search icon-on-right"></i>
                                                </button>
                                            </h5>
                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body" style="margin-top:-1px;">

                                            <div class="widget-main"  style ="padding:0;">

                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover" style="margin-bottom: -1px;margin-left:0px;margin-right:-1px;">
                                                    <thead id="targethead">

                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">单层报表！</div>

                                                </div>

                                                <div class="modal-body no-padding">

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div><!-- /row -->

                            <div class="hr hr32 hr-dotted"></div>

                            <div class="row">

                            </div>

                            <div class="hr hr32 hr-dotted"></div>


                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->

            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="icon-cog bigger-150"></i>
                </div>

                <div class="ace-settings-box" id="ace-settings-box">
                    <div>
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-skin="default" value="#438EB9">#438EB9</option>
                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                            </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                    </div>

                    <div>
                        <input type="checkbox"  class="ace ace-checkbox-2" id="ace-settings-navbar"  />
                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar"  />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                        <label class="lbl" for="ace-settings-add-container">
                            Inside
                            <b>.container</b>
                        </label>
                    </div>
                </div>
            </div><!-- /#ace-settings-container -->
        </div><!-- /.main-container-inner -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->



    <!-- <![endif]-->

    <!--[if IE]>
   
    <![endif]-->

    <!--[if !IE]> -->

    <script type="text/javascript">
        window.jQuery || document.write("<script src='../res/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
    window.jQuery || document.write("<script src='../res/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->

    <script type="text/javascript">
        if ("ontouchend" in document)
            document.write("<script src='../res/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="../res/js/bootstrap.min.js"></script>
    <script src="../res/js/typeahead-bs2.min.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="../res/js/excanvas.min.js"></script>
    <![endif]-->

    <script src="../res/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="../res/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../res/js/jquery.slimscroll.min.js"></script>
    <script src="../res/js/jquery.easy-pie-chart.min.js"></script>
    <script src="../res/js/jquery.sparkline.min.js"></script>
    <script src="../res/js/flot/jquery.flot.min.js"></script>
    <script src="../res/js/flot/jquery.flot.pie.min.js"></script>
    <script src="../res/js/flot/jquery.flot.resize.min.js"></script>

    <script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <!-- ace scripts -->

    <script src="../res/js/jquery.dataTables.min.js"></script>
    <script src="../res/js/jquery.dataTables.bootstrap.js"></script>

    <script src="../res/js/ace-elements.min.js"></script>
    <script src="../res/js/ace.min.js"></script>
    <script src="../res/js/jspacket.js"></script>

    <!-- inline scripts related to this page -->

    <script type="text/javascript">

        var offset = 0;

        var headtitle = new Array();

       <?php foreach ($username as $key => $value) { ?>
            headtitle.push({"tt": "<?php echo $value['name']; ?>", "kk": "<?php echo $key; ?>"});
       <?php } ?>;


        var rowtitle = [
        <?php foreach ($systemconfig as $k1 => $row1) { ?>
        <?php foreach ($row1["child"] as $k2 => $row2) { ?>
                    {"key": "<?php echo $row2['ns']; ?>", "value": "<?php echo "【" . $k1 . "】：" . $row2['name']; ?>"},
        <?php } ?>
        <?php } ?>];

       var rowdata = eval('(' + '<?php echo $plist; ?>' + ')');
              
 
        function getsumdata(name, key) {
            
            if(rowdata[key][name]===1)
            {
              return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + name + '")  id="id' + key + name + '">√</div>';   
            }
            
             if(rowdata[key][name]===0)
            {
              return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + name + '")  id="id' + key + name + '">X</div>';   
            }
        }


        function doclick(key, time) {
            if ($("#id" + key + time).html() == "√") {
                $("#id" + key + time).html("X");
                rowdata[key][time] = 0;
            }
            else {
                $("#id" + key + time).html("√");
                 rowdata[key][time] = 1;
            }
        }
        
        countname =100;
        function dotimeclick_p(name){
            countname = countname +1;
                 for (var itemz in rowtitle) {
                    var key = rowtitle[itemz]["key"];
                    if(countname % 2 === 0)
                    {
                       $("#id" + key + name).html("√");
                        rowdata[key][name] = 1;
                    }else{
                       $("#id" + key + name).html("X"); 
                        rowdata[key][name] = 0;
                    }
             }
        }
        
        function dotimeclick_q(key){
               countname = countname +1;
               for (var itemz in headtitle) {
                    var name = headtitle[itemz]["kk"];
                    if(countname % 2 === 0)
                    {
                       $("#id" + key + name).html("√");
                       rowdata[key][name] = 1;
                    }else{
                       $("#id" + key + name).html("X"); 
                       rowdata[key][name] = 0;
                    }
                 }
          }
        
        function dotimeclick_w(key){
             countname = countname +1;
             for (var itemz in headtitle) {
                    var name = headtitle[itemz]["kk"];
                    if(countname % 2 === 0)
                    {
                       $("#id" + key + name).html("√");
                       rowdata[key][name] = 1;
                    }else{
                       $("#id" + key + name).html("X"); 
                       rowdata[key][name] = 0;
                    }
                 }
        }
        
       function reflesk(){
             var packet = {
                action: 'get_online_data',
             };
            function onsuccess(data) {
                rowdata  = eval("(" + data + ")");
                startdata();
             }
            function onerrors(data) {
                $("#id" + key + name).html("error");
            }
           jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/typeprivate/get_private_data", packet, onsuccess, onerrors);;
       }
       

       
       function saveflesh(){
          // alert(objtostr(rowdata["ywgl_jzsd"]["huanwei"]));
            var packet = {
                action: 'get_online_data',
                data: JSON.stringify(rowdata)
             };
            function onsuccess(data) {
                   alert("写入OK，写入"+data+"字节"); 
            }
            function onerrors(data) {
                $("#id" + key + name).html("error");
            }
           jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/typeprivate/save_private_data", packet, onsuccess, onerrors);
       }

        function startdata() {
             $("#targethead").html("");
            $("#targetbody").html("");
            var headtitle1 = new Array();
            var len = headtitle.length;
            if (offset < 0)
                offset = 0;
            if (offset > (len - 7))
                offset = 0;
            var endticket = offset + 7;
            if (endticket > len)
                endticket = len;
            for (var start = offset; start < endticket; start = start + 1)
            {
                headtitle1.push(headtitle[start]);
            }
            $("#targethead").html($("#headmodel1").tmpl({"titles": headtitle1}));
            $("#targetbody").html($("#datamodel1").tmpl({"titles": headtitle1, "rowtitles": rowtitle}));
            $(".choosedataleft").bind("click", function() {
                offset = offset - 1;
                startdata();
            });
            $(".choosedataright").bind("click", function() {
                offset = offset + 1;
                startdata();
            });
        }
        jQuery(function($) {
            startdata();
        });

    </script>
</body>
</html>
