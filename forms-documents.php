<?php
$page_title = "Forms & Documents";
require_once __DIR__ . '/includes/header.php';
?>

<style>
.container{
    max-width:1200px;
    margin:auto;
    padding:20px;
}

.page-header{
    text-align:center;
    padding:50px 20px;
}

.page-header h2{
    color:#0c2340;
    font-size:40px;
    margin-bottom:15px;
}

.page-header p{
    color:#555;
    font-size:18px;
    line-height:1.8;
}

.section{
    background:#fff;
    padding:30px;
    margin-bottom:25px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.section h3{
    color:#0c2340;
    border-left:5px solid #d4af37;
    padding-left:12px;
    margin-bottom:20px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:20px;
}

.card{
    background:#f8f9fa;
    padding:20px;
    border-radius:10px;
    border-top:4px solid #0c2340;
}

.card h4{
    color:#0c2340;
    margin-bottom:10px;
}

.card p{
    color:#555;
    line-height:1.6;
}

.download-btn{
    display:inline-block;
    margin-top:10px;
    background:#0c2340;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
}

.download-btn:hover{
    background:#d4af37;
    color:#000;
}

ul{
    line-height:2;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#0c2340;
    color:white;
    padding:12px;
}

table td{
    border:1px solid #ddd;
    padding:12px;
}
</style>

<div class="container">

<div class="page-header">
    <h2>Forms & Documents</h2>

    <p>
        The Forms & Documents Service provides students with access
        to important academic and administrative forms required during
        their studies at Major General Mulugeta Buli Polytechnic College.
        Students can obtain forms from the Student Affairs Office or
        download them from the college website.
    </p>
</div>

<div class="section">

<h3>Overview</h3>

<p>
This service helps students access official college documents,
application forms, request forms, and administrative records.
These documents support academic, financial, housing, and student affairs services.
</p>

</div>

<div class="section">

<h3>Available Forms</h3>

<div class="grid">

<div class="card">
<h4>📝 Student Request Form</h4>
<p>
Used to request transcripts, recommendation letters,
enrollment verification, and other academic services.
</p>
<a href="#" class="download-btn">Download Form</a>
</div>

<div class="card">
<h4>📅 Leave Application Form</h4>
<p>
Used when students need official permission
to take temporary leave from studies.
</p>
<a href="#" class="download-btn">Download Form</a>
</div>

<div class="card">
<h4>✅ Clearance Form</h4>
<p>
Required for graduation, transfer,
withdrawal, or program completion.
</p>
<a href="#" class="download-btn">Download Form</a>
</div>

<div class="card">
<h4>🎓 Scholarship Application Form</h4>
<p>
Used to apply for scholarship and financial support opportunities.
</p>
<a href="#" class="download-btn">Download Form</a>
</div>

<div class="card">
<h4>🏠 Housing Application Form</h4>
<p>
Used to request dormitory accommodation
and residence services.
</p>
<a href="#" class="download-btn">Download Form</a>
</div>

<div class="card">
<h4>📢 Complaint Form</h4>
<p>
Used to submit complaints, appeals,
feedback, and suggestions.
</p>
<a href="#" class="download-btn">Download Form</a>
</div>

</div>

</div>

<div class="section">

<h3>How to Access Forms</h3>

<ul>
<li>Download forms from the college website.</li>
<li>Collect printed forms from Student Affairs Office.</li>
<li>Complete all required information accurately.</li>
<li>Attach supporting documents when necessary.</li>
<li>Submit completed forms to the responsible office.</li>
<li>Keep a copy of submitted documents.</li>
</ul>

</div>

<div class="section">

<h3>Required Supporting Documents</h3>

<ul>
<li>Student Identification Card</li>
<li>Admission Letter</li>
<li>Academic Transcript (if required)</li>
<li>Passport Size Photographs</li>
<li>Recommendation Letters (if required)</li>
<li>Additional Supporting Documents</li>
</ul>

</div>

<div class="section">

<h3>Services Supported</h3>

<ul>
<li>Student Registration & Records</li>
<li>Scholarship Applications</li>
<li>Housing & Accommodation Requests</li>
<li>Academic Advising Services</li>
<li>Career Development Services</li>
<li>Grievance & Complaint Services</li>
<li>Clearance Processing</li>
<li>Leave Applications</li>
</ul>

</div>

<div class="section">

<h3>Office Working Hours</h3>

<table>

<tr>
<th>Day</th>
<th>Working Hours</th>
</tr>

<tr>
<td>Monday - Friday</td>
<td>8:00 AM - 5:00 PM</td>
</tr>

<tr>
<td>Saturday</td>
<td>8:00 AM - 12:00 PM</td>
</tr>

<tr>
<td>Sunday</td>
<td>Closed</td>
</tr>

</table>

</div>

<div class="section">

<h3>Contact Information</h3>

<p><strong>Office:</strong> Forms & Documents Service Office</p>

<p><strong>College:</strong> Major General Mulugeta Buli Polytechnic College</p>

<p><strong>Location:</strong> Student Affairs Building</p>

<p><strong>Email:</strong> forms@mgmbptc.edu.et</p>

<p><strong>Phone:</strong> +251 XXX XXX XXX</p>

</div>

</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>