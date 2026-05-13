<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}

$pageTitle = "Gold Bailout Service | Gold Pe Cash";
$metaDescription = "Gold Pe Cash helps you release your pledged gold from banks and NBFCs for instant cash at the best market rate in Ranchi.";
$seoKey = 'bailout';

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';

$S = getAllSettings();
?>

<style>
    .bailout-hero {
        background: linear-gradient(135deg, #1a0505 0%, #2d0a05 40%, #3d1505 100%);
        padding: 90px 0 70px;
        position: relative;
        overflow: hidden;
    }

    .bailout-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c8a84b' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    .bailout-hero .hero-badge {
        display: inline-block;
        background: rgba(200, 168, 75, 0.15);
        border: 1px solid rgba(200, 168, 75, 0.4);
        color: #c8a84b;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2px;
        padding: 6px 18px;
        border-radius: 30px;
        margin-bottom: 20px;
    }

    .bailout-hero h1 {
        color: #fff;
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .bailout-hero h1 span {
        color: #c8a84b;
    }

    .bailout-hero p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
        line-height: 1.8;
        max-width: 580px;
        margin-bottom: 30px;
    }

    .bailout-hero-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 60px;
        align-items: center;
    }

    .bailout-hero-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(200, 168, 75, 0.2);
    }

    .hero-check-list {
        list-style: none;
        padding: 0;
        margin: 0 0 30px;
    }

    .hero-check-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
        margin-bottom: 10px;
    }

    .hero-check-list li i {
        color: #c8a84b;
        font-size: 1rem;
    }

    /* Steps */
    .steps-section {
        background: #111;
        padding: 80px 0;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0;
        margin-top: 50px;
        position: relative;
    }

    .steps-grid::before {
        content: '';
        position: absolute;
        top: 38px;
        left: 12.5%;
        right: 12.5%;
        height: 2px;
        background: linear-gradient(90deg, #c8a84b, rgba(200, 168, 75, 0.2));
        z-index: 0;
    }

    .step-card {
        text-align: center;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }

    .step-number {
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: linear-gradient(135deg, #c8a84b, #a07830);
        color: #1a0505;
        font-size: 1.6rem;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 30px rgba(200, 168, 75, 0.4);
    }

    .step-card h4 {
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .step-card p {
        color: rgba(255, 255, 255, 0.55);
        font-size: 0.85rem;
        line-height: 1.6;
    }

    /* Eligibility */
    .eligibility-section {
        background: linear-gradient(135deg, #1a0505 0%, #2d0a12 100%);
        padding: 80px 0;
    }

    .eligibility-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
        margin-top: 40px;
    }

    .eligibility-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(200, 168, 75, 0.2);
    }

    .eligibility-content .section-label {
        color: #c8a84b;
    }

    .eligibility-content .section-heading {
        color: #fff;
    }

    .eligibility-list {
        list-style: none;
        padding: 0;
        margin: 25px 0 0;
    }

    .eligibility-list li {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        margin-bottom: 14px;
        line-height: 1.5;
    }

    .eligibility-list li i {
        color: #c8a84b;
        font-size: 1rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* Why Choose */
    .why-bailout-section {
        background: #0d0d0d;
        padding: 80px 0;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 50px;
    }

    .why-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(200, 168, 75, 0.2);
        border-radius: 16px;
        padding: 30px 22px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .why-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(200, 168, 75, 0.1);
    }

    .why-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(200, 168, 75, 0.2), rgba(200, 168, 75, 0.05));
        border: 1px solid rgba(200, 168, 75, 0.3);
        color: #c8a84b;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }

    .why-card h4 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .why-card p {
        color: rgba(255, 255, 255, 0.55);
        font-size: 0.88rem;
        line-height: 1.6;
        margin: 0;
    }

    /* CTA */
    .bailout-cta {
        background: linear-gradient(135deg, #c8a84b 0%, #a07830 100%);
        padding: 70px 0;
        text-align: center;
    }

    .bailout-cta h2 {
        color: #1a0505;
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 15px;
    }

    .bailout-cta p {
        color: rgba(26, 5, 5, 0.75);
        font-size: 1.05rem;
        margin-bottom: 30px;
    }

    .bailout-cta .cta-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-dark-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #1a0505;
        color: #c8a84b !important;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-dark-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .btn-outline-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #1a0505 !important;
        border: 2px solid #1a0505;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-outline-cta:hover {
        background: #1a0505;
        color: #c8a84b !important;
    }

    @media (max-width: 992px) {

        .bailout-hero-grid,
        .eligibility-grid {
            grid-template-columns: 1fr;
        }

        .steps-grid,
        .why-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .steps-grid::before {
            display: none;
        }

        .bailout-hero-image {
            order: -1;
        }
    }

    @media (max-width: 576px) {

        .steps-grid,
        .why-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<section class="bailout-hero">
    <div class="container">
        <div class="bailout-hero-grid">
            <div class="bailout-hero-content">
                <div class="hero-badge">🔓 GOLD RELEASE SERVICE</div>
                <h1>Free Your <span>Pledged Gold</span><br>Get Maximum Cash</h1>
                <p>Is your gold stuck in a bank loan? We pay off the bank, release your gold, and pay you the full
                    market value — all on the same day.</p>
                <ul class="hero-check-list">
                    <li><i class="fas fa-check-circle"></i> Gold released from Any Bank or NBFC</li>
                    <li><i class="fas fa-check-circle"></i> We Handle All the Paperwork</li>
                    <li><i class="fas fa-check-circle"></i> You Receive Surplus Cash Immediately</li>
                    <li><i class="fas fa-check-circle"></i> 100% Legal & Transparent</li>
                </ul>
                <div style="display:flex; gap:14px; flex-wrap:wrap;">
                    <a href="contact/?service=gold_bailout" class="btn btn-red"
                        style="padding:14px 30px; border-radius:50px;">
                        <i class="fas fa-paper-plane" style="margin-right:8px;"></i>Get Started Today
                    </a>
                    <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', s($S, 'phone', '+91-9576889595')); ?>"
                        style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.08);color:#fff;padding:14px 28px;border-radius:50px;text-decoration:none;font-weight:600;border:1px solid rgba(255,255,255,0.15);transition:all 0.3s;">
                        <i class="fas fa-phone-alt" style="color:#c8a84b;"></i> Call Now
                    </a>
                </div>
            </div>
            <div class="bailout-hero-image">
                <img src="assets/images/financial-freedom.png" alt="Gold Bailout Service — Gold Pe Cash">
            </div>
        </div>
    </div>
</section>

<!-- How It Works — Step by Step -->
<section class="steps-section">
    <div class="container">
        <p class="section-label text-center" style="color:#c8a84b;">STEP BY STEP</p>
        <h2 class="section-heading text-center" style="color:#fff;">How Gold Bailout Works</h2>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h4>Contact Us</h4>
                <p>Call or WhatsApp with your gold loan details — amount, bank name, and gold weight.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h4>Visit Our Branch</h4>
                <p>Come to our nearest branch with your gold loan documents and ID proof.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h4>We Release & Buy</h4>
                <p>We pay the bank directly to release your gold and immediately buy it from you.</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h4>You Get Cash</h4>
                <p>You receive the surplus (market value minus loan) immediately in hand — same day.</p>
            </div>
        </div>
    </div>
</section>

<!-- Eligibility -->
<section class="eligibility-section">
    <div class="container">
        <div class="eligibility-grid">
            <div class="eligibility-content">
                <p class="section-label">WHO IS THIS FOR?</p>
                <h2 class="section-heading">Are You Eligible?</h2>
                <p style="color:rgba(255,255,255,0.65); line-height:1.8; margin-bottom:5px;">
                    Our Gold Bailout service is for anyone who has gold pledged with a bank or loan company and wants to
                    release it quickly.
                </p>
                <ul class="eligibility-list">
                    <li><i class="fas fa-check-circle"></i> Gold pledged with Muthoot, Manappuram, SBI, HDFC, or any
                        bank</li>
                    <li><i class="fas fa-check-circle"></i> Cannot repay the gold loan on your own</li>
                    <li><i class="fas fa-check-circle"></i> Loan tenure expiring — gold may be auctioned</li>
                    <li><i class="fas fa-check-circle"></i> You want more cash than the loan balance allows</li>
                    <li><i class="fas fa-check-circle"></i> You simply want to close the loan and sell the gold</li>
                </ul>
                <a href="contact/?service=gold_bailout" class="btn btn-red"
                    style="margin-top:25px; border-radius:50px; padding:14px 30px;">
                    <i class="fas fa-arrow-right" style="margin-right:8px;"></i>Apply Now
                </a>
            </div>
            <div class="eligibility-image">
                <img src="assets/images/comic-story.png" alt="Gold Bailout Eligibility">
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-bailout-section">
    <div class="container">
        <p class="section-label text-center" style="color:#c8a84b;">OUR ADVANTAGE</p>
        <h2 class="section-heading text-center" style="color:#fff;">Why Choose Gold Pe Cash?</h2>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-bolt"></i></div>
                <h4>Same Day Release</h4>
                <p>We process the gold release and pay you on the same day. No delays whatsoever.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-rupee-sign"></i></div>
                <h4>Maximum Payout</h4>
                <p>You get live market rate for your gold — far more than any loan repayment scheme.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-file-contract"></i></div>
                <h4>We Handle Docs</h4>
                <p>No paperwork stress. Our team manages the entire bank release process for you.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-shield-alt"></i></div>
                <h4>100% Safe & Legal</h4>
                <p>Fully transparent, legally compliant with RBI guidelines. Your gold is safe with us.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bailout-cta">
    <div class="container">
        <h2>Ready to Free Your Gold?</h2>
        <p>Get in touch today — it's free to enquire, and we'll guide you through every step.</p>
        <div class="cta-buttons">
            <a href="contact/?service=gold_bailout" class="btn-dark-cta">
                <i class="fas fa-paper-plane"></i> Submit Bailout Request
            </a>
            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', s($S, 'phone', '+91-9576889595')); ?>"
                class="btn-outline-cta">
                <i class="fas fa-phone-alt"></i> Call Us Now
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>