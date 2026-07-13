<?php
$page_title = 'Academic Programs';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h2>Academic Programs & Departments</h2>
</div>

<p style="margin-bottom: 2rem;">
    MGMBPTC offers a range of Technical and Vocational Education and Training (TVET) programs. Our courses are structured according to the Ethiopian National TVET Qualifications Framework (NTQF), spanning from Level 1 to Level 5, as well as customized short-term industry training.
</p>

<div class="grid-2">
    <!-- TVET Levels Card -->
    <div class="card">
        <h3>National TVET Levels (NTQF)</h3>
        <p style="margin-bottom: 1rem;">
            Our formal programs are designed around occupational standards to ensure student competence in industrial applications.
        </p>
        <ul style="padding-left: 1.5rem; margin-bottom: 1rem;">
            <li style="margin-bottom: 0.5rem;"><strong>Level 1 - 2 (Certificate):</strong> Focuses on basic operational skills and simple mechanical/clerical competencies.</li>
            <li style="margin-bottom: 0.5rem;"><strong>Level 3 - 4 (Diploma):</strong> Advanced technical training, system troubleshooting, and supervisor roles.</li>
            <li style="margin-bottom: 0.5rem;"><strong>Level 5 (Advanced Diploma):</strong> High-level technological management, analysis, design, and system diagnostics.</li>
        </ul>
        <a href="admission.php" class="btn btn-secondary"><?php echo __('btn_apply'); ?></a>
    </div>

    <!-- Short term training -->
    <div class="card">
        <h3>Short-Term Industry Training</h3>
        <p>
            We run customized short courses (1 to 3 months) designed for workers in public and private sectors who want to upgrade their skills or obtain specific industry certifications.
        </p>
        <h4 style="margin-top: 1rem; color: var(--primary-color);">Popular Programs:</h4>
        <ul style="padding-left: 1.5rem;">
            <li>Basic Web Development & Coding</li>
            <li>Computer Aided Drafting (AutoCAD)</li>
            <li>Industrial Electrician Training</li>
            <li>Solar System Panel Installation</li>
            <li>Basic Automotive Engine Diagnosis</li>
        </ul>
    </div>
</div>

<!-- Departments List -->
<section class="card" style="margin-bottom: 2rem;">
    <h3>Academic Departments</h3>
    <p style="margin-bottom: 1.5rem;">Below is the list of core departments in our polytechnic college and the primary qualifications they offer.</p>
    
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Available NTQF Levels</th>
                    <th>Core Specializations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Information Technology (IT)</strong></td>
                    <td>Level 3, 4, 5</td>
                    <td>Hardware & Networking, Database Administration, Software Development, IT Support</td>
                </tr>
                <tr>
                    <td><strong>Automotive Technology</strong></td>
                    <td>Level 1, 2, 3, 4, 5</td>
                    <td>Vehicle Engine Diagnostics, Auto Electricity, Body Repair, Heavy Machinery Maintenance</td>
                </tr>
                <tr>
                    <td><strong>Electrical & Electronics</strong></td>
                    <td>Level 2, 3, 4, 5</td>
                    <td>Industrial Electricity, Electronics Servicing, Control Systems, Solar Technology</td>
                </tr>
                <tr>
                    <td><strong>Manufacturing & Mechanical</strong></td>
                    <td>Level 1, 2, 3, 4</td>
                    <td>Machining, General Welding, Metal Fabrication, CAD/CAM Prototyping</td>
                </tr>
                <tr>
                    <td><strong>Construction & Civil Technology</strong></td>
                    <td>Level 1, 2, 3, 4, 5</td>
                    <td>Building Construction, Road Maintenance, Plumbing, Surveying, Masonry</td>
                </tr>
                <tr>
                    <td><strong>Garment & Textile</strong></td>
                    <td>Level 1, 2, 3, 4</td>
                    <td>Fashion Design, Tailoring, Industrial Sewing, Textile Production</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
