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
                        <a href="elearning.php"><span class="icon">&#128187;</span> e-Learning Portal</a>
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
                        <nav>
  <div class="dropdown">
    <button class="dropbtn"><?php echo __('nav_about'); ?></button>
    <div class="dropdown-content">
       <a href="gallery.php" class="<?php echo $current_page == 'gallery.php' ? 'active' : ''; ?>">
                           <?php echo __('nav_gallery'); ?>
                        </a>
   
      <a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_contact'); ?>
                        </a>
                        <a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_about'); ?>
                        </a>
                        <a href="history.php" class="<?php echo $current_page == 'history.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_history'); ?>
                        </a>
                        <a href="mission.php" class="<?php echo $current_page == 'mission.php' ? 'active' : ''; ?>">
                            <?php echo __('nav_mission'); ?>
                        </a>
    </div>
  </div>
</nav>
                        
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
                    <li class="dropdown">
                     <button class="dropbtn">
        Student Affairs & Services ▼
    </button>
                    
                    <div class="dropdown-content">


                        <a href="academic-advising.php">Academic Advising & Counseling</a>

                        <a href="scholarship.php">Scholarships & Financial Support</a>

                        <a href="health-services.php">Health Services</a>

                        <a href="housing.php">Student Housing & Accommodation</a>

                        <a href="career-development.php">Career Development Services</a>

                        <a href="clubs.php">Student Clubs & Organizations</a>

                        <a href="sports-recreation.php">Sports & Recreation</a>

                        <a href="grievance.php">Grievance & Complaint Services</a>

                        <a href="forms-documents.php">Forms & Documents</a>

                        <a href="library-services.php">Library Services</a>

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
