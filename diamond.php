<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}
$pageTitle = "Cash for Diamond in Ranchi | Gold Pe Cash";
$metaDescription = "Sell your diamond jewelry and loose stones at Gold Pe Cash Ranchi. Expert 4C valuation, best market price, instant cash payment guaranteed.";
$seoKey = 'diamond';
include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';
$S = getAllSettings();
?>

<!-- 
    CRITICAL MOBILE OVERRIDE
    This style block aggressively forces the hamburger menu to display 
    on mobile devices specifically for this page.
-->
<style>
    /* ===== DIAMOND STRUCTURAL CSS ===== */
    .gold-hero {
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 130px 20px 80px 20px;
        position: relative;
    }

    .gold-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(180, 150, 255, 0.15) 0%, transparent 70%);
    }

    .gold-hero-content {
        position: relative;
        z-index: 2;
    }

    .gold-hero h1 {
        font-size: 3.5rem;
        color: #d4b8ff;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 3px;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.5);
        margin-bottom: 15px;
    }

    .gold-hero p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
        margin: 0 auto 30px;
        line-height: 1.7;
    }

    .gold-hero .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(180, 150, 255, 0.2);
        border: 1px solid rgba(180, 150, 255, 0.5);
        color: #d4b8ff;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    .gold-stat-bar {
        background: linear-gradient(90deg, #b088f0 0%, #d4b8ff 50%, #b088f0 100%);
        padding: 30px 0;
    }

    .gold-stat-bar .stat-item {
        text-align: center;
        color: #100520;
    }

    .gold-stat-bar .stat-number {
        font-size: 2.2rem;
        font-weight: 900;
        display: block;
    }

    .gold-stat-bar .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
    }

    .gold-border-card {
        border-left: 4px solid #b088f0;
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .gold-cta-section {
        background: linear-gradient(135deg, rgba(20, 5, 40, 0.96) 0%, rgba(40, 10, 70, 0.94) 100%);
        padding: 80px 0;
        text-align: center;
        border-top: 1px solid rgba(180, 150, 255, 0.2);
    }

    @media (max-width: 768px) {
        .gold-hero {
            padding: 110px 20px 50px 20px !important;
            /* CRITICAL: 110px top padding clears the fixed header! */
            min-height: auto !important;
        }

        .gold-hero h1 {
            font-size: 2rem !important;
            margin-bottom: 5px !important;
        }

        .gold-hero p {
            display: none !important;
        }

        .gold-hero .hero-badge {
            margin-bottom: 15px !important;
        }

        .gold-hero-content .btn {
            margin: 5px !important;
            padding: 12px 25px !important;
            font-size: 0.9rem !important;
        }
    }

    @media (max-width: 992px) {
        header .hamburger {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            z-index: 999999 !important;
        }

        /* Ensure the individual hamburger lines are visible */
        header .hamburger span {
            background-color: #ffffff !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    }
</style>

<!-- DIAMOND HERO SECTION -->
<section class="gold-hero"
    style="background: linear-gradient(135deg, rgba(20, 5, 30, 0.95) 0%, rgba(40, 10, 60, 0.95) 100%);">
    <div class="gold-hero-content container">
        <div class="hero-badge"><i class="fas fa-gem"></i>
            <?= htmlspecialchars(s($S, 'diamond_hero_badge', 'DIAMOND BUYING SERVICE')) ?></div>
        <h1><?= htmlspecialchars(s($S, 'diamond_hero_h1', 'Cash for Diamond')) ?></h1>
        <p><?= htmlspecialchars(s($S, 'diamond_hero_text', 'Sell your diamond jewelry and loose stones at the highest live market rate. Expert 4C valuation, zero hassle, 100% transparent process.')) ?>
        </p>
        <a href="contact/?service=diamond" class="btn btn-red"
            style="padding:14px 40px; font-size:1rem; margin-right:15px;">
            <?= htmlspecialchars(s($S, 'diamond_hero_btn', 'Get Free Valuation')) ?>
        </a>
        <a href="tel:<?= preg_replace('/[^0-9+]/', '', s($S, 'phone', '+919576889595')) ?>" class="btn"
            style="background:rgba(255,255,255,0.1); color:#fff; border:2px solid rgba(255,255,255,0.4); padding:14px 40px; font-size:1rem; border-radius:50px;">Call
            Now</a>
    </div>
</section>

<!-- DIAMOND STATS BAR -->
<div class="gold-stat-bar" style="background: linear-gradient(90deg, #b088f0 0%, #d4b8ff 50%, #b088f0 100%);">
    <div class="container">
        <div style="display:grid; grid-template-columns: repeat(4,1fr); gap:20px;">
            <div class="stat-item"><span class="stat-number">4C</span><span class="stat-label">Expert Valuation</span>
            </div>
            <div class="stat-item"><span class="stat-number">Certified</span><span class="stat-label">Gemologists
                    On-Site</span></div>
            <div class="stat-item"><span class="stat-number">Instant</span><span class="stat-label">Cash Payment</span>
            </div>
            <div class="stat-item"><span class="stat-number">All Types</span><span class="stat-label">Diamonds
                    Accepted</span></div>
        </div>
    </div>
</div>

<!-- WHAT WE BUY -->
<section class="section-padding gold-section-bg" style="background: linear-gradient(135deg, #f8f5ff 0%, #f0ecff 100%);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="assets/images/service-diamond-final.png" alt="Diamond Buying at Gold Pe Cash"
                    style="width:100%; border-radius:16px; box-shadow: 0 20px 60px rgba(180,120,255,0.25);">
            </div>
            <div>
                <p class="section-label" style="color:#b088f0;">WHAT WE BUY</p>
                <h2 class="section-heading">
                    <?= htmlspecialchars(s($S, 'diamond_what_heading', 'All Types of Diamonds Accepted')) ?>
                </h2>
                <p style="color:var(--text-muted); line-height:1.8; margin-bottom:25px;">
                    <?= htmlspecialchars(s($S, 'diamond_what_text', 'Whether it\'s a solitaire from your engagement ring, loose stones from old jewelry, or a full diamond set — our certified gemologists evaluate every diamond using international standards. You get a transparent, documented valuation before accepting any offer.')) ?>
                </p>
                <div class="gold-border-card" style="border-left-color: #b088f0;">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-ring gold-accent" style="color: #b088f0;"></i>
                        <?= htmlspecialchars(s($S, 'diamond_item1_title', 'Diamond Jewelry')) ?></h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">
                        <?= htmlspecialchars(s($S, 'diamond_item1_text', 'Rings, earrings, necklaces, pendants — full pieces with diamonds accepted')) ?>
                    </p>
                </div>
                <div class="gold-border-card" style="border-left-color: #b088f0;">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-gem gold-accent" style="color: #b088f0;"></i>
                        <?= htmlspecialchars(s($S, 'diamond_item2_title', 'Loose Diamonds')) ?></h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">
                        <?= htmlspecialchars(s($S, 'diamond_item2_text', 'Loose certified or uncertified diamonds of any carat — individually evaluated')) ?>
                    </p>
                </div>
                <div class="gold-border-card" style="border-left-color: #b088f0;">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-boxes gold-accent" style="color: #b088f0;"></i>
                        <?= htmlspecialchars(s($S, 'diamond_item3_title', 'Diamond Sets')) ?></h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">
                        <?= htmlspecialchars(s($S, 'diamond_item3_text', 'Full bridal or occasion sets including necklace, earrings, bangles')) ?>
                    </p>
                </div>
                <a href="contact/?service=diamond" class="btn btn-red" style="margin-top:20px;">Get a Free Quote
                    Now</a>
            </div>
        </div>
    </div>
</section>

<!-- HOW WE VALUE DIAMONDS -->
<section class="section-padding gold-dark-bg" style="background: linear-gradient(135deg, #100520 0%, #201040 100%);">
    <div class="container">
        <p class="section-label text-center" style="color: #b088f0;">HOW WE VALUE</p>
        <h2 class="section-heading text-center" style="color: #d4b8ff !important;">
            <?= htmlspecialchars(s($S, 'diamond_4c_heading', 'The 4C Diamond Valuation')) ?>
        </h2>
        <p
            style="text-align:center; color:rgba(255,255,255,0.7) !important; max-width:600px; margin:15px auto 40px; font-size:1.05rem; line-height:1.7;">
            Every diamond we buy is evaluated against the international GIA 4C standard — the world's most trusted
            diamond grading system.
        </p>

        <div class="features-grid">
            <div class="feature-box" style="border-color: rgba(180, 150, 255, 0.3);">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #d4b8ff;">
                    <i class="fas fa-cut"></i>
                </div>
                <!-- Inline color forcing to override gold-dark-bg h4 -->
                <h4 style="color: #d4b8ff !important;"><?= htmlspecialchars(s($S, 'diamond_4c1_title', 'Cut')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'diamond_4c1_text', 'How precisely is the diamond shaped? A perfect cut creates maximum light reflection — the sparkle you see. Better cut = more brilliance = higher value.')) ?>
                </p>
            </div>
            <div class="feature-box" style="border-color: rgba(180, 150, 255, 0.3);">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #d4b8ff;">
                    <i class="fas fa-palette"></i>
                </div>
                <h4 style="color: #d4b8ff !important;"><?= htmlspecialchars(s($S, 'diamond_4c2_title', 'Color')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'diamond_4c2_text', 'Graded D (completely colorless) to Z (yellow tint). The closer to a D grade, the purer the diamond — and the higher the price we offer.')) ?>
                </p>
            </div>
            <div class="feature-box" style="border-color: rgba(180, 150, 255, 0.3);">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #d4b8ff;">
                    <i class="fas fa-search"></i>
                </div>
                <h4 style="color: #d4b8ff !important;"><?= htmlspecialchars(s($S, 'diamond_4c3_title', 'Clarity')) ?>
                </h4>
                <p><?= htmlspecialchars(s($S, 'diamond_4c3_text', 'Measures internal imperfections (inclusions). Grades range from FL (Flawless) to I3. Clearer diamonds with fewer inclusions earn significantly more.')) ?>
                </p>
            </div>
            <div class="feature-box" style="border-color: rgba(180, 150, 255, 0.3);">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #d4b8ff;">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h4 style="color: #d4b8ff !important;"><?= htmlspecialchars(s($S, 'diamond_4c4_title', 'Carat')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'diamond_4c4_text', 'The weight of your diamond. 1 carat = 0.2 grams. Bigger carats are rarer — but all four Cs together determine the true final value.')) ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- WHY SELL DIAMOND TO US -->
<section class="section-padding gold-section-bg" style="background: linear-gradient(135deg, #f8f5ff 0%, #f0ecff 100%);">
    <div class="container">
        <p class="section-label text-center" style="color: #b088f0;">WHY CHOOSE US</p>
        <h2 class="section-heading text-center">Why Sell Diamonds to Gold Pe Cash?</h2>
        <div class="features-grid" style="margin-top:40px;">
            <div class="feature-box bg-white">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #9050d0;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4>Trained Gemologists</h4>
                <p style="color:var(--text-muted); font-size:0.95rem;">On-site certified gemologists — not just gold
                    buyers. We truly understand diamonds.</p>
            </div>
            <div class="feature-box bg-white">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #9050d0;">
                    <i class="fas fa-eye"></i>
                </div>
                <h4>Transparent Evaluation</h4>
                <p style="color:var(--text-muted); font-size:0.95rem;">Full 4C valuation done in front of you. Every
                    step explained. No surprises.</p>
            </div>
            <div class="feature-box bg-white">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #9050d0;">
                    <i class="fas fa-check-double"></i>
                </div>
                <h4>All Diamonds Accepted</h4>
                <p style="color:var(--text-muted); font-size:0.95rem;">Certified or uncertified, loose or set in jewelry
                    — we buy all types of diamonds.</p>
            </div>
            <div class="feature-box bg-white">
                <div class="feature-icon" style="background: rgba(180, 150, 255, 0.15); color: #9050d0;">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h4>Instant Payment</h4>
                <p style="color:var(--text-muted); font-size:0.95rem;">Cash, NEFT, or IMPS — payment processed
                    immediately after agreed valuation.</p>
            </div>
        </div>
        <div style="text-align:center; margin-top:40px;">
            <a href="contact/?service=diamond" class="btn btn-red" style="padding:14px 40px; font-size:1rem;">Visit
                Us
                &amp; Get Diamond Quote</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="gold-cta-section"
    style="background: linear-gradient(135deg, rgba(20, 5, 40, 0.96) 0%, rgba(40, 10, 70, 0.94) 100%); border-top: 1px solid rgba(180, 150, 255, 0.2);">
    <div class="container">
        <p class="section-label" style="color: #b088f0;">READY TO SELL?</p>
        <h2 style="font-size:2.5rem; color:#fff; font-weight:900; margin-bottom:15px;">
            <?= htmlspecialchars(s($S, 'diamond_cta_heading', 'Get Expert Diamond Valuation Today')) ?>
        </h2>
        <p
            style="color:rgba(255,255,255,0.7); max-width:600px; margin:0 auto 35px; font-size:1.05rem; line-height:1.7;">
            <?= htmlspecialchars(s($S, 'diamond_cta_text', 'Our gemologists are waiting. No appointment needed — walk in with your diamonds and walk out with cash.')) ?>
        </p>
        <a href="contact/?service=diamond" class="btn btn-red"
            style="padding:16px 50px; font-size:1.1rem; margin-right:15px;">Get Free Valuation</a>
        <a href="gold-pe-cash-services/"
            style="color:rgba(255,255,255,0.6); font-size:0.95rem; text-decoration:underline; line-height:3;">View All
            Services</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>