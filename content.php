<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Dashboard Selector</title>
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

        /* --- BODY STYLES (Allows Content to Flow and Scroll) --- */
        body {
            min-height: 100vh;
            display: block; 
            padding: 0; 
            color: #0c0c0cff;
            margin: 0;
            overflow-x: hidden;
            background-color: #000;
            font-size: 1.125rem; /* Increased base font size */
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
            -webkit-animation: drift-zoom 10s linear infinite alternate;
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
            /* 1. INCREASED PADDING FOR TALLER CARD */
            padding: 60px; 
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            box-shadow: 0 16px 64px 0 rgba(0, 0, 0, 0.5);
        }

        /* --- Layout for Centering the Initial Control Panel --- */
        .content-area {
            max-width: 1200px; 
            margin: 0 auto;    
            padding: 0 20px 40px 20px; 
        }

        .initial-selector-wrapper {
            /* Centers the card perfectly on the screen */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            text-align: center;
        }

        /* --- View Selection Buttons --- */
        .role-buttons {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            justify-content: center;
        }
        
        .role-buttons a {
            flex-grow: 1;
            text-decoration: none;
            color: #e1e6e2ff;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
            max-width: 250px;
        }

        .role-buttons a:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* --- Content Section Toggling --- */
        .view-content-section {
            display: none;
            padding: 60px 0;
            min-height: 80vh; /* Ensures content area is tall enough for scrolling demo */
        }
        
        .view-content-section:target {
            display: block;
        }
        
        /* Default view for when no hash is present */
        body:not(:has(:target)) #initial-selector {
            display: flex; /* Display as flex to use the centered wrapper */
        }

        .view-content-section h2 {
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 10px;
            margin-top: 0;
        }
    </style>
</head>
<body>
    
    <div class="fixed-background"></div>

    <main class="content-area">
        
        <section id="initial-selector" class="initial-selector-wrapper">
            <div class="glass-card" style="max-width: 1000px; width: 100%;">
                <h1>Welcome to Doctor Appointment  System</h1>
                <p>Please select your role to proceed to the main dashboard.</p>
                
                <div class="role-buttons">
                    <a href="hall.php">🧑‍🎓 Doctor View</a>
                    <a href="hall.php">💼 Patient View</a>
                    <a href="jo.php">⚙️ Reception View</a>
                </div>
                
            </div>
        </section>


        <section id="student-view" class="glass-card view-content-section">
            <h2>🧑‍🎓 Student Dashboard</h2>
            <p>Welcome, Student! Here you can manage your rent payments, view roommate details, and submit maintenance complaints.</p>
            
            <div style="height: 1000px; padding: 20px; background: rgba(255, 255, 255, 0.1);">
                <h3>Student-Specific Content</h3>
                <p>This area is scrollable. The background remains fixed.</p>
            </div>
            <p><a href="#initial-selector" style="color: #4CAF50;">← Back to Role Selector</a></p>
        </section>


        <section id="landlord-view" class="glass-card view-content-section">
            <h2>💼 Landlord Dashboard</h2>
            <p>Welcome, Landlord! Access occupancy rates, financial summaries, and manage room listings.</p>
            
            <div style="height: 1000px; padding: 20px; background: rgba(255, 255, 255, 0.1);">
                <h3>Landlord-Specific Content</h3>
                <p>This area is scrollable. The background remains fixed.</p>
            </div>
            <p><a href="#initial-selector" style="color: #4CAF50;">← Back to Role Selector</a></p>
        </section>


        <section id="superadmin-view" class="glass-card view-content-section">
            <h2>⚙️ Superadmin Dashboard</h2>
            <p>Welcome, Superadmin! Control system settings, manage users, and view global hostel statistics.</p>
            
            <div style="height: 1000px; padding: 20px; background: rgba(255, 255, 255, 0.1);">
                <h3>Superadmin-Specific Content</h3>
                <p>This area is scrollable. The background remains fixed.</p>
            </div>
            <p><a href="#initial-selector" style="color: #4CAF50;">← Back to Role Selector</a></p>
        </section>

    </main>
</body>
</html>