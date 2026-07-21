<?php
$page_title = 'Staff Directory';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h2>College Staff Directory</h2>
</div>

<section class="hero-staff">

    <h1>Meet Our Leadership & Staff</h1>

    <p>
        Search and find information about MGMBPTC administrators,
        department heads, instructors, and support staff.
    </p>

</section>

<!-- Directory Filtering Controls (Mockup Layout) -->
<section class="card" style="margin-bottom: 2rem; background-color: #edf2f7;">
    <h4 style="margin-bottom: 1rem;">Filter Directory</h4>
    <form action="staff.php" method="GET" onsubmit="event.preventDefault();">
        <div class="grid-3" style="margin-bottom: 0;">
            <div class="form-group" style="margin-bottom: 0;">
                <input type="text" id="staffSearch" class="form-control" placeholder="Search by name...">
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <select id="staffDeptFilter" class="form-control">
                    <option value="">-- All Departments --</option>
                    <option value="Administration">Administration</option>
                    <option value="IT">Information Technology</option>
                    <option value="Automotive">Automotive Technology</option>
                    <option value="Electrical">Electrical & Electronics</option>
                    <option value="Mechanical">Mechanical & Manufacturing</option>
                </select>
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn" style="flex: 1;">Search</button>
                <button type="reset" class="btn btn-secondary" onclick="document.getElementById('staffSearch').value=''; document.getElementById('staffDeptFilter').selectedIndex=0;">Reset</button>
            </div>
        </div>
    </form>



<!-- ================= LEADERSHIP TEAM ================= -->

<section class="staff-section">

<h2>Leadership Team</h2>

<div class="staff-grid">


<div class="staff-card">

<img src="images/staff/dean.jpg" class="staff-photo">

<h3>College Dean</h3>

<h4>Dr. Abebe Kebede</h4>

<p>
Administration Department
</p>

<p>
Educational Administration and Leadership
</p>

<a href="mailto:dean@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>



<div class="staff-card">

<img src="images/staff/academic.jpg" class="staff-photo">

<h3>Academic Vice Dean</h3>

<h4>Ato Tsegaye Mengistu</h4>

<p>
Administration Department
</p>

<p>
Curriculum Development and Academic Affairs
</p>

<a href="mailto:academic@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>




<div class="staff-card">

<img src="images/staff/admin.jpg" class="staff-photo">

<h3>Administrative Vice Dean</h3>

<h4>W/ro Aster Almaz</h4>

<p>
Administration Department
</p>

<p>
Human Resource Management
</p>

<a href="mailto:admin@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>


</div>

</section>



<!-- ================= DEPARTMENT HEADS ================= -->


<section class="staff-section">

<h2>Department Heads</h2>


<div class="staff-grid">


<div class="staff-card">

<img src="images/staff/it.jpg" class="staff-photo">

<h3>Department Head</h3>

<h4>Ato Yohannes Bekele</h4>

<p>
Information Technology
</p>

<p>
Database and Networking Specialist
</p>

<a href="mailto:it@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>




<div class="staff-card">

<img src="images/staff/auto.jpg" class="staff-photo">

<h3>Department Head</h3>

<h4>Ato Mulugeta Tadesse</h4>

<p>
Automotive Technology
</p>

<p>
Automotive Diagnostics Expert
</p>

<a href="mailto:auto@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>




<div class="staff-card">

<img src="images/staff/electrical.jpg" class="staff-photo">

<h3>Department Head</h3>

<h4>W/t Kidist Daniel</h4>

<p>
Electrical & Electronics
</p>

<p>
Embedded Systems
</p>

<a href="mailto:electrical@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>
<!-- Construction Technology Head -->

<div class="staff-card"
data-name="Construction Technology Department Head"
data-department="Construction Technology">


<img src="images/staff/construction.jpg"
class="staff-photo"
alt="Construction Head">


<h3>
Department Head
</h3>


<h4>
Construction Technology
</h4>


<p>
Building Construction and Engineering
</p>


<p>
Construction Design Specialist
</p>


<a href="mailto:construction@mgmbptc.edu.et"
class="email-btn">

📧 Email

</a>


</div>





<!-- Mechanical Manufacturing Head -->

<div class="staff-card"
data-name="Mechanical Manufacturing Department Head"
data-department="Mechanical & Manufacturing">


<img src="images/staff/mechanical.jpg"
class="staff-photo"
alt="Mechanical Head">


<h3>
Department Head
</h3>


<h4>
Mechanical & Manufacturing Technology
</h4>


<p>
Manufacturing Systems and CAD Design
</p>


<p>
Workshop and Production Specialist
</p>


<a href="mailto:mechanical@mgmbptc.edu.et"
class="email-btn">

📧 Email

</a>


</div>


</div>

</section>




<!-- ================= ACADEMIC STAFF ================= -->


<section class="staff-section">

<h2>Academic Staff</h2>


<div class="staff-grid">


<div class="staff-card">

<img src="images/staff/instructor1.jpg" class="staff-photo">

<h3>Instructor</h3>

<h4>Sample Instructor</h4>

<p>
Information Technology
</p>

<p>
Software Development
</p>

<a href="mailto:staff@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>



<div class="staff-card">

<img src="img.jpg" class="staff-photo">

<h3>Instructor</h3>

<h4>Sample Instructor</h4>

<p>
Mechanical Technology
</p>

<p>
Manufacturing Specialist
</p>

<a href="mailto:staff2@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>


</div>

</section>




<!-- ================= ADMINISTRATIVE STAFF ================= -->


<section class="staff-section">

<h2>Administrative Staff</h2>


<div class="staff-grid">


<div class="staff-card">

<img src="imgage.jpg" class="staff-photo">

<h3>Registrar</h3>

<h4>Sample Name</h4>

<p>
Student Affairs Office
</p>


<a href="mailto:registrar@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>



<div class="staff-card">

<img src="images/staff/library.jpg" class="staff-photo">

<h3>Librarian</h3>

<h4>Sample Name</h4>

<p>
Library Service
</p>


<a href="mailto:library@mgmbptc.edu.et" class="email-btn">
📧 Email
</a>

</div>


</div>

</section>



<!-- ================= CSS ================= -->


<style>


.hero-staff{

text-align:center;

padding:5px;

background:#003366;

color:white;

border-radius:15px;

}


.hero-staff h1{

font-size:40px;

}



.staff-section{

margin:60px 0;

}



.staff-section h2{

text-align:center;

color:#003366;

font-size:32px;

margin-bottom:30px;

}



.staff-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(280px,1fr));

gap:30px;

}



.staff-card{

background:white;

padding:25px;

text-align:center;

border-radius:20px;

box-shadow:0 8px 20px rgba(0,0,0,.12);

transition:.3s;

}



.staff-card:hover{

transform:translateY(-10px);

}



.staff-photo{

width:150px;

height:150px;

border-radius:50%;

object-fit:cover;

border:5px solid #003366;

}



.staff-card h3{

color:#0066cc;

margin-top:20px;

}



.staff-card h4{

font-size:20px;

}



.email-btn{

display:inline-block;

margin-top:15px;

background:#0066cc;

color:white;

padding:12px 25px;

border-radius:30px;

text-decoration:none;

}



.email-btn:hover{

background:#003366;

}



@media(max-width:600px){

.hero-staff h1{

font-size:28px;

}

}


</style>


<?php
require_once __DIR__ . '/includes/footer.php';
?>
          