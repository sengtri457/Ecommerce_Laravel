<div class="cta-newsletter-section py-5 my-5" style="background-color: #F4F4F0; border-top: 1px solid #E6E6E2; border-bottom: 1px solid #E6E6E2;">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <span class="text-primary text-uppercase font-weight-600 mb-2 d-inline-block" style="letter-spacing: 0.15em; font-size: 1.15rem;">Private Capsule</span>
                <h3 class="cta-title mb-2" style="font-size: 2.4rem; color: #1A1A1A; font-family: 'Playfair Display', serif;">Join The Private Capsule</h3>
                <p class="cta-desc text-muted mb-0" style="font-size: 1.35rem; line-height: 1.6;">Receive mindful styling lookbooks, private previews of seasonal drops, and transparent garment care guides.</p>
            </div>
            
            <div class="col-lg-6">
                <form action="{{ route('newsletter.store') }}" method="POST">
                    @csrf
                    <div class="input-group" style="background: #ffffff; border: 1px solid #E6E6E2; border-radius: 4px; padding: 4px; overflow: hidden;">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address" aria-label="Email Address" required style="border: none; background: transparent; padding-left: 15px; font-size: 1.3rem;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" style="padding: 12px 28px; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; font-size: 1.2rem; border-radius: 4px;">
                                <span>Join</span>
                                <i class="icon-long-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
