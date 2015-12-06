
<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Dashboard
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                المستخدمين <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('users/create') ?>">تسجيل حساب جديد</a></li>
                <li><a href="<?php echo site_url('users') ?>">عرض المستخدمين</a></li>
            </ul>
        </li>
        <li>
            <a href="<?php echo site_url('topic-types'); ?>">Topic Types</a>
        </li>
        <li>
            <a href="<?php echo site_url('document-types'); ?>">Document Types</a>
        </li>
        <li>
            <a href="<?php echo site_url('topics'); ?>">Topics</a>
        </li>
        <li>
            <a href="<?php echo site_url('documents'); ?>">Documents</a>
        </li>
        <li>
            <a class="navbar-brand" href="<?php echo site_url('backend/logout'); ?>">خروج</a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->