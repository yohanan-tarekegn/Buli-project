<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default language is English
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Handle language toggle via GET request
if (isset($_GET['lang'])) {
    $requested_lang = $_GET['lang'];
    if ($requested_lang === 'am' || $requested_lang === 'en') {
        $_SESSION['lang'] = $requested_lang;
    }
    // Redirect back to clean URL if possible, otherwise page will just reload with session set
    $uri = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: " . $uri);
    exit;
}

$lang = $_SESSION['lang'];

// Translation mapping dictionary
$translations = [
    'en' => [
        'college_name' => 'Major General Mulugeta Buli Polytechnic College',
        'college_short' => 'M.G.M.B.P.T.C',
        'motto' => 'Shine Through Education and Technology',
        
        // Navigation links
        'nav_home' => 'Home',
        'nav_about' => 'About Us',
        'nav_academics' => 'Academics',
        'nav_admission' => 'Admissions',
        'nav_news' => 'News & Events',
        'nav_research' => 'Research',
        'nav_staff' => 'Staff Directory',
        'nav_services' => 'Student Services',
        'nav_contact' => 'Contact Us',
        'nav_gallery' => 'Gallery',
        'nav_download' => 'Downloads',
        
        // General text
        'btn_read_more' => 'Read More',
        'btn_apply' => 'Apply Now',
        'btn_submit' => 'Submit',
        'btn_send' => 'Send Message',
        
        // Home page
        'hero_title' => 'Welcome to Major General Mulugeta Buli Polytechnic College',
        'hero_desc' => 'Ethiopia’s leading institution dedicated to producing competent graduates in science, technology, and vocational training.',
        'announcements' => 'Announcements & Notice Board',
        'latest_news' => 'Latest News & Updates',
        'upcoming_events' => 'Upcoming Events',
        'quick_links' => 'Quick Links',
        
        // About page
        'about_title' => 'About Our College',
        'mission' => 'Mission',
        'vision' => 'Vision',
        'core_values' => 'Core Values',
        
        // Contact page
        'contact_title' => 'Contact Us',
        'address' => 'Address',
        'phone' => 'Phone',
        'email' => 'Email',
        'name_label' => 'Full Name',
        'subject_label' => 'Subject',
        'message_label' => 'Message'
    ],
    'am' => [
        'college_name' => 'ሜጀር ጄኔራል ሙሉጌታ ቡሊ ፖሊቴክኒክ ኮሌጅ',
        'college_short' => 'ሜ.ጄ.ሙ.ቡ.ፖ.ኮ',
        'motto' => 'በትምህርት እና በቴክኖሎጂ እንበራለን',
        
        // Navigation links
        'nav_home' => 'ዋና ገጽ',
        'nav_about' => 'ስለ ኮሌጁ',
        'nav_academics' => 'አካዳሚክስ',
        'nav_admission' => 'ምዝገባ እና መግቢያ',
        'nav_news' => 'ዜና እና ሁነቶች',
        'nav_research' => 'ምርምርና ፈጠራ',
        'nav_staff' => 'የሰራተኞች ማውጫ',
        'nav_services' => 'የተማሪዎች አገልግሎት',
        'nav_contact' => 'አድራሻችን',
        'nav_gallery' => 'ማዕከለ-ስዕላት',
        'nav_download' => 'ማውረጃዎች',
        
        // General text
        'btn_read_more' => 'ተጨማሪ ያንብቡ',
        'btn_apply' => 'አሁን ያመልክቱ',
        'btn_submit' => 'አስገባ',
        'btn_send' => 'መልዕክት ላክ',
        
        // Home page
        'hero_title' => 'እንኳን ወደ ሜጀር ጄኔራል ሙሉጌታ ቡሊ ፖሊቴክኒክ ኮሌጅ በደህና መጡ',
        'hero_desc' => 'በሳይንስ፣ ቴክኖሎጂ እና በሙያ ስልጠና ብቁ የሆኑ ተመራቂዎችን ለማፍራት የተቋቋመ የኢትዮጵያ መሪ ተቋም።',
        'announcements' => 'ማስታወቂያዎች እና የማስታወቂያ ሰሌዳ',
        'latest_news' => 'የቅርብ ጊዜ ዜናዎች',
        'upcoming_events' => 'የሚመጡ ሁነቶች',
        'quick_links' => 'ፈጣን ሊንኮች',
        
        // About page
        'about_title' => 'ስለ ኮሌጃችን',
        'mission' => 'ተልዕኮ',
        'vision' => 'ራዕይ',
        'core_values' => 'ዕሴቶች',
        
        // Contact page
        'contact_title' => 'ያግኙን',
        'address' => 'አድራሻ',
        'phone' => 'ስልክ',
        'email' => 'ኢሜይል',
        'name_label' => 'ሙሉ ስም',
        'subject_label' => 'ርዕሰ ጉዳይ',
        'message_label' => 'መልዕክት'
    ]
];

// Translation Helper function
function __($key) {
    global $translations, $lang;
    return $translations[$lang][$key] ?? $translations['en'][$key] ?? $key;
}
?>
