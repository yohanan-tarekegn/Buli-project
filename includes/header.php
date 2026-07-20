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
