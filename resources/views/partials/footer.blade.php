<footer class="footer">
    <div class="footer-middle border-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="widget widget-about">
                        <img src="{{ asset($settings['site_logo_footer'] ?? 'assets/images/demos/demo-13/logo-footer.png') }}" class="footer-logo" alt="{{ $settings['site_name'] ?? 'Molla' }}" width="105" height="25">
                        <p>{{ $settings['footer_text'] ?? '' }}</p>
                        
                        <div class="widget-about-info">
                            <div class="row">
                                <div class="col-sm-6 col-md-5">
                                    <span class="widget-about-title">Got Question? Call us 24/7</span>
                                    <a href="tel:{{ $settings['phone'] ?? '' }}">{{ $settings['phone'] ?? '+0123 456 789' }}</a>
                                </div>
                                <div class="col-sm-6 col-md-7">
                                    <span class="widget-about-title">Payment Method</span>
                                    <figure class="footer-payments">
                                        <img src="{{ asset($settings['payment_icons'] ?? 'assets/images/payments.png') }}" alt="Payment methods" width="272" height="20">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">{{ $footerInfoMenu->name ?? 'Information' }}</h4>
                        <ul class="widget-list">
                            @if(isset($footerInfoMenu) && $footerInfoMenu->items)
                                @foreach($footerInfoMenu->items as $item)
                                    <li><a href="{{ url($item->url) }}">{{ $item->label }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">{{ $footerHelpMenu->name ?? 'Customer Service' }}</h4>
                        <ul class="widget-list">
                            @if(isset($footerHelpMenu) && $footerHelpMenu->items)
                                @foreach($footerHelpMenu->items as $item)
                                    <li><a href="{{ url($item->url) }}">{{ $item->label }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">{{ $footerAccountMenu->name ?? 'My Account' }}</h4>
                        <ul class="widget-list">
                            @if(isset($footerAccountMenu) && $footerAccountMenu->items)
                                @foreach($footerAccountMenu->items as $item)
                                    <li><a href="{{ url($item->url) }}">{{ $item->label }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">{{ $settings['copyright_text'] ?? 'Copyright © 2026 Molla Store. All Rights Reserved.' }}</p>
            <ul class="footer-menu">
                <li><a href="{{ route('pages.show', 'terms-conditions') }}">Terms Of Use</a></li>
                <li><a href="{{ route('pages.show', 'privacy-policy') }}">Privacy Policy</a></li>
            </ul>

            <div class="social-icons social-icons-color">
                <span class="social-label">Social Media</span>
                @if(isset($footerSocialMenu) && $footerSocialMenu->items)
                    @foreach($footerSocialMenu->items as $social)
                        <a href="{{ $social->url }}" class="social-icon" title="{{ $social->label }}" target="_blank">
                            <i class="{{ $social->icon ?: 'icon-share' }}"></i>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</footer>
