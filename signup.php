<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment System - Sign Up</title>
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
            
            padding: 20px; /* Add padding for small screens */
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
            100% { background-size: 120% 120%; background-position: 100% 50%; }
        }

        @-webkit-keyframes drift-zoom {
            0% { background-size: 100% 100%; background-position: 0% 50%; }
            100% { background-size: 120% 120%; background-position: 100% 50%; }
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
            padding: 40px 60px;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 500px; /* Slightly wider than login for more form fields */
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
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            color: #090808ff;
            box-sizing: border-box;
            transition: background 0.3s ease;
        }
        
        .form-group input:focus, .form-group select:focus {
            background: rgba(255, 255, 255, 0.25);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }
        
        /* Select Dropdown Arrow Styling */
        .form-group select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            padding-right: 40px; 
        }
        
        /* Button styling */
        .submit-button {
            width: 100%;
            background: #4CAF50; /* Green for registration */
            color: #1a1a1a;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1rem;
            transition: background 0.3s, transform 0.2s;
            margin-top: 15px;
        }
        .submit-button:hover { 
            background: #66bb6a; 
            transform: translateY(-2px);
        }
        
        .back-to-login {
            margin-top: 25px;
            font-size: 0.9rem;
        }
        .back-to-login a {
             color: #00bcd4; 
             text-decoration: none;
        }
    </style>
</head>
<body>
    
    <div class="fixed-background"></div>

    <main>
        
        <div class="glass-card">
            <h1>Create New Account</h1>
            <p>Join Doctor Appointment System by registering your details.</p>
            
            <form action="login.php" method="POST">
                
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter a valid email" required>
                </div>
                
                <div class="form-group">
                    <label for="new_username">Create Username / ID</label>
                    <input type="text" id="new_username" name="new_username" placeholder="Choose a unique ID" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">Create Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Choose a strong password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
                </div>
                
                <div class="form-group">
                    <label for="new_role">Register As</label>
                    <select id="new_role" name="new_role" required>
                        <option value="" disabled selected>Select your user type</option>
                        <option value="student">Doctor</option>
                        <option value="landlord">Patient</option>
                        <option value="superadmin">Reception</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-button">Register Account</button>
                
                <p class="back-to-login">
                    Already have an account? <a href="login.php">Log In Here</a>
                </p>
                
            </form>
        </div>

    </main>
</body>
</html>