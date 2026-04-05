<div x-data x-init="
    $nextTick(() => {
        window.addEventListener('successMessageShown', () => {
            setTimeout(() => {
                $wire.set('success', false);
            }, 5000);
        });
    })
">
    <section id="arck-breadcrumb" class="arck-breadcrumb-section-2 position-relative" data-background="{{ asset('assets/img/bg/ar-shape.png') }}">
        <div class="slider-side-content position-absolute">
            <span class="archx-slider-side1 position-absolute">
                <a href="mailto:{{ $siteSettings->company_email ?? 'livingsmeinterior@gmail.com' }}">
                    {{ $siteSettings->company_email ?? 'livingsmeinterior@gmail.com' }}
                </a>
            </span>
        </div>
        <div class="container">
            <div class="text-center arck-breadcrumb-content position-relative headline-2 ul-li">
                <h1>Kontak Kami</h1>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Kontak Kami</li>
                </ul>
            </div>
        </div>
    </section>
    <section id="arck-contact-page" class="arck-contact-page-section inner-page-padding">
        <div class="container">
            <div class="arck-contact-page-content">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="arck-contact-page-cta position-relative">
                            <div class="contact-cta-inner-img position-relative">
                                <img src="{{ asset('assets/img/about/cn1.jpg') }}" alt="Contact Us">
                            </div>
                            <div class="contact-cta-inner-text position-absolute headline pera-content" data-background="{{ asset('assets/img/about/cn-bg.jpg') }}">
                                <h3>Kontak Detail</h3>
                                <div class="arck-video-cta-wrap">
                                    <div class="video-cta-item d-flex">
                                        <div class="inner-icon">
                                            <img src="{{ asset('assets/icon/ic8.png') }}" alt="Address">
                                        </div>
                                        <div class="inner-text headline pera-content">
                                            <h3>Alamat Workshop</h3>
                                            <p>{{ $siteSettings->company_address ?? 'Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren, Tangerang Selatan' }}</p>
                                        </div>
                                    </div>
                                    <div class="video-cta-item d-flex">
                                        <div class="inner-icon">
                                            <img src="{{ asset('assets/icon/ic9.png') }}" alt="Email">
                                        </div>
                                        <div class="inner-text headline pera-content">
                                            <h3>Email Kami</h3>
                                            <p>{{ $siteSettings->company_email ?? 'livingsmeinterior@gmail.com' }}</p>
                                        </div>
                                    </div>
                                    <div class="video-cta-item d-flex">
                                        <div class="inner-icon">
                                            <img src="{{ asset('assets/icon/ic10.png') }}" alt="Phone">
                                        </div>
                                        <div class="inner-text headline pera-content">
                                            <h3>Telephone:</h3>
                                            <p>{{ $siteSettings->company_phone ?? '0821-3035-4599' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="arck-contact-page-form">
                            <div class="arck-appointment-form-wrap">

                                @if($success)
                                    <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; padding: 30px; border-radius: 8px; text-align: center;">
                                        <i class="fas fa-check-circle" style="font-size: 48px; color: #22c55e; margin-bottom: 15px;"></i>
                                        <h3 style="font-size: 24px; color: #166534; font-weight: bold; margin-bottom: 10px;">Message Sent Successfully!</h3>
                                        <p style="color: #15803d; margin-bottom: 20px;">
                                            Thank you for reaching out to us. We've received your message and will get back to you soon.
                                        </p>
                                        <button wire:click="resetForm" style="background-color: #22c55e; color: white; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                                            Send Another Message
                                        </button>
                                    </div>
                                @else
                                    <div class="arck-section-title headline pera-content">
                                        <h2>Konsultasi Desain Interior Sekarang</h2>
                                        <p>Ceritakan kebutuhan interior Anda, tim kami akan membantu memberikan solusi desain terbaik sesuai konsep, budget, dan fungsi ruang.</p>
                                    </div>

                                    @if(session('error'))
                                        <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                        </div>
                                    @endif

                                    <form wire:submit.prevent="submit">
                                        <div class="row">
                                            <div class="col-md-6" style="margin-bottom: 15px;">
                                                <input type="text" wire:model.blur="firstname" placeholder="First Name" style="margin-bottom: 5px; {{ $errors->has('firstname') ? 'border-color: #ef4444;' : '' }}">
                                                @error('firstname') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 15px;">
                                                <input type="text" wire:model.blur="lastname" placeholder="Last Name" style="margin-bottom: 5px; {{ $errors->has('lastname') ? 'border-color: #ef4444;' : '' }}">
                                                @error('lastname') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6" style="margin-bottom: 15px;">
                                                <input type="tel" wire:model.blur="phone" placeholder="Phone Number" style="margin-bottom: 5px;">
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 15px;">
                                                <input type="email" wire:model.blur="email" placeholder="E-mail" style="margin-bottom: 5px; {{ $errors->has('email') ? 'border-color: #ef4444;' : '' }}">
                                                @error('email') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-6" style="margin-bottom: 15px;">
                                                <input type="text" wire:model.blur="company" placeholder="Company (Optional)" style="margin-bottom: 5px;">
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 15px;">
                                                <select wire:model.blur="employees" style="width: 100%; height: 55px; padding: 0 20px; border: 1px solid #e1e1e1; background-color: transparent; margin-bottom: 5px; color: #666;">
                                                    <option value="">Company Size</option>
                                                    @foreach($employeeOptions as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-12" style="margin-bottom: 15px;">
                                                <input type="text" wire:model.blur="subject" placeholder="Subject" style="margin-bottom: 5px; {{ $errors->has('subject') ? 'border-color: #ef4444;' : '' }}">
                                                @error('subject') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-12" style="margin-bottom: 15px;">
                                                <textarea wire:model.blur="message" placeholder="Message" style="margin-bottom: 5px; {{ $errors->has('message') ? 'border-color: #ef4444;' : '' }}"></textarea>
                                                @error('message') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <button type="submit" wire:loading.attr="disabled" wire:target="submit" style="position: relative;">
                                            <span wire:loading.remove wire:target="submit">Submit Now</span>
                                            <span wire:loading wire:target="submit">
                                                <i class="fas fa-spinner fa-spin"></i> Sending...
                                            </span>
                                        </button>

                                        <div aria-hidden="true" style="position:absolute; left:-9999px;">
                                            <input type="text" wire:model="company_website" name="company_website" tabindex="-1" autocomplete="off">
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="contact_map">
        <iframe class="arck_map" src="https://maps.google.com/maps?q=Gg.%20Sanan,%20Pd.%20Kacang%20Bar.,%20Kec.%20Pd.%20Aren&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="475" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
