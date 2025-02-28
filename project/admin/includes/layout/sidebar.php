<?php 
    
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">David Grey. H</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item <?php //p == 'active' ?> ">
            <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?p=slideshows">
                <span class="menu-title">Slideshows</span>
                <i class="mdi mdi-application menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?p=products">
                <span class="menu-title">Products</span>
                <i class="mdi mdi-package menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?p=users">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?p=settings">
                <span class="menu-title">Settings</span>
                <i class="mdi mdi-cog menu-icon"></i>
            </a>
        </li>
        
    </ul>
</nav>