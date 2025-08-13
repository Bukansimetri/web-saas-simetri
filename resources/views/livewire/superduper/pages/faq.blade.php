<div>
    @push('css')
        <style>
            :root {
                --primary: #016725;
                --secondary: #DC311C;
                --accent: #3498db;
                --light: #f0f5f1;
                --dark: #333;
                --success: #27ae60;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .tnc-container {
                max-width: auto;
                padding: 30px;
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                border: 1px solid var(--light);
            }

            .tnc-header {
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 2px solid var(--light);
            }

            .tnc-header h1 {
                color: var(--primary);
                font-size: 2.5rem;
                margin-bottom: 10px;
            }

            .tnc-header p {
                color: #777;
                font-size: 1.1rem;
            }

            .tnc-content {
                margin-bottom: 30px;
            }

            .tnc-item {
                display: flex;
                margin-bottom: 25px;
                padding: 20px;
                background: rgba(1, 103, 37, 0.05);
                border-radius: 10px;
                transition: all 0.3s ease;
                border-left: 4px solid var(--primary);
            }

            .tnc-item:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                background: rgba(1, 103, 37, 0.08);
            }

            .tnc-number {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                background: var(--primary);
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                margin-right: 20px;
                font-size: 1.2rem;
            }

            .tnc-text h3 {
                color: var(--primary);
                margin-bottom: 8px;
                font-size: 1.3rem;
            }

            .tnc-text p {
                color: #555;
            }

            .tnc-contact {
                background: linear-gradient(135deg, rgba(1, 103, 37, 0.9), rgba(1, 103, 37, 0.8));
                color: white;
                padding: 25px;
                border-radius: 10px;
                margin-top: 40px;
                box-shadow: 0 5px 15px rgba(1, 103, 37, 0.2);
            }

            .tnc-contact h2 {
                margin-bottom: 15px;
                font-size: 1.5rem;
                color: white;
            }

            .contact-item {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }

            .contact-icon {
                margin-right: 15px;
                font-size: 1.2rem;
                color: white;
                background: rgba(255, 255, 255, 0.2);
                width: 35px;
                height: 35px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .tnc-footer {
                text-align: center;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 2px solid var(--light);
            }

            .agree-btn {
                display: inline-block;
                background: var(--primary);
                color: white;
                padding: 12px 30px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                font-size: 1.1rem;
                border: 2px solid var(--primary);
            }

            .agree-btn:hover {
                background: white;
                color: var(--primary);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(1, 103, 37, 0.3);
            }

            .highlight {
                color: var(--secondary);
                font-weight: 600;
            }

            .warning-text {
                color: var(--secondary);
                font-weight: 500;
            }

            @media (max-width: 768px) {
                .tnc-container {
                    margin: 20px;
                    padding: 20px;
                }

                .tnc-header h1 {
                    font-size: 2rem;
                }

                .tnc-item {
                    flex-direction: column;
                }

                .tnc-number {
                    margin-bottom: 15px;
                    margin-right: 0;
                }
            }
        </style>
    @endpush
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-superduper.components.breadcrumb title="Terms & Conditions" />

    <!-- =========================== FAQ's =================================== -->
    <section>
        <div class="container">
            <div class="row">

                <div class="tnc-container">

                            <div class="tnc-content">
                                <div class="tnc-item">
                                    <div class="tnc-number">1</div>
                                    <div class="tnc-text">
                                        <h3>Keaslian Produk</h3>
                                        <p>Semua product yang kami jual adalah <span class="highlight">original 100%</span> dengan garansi keaslian.</p>
                                    </div>
                                </div>

                                <div class="tnc-item">
                                    <div class="tnc-number">2</div>
                                    <div class="tnc-text">
                                        <h3>Quality Control</h3>
                                        <p>Semua produk yang dikemas dan dikirim sudah melalui <span class="highlight">quality control</span> ketat. <span class="warning-text">Kelalaian pada jasa pengiriman diluar tanggung jawab kami.</span></p>
                                    </div>
                                </div>

                                <div class="tnc-item">
                                    <div class="tnc-number">3</div>
                                    <div class="tnc-text">
                                        <h3>Kebijakan Komplain</h3>
                                        <p>Untuk complain yang berhubungan dengan persepsi seseorang sehingga menyebutkan bahwa rasa berbeda, <span class="highlight">tidak bisa diterima</span>. Karena rasa berbeda pada lidah disebabkan karena makanan atau minuman yang dikonsumi sebelumnya.</p>
                                    </div>
                                </div>

                                <div class="tnc-item">
                                    <div class="tnc-number">4</div>
                                    <div class="tnc-text">
                                        <h3>Verifikasi Keaslian</h3>
                                        <p>Jika ingin mengecek keaslian produk dapat mengunjungi toko kami atau menghubungi kontak yang tersedia.</p>
                                    </div>
                                </div>

                                <div class="tnc-item">
                                    <div class="tnc-number">5</div>
                                    <div class="tnc-text">
                                        <h3>Persetujuan Pembeli</h3>
                                        <p>Dengan melakukan pembelian, berarti Anda <span class="highlight">menyetujui</span> semua syarat dan ketentuan yang berlaku.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tnc-contact">
                                <h2><i class="fas fa-info-circle"></i> Informasi Kontak</h2>

                                <div class="contact-item">
                                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div>
                                        <p>Jl Masjid Pedurenan Raya no 52c, Karet Kuningan, Jakarta Selatan</p>
                                    </div>
                                </div>

                                <div class="contact-item">
                                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                                    <div>
                                        <p>WhatsApp: 0818-2424-05</p>
                                    </div>
                                </div>
                            </div>

                        </div>

            </div>
        </div>
    </section>
    <!-- =========================== FAQ's =================================== -->
</div>
