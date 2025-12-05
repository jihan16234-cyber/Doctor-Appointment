<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard (Glassmorphism SPA)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        
        /* Define a background image URL relevant to a medical system */
  :root {
            --bg-image: url('https://source.unsplash.com/1920x1090/?hospital,clinic,doctor,health');
            /* New Dark Blue and Black Colors */
            --color-dark-blue: rgba(84, 84, 146, 0.8); 
            --color-solid-dark-blue: #576d93ff; 
            --color-dark-black: #000000;
            
            --color-primary-medicine: #5B89B6; 
        }

       body, html {
    margin: 0;        
    padding: 0;
    height: 100%;
  }

  
  .fixed-bg-layer {
    position: fixed; /* Locks it to the viewport */
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: -1; /* Pushes it behind the content */
    
    background-image: url('pp.jpg');
    background-repeat: no-repeat;
    
    /* Animation settings */
    animation: bg-drift-zoom 10s infinite alternate ease-in-out;
  }

  /* 3. The Keyframes (No Scale Used) */
  @keyframes bg-drift-zoom {
    0% {
      /* Start: Smaller size (Zoom out) and centered */
      background-size: 100%; 
      background-position: 50% 50%;
    }
    50% {
      /* Mid: Slight zoom in, drift right */
      background-size: 120%; 
      background-position: 80% 50%;
    }
    100% {
      /* End: Maximum zoom in, drift bottom-left */
      background-size: 120%; 
      background-position: 20% 80%;
    }
  }

  /* 4. The Scrollable Content */
  .content-body {
    position: relative;
    /* Add semi-transparent backing or shadow to make text readable */
    background: transparent;
    color: white;
    font-family: sans-serif;
    padding: 50px;
    min-height: 200vh; /* Ensures page is long enough to scroll */
  }
        /* Custom CSS for the Frosted Glass effect (Glassmorphism) on the Navbar (Refined) */
        .glass-nav {
            backdrop-filter: blur(15px) saturate(200%); 
            -webkit-backdrop-filter: blur(15px) saturate(200%);
            /* FIX: Dark Blue Background */
            background-color: var(--color-dark-blue); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.3);
        }

        .glass-card {
            /* FIX: Solid Dark Blue Background */
            background-color: var(--color-solid-dark-blue); 
            border: 1px solid rgba(66, 112, 229, 0.9); /* Keep a subtle light border */
            border-radius: 1.25rem; 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #ffffff; /* Default text color for cards is white */
        }
        
        /* Ensure key text within cards remains visible and white */
        .glass-card h1, .glass-card h2, .glass-card h3 {
            color: #ffffff;
        }

        .glass-card p {
            color: #e5e5e5;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            /* FIX: Changed box-shadow to a darker, more prominent shadow 
               to prevent the 'white highlight' effect */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6); 
        }

        /* Overlay is transparent (from previous fix) */
        .content-overlay {
            background-color: transparent; 
            min-height: 100vh;
            padding-bottom: 3rem; 
        }

        /* Active class for navigation link highlighting - Changed to White */
        .nav-active {
            background-color: rgba(255, 255, 255, 0.95);
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: var(--color-solid-dark-blue); /* Text color contrast with white background */
        }
        
        /* Base Navigation Link Color - CHANGED TO BLACK */
        .glass-nav a {
            color: #000000; /* CHANGED to Black */
        }
        .glass-nav a:hover {
            /* Keep the subtle light hover background effect */
            background-color: rgba(255, 255, 255, 0.2); 
            color: #000000; /* Keep hover text black */
        }
        
        /* Change all colored icons to white for better contrast on dark glass cards */
        .glass-card [data-lucide] {
            color: #ffffff;
        }

        /* Update Action Button colors to Dark Black */
        .btn-primary-indigo { background-color: var(--color-dark-black); }
        .btn-primary-indigo:hover { background-color: #333333; }
        
        .btn-primary-green { background-color: var(--color-dark-black); }
        .btn-primary-green:hover { background-color: #333333; }

        .btn-primary-pink { background-color: var(--color-dark-black); }
        .btn-primary-pink:hover { background-color: #333333; }
        
        .btn-primary-blue { background-color: var(--color-dark-black); }
        .btn-primary-blue:hover { background-color: #333333; }
        
        .btn-primary-yellow { background-color: var(--color-dark-black); }
        .btn-primary-yellow:hover { background-color: #333333; }
        
        .btn-primary-red { background-color: var(--color-dark-black); }
        .btn-primary-red:hover { background-color: #333333; }
        
        /* New Medicine Button Styles */
        .btn-primary-medicine { background-color: var(--color-primary-medicine); }
        .btn-primary-medicine:hover { background-color: #4A739C; }


        /* CSS to hide non-active pages */
        .page-content {
            display: none;
        }
        
        /* Custom styling for the multi-step progress bar */
        .progress-step.active .step-number {
            background-color: var(--color-dark-black); /* Dark Black */
            color: white;
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.2); 
        }
        .progress-step.done .step-number {
            background-color: #333333; /* Darker grey for done steps */
            color: white;
        }
        .step-number {
            background-color: #555555; 
            color: white;
            transition: all 0.3s ease;
            z-index: 10;
        }
        .step-label {
            color: #e5e5e5; /* Light text for visibility */
        }
        .progress-step.active + .progress-step .progress-line,
        .progress-step.done + .progress-step .progress-line {
            background-color: var(--color-dark-black);
        }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="antialiased">
<div class="fixed-bg-layer"></div>
    <div class="content-overlay">

        <nav class="sticky top-0 z-50 p-4 glass-nav" id="main-nav">
            <div class="max-w-7xl mx-auto flex justify-center items-center">
                <div class="flex flex-wrap justify-center space-x-4 sm:space-x-8 text-gray-800 font-semibold">
                    <a href="#" id="nav-dashboard" class="p-2 rounded-lg nav-active hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('dashboard-content', this); return false;">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 mr-1"></i> Dashboard
                    </a>
                    <a href="#" id="nav-doctors" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('doctors-content', this); return false;">
                        <i data-lucide="stethoscope" class="w-4 h-4 mr-1"></i> Doctors
                    </a>
                    <a href="#" id="nav-appointments" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('full-booking-content', this); return false;">
                        <i data-lucide="calendar-check" class="w-4 h-4 mr-1"></i> Appointments
                    </a>
                    <a href="#" id="nav-patients" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('patients-content', this); return false;">
                        <i data-lucide="user-round" class="w-4 h-4 mr-1"></i> Patients
                    </a>
                    <a href="#" id="nav-medicine" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('medicine-content', this); return false;">
                        <i data-lucide="pill" class="w-4 h-4 mr-1"></i> Medicine
                    </a>
                    <a href="#" id="nav-ambulance" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
    onclick="showPage('ambulance-content', this); return false;">
    <i data-lucide="ambulance" class="w-4 h-4 mr-1"></i> Ambulance
</a>
                    <a href="#" id="nav-reports" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('reports-content', this); return false;">
                        <i data-lucide="bar-chart-2" class="w-4 h-4 mr-1"></i> Reports
                    </a>
                    <a href="#" id="nav-settings" class="p-2 rounded-lg hover:bg-white/70 transition duration-150 text-sm sm:text-base flex items-center" 
                        onclick="showPage('settings-content', this); return false;">
                        <i data-lucide="settings" class="w-4 h-4 mr-1"></i> Settings
                    </a>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 mt-4">

            <section id="dashboard-content" class="page-content">
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight">
                    Doctor Appointment System Dashboard
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">

                    <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i data-lucide="stethoscope" class="w-8 h-8"></i>
                            <h2 class="text-xl font-semibold">Doctor Management</h2>
                        </div>
                        <p class="mt-4">Manage doctor profiles and search for specialists or departments.</p>
                        <p class="mt-2 text-sm font-medium text-white">Active: 42 Doctors</p>
                        <button class="mt-4 w-full py-2 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition transform hover:scale-[1.02] active:scale-[0.98]" onclick="showPage('doctors-content', document.getElementById('nav-doctors')); return false;">View Profiles</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i data-lucide="clock" class="w-8 h-8"></i>
                            <h2 class="text-xl font-semibold">Timeslot Management</h2>
                        </div>
                        <p class="mt-4">Define and configure available booking slots for each doctor.</p>
                        <p class="mt-2 text-sm font-medium text-white">Slots Today: 185 Open</p>
                        <button class="mt-4 w-full py-2 btn-primary-green text-white font-medium rounded-lg hover:bg-green-700 transition transform hover:scale-[1.02] active:scale-[0.98]">Configure Slots</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i data-lucide="calendar-check" class="w-8 h-8"></i>
                            <h2 class="text-xl font-semibold">Appointment Management</h2>
                        </div>
                        <p class="mt-4">Handle booking, viewing records, accepting/deleting appointments.</p>
                        <p class="mt-2 text-sm font-medium text-white">Pending Requests: 14</p>
                        <button class="mt-4 w-full py-2 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition transform hover:scale-[1.02] active:scale-[0.98]" onclick="showPage('full-booking-content', document.getElementById('nav-appointments')); return false;">Manage Bookings</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i data-lucide="user-round" class="w-8 h-8"></i>
                            <h2 class="text-xl font-semibold">Patient Management</h2>
                        </div>
                        <p class="mt-4">Maintain detailed records, history, and check existing records for prescriptions.</p>
                        <p class="mt-2 text-sm font-medium text-white">Total: 1245 Patients</p>
                        <button class="mt-4 w-full py-2 btn-primary-blue text-white font-medium rounded-lg hover:bg-blue-700 transition transform hover:scale-[1.02] active:scale-[0.98]" onclick="showPage('patients-content', document.getElementById('nav-patients')); return false;">View Patients</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i data-lucide="pill" class="w-8 h-8"></i>
                            <h2 class="text-xl font-semibold">Inventory Management</h2>
                        </div>
                        <p class="mt-4">Track medicine stock, manage expiry dates, and view product details.</p>
                        <p class="mt-2 text-sm font-medium text-white">Low Stock Items: 5</p>
                        <button class="mt-4 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg hover:bg-yellow-700 transition transform hover:scale-[1.02] active:scale-[0.98]" onclick="showPage('medicine-content', document.getElementById('nav-medicine')); return false;">Manage Stock</button>
                    </div>
                    
                    <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i data-lucide="bar-chart-2" class="w-8 h-8"></i>
                            <h2 class="text-xl font-semibold">System Reports</h2>
                        </div>
                        <p class="mt-4">Generate detailed reports for Doctors, Appointments, and Patients.</p>
                        <p class="mt-2 text-sm font-medium text-white">Access data for successful/failed payments, etc.</p>
                        <button class="mt-4 w-full py-2 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition transform hover:scale-[1.02] active:scale-[0.98]" onclick="showPage('reports-content', document.getElementById('nav-reports')); return false;">Go to Reports</button>
                    </div>

                </div>

                <section class="mt-12">
                     <h2 class="text-2xl font-bold text-white mb-4">Key Performance Indicators</h2>
                     <div class="glass-card p-6 rounded-xl shadow-xl">
                        <p class="font-semibold mb-4">Detailed charts and resource utilization metrics.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-center">
                            <div class="p-3 bg-white/10 rounded-lg text-white">
                                <p class="text-3xl font-bold">95%</p>
                                <p class="text-sm">Avg. Satisfaction</p>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg text-white">
                                <p class="text-3xl font-bold">120</p>
                                <p class="text-sm">Today's Appointments</p>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg text-white">
                                <p class="text-3xl font-bold">4%</p>
                                <p class="text-sm">Cancellation Rate</p>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg text-white">
                                <p class="text-3xl font-bold">23</p>
                                <p class="text-sm">New Patients (Last 7D)</p>
                            </div>
                        </div>
                     </div>
                </section>
            </section> 

            <section id="doctors-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="stethoscope" class="w-8 h-8 mr-3"></i> Doctor Profiles & Management
                </h1>
                
                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="search" class="w-6 h-6 mr-2"></i> Doctor Search & Profile Overview</h2>
                    
                   <input type="text" id="doctorSearchInput" onkeyup="filterDoctorTable()" placeholder="Search by name, clinic, or department..." class="w-full p-3 mb-6 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    
                    <div class="overflow-x-auto">
                       <table id="doctorTable" class="min-w-full divide-y divide-white/30">
                            <thead class="bg-white/10 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Doctor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Specialty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Clinic/Center</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Rating</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/20 text-white">
                                <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Jihan</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Cardiology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Main Medical Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.8 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. jihan'); return false;">View Profile</a></td>
                                </tr>
                                <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Fardin</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Orthopedics</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">East Wing Clinic</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.5 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Fardin'); return false;">View Profile</a></td>
                                </tr>

                                <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. misbah</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">General Practice</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Pediatric Unit</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.9 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Misbah'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Kamal</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">General Practice</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Pediatric Unit</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.9 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Kamal'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Kamal</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">General Practice</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Pediatric Unit</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.9 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Kamal'); return false;">View Profile</a></td>
                                </tr>
                                <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Kamal</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Kamal'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. humayrah</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. humayra'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. riaz siddiqe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Riyaz Siddiqe'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Salman khan</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Salman Khan'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Eva chy</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Eva Chy'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Emon</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Emon'); return false;">View Profile</a></td>
                                </tr>
                                 <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Dr. Sajib</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neurology</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Neuroscience Center</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300 font-bold">4.1 <i data-lucide="star" class="w-4 h-4 inline fill-yellow-300"></i></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300" onclick="showDoctorProfileModal('Dr. Sajib'); return false;">View Profile</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="plus-circle" class="w-6 h-6 mr-2"></i> Add New Doctor</h2>
                        <form onsubmit="alert('Doctor Added!'); return false;" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Full Name</label>
                                <input type="text" placeholder="Dr. Jane Smith" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Specialty</label>
                                    <select required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                                        <option class="text-black" value="">Select Specialty</option>
                                        <option class="text-black">Cardiology</option>
                                        <option class="text-black">Orthopedics</option>
                                        <option class="text-black">Neurology</option>
                                        <option class="text-black">Pediatrics</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Clinic/Hospital</label>
                                    <input type="text" placeholder="Main Medical Center" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Contact Email</label>
                                <input type="email" placeholder="jane.smith@clinic.com" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <button type="submit" class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition w-full">Register Doctor</button>
                        </form>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="trending-up" class="w-6 h-6 mr-2"></i> Key Doctor Metrics</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Avg. Appointment Time</span>
                                <span class="font-bold text-white">18 min</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Most Booked Specialty</span>
                                <span class="font-bold text-white">Cardiology</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Doctors on Leave</span>
                                <span class="font-bold text-white">3</span>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-green text-white font-medium rounded-lg hover:bg-green-700 transition w-full">Manage Leaves</button>
                    </div>
                </div>
            </section>

            <section id="medicine-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="pill" class="w-8 h-8 mr-3"></i> Medicine Search & Inventory
                </h1>

                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <input type="text" id="medicineSearchInput" onkeyup="filterMedicineCards()" placeholder="Search by Medicine Name, Generic, or ID..." class="w-full md:w-2/3 p-3 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                        <select class="w-full md:w-1/3 p-3 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                            <option class="text-black">Filter by Category (e.g., Painkillers)</option>
                            <option class="text-black">Cardiology</option>
                            <option class="text-black">Antibiotics</option>
                            <option class="text-black">Vitamins</option>
                        </select>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                        <div class="text-white mb-3 sm:mb-0">
                            <span class="font-semibold mr-2">Price Range:</span> $0 - $100 
                            <input type="range" min="0" max="100" value="50" class="ml-2 w-32">
                        </div>
                        <div class="text-white">
                            <span class="font-semibold mr-2">Min Stock:</span> 
                            <select class="p-1 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white text-sm">
                                <option class="text-black">Any</option>
                                <option class="text-black">Low (Under 10)</option>
                                <option class="text-black">Critical (Under 3)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                        <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="20.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Paracetamol</p>
                                <h3 class="text-xl font-bold mb-1">PainAway Max (500mg)</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">5.99Tk / Strip (10 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('PainAway Max (500mg)');">View Details</button>
                            </div>
                        </div>

                        <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">Low Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Dextromethorphan</p>
                                <h3 class="text-xl font-bold mb-1">CoughRelief Extra</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">12.50Tk / Bottle (150ml)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('CoughRelief Extra');">View Details</button>
                            </div>
                        </div>

                        <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="26.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="25.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="22.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="21.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="20.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="22.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="20.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="21.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="26.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="25.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="26.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="25.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="28.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="25.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="26.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="25.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="24.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="22.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="22.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="26.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                         <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                          <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="27.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                            </div>
                        </div>
                        
                       
                        
                       
                      
                        
                        <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="https://source.unsplash.com/400x300/?injection,syringe" alt="Medicine F" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Metformin</p>
                                <h3 class="text-xl font-bold mb-1">GlucoControl Tabs</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">$15.75 / Pack (100 tabs)</p>
                            </div>
                            <div class="mt-auto">
                                <button class="mt-2 w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('GlucoControl Tabs');">View Details</button>
                            </div>
                        </div>

                    </div>
                    
                    <div class="mt-8 text-center text-white">
                        <p class="text-sm font-medium">Showing 6 of 45 products. <a href="#" class="text-yellow-300 hover:text-yellow-400">View All Stock</a></p>
                    </div>

                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="plus-circle" class="w-6 h-6 mr-2"></i> Add New Medicine Stock</h2>
                        <form onsubmit="alert('New Medicine Added!'); return false;" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Medicine Name (Trade)</label>
                                <input type="text" placeholder="PainAway Max" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Generic Name</label>
                                    <input type="text" placeholder="Paracetamol" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Quantity in Stock</label>
                                    <input type="number" placeholder="150" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Unit Price</label>
                                    <input type="number" step="0.01" placeholder="5.99" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Expiry Date</label>
                                    <input type="date" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                                </div>
                            </div>
                            <button type="submit" class="py-2 px-6 btn-primary-medicine text-white font-medium rounded-lg hover:opacity-90 transition w-full">Add to Inventory</button>
                        </form>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="bell" class="w-6 h-6 mr-2"></i> Low Stock Alerts</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between p-3 bg-red-800/50 rounded-lg">
                                <span class="text-white">AeroFlow Inhaler</span>
                                <span class="font-bold text-red-300">2 Units</span>
                            </div>
                            <div class="flex justify-between p-3 bg-yellow-800/50 rounded-lg">
                                <span class="text-white">CoughRelief Extra</span>
                                <span class="font-bold text-yellow-300">8 Bottles</span>
                            </div>
                            <div class="flex justify-between p-3 bg-yellow-800/50 rounded-lg">
                                <span class="text-white">Insulin Vials (Exp. Soon)</span>
                                <span class="font-bold text-yellow-300">12 Vials</span>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-medicine text-white font-medium rounded-lg hover:opacity-90 transition w-full">Generate Restock List</button>
                    </div>
                </div>
            </section>

            <section id="full-booking-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="calendar-check" class="w-8 h-8 mr-3"></i> Book Appointment
                </h1>

                <div class="glass-card p-6 rounded-xl shadow-xl mb-8">
                    <div class="flex justify-between items-center relative">
                        <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-600 -mt-px"></div>
                        
                        <div class="progress-step active relative flex flex-col items-center z-10 w-1/3">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mb-1">1</div>
                            <div class="step-label text-center text-xs sm:text-sm">Select Doctor</div>
                        </div>
                        
                        <div class="progress-step relative flex flex-col items-center z-10 w-1/3">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mb-1">2</div>
                            <div class="step-label text-center text-xs sm:text-sm">Select Slot</div>
                        </div>
                        
                        <div class="progress-step relative flex flex-col items-center z-10 w-1/3">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mb-1">3</div>
                            <div class="step-label text-center text-xs sm:text-sm">Patient Info</div>
                        </div>
                    </div>
                </div>
                
                <div class="glass-card p-6 rounded-xl shadow-xl">
                    
                    <div id="booking-step-1" class="booking-step">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="stethoscope" class="w-6 h-6 mr-2"></i> Step 1: Select Doctor
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. jihan, MD</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.8/5 (120 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Today, 3:00 PM**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>

                            <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. Fardin, MD</p>
                                    <p class="text-sm text-gray-300">Orthopedics | Rating: 4.5/5 (90 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Tomorrow, 9:00 AM**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>

                            <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. Misbah, MBBS</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>
                             <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. Kamal, MBBS</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>
                             <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. Salman khan, MBBS</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>
                             <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. humayra</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>
                             <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. Salman khan, MBBS</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>
                             <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. Riaz Siddiqe, MBBS</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>
                             <div class="p-4 bg-white/10 rounded-lg flex justify-between items-center border border-white/20">
                                <div>
                                    <p class="font-semibold text-white">Dr. kamal, MBBS</p>
                                    <p class="text-sm text-gray-300">Cardiology | Rating: 4.5/5 (88 Reviews)</p>
                                    <p class="text-sm text-green-300 font-medium">Next Available Slot: **Next Week, Tuesday**</p>
                                </div>
                                <button class="py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">Select Doctor</button>
                            </div>

                            <div class="p-4 bg-white/5 rounded-lg flex justify-between items-center border border-white/10 opacity-60">
                                <div>
                                    <p class="font-semibold text-white">Dr. emonn (Unavailable)</p>
                                    <p class="text-sm text-gray-400">Cardiology | Rating: 4.9/5</p>
                                    <p class="text-sm text-red-400 font-medium">Status: Currently booked out for 3 days.</p>
                                </div>
                                <button class="py-2 px-4 bg-gray-500 text-white font-medium rounded-lg cursor-not-allowed">Booked</button>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="showBookingStep(2)">Next: Select Slot</button>
                        </div>
                    </div>

                    <div id="booking-step-2" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="clock" class="w-6 h-6 mr-2"></i> Step 2: Choose Date and Time
                        </h2>
                        
                        <div class="p-6 mb-6 bg-white/10 rounded-lg shadow-inner">
                            <h3 class="text-xl font-semibold mb-4 text-white">Selected Doctor: Dr. Amelia Reed (Cardiology)</h3>
                            
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-white mb-1">Select Date</label>
                                <input type="date" value="2024-12-05" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                            </div>
                            
                            <p class="font-semibold text-sm mb-2 text-white">Morning Slots (Dec 5)</p>
                            <div class="grid grid-cols-3 md:grid-cols-4 gap-2 mb-4">
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">9:00 AM</button>
                                <button class="p-2 bg-gray-600 text-gray-200 rounded-lg cursor-not-allowed">9:30 AM (Booked)</button>
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">10:00 AM</button>
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">10:30 AM</button>
                            </div>

                            <p class="font-semibold text-sm mb-2 text-white">Afternoon Slots</p>
                            <div class="grid grid-cols-3 md:grid-cols-4 gap-2 mb-4">
                                <button class="p-2 btn-primary-pink text-white rounded-lg shadow-md font-bold transition">1:00 PM (Selected)</button>
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">1:30 PM</button>
                                <button class="p-2 bg-gray-600 text-gray-200 rounded-lg cursor-not-allowed">2:00 PM (Booked)</button>
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">2:30 PM</button>
                            </div>
                            
                            <p class="font-semibold text-sm mb-2 text-white">Late Afternoon Slots</p>
                            <div class="grid grid-cols-2 gap-2">
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">4:00 PM</button>
                                <button class="p-2 border border-white/30 rounded-lg hover:bg-white/20 transition text-white">4:30 PM</button>
                            </div>
                        </div>

                        <div class="flex justify-between mt-6">
                            <button class="py-2 px-6 bg-gray-500 text-white font-medium rounded-lg hover:bg-gray-600 transition" onclick="showBookingStep(1)">Back to Doctor Selection</button>
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="showBookingStep(3)">Next: Patient Info</button>
                        </div>
                    </div>

                    <div id="booking-step-3" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="user-round-plus" class="w-6 h-6 mr-2"></i> Step 3: Patient Information
                        </h2>
                        
                        <div class="p-6 bg-white/10 rounded-lg shadow-inner">
                            <h3 class="text-xl font-semibold mb-4 text-white">New Patient Details</h3>
                            <form onsubmit="return false;" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Full Name</label>
                                    <input type="text" placeholder="Patient Full Name" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Contact Phone</label>
                                    <input type="tel" placeholder="(555) 123-4567" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Email Address</label>
                                    <input type="email" placeholder="patient@email.com" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Reason for Visit</label>
                                    <select class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                                        <option class="text-black">New Symptoms/Checkup</option>
                                        <option class="text-black">Follow-up</option>
                                        <option class="text-black">Prescription Refill</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-white mb-1">Notes / Pre-existing Conditions</label>
                                    <textarea rows="3" placeholder="Briefly describe any relevant history..." class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300"></textarea>
                                </div>
                            </form>

                            <div class="mt-6 p-4 bg-red-800/50 rounded-lg text-white">
                                <p class="font-bold mb-1 flex items-center"><i data-lucide="alert-triangle" class="w-5 h-5 mr-2"></i> Important</p>
                                <p class="text-sm">Please ensure all required fields are filled before submitting the booking request.</p>
                            </div>
                        </div>

                        <div class="flex justify-between mt-6">
                            <button class="py-2 px-6 bg-gray-500 text-white font-medium rounded-lg hover:bg-gray-600 transition" onclick="showBookingStep(2)">Back to Slot Selection</button>
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="alert('Appointment Submitted! You will receive confirmation shortly.'); showPage('dashboard-content', document.getElementById('nav-dashboard'));">
                                Submit Appointment
                            </button>
                        </div>
                    </div>

                </div>
            </section>
            
            <section id="patients-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="user-round" class="w-8 h-8 mr-3"></i> Patient Records Management
                </h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="list-ordered" class="w-6 h-6 mr-2"></i> Patient List</h2>
                        <input 
                            type="text" 
                            id="patientSearchInput"
                            onkeyup="filterPatientTable()"
                            placeholder="Search Patient ID or Name..." 
                            class="w-full p-3 mb-6 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300"
                        >
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-white/20">
                                <thead class="bg-white/10 text-white">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Patient ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Last Visit</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="patientTableBody" class="divide-y divide-white/20 text-white">
                                    <tr class="hover:bg-white/10">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">P00101</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">Alice Johnson</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">2024-10-15</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                                    </tr>
                                    <tr class="hover:bg-white/10">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">P00102</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">Robert Smith</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">2024-11-20</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">2024-11-20</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                                    </tr>
                                    <tr class="hover:bg-white/10">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">P00103</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">Jane Doe</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">2024-11-28</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                                    </tr>
                                    <tr class="hover:bg-white/10">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">P00104</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">Michael Brown</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">2024-12-01</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <p class="text-sm text-gray-300">Showing 1 to 4 of 1245 results</p>
                            <button class="py-1 px-4 btn-primary-blue text-white font-medium rounded-lg hover:opacity-90 transition">Next Page</button>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="bar-chart-3" class="w-6 h-6 mr-2"></i> Quick Stats</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">New Patients (This Month)</span>
                                <span class="font-bold text-white">78</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Avg. Visit Frequency</span>
                                <span class="font-bold text-white">3.5 visits/year</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Most Common Diagnosis</span>
                                <span class="font-bold text-white">Flu</span>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-blue text-white font-medium rounded-lg hover:opacity-90 transition w-full">Register New Patient</button>
                    </div>
                </div>
            </section>
            <section id="ambulance-content" class="page-content">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
        <i data-lucide="ambulance" class="w-8 h-8 mr-3"></i> Emergency & Ambulance System
    </h1>

    <div class="glass-card p-6 rounded-xl shadow-xl mb-8 border border-red-500/30 bg-red-900/20">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-red-100 flex items-center">
                    <i data-lucide="siren" class="w-6 h-6 mr-2 animate-pulse"></i> EMERGENCY RESPONSE
                </h2>
                <p class="text-gray-200 mt-2">Need immediate assistance? Dispatch the nearest unit to your registered location.</p>
            </div>
            <button onclick="alert('SOS SIGNAL SENT! \nDispatching nearest unit to your location immediately.')" 
                    class="py-3 px-8 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 shadow-lg hover:shadow-red-500/50 transition transform hover:scale-105 flex items-center">
                <i data-lucide="phone-call" class="w-5 h-5 mr-2"></i> CALL SOS
            </button>
        </div>
    </div>

    <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
        <h2 class="text-xl font-semibold mb-4 text-white">Find an Ambulance</h2>
        <div class="flex flex-col md:flex-row gap-4">
            <input type="text" placeholder="Search by Area, Driver Name, or ID..." class="w-full p-3 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
            <select class="p-3 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white md:w-1/4">
                <option class="text-black" value="all">All Types</option>
                <option class="text-black" value="icu">ICU Support</option>
                <option class="text-black" value="freezer">Freezer Van</option>
                <option class="text-black" value="basic">Basic Life Support</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="glass-card p-5 rounded-xl shadow-lg hover:shadow-2xl transition border-t-4 border-t-red-500">
            <div class="flex justify-between items-start mb-3">
                <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wide">Available</span>
                <span class="text-gray-300 font-mono text-sm">ID: AMB-101</span>
            </div>
            <h3 class="text-xl font-bold text-white mb-1">ICU Cardiac Unit</h3>
            <p class="text-sm text-gray-300 mb-2">Number Plate: <span class="text-white font-medium">DHA-MET-5521</span></p>
            
            <div class="space-y-2 mt-4 mb-6">
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: Downtown Station
                </div>
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-223344
                </div>
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Rahim Uddin
                </div>
            </div>

            <button onclick="openBookingModal('AMB-101', 'ICU Cardiac Unit')" 
                    class="w-full py-2 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition">
                Book This Ambulance
            </button>
        </div>

        <div class="glass-card p-5 rounded-xl shadow-lg hover:shadow-2xl transition border-t-4 border-t-blue-500">
            <div class="flex justify-between items-start mb-3">
                <span class="bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wide">On Trip</span>
                <span class="text-gray-300 font-mono text-sm">ID: AMB-104</span>
            </div>
            <h3 class="text-xl font-bold text-white mb-1">Standard Life Support</h3>
            <p class="text-sm text-gray-300 mb-2">Number Plate: <span class="text-white font-medium">DHA-MET-8890</span></p>
            
            <div class="space-y-2 mt-4 mb-6">
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: North Sector
                </div>
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-556677
                </div>
                 <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Karim Hossain
                </div>
            </div>

            <button disabled class="w-full py-2 bg-gray-600 text-gray-300 font-medium rounded-lg cursor-not-allowed">
                Currently Busy
            </button>
        </div>

        <div class="glass-card p-5 rounded-xl shadow-lg hover:shadow-2xl transition border-t-4 border-t-green-500">
            <div class="flex justify-between items-start mb-3">
                <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wide">Available</span>
                <span class="text-gray-300 font-mono text-sm">ID: AMB-205</span>
            </div>
            <h3 class="text-xl font-bold text-white mb-1">AC Freezer Van</h3>
            <p class="text-sm text-gray-300 mb-2">Number Plate: <span class="text-white font-medium">DHA-MET-1100</span></p>
            
            <div class="space-y-2 mt-4 mb-6">
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: Hospital Garage
                </div>
                <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-998877
                </div>
                 <div class="flex items-center text-sm text-gray-200">
                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Sumon Khan
                </div>
            </div>

            <button onclick="openBookingModal('AMB-205', 'AC Freezer Van')" 
                    class="w-full py-2 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition">
                Book This Ambulance
            </button>
        </div>

    </div>
</section>

            <section id="reports-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="bar-chart-2" class="w-8 h-8 mr-3"></i> System Analytics & Reporting
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="calendar" class="w-5 h-5 mr-2"></i> Appointment Summary Report</h2>
                        <p class="mb-4">Detailed breakdown of appointments by date, doctor, and status (completed, canceled, no-show).</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="stethoscope" class="w-5 h-5 mr-2"></i> Doctor Performance Report</h2>
                        <p class="mb-4">Evaluate doctor performance based on patient load, patient ratings, and successful appointments.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="user-round" class="w-5 h-5 mr-2"></i> Patient Demographics & History Report</h2>
                        <p class="mb-4">Generate reports on patient age, gender distribution, common ailments, and total unique patients over time.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="pill" class="w-5 h-5 mr-2"></i> Inventory Stock & Expiry Report</h2>
                        <p class="mb-4">Crucial report for tracking stock levels, identifying expiring products, and managing procurement.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="credit-card" class="w-5 h-5 mr-2"></i> Financial & Billing Report</h2>
                        <p class="mb-4">Summary of successful/failed payments, total revenue generated, and outstanding bills by month/quarter.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="settings" class="w-5 h-5 mr-2"></i> System Audit & Access Log</h2>
                        <p class="mb-4">A record of all staff login, logout, and major system action events for security and compliance.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">View Logs</button>
                    </div>
                </div>

                <div class="mt-8 glass-card p-6 rounded-xl shadow-xl">
                    <h2 class="text-2xl font-bold mb-4">Report Generation History</h2>
                    <p class="mb-4">Recently generated or scheduled reports.</p>
                    <ul class="space-y-3">
                        <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center">
                            <span class="font-medium">Monthly Appointment Summary (Oct 2024)</span>
                            <a href="#" class="text-white hover:text-gray-300 font-semibold">Download PDF</a>
                        </li>
                        <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center">
                            <span class="font-medium">Cardiology Patient Rating (Q3)</span>
                            <a href="#" class="text-white hover:text-gray-300 font-semibold">Download Excel</a>
                        </li>
                    </ul>
                </div>

            </section>

            <section id="settings-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="settings" class="w-8 h-8 mr-3"></i> System Settings & Configuration
                </h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="users" class="w-6 h-6 mr-2"></i> User Account Management</h2>
                        <p class="mb-4 text-gray-300">Create, edit, or disable user accounts and manage staff roles and permissions.</p>
                        <form onsubmit="alert('New User Created!'); return false;" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Username</label>
                                <input type="text" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Password</label>
                                    <input type="password" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Assign Role</label>
                                    <select required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                                        <option class="text-black">Administrator</option>
                                        <option class="text-black">Doctor</option>
                                        <option class="text-black">Receptionist</option>
                                        <option class="text-black">Report Viewer</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="py-2 px-6 btn-primary-yellow text-white font-medium rounded-lg hover:bg-yellow-700 transition w-full">Create User</button>
                        </form>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> System Health</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Database Status</span>
                                <span class="font-bold text-green-300">Operational</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">API Response Time</span>
                                <span class="font-bold text-green-300">Fast (50ms)</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Disk Usage</span>
                                <span class="font-bold text-yellow-300">85% Full</span>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition w-full">Maintenance Console</button>
                    </div>

                </div>
                
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="shield" class="w-6 h-6 mr-2"></i> Security & Policy</h2>
                        <p class="mb-4">Manage access control, security protocols, and compliance requirements.</p>
                        <div class="space-y-3">
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">2FA Enforcement</span>
                                <span class="font-bold text-green-300">Active</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Data Encryption</span>
                                <span class="font-bold text-green-300">TLS/AES-256</span>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition w-full">View Security Logs</button>
                    </div>
                    
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="message-square" class="w-6 h-6 mr-2"></i> Recent Feedback</h2>
                        <div class="space-y-3 max-h-48 overflow-y-auto">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-white">Dr. Chen</span>
                                    <span class="text-yellow-300 font-bold">5/5 <i data-lucide="star" class="w-3 h-3 inline fill-yellow-300"></i></span>
                                </div>
                                <p class="text-gray-300 text-sm italic">"System update significantly improved loading times for patient history."</p>
                                <button class="mt-1 text-xs text-green-400 hover:text-green-300">Acknowledge</button>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-white">Dr. Carter</span>
                                    <span class="text-yellow-300 font-bold">4/5 <i data-lucide="star" class="w-3 h-3 inline fill-yellow-300"></i></span>
                                </div>
                                <p class="text-gray-300 text-sm italic">"Wait time was a bit long, but the consultation was thorough."</p>
                                <button class="mt-1 text-xs text-red-400 hover:text-red-300">Delete/Hide</button>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition w-full">View All Reviews</button>
                    </div>
                </div>

            </section>

        </main>
    </div>
    <div id="ambulance-booking-modal" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-[110]" onclick="closeBookingModal()">
    <div class="glass-card p-6 w-full max-w-lg mx-4 rounded-xl border border-white/20 shadow-2xl relative" onclick="event.stopPropagation()">
        
        <button onclick="closeBookingModal()" class="absolute top-4 right-4 text-white hover:text-red-400">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

        <h2 class="text-2xl font-bold text-white mb-1">Confirm Booking</h2>
        <p class="text-gray-300 text-sm mb-6">Booking for: <span id="modal-amb-name" class="font-bold text-yellow-300"></span> (<span id="modal-amb-id"></span>)</p>

        <form onsubmit="alert('Ambulance Booked Successfully! The driver will contact you shortly.'); closeBookingModal(); return false;" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-white mb-1">Pickup Location</label>
                <input type="text" required placeholder="Enter full address or landmark" class="w-full p-2 rounded-lg border border-white/30 bg-white/10 text-white focus:border-red-500 transition">
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-1">Contact Name</label>
                    <input type="text" required placeholder="Caller Name" class="w-full p-2 rounded-lg border border-white/30 bg-white/10 text-white focus:border-red-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-1">Phone Number</label>
                    <input type="tel" required placeholder="017..." class="w-full p-2 rounded-lg border border-white/30 bg-white/10 text-white focus:border-red-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white mb-1">Emergency Type / Notes</label>
                <textarea rows="3" placeholder="Describe the situation (e.g., Cardiac Arrest, Road Accident)..." class="w-full p-2 rounded-lg border border-white/30 bg-white/10 text-white focus:border-red-500 transition"></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition mt-2">
                CONFIRM AMBULANCE REQUEST
            </button>
        </form>
    </div>
</div>

<script>
    // Functions for Ambulance System
    function openBookingModal(id, name) {
        document.getElementById('modal-amb-id').innerText = id;
        document.getElementById('modal-amb-name').innerText = name;
        document.getElementById('ambulance-booking-modal').classList.remove('hidden');
    }

    function closeBookingModal() {
        document.getElementById('ambulance-booking-modal').classList.add('hidden');
    }
</script>

    <div id="doctor-profile-modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-[100]" onclick="closeDoctorProfileModal()">
        <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-sm sm:max-w-xl md:max-w-2xl text-white" onclick="event.stopPropagation()">
            <div class="relative bg-blue-800 h-32">
                <button class="absolute top-3 right-3 text-white hover:text-gray-400 transition z-20" onclick="document.getElementById('doctor-profile-modal').classList.add('hidden')">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
                <div class="absolute -bottom-16 left-6 z-10">
                    <img id="modal-doctor-image" src="https://via.placeholder.com/128x128.png?text=Dr+Pic" alt="Doctor Profile" class="w-32 h-32 rounded-full border-4 border-gray-800 shadow-lg object-cover">
                </div>
            </div>
            <div class="p-4 pt-16 md:p-6 max-h-[80vh] overflow-y-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-gray-600 pb-4 mb-4">
                    <div>
                        <h3 id="modal-doctor-name" class="text-3xl font-bold leading-tight">Doctor Name</h3>
                        <p id="modal-doctor-specialty" class="text-lg text-yellow-300 mt-1">Specialty</p>
                    </div>
                    <button class="mt-4 md:mt-0 py-2 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition">Book Appointment</button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <h4 class="text-xl font-semibold mb-2">Biography</h4>
                        <p id="modal-doctor-bio" class="text-gray-300 text-sm mb-4">A short biography of the doctor...</p>
                        
                        <h4 class="text-xl font-semibold mb-2 mt-4">Services Offered</h4>
                        <ul id="modal-doctor-services" class="list-disc list-inside space-y-1 text-sm ml-4 text-gray-300">
                            </ul>
                    </div>
                    <div class="space-y-3">
                        <div class="p-3 bg-white/10 rounded-lg">
                            <p class="font-bold mb-1">Experience</p>
                            <p id="modal-doctor-experience" class="text-sm text-gray-200">10+ years</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-lg">
                            <p class="font-bold mb-1">Education</p>
                            <p id="modal-doctor-education" class="text-sm text-gray-200">MD from University</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-lg">
                            <p class="font-bold mb-1">Languages</p>
                            <p id="modal-doctor-languages" class="text-sm text-gray-200">English, Spanish</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="medicine-details-modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-[100]" onclick="closeMedicineDetailsModal()">
        <div class="glass-card rounded-xl shadow-2xl w-full max-w-lg mx-4 text-white p-6" onclick="event.stopPropagation()">
            
            <div class="flex justify-between items-start border-b border-white/20 pb-4 mb-4">
                <div>
                    <h3 id="modal-medicine-name" class="text-3xl font-bold leading-tight">Medicine Name</h3>
                    <p id="modal-medicine-generic" class="text-lg font-medium text-yellow-300 mt-1">Generic: Generic Name</p>
                </div>
                <button class="text-white hover:text-gray-400 transition" onclick="closeMedicineDetailsModal()">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <div class="space-y-4 mb-6">
                <p id="modal-medicine-price" class="text-xl font-bold text-yellow-300">Price: $X.XX</p>
                <p id="modal-medicine-stock" class="text-md font-semibold text-green-400">Stock Status: In Stock</p>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-white/10 p-3 rounded-lg">
                        <p class="font-bold mb-1 flex items-center"><i data-lucide="calendar-x" class="w-4 h-4 mr-2 text-red-300"></i> Expire Date</p>
                        <p id="modal-medicine-expiry" class="text-gray-200">YYYY-MM-DD</p>
                    </div>
                    <div class="bg-white/10 p-3 rounded-lg">
                        <p class="font-bold mb-1 flex items-center"><i data-lucide="globe" class="w-4 h-4 mr-2 text-blue-300"></i> Origin</p>
                        <p id="modal-medicine-origin" class="text-gray-200">Country</p>
                    </div>
                </div>
                
                <div class="bg-white/10 p-3 rounded-lg">
                    <p class="font-bold mb-1 flex items-center"><i data-lucide="flask-conical" class="w-4 h-4 mr-2 text-purple-300"></i> Making Materials</p>
                    <p id="modal-medicine-materials" class="text-gray-200 text-sm">Main ingredients and components listed here.</p>
                </div>
            </div>

            <button class="w-full py-3 btn-primary-medicine text-white font-bold rounded-lg hover:opacity-90 transition" onclick="alert('Purchase initiated for ' + document.getElementById('modal-medicine-name').textContent);">
                <i data-lucide="shopping-cart" class="w-5 h-5 mr-2 inline"></i> Purchase Now
            </button>

        </div>
    </div>


    <script>
        // Data structure for doctor profiles (Existing)
        const DOCTOR_DATA = {
            'Dr. jihan': {
                name: 'Dr. jihan',
                title: 'Senior Cardiologist',
                bio: 'Dr. Reed is a highly respected cardiologist with extensive experience in preventative medicine and complex cardiac cases. She is committed to patient education and holistic health approaches.',
                education: 'MD from Columbia University',
                experience: '12+ years',
                specializations: 'Cardiology, Preventative Medicine',
                languages: 'English, German',
                image: 'e.jpg', // Placeholder image URL
                services: ['Cardiac Consultation', 'Echocardiography', 'Stress Testing', 'Vascular Screening']
            },
            'Dr. Fardin': {
                name: 'Dr. Fardin',
                title: 'Orthopedic Surgeon',
                bio: 'Dr. Carter specializes in complex joint replacement and sports injuries. He completed his fellowship at the Hospital for Special Surgery and has published numerous articles on minimally invasive surgery.',
                education: 'MD from Yale University',
                experience: '10+ years',
                specializations: 'Orthopedics, Sports Medicine, Joint Replacement',
                languages: 'English, Spanish',
                image: 'a.jpg', // Placeholder image URL
                services: ['Joint Consultation', 'Arthroscopy', 'Physical Therapy Referral', 'Surgical Consult']
            },
            'Dr. misbah': {
                name: 'Dr. Misbah',
                title: 'General Practice Pediatrician',
                bio: 'Dr. Diaz runs the Pediatric Unit and focuses on preventative care and wellness for children and adolescents. She is known for her compassionate approach.',
                education: 'MD from Stanford University',
                experience: '8 years',
                specializations: 'Pediatrics, General Practice',
                languages: 'English, French',
                image: 'b.jpg', // Placeholder image URL
                services: ['Routine Checkups', 'Vaccinations', 'Acute Illness Treatment', 'Developmental Screening']
            },
            'Dr. Kamal': {
                name: 'Dr. Kamal',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'op.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. Kamal': {
                name: 'Dr. Kamal',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'c.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. Kamal': {
                name: 'Dr. Kamal',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'd.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. humayra': {
                name: 'Dr. Humayra',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'e.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. Riyaz Siddiqe': {
                name: 'Dr. Riyaz Siddiqe',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'op.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. salman Khan': {
                name: 'Dr. Salman Khan',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'op.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. Eva Chy': {
                name: 'Dr. Eva chy',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'a.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. Emon': {
                name: 'Dr. Emon',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'b.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
              'Dr. Sajib': {
                name: 'Dr. Sajib',
                title: 'Neurologist',
                bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
                education: 'MD from Johns Hopkins',
                experience: '15+ years',
                specializations: 'Neurology, Headache Management, Epilepsy',
                languages: 'English, Mandarin',
                image: 'c.jpg', // Placeholder image URL (using a generic one for now)
                services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
            },
            // Add more doctor data here as needed
        };

        // Data structure for medicine details (New)
        const MEDICINE_DATA = {
            'PainAway Max (500mg)': {
                name: 'PainAway Max (500mg)',
                generic: 'Paracetamol',
                price: '$5.99 / Strip (10 pcs)',
                expiry: '2026-11-01',
                origin: 'India',
                
                materials: 'Acetaminophen (500mg), Starch, Magnesium Stearate',
                stock: 'In Stock'
            },
            'CoughRelief Extra': {
                name: 'CoughRelief Extra',
                generic: 'Dextromethorphan',
                price: '$12.50 / Bottle (150ml)',
                expiry: '2025-05-20',
                origin: 'USA',
                materials: 'Dextromethorphan HBr, Glycerin, Water, Flavoring Agents',
                stock: 'Low Stock'
            },
            'Amoxil-500 Cap': {
                name: 'Amoxil-500 Cap',
                generic: 'Amoxicillin',
                price: '$8.20 / Strip (8 pcs)',
                expiry: '2027-02-15',
                origin: 'UK',
                materials: 'Amoxicillin Trihydrate (500mg), Gelatin, Titanium Dioxide',
                stock: 'In Stock'
            },
            'VitaBoost Daily': {
                name: 'VitaBoost Daily',
                generic: 'Multivitamin',
                price: '$19.99 / Bottle (60 pcs)',
                expiry: '2028-09-30',
                origin: 'Germany',
                materials: 'Vitamin A, B-Complex, C, D, E, Minerals (Zinc, Iron, Calcium)',
                stock: 'In Stock'
            },
            'AeroFlow Inhaler': {
                name: 'AeroFlow Inhaler',
                generic: 'Salbutamol',
                price: '$24.00 / Unit',
                expiry: '2025-03-10',
                origin: 'Switzerland',
                materials: 'Salbutamol Sulfate, Propellant HFA 134a',
                stock: 'Critical'
            },
            'GlucoControl Tabs': {
                name: 'GlucoControl Tabs',
                generic: 'Metformin',
                price: '$15.75 / Pack (100 tabs)',
                expiry: '2026-07-25',
                origin: 'China',
                materials: 'Metformin Hydrochloride (850mg), Povidone, Hypromellose',
                stock: 'In Stock'
            }
        };

        // Function to control which page content is displayed (Existing)
        function showPage(pageId, navElement) {
            // Hide all pages
            document.querySelectorAll('.page-content').forEach(page => {
                page.style.display = 'none';
            });
            // Show the requested page
            const activePage = document.getElementById(pageId);
            if (activePage) {
                activePage.style.display = 'block';
            }
            
            // Remove active class from all nav links
            document.querySelectorAll('#main-nav a').forEach(nav => {
                nav.classList.remove('nav-active');
            });
            // Add active class to the clicked link
            if (navElement) {
                navElement.classList.add('nav-active');
            }
            
            // Re-render icons on the new page
            lucide.createIcons();
        }

        // Function to control the booking stepper (Existing)
        function showBookingStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.booking-step').forEach(step => {
                step.classList.add('hidden');
            });
            // Show the requested step
            const activeStep = document.getElementById(`booking-step-${stepNumber}`);
            if (activeStep) {
                activeStep.classList.remove('hidden');
            }

            // Update the progress bar
            document.querySelectorAll('.progress-step').forEach((step, index) => {
                step.classList.remove('active', 'done');
                if (index < stepNumber - 1) {
                    step.classList.add('done');
                } else if (index === stepNumber - 1) {
                    step.classList.add('active');
                }
            });

            // Re-render icons for the active step content
            lucide.createIcons();
        }

        // Function to show the detailed doctor profile modal (Existing)
        function showDoctorProfileModal(doctorName) {
            const data = DOCTOR_DATA[doctorName];
            if (!data) return;

            // 1. Populate standard fields
            document.getElementById('modal-doctor-name').textContent = data.name;
            document.getElementById('modal-doctor-specialty').textContent = data.title + ' - ' + data.specializations.split(',')[0].trim();
            document.getElementById('modal-doctor-bio').textContent = data.bio;
            document.getElementById('modal-doctor-education').textContent = data.education;
            document.getElementById('modal-doctor-experience').textContent = data.experience;
            document.getElementById('modal-doctor-languages').textContent = data.languages;
            document.getElementById('modal-doctor-image').src = data.image;

            // 2. Populate services list
            const servicesList = document.getElementById('modal-doctor-services');
            servicesList.innerHTML = ''; // Clear existing
            data.services.forEach(service => {
                const li = document.createElement('li');
                li.textContent = service;
                servicesList.appendChild(li);
            });

            // 3. Show the modal
            const modal = document.getElementById('doctor-profile-modal');
            modal.classList.remove('hidden');
            // Re-render icons inside the modal
            lucide.createIcons();
        }

        // Function to close the detailed doctor profile modal (Existing)
        function closeDoctorProfileModal() {
            document.getElementById('doctor-profile-modal').classList.add('hidden');
        }
        function filterDoctorTable() {
            const input = document.getElementById('doctorSearchInput'); 
            // Check if the input element exists (prevents crashes if ID is wrong)
            if (!input) return; 

            const filter = input.value.toUpperCase();
            const table = document.getElementById('doctorTable');
            // Check if the table element exists
            if (!table) return; 

            const tr = table.getElementsByTagName('tr');

            // Loop through all table rows, starting from index 1 to skip the header (thead)
            for (let i = 1; i < tr.length; i++) {
                let display = false;
                const tds = tr[i].getElementsByTagName('td');
                
                // Loop through the first four columns (Doctor, Specialty, Clinic, Rating)
                for (let j = 0; j < 4; j++) { 
                    if (tds[j]) {
                        // Check if the cell content matches the search filter
                        if (tds[j].textContent.toUpperCase().indexOf(filter) > -1) {
                            display = true;
                            break; // Found a match in this row, stop checking columns
                        }
                    }       
                }
                // Set the row display style
                tr[i].style.display = display ? '' : 'none';
            }
        }
        function openBookingModal(id, name) {
        document.getElementById('modal-amb-id').innerText = id;
        document.getElementById('modal-amb-name').innerText = name;
        document.getElementById('ambulance-booking-modal').classList.remove('hidden');
    }

    function closeBookingModal() {
        document.getElementById('ambulance-booking-modal').classList.add('hidden');
    }
        // Function to show the detailed medicine details modal (New)// Function to filter medicine inventory cards based on search input
function filterMedicineCards() {
    const input = document.getElementById('medicineSearchInput');
    const filter = input.value.toUpperCase();
    // Get the grid container for the medicine cards
    const grid = document.querySelector('#medicine-content .grid'); 
    // Get all medicine cards inside the grid
    // Note: 'glass-card' is used for the medicine items themselves
    const cards = grid ? grid.querySelectorAll('.glass-card') : []; 

    // Loop through all medicine cards
    for (let i = 0; i < cards.length; i++) {
        // Look for the elements containing the name (h3) and generic (p.text-sm) information
        const nameElement = cards[i].querySelector('h3'); 
        const genericElement = cards[i].querySelector('p.text-sm'); 

        let display = false;
        
        if (nameElement && genericElement) {
            const nameText = nameElement.textContent || nameElement.innerText;
            const genericText = genericElement.textContent || genericElement.innerText;
            
            // Check if either the name or generic text contains the filter value
            if (nameText.toUpperCase().indexOf(filter) > -1 || genericText.toUpperCase().indexOf(filter) > -1) {
                display = true;
            }
        }
        
        // Set the card display style (use 'flex' to maintain the grid layout)
        cards[i].style.display = display ? 'flex' : 'none';
    }
}
        function showMedicineDetailsModal(medicineName) {
            const data = MEDICINE_DATA[medicineName];
            if (!data) return;

            // 1. Populate fields
            document.getElementById('modal-medicine-name').textContent = data.name;
            document.getElementById('modal-medicine-generic').textContent = 'Generic: ' + data.generic;
            document.getElementById('modal-medicine-price').textContent = 'Price: ' + data.price;
            
            const stockElement = document.getElementById('modal-medicine-stock');
            stockElement.textContent = 'Stock Status: ' + data.stock;
            stockElement.classList.remove('text-green-400', 'text-yellow-300', 'text-red-400');
            if (data.stock === 'In Stock') {
                stockElement.classList.add('text-green-400');
            } else if (data.stock === 'Low Stock') {
                stockElement.classList.add('text-yellow-300');
            } else if (data.stock === 'Critical') {
                stockElement.classList.add('text-red-400');
            }
            
            document.getElementById('modal-medicine-expiry').textContent = data.expiry;
            document.getElementById('modal-medicine-origin').textContent = data.origin;
            document.getElementById('modal-medicine-materials').textContent = data.materials;

            // 2. Show the modal
            const modal = document.getElementById('medicine-details-modal');
            modal.classList.remove('hidden');
            // Re-render icons inside the modal
            lucide.createIcons();
        }

        // Function to close the detailed medicine details modal (New)
        function closeMedicineDetailsModal() {
            document.getElementById('medicine-details-modal').classList.add('hidden');
        }

        // NEW FUNCTION: Filter Patient Table
        function filterPatientTable() {
            // 1. Get the input value
            const input = document.getElementById('patientSearchInput');
            const filter = input.value.toUpperCase();
            
            // 2. Get the table rows
            const tableBody = document.getElementById('patientTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            // 3. Loop through rows and hide those that don't match
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const textContent = row.textContent || row.innerText;
                
                if (textContent.toUpperCase().indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }
     // Initial setup: Ensure the Doctors page is shown on load
window.onload = function() {
    // ...
    // LINE 472: Now points to the 'doctors-content' section
    showPage('doctors-content', document.getElementById('nav-doctors')); 
}

// Fallback for if window.onload isn't fast enough
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        // ...
        // LINE 479: Now points to the 'doctors-content' section
        showPage('doctors-content', document.getElementById('nav-doctors')); 
    });
}
    </script>
</body>
</html>