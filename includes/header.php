<?php
require_once __DIR__ . '/lang.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('college_name'); ?> | <?php echo isset($page_title) ? $page_title : __('motto'); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Login dropdown */
        .login-dropdown { position: relative; }
        .login-btn {
            background-color: var(--accent-color);
            color: #1a202c;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.85rem;
            cursor: pointer;
            white-space: nowrap;
        }
        .login-btn:hover { background-color: #ecc94b; }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 6px);
            background: #fff;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            z-index: 999;
        }
        .login-dropdown:hover .dropdown-menu,
        .login-dropdown:focus-within .dropdown-menu { display: block; }
        .dropdown-menu a {
            display: block;
            padding: 0.7rem 1rem;
            color: #2d3748;
            font-size: 0.9rem;
            border-bottom: 1px solid #e2e8f0;
            text-decoration: none;
        }
        .dropdown-menu a:last-child { border-bottom: none; }
        .dropdown-menu a:hover { background-color: #ebf8ff; color: #1a365d; }
        .dropdown-menu .icon { margin-right: 0.4rem; }
    </style>
</head>
<body>

    <!-- Header section -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-area">
                <a href="index.php" class="logo-link">
                    <div class="logo-placeholder">M.G.M.B.P.T.C</div>
                    <div class="logo-text">
                        <h1><?php echo __('college_name'); ?></h1>
                        <p class="tagline"><?php echo __('motto'); ?></p>
                    </div>
                </a>
            </div>
            
            <div class="top-utils">
                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <a href="?lang=en" class="<?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                    <span class="separator">|</span>
                    <a href="?lang=am" class="<?php echo $lang === 'am' ? 'active' : ''; ?>">አማ</a>
                </div>

                <!-- Login Portal Dropdown -->
                <div class="login-dropdown">
                    <button class="login-btn">&#128274; Login &#9660;</button>
                    <div class="dropdown-menu">
                        <a href="student_login.php"><span class="icon">&#127891;</span> Student Portal</a>
                        <a href="staff_login.php"><span class="icon">&#128100;</span> Staff Portal</a>
                        <a href="admin.php"><span class="icon">&#9998;</span> Admin Panel</a>
                    </div>
                </div>

                <!-- Mobile Navigation Trigger -->
                <button class="nav-toggle" id="navToggle" aria-label="Toggle Navigation">
                    <span class="hamburger"></span>
                </button>
            </div>
        </div>
        
        <!-- Navigation bar -->
        <nav class="navbar" id="navbar">
            <div class="nav-container">
                <ul class="nav-links">
                    <li>
                        <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_home'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_about'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="academics.php" class="<?php echo $current_page == 'academics.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_academics'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="admission.php" class="<?php echo $current_page == 'admission.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_admission'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="news.php" class="<?php echo $current_page == 'news.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_news'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="research.php" class="<?php echo $current_page == 'research.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_research'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="staff.php" class="<?php echo $current_page == 'staff.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_staff'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="services.php" class="<?php echo $current_page == 'services.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_services'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="gallery.php" class="<?php echo $current_page == 'gallery.php' ? 'active' : ''; ?>">
                           <?php echo __('nav_gallery'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="downloads.php" class="<?php echo $current_page == 'downloads.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_download'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_contact'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <main class="content-wrapper">
