<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment System - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* --- 1. Global Setup & Font Import --- */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        /* --- BODY STYLES (Enables Centering) --- */
        body {
            min-height: 100vh;
            /* Center content horizontally and vertically */
            display: flex; 
            justify-content: center;
            align-items: center; 
            
            padding: 0; 
            color: #fff;
            margin: 0;
            overflow-x: hidden;
            background-color: #000;
            font-size: 1.125rem;
        }

        /* ---------------------------------------------------- */
        /* FIXED BACKGROUND & ANIMATION (Ensures Fixed Layering) */
        /* ---------------------------------------------------- */
        
        @keyframes drift-zoom {
            0% { background-size: 100% 100%; background-position: 0% 50%; }
            100% { background-size: 135% 135%; background-position: 100% 50%; }
        }

        @-webkit-keyframes drift-zoom {
            0% { background-size: 120% 120%; background-position: 0% 50%; }
            100% { background-size: 135% 135%; background-position: 100% 50%; }
        }

        .fixed-background {
            position: fixed; 
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1; 
            animation: drift-zoom 8s linear infinite alternate; 
            -webkit-animation: drift-zoom 8s linear infinite alternate;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), 
                url('pp.jpg'); /* Replace with your actual image path */
            background-size: 110% 110%; 
            background-position: 0% 50%; 
            background-repeat: no-repeat;
            will-change: background-size, background-position;
        }

        /* --- Glassmorphism Styles --- */
        .glass-card {
            background: rgba(84, 84, 146, 0.8); 
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            padding: 40px 60px; /* Adjusted padding for better vertical fit */
            transition: all 0.3s ease;
            width: 100%;
            max-width: 450px; /* Controlled width for a login form */
            text-align: center;
        }
        
        .glass-card h1 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .glass-card p {
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* --- Form Styling --- */
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15); /* Slightly darker glass for inputs */
            color: #251111ff;
            box-sizing: border-box;
            transition: background 0.3s ease;
        }
        
        .form-group input:focus {
            background: rgba(255, 255, 255, 0.25);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }
        
        /* Dropdown specific styles */
        .form-group select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            padding-right: 40px; /* Space for arrow */
        }
        
        /* Button styling */
        .login-button, .signup-button {
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1rem;
            transition: background 0.3s, transform 0.2s;
            text-decoration: none; /* Crucial for anchor tags */
            display: block; /* Makes anchor tag behave like a block button */
        }
        
        .login-button {
            background: #00bcd4; /* A vibrant color for the main action */
            color: #1a1a1a;
            margin-top: 10px;
            margin-bottom: 10px; /* Space between login and signup */
        }
        .login-button:hover { 
            background: #00e5ff; 
            transform: translateY(-2px);
        }
        
        /* --- NEW SIGN UP BUTTON STYLES --- */
        .signup-button {
            background: rgba(255, 255, 255, 0.2); /* Transparent/Ghost button style */
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .signup-button:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    
    <div class="fixed-background"></div>

    <main>
        
        <div class="glass-card">
            <h1>Doctor Appointment System Login</h1>
            <p>Sign in with your credentials to access the dashboard.</p>
            
            <form action="content.php" method="GET">
                
                <div class="form-group">
                    <label for="username">Username / ID</label>
                    <input type="text" id="username" name="username" placeholder="Enter ID or Username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Select Role</label>
                    <select id="role" name="role" required>
                        <option value="" disabled selected>Choose your role</option>
                        <option value="student">Doctor</option>
                        <option value="landlord">Patient</option>
                        <option value="superadmin">Reception</option>
                    </select>
                </div>
                
                <button type="submit" class="login-button">Login</button>
                
                <a href="signup.php" class="signup-button">Register / Sign Up</a>
                <a href="content.php" class="signup-button">Login</a>
                
                <p style="margin-top: 20px; font-size: 0.9rem;">
                    <a href="#" style="color: #00bcd4; text-decoration: none;">Forgot Password?</a>
                </p>
                
            </form>
        </div>

    </main>
</body>
</html>