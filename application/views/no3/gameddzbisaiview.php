<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <body>
        
        
     
        <div id="modal-tree-items" class="modal" tabindex="-1">
            <div class="modal-dialog" style="width:850px;margin-top: 100px;">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">斗地主比赛场数据填写表</h4>
                    </div>

                    <div class="modal-body">

                        <table id="sample-table-congzhi" class="table table-striped table-bordered table-hover">
                            <thead id="targetheadcongzhi">
                                <tr>
                                    <th >基本类型名称</th>
                                    <th>基本类型内容</th>
                                    <th>高级类型名称</th>
                                    <th>高级类型内容</th>
                                    
                                </tr>
                            </thead>

                            <tbody id="targetbodycongzhi">
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; ">比赛ID</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="tournamentRoomID" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">比赛简介</td>
                                    <td  width="80"  style="padding: 2px; "><input id="tournamentDesc" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; ">游戏类型</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; ">
                                        <!--<input id="gameType" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  />-->
                                        
                                        <select class="zsh-select form-control"  id="gameType" data-placeholder="Choose a game..."  value="100"  style="height:100%;width:100%;border: 0px;background-color:transparent;">
                                        <option value="100">经典场</option>
                                        <option value="99">欢乐场</option>
                                        <option value="103">赖子场</option>
                                        </select>
                                        
                                        </td>
                                    <td  width="80"  style="padding: 2px; "> 预赛局数</td>
                                    <td  width="80"  style="padding: 2px; "><input id="preliminaryBoutCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                
                              <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                  <!--  <td width="60" style="padding: 2px; ">比赛类型</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="tournamentGameType" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>-->
                                  <td width="60" style="padding: 2px; ">开赛方式</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; ">
                                       <!-- <input id="tournamentStartKey" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  />-->
                                        
                                        <select class="zsh-select form-control"  id="tournamentStartKey" data-placeholder="Choose a game..."  value="1"  style="height:100%;width:100%;border: 0px;background-color:transparent;">
                                        <option value="1">流水赛</option>
                                        <option value="2">定时赛</option>
                                        </select>
                                    </td>
                                    <td  width="80"  style="padding: 2px; ">预赛轮数</td>
                                    <td  width="80"  style="padding: 2px; "><input id="preliminaryRoundCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; ">比赛标签</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; ">
                                        
                                       <!-- <input id="tournamentFlag" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  />  -->
                                        
                                        <select class="zsh-select form-control"  id="tournamentFlag" data-placeholder="Choose a game..."  value="0"  style="height:100%;width:100%;border: 0px;background-color:transparent;">
                                        <option value="0">普通</option>
                                        <option value="1">免费</option>
                                        <option value="2">豪华</option>
                                        </select>
                                    
                                    </td>
                                    <td  width="80"  style="padding: 2px; ">底分增幅增长</td>
                                    <td  width="80"  style="padding: 2px; "><input id="preliminaryRoundCount" class="baseScoreIncrementGrowth" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; ">比赛名称</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="tournamentName" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">加赛局数</td>
                                    <td  width="80"  style="padding: 2px; "><input id="extraBoutCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                        
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; ">最低人数</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="minApplyCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; "> 决赛轮数</td>
                                    <td  width="80"  style="padding: 2px; "> <input id="finalRoundCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; ">最高人数</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="maxApplyCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; "> 预赛截至人数</td>
                                    <td  width="80"  style="padding: 2px; "> <input id="preliminaryCutOffCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; "> 比赛奖励ID</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="rewardID" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">底分增长幅度</td>
                                    <td  width="80"  style="padding: 2px; "><input id="baseScoreIncrement" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                 <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; "> 开始日期（年）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="startyear" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">底分增长间隔</td>
                                    <td  width="80"  style="padding: 2px; "><input id="baseScoreGrowthInterval" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                     <td width="60" style="padding: 2px; "> 开始日期（月）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="startmonth" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">VIP等级限制</td>
                                    <td  width="80"  style="padding: 2px; "><input id="vipLevelLimit" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                     <td width="60" style="padding: 2px; "> 开始日期（日）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="startday" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">间隔时间(分)</td>
                                    <td  width="80"  style="padding: 2px; "><input id="period" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; "> 开始日期（时）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="starthour" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td  width="80"  style="padding: 2px; ">是否闹钟提示</td>
                                    <td  width="80"  style="padding: 2px; "><input id="useClock" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; "> 开始日期（分）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="startminute" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                     <td width="60" style="padding: 2px; ">用户初始积分</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="initialUserScore" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                     <td width="60" style="padding: 2px; "> 结束日期（年）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="stopyear" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                     <td  width="80"  style="padding: 2px; ">决赛局数</td>
                                    <td  width="80"  style="padding: 2px; "><input id="finalBoutCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                               <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                    <td width="60" style="padding: 2px; "> 结束日期（月）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="stopmonth" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                    <td width="60" style="padding: 2px; "> 报名费类型</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; ">
                                       <!-- <input id="applyFeeType" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  />  -->
                                        <select class="zsh-select form-control"  id="applyFeeType" data-placeholder="Choose a game..."  value="0"  style="height:100%;width:100%;border: 0px;background-color:transparent;">
                                        <option value="0">金豆</option>
                                        <option value="7">参赛劵</option>
                                        </select>
                                        
                                    </td>
                                    

                                </tr>
                                
                                <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                     <td width="60" style="padding: 2px; "> 结束日期（日）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="stopday" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                     <td  width="80"  style="padding: 2px; "> 决赛晋级人数</td>
                                    <td  width="80"  style="padding: 2px; "><input id="finalPromotedCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>
                                
                               <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                     <td width="60" style="padding: 2px; "> 结束日期（时）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="stophour" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                   <td width="60" style="padding: 2px; ">报名费数量</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="applyFeeCount" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                   

                                </tr>
                                
                                 <tr class="mynumcongzhi" porderid="${orderid}" pnumber="${ mobile}" pprice="${price}" id="ix${orderid}">
                                     <td width="60" style="padding: 2px; "> 结束日期（分）</td>
                                    <td width="80" class="hidden-480" style="padding: 2px; "><input id="stopminute" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>
                                     <td  width="80"  style="padding: 2px; ">初始底分</td>
                                    <td  width="80"  style="padding: 2px; "><input id="initialBaseScore" class="tomodifyheight" type="text" value="0"  style = "width:100%;height:100%;margin: -1px;border: 0px;background-color:transparent;"  /></td>

                                </tr>

                            </tbody>
                        </table>



                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>取消</button>
                        <button class="btn btn-sm btn-primary" onclick="javascript:commitid();"><i class="ace-icon fa fa-check"></i> 提交</button>
                    </div>

                </div>
            </div>
        </div>      
        
        
        
        

    <script id="datamodel1" type="text/html" >
        <tr id="model_id_${tournamentRoomID}">
            <td width="60" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${tournamentRoomID}</td>
            <td width="80" class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${gameType}</td>
            <td  width="80"  style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${tournamentGameType}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${tournamentName}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${minApplyCount}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${maxApplyCount}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${applyFeeType}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${applyFeeCount}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${rewardID}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${startyear}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${startmonth}</td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${startday}</td>
       
            <td  style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;width:140px;">
                 <div class="widget-toolbox padding-8 clearfix">
                <button class="btn btn-xs smaller btn-success "   onclick="javascript: insert_data1(
                    ${tournamentRoomID},
                    ${gameType},
                    ${tournamentFlag},
                    ${baseScoreIncrementGrowth},
                    ${tournamentStartKey},
                    ${tournamentGameType},
                    '${tournamentName}',
                    '${tournamentDesc}',
                    ${preliminaryBoutCount},
                    ${preliminaryRoundCount},
                    ${extraBoutCount},
                    ${finalBoutCount},
                    ${finalRoundCount},
                    ${preliminaryCutOffCount},
                    ${finalPromotedCount},
                    ${initialBaseScore},
                    ${baseScoreIncrement},
                    ${baseScoreGrowthInterval},
                    ${initialUserScore},
                    ${minApplyCount},
                    ${maxApplyCount},
                    ${applyFeeType},
                    ${applyFeeCount},
                    ${rewardID},
                    ${startyear},
                    ${startmonth},
                    ${startday},
                    ${starthour},
                    ${startminute},
                    ${stopyear},
                    ${stopmonth},
                    ${stopday},
                    ${stophour},
                    ${stopminute},
                    ${period},
                    ${vipLevelLimit},
                    ${useClock})" data-toggle="dropdown"  style="height:25px;">
                    修改
                    <i class="icon-save icon-on-right"></i>
                </button>
                <button class="btn btn-xs smaller btn-success "   onclick="javascript: delete_data(${tournamentRoomID})" data-toggle="dropdown"  style="height:25px;">
                    删除
                    <i class="icon-remove icon-on-right"></i>
                </button>
                     </div>
            </td>
            
        </tr>
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
                        <!--    <?php $this->load->view('no3/common/nav_top2', $header3); ?>  -->

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-blue2">
                                            <h5><i class="icon-arrow-left"></i>斗地主比赛场管理 </h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>


                                        <div class="widget-toolbox padding-8 clearfix">
                                            
                                             
                                             <button onclick="javascript:allreflesh()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                             <button onclick="javascript:insert_data()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">添加</span>

                                                <i class="icon-plus icon-on-right"></i>
                                            </button>
                                            
                                         </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">


                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                         <tr>
                                                             <th >比赛ID</th>
                                                             <th>游戏类型</th>
                                                             <th>比赛类型</th>
                                                             <th>比赛名称</th>
                                                             <th>最低人数</th>
                                                             <th>最高人数</th>
                                                             <th>报名费类型</th>
                                                             <th>报名费数额</th>
                                                             <th>比赛奖励ID</th>
                                                             <th>开始日期</th>
                                                             <th>结束日期</th>
                                                             <th>时间间隔(分)</th>
                                                             <th>操作</th>
                                                         </tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“ 保存”，将配置保存到服务器上。</div>

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
    
   
		
    <script src="../res/js/chosen.jquery.min.js"></script>
    <script src="../res/js/fuelux/fuelux.spinner.min.js"></script>
     
    <script src="../res/js/jquery.knob.min.js"></script>
    <script src="../res/js/jquery.autosize.min.js"></script>
    <script src="../res/js/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="../res/js/jquery.maskedinput.min.js"></script>
    <script src="../res/js/bootstrap-tag.min.js"></script>
   
    <!-- ace scripts -->

    <script src="../res/js/jquery.dataTables.min.js"></script>
    <script src="../res/js/jquery.dataTables.bootstrap.js"></script>

    <script src="../res/js/ace-elements.min.js"></script>
    <script src="../res/js/ace.min.js"></script>
    <script src="../res/js/jspacket.js"></script>
    <!-- inline scripts related to this page -->

    <script type="text/javascript">
        
        var current_gamecode = 0;
        var current_roomid = 0;
        var roomindex = 0;
        
        function reset() {
            $("#userid1").val(userid_back);
        }
        
         function  changegname(key,value){
           current_gamecode = key;
           $("#tipmessage").html("  当前游戏ID："+current_gamecode+",房间ID："+current_roomid);
         }
        
         function  changeroom(key,value){
            current_roomid = key;
            $("#tipmessage").html("当前游戏ID："+current_gamecode+",房间ID："+current_roomid);
        }
        
        function delete_data(id){
            var packet = {
                action: 'get_online_data',
                id :id,
                 };
              
            function onsuccess(data) {
                if(data === "true")
                 $("#model_id_"+id).remove();
            }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/do_delete_gamemessage_data", packet, onsuccess, onerrors);
        }
        
         
        function insert_data1(
                    tournamentRoomID,
                    gameType,
                    tournamentFlag,
                    baseScoreIncrementGrowth,
                    tournamentStartKey,
                    tournamentGameType,
                    tournamentName,
                    tournamentDesc,
                    preliminaryBoutCount,
                    preliminaryRoundCount,
                    extraBoutCount,
                    finalBoutCount,
                    finalRoundCount,
                    preliminaryCutOffCount,
                    finalPromotedCount,
                    initialBaseScore,
                    baseScoreIncrement,
                    baseScoreGrowthInterval,
                    initialUserScore,
                    minApplyCount,
                    maxApplyCount,
                    applyFeeType,
                    applyFeeCount,
                    rewardID,
                    startyear,
                    startmonth,
                    startday,
                    starthour,
                    startminute,
                    stopyear,
                    stopmonth,
                    stopday,
                    stophour,
                    stopminute,
                    period,
                    vipLevelLimit,
                    useClock){
                    $('#modal-tree-items').modal('show');
                    
                    $("#gameType").attr("value",gameType);
                    $("#applyFeeType").attr("value",applyFeeType);
                    $("#tournamentFlag").attr("value",tournamentFlag);
                    $("#tournamentStartKey").attr("value",tournamentStartKey);
                    
                    $("#gameType").val(gameType);
                    $("#tournamentFlag").val(tournamentFlag);
                    $("#baseScoreIncrementGrowth").val(baseScoreIncrementGrowth);
                    $("#tournamentStartKey").val(tournamentStartKey);
                    $("#tournamentGameType").val(tournamentGameType);
                    $("#tournamentRoomID").val(tournamentRoomID);
                    $("#tournamentName").val(tournamentName);
                    $("#tournamentDesc").val(tournamentDesc);
                    $("#preliminaryBoutCount").val(preliminaryBoutCount);
                    $("#preliminaryRoundCount").val(preliminaryRoundCount);
                    $("#extraBoutCount").val(extraBoutCount);
                    $("#finalBoutCount").val(finalBoutCount);
                    $("#finalRoundCount").val(finalRoundCount);
                    $("#preliminaryCutOffCount").val(preliminaryCutOffCount);
                    $("#finalPromotedCount").val(finalPromotedCount);
                    $("#initialBaseScore").val(initialBaseScore);
                    $("#baseScoreIncrement").val(baseScoreIncrement);
                    $("#baseScoreGrowthInterval").val(baseScoreGrowthInterval);
                    $("#initialUserScore").val(initialUserScore);
                    $("#minApplyCount").val(minApplyCount);
                    $("#maxApplyCount").val(maxApplyCount);
                    $("#applyFeeType").val(applyFeeType);
                    $("#applyFeeCount").val(applyFeeCount);
                    $("#rewardID").val(rewardID);
                    $("#startyear").val(startyear);
                    $("#startmonth").val(startmonth);
                    $("#startday").val(startday);
                    $("#starthour").val(starthour);
                    $("#startminute").val(startminute);
                    $("#stopyear").val(stopyear);
                    $("#stopmonth").val(stopmonth);
                    $("#stopday").val(stopday);
                    $("#stophour").val(stophour);
                    $("#stopminute").val(stopminute);
                    $("#period").val(period);
                    $("#vipLevelLimit").val(vipLevelLimit);
                    $("#useClock").val(useClock);
                    
       
        }
        
        
        function commitid(){
            
         var  gameType=$("#gameType").val();
         var  tournamentGameType=2;
         var  tournamentFlag=$("#tournamentFlag").val();
         var  baseScoreIncrementGrowth=$("#baseScoreIncrementGrowth").val();
         var  tournamentStartKey=$("#tournamentStartKey").val();
         var  tournamentRoomID=$("#tournamentRoomID").val();
         var  tournamentName=$("#tournamentName").val();
         var  tournamentDesc=$("#tournamentDesc").val();
         var  preliminaryBoutCount=$("#preliminaryBoutCount").val();
         var  preliminaryRoundCount=$("#preliminaryRoundCount").val();
         var  extraBoutCount=$("#extraBoutCount").val();
         var  finalBoutCount=$("#finalBoutCount").val();
         var  finalRoundCount=$("#finalRoundCount").val();
         var  preliminaryCutOffCount=$("#preliminaryCutOffCount").val();
         var  finalPromotedCount=$("#finalPromotedCount").val();
         var  initialBaseScore=$("#initialBaseScore").val();
         var  baseScoreIncrement=$("#baseScoreIncrement").val();
         var  baseScoreGrowthInterval=$("#baseScoreGrowthInterval").val();
         var  initialUserScore=$("#initialUserScore").val();
         var  minApplyCount=$("#minApplyCount").val();
         var  maxApplyCount=$("#maxApplyCount").val();
         var  applyFeeType=$("#applyFeeType").val();
         var  applyFeeCount=$("#applyFeeCount").val();
         var  rewardID=$("#rewardID").val();
         var  startyear=$("#startyear").val();
         var  startmonth=$("#startmonth").val();
         var  startday=$("#startday").val();
         var  starthour=$("#starthour").val();
         var  startminute=$("#startminute").val();
         var  stopyear=$("#stopyear").val();
         var  stopmonth=$("#stopmonth").val();
         var  stopday=$("#stopday").val();
         var  stophour=$("#stophour").val();
         var  stopminute=$("#stopminute").val();
         var  period= $("#period").val();
         var  vipLevelLimit=$("#vipLevelLimit").val();
         var  useClock=$("#useClock").val();
         
         
         var packet = {
           action: 'get_online_data',
           gameType:gameType,
           tournamentFlag:tournamentFlag,
           baseScoreIncrementGrowth:baseScoreIncrementGrowth,
           tournamentStartKey:tournamentStartKey,
           tournamentGameType:tournamentGameType,
           tournamentRoomID:tournamentRoomID,
           tournamentName:tournamentName,
           tournamentDesc:tournamentDesc,
           preliminaryBoutCount:preliminaryBoutCount,
           preliminaryRoundCount:preliminaryRoundCount,
           extraBoutCount:extraBoutCount,
           finalBoutCount:finalBoutCount,
           finalRoundCount:finalRoundCount,
           preliminaryCutOffCount:preliminaryCutOffCount,
           finalPromotedCount:finalPromotedCount,
           initialBaseScore:initialBaseScore,
           baseScoreIncrement:baseScoreIncrement,
           baseScoreGrowthInterval:baseScoreGrowthInterval,
           initialUserScore:initialUserScore,
           minApplyCount:minApplyCount,
           maxApplyCount:maxApplyCount,
           applyFeeType:applyFeeType,
           applyFeeCount:applyFeeCount,
           rewardID:rewardID,
           startyear:startyear,
           startmonth:startmonth,
           startday:startday,
           starthour:starthour,
           startminute:startminute,
           stopyear:stopyear,
           stopmonth:stopmonth,
           stopday:stopday,
           stophour:stophour,
           stopminute:stopminute,
           period:period,
           vipLevelLimit:vipLevelLimit,
           useClock:useClock,
                 };
              
               function onsuccess(data) {
                  alert(tournamentRoomID+"号配置返回："+data);
                  $('#modal-tree-items').modal('hide');
               }
               function onerrors(data) {
                // alert(objtostr(data))
              }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/do_bisaicheng_gamemessage_data", packet, onsuccess, onerrors);
          }
        
        function insert_data(){
             $('#modal-tree-items').modal('show');
             
                    $("#gameType").attr("value",100);
                    $("#applyFeeType").attr("value",0);
                    $("#tournamentFlag").attr("value",0);
                    $("#tournamentStartKey").attr("value",1);
                    
                    $("#gameType").val(100);
                    $("#tournamentStartKey").val(1);
                    $("#tournamentFlag").val(0);
                    $("#tournamentRoomID").val(1);
                    $("#tournamentName").val("为人民服务");
                    $("#tournamentDesc").val("hahahahaceshi");
                    $("#preliminaryBoutCount").val(1);
                    $("#preliminaryRoundCount").val(2);
                    $("#extraBoutCount").val(1);
                    $("#finalBoutCount").val(2);
                    $("#finalRoundCount").val(2);
                    $("#preliminaryCutOffCount").val(12);
                    $("#finalPromotedCount").val(10);
                    $("#initialBaseScore").val(100);
                    $("#baseScoreIncrement").val(20);
                    $("#baseScoreGrowthInterval").val(5);
                    $("#initialUserScore").val(10000);
                    $("#minApplyCount").val(10);
                    $("#maxApplyCount").val(20);
                    $("#applyFeeType").val(0);
                    $("#applyFeeCount").val(100);
                    $("#rewardID").val(1);
                    $("#startyear").val(1991);
                    $("#startmonth").val(10);
                    $("#startday").val(1);
                    $("#starthour").val(10);
                    $("#startminute").val(30);
                    $("#stopyear").val(1991);
                    $("#stopmonth").val(10);
                    $("#stopday").val(1);
                    $("#stophour").val(10);
                    $("#stopminute").val(30);
                    $("#period").val(5);
                    $("#vipLevelLimit").val(2);
                    $("#useClock").val(0);
                    
                      $(".zsh-select").each(function(e) {
                      var value = $(this).attr("value");
                       $(this).val(value);
                     });
            /*
             roomindex = roomindex+1;
              var packet = 
               {"gameType":100,"tournamentGameType":2,"tournamentRoomID":roomindex,"tournamentName":"","minApplyCount":10,"maxApplyCount":20,"applyFeeType":0,"applyFeeCount":100,"rewardID":1,"startyear":"","startmonth":"","startday":"","starthour":"","startminute":"","stopyear":"","stopmonth":"","stopday":"","stophour":"","stopminute":"","period":5,"vipLevelLimit":2,"useClock":0};
             $("#targetbody").append($("#datamodel1").tmpl(packet));
             */
        }
        
        function allreflesh(){
            $("#targetbody").html("");
            var packet = {
                action: 'get_online_data',
                 gameid:  current_gamecode,
               };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var reward = datax["reward"];
                var myconfig = datax["config"];
                 for (var i in myconfig){
                   if(myconfig[i]["tournamentRoomID"]> roomindex)  roomindex = myconfig[i]["tournamentRoomID"];
                }
                $("#targetbody").html($("#datamodel1").tmpl(myconfig));
            }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/get_allgamemessage_data", packet, onsuccess, onerrors);
         }
        
        function get_online_data() {
            $("#targetbody").html("");
            var packet = {
                action: 'get_online_data',
                 gameid:  current_gamecode,
                 roomid: current_roomid,
             };
            function onsuccess(data) {
                
                var datax = eval("(" + data + ")");
                 $("#targetbody").html($("#datamodel1").tmpl(datax));
            }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/get_gamemessage_data", packet, onsuccess, onerrors);
        }

        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        
    </script>
</body>
</html>
