<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}
$pageTitle = "Cash for Gold in Ranchi | Gold Pe Cash";
$metaDescription = "Sell your gold jewelry, coins and bars at Gold Pe Cash Ranchi for the highest price. Instant cash, transparent process, best rates guaranteed.";
$seoKey = 'gold';
include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';
$S = getAllSettings();
?>

<style>
    /* ===== GOLD PAGE THEME ===== */
    .gold-hero {
        min-height: 480px;
        background:
            linear-gradient(135deg, rgba(30, 10, 0, 0.88) 0%, rgba(90, 50, 0, 0.85) 100%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c8a84b' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 100px 20px;
        position: relative;
    }

    .gold-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(200, 168, 75, 0.15) 0%, transparent 70%);
    }

    .gold-hero-content {
        position: relative;
        z-index: 2;
    }

    .gold-hero h1 {
        font-size: 3.5rem;
        color: #c8a84b;
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
        background: rgba(200, 168, 75, 0.2);
        border: 1px solid rgba(200, 168, 75, 0.5);
        color: #c8a84b;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    .gold-section-bg {
        background: linear-gradient(135deg, #fffdf4 0%, #fdf5dc 100%);
    }

    .gold-dark-bg {
        background:
            linear-gradient(135deg, #1a0f00 0%, #2d1a00 100%),
            url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23c8a84b' fill-opacity='0.08'%3E%3Cpath d='M20 20.5V18H0v5h5v5H0v5h20v-2.5l5 2.5V20l-5 .5z'/%3E%3C/g%3E%3C/svg%3E");
        color: white;
    }

    .gold-dark-bg .section-heading,
    .gold-dark-bg h3,
    .gold-dark-bg h4 {
        color: #c8a84b !important;
    }

    .gold-dark-bg p,
    .gold-dark-bg li {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .gold-dark-bg .feature-box {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(200, 168, 75, 0.3);
    }

    .gold-dark-bg .feature-icon {
        background: rgba(200, 168, 75, 0.15);
        color: #c8a84b;
    }

    .gold-stat-bar {
        background: linear-gradient(90deg, #c8a84b 0%, #f0d060 50%, #c8a84b 100%);
        padding: 30px 0;
    }

    .gold-stat-bar .stat-item {
        text-align: center;
        color: #1a0f00;
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

    .gold-accent {
        color: #c8a84b;
    }

    .gold-border-card {
        border-left: 4px solid #c8a84b;
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .gold-cta-section {
        background:
            linear-gradient(135deg, rgba(74, 0, 16, 0.95) 0%, rgba(120, 20, 30, 0.92) 100%),
            url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23c8a84b' fill-opacity='0.07'%3E%3Cpath d='M14 16H9v-2h5V9.87a4 4 0 1 1 2 0V14h5v2h-5v15.95A10 10 0 0 0 23.66 30h5.34A2 2 0 0 1 31 32v2a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h5.34A10 10 0 0 0 14 31.95V16z'/%3E%3C/g%3E%3C/svg%3E");
        padding: 80px 0;
        text-align: center;
    }

    @media (max-width: 768px) {
        .gold-hero {
            padding: 120px 20px 50px 20px !important;
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
            margin-bottom: 5px !important;
        }

        .gold-hero-content .btn {
            margin: 5px !important;
            padding: 12px 25px !important;
            font-size: 0.9rem !important;
        }
    }
</style>

<!-- GOLD HERO SECTION -->
<section class="gold-hero">
    <div class="gold-hero-content container">
        <div class="hero-badge"><i class="fas fa-crown"></i>
            <?= htmlspecialchars(s($S, 'gold_hero_badge', 'GOLD BUYING SERVICE')) ?></div>
        <h1><?= htmlspecialchars(s($S, 'gold_hero_h1', 'Cash for Gold')) ?></h1>
        <p><?= htmlspecialchars(s($S, 'gold_hero_text', 'Sell your gold jewelry, coins, bars & scrap at the highest live market rate. Instant payment, zero hassle, 100% transparent process.')) ?>
        </p>
        <a href="contact/?service=gold" class="btn btn-red"
            style="padding:14px 40px; font-size:1rem; margin-right:15px;">
            <?= htmlspecialchars(s($S, 'gold_hero_btn', 'Get Free Valuation')) ?>
        </a>
        <a href="tel:<?= preg_replace('/[^0-9+]/', '', s($S, 'phone', '+919576889595')) ?>" class="btn"
            style="background:rgba(255,255,255,0.1); color:#fff; border:2px solid rgba(255,255,255,0.4); padding:14px 40px; font-size:1rem; border-radius:50px;">Call
            Now</a>
    </div>
</section>

<!-- GOLD STATS BAR -->
<div class="gold-stat-bar">
    <div class="container">
        <div style="display:grid; grid-template-columns: repeat(4,1fr); gap:20px;">
            <div class="stat-item"><span class="stat-number">24K</span><span class="stat-label">Gold Accepted</span>
            </div>
            <div class="stat-item"><span class="stat-number">₹ Best</span><span class="stat-label">Rate
                    Guaranteed</span></div>
            <div class="stat-item"><span class="stat-number">30 Min</span><span class="stat-label">Full Process</span>
            </div>
            <div class="stat-item"><span class="stat-number">10,000+</span><span class="stat-label">Happy
                    Customers</span></div>
        </div>
    </div>
</div>

<!-- WHAT WE BUY -->
<section class="section-padding gold-section-bg">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="assets/images/service-gold-final.png" alt="Gold Buying at Gold Pe Cash"
                    style="width:100%; border-radius:16px; box-shadow: 0 20px 60px rgba(200,168,75,0.25);">
            </div>
            <div>
                <p class="section-label">WHAT WE BUY</p>
                <h2 class="section-heading">
                    <?= htmlspecialchars(s($S, 'gold_what_heading', 'All Types of Gold Accepted')) ?>
                </h2>
                <p style="color:var(--text-muted); line-height:1.8; margin-bottom:25px;">
                    <?= htmlspecialchars(s($S, 'gold_what_text', 'Whether it\'s old jewelry from your locker, broken bangles, gold coins, or inherited gold bars — we buy everything.')) ?>
                </p>
                <div class="gold-border-card">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-ring gold-accent"></i>
                        <?= htmlspecialchars(s($S, 'gold_item1_title', 'Jewelry')) ?></h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">
                        <?= htmlspecialchars(s($S, 'gold_item1_text', 'Necklaces, bangles, rings, earrings, maang tikka, payal — all accepted')) ?>
                    </p>
                </div>
                <div class="gold-border-card">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-coins gold-accent"></i>
                        <?= htmlspecialchars(s($S, 'gold_item2_title', 'Gold Coins & Bars')) ?></h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">
                        <?= htmlspecialchars(s($S, 'gold_item2_text', '22K & 24K coins, Sovereign gold bonds, gold bars — any weight accepted')) ?>
                    </p>
                </div>
                <div class="gold-border-card">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-recycle gold-accent"></i>
                        <?= htmlspecialchars(s($S, 'gold_item3_title', 'Scrap Gold')) ?></h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">
                        <?= htmlspecialchars(s($S, 'gold_item3_text', 'Broken pieces, melted gold, leftover gold from any source accepted')) ?>
                    </p>
                </div>
                <a href="contact/?service=gold" class="btn btn-red" style="margin-top:20px;">Get a Free Quote
                    Today</a>
            </div>
        </div>
    </div>
</section>

<!-- HOW WE VALUE GOLD -->
<section class="section-padding gold-dark-bg">
    <div class="container">
        <p class="section-label text-center" style="color:#c8a84b;">OUR TECHNOLOGY</p>
        <h2 class="section-heading text-center" style="color:#c8a84b;">
            <?= htmlspecialchars(s($S, 'gold_tech_heading', 'How We Value Your Gold')) ?>
        </h2>
        <div class="features-grid" style="margin-top:40px;">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-microscope"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_tech1_title', 'XRF Testing')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_tech1_text', 'We use German KARATMETER technology — the most accurate gold testing method available, tested in front of you.')) ?>
                </p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-weight-hanging"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_tech2_title', 'Precision Weighing')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_tech2_text', 'Gold is weighed on calibrated digital scales accurate to 0.01 grams. You verify the reading yourself.')) ?>
                </p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_tech3_title', 'Live Market Rate')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_tech3_text', 'We offer rates directly linked to today\'s MCX / international gold market price. No below-market offers.')) ?>
                </p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_tech4_title', 'Instant Payment')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_tech4_text', 'Cash in hand, NEFT, RTGS or IMPS — payment processed within minutes of final valuation.')) ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- WHY SELL GOLD TO US -->
<section class="section-padding gold-section-bg">
    <div class="container">
        <p class="section-label text-center">WHY CHOOSE US</p>
        <h2 class="section-heading text-center">
            <?= htmlspecialchars(s($S, 'gold_why_heading', 'Why Sell Gold to Gold Pe Cash?')) ?>
        </h2>
        <div class="features-grid" style="margin-top:40px;">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-trophy"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_why1_title', 'Highest Payout')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_why1_text', 'We consistently beat competitor rates. You get more cash for the same gold — guaranteed.')) ?>
                </p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_why2_title', 'No Damage Testing')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_why2_text', 'XRF testing causes zero damage. Your gold is returned exactly as you brought it, if needed.')) ?>
                </p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-rupee-sign"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_why3_title', 'Same Day Payment')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_why3_text', 'Cash, NEFT, or IMPS — payment done immediately after valuation. No waiting period ever.')) ?>
                </p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h4><?= htmlspecialchars(s($S, 'gold_why4_title', '6 Ranchi Branches')) ?></h4>
                <p><?= htmlspecialchars(s($S, 'gold_why4_text', 'Multiple branches across Ranchi. Walk in any time — no appointment needed.')) ?>
                </p>
            </div>
        </div>
        <div style="text-align:center; margin-top:40px;">
            <a href="contact/?service=gold" class="btn btn-red" style="padding:14px 40px; font-size:1rem;">Visit Us
                &amp; Get Quote</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="gold-cta-section">
    <div class="container">
        <p class="section-label" style="color:#c8a84b;">READY TO SELL?</p>
        <h2 style="font-size:2.5rem; color:#fff; font-weight:900; margin-bottom:15px;">
            <?= htmlspecialchars(s($S, 'gold_cta_heading', 'Get the Best Price for Your Gold Today')) ?>
        </h2>
        <p
            style="color:rgba(255,255,255,0.75); max-width:600px; margin:0 auto 35px; font-size:1.05rem; line-height:1.7;">
            <?= htmlspecialchars(s($S, 'gold_cta_text', 'Walk in to any of our Ranchi branches. No appointment needed. Bring your gold and ID — walk out with cash.')) ?>
        </p>
        <a href="contact/?service=gold" class="btn btn-red"
            style="padding:16px 50px; font-size:1.1rem; margin-right:15px;">Get Free Valuation</a>
        <a href="gold-pe-cash-services/"
            style="color:rgba(255,255,255,0.7); font-size:0.95rem; text-decoration:underline; line-height:3;">View All
            Services</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>