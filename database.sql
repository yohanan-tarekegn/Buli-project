-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2026 at 09:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buli_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `full_name`, `email`, `phone`, `department`, `status`, `created_at`) VALUES
(2, 'xyz', 'xyz@g.c', '+25111111111', 'Automotive Technology', 'Approved', '2026-07-16 18:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'General',
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `title`, `description`, `category`, `file_name`, `created_at`) VALUES
(1, 'Student Application Form', 'Official form for new student admissions.', 'Application Forms', 'application_form.pdf', '2026-07-16 06:43:29'),
(2, 'TVET Level Registration Guide', 'Step-by-step guide for level registration.', 'Academic Guides', 'registration_guide.pdf', '2026-07-16 06:43:29'),
(3, 'College Academic Calendar 2026/27', 'Official academic calendar for the new year.', 'Academic Guides', 'academic_calendar_2026.pdf', '2026-07-16 06:43:29'),
(4, 'Student Code of Conduct', 'Rules, regulations and student discipline manual.', 'Regulations', 'student_conduct.pdf', '2026-07-16 06:43:29'),
(5, 'Research Publication Vol. 3', 'MGMBPTC annual research and innovation publication.', 'Publications', 'research_vol3.pdf', '2026-07-16 06:43:29'),
(6, 'Short-Course Registration Form', 'Form for enrolling in evening short-term programs.', 'Application Forms', 'short_course_form.pdf', '2026-07-16 06:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('photo','video') DEFAULT 'photo',
  `date_taken` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `description`, `type`, `date_taken`, `created_at`) VALUES
(1, 'Annual Graduation Ceremony 2026', 'Graduates celebrating at the main pavilion.', 'photo', '2026-07-01', '2026-07-16 06:43:29'),
(2, 'IT Workshop Lab Session', 'Students during a hands-on ICT practical session.', 'photo', '2026-06-15', '2026-07-16 06:43:29'),
(3, 'Innovation Exhibition 2026', 'Student projects showcased at the national TVET expo.', 'photo', '2026-05-20', '2026-07-16 06:43:29'),
(4, 'Automotive Workshop', 'Automotive trainees working on engine diagnostics.', 'photo', '2026-04-10', '2026-07-16 06:43:29'),
(5, 'College Campus Tour', 'Video overview of the college facilities and campus.', 'video', '2026-03-05', '2026-07-16 06:43:29'),
(6, 'Solar Energy Installation Training', 'Students installing a solar panel unit on campus.', 'photo', '2026-02-18', '2026-07-16 06:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_am` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `content_am` text NOT NULL,
  `type` enum('news','event','announcement') NOT NULL,
  `date_posted` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`id`, `title_en`, `title_am`, `content_en`, `content_am`, `type`, `date_posted`, `created_at`) VALUES
