<aside style="position: fixed;" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo BASE_URL . '/public/images/favicon.ico' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="background-color: white;">
        <span class="brand-text font-weight-light">IVY Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_URL . '/public/images/admin.jpg' ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=home' ?>" class="nav-link 
                        <?php
                        if ((exist_param('home')) || !isset($_GET['action'])) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=categories' ?>" class="nav-link
                        <?php
                        if ((exist_param('categories'))) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-solid fa-layer-group"></i>
                        <p>
                            Loại hàng
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=products' ?>" class="nav-link
                        <?php
                        if ((exist_param('products'))) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-brands fa-product-hunt"></i>
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=users' ?>" class="nav-link 
                        <?php
                        if ((exist_param('users'))) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            Người dùng
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=comments' ?>" class="nav-link
                        <?php
                        if ((exist_param('comments'))) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-solid fa-comment"></i>
                        <p>
                            Bình luận
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=invoices' ?>" class="nav-link
                        <?php
                        if ((exist_param('invoices'))) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p>
                            Hóa đơn
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/admin/?action=statistics' ?>" class="nav-link 
                        <?php
                        if ((exist_param('statistics'))) {
                            echo 'active';
                        } ?>
                    ">
                        <i class="nav-icon fa-solid fa-chart-simple"></i>
                        <p>
                            Thống kê
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>