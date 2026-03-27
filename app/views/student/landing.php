<section class="hero hero-professional hero--mesh" aria-labelledby="hero-title">
    <div class="hero-main">
        <p class="eyebrow">Tribhuvan University</p>
        <h1 id="hero-title">Build your future with confidence</h1>
        <p class="hero-lead">
            Discover programmes inspired by the Tribhuvan University model, compare
            academic pathways, and plan your next step with clear course and module details.
        </p>
        <div class="hero-actions">
            <a class="button-link" href="<?= e(url('/programmes')) ?>">Explore Programmes</a>
            <a class="button-link secondary-link" href="<?= e(url('/admin/login')) ?>">Admin Portal</a>
        </div>
    </div>
    <aside class="hero-panel" aria-label="Quick highlights">
        <h3>At a glance</h3>
        <ul class="hero-highlights">
            <li><strong><?= (int) $programmeCount ?></strong> published programmes</li>
            <li>Undergraduate and postgraduate pathways</li>
            <li>Module-by-year curriculum visibility</li>
        </ul>
    </aside>
</section>

<section class="content-section prose-block">
    <h2>About Tribhuvan University</h2>
    <p>
        Tribhuvan University is one of Nepal's oldest and largest public universities.
        Known for broad academic offerings and national reach through campuses and
        affiliated colleges, it supports accessible, quality higher education for
        students from diverse regions and backgrounds.
    </p>
</section>

<section class="landing-grid content-section" aria-label="Key information">
    <article class="feature-tile">
        <h3>Academic Faculties</h3>
        <p class="muted">A multi-disciplinary study environment.</p>
        <ul>
            <li>Science and Technology</li>
            <li>Management and Business Studies</li>
            <li>Humanities, Education, and Law</li>
        </ul>
    </article>
    <article class="feature-tile">
        <h3>Student Journey</h3>
        <p class="muted">Simple steps from discovery to decision.</p>
        <ol>
            <li>Browse and compare programme options.</li>
            <li>Review level, modules, and course details.</li>
            <li>Register interest for updates and guidance.</li>
        </ol>
    </article>
    <article class="feature-tile">
        <h3>Why this platform</h3>
        <p class="muted">Built for clarity and faster decisions.</p>
        <ul>
            <li>Structured programme and module information</li>
            <li>Search and filter for focused exploration</li>
            <li>Quick expression of interest per programme</li>
        </ul>
    </article>
</section>

<section class="landing-cta content-section">
    <h2>Start exploring today</h2>
    <p>
        View available programmes and find the right academic pathway for your goals.
    </p>
    <a class="button-link" href="<?= e(url('/programmes')) ?>">Go to Programmes</a>
</section>
