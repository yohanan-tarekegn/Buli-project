<?php
$page_title = 'News & Events';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h2><?php echo __('latest_news'); ?> & Announcements</h2>
</div>

<p style="margin-bottom: 2rem;">
    Stay updated with the latest happenings, academic calendars, notice releases, and achievements of Major General Mulugeta Buli Polytechnic College.
</p>

<!-- Double column: Announcements vs News -->
<div class="grid-2">
    <!-- Notice Board Archive -->
    <div class="card notice-board" id="announcements-section">
        <h3><?php echo __('announcements'); ?></h3>
        <div class="notice-list">
            <div class="notice-item" id="notice1">
                <span class="notice-date">July 10, 2026</span>
                <h4>Registration Open for Semester I (2026/2027)</h4>
                <p style="font-size: 0.9rem; margin-top: 0.25rem;">
                    Formal enrollment for regular TVET Levels 1 through 5 is officially open. Please submit your academic records to the Registrar office before September 15. See <a href="admission.php">Admissions</a>.
                </p>
            </div>
            
            <div class="notice-item" id="notice2">
                <span class="notice-date">July 05, 2026</span>
                <h4>Innovation Seminar Starting Soon</h4>
                <p style="font-size: 0.9rem; margin-top: 0.25rem;">
                    The Technology Transfer Office will host a 3-day workshop for students and local manufacturing SME operators starting next Tuesday in the main auditorium.
                </p>
            </div>
            
            <div class="notice-item" id="notice3">
                <span class="notice-date">June 28, 2026</span>
                <h4>Graduation Ceremony Logistics</h4>
                <p style="font-size: 0.9rem; margin-top: 0.25rem;">
                    The annual graduation ceremony has been scheduled for August 20, 2026, at the College Sports Pavilion. Graduating candidates must verify their academic clearances.
                </p>
            </div>
        </div>
    </div>

    <!-- Upcoming Events List -->
    <div class="card" id="events-section">
        <h3><?php echo __('upcoming_events'); ?></h3>
        
        <div style="margin-bottom: 1.25rem; border-left: 4px solid var(--primary-color); padding-left: 1rem;">
            <span class="notice-date" style="font-weight: bold; color: var(--primary-color);">August 20, 2026</span>
            <h4 style="margin: 0.25rem 0;">Annual Graduation Day Ceremony</h4>
            <p style="font-size: 0.9rem;">Celebrating our graduates of TVET levels and certifications class of 2026.</p>
        </div>

        <div style="margin-bottom: 1.25rem; border-left: 4px solid var(--primary-color); padding-left: 1rem;">
            <span class="notice-date" style="font-weight: bold; color: var(--primary-color);">September 10, 2026</span>
            <h4 style="margin: 0.25rem 0;">Short-Course Certification Examinations</h4>
            <p style="font-size: 0.9rem;">Final assessments for participants of the short-term ICT & electrical networks classes.</p>
        </div>

        <div style="border-left: 4px solid var(--primary-color); padding-left: 1rem;">
            <span class="notice-date" style="font-weight: bold; color: var(--primary-color);">October 05, 2026</span>
            <h4 style="margin: 0.25rem 0;">Semester I Classes Commencement</h4>
            <p style="font-size: 0.9rem;">First day of academic lectures and practical laboratory classes for all enrolled students.</p>
        </div>
    </div>
</div>

<!-- Main News Articles Grid -->
<section class="card" style="margin-bottom: 2rem;">
    <h3>Featured Articles</h3>
    
    <div class="grid-3" style="margin-top: 1.5rem; margin-bottom: 0;">
        <div class="card" style="background-color: var(--bg-light);" id="news1">
            <span class="notice-date" style="margin-bottom: 0.5rem; display: block;">July 12, 2026</span>
            <h4>Strategic Partnership Signed with Ministry of Innovation</h4>
            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                Our college officially signed a memorandum of understanding with the Ethiopian Ministry of Innovation and Technology (MInT) to establish a joint innovation hub inside the college grounds. The hub will grant students access to modern prototyping tools, 3D printers, and industrial design software.
            </p>
        </div>
        
        <div class="card" style="background-color: var(--bg-light);" id="news2">
            <span class="notice-date" style="margin-bottom: 0.5rem; display: block;">June 20, 2026</span>
            <h4>Continuous Skills Upgrade: Evening ICT Trainings</h4>
            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                To address local community demands, the IT department has expanded its evening short courses. Over 150 local workers are currently enrolled in our SQL Database Management and Javascript Fundamentals certificates. Classes are held Monday to Thursday between 6:00 PM and 8:30 PM.
            </p>
        </div>
        
        <div class="card" style="background-color: var(--bg-light);" id="news3">
            <span class="notice-date" style="margin-bottom: 0.5rem; display: block;">May 15, 2026</span>
            <h4>Automotive Workshop Facility Upgraded</h4>
            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                Our automotive technology workshop has received state-of-the-art diagnostic machinery. The equipment, donated by industrial partners, includes electronic computer scanning diagnostics and model electric engine trainers, ensuring our curriculum remains aligned with modern automotive shifts.
            </p>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
