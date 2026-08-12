<?php
require_once __DIR__ . '/lang.php';
$current_page = basename($_SERVER['PHP_SELF']);

// Map pages to concise dropdown titles & active status
$about_pages = [
    'about.php'   => __('about_title'),
    'mission.php' => __('nav_mission'),
    'history.php' => __('nav_history'),
    'gallery.php' => __('nav_gallery')
];
$about_active = isset($about_pages[$current_page]);
$about_label  = $about_active ? $about_pages[$current_page] : __('nav_about');

$admission_pages = [
    'admission.php' => __('nav_admission')
];
$admission_active = isset($admission_pages[$current_page]);
$admission_label  = $admission_active ? $admission_pages[$current_page] : __('nav_admission');

$academics_pages = [
    'academics.php' => __('nav_academics')
];
$academics_active = isset($academics_pages[$current_page]);
$academics_label  = $academics_active ? $academics_pages[$current_page] : __('nav_academics');

$news_pages = [
    'news.php'     => 'News & Updates',
    'research.php' => 'Research',
    'downloads.php'=> 'Downloads'
];
$news_active = isset($news_pages[$current_page]);
$news_label  = $news_active ? $news_pages[$current_page] : __('nav_news');

$services_pages = [
    'health-services.php'   => 'Health Services',
    'housing.php'           => 'Housing & Hostel',
    'career-development.php'=> 'Career Dev',
    'clubs.php'             => 'Clubs & Orgs',
    'library-services.php'  => 'Library'
];
$services_active = isset($services_pages[$current_page]);
$services_label  = $services_active ? $services_pages[$current_page] : __('nav_studentservice');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('college_name'); ?> | <?php echo isset($page_title) ? $page_title : __('motto'); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
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
        .dropdown-menu a:hover { background-color: #ebf8ff; color: #1e3f20; }
        .dropdown-menu .icon { margin-right: 0.4rem; }
    </style>
</head>

<body>

    <!-- Top Announcement & Ticker Bar -->
    <div class="top-ticker-bar">
        <div class="top-ticker-content">
            <span class="ticker-badge">Notice</span>
            <span class="ticker-text">
                📢 Registration for Semester I TVET Regular & Evening Programs is Now Open! 
            </span>
        </div>
        <div class="top-ticker-links">
            <a href="news.php">📰 Latest Updates</a>
            <a href="downloads.php">📁 Documents</a>
            <a href="contact.php">📞 Contact</a>
        </div>
    </div>

    <!-- Header section -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-area">
                <a href="index.php" class="logo-link">
                    <img src="includes/images.jpg" alt="College Logo" class="logo-img">
                    <div class="logo-text">
                        <h1><?php echo __('college_name'); ?></h1>
                        <p class="tagline"><?php echo __('motto'); ?></p>
                    </div>
                </a>
            </div>

            <div class="top-utils">
                <!-- Search Form -->
                <form action="search.php" method="GET" class="header-search-form">
                    <input type="text" name="q" placeholder="Search..." required class="header-search-input">
                    <button type="submit" class="header-search-btn" title="Search" aria-label="Search">🔍</button>
                </form>

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
                        <a href="elearning.php"><span class="icon">&#128187;</span> e-Learning Portal</a>
                    </div>
                </div>

                <!-- Mobile Navigation Trigger -->
                <button class="nav-toggle" id="navToggle" aria-label="Toggle Navigation">
                    <span class="hamburger"></span>
                </button>
            </div>
        </div>

        <!-- Benchmark Multi-Tiered Navigation Bar -->
        <nav class="navbar" id="navbar">
            <div class="nav-container">
                <ul class="nav-links">
                    <li>
                        <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_home'); ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <button class="dropbtn <?php echo $about_active ? 'active' : ''; ?>"><?php echo htmlspecialchars($about_label); ?></button>
                        <div class="dropdown-content">
                            <a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">
                                <?php echo __('about_title'); ?>
                            </a>
                            <a href="mission.php" class="<?php echo $current_page == 'mission.php' ? 'active' : ''; ?>">
                                <?php echo __('nav_mission'); ?>
                            </a>
                            <a href="history.php" class="<?php echo $current_page == 'history.php' ? 'active' : ''; ?>">
                                <?php echo __('nav_history'); ?>
                            </a>
                            <a href="gallery.php" class="<?php echo $current_page == 'gallery.php' ? 'active' : ''; ?>">
                                <?php echo __('nav_gallery'); ?>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <button class="dropbtn <?php echo $admission_active ? 'active' : ''; ?>"><?php echo htmlspecialchars($admission_label); ?></button>
                        <div class="dropdown-content">
                            <a href="admission.php" class="<?php echo $current_page == 'admission.php' ? 'active' : ''; ?>">
                                Admission Overview & Apply
                            </a>
                            <a href="admission.php#requirements">
                                Entry Requirements & Levels
                            </a>
                            <a href="admission.php#fees">
                                Training Fees & Guide
                            </a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <button class="dropbtn <?php echo $academics_active ? 'active' : ''; ?>"><?php echo htmlspecialchars($academics_label); ?></button>
                        <div class="dropdown-content">
                            <a href="academics.php" class="<?php echo $current_page == 'academics.php' ? 'active' : ''; ?>">
                                Departments & Curricula
                            </a>
                            <a href="academics.php#guidance">
                                Vocational Counseling Center
                            </a>
                        </div>
                    </li>
                    <li>
                        <a href="innovation.php" class="<?php echo $current_page == 'innovation.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_innovation'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="offices.php" class="<?php echo $current_page == 'offices.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_offices'); ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <button class="dropbtn <?php echo $news_active ? 'active' : ''; ?>"><?php echo htmlspecialchars($news_label); ?></button>
                        <div class="dropdown-content">
                            <a href="news.php" class="<?php echo $current_page == 'news.php' ? 'active' : ''; ?>">
                                News & Announcements
                            </a>
                            <a href="research.php" class="<?php echo $current_page == 'research.php' ? 'active' : ''; ?>">
                                Research & Innovation
                            </a>
                            <a href="downloads.php" class="<?php echo $current_page == 'downloads.php' ? 'active' : ''; ?>">
                                Download Center
                            </a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <button class="dropbtn <?php echo $services_active ? 'active' : ''; ?>"><?php echo htmlspecialchars($services_label); ?></button>
                        <div class="dropdown-content">
                            <a href="health-services.php" class="<?php echo $current_page == 'health-services.php' ? 'active' : ''; ?>">Health Services</a>
                            <a href="housing.php" class="<?php echo $current_page == 'housing.php' ? 'active' : ''; ?>">Student Housing & Hostel</a>
                            <a href="career-development.php" class="<?php echo $current_page == 'career-development.php' ? 'active' : ''; ?>">Career Development</a>
                            <a href="clubs.php" class="<?php echo $current_page == 'clubs.php' ? 'active' : ''; ?>">Clubs & Organizations</a>
                            <a href="library-services.php" class="<?php echo $current_page == 'library-services.php' ? 'active' : ''; ?>">Library Services</a>
                        </div>
                    </li>
                    <li>
                        <a href="staff.php" class="<?php echo $current_page == 'staff.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_staff'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <main class="content-wrapper">
