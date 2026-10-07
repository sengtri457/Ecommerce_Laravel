<div class="cta cta-horizontal cta-horizontal-box bg-primary pt-5 pb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <h3 class="cta-title text-white">Join Our Newsletter</h3>
                <p class="cta-desc text-white">Subscribe to get timely updates on products, discounts and new arrivals.</p>
            </div>
            
            <div class="col-lg-7">
                <form action="{{ route('newsletter.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Address" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-white-2" type="submit">
                                <span>Subscribe</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
