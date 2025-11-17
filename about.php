<?php
$pageClass = 'about-page';
require_once 'header.inc';
?>

<section class="hero hero-about">
    <h2>About Glitzers</h2>
    <p>Learn more about our mission, values, and the team behind Glitzers.</p>
</section>

<main>
    <div class="about-board">
        <div class="about-main">
            <h2>About Our Group</h2>
            <p>Team 36 — presented in the Glitzers project — worked together to deliver this recruitment and information site as part of the COS10026 assignment.</p>

            <h3>Group Information</h3>
            <p><strong>Group Name:</strong> Team 36 Rau Ma</p>
            <p><strong>Class Schedule:</strong> Day: Friday &nbsp;|&nbsp; Time: 2:00 PM – 5:00 PM</p>

            <h3>Member Contributions</h3>
            <div class="member-card"><strong>Minh Viet</strong> — Designed and developed HTML structure and CSS layout.</div>
            <div class="member-card"><strong>Danh Phong</strong> — Worked on back-end logic and apply interactivity.</div>
            <div class="member-card"><strong>Sy An</strong> — Wrote and formatted content for topic and enhancement pages.</div>

            <h3>Members' Interests</h3>
            <p><strong>Table 1: Our Group Interests</strong></p>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Favourite Book</th>
                        <th>Favourite Movie</th>
                        <th>Hobby</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Minh Viet</td>
                        <td>The Pragmatic Programmer</td>
                        <td>Inception</td>
                        <td>Photography</td>
                    </tr>
                    <tr>
                        <td>Danh Phong</td>
                        <td>Clean Code</td>
                        <td>Interstellar</td>
                        <td>Coding</td>
                    </tr>
                    <tr>
                        <td>Sy An</td>
                        <td>Harry Potter</td>
                        <td>Avengers: Endgame</td>
                        <td>Music</td>
                    </tr>
                </tbody>
            </table>

            <p>All members share an interest in technology and innovation.</p>
        </div>

        <aside class="aside-panel">
            <div class="student-id">Student IDs</div>
            <ul>
                <li>103995123 – Minh Viet</li>
                <li>103181456 – Danh Phong</li>
                <li>104024789 – Sy An</li>
            </ul>

            <h4 style="margin-top:12px;">Tutor</h4>
            <p>Mr. Binh Vu</p>

            <figure>
                <img src="images/rauma.png" alt="Team 36 group photo">
                <figcaption>Team 36 — Rau Ma</figcaption>
            </figure>
        </aside>
    </div>
</main>

<?php require_once 'footer.inc'; ?>
