<?php
$page_title = "Search Results";
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/includes/db.php";

$query = trim($_GET['q'] ?? '');
$results = [];

if (!empty($query)) {
    $q_lower = strtolower($query);

    // 1. Search Departments & Academics
    $departments = [
        ["title" => "Information Technology (IT)", "desc" => "Hardware, Networking, Software Development, Database Administration.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Automotive Technology", "desc" => "Vehicle engine diagnostics, auto electricity, transmission systems.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Electrical & Electronics", "desc" => "Industrial control, power systems, electronic servicing, solar installation.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Manufacturing & Mechanical", "desc" => "CNC machining, lathe, milling, welding, metal fabrication.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Construction & Civil Technology", "desc" => "Building construction, road maintenance, plumbing, surveying, masonry.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Garment & Textile", "desc" => "Fashion design, tailoring, industrial sewing, textile production.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Woodwork Technology", "desc" => "Furniture design, cabinet making, interior wood finishing.", "link" => "academics.php#ntqf", "category" => "Academic Dept"],
        ["title" => "Business & Commerce", "desc" => "Accounting, marketing, HR management, secretarial science.", "link" => "academics.php#ntqf", "category" => "Academic Dept"]
    ];

    foreach ($departments as $dept) {
        if (strpos(strtolower($dept['title']), $q_lower) !== false || strpos(strtolower($dept['desc']), $q_lower) !== false) {
            $results[] = $dept;
        }
    }

    // 2. Search Innovation & Offices
    $institutional = [
        ["title" => "Incubation & Technology Hub", "desc" => "Prototyping laboratory, hardware fabrication, and startup support.", "link" => "innovation.php#incubation", "category" => "Innovation Hub"],
        ["title" => "Production & Trade Unit", "desc" => "Real-world manufacturing and commercial production services.", "link" => "innovation.php#production", "category" => "Production Unit"],
        ["title" => "Dean's Office", "desc" => "Col. Dr. Mulugeta Haile — Strategic planning and college governance.", "link" => "offices.php#dean", "category" => "Administration"],
        ["title" => "Vice Deans Directory", "desc" => "Academic, Technology Development, and Administrative vice deans.", "link" => "offices.php#vice-deans", "category" => "Administration"],
        ["title" => "Institutional Directorates", "desc" => "HR, Finance, Procurement, Plan & Budget, Internal Audit, Ethics, Property.", "link" => "offices.php#directorates", "category" => "Directorates"],
        ["title" => "Vocational Guidance & Counseling", "desc" => "Career aptitude testing, job placement assistance, and student counseling.", "link" => "academics.php#guidance", "category" => "Student Service"],
        ["title" => "Admission & Online Application", "desc" => "TVET diploma registration, required document uploads, fee structure.", "link" => "admission.php", "category" => "Admissions"],
        ["title" => "Download Center", "desc" => "Academic calendars, application forms, TVET handbooks, curriculum guides.", "link" => "downloads.php", "category" => "Downloads"]
    ];

    foreach ($institutional as $item) {
        if (strpos(strtolower($item['title']), $q_lower) !== false || strpos(strtolower($item['desc']), $q_lower) !== false) {
            $results[] = $item;
        }
    }

    // 3. Search Database News & Announcements if available
    if (isset($pdo) && $pdo instanceof PDO) {
        try {
            $stmt = $pdo->prepare("SELECT id, title_en, content_en, type FROM news_events WHERE title_en LIKE :q OR content_en LIKE :q LIMIT 5");
            $stmt->execute([':q' => "%$query%"]);
            $db_news = $stmt->fetchAll();
            foreach ($db_news as $n) {
                $results[] = [
                    "title" => $n['title_en'],
                    "desc" => strlen($n['content_en']) > 140 ? substr($n['content_en'], 0, 137) . "..." : $n['content_en'],
                    "link" => "news.php#news" . $n['id'],
                    "category" => ucfirst($n['type'])
                ];
            }
        } catch (\PDOException $e) {
            // Database query fallback
        }
    }
}
?>

<div class="page-header">
    <h2>🔍 Search Results</h2>
    <p><?php echo !empty($query) ? "Showing results for \"" . htmlspecialchars($query) . "\"" : "Please enter a search term above."; ?></p>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <!-- Search Form Input inside Page -->
    <form action="search.php" method="GET" style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem;">
        <input type="text" name="q" value="<?php echo htmlspecialchars($query); ?>" placeholder="Search programs, departments, news..." class="form-control" style="flex: 1;" required>
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <?php if (empty($query)): ?>
        <div class="alert alert-info">Enter a keyword above to search through MGMBPTC departments, admissions, news, and services.</div>
    <?php elseif (empty($results)): ?>
        <div class="alert alert-error">No results found for "<strong><?php echo htmlspecialchars($query); ?></strong>". Try searching for "IT", "Automotive", "Admission", "Dean", or "Fees".</div>
    <?php else: ?>
        <p style="font-weight: 700; color: var(--green-dark); margin-bottom: 1rem;">Found <?php echo count($results); ?> matching item(s):</p>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <?php foreach ($results as $res): ?>
                <div style="background: var(--gray-100); border: 1.5px solid var(--border-color); border-left: 4px solid var(--green-mid); border-radius: var(--radius-sm); padding: 1rem 1.25rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                        <span class="dept-badge"><?php echo htmlspecialchars($res['category']); ?></span>
                        <a href="<?php echo htmlspecialchars($res['link']); ?>" class="btn btn-outline" style="padding: 0.25rem 0.75rem; font-size: 0.78rem;">View Details &rarr;</a>
                    </div>
                    <h4 style="margin-bottom: 0.35rem; color: var(--green-dark);"><?php echo htmlspecialchars($res['title']); ?></h4>
                    <p style="font-size: 0.88rem; color: var(--gray-600); margin: 0;"><?php echo htmlspecialchars($res['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
