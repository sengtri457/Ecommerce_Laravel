<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Page;
use App\Models\StoreLocation;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pages
        $pages = [
            [
                'slug' => 'about',
                'title' => 'About Molla',
                'subtitle' => 'Who we are & our guiding vision',
                'banner_image' => 'assets/images/about-header-bg.jpg',
                'content' => '<p class="lead text-primary mb-3">We believe high craftsmanship and cutting-edge tech should be accessible to all.</p><p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Phasellus blandit leo ut odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>',
                'meta_title' => 'About Us - Molla eCommerce',
                'meta_description' => 'Learn more about Molla, our story, team, and passion for excellence.',
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact Us',
                'subtitle' => 'We are here to assist with any inquiry',
                'banner_image' => 'assets/images/contact-header-bg.jpg',
                'content' => '<p>Got a question about an order, partnership, or custom hardware spec? Reach out via our direct phone, email, or send us a message below.</p>',
                'meta_title' => 'Contact Us - Molla eCommerce',
                'meta_description' => 'Get in touch with customer support or visit our flagship retail branches.',
            ],
            [
                'slug' => 'faq',
                'title' => 'F.A.Q',
                'subtitle' => 'Frequently Asked Questions',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<p>Find quick answers to common questions regarding ordering, shipping rates, returns, and warranties.</p>',
                'meta_title' => 'FAQs - Molla eCommerce',
                'meta_description' => 'Frequently asked questions about ordering, payments, and account safety.',
            ],
            [
                'slug' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'subtitle' => 'Your security and confidential data handling',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<h3>1. Information We Collect</h3><p>We respect your privacy and only collect account and billing details required to process transactions and fulfill deliveries accurately.</p><h3>2. Data Protection</h3><p>All sensitive payment details are securely tokenized with end-to-end encryption under industry compliance standards.</p>',
                'meta_title' => 'Privacy Policy - Molla eCommerce',
                'meta_description' => 'Our commitment to data protection and transparent user privacy.',
            ],
            [
                'slug' => 'terms-conditions',
                'title' => 'Terms & Conditions',
                'subtitle' => 'Store policies and customer terms of service',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<h3>General Terms</h3><p>By placing an order on Molla eCommerce, you agree to comply with all store policies, warranty guidelines, and terms governing consumer transactions.</p>',
                'meta_title' => 'Terms & Conditions - Molla eCommerce',
                'meta_description' => 'Legal terms of service and purchase regulations.',
            ],
            [
                'slug' => 'shipping',
                'title' => 'Shipping & Delivery',
                'subtitle' => 'Fast, insured doorstep deliveries',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<p>Orders placed before 2:00 PM EST ship the same business day. We offer Free Express Shipping on eligible orders above $50.00 across the continental United States and expedited international air shipping.</p>',
                'meta_title' => 'Shipping Information - Molla eCommerce',
                'meta_description' => 'Delivery lead times, carriers, tracking, and international rates.',
            ],
            [
                'slug' => 'returns',
                'title' => 'Returns & Refunds',
                'subtitle' => 'Hassle-free 30-day return policy',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<p>If you are not 100% satisfied with your purchase, you can return items in their original packaging within 30 days of arrival for a full refund or direct exchange.</p>',
                'meta_title' => 'Returns Policy - Molla eCommerce',
                'meta_description' => 'Simple returns and exchange instructions.',
            ],
            [
                'slug' => 'payment-methods',
                'title' => 'Payment Methods',
                'subtitle' => 'Multiple flexible payment options',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<p>We accept major credit cards (Visa, MasterCard, American Express), PayPal, Apple Pay, Cash on Delivery (COD), and direct bank transfers.</p>',
                'meta_title' => 'Accepted Payment Methods - Molla eCommerce',
                'meta_description' => 'Secure checkout and diverse payment methods.',
            ],
            [
                'slug' => 'how-to-shop',
                'title' => 'How to Shop on Molla',
                'subtitle' => 'Step by step purchasing walkthrough',
                'banner_image' => 'assets/images/page-header-bg.jpg',
                'content' => '<p>Browse categories or use our smart search bar. Add your preferred color and size to your shopping bag, review coupons on the Cart page, and complete checkout with secure guest or customer authentication.</p>',
                'meta_title' => 'Shopping Guide - Molla eCommerce',
                'meta_description' => 'Easy guidance for placing your first order on Molla.',
            ],
        ];

        foreach ($pages as $p) {
            Page::create(array_merge($p, ['is_active' => true]));
        }

        // 2. Team Members
        TeamMember::create([
            'name' => 'Samanta Grey',
            'role' => 'Founder & CEO',
            'photo' => 'assets/images/team/member-1.jpg',
            'bio' => 'Passionate tech advocate with over 15 years leading consumer hardware and retail experiences.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Bruce Sutton',
            'role' => 'Head of Product Design',
            'photo' => 'assets/images/team/member-2.jpg',
            'bio' => 'Award-winning industrial designer focusing on minimalist aesthetics and intuitive ergonomics.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Janet Joy',
            'role' => 'VP of Customer Success',
            'photo' => 'assets/images/team/member-3.jpg',
            'bio' => 'Dedicated to ensuring seamless shopping journeys, instant support, and exceptional buyer satisfaction.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // 3. Testimonials
        Testimonial::create([
            'author_name' => 'Jenson Button',
            'author_role' => 'Tech Reviewer',
            'photo' => 'assets/images/testimonials/user-1.jpg',
            'quote' => 'Molla has become my go-to store for workstation upgrades. Superb prices, authentic gear, and rapid deliveries every single time.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Testimonial::create([
            'author_name' => 'Victoria Ventura',
            'author_role' => 'Interior Architect',
            'photo' => 'assets/images/testimonials/user-2.jpg',
            'quote' => 'The curated furniture and smart lighting options are gorgeous. Their support team went above and beyond to verify specifications.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // 4. FAQ Categories & FAQs
        $cat1 = FaqCategory::create(['name' => 'Shipping & Delivery', 'sort_order' => 1]);
        $cat2 = FaqCategory::create(['name' => 'Orders & Payment', 'sort_order' => 2]);
        $cat3 = FaqCategory::create(['name' => 'Returns & Refunds', 'sort_order' => 3]);

        // FAQs for Cat 1
        Faq::create([
            'faq_category_id' => $cat1->id,
            'question' => 'How long does shipping usually take?',
            'answer' => 'Standard delivery takes between 2 to 4 business days within the continental US. Express shipping arrives within 1 to 2 business days.',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat1->id,
            'question' => 'Do you ship to international addresses?',
            'answer' => 'Yes, we ship to over 80 countries worldwide. International delivery times vary from 5 to 10 business days.',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat1->id,
            'question' => 'How can I track my package?',
            'answer' => 'As soon as your package leaves our fulfillment hub, a tracking URL and reference code are sent to your confirmation email and account dashboard.',
            'sort_order' => 3,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat1->id,
            'question' => 'What if my delivery is damaged upon arrival?',
            'answer' => 'Please notify our customer care team within 48 hours with order photos, and we will issue an immediate replacement at zero extra cost.',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // FAQs for Cat 2
        Faq::create([
            'faq_category_id' => $cat2->id,
            'question' => 'Which payment methods do you accept?',
            'answer' => 'We accept all major credit/debit cards, PayPal, Apple Pay, Cash on Delivery (COD), and direct bank deposits.',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat2->id,
            'question' => 'How do I apply a discount coupon code?',
            'answer' => 'You can enter coupon codes (such as WELCOME10 or SAVE20) on either the Cart page or during Step 2 of the Checkout summary.',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat2->id,
            'question' => 'Can I modify or cancel an order after placing it?',
            'answer' => 'Orders can be amended or canceled while their status remains "Pending". Please visit My Orders in your account dashboard or contact support.',
            'sort_order' => 3,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat2->id,
            'question' => 'Is my personal billing information safe?',
            'answer' => 'Yes, all sensitive data is processed over 256-bit SSL encrypted connections and meets full PCI-DSS Level 1 compliance standards.',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // FAQs for Cat 3
        Faq::create([
            'faq_category_id' => $cat3->id,
            'question' => 'What is your return policy period?',
            'answer' => 'We offer a 30-day money-back guarantee on all undamaged products kept in original packaging.',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat3->id,
            'question' => 'Are returns free of charge?',
            'answer' => 'Domestic returns within the United States include prepaid return shipping labels generated directly from your account page.',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat3->id,
            'question' => 'When will I receive my refund?',
            'answer' => 'Refunds are inspected and processed within 2 business days of warehouse receipt, returning funds to your original payment method in 3 to 5 banking days.',
            'sort_order' => 3,
            'is_active' => true,
        ]);
        Faq::create([
            'faq_category_id' => $cat3->id,
            'question' => 'Do products include manufacturer warranty?',
            'answer' => 'All brand new electronics and home appliances include a minimum 1-year comprehensive manufacturer warranty.',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // 5. Store Locations
        StoreLocation::create([
            'name' => 'New York Flagship Store',
            'address' => '70 Washington Square South',
            'city' => 'New York, NY 10012',
            'phone' => '+1 (212) 555-0143',
            'email' => 'ny.store@molla.com',
            'opening_hours' => "Monday - Saturday: 9:00 AM - 8:00 PM\nSunday: 10:00 AM - 6:00 PM",
            'sort_order' => 1,
            'is_active' => true,
        ]);

        StoreLocation::create([
            'name' => 'San Francisco Innovation Hub',
            'address' => '100 Market Street, Suite 400',
            'city' => 'San Francisco, CA 94105',
            'phone' => '+1 (415) 555-0198',
            'email' => 'sf.store@molla.com',
            'opening_hours' => "Monday - Saturday: 9:30 AM - 7:30 PM\nSunday: Closed",
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }
}
