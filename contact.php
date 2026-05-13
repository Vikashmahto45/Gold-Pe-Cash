<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}

$pageTitle = "Contact Us | Gold Pe Cash";
$metaDescription = "Contact Gold Pe Cash in Ranchi for instant cash on gold, silver and diamonds. Visit our branches or call us now.";
$seoKey = 'contact';

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';

$S = getAllSettings();
?>

<style>
    /* ── Contact Hero ── */
    .contact-hero {
        background: linear-gradient(135deg, #1a0505 0%, #2d0a12 50%, #3d1020 100%);
        padding: 90px 0 70px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c8a84b' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    .contact-hero .hero-badge {
        display: inline-block;
        background: rgba(200, 168, 75, 0.15);
        border: 1px solid rgba(200, 168, 75, 0.4);
        color: #c8a84b;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        padding: 6px 18px;
        border-radius: 30px;
        margin-bottom: 18px;
    }

    .contact-hero h1 {
        color: #fff;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 900;
        margin-bottom: 14px;
    }

    .contact-hero h1 span {
        color: #c8a84b;
    }

    .contact-hero p {
        color: rgba(255, 255, 255, 0.65);
        font-size: 1.05rem;
        max-width: 520px;
        margin: 0 auto 35px;
    }

    /* Quick contact pills */
    .quick-contacts {
        display: flex;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
    }

    .quick-contact-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(200, 168, 75, 0.3);
        color: #fff;
        padding: 12px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        backdrop-filter: blur(8px);
    }

    .quick-contact-pill:hover {
        background: rgba(200, 168, 75, 0.15);
        border-color: #c8a84b;
        transform: translateY(-2px);
        color: #fff;
    }

    .quick-contact-pill i {
        color: #c8a84b;
        font-size: 0.95rem;
    }

    /* ── Main Contact Section ── */
    .contact-main {
        background: linear-gradient(180deg, #120308 0%, #1a0505 100%);
        padding: 80px 0;
    }

    .contact-main-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        align-items: start;
    }

    /* Info Box */
    .contact-info-panel {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(200, 168, 75, 0.2);
        border-radius: 20px;
        padding: 35px;
        backdrop-filter: blur(10px);
    }

    .contact-info-panel h3 {
        color: #c8a84b;
        font-size: 1.2rem;
        font-weight: 800;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(200, 168, 75, 0.2);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
    }

    .info-item-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(200, 168, 75, 0.2), rgba(200, 168, 75, 0.05));
        border: 1px solid rgba(200, 168, 75, 0.3);
        color: #c8a84b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-item a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: color 0.3s;
    }

    .info-item a:hover {
        color: #c8a84b;
    }

    .branches-title {
        color: #c8a84b;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin: 25px 0 14px;
        padding-top: 20px;
        border-top: 1px solid rgba(200, 168, 75, 0.15);
    }

    .branch-entry {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .branch-entry i {
        color: #c8a84b;
        font-size: 0.75rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    /* Form */
    .contact-form-panel {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 40px;
        backdrop-filter: blur(10px);
    }

    .contact-form-panel h3 {
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .contact-form-panel p {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.88rem;
        margin-bottom: 28px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 14px;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .contact-form-panel input,
    .contact-form-panel select,
    .contact-form-panel textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.06);
        color: #fff;
        font-family: var(--font-body);
        font-size: 0.93rem;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .contact-form-panel input::placeholder,
    .contact-form-panel textarea::placeholder {
        color: rgba(255, 255, 255, 0.38);
    }

    .contact-form-panel select {
        color: rgba(255, 255, 255, 0.75);
    }

    .contact-form-panel select option {
        background: #2d0a12;
        color: #fff;
    }

    .contact-form-panel input:focus,
    .contact-form-panel select:focus,
    .contact-form-panel textarea:focus {
        border-color: #c8a84b;
        background: rgba(200, 168, 75, 0.07);
        box-shadow: 0 0 0 3px rgba(200, 168, 75, 0.12);
        outline: none;
    }

    .contact-form-panel textarea {
        min-height: 130px;
        resize: vertical;
    }

    /* ── Feature Cards ── */
    .why-visit {
        background: #0d0d0d;
        padding: 80px 0;
    }

    .experience-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 50px;
    }

    .experience-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(200, 168, 75, 0.15);
        border-radius: 16px;
        padding: 28px 20px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .experience-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(200, 168, 75, 0.1);
        border-color: rgba(200, 168, 75, 0.35);
    }

    .exp-icon {
        width: 58px;
        height: 58px;
        background: linear-gradient(135deg, rgba(200, 168, 75, 0.2), rgba(200, 168, 75, 0.04));
        border: 1px solid rgba(200, 168, 75, 0.3);
        border-radius: 50%;
        color: #c8a84b;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .experience-card h4 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .experience-card p {
        color: rgba(255, 255, 255, 0.55);
        font-size: 0.86rem;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 992px) {
        .contact-main-grid {
            grid-template-columns: 1fr;
        }

        .experience-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .experience-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero -->
<section class="contact-hero">
    <div class="container" style="position:relative;z-index:2;">
        <div class="hero-badge">📞 GET IN TOUCH</div>
        <h1>Contact <span>Gold Pe Cash</span></h1>
        <p>We're here to help you get the best value for your gold, silver, and diamonds. Reach out anytime.</p>
        <div class="quick-contacts">
            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', s($S, 'phone', '+91-9576889595')); ?>"
                class="quick-contact-pill">
                <i class="fas fa-phone-alt"></i> <?php echo htmlspecialchars(s($S, 'phone', '+91-9576889595')); ?>
            </a>
            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', s($S, 'whatsapp', '919576889595')); ?>"
                class="quick-contact-pill">
                <i class="fab fa-whatsapp"></i> WhatsApp Us
            </a>
            <a href="mailto:<?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>"
                class="quick-contact-pill">
                <i class="fas fa-envelope"></i> <?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>
            </a>
        </div>
    </div>
</section>

<!-- Contact Form + Info -->
<section class="contact-main">
    <div class="container">
        <div class="contact-main-grid">

            <!-- Info Panel -->
            <div class="contact-info-panel">
                <h3><i class="fas fa-map-marker-alt" style="margin-right:8px;"></i>Our Details</h3>
                <div class="info-item">
                    <div class="info-item-icon"><i class="fas fa-phone-alt"></i></div>
                    <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', s($S, 'phone', '+91-9576889595')); ?>">
                        <?php echo htmlspecialchars(s($S, 'phone', '+91-9576889595')); ?>
                    </a>
                </div>
                <div class="info-item">
                    <div class="info-item-icon"><i class="fab fa-whatsapp"></i></div>
                    <a
                        href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', s($S, 'whatsapp', '919576889595')); ?>">
                        WhatsApp Us Now
                    </a>
                </div>
                <div class="info-item">
                    <div class="info-item-icon"><i class="fas fa-envelope"></i></div>
                    <a href="mailto:<?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>">
                        <?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>
                    </a>
                </div>
                <p class="branches-title"><i class="fas fa-store" style="margin-right:6px;"></i>Our Branches</p>
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <?php $addr = s($S, "address$i", '');
                    if ($addr): ?>
                        <div class="branch-entry">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($addr); ?></span>
                        </div>
                    <?php endif; endfor; ?>
            </div>

            <!-- Form Panel -->
            <div class="contact-form-panel">
                <h3><i class="fas fa-paper-plane" style="color:#c8a84b; margin-right:10px;"></i>Send Us a Message</h3>
                <p>Fill the form below and we'll get back to you within a few hours.</p>
                <form action="submit_contact.php" method="POST">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <select name="service" required>
                            <option value="">Select a Service</option>
                            <option value="cash_on_gold" <?php echo (isset($_GET['service']) && $_GET['service'] == 'cash_on_gold') ? ' selected' : ''; ?>>Cash on Gold</option>
                            <option value="cash_on_silver" <?php echo (isset($_GET['service']) && $_GET['service'] == 'cash_on_silver') ? ' selected' : ''; ?>>Cash on Silver</option>
                            <option value="cash_on_diamond" <?php echo (isset($_GET['service']) && $_GET['service'] == 'cash_on_diamond') ? ' selected' : ''; ?>>Cash on Diamond</option>
                            <option value="gold_bailout" <?php echo (isset($_GET['service']) && $_GET['service'] == 'gold_bailout') ? ' selected' : ''; ?>>Gold Bailout / Release</option>
                            <option value="doorstep" <?php echo (isset($_GET['service']) && $_GET['service'] == 'doorstep') ? ' selected' : ''; ?>>Doorstep Service</option>
                            <option value="other">Other Enquiry</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message or Query"></textarea>
                    </div>
                    <button type="submit" class="btn btn-red"
                        style="width:100%; padding:16px; font-size:1rem; letter-spacing:1px; border-radius:10px;">
                        <i class="fas fa-paper-plane" style="margin-right:8px;"></i>SEND MESSAGE
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- Google Map Section -->
<section class="contact-map" style="padding-bottom: 0;">
    <div class="container-fluid" style="padding: 0;">
        <div class="map-wrapper" style="width: 100%; height: 450px; border-top: 2px solid rgba(200, 168, 75, 0.3); border-bottom: 2px solid rgba(200, 168, 75, 0.3);">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14652.8123275952!2d85.3116541!3d23.3628469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f4e10b1a00a121%3A0x633783a54d1d936d!2sGold%20Pe%20Cash!5e0!3m2!1sen!2sin!4v1710922441234!5m2!1sen!2sin" 
                width="100%" 
                height="100%" 
                style="border:0; filter: grayscale(1) invert(1) contrast(1.2);" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<!-- Why Visit Us -->
<section class="why-visit">
    <div class="container">
        <p class="section-label text-center" style="color:#c8a84b;">WHY VISIT US?</p>
        <h2 class="section-heading text-center" style="color:#fff;">The Gold Pe Cash Experience</h2>
        <div class="experience-grid">
            <div class="experience-card">
                <div class="exp-icon"><i class="fas fa-bolt"></i></div>
                <h4>Fast Process</h4>
                <p>From valuation to payment in less than 30 minutes. Time is money — we respect yours.</p>
            </div>
            <div class="experience-card">
                <div class="exp-icon"><i class="fas fa-eye"></i></div>
                <h4>Transparent</h4>
                <p>Every test done in front of you. No hidden charges. No surprises. What you see is what you get.</p>
            </div>
            <div class="experience-card">
                <div class="exp-icon"><i class="fas fa-rupee-sign"></i></div>
                <h4>Best Rates</h4>
                <p>We always offer the highest market price. We won't let you leave disappointed.</p>
            </div>
            <div class="experience-card">
                <div class="exp-icon"><i class="fas fa-headset"></i></div>
                <h4>Friendly Staff</h4>
                <p>Our team guides you through every step with care and respect. Always a warm welcome.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>