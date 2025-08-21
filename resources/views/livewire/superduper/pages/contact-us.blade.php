<div x-data x-init="
    $nextTick(() => {
        window.addEventListener('successMessageShown', () => {
            setTimeout(() => {
                $wire.set('success', false);
            }, 5000);
        });
    })
">
    <x-superduper.components.breadcrumb title="Contact Us" />

    <!-- =========================== Contact Us =================================== -->
    <section class="gray">
        <div class="container">

            <div class="mb-4 row">

                <div class="col-lg-4 col-md-4">
                    <div class="contact-box">
                        <img src="{{asset('assets/img/mail.png')}}" class="mx-auto" alt="minum24" style="color: #016725" width="60" height="60">
                        <h4>Email</h4>
                        {{ $siteSettings->company_email }}<br><br>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="contact-box">
                        <img src="{{asset('assets/img/map.png')}}" class="mx-auto" alt="minum24" style="color: #016725" width="60" height="60">
                        <h4>Address</h4>
                        {{ $siteSettings->company_address }}<br>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="contact-box">
                        <img src="{{asset('assets/img/telephone.png')}}" class="mx-auto" alt="minum24" style="color: #016725" width="60" height="60">
                        <h4>Phone</h4>
                        {{ $siteSettings->company_phone }}<br><br>
                    </div>
                </div>

            </div>

            <div class="mt-5 row align-items-center">

                <div class="col-lg-5 col-md-12 hide-91">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.325208721889!2d106.829504!3d-6.2207776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3fbc30150c1%3A0xacc833a634753939!2sMinum%2024!5e0!3m2!1sen!2sid!4v1755795844647!5m2!1sen!2sid"
                        width="500" height="500"
                        style="border-width:2px !important; border-color:#016725 !important;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="contact-form">
                        <form wire:submit.prevent="submit" class="flex flex-col gap-4">

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label>Name</label>
                                    <input type="text" wire:model="name" class="form-control" placeholder="Name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="email" wire:model="email" class="form-control" placeholder="Email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Subject</label>
                                    <input type="text" wire:model="subject" class="form-control" placeholder="Subject">
                                    @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Phone</label>
                                    <input type="text" wire:model="phone" class="form-control" placeholder="Phone (optional)">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-lg-12 col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary"
                                        wire:target="submit">
                                        Send Request
                                    </button>
                                </div>

                            </div>
                        <form>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- =========================== Contact Us =================================== -->
</div>

