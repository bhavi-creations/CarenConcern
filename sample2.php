<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Why Choose Us</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
 
        .dental-why-choose-section {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .dental-section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .dental-section-title h2 {
            font-size: 48px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .dental-title-underline {
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #1a1a1a 0%, #666666 100%);
            margin: 0 auto;
        }

        .dental-feature-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 25px;
            background: #dadee2;
            border-radius: 10px;
            transition: all 0.4s ease;
            border: 2px solid transparent;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .dental-feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%);
            transition: all 0.5s ease;
            z-index: 0;
        }

        .dental-feature-item:hover::before {
            left: 0;
        }

        .dental-feature-item:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-color: #1a1a1a;
        }

        .dental-feature-icon-wrapper {
            position: relative;
            z-index: 1;
            width: 60px;
            height: 60px;
            min-width: 60px;
            background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            transition: all 0.4s ease;
        }

        .dental-feature-item:hover .dental-feature-icon-wrapper {
            background: #ffffff;
            transform: rotate(360deg);
        }

        .dental-feature-icon-wrapper i {
            font-size: 26px;
            color: #ffffff;
            transition: all 0.4s ease;
        }

        .dental-feature-item:hover .dental-feature-icon-wrapper i {
            color: #1a1a1a;
        }

        .dental-feature-text {
            position: relative;
            z-index: 1;
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.4s ease;
        }

        .dental-feature-item:hover .dental-feature-text {
            color: #ffffff;
        }

        .dental-left-column, .dental-right-column {
            padding: 0 15px;
        }

        @media (max-width: 768px) {
            .dental-section-title h2 {
                font-size: 32px;
            }
            
            .dental-why-choose-section {
                padding: 40px 20px;
            }

            .dental-feature-text {
                font-size: 16px;
            }

            .dental-feature-icon-wrapper {
                width: 50px;
                height: 50px;
                min-width: 50px;
            }

            .dental-feature-icon-wrapper i {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container" style="padding: 40px;">
        <div class="dental-why-choose-section">
            <div class="dental-section-title">
                <h2>Why Choose Us</h2>
                <div class="dental-title-underline"></div>
            </div>

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-6 dental-left-column">
                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="dental-feature-text">Hygienic High Quality</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="dental-feature-text">Laser Dentistry</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-syringe"></i>
                        </div>
                        <div class="dental-feature-text">Needle-Less Injection</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-tooth"></i>
                        </div>
                        <div class="dental-feature-text">Advanced Implants</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-align-justify"></i>
                        </div>
                        <div class="dental-feature-text">Best In Class Clear Aligners</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-grip-horizontal"></i>
                        </div>
                        <div class="dental-feature-text">Latest Generation Braces</div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-6 dental-right-column">
                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-x-ray"></i>
                        </div>
                        <div class="dental-feature-text">Digital OPG & RVG X-Rays</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <div class="dental-feature-text">Digital Scanner</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div class="dental-feature-text">Intra-Oral Camera</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="dental-feature-text">Best Brand Materials</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="dental-feature-text">Honest & Caring Services</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-smile"></i>
                        </div>
                        <div class="dental-feature-text">Remove Fear Of Dental Treatments</div>
                    </div>

                    <div class="dental-feature-item">
                        <div class="dental-feature-icon-wrapper">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="dental-feature-text">EMI & Easy Payment Options</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>