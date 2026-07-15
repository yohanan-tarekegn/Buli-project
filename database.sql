-- MySQL Database Schema for Major General Mulugeta Buli Polytechnic College
-- Database: buli_db

CREATE DATABASE IF NOT EXISTS `buli_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `buli_db`;

-- 1. Table structure for table `admissions`
CREATE TABLE IF NOT EXISTS `admissions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  `department` VARCHAR(100) NOT NULL,
  `status` VARCHAR(20) DEFAULT 'Pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Table structure for table `contact_messages`
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(255) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Table structure for table `news_events`
CREATE TABLE IF NOT EXISTS `news_events` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title_en` VARCHAR(255) NOT NULL,
  `title_am` VARCHAR(255) NOT NULL,
  `content_en` TEXT NOT NULL,
  `content_am` TEXT NOT NULL,
  `type` ENUM('news', 'event', 'announcement') NOT NULL,
  `date_posted` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping starting sample data for `news_events`
INSERT INTO `news_events` (`title_en`, `title_am`, `content_en`, `content_am`, `type`, `date_posted`) VALUES
(
  'Registration Open for Semester I (2026/2027)',
  'ለእረኛ (Regular) ተማሪዎች ምዝገባ ተጀምሯል (2018/2019 ዓ.ም)',
  'Formal enrollment for regular TVET Levels 1 through 5 is officially open. Please submit your academic records to the Registrar office before September 15. See Admissions page.',
  'ለመደበኛ የቲቪቲ (TVET) ደረጃ 1 እስከ 5 ምዝገባ በይፋ ተጀምሯል። እባክዎን የትምህርት ማስረጃዎችዎን እስከ መስከረም 15 ድረስ ለሬጅስትራር ቢሮ ያቅርቡ።',
  'announcement',
  '2026-07-10'
),
(
  'Innovation Seminar Starting Soon',
  'የቴክኖሎጂ ፈጠራ ሴሚናር በቅርቡ ይጀምራል',
  'The Technology Transfer Office will host a 3-day workshop for students and local manufacturing SME operators starting next Tuesday in the main auditorium.',
  'የቴክኖሎጂ ሽግግር ቢሮ ለተማሪዎች እና ለአገር ውስጥ አነስተኛ እና አጋዥ ማኑፋክቸሪንግ አንቀሳቃሾች የሚሆን የ3 ቀን አውደ ጥናት በሚቀጥለው ማክሰኞ በዋናው አዳራሽ ያካሂዳል።',
  'announcement',
  '2026-07-05'
),
(
  'Graduation Ceremony Logistics',
  'የምረቃ ስነ-ስርዓት ዝግጅት',
  'The annual graduation ceremony has been scheduled for August 20, 2026, at the College Sports Pavilion. Graduating candidates must verify their academic clearances.',
  'አመታዊ የምረቃ ስነ-ስርዓት ነሐሴ 20 ቀን 2026 ዓ.ም በኮሌጁ ስፖርት ፓቪሊዮን ውስጥ እንዲካሄድ ተወስኗል። ተመራቂዎች የትምህርት ማረጋገጫዎቻቸውን ማጠናቀቅ አለባቸው።',
  'announcement',
  '2026-06-28'
),
(
  'Strategic Partnership Signed with Ministry of Innovation',
  'ከፈጠራና ቴክኖሎጂ ሚኒስቴር ጋር ስልታዊ ስምምነት ተፈረመ',
  'Our college officially signed a memorandum of understanding with the Ethiopian Ministry of Innovation and Technology (MInT) to establish a joint innovation hub inside the college grounds. The hub will grant students access to modern prototyping tools, 3D printers, and industrial design software.',
  'ኮሌጃችን ከፈጠራና ቴክኖሎጂ ሚኒስቴር (MInT) ጋር በጋራ የፈጠራ ማዕከል በኮሌጁ ውስጥ ለማቋቋም የመግባቢያ ስምምነት ተፈራርሟል። ማዕከሉ ለተማሪዎች የ3ዲ ማተሚያዎችን እና የዲዛይን ሶፍትዌሮችን ጨምሮ ዘመናዊ መሣሪያዎችን ተጠቃሚ ያደርጋል።',
  'news',
  '2026-07-12'
),
(
  'Continuous Skills Upgrade: Evening ICT Trainings',
  'የክህሎት ማሻሻያ፡ የማታ የኮምፒውተር ስልጠናዎች',
  'To address local community demands, the IT department has expanded its evening short courses. Over 150 local workers are currently enrolled in our SQL Database Management and Javascript Fundamentals certificates. Classes are held Monday to Thursday between 6:00 PM and 8:30 PM.',
  'የአካባቢውን ማህበረሰብ ፍላጎት ለማሟላት የአይቲ ክፍል የማታ አጫጭር ስልጠናዎችን አስፋፍቷል። በአሁኑ ወቅት ከ150 በላይ የአካባቢው ሰራተኞች በኤስኪውኤል (SQL) እና በጃቫስክሪፕት ስልጠናዎች ላይ ተመዝግበዋል።',
  'news',
  '2026-06-20'
),
(
  'Automotive Workshop Facility Upgraded',
  'የሞተርና አውቶሞቲቭ ወርክሾፕ እድሳት ተደረገለት',
  'Our automotive technology workshop has received state-of-the-art diagnostic machinery. The equipment, donated by industrial partners, includes electronic computer scanning diagnostics and model electric engine trainers, ensuring our curriculum remains aligned with modern automotive shifts.',
  'የአውቶሞቲቭ ቴክኖሎጂ ወርክሾፓችን ዘመናዊ የምርመራ ማሽኖችን ተቀብሏል። በኢንዱስትሪ አጋሮች የተለገሱት እነዚህ መሳሪያዎች የኤሌክትሮኒክስ ስካነር ምርመራዎችን እና የኤሌክትሪክ ሞተሮችን ያካትታሉ።',
  'news',
  '2026-05-15'
),
(
  'Annual Graduation Day Ceremony',
  'አመታዊ የምረቃ ቀን ስነ-ስርዓት',
  'Celebrating our graduates of TVET levels and certifications class of 2026.',
  'የ2026 ዓ.ም የቲቪቲ ደረጃ እና ሰርተፍኬት ተመራቂዎችን በደማቅ ሁኔታ እናከብራለን።',
  'event',
  '2026-08-20'
),
(
  'Short-Course Certification Examinations',
  'የአጫጭር ስልጠናዎች የምስክር ወረቀት ፈተና',
  'Final assessments for participants of the short-term ICT & electrical networks classes.',
  'የአጭር ጊዜ የአይቲ እና የኤሌክትሪክ ኔትወርክ ተማሪዎች የመጨረሻ ፈተና አሰጣጥ።',
  'event',
  '2026-09-10'
),
(
  'Semester I Classes Commencement',
  'የአንደኛ ሴሚስተር ትምህርት መጀመሪያ',
  'First day of academic lectures and practical laboratory classes for all enrolled students.',
  'ለትምህርት ለተመዘገቡ ተማሪዎች በሙሉ የአንደኛ ሴሚስተር መደበኛ ትምህርት እና የተግባር ስልጠናዎች መጀመሪያ ቀን።',
  'event',
  '2026-10-05'
);
