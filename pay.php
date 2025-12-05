
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
    // Code to display the message (e.g., in a div at the top)
    echo '<div class="alert-box">'. $message .'</div>';
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Apply the Inter font family */
       @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
   
    /* 1. Ensure HTML and BODY start at the very top */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    /* --- FIX APPLIED HERE --- */
    /* Removed display: flex and align-items: center to stop vertical centering, 
       allowing content to flow from the top and be fully scrollable. */
    body {
        min-height: 100vh;
        display: block; /* Changed from flex to block for normal flow */
        padding: 0; /* Removed padding: 20px; */
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
        /* Duration: 8s (Slow and subtle)
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
        /* Basic SVG icon style */
        .icon {
            width: 1.25rem; /* 20px */
            height: 1.25rem; /* 20px */
            stroke-width: 2;
            flex-shrink: 0;
        }
        
        /* --- ADDED THIS --- */
        /* Style for the payment logos inside buttons */
        .payment-logo {
            height: 40px; /* Sets a consistent height (2.5rem or h-10) */
            width: auto;  /* Maintains the image's aspect ratio */
            object-fit: contain; /* Ensures the logo fits cleanly */
        }
        /* --- END OF ADDED CSS --- */

    </style>
</head>
<body>
   <div class="fixed-background"></div>
<div class="min-h-screen text-white p-4 md:p-8 flex items-center justify-center">

    <div class="bg-black/60 backdrop-blur-lg rounded-2xl shadow-xl border border-white/30 w-full max-w-4xl p-6 md:p-8">
        
        <header class="flex items-center justify-between mb-6 pb-6 border-b border-white/30">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white font-bold p-2 rounded-lg text-lg">
                    123
                </div>
                <span class="text-sm md:text-base font-medium">Thank you for shopping with <strong>123.com.bd</strong></span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

            <div class="md:col-span-2">
                <h2 class="text-xl font-semibold mb-4">Select a Payment Method</h2>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    
                    <button class="payment-button">
                        <img src="bkash.png" alt="bKash" class="payment-logo">
                        <span class="font-bold text-lg">bKash</span>
                    </button>
                    
                    <button class="payment-button">
                        <img src="nagad.png" alt="Nagad" class="payment-logo">
                        <span class="font-bold text-lg">Nagad</span>
                    </button>

                    <button class="payment-button">
                        <img src="rocket.png" alt="Rocket" class="payment-logo">
                        <span class="font-bold text-lg">Rocket</span>
                    </button>

                    <button class="payment-button">
                        <img src="visa.jpg" alt="VISA" class="payment-logo">
                        <span class="font-bold text-lg">VISA</span>
                    </button>

                    <button class="payment-button">
                        <img src="master.png" alt="Mastercard" class="payment-logo">
                        <span class="font-bold text-lg">Mastercard</span>
                    </button>

                    <button class="payment-button">
                        <img src="amex.png" alt="AMEX" class="payment-logo">
                        <span class="font-bold text-lg">AMEX</span>
                    </button>

                    <button class="payment-button">
                        <img src="dbbl.jpg" alt="DBBL Nexus" class="payment-logo">
                        <span class="font-bold text-lg">DBBL Nexus</span>
                    </button>
                    
                    <button class="payment-button">
                        <img src="paypal.png" alt="PayPal" class="payment-logo">
                        <span class="font-bold text-lg">PayPal</span>
                    </button>
                    
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-black/70 backdrop-blur-md rounded-xl p-5 border border-white/20 h-full flex flex-col">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-white/30 text-center">Payment Summary</h2>
                    
                    <div class="space-y-3 text-sm flex-grow">
                        <div class="summary-row">
                            <span class="text-white/80">Merchant:</span>
                            <span class="font-medium text-right">123</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">Invoice To:</span>
                            <span class="font-medium text-right">Mr. User Name</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">Mobile:</span>
                            <span class="font-medium text-right">01719023450</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">Email:</span>
                            <span class="font-medium text-right truncate">username@gmail.com</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">Order No:</span>
                            <span class="font-medium text-right">294</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">3Pay-ID:</span>
                            <span class="font-medium text-right truncate">C9Yc89...</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">Invoice Amount:</span>
                            <span class="font-medium text-right">tk 1.00</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-white/80">Order Details:</span>
                            <span class="font-medium text-right">Canon Digital SLR</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-white/30">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold">TOTAL:</span>
                            <span class="text-2xl font-bold">tk 1.00</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> <footer class="flex items-center justify-between mt-8 pt-6 border-t border-white/30">
            <button class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg px-5 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/40">
                &lt; Cancel
            </button>
            
            <div class="text-sm flex items-center gap-2">
                <span class="text-white/80">Powered By:</span>
                <span class="bg-red-600 text-white font-bold p-2 rounded-lg text-lg">
                    3pay
                </span>
            </div>
        </footer>

    </div> <script>
        // Configure Tailwind CSS
        tailwind.config = {
            theme: {
                extend: {
                    // Add custom styles if needed
                }
            },
            plugins: [
                function({ addComponents }) {
                    addComponents({
                        // Custom utility class for the glass payment buttons
                        '.payment-button': {
                            // This class already uses flex-col, which is perfect
                            // It will stack the image on top of the text
                            '@apply bg-white/25 backdrop-blur-sm border border-white/20 rounded-xl p-4 h-24 flex flex-col items-center justify-center gap-1 cursor-pointer transition-all duration-300 hover:bg-white/40 hover:border-white/40 hover:shadow-lg': {},
                        },
                        // Custom utility for summary rows
                        '.summary-row': {
                            '@apply flex justify-between items-center gap-4': {},
                        }
                    })
                }
            ]
        }
    </script>

</body>
</html>