<?php
/**
 * staff.php — MGMBPTC Staff Directory
 * Displays leadership, department heads, academic & administrative staff.
 */
$page_title = 'Staff Directory';
require_once __DIR__ . '/includes/header.php';
?>

<!-- ====================================================
     HERO BANNER
     ==================================================== -->
<section class="hero-staff">
    <h1>Our Staff &amp; Leadership</h1>
    <p>Meet the dedicated administrators, instructors, and support personnel of Melkegenet General &amp; Bibi Buli Polytechnic College.</p>
</section>

<!-- ====================================================
     SEARCH / FILTER BAR
     ==================================================== -->
<section class="staff-filter-bar card">
    <div class="staff-filter-inner">
        <div class="form-group" style="margin:0; flex:1;">
            <input type="text" id="staffSearch" class="form-control" placeholder="🔍  Search by name or role…" oninput="filterStaff()">
        </div>
        <div class="form-group" style="margin:0;">
            <select id="staffDeptFilter" class="form-control" onchange="filterStaff()">
                <option value="">All Departments</option>
                <option value="Administration">Administration</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Automotive Technology">Automotive Technology</option>
                <option value="Electrical &amp; Electronics">Electrical &amp; Electronics</option>
                <option value="Mechanical &amp; Manufacturing">Mechanical &amp; Manufacturing</option>
                <option value="Construction Technology">Construction Technology</option>
                <option value="Student Affairs">Student Affairs</option>
                <option value="Library">Library</option>
            </select>
        </div>
        <button class="btn btn-secondary" onclick="resetFilter()" type="button">Reset</button>
    </div>
    <p id="staffNoResult" style="display:none; color:#c0392b; margin-top:0.75rem;">No staff members match your search.</p>
</section>

<!-- ====================================================
     SECTION 1 — LEADERSHIP TEAM
     ==================================================== -->
<section class="staff-section" id="section-leadership">
    <h2 class="staff-section-title">
        <span class="section-icon">🏛️</span> Leadership Team
    </h2>
    <div class="staff-grid" id="grid-leadership">

        <div class="staff-card" data-name="dr abebe kebede" data-dept="Administration">
            <div class="staff-photo-wrap">
                <img src="images/staff/dean.jpg" alt="College Dean" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">College Dean</span>
            <h3 class="staff-name">Dr. Abebe Kebede</h3>
            <p class="staff-dept">Administration</p>
            <p class="staff-spec">Educational Administration &amp; Leadership</p>
            <a href="mailto:dean@mgmbptc.edu.et" class="staff-email-btn">✉ dean@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="ato tsegaye mengistu" data-dept="Administration">
            <div class="staff-photo-wrap">
                <img src="images/staff/academic.jpg" alt="Academic Vice Dean" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Academic Vice Dean</span>
            <h3 class="staff-name">Ato Tsegaye Mengistu</h3>
            <p class="staff-dept">Administration</p>
            <p class="staff-spec">Curriculum Development &amp; Academic Affairs</p>
            <a href="mailto:academic@mgmbptc.edu.et" class="staff-email-btn">✉ academic@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="w/ro aster almaz" data-dept="Administration">
            <div class="staff-photo-wrap">
                <img src="images/staff/admin.jpg" alt="Administrative Vice Dean" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Administrative Vice Dean</span>
            <h3 class="staff-name">W/ro Aster Almaz</h3>
            <p class="staff-dept">Administration</p>
            <p class="staff-spec">Human Resource Management</p>
            <a href="mailto:admin@mgmbptc.edu.et" class="staff-email-btn">✉ admin@mgmbptc.edu.et</a>
        </div>

    </div>
</section>

<!-- ====================================================
     SECTION 2 — DEPARTMENT HEADS
     ==================================================== -->
<section class="staff-section" id="section-dept-heads">
    <h2 class="staff-section-title">
        <span class="section-icon">📐</span> Department Heads
    </h2>
    <div class="staff-grid" id="grid-dept-heads">

        <div class="staff-card" data-name="ato yohannes bekele" data-dept="Information Technology">
            <div class="staff-photo-wrap">
                <img src="images/staff/it.jpg" alt="IT Dept Head" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Department Head</span>
            <h3 class="staff-name">Ato Yohannes Bekele</h3>
            <p class="staff-dept">Information Technology</p>
            <p class="staff-spec">Database Administration &amp; Networking</p>
            <a href="mailto:it@mgmbptc.edu.et" class="staff-email-btn">✉ it@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="ato mulugeta tadesse" data-dept="Automotive Technology">
            <div class="staff-photo-wrap">
                <img src="images/staff/auto.jpg" alt="Automotive Dept Head" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Department Head</span>
            <h3 class="staff-name">Ato Mulugeta Tadesse</h3>
            <p class="staff-dept">Automotive Technology</p>
            <p class="staff-spec">Automotive Diagnostics Expert</p>
            <a href="mailto:auto@mgmbptc.edu.et" class="staff-email-btn">✉ auto@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="w/t kidist daniel" data-dept="Electrical &amp; Electronics">
            <div class="staff-photo-wrap">
                <img src="images/staff/electrical.jpg" alt="Electrical Dept Head" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Department Head</span>
            <h3 class="staff-name">W/t Kidist Daniel</h3>
            <p class="staff-dept">Electrical &amp; Electronics</p>
            <p class="staff-spec">Embedded Systems Specialist</p>
            <a href="mailto:electrical@mgmbptc.edu.et" class="staff-email-btn">✉ electrical@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="construction technology head" data-dept="Construction Technology">
            <div class="staff-photo-wrap">
                <img src="images/staff/construction.jpg" alt="Construction Dept Head" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Department Head</span>
            <h3 class="staff-name">Construction Technology Dept.</h3>
            <p class="staff-dept">Construction Technology</p>
            <p class="staff-spec">Building Construction &amp; Engineering</p>
            <a href="mailto:construction@mgmbptc.edu.et" class="staff-email-btn">✉ construction@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="mechanical manufacturing head" data-dept="Mechanical &amp; Manufacturing">
            <div class="staff-photo-wrap">
                <img src="images/staff/mechanical.jpg" alt="Mechanical Dept Head" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Department Head</span>
            <h3 class="staff-name">Mechanical &amp; Manufacturing Dept.</h3>
            <p class="staff-dept">Mechanical &amp; Manufacturing</p>
            <p class="staff-spec">Manufacturing Systems &amp; CAD Design</p>
            <a href="mailto:mechanical@mgmbptc.edu.et" class="staff-email-btn">✉ mechanical@mgmbptc.edu.et</a>
        </div>

    </div>
</section>

<!-- ====================================================
     SECTION 3 — ACADEMIC STAFF
     ==================================================== -->
<section class="staff-section" id="section-academic">
    <h2 class="staff-section-title">
        <span class="section-icon">🎓</span> Academic Staff
    </h2>
    <div class="staff-grid" id="grid-academic">

        <div class="staff-card" data-name="sample instructor it" data-dept="Information Technology">
            <div class="staff-photo-wrap">
                <img src="images/staff/instructor1.jpg" alt="IT Instructor" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Instructor</span>
            <h3 class="staff-name">IT Instructor</h3>
            <p class="staff-dept">Information Technology</p>
            <p class="staff-spec">Software Development</p>
            <a href="mailto:staff@mgmbptc.edu.et" class="staff-email-btn">✉ staff@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="sample instructor mechanical" data-dept="Mechanical &amp; Manufacturing">
            <div class="staff-photo-wrap">
                <img src="images/staff/instructor2.jpg" alt="Mechanical Instructor" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Instructor</span>
            <h3 class="staff-name">Mechanical Instructor</h3>
            <p class="staff-dept">Mechanical &amp; Manufacturing</p>
            <p class="staff-spec">Manufacturing Specialist</p>
            <a href="mailto:staff2@mgmbptc.edu.et" class="staff-email-btn">✉ staff2@mgmbptc.edu.et</a>
        </div>

    </div>
</section>

<!-- ====================================================
     SECTION 4 — ADMINISTRATIVE STAFF
     ==================================================== -->
<section class="staff-section" id="section-admin">
    <h2 class="staff-section-title">
        <span class="section-icon">📋</span> Administrative Staff
    </h2>
    <div class="staff-grid" id="grid-admin">

        <div class="staff-card" data-name="registrar student affairs" data-dept="Student Affairs">
            <div class="staff-photo-wrap">
                <img src="images/staff/registrar.jpg" alt="Registrar" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Registrar</span>
            <h3 class="staff-name">Office of the Registrar</h3>
            <p class="staff-dept">Student Affairs</p>
            <p class="staff-spec">Student Records &amp; Enrollment</p>
            <a href="mailto:registrar@mgmbptc.edu.et" class="staff-email-btn">✉ registrar@mgmbptc.edu.et</a>
        </div>

        <div class="staff-card" data-name="librarian library" data-dept="Library">
            <div class="staff-photo-wrap">
                <img src="images/staff/library.jpg" alt="Librarian" class="staff-photo" onerror="this.onerror=null;this.src='images/placeholder_staff.png'">
            </div>
            <span class="staff-role-badge">Librarian</span>
            <h3 class="staff-name">College Librarian</h3>
            <p class="staff-dept">Library</p>
            <p class="staff-spec">Information &amp; Library Services</p>
            <a href="mailto:library@mgmbptc.edu.et" class="staff-email-btn">✉ library@mgmbptc.edu.et</a>
        </div>

    </div>
</section>

<!-- ====================================================
     LIVE SEARCH JAVASCRIPT
     ==================================================== -->
<script>
function filterStaff() {
    const query  = document.getElementById('staffSearch').value.toLowerCase().trim();
    const dept   = document.getElementById('staffDeptFilter').value.toLowerCase().trim();
    const cards  = document.querySelectorAll('.staff-card');
    let   visible = 0;

    cards.forEach(function(card) {
        const name     = (card.dataset.name || '').toLowerCase();
        const cardDept = (card.dataset.dept || '').toLowerCase();

        const matchName = !query || name.includes(query);
        const matchDept = !dept  || cardDept.includes(dept.replace('&amp;', '&').replace('&#38;','&'));

        if (matchName && matchDept) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    // Hide entire section if all its cards are hidden
    document.querySelectorAll('.staff-section').forEach(function(sec) {
        const anyVisible = Array.from(sec.querySelectorAll('.staff-card')).some(c => c.style.display !== 'none');
        sec.style.display = anyVisible ? '' : 'none';
    });

    document.getElementById('staffNoResult').style.display = visible === 0 ? 'block' : 'none';
}

function resetFilter() {
    document.getElementById('staffSearch').value = '';
    document.getElementById('staffDeptFilter').selectedIndex = 0;
    filterStaff();
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>