<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Manager Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* --- 1. Global Setup --- */ @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    /* --- FONT SIZE INCREASE APPLIED HERE --- */
    body {
        min-height: 100vh;
        display: block; /* Changed from flex to block for normal flow */
        padding: 0; /* Removed padding: 20px; */
        color: #0a0a0aff;
        margin: 0;
        overflow-x: hidden;
        background-color: #000; /* Fallback color for contrast */
        /* === NEW: BASE FONT SIZE INCREASE === */
        font-size: 1.2rem; /* Sets the base font size to ~18px */
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
            linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), /* Darker overlay for better contrast */
            url('darma.jpg'); /* Ensure this image path is correct */
        
        background-size: 110% 110%; /* Initial state for smooth start/end */
        background-position: 0% 50%; 
        background-repeat: no-repeat;
        
        /* Performance hint for better rendering */
        will-change: background-size, background-position;
    }

        /* --- 3. Base Glassmorphism Effect --- */
        .glass-nav, .glass-card, .glass-card-item {
            background: rgba(255, 255, 255, 0.15); 
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.5);
        }

        /* --- 4. Top Side Menu (Sticky Header) Styling --- */
        .top-side-menu {
            position: sticky;
            top: 20px; 
            z-index: 100;
            margin: 20px auto 40px auto; 
            padding: 10px 40px;
            background: rgba(255, 255, 255, 0.1); 
            max-width: 1200px; 
        }

        .top-side-menu nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .top-side-menu ul {
            list-style: none;
            display: flex;
            gap: 30px;
            padding: 0;
            margin: 0;
        }

        .top-side-menu a {
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .top-side-menu a:hover,
        .top-side-menu a:focus { /* Focus helps show active state */
            background: rgba(255, 255, 255, 0.25);
            outline: none; /* Remove default focus outline */
        }

        /* --- 5. Content Area (Medium Sizing & Centering) --- */
        .content-area {
            max-width: 1200px; 
            margin: 0 auto;    
            padding: 0 20px 40px 20px; 
        }

        .glass-card {
            padding: 40px;
            margin-bottom: 40px;
        }

        h2 {
            font-weight: 600;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 10px;
            margin-top: 0;
        }
        
        .glass-card-item {
            padding: 25px;
            margin-bottom: 20px; /* Added margin for separation */
        }
        
        /* === KEY ROUTING / SWITCHING CSS === */
        /* Hide all sections by default */
        .content-section {
            display: none;
        }

        /* Show section only when its ID matches the URL hash (i.e., when clicked) */
        /* If no hash is present, show the Dashboard by default */
        body:not(:has(:target)) #dashboard {
            display: block;
        }
        
        .content-section:target {
            display: block;
        }
        /* =================================== */

        /* Existing utility styles (lists, buttons) */
        .card-grid {
            display: grid;
            grid-template-columns: 1fr 1fr; 
            gap: 20px; 
            margin-top: 20px;
        }
        
        @media (max-width: 900px) {
            .card-grid {
                grid-template-columns: 1fr; 
            }
        }
        
        .glass-card ul {
            list-style: none;
            padding: 0;
        }

        .glass-card ul li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Styling for form elements (used in Add Room Form) */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            box-sizing: border-box;
            /* Note: Input/Select text size is typically fine as is, but inherits the new base size */
        }

        /* NEW CSS: Styling for the Room List table */
        .room-list-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
            /* === ADJUSTED TABLE FONT SIZE === */
            font-size: 1.2rem; /* Increased from 0.9rem to 1rem to keep it readable, but slightly smaller than body text */
        }

        .room-list-table th, .room-list-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .room-list-table th {
            background: rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }

        .room-list-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        /* Button styling */
        button {
            background: rgba(255, 255, 255, 0.8);
            color: #1a1a1a;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }
        button:hover { background: #fff; }
    </style>
</head>
<body>
    
    <div class="fixed-background"></div>

    <header class="top-side-menu glass-nav">
        <nav>
            <div class="logo">HostelMS</div>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#roommgmt">Room Management</a></li>
                <li><a href="#myhostels">My Hostels List</a></li>
                <li><a href="#bookings">Bookings</a></li>
                <li><a href="#complaints">Complaints</a></li>
                <li><a href="#subscription">Subscription</a></li>
            </ul>
        </nav>
    </header>

    <main class="content-area">
        
        <section id="dashboard" class="content-section">
            <h2>🏠 Dashboard Overview</h2>
            
            <div class="glass-card-item">
                <h3>🔔 Notification Panel</h3>
                <ul>
                    <li>**5 New Bookings** pending confirmation.</li>
                    <li>**2 Tenants** have overdue rent this month (See Financial Summary).</li>
                    <li>New maintenance ticket: jihan (Room 101).</li>
                </ul>
                <button>View All Notifications</button>
            </div>
            
            <div class="card-grid">
                
                <div class="glass-card-item">
                    <h3>💰 Financial Summary (Overdue Rent)</h3>
                    <p class="mb-3">**Total Overdue:** <span style="font-size: 1.2rem; font-weight: bold; color: #ffeb3b;">900.00</span></p>
                    <hr style="border-color: rgba(17, 15, 15, 0.2); margin: 15px 0;">
                    <h4>Tenants with Overdue Rent:</h4>
                    <ul>
                        <li><strong style="color: #0da74dff;">Tenant A</strong> (Room 101) - 500 (Due Oct)</li>
                        <li><strong style="color: #099d31ff;">Tenant B</strong> (Room 302) - 400 (Due Sep)</li>
                    </ul>
                    <button style="margin-top: 10px;">Contact Tenants</button>
                </div>
                
                <div class="glass-card-item">
                    <h3>Tenancy & Rooms</h3>
                    <p>**90% Occupancy** across all rooms.</p>
                    <p>Total Vacant Rooms: **5**</p>
                </div>
                
                <div class="glass-card-item">
                    <h3>Complaint & Repair Notifications</h3>
                    <p>2 Open Tickets. Update status.</p>
                </div>
                
                <div class="glass-card-item">
                    <h3>Hostel Add/Edit</h3>
                    <button>Manage Hostel Details</button>
                </div>
            </div>
        </section>

        <section id="roommgmt" class="content-section">
            <h2>🔑 Room Management</h2>
            
            <div class="glass-card-item">
                <h3>➕ Add New Room</h3>
                <form>
                    <div class="form-group">
                        <label for="room_number">Room Number</label>
                        <input type="text" id="room_number" name="room_number" value="A-401" required>
                    </div>
                    <div class="form-group">
                        <label for="room_type">Room Type</label>
                        <select id="room_type" name="room_type" required>
                            <option value="single">Single Occupancy</option>
                            <option value="double">Double Occupancy</option>
                            <option value="quad">Quad Sharing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="monthly_rent">Monthly Rent </label>
                        <input type="number" id="monthly_rent" name="monthly_rent" value="450" required>
                    </div>
                    <button type="submit">Add Room</button>
                </form>
            </div>
            
            <div class="glass-card-item">
                <h3>📋 All Room Details</h3>
                <table class="room-list-table">
                    <thead>
                        <tr>
                            <th>Room #</th>
                            <th>Type</th>
                            <th>Rent</th>
                            <th>Status</th>
                            <th>Current Tenant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>Single</td>
                            <td>500</td>
                            <td style="color: #b9f6ca;">Occupied</td>
                            <td>jihan</td>
                            <td><button>Edit</button></td>
                        </tr>
                        <tr>
                            <td>205</td>
                            <td>Double</td>
                            <td>450</td>
                            <td style="color: #ff8a80;">Vacant</td>
                            <td>N/A</td>
                            <td><button>Edit</button></td>
                        </tr>
                        <tr>
                            <td>302</td>
                            <td>Single</td>
                            <td>400</td>
                            <td style="color: #b9f6ca;">Occupied</td>
                            <td>Sakib</td>
                            <td><button>Edit</button></td>
                        </tr>
                        <tr>
                            <td>A-401</td>
                            <td>Quad</td>
                            <td>300</td>
                            <td style="color: #ff8a80;">Vacant</td>
                            <td>N/A</td>
                            <td><button>Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section id="myhostels" class="glass-card content-section">
            <h2>🛌 My Hostels List & Room Details</h2>
            <p>Details corresponding to your managed Hostels and specific Rooms.</p>
            
            <div class="glass-card-item room-card">
                <h3>Room 101 - Tenancy Status</h3>
                <ul>
                    <li>Tenancy Status: **Leased**</li>
                    <li>**Tenant's details**: Jihan (View Profile)</li>
                    <li>Rent Overview: **500/month**</li>
                    <li>Booking requests: **None**</li>
                </div>
            
            <div class="glass-card-item room-card">
                <h3>Room 205 - Tenancy Status</h3>
                <ul>
                    <li>Tenancy Status: **Vacant**</li>
                    <li>**Tenant's details**: N/A</li>
                    <li>Rent Overview: 450/month</li>
                    <li>Booking requests: **1 Pending**</li>
                </ul>
            </div>
        </section>

        <section id="bookings" class="glass-card content-section">
            <h2>🗓️ Bookings Management</h2>
            <p>Manage all pending and confirmed bookings. (See: Tenant's contact details, Booked room details, Booking confirmation)</p>
            
            <div class="glass-card-item">
                <h3>Pending Bookings</h3>
                <p>New request from Tanvir for Room 302.</p>
                <a href="pay.php" style="text-decoration: none;">
                <button>Confirm Booking</button>
            </div>
        </section>

        <section id="complaints" class="glass-card content-section">
            <h2>🔧 Complaint & Repair Status</h2>
            <p>View open tickets and update status.</p>
            
            <div class="glass-card-item">
                <h3>Open Ticket: Leaky Faucet (Room 101)</h3>
                <p>Status: **Assigned to maintenance.**</p>
                <button>Update Status</button>
            </div>
        </section>

        <section id="subscription" class="content-section">
            <h2>💳 Subscription Details</h2>
            <p>Manage app subscription details and online payment.</p>
            
            <div class="glass-card-item">
                <h3>Current Plan: Premium</h3>
                <p>Next Payment Due: 2026-01-30</p>
                <button>Make Online Payment</button>
            </div>
        </section>
        
        <section class="glass-card content-section" id="scroll-test">
            <h2>⬇️ Scroll Test Area ⬇️</h2>
            <div style="height: 500px; padding: 50px; opacity: 0.8; text-align: center;">
                <p>This space ensures the page can scroll. Note that only one section is visible at a time.</p>
                <p>The **background image remains fixed** regardless of which section is currently displayed.</p>
            </div>
        </section>

    </main>
</body>
</html>