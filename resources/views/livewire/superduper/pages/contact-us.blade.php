@section('hero')
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'contact-us-banner');
            })
            ->active()
            ->orderBy('sort')
            ->with(['media'])
            ->first();
@endphp
<!-- Title Bar -->
<div class="pbmit-title-bar-wrapper" style="background-image: url({{ $banners->getImageUrl('large') }}) !important;">
    <div class="container">
        <div class="pbmit-title-bar-content">
            <div class="pbmit-title-bar-content-inner">
                <x-superduper.components.breadcrumb title="Contact Us"/>
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<div x-data x-init="
        $nextTick(() => {
            window.addEventListener('successMessageShown', () => {
                setTimeout(() => {
                    $wire.set('success', false);
                }, 5000);
            });
        })
    ">

    <!-- Page Content -->
    <div class="page-content">
        <section class="pbmit-sticky-section">
            <div class="container">
                <div class="contact-us-bg">
                    <div class="row">
                        <div class="col-md-12 col-xl-5">
                            <div class="pbmit-sticky-col">
                                <div class="contact-us-left-area">
                                    <div class="pbmit-heading-subheading animation-style2">
                                        <h4 class="pbmit-subtitle">Contact Us</h4>
                                        <h2 class="pbmit-title">Happy to answer all your questions</h2>
                                        <div class="pbmit-heading-desc">
                                            Have questions about our services or need assistance? We're here to help!
                                            Reach out by filling out the form.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-7">
                            <div class="contact-form-area">

                                {{-- SUCCESS MESSAGE STATE --}}
                                @if($success)
                                    <div class="p-4 text-center border rounded-lg border-success bg-light">
                                        <h2 class="pbmit-title">Message Sent!</h2>
                                        <p class="mb-4">
                                            Thank you for reaching out to us. We've received your message and will get back to you soon.
                                        </p>
                                        <button wire:click="resetForm" class="pbmit-btn">
                                            Send Another Message
                                        </button>
                                    </div>
                                @else
                                {{-- FORM STATE --}}
                                    <div class="pbmit-heading animation-style2">
                                        <h2 class="pbmit-title">Send a Message</h2>
                                    </div>

                                    <form wire:submit.prevent="submit" class="contact-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="message">Message</label>
                                                <textarea wire:model.blur="message" id="message" cols="40" rows="5" class="form-control" placeholder="Write your message here..." required></textarea>
                                                @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="name">Your Name *</label>
                                                {{-- NOTE: Combining firstname and lastname into a single 'name' field --}}
                                                <input type="text" wire:model.blur="firstname" id="name" class="form-control" placeholder="e.g. John Doe" required>
                                                @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Your Email *</label>
                                                <input type="email" wire:model.blur="email" id="email" class="form-control" placeholder="e.g. your@email.com" required>
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone">Your Phone (Optional)</label>
                                                <input type="tel" wire:model.blur="phone" id="phone" class="form-control" placeholder="e.g. +1 234 567 890">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="subject">Subject</label>
                                                <input type="text" wire:model.blur="subject" id="subject" class="form-control" placeholder="What is your message about?" required>
                                                @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <button class="pbmit-btn pbmit-btn-outline"
                                                        type="submit"
                                                        wire:loading.attr="disabled"
                                                        wire:target="submit">

                                                    {{-- Normal State Text --}}
                                                    <span wire:loading.remove wire:target="submit" class="pbmit-button-content-wrapper">
                                                        <span class="pbmit-button-text">Submit Now</span>
                                                    </span>
                                                </button>
                                            </div>

                                            {{-- Honeypot field for security --}}
                                            <div aria-hidden="true" style="position:absolute; left:-9999px;">
                                                <input type="text" wire:model="company_website" name="company_website" tabindex="-1" autocomplete="off">
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- NOTE: This client slider is static. You will need to populate it with your own data dynamically. --}}

        {{-- NOTE: Remember to update the src attribute with your actual Google Maps URL. --}}
        <section class="section-xl">
            <div class="container-fluid">
                <div class="iframe-area">
                    <iframe src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" title="London Eye, London, United Kingdom" aria-label="London Eye, London, United Kingdom"></iframe>
                </div>
            </div>
        </section>
    </div>

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%20Tim%20Home%20Care%20Interior%2C%20saya%20ingin%20berkonsultasi%20dengan%20tim%20designnya%20mengenai%20desain%20interior%2C%20bisa%20dibantu%20%3F" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16.75 13.96c.25.13.43.2.5.33.07.13.07.66 0 1.14-.07.48-.83 1.14-1.5 1.25-.67.11-1.33 0-2.1-.25-.77-.25-1.93-.92-3.3-2.2-.47-.44-.9-1-1.29-1.6-.39-.6-.6-1.28-.6-1.8 0-.52.23-.9.48-1.15.25-.25.5-.33.7-.33.19 0 .38.03.52.07.14.04.25.07.38.48s.33.81.36.88c.03.07.03.16 0 .25-.03.09-.07.14-.14.23-.07.09-.14.16-.2.23-.07.07-.12.12-.16.18-.04.06-.07.1-.04.16.14.3.52.83 1.1 1.36.77.7 1.48 1.11 1.8 1.23.07.03.13.01.16-.01.03-.02.31-.25.43-.5.12-.25.21-.47.28-.6.07-.13.14-.14.23-.1.09.04.63.3 1.1.58zM12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
        </svg>
    </a>
</div>
