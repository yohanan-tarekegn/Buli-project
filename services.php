<?php
$page_title = 'Student Affairs & Services';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.page-header{
    text-align:center;
    margin-bottom:40px;
}

.page-header h2{
    color:#0c2340;
    font-size:2.5rem;
    margin-bottom:10px;
}

.page-header p{
    color:#555;
    max-width:800px;
    margin:auto;
}

.search-bar-container{
    max-width:600px;
    margin:0 auto 30px;
}

.search-input{
    width:100%;
    padding:15px 20px;
    border:2px solid #ddd;
    border-radius:50px;
    font-size:16px;
}

.grid-3{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:25px;
    margin-bottom:50px;
}

.interactive-card{
    background:#fff;
    border-radius:15px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    transition:.3s;
    border-top:5px solid #0c2340;
}

.interactive-card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.card-icon{
    font-size:50px;
    margin-bottom:15px;
}

.card-meta{
    margin-top:15px;
    padding-top:10px;
    border-top:1px solid #eee;
    color:#666;
    font-size:14px;
}

.club-accordion{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    margin-bottom:50px;
}

.accordion-item{
    border-bottom:1px solid #ddd;
    padding:15px 0;
}

.accordion-header{
    display:flex;
    justify-content:space-between;
    cursor:pointer;
    font-weight:bold;
    color:#0c2340;
}

.accordion-content{
    max-height:0;
    overflow:hidden;
    transition:max-height .3s ease;
}

.accordion-item.active .accordion-content{
    max-height:250px;
    margin-top:10px;
}

.contact-box{
    background:#0c2340;
    color:white;
    padding:40px;
    border-radius:15px;
    text-align:center;
}

.contact-box h3{
    margin-bottom:15px;
}
</style>

<div class="page-header">
    <h2>Student Affairs & Services</h2>

    <p>
        Madda Walabu University is committed to providing quality student
        support services that promote academic success, personal development,
        leadership, health, and campus engagement.
    </p>
</div>

<div class="search-bar-container">
    <input
        type="text"
        id="serviceSearch"
        class="search-input"
        placeholder="Search student services..."
    >
</div>

<div class="grid-3" id="servicesGrid">

    


    <div class="interactive-card">
        <div class="card-icon">🏥</div>
        <h3>Health Services</h3>
        <p>
            Medical consultations, first aid services,
            wellness programs and emergency support.
        </p>
        <br>
        <a href="health-services.php" class="service-btn">
    read more
        <div class="card-meta">
            Campus Health Center
        </div>
    </div>

    <div class="interactive-card">
        <div class="card-icon">📚</div>
        <h3>Library Services</h3>
        <p>
            Access books, journals, research databases,
            e-books and study facilities.
        </p>
        <br>
        
</a>
        <div class="card-meta">
            University Library
        </div>
    </div>

    <div class="interactive-card">
        <div class="card-icon">💼</div>
        <h3>Career Development</h3>
        <p>
            Career counseling, internships,
            job placement and CV writing support.
        </p>
        <br>
         <a href="career-development-services.php">
        read for more
    </a> 
        <div class="card-meta">
            Career Services Office
        </div>
    </div>

    <div class="interactive-card">
        <div class="card-icon">🏠</div>
        <h3>Housing & Accommodation</h3>
        <p>
            Dormitory services, housing support
            and accommodation information.
        </p>
        <br>
        <a href="student-housing-accommodation.php" class="service-btn">
    click for more
</a>
        <div class="card-meta">
            Student Housing Office
        </div>
    </div>

    <div class="interactive-card">
        <div class="card-icon">⚽</div>
        <h3>Sports & Recreation</h3>
        <p>
            Sports facilities, tournaments,
            fitness programs and recreational activities.
        </p>
        <div class="card-meta">
            Sports Department
        </div>
    </div>

    <div class="interactive-card">
        <div class="card-icon">📢</div>
        <h3>Grievance & Complaints</h3>
        <p>
            Student complaints, suggestions,
            appeals and feedback management.
        </p>
        <div class="card-meta">
            Student Affairs Office
        </div>
    </div>

</div>

<section class="club-accordion">

    <h3>Student Clubs & Organizations</h3>

    <p>
        Join clubs and organizations to enhance leadership,
        teamwork and community engagement.
    </p>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>🎓 Student Union</span>
            <span>+</span>
        </div>
        <div class="accordion-content">
            <p>
                Represents students and promotes student welfare,
                participation and leadership development.
            </p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>💻 ICT & Innovation Club</span>
            <span>+</span>
        </div>
        <div class="accordion-content">
            <p>
                Supports innovation, software development,
                technology projects and entrepreneurship.
            </p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>⚽ Sports Club</span>
            <span>+</span>
        </div>
        <div class="accordion-content">
            <p>
                Encourages participation in football,
                volleyball, basketball and athletics.
            </p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>🌱 Environmental Club</span>
            <span>+</span>
        </div>
        <div class="accordion-content">
            <p>
                Promotes environmental awareness,
                sustainability and community service.
            </p>
        </div>
    </div>

</section>

<div class="contact-box">
    <h3>Contact Student Affairs Office</h3>

    <p>
        Email: info@mwu.edu.et<br>
        Phone: +251 22 665 3092
    </p>

    <p>
        Madda Walabu University<br>
        Robe, Bale Zone, Oromia, Ethiopia
    </p>
</div>

<script>
document.addEventListener("DOMContentLoaded",function(){

const searchInput =
document.getElementById("serviceSearch");

const cards =
document.querySelectorAll(".interactive-card");

searchInput.addEventListener("keyup",function(){

let value =
this.value.toLowerCase();

cards.forEach(card=>{

if(card.innerText.toLowerCase().includes(value)){
card.style.display="block";
}
else{
card.style.display="none";
}

});

});

document.querySelectorAll(".accordion-header")
.forEach(header=>{

header.addEventListener("click",function(){

let item = this.parentElement;

item.classList.toggle("active");

});

});

});
</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>