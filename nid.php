<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NID Verification System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        /* 1. CORRECTED BODY STYLES */
      body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: #fff;
        margin: 0;
        overflow-x: hidden;
        background-color: #000; /* Fallback color for contrast */
    }

    /* ---------------------------------------------------- */
    /* NEW: Combined Drift and Zoom Animation using background-position and background-size */
    /* ---------------------------------------------------- */
    
    @keyframes drift-zoom {
        0% {
            background-size: 100% 100%; /* Starting Zoom */
            background-position: 0% 50%; /* Starting Drift Position (Left side) */
        }
        100% {
            background-size: 135% 135%; /* Ending Zoom (more aggressive) */
            background-position: 100% 50%; /* Ending Drift Position (Right side) */
        }
    }

    /* Webkit prefix for compatibility */
    @-webkit-keyframes drift-zoom {
        0% {
            background-size: 100% 100%;
            background-position: 0% 50%;
        }
        100% {
            background-size: 135% 135%;
            background-position: 100% 50%;
        }
    }

    /* 2. CRITICAL CSS: The fixed background layer */
    .fixed-background {
        position: fixed; 
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: -1; 
        
        /* Apply the combined animation */
        /* Duration: 20s (Slow and subtle)
           Direction: infinite alternate (Drifts to 100%, then back to 0%)
        */
        animation: drift-zoom 8s linear infinite alternate; 
        -webkit-animation: drift-zoom 8s linear infinite alternate;
        
        /* Image Source and Sizing */
        background-image: 
            linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), /* Darker overlay for better contrast */
            url('darma.jpg'); /* Ensure this image path is correct */
        
        background-size: 110% 110%; /* Initial state for smooth start/end */
        background-position: 0% 50%; 
        background-repeat: no-repeat;
        
        /* Performance hint for better rendering */
        will-change: background-size, background-position;
    }
        .container {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .header {
            grid-column: 1 / -1;
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 36px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo i {
            margin-right: 15px;
            font-size: 40px;
            color: #ffcc00;
        }

        .subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 10px;
            font-size: 26px;
            color: #ffcc00;
        }

        .upload-area {
            border: 2px dashed rgba(255, 255, 255, 0.4);
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
        }

        .upload-area:hover {
            border-color: rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.15);
        }

        .upload-icon {
            font-size: 50px;
            margin-bottom: 15px;
            color: #ffcc00;
        }

        .upload-text {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .upload-subtext {
            font-size: 14px;
            opacity: 0.8;
        }

        .camera-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
            width: 80%;
        }

        .camera-btn i {
            margin-right: 10px;
            font-size: 18px;
        }

        .camera-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .verify-btn {
            background: linear-gradient(to right, #ffcc00, #ff9900);
            border: none;
            padding: 16px;
            border-radius: 50px;
            color: #1a1a2e;
            font-weight: 700;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px auto 0;
            transition: all 0.3s ease;
            width: 80%;
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.3);
        }

        .verify-btn i {
            margin-right: 10px;
            font-size: 20px;
        }

        .verify-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 204, 0, 0.4);
        }

        .info-card {
            grid-column: 1 / -1;
            margin-top: 20px;
        }

        .info-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-title i {
            margin-right: 10px;
            color: #ffcc00;
        }

        .info-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .info-icon {
            font-size: 20px;
            margin-right: 15px;
            color: #ffcc00;
            margin-top: 3px;
        }

        .info-text {
            flex: 1;
        }

        .info-text h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .info-text p {
            font-size: 14px;
            opacity: 0.8;
        }

        .status-indicator {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .status-step {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .status-step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 20px;
            right: -50%;
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 1;
        }

        .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 2;
        }

        .status-icon.active {
            background: #ffcc00;
            color: #1a1a2e;
        }

        .status-label {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .info-content {
                grid-template-columns: 1fr;
            }
            
            .status-indicator {
                flex-direction: column;
                gap: 20px;
            }
            
            .status-step:not(:last-child):after {
                display: none;
            }
        }

        .preview-image {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 10px;
            margin-top: 15px;
            display: none;
        }

        /* Success Modal Styles */
        .success-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            color: #333;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-icon {
            font-size: 80px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1a2a6c;
        }

        .modal-text {
            font-size: 18px;
            margin-bottom: 30px;
            color: #555;
        }

        .modal-btn {
            background: linear-gradient(to right, #1a2a6c, #b21f1f);
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 700;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
  <body>
    <div class="fixed-background"></div>
    
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-id-card"></i>
               Please NID Access First
            </div>
            <div class="subtitle">Secure National ID Verification System</div>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="fas fa-id-card"></i>
                Scan Front Side
            </div>
            <div class="upload-area" id="frontUpload">
                <div class="upload-icon">
                    <i class="fas fa-file-upload"></i>
                </div>
                <div class="upload-text">Click to upload or use camera</div>
                <div class="upload-subtext">Supported formats: JPG, PNG, PDF</div>
                <img id="frontPreview" class="preview-image" alt="Front side preview">
            </div>
            <button class="camera-btn">
                <i class="fas fa-camera"></i> Use Camera
            </button>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="fas fa-id-card"></i>
                Scan Back Side
            </div>
            <div class="upload-area" id="backUpload">
                <div class="upload-icon">
                    <i class="fas fa-file-upload"></i>
                </div>
                <div class="upload-text">Click to upload or use camera</div>
                <div class="upload-subtext">Supported formats: JPG, PNG, PDF</div>
                <img id="backPreview" class="preview-image" alt="Back side preview">
            </div>
            <button class="camera-btn">
                <i class="fas fa-camera"></i> Use Camera
            </button>
        </div>

        <button class="verify-btn" id="verifyBtn">
            <i class="fas fa-check-circle"></i> Verify NID
        </button>

        <div class="card info-card">
            <div class="info-title">
                <i class="fas fa-info-circle"></i>
                NID Verification Guidelines
            </div>
            <div class="info-content">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="info-text">
                        <h3>Clear Images</h3>
                        <p>Ensure both sides of your NID are clearly visible without glare or shadows.</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="info-text">
                        <h3>Good Lighting</h3>
                        <p>Take photos in well-lit conditions for better clarity and accuracy.</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Complete Details</h3>
                        <p>Make sure all text and photos on the NID are fully visible.</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Secure Process</h3>
                        <p>Your data is encrypted and processed securely according to privacy laws.</p>
                    </div>
                </div>
            </div>

            <div class="status-indicator">
                <div class="status-step">
                    <div class="status-icon active" id="step1">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="status-label">Upload</div>
                </div>
                <div class="status-step">
                    <div class="status-icon" id="step2">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="status-label">Processing</div>
                </div>
                <div class="status-step">
                    <div class="status-icon" id="step3">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="status-label">Verification</div>
                </div>
                <div class="status-step">
                    <div class="status-icon" id="step4">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="status-label">Complete</div>
                </div>
            </div>
        </div>
    </div>

    <div class="success-modal" id="successModal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="modal-title">Verification Successful!</div>
            <div class="modal-text">
                Your NID has been successfully verified. You will now be redirected to the payment page to complete your transaction.
            </div>
            <button class="modal-btn" id="proceedToPayment">
                <i class="fas fa-credit-card"></i> Proceed to Payment
            </button>
        </div>
    </div>

    <script>
        // Upload area functionality
        const frontUpload = document.getElementById('frontUpload');
        const backUpload = document.getElementById('backUpload');
        const frontPreview = document.getElementById('frontPreview');
        const backPreview = document.getElementById('backPreview');
        const verifyBtn = document.getElementById('verifyBtn');
        const successModal = document.getElementById('successModal');
        const proceedToPaymentBtn = document.getElementById('proceedToPayment');
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const step4 = document.getElementById('step4');

        // Front side upload
        frontUpload.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        frontPreview.src = event.target.result;
                        frontPreview.style.display = 'block';
                        updateVerificationStatus();
                    };
                    reader.readAsDataURL(file);
                }
            };
            
            input.click();
        });

        // Back side upload
        backUpload.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        backPreview.src = event.target.result;
                        backPreview.style.display = 'block';
                        updateVerificationStatus();
                    };
                    reader.readAsDataURL(file);
                }
            };
            
            input.click();
        });

        // Camera buttons
        document.querySelectorAll('.camera-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Camera would open here in a real application. For demo purposes, please use the upload area.');
            });
        });

        // Verify button
        verifyBtn.addEventListener('click', function() {
            if (!frontPreview.src && !backPreview.src) {
                alert('Please upload both sides of your NID card to proceed with verification.');
                return;
            } else if (!frontPreview.src) {
                alert('Please upload the front side of your NID card.');
                return;
            } else if (!backPreview.src) {
                alert('Please upload the back side of your NID card.');
                return;
            }
            
            // Simulate verification process
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';
            this.disabled = true;
            
            // Update status indicator
            step2.classList.add('active');
            
            setTimeout(() => {
                step3.classList.add('active');
                
                setTimeout(() => {
                    step4.classList.add('active');
                    
                    // Show success modal
                    setTimeout(() => {
                        successModal.style.display = 'flex';
                    }, 500);
                    
                }, 1000);
            }, 2000);
        });

        // Proceed to payment button
        proceedToPaymentBtn.addEventListener('click', function() {
            // Redirect to payment page
            window.location.href = 'pay.php';
        });

        function updateVerificationStatus() {
            if (frontPreview.src && backPreview.src) {
                verifyBtn.style.background = 'linear-gradient(to right, #00b09b, #96c93d)';
            }
        }
    </script>
</body>
</html>