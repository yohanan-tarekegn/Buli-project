<?php
$page_title = 'Student Services';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Custom inline CSS for this page's specific modern UI features -->
<style>
    .page-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    
    .page-header h2 {
        color: var(--primary-color, #0c2340);
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
    }
    
    .search-bar-container {
        max-width: 500px;
        margin: 0 auto 2rem auto;
        text-align: center;
    }

    .search-input {
        width: 100%;
        padding: 12px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 30px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
    }

    .search-input:focus {
        border-color: var(--accent-color, #d4af37);
        box-shadow: 0 0 8px rgba(212, 175, 55, 0.2);
    }

    /* Grid Layout */
    .grid-3 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 3rem;
    }

    /* Interactive Cards */
    .interactive-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-top: 5px solid var(--primary-color, #0c2340);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .interactive-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        border-top-color: var(--accent-color, #d4af37);
    }

    .card-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .card-meta {
        font-size: 0.85rem;
        color: #718096;
        border-top: 1px solid #edf2f7;
        padding-top: 10px;
        margin-top: 15px;
    }

    /* Accordion Style for Clubs */
    .club-accordion {
        margin-top: 3rem;
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .accordion-item {
        border-bottom: 1px solid #edf2f7;
        padding: 15px 0;
    }

    .accordion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-weight: bold;
        color: var(--primary-color, #0c2340);
        font-size: 1.1rem;
        user-select: none;
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        color: #4a5568;
        font-size: 0.95rem;
        margin-top: 0;
    }

    .accordion-item.active .accordion-content {
        max-height: 200px;
        margin-top: 10px;
    }

    .accordion-icon {
        transition: transform 0.3s ease;
    }

    .accordion-item.active .accordion-icon {
        transform: rotate(45deg);
    }
</style>

<div class="page-header">
    <h2>Student Affairs & Campus Services</h2>
    <p>Ensuring a supportive, engaging, and dynamic environment for your polytechnic journey.</p>
</div>

<!-- Interactive Search Filter -->
<div class="search-bar-container">
    <input type="text" id="serviceSearch" class="search-input" placeholder="Search for services, clinics, clubs...">
</div>

<!-- Service Cards Grid -->
<div class="grid-3" id="servicesGrid">
    <!-- Card 1 -->
    <div class="interactive-card" data-title="digital physical library books study hours">
        <div>
            <div class="card-icon">📚</div>
            <h3>Digital & Physical Library</h3>
            <p style="font-size: 0.95rem; color: #4a5568; line-height: 1.6;">
                Access over 10,000 engineering, automotive, and IT reference textbooks, alongside digital PCs connected directly to open-access e-book repositories.
            </p>
        </div>
        <div class="card-meta">
            <strong>⏰ Hours:</strong> Mon - Sat: 8:00 AM - 8:00 PM
        </div>
    </div>

    <!-- Card 2 -->
    <div class="interactive-card" data-title="college health clinic medical first aid block b">
        <div>
            <div class="card-icon">🏥</div>
            <h3>College Health Clinic</h3>
            <p style="font-size: 0.95rem; color: #4a5568; line-height: 1.6;">
                Our on-campus clinic offers free primary healthcare consultations, basic treatment, and emergency referrals handled by certified clinical nurses.
            </p>
        </div>
        <div class="card-meta">
            <strong>📍 Location:</strong> Ground Floor, Block B
        </div>
    </div>

    <!-- Card 3 -->
    <div class="interactive-card" data-title="guidance counseling stress mental health support career">
        <div>
            <div class="card-icon">🤝</div>
            <h3>Guidance & Counseling</h3>
            <p style="font-size: 0.95rem; color: #4a5568; line-height: 1.6;">
                Get personalized guidance from professional academic mentors regarding stress management, career pathways, and academic growth.
            </p>
        </div>
        <div class="card-meta">
            <strong>📧 Contact:</strong> counseling@mgmbptc.edu.et
        </div>
    </div>
</div>

<!-- Interactive Clubs Accordion Section -->
<section class="club-accordion">
    <h3 style="color: var(--primary-color, #0c2340); margin-bottom: 5px;">Campus Clubs & Representative Union</h3>
    <p style="color: #718096; margin-bottom: 20px;">Click on a club to view details and learn how you can participate.</p>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>🎓 Student Union Executive Council</span>
            <span class="accordion-icon">➕</span>
        </div>
        <div class="accordion-content">
            <p>The Student Union acts as the bridge connecting MGMBPTC students to the administrative council. They organize annual forums, technical exhibitions, and advocate for student welfare and facility improvements.</p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>⚙️ Technology & Innovation Club</span>
            <span class="accordion-icon">➕</span>
        </div>
        <div class="accordion-content">
            <p>Collaborate with students across IT, Electronics, and Automotive departments to build cross-functional projects. Members gain exclusive access to innovation labs after academic class hours.</p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>⚽ Sports & Athletics Club</span>
            <span class="accordion-icon">➕</span>
        </div>
        <div class="accordion-content">
            <p>Represent MGMBPTC in regional TVET tournaments! We host active internal and inter-collegiate teams for football, volleyball, and basketball on our central campus field.</p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">
            <span>🌱 Environmental Protection & Green Club</span>
            <span class="accordion-icon">➕</span>
        </div>
        <div class="accordion-content">
            <p>Join hands in leading tree-planting days, ecological beauty drives on campus, and community garbage recycling awareness workshops around local neighborhoods.</p>
        </div>
    </div>
</section>

<!-- Frontend Interactive Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Live Search functionality
    const searchInput = document.getElementById("serviceSearch");
    const cards = document.querySelectorAll(".interactive-card");

    searchInput.addEventListener("input", function() {
        const query = searchInput.value.toLowerCase().trim();

        cards.forEach(card => {
            const dataTitle = card.getAttribute("data-title").toLowerCase();
            const textContent = card.innerText.toLowerCase();

            if (dataTitle.includes(query) || textContent.includes(query)) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    });

    // 2. Accordion Interaction
    const accordionHeaders = document.querySelectorAll(".accordion-header");

    accordionHeaders.forEach(header => {
        header.addEventListener("click", function() {
            const parent = this.parentElement;
            
            // Toggle active state
            parent.classList.toggle("active");

            // Change icon indicator
            const icon = this.querySelector(".accordion-icon");
            if (parent.classList.contains("active")) {
                icon.textContent = "➖";
            } else {
                icon.textContent = "➕";
            }
        });
    });
});
</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
