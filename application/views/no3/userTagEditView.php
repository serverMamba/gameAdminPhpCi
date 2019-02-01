<?php
$rearrangedChannels = array();
$ITEMS_PER_LINE = 8;
$channelsCount = count($allChannelList);

$lines = $channelsCount / $ITEMS_PER_LINE;
if ($channelsCount % $ITEMS_PER_LINE > 0) {
    $lines++;
}

for ($i = 0; $i < $channelsCount; $i++) {
    if ($i % $ITEMS_PER_LINE == 0) {
        $rearrangedChannels[] = array();
    }

    $row = $i / $ITEMS_PER_LINE;
    $rearrangedChannels[$row][] = $allChannelList[$i];
}

?>
<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('no3/common/header'); ?>

<body>
<?php $this->load->view('no3/common/message'); ?>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#"> <span
                class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed')
                } catch (e) {
                }
            </script>

            <?php $this->load->view('no3/common/nav_shortcut'); ?>

            <?php $this->load->view('no3/common/nav_left1'); ?>

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left"
                   data-icon1="icon-double-angle-left"
                   data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {
                }
            </script>
        </div>

        <div class="main-content">
            <?php $this->load->view('no3/common/nav_top'); ?>

            <div class="page-content">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success"
                         role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger"
                         role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 widget-container-span">
                                <div class="widget-box">
                                    <div class="widget-body">
                                        <div class="widget-main" style="padding: 0;">
                                            <form class="form-horizontal" action="<?php echo site_url('no3/userTag/edit'); ?>" method="post">
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <input type="hidden" class="form-control" id="id" name="id"
                                                               placeholder="" value="<?php if (isset($oldValue['name'])) {
                                                            echo $oldValue['id'];
                                                        } ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-1 control-label">标签名称</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="name" name="name"
                                                               placeholder="" value="<?php if (isset($oldValue['name'])) {
                                                            echo $oldValue['name'];
                                                        } ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-1 control-label">自动出款</label>
                                                    <div class="col-sm-4">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="autoMoney"
                                                                   value="1" <?php if (isset($oldValue['autoMoney']) && $oldValue['autoMoney'] == 1) { ?> checked="checked" <?php } ?>>
                                                            是
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="autoMoney"
                                                                   value="2" <?php if (isset($oldValue['autoMoney']) && $oldValue['autoMoney'] == 2) { ?> checked="checked" <?php } ?>>
                                                            否
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-1 control-label">排序</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="sort" name="sort"
                                                               placeholder="" value="<?php if (isset($oldValue['sort'])) {
                                                            echo $oldValue['sort'];
                                                        } ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-default">提交</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="modal-body no-padding"></div>

                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.page-content -->
        </div>
        <!-- /.main-content -->
        <!-- /#ace-settings-container -->
    </div>
    <!-- /.main-container-inner -->
</div>
<!-- /.main-container -->
<script src="<?php echo base_url() . 'res/js/jquery-2.0.3.min.js'; ?>"></script>
<script
    src="<?php echo base_url() . 'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/ace-elements.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/ace.min.js'; ?>"></script>
<script>
    function init() {
        if ($('#allSelect').checked) {
            $('#channelsTable').hide();
        }
        else {
            $(".tagSelect").each(function () {
                dealWithSelectionChange(this);
            });
        }
    }

    function dealWithSelectionChange(em) {
        if (em.checked) {
            $(em).next().css("color", "red");
        }
        else {
            $(em).next().css("color", "");
        }
    }

    // 初始化，遍历所有的tagSelect
    init();

    // 当选择变化时执行
    $('.tagSelect').change(function () {
            dealWithSelectionChange(this);
        }
    );

    $('#allSelect').change(function () {
            var self = this;
            if (this.checked) {
                // 把其他所有的都设置为不选中
                $('#channelsTable').hide();

                $(".tagSelect").each(function () {
                    if (this != self) {
                        $(this).prop("checked", false);
                        dealWithSelectionChange(this);
                    }
                });
            }
            else {
                $('#channelsTable').show();
            }
        }
    );

    function onclickSelectAll() {
        $(".tagSelect").each(function () {
            if (($(this).attr('id') != 'allSelect') && (!this.checked)) {
                $(this).prop("checked", true);
                dealWithSelectionChange(this);
            }
        });
    }

    function onclickSelectNone() {
        $(".tagSelect").each(function () {
            if (($(this).attr('id') != 'allSelect') && this.checked) {
                $(this).prop("checked", false);
                dealWithSelectionChange(this);
            }
        });
    }

    function onclickSelectReverse() {
        $(".tagSelect").each(function () {
            if ($(this).attr('id') != 'allSelect') {
                if (this.checked) {
                    $(this).prop("checked", false);
                }
                else {
                    $(this).prop("checked", true);
                }
                dealWithSelectionChange(this);
            }
        });
    }
</script>
</body>
</html>