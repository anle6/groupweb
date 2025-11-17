<?php
$pageClass = 'jobs-page';
require_once 'header.inc';
?>

<section class="hero hero-jobs">
    <h2>Open Positions</h2>
    <p>Explore career opportunities at Glitzers. We are always searching for brilliant minds to join our growing team.</p>
</section>

<main>
    <h1 id="main-title">Current Job Openings</h1>

    <!-- Aside with filters / info for jobs page (will be floated by CSS) -->
    <aside>
        <h4>Filter & Info</h4>
        <p>Location: Remote / Hybrid / On-site</p>
        <p>Employment: Full-time / Part-time</p>
        <p>Contact: hr@glitzers.example</p>
    </aside>

    <div class="jobs-grid">

        <article class="job-card">
            <h3>Cybersecurity Analyst (GA102)</h3>
            <p>Monitor threats, assess vulnerabilities, and respond to security incidents. You will work with SIEM tools, threat intelligence feeds, and endpoint protection technologies.</p>
            <a href="apply.php?jobRef=GA102">Apply Now</a>
        </article>

        <article class="job-card">
            <h3>Full-Stack Developer (FD215)</h3>
            <p>Develop, test, and maintain modern web applications. Work with JavaScript, PHP, MySQL, and RESTful APIs across both frontend and backend environments.</p>
            <a href="apply.php?jobRef=FD215">Apply Now</a>
        </article>

        <article class="job-card">
            <h3>Cloud Infrastructure Engineer (CE301)</h3>
            <p>Deploy and manage cloud-based systems using AWS, Azure, or Google Cloud. Responsibilities include automation, CI/CD, and infrastructure security.</p>
            <a href="apply.php?jobRef=CE301">Apply Now</a>
        </article>

    </div>
</main>

<?php require_once 'footer.inc'; ?>