(1, 'Registration Open for Semester I (2026/2027)', 'ለእረኛ (Regular) ተማሪዎች ምዝገባ ተጀምሯል (2018/2019 ዓ.ም)', 'Formal enrollment for regular TVET Levels 1 through 5 is officially open. Please submit your academic records to the Registrar office before September 15. See Admissions page.', 'ለመደበኛ የቲቪቲ (TVET) ደረጃ 1 እስከ 5 ምዝገባ በይፋ ተጀምሯል። እባክዎን የትምህርት ማስረጃዎችዎን እስከ መስከረም 15 ድረስ ለሬጅስትራር ቢሮ ያቅርቡ።', 'announcement', '2026-07-10', '2026-07-15 08:40:36'),
(2, 'Innovation Seminar Starting Soon', 'የቴክኖሎጂ ፈጠራ ሴሚናር በቅርቡ ይጀምራል', 'The Technology Transfer Office will host a 3-day workshop for students and local manufacturing SME operators starting next Tuesday in the main auditorium.', 'የቴክኖሎጂ ሽግግር ቢሮ ለተማሪዎች እና ለአገር ውስጥ አነስተኛ እና አጋዥ ማኑፋክቸሪንግ አንቀሳቃሾች የሚሆን የ3 ቀን አውደ ጥናት በሚቀጥለው ማክሰኞ በዋናው አዳራሽ ያካሂዳል።', 'announcement', '2026-07-05', '2026-07-15 08:40:36'),
(3, 'Graduation Ceremony Logistics', 'የምረቃ ስነ-ስርዓት ዝግጅት', 'The annual graduation ceremony has been scheduled for August 20, 2026, at the College Sports Pavilion. Graduating candidates must verify their academic clearances.', 'አመታዊ የምረቃ ስነ-ስርዓት ነሐሴ 20 ቀን 2026 ዓ.ም በኮሌጁ ስፖርት ፓቪሊዮን ውስጥ እንዲካሄድ ተወስኗል። ተመራቂዎች የትምህርት ማረጋገጫዎቻቸውን ማጠናቀቅ አለባቸው።', 'announcement', '2026-06-28', '2026-07-15 08:40:36'),
(4, 'Strategic Partnership Signed with Ministry of Innovation', 'ከፈጠራና ቴክኖሎጂ ሚኒስቴር ጋር ስልታዊ ስምምነት ተፈረመ', 'Our college officially signed a memorandum of understanding with the Ethiopian Ministry of Innovation and Technology (MInT) to establish a joint innovation hub inside the college grounds. The hub will grant students access to modern prototyping tools, 3D printers, and industrial design software.', 'ኮሌጃችን ከፈጠራና ቴክኖሎጂ ሚኒስቴር (MInT) ጋር በጋራ የፈጠራ ማዕከል በኮሌጁ ውስጥ ለማቋቋም የመግባቢያ ስምምነት ተፈራርሟል። ማዕከሉ ለተማሪዎች የ3ዲ ማተሚያዎችን እና የዲዛይን ሶፍትዌሮችን ጨምሮ ዘመናዊ መሣሪያዎችን ተጠቃሚ ያደርጋል።', 'news', '2026-07-12', '2026-07-15 08:40:36'),
(5, 'Continuous Skills Upgrade: Evening ICT Trainings', 'የክህሎት ማሻሻያ፡ የማታ የኮምፒውተር ስልጠናዎች', 'To address local community demands, the IT department has expanded its evening short courses. Over 150 local workers are currently enrolled in our SQL Database Management and Javascript Fundamentals certificates. Classes are held Monday to Thursday between 6:00 PM and 8:30 PM.', 'የአካባቢውን ማህበረሰብ ፍላጎት ለማሟላት የአይቲ ክፍል የማታ አጫጭር ስልጠናዎችን አስፋፍቷል። በአሁኑ ወቅት ከ150 በላይ የአካባቢው ሰራተኞች በኤስኪውኤል (SQL) እና በጃቫስክሪፕት ስልጠናዎች ላይ ተመዝግበዋል።', 'news', '2026-06-20', '2026-07-15 08:40:36'),
(6, 'Automotive Workshop Facility Upgraded', 'የሞተርና አውቶሞቲቭ ወርክሾፕ እድሳት ተደረገለት', 'Our automotive technology workshop has received state-of-the-art diagnostic machinery. The equipment, donated by industrial partners, includes electronic computer scanning diagnostics and model electric engine trainers, ensuring our curriculum remains aligned with modern automotive shifts.', 'የአውቶሞቲቭ ቴክኖሎጂ ወርክሾፓችን ዘመናዊ የምርመራ ማሽኖችን ተቀብሏል። በኢንዱስትሪ አጋሮች የተለገሱት እነዚህ መሳሪያዎች የኤሌክትሮኒክስ ስካነር ምርመራዎችን እና የኤሌክትሪክ ሞተሮችን ያካትታሉ።', 'news', '2026-05-15', '2026-07-15 08:40:36'),
(7, 'Annual Graduation Day Ceremony', 'አመታዊ የምረቃ ቀን ስነ-ስርዓት', 'Celebrating our graduates of TVET levels and certifications class of 2026.', 'የ2026 ዓ.ም የቲቪቲ ደረጃ እና ሰርተፍኬት ተመራቂዎችን በደማቅ ሁኔታ እናከብራለን።', 'event', '2026-08-20', '2026-07-15 08:40:36'),
(8, 'Short-Course Certification Examinations', 'የአጫጭር ስልጠናዎች የምስክር ወረቀት ፈተና', 'Final assessments for participants of the short-term ICT & electrical networks classes.', 'የአጭር ጊዜ የአይቲ እና የኤሌክትሪክ ኔትወርክ ተማሪዎች የመጨረሻ ፈተና አሰጣጥ።', 'event', '2026-09-10', '2026-07-15 08:40:36'),
(9, 'Semester I Classes Commencement', 'የአንደኛ ሴሚስተር ትምህርት መጀመሪያ', 'First day of academic lectures and practical laboratory classes for all enrolled students.', 'ለትምህርት ለተመዘገቡ ተማሪዎች በሙሉ የአንደኛ ሴሚስተር መደበኛ ትምህርት እና የተግባር ስልጠናዎች መጀመሪያ ቀን።', 'event', '2026-10-05', '2026-07-15 08:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `department` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `email`, `password_hash`, `role`, `department`, `created_at`) VALUES
(1, 'Admin User', 'admin@mgmbptc.edu.et', '$2y$10$LiPNQKk2c9eI6Y3HRrKCW.xATRwd/3t/xX.zPuQBReQOPo8.yq9hq', 'admin', 'Administration', '2026-07-16 06:43:29'),
(2, 'Tsegaye Mengistu', 'tsegaye@mgmbptc.edu.et', '$2y$10$OTMOh6nN6CAohqsir/LRROSArwnilU5h.tAkE0iRu3cX5NsoK0aGq', 'staff', 'Information Technology', '2026-07-16 06:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `student_id_no` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `must_change_password` tinyint(1) NOT NULL DEFAULT 1,
  `admission_ref_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `email`, `password_hash`, `department`, `student_id_no`, `status`, `created_at`, `must_change_password`, `admission_ref_id`) VALUES
(1, 'xyz', 'xyz@g.c', '$2y$10$Dc9IZGUWXynZy83zlUGdxuRZ8bQVKL3vHKn69lon9Y7ZJH3jnUBza', 'Automotive Technology', 'MGMB/2026/0001', 'Active', '2026-07-16 18:17:49', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_events`
--
ALTER TABLE `news_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
