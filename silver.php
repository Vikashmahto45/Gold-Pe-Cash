<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}
$pageTitle = "Cash for Silver in Ranchi | Gold Pe Cash";
$metaDescription = "Sell your silver coins, utensils, jewelry and bars at Gold Pe Cash Ranchi. Best market rates, instant cash, transparent process guaranteed.";
$seoKey = 'silver';
include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';
$S = getAllSettings();
?>

<style>
    /* ===== SILVER PAGE THEME ===== */
    .silver-hero {
        min-height: 480px;
        background:
            linear-gradient(135deg, rgba(15, 20, 30, 0.92) 0%, rgba(40, 55, 75, 0.90) 100%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23a8b8c8' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 100px 20px;
        position: relative;
    }

    .silver-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(168, 184, 200, 0.12) 0%, transparent 70%);
    }

    .silver-hero-content {
        position: relative;
        z-index: 2;
    }

    .silver-hero h1 {
        font-size: 3.5rem;
        color: #c0cfe0;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 3px;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.5);
        margin-bottom: 15px;
    }

    .silver-hero p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
        margin: 0 auto 30px;
        line-height: 1.7;
    }

    .silver-hero .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(192, 207, 224, 0.15);
        border: 1px solid rgba(192, 207, 224, 0.4);
        color: #c0cfe0;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    .silver-stat-bar {
        background: linear-gradient(90deg, #7a8fa0 0%, #b0c8d8 40%, #d0dde8 60%, #a0b8c8 100%);
        padding: 30px 0;
    }

    .silver-stat-bar .stat-item {
        text-align: center;
        color: #1a2530;
    }

    .silver-stat-bar .stat-number {
        font-size: 2.2rem;
        font-weight: 900;
        display: block;
    }

    .silver-stat-bar .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
    }

    .silver-section-bg {
        background: linear-gradient(135deg, #f4f7fa 0%, #eaf0f6 100%);
    }

    .silver-dark-bg {
        background:
            linear-gradient(135deg, #0f1520 0%, #1e2d40 100%),
            url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%2399aabb' fill-opacity='0.07'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z'/%3E%3C/g%3E%3C/svg%3E");
        color: white;
    }

    .silver-dark-bg .feature-box {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(192, 207, 224, 0.2);
    }

    .silver-dark-bg .feature-icon {
        background: rgba(192, 207, 224, 0.15);
        color: #c0cfe0;
    }

    .silver-dark-bg h4 {
        color: #c0cfe0 !important;
    }

    .silver-dark-bg p {
        color: rgba(255, 255, 255, 0.75) !important;
    }

    .silver-accent {
        color: #7a9ab0;
    }

    .silver-border-card {
        border-left: 4px solid #a0b8c8;
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .silver-cta-section {
        background: linear-gradient(135deg, rgba(74, 0, 16, 0.95) 0%, rgba(120, 20, 30, 0.92) 100%);
        padding: 80px 0;
        text-align: center;
    }
</style>

<!-- SILVER HERO -->
<section class="silver-hero">
    <div class="silver-hero-content container">
        <div class="hero-badge"
            style="background:rgba(192,207,224,0.15); border-color:rgba(192,207,224,0.4); color:#c0cfe0;"><i
                class="fas fa-coins"></i> SILVER BUYING SERVICE</div>
        <h1>Cash for Silver</h1>
        <p>Turn your old silver coins, utensils, ornaments, and bars into instant cash. Best market rates, transparent
            weighing, immediate payment.</p>
        <a href="contact/?service=silver" class="btn btn-red"
            style="padding:14px 40px; font-size:1rem; margin-right:15px;">Get Free Valuation</a>
        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', s($S, 'phone', '+919576889595')); ?>" class="btn"
            style="background:rgba(255,255,255,0.1); color:#fff; border:2px solid rgba(255,255,255,0.4); padding:14px 40px; font-size:1rem; border-radius:50px;">Call
            Now</a>
    </div>
</section>

<!-- SILVER STATS BAR -->
<div class="silver-stat-bar">
    <div class="container">
        <div style="display:grid; grid-template-columns: repeat(4,1fr); gap:20px;">
            <div class="stat-item"><span class="stat-number">999</span><span class="stat-label">Purity Accepted</span>
            </div>
            <div class="stat-item"><span class="stat-number">₹ Live</span><span class="stat-label">Rate Offered</span>
            </div>
            <div class="stat-item"><span class="stat-number">30 Min</span><span class="stat-label">Complete
                    Process</span></div>
            <div class="stat-item"><span class="stat-number">Any Wt.</span><span class="stat-label">All Weights
                    Bought</span></div>
        </div>
    </div>
</div>

<!-- WHAT WE BUY -->
<section class="section-padding silver-section-bg">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="assets/images/service-silver-final.png" alt="Silver Buying at Gold Pe Cash"
                    style="width:100%; border-radius:16px; box-shadow: 0 20px 60px rgba(100,140,180,0.2);">
            </div>
            <div>
                <p class="section-label">WHAT WE BUY</p>
                <h2 class="section-heading">All Types of Silver Accepted</h2>
                <p style="color:var(--text-muted); line-height:1.8; margin-bottom:25px;">
                    We accept all forms of silver — from antique silverware in your kitchen to fresh coins from a safe
                    deposit. Silver is weighed on calibrated digital scales with results displayed openly. You get the
                    <strong>live MCX silver market rate</strong> — no below-market offers.
                </p>
                <div class="silver-border-card">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-utensils silver-accent"></i> Silverware & Utensils</h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">Thalis, glasses, bowls, spoons,
                        serving items — all accepted by weight</p>
                </div>
                <div class="silver-border-card">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-coins silver-accent"></i> Silver Coins</h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">Lakshmi coins, commemorative coins,
                        bank coins — any mint or year</p>
                </div>
                <div class="silver-border-card">
                    <h4 style="color:var(--maroon); font-weight:700; margin-bottom:5px;"><i
                            class="fas fa-gem silver-accent"></i> Silver Jewelry</h4>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin:0;">Antique, modern, damaged or intact
                        silver ornaments — all weights</p>
                </div>
                <a href="contact/?service=silver" class="btn btn-red" style="margin-top:20px;">Get a Free Silver
                    Quote</a>
            </div>
        </div>
    </div>
</section>

<!-- HOW WE VALUE SILVER -->
<section class="section-padding silver-dark-bg">
    <div class="container">
        <p class="section-label text-center" style="color:#c0cfe0;">OUR PROCESS</p>
        <h2 class="section-heading text-center" style="color:#c0cfe0;">How We Buy Your Silver</h2>
        <div class="features-grid" style="margin-top:40px;">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-store"></i></div>
                <h4>Bring Your Silver</h4>
                <p>Walk into any of our Ranchi branches with your silver items and a valid ID proof.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-weight-hanging"></i></div>
                <h4>Precision Weighing</h4>
                <p>Every item is weighed on calibrated scales accurate to 0.01g. You verify the weight.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h4>Live Market Rate</h4>
                <p>We offer you the day's live MCX silver rate, multiplied by your weight — no tricks.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h4>Instant Payment</h4>
                <p>Cash, NEFT, RTGS, or IMPS — payment done on the spot within minutes.</p>
            </div>
        </div>
    </div>
</section>

<!-- WHY SELL SILVER TO US -->
<section class="section-padding silver-section-bg">
    <div class="container">
        <p class="section-label text-center">WHY CHOOSE US</p>
        <h2 class="section-heading text-center">Why Sell Silver to Gold Pe Cash?</h2>
        <div class="features-grid" style="margin-top:40px;">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h4>Live MCX Rate</h4>
                <p>We offer the MCX live silver rate — no deductions, no below-market offers. Ever.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-weight-hanging"></i></div>
                <h4>Any Weight Accepted</h4>
                <p>From a few grams of jewelry to kilograms of silverware — all weights are welcome.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-eye"></i></div>
                <h4>Weighing Done Openly</h4>
                <p>Every gram is weighed in front of you on certified digital scales. Full transparency.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h4>Same-Day Payment</h4>
                <p>Cash or bank transfer — payment guaranteed on the same day, no delays.</p>
            </div>
        </div>
        <div style="text-align:center; margin-top:40px;">
            <a href="contact/?service=silver" class="btn btn-red" style="padding:14px 40px; font-size:1rem;">Visit Us
                &amp; Get Silver Quote</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="silver-cta-section">
    <div class="container">
        <p class="section-label" style="color:#c0cfe0;">READY TO SELL?</p>
        <h2 style="font-size:2.5rem; color:#fff; font-weight:900; margin-bottom:15px;">Get the Best Price for Your
            Silver Today</h2>
        <p
            style="color:rgba(255,255,255,0.75); max-width:600px; margin:0 auto 35px; font-size:1.05rem; line-height:1.7;">
            No appointment needed. Bring your silver and ID — walk out with cash in 30 minutes.</p>
        <a href="contact/?service=silver" class="btn btn-red"
            style="padding:16px 50px; font-size:1.1rem; margin-right:15px;">Get Free Valuation</a>
        <a href="gold-pe-cash-services/"
            style="color:rgba(255,255,255,0.7); font-size:0.95rem; text-decoration:underline; line-height:3;">View All
            Services</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>