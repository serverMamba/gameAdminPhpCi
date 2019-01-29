
<ul class="nav nav-list">
    <?php foreach ($menu as $k1 => $row1) { ?>

        <li class="<?php if ($choose['father'] == $k1) echo 'active open'; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="<?php echo  $row1['cls'] ?>"></i>
                <span class="menu-text"> <?php echo $k1 ?> </span>

                <b class="arrow icon-angle-down"></b>
            </a>
            
            <ul class="submenu">
                <?php foreach ($row1["child"] as $k2 => $row2) { ?>
                    <li class="<?php if ($choose['child'] == $row2['name']) echo 'active'; ?>">
                        <a href="<?php echo  $row2['url'] ?>">
                            <i class="<?php echo  $row2['cls'] ?>"></i>
                            <?php echo $row2["name"] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>

    <?php } ?>

</ul><!-- /.nav-list -->