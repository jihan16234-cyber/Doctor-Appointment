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
                                </tr>...
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                    <div class="lg:col-span-1 glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="user-plus" class="w-6 h-6 mr-2"></i> Register New Doctor</h2>
                        <form onsubmit="alert('Doctor registered!'); return false;" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Full Name</label>
                                <input type="text" placeholder="Dr. Jane Smith" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                             <div>
                                <label class="block text-sm font-medium text-white mb-1">Specialty</label>
                                <input type="text" placeholder="Cardiologist" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                             <div>
                                <label class="block text-sm font-medium text-white mb-1">Clinic/Center</label>
                                <input type="text" placeholder="Main Medical Center" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                             <div>
                                <label class="block text-sm font-medium text-white mb-1">Contact Email</label>
                                <input type="email" placeholder="jane.smith@clinic.com" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <button type="submit" class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition w-full">Register Doctor</button>
                        </form>
                    </div>

                    <div class="lg:col-span-2 glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="trending-up" class="w-6 h-6 mr-2"></i> Key Doctor Metrics</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Total Active Doctors</span>
                                <span class="font-bold text-white">42</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Highest Rated Doctor</span>
                                <span class="font-bold text-yellow-300">Dr. Misbah (4.9)</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Busiest Department</span>
                                <span class="font-bold text-white">General Practice</span>
                            </div>
                            <div class="flex justify-between p-3 bg-white/10 rounded-lg">
                                <span class="text-white">Avg. Appointment Time</span>
                                <span class="font-bold text-white">25 Minutes</span>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            
            <section id="full-booking-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="calendar-check" class="w-8 h-8 mr-3"></i> Book Appointment
                </h1>
                
                <div class="glass-card p-6 rounded-xl shadow-xl">
                    
                    <div class="flex justify-between items-center mb-10 relative">
                        <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-600 transform -translate-y-1/2 z-0"></div>
                        <div id="progress-line-fill" class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-800 transform -translate-y-1/2 z-0 transition-all duration-500" style="width: 0%;"></div>

                        <div id="progress-step-1" class="progress-step active flex flex-col items-center">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold">1</div>
                            <p class="step-label text-xs mt-2 text-center">Select Doctor</p>
                        </div>

                        <div id="progress-step-2" class="progress-step flex flex-col items-center">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold">2</div>
                            <p class="step-label text-xs mt-2 text-center">Select Time</p>
                        </div>

                        <div id="progress-step-3" class="progress-step flex flex-col items-center">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold">3</div>
                            <p class="step-label text-xs mt-2 text-center">Patient Info</p>
                        </div>

                        <div id="progress-step-4" class="progress-step flex flex-col items-center">
                            <div class="step-number w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold">4</div>
                            <p class="step-label text-xs mt-2 text-center">Confirm</p>
                        </div>
                    </div>

                    <div id="booking-step-1" class="booking-step">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="stethoscope" class="w-6 h-6 mr-2"></i> Step 1: Select Doctor
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="glass-card p-4 rounded-xl shadow-lg border-2 border-transparent hover:border-yellow-400 cursor-pointer transition" 
                                 onclick="selectDoctor('Dr. Jihan', this)">
                                <h3 class="text-xl font-bold text-white">Dr. Jihan</h3>
                                <p class="text-white/70">Cardiologist</p>
                                <p class="text-yellow-300 font-medium mt-2">4.8 Rating</p>
                            </div>
                            <div class="glass-card p-4 rounded-xl shadow-lg border-2 border-transparent hover:border-yellow-400 cursor-pointer transition"
                                 onclick="selectDoctor('Dr. Fardin', this)">
                                <h3 class="text-xl font-bold text-white">Dr. Fardin</h3>
                                <p class="text-white/70">Orthopedics</p>
                                <p class="text-yellow-300 font-medium mt-2">4.5 Rating</p>
                            </div>
                            <div class="glass-card p-4 rounded-xl shadow-lg border-2 border-transparent hover:border-yellow-400 cursor-pointer transition"
                                 onclick="selectDoctor('Dr. Misbah', this)">
                                <h3 class="text-xl font-bold text-white">Dr. Misbah</h3>
                                <p class="text-white/70">Pediatrician</p>
                                <p class="text-yellow-300 font-medium mt-2">4.9 Rating</p>
                            </div>
                        </div>

                        <div class="mt-8 text-right">
                            <button id="next-step-1" class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg opacity-50 cursor-not-allowed transition" 
                                    onclick="showBookingStep(2)" disabled>Next: Select Time</button>
                        </div>
                    </div>

                    <div id="booking-step-2" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="clock" class="w-6 h-6 mr-2"></i> Step 2: Select Date & Time for <span id="selected-doctor-name" class="ml-2 text-yellow-300"></span>
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">Select Date</label>
                                <input type="date" id="appointment-date" required class="w-full p-3 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div id="time-slots-container">
                                <label class="block text-sm font-medium text-white mb-2">Available Time Slots</label>
                                <div class="grid grid-cols-3 gap-3" id="time-slots-grid">
                                    <button class="time-slot-btn p-3 bg-white/10 rounded-lg hover:bg-white/20 transition duration-150 text-white" onclick="selectTime('10:00 AM', this)">10:00 AM</button>
                                    <button class="time-slot-btn p-3 bg-white/10 rounded-lg hover:bg-white/20 transition duration-150 text-white" onclick="selectTime('11:30 AM', this)">11:30 AM</button>
                                    <button class="time-slot-btn p-3 bg-white/10 rounded-lg hover:bg-white/20 transition duration-150 text-white" onclick="selectTime('02:00 PM', this)">02:00 PM</button>
                                    <button class="time-slot-btn p-3 bg-white/10 rounded-lg hover:bg-white/20 transition duration-150 text-white" onclick="selectTime('03:30 PM', this)">03:30 PM</button>
                                    <button class="time-slot-btn p-3 bg-white/10 rounded-lg hover:bg-white/20 transition duration-150 text-white" onclick="selectTime('04:45 PM', this)">04:45 PM</button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition" onclick="showBookingStep(1)">Previous</button>
                            <button id="next-step-2" class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg opacity-50 cursor-not-allowed transition" 
                                    onclick="showBookingStep(3)" disabled>Next: Patient Info</button>
                        </div>
                    </div>

                    <div id="booking-step-3" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="user-round-plus" class="w-6 h-6 mr-2"></i> Step 3: Patient Information
                        </h2>
                        <div class="p-6 bg-white/10 rounded-lg shadow-inner">
                            <h3 class="text-xl font-semibold mb-4 text-white">New Patient Details</h3>
                            <form onsubmit="return false;" id="patient-info-form" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Full Name</label>
                                    <input type="text" id="patient-name" placeholder="Patient Full Name" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Contact Phone</label>
                                    <input type="tel" id="patient-phone" placeholder="(555) 123-4567" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Email Address (Optional)</label>
                                    <input type="email" id="patient-email" placeholder="patient@example.com" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Date of Birth</label>
                                    <input type="date" id="patient-dob" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-white mb-1">Reason for Visit</label>
                                    <textarea id="patient-reason" rows="3" placeholder="Briefly describe the symptoms or reason for the appointment." required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300"></textarea>
                                </div>
                            </form>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition" onclick="showBookingStep(2)">Previous</button>
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg transition" onclick="validateStep3()">Next: Confirm</button>
                        </div>
                    </div>

                    <div id="booking-step-4" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i> Step 4: Confirm Appointment
                        </h2>
                        
                        <div class="glass-card p-6 rounded-xl shadow-lg border-2 border-yellow-400">
                            <h3 class="text-xl font-bold text-white mb-4 border-b border-white/20 pb-2">Appointment Summary</h3>
                            <div class="space-y-3" id="confirmation-details">
                                </div>
                        </div>
                        
                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition" onclick="showBookingStep(3)">Previous</button>
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg transition" onclick="confirmBooking()">Finalize Booking</button>
                        </div>
                    </div>

                </div>
            </section>

            <section id="patients-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="user-round" class="w-8 h-8 mr-3"></i> Patient Records & History
                </h1>

                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="search" class="w-6 h-6 mr-2"></i> Patient Lookup</h2>
                    <input type="text" id="patientSearchInput" onkeyup="filterPatientTable()" placeholder="Search by ID or Name..." class="w-full p-3 mb-4 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    
                    <div class="flex items-center space-x-4 text-white">
                        <label for="filterStatus" class="text-sm">Filter by Status:</label>
                        <select id="filterStatus" class="p-2 rounded-lg bg-white/10 border border-white/20 text-white text-sm">
                            <option value="all">All Patients</option>
                            <option value="active">Active</option>
                            <option value="new">New (Last 30 days)</option>
                        </select>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl shadow-xl overflow-x-auto">
                    <h2 class="text-2xl font-semibold mb-4 text-white">Current Patient List</h2>
                    <table class="min-w-full divide-y divide-white/30">
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm">Bob Williams</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">2024-11-20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                            </tr>
                            <tr class="hover:bg-white/10">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">P00103</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">Charlie Davis</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">2024-12-01</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="glass-card p-6 rounded-xl shadow-xl mt-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="bar-chart-3" class="w-6 h-6 mr-2"></i> Patient Statistics</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="p-4 bg-white/10 rounded-lg">
                            <p class="text-3xl font-bold text-white">1245</p>
                            <p class="text-sm text-gray-300">Total Patients</p>
                        </div>
                        <div class="p-4 bg-white/10 rounded-lg">
                            <p class="text-3xl font-bold text-white">55%</p>
                            <p class="text-sm text-gray-300">Female Patients</p>
                        </div>
                        <div class="p-4 bg-white/10 rounded-lg">
                            <p class="text-3xl font-bold text-white">25</p>
                            <p class="text-sm text-gray-300">Avg. Age</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="medicine-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="pill" class="w-8 h-8 mr-3"></i> Medicine Inventory Management
                </h1>
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="relative w-full sm:w-1/3">
                        <input type="text" placeholder="Search for medicine..." class="w-full bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/80 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:border-white/50 transition duration-300">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    
                    <button class="bg-white/30 hover:bg-white/50 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add New Medicine
                    </button>
                </div>

                <div class="glass-card p-4 md:p-6 rounded-2xl shadow-xl overflow-x-auto">
                    <h2 class="text-2xl font-semibold text-white mb-4">Current Stock</h2>
                    <table class="min-w-full divide-y divide-white/20 text-white/90">
                        <thead>
                            <tr class="text-left">
                                <th class="px-4 py-3 text-xs font-medium uppercase tracking-wider">Medicine Name</th>
                                <th class="px-4 py-3 text-xs font-medium uppercase tracking-wider">Type/Category</th>
                                <th class="px-4 py-3 text-xs font-medium uppercase tracking-wider">Price (GHC)</th>
                                <th class="px-4 py-3 text-xs font-medium uppercase tracking-wider">Stock</th>
                                <th class="px-4 py-3 text-xs font-medium uppercase tracking-wider text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-medium">Paracetamol 500mg</td>
                                <td class="px-4 py-4 whitespace-nowrap text-white/70">Pain Relief</td>
                                <td class="px-4 py-4 whitespace-nowrap">5.50</td>
                                <td class="px-4 py-4 whitespace-nowrap"><span class="bg-green-600/50 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">345 units</span></td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <button class="text-blue-300 hover:text-blue-500 transition duration-150 mr-3">Edit</button>
                                    <button class="text-red-300 hover:text-red-500 transition duration-150">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-medium">Amoxicillin 250mg</td>
                                <td class="px-4 py-4 whitespace-nowrap text-white/70">Antibiotic</td>
                                <td class="px-4 py-4 whitespace-nowrap">12.00</td>
                                <td class="px-4 py-4 whitespace-nowrap"><span class="bg-yellow-600/50 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">45 units</span></td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <button class="text-blue-300 hover:text-blue-500 transition duration-150 mr-3">Edit</button>
                                    <button class="text-red-300 hover:text-red-500 transition duration-150">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-medium">Inhaler (Salbutamol)</td>
                                <td class="px-4 py-4 whitespace-nowrap text-white/70">Respiratory</td>
                                <td class="px-4 py-4 whitespace-nowrap">45.00</td>
                                <td class="px-4 py-4 whitespace-nowrap"><span class="bg-red-600/50 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">12 units</span></td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <button class="text-blue-300 hover:text-blue-500 transition duration-150 mr-3">Edit</button>
                                    <button class="text-red-300 hover:text-red-500 transition duration-150">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </section>


            <section id="ambulance-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="ambulance" class="w-8 h-8 mr-3"></i> Emergency Ambulance Services
                </h1>

                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="map-pin" class="w-6 h-6 mr-2"></i> Ambulance Dispatch Center</h2>
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-white/80">Monitor real-time status of all emergency vehicles.</p>
                        <button class="w-full md:w-auto py-2 px-6 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition">Dispatch Emergency Call</button>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl shadow-xl">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="car" class="w-6 h-6 mr-2"></i> Available Vehicles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-101 (Basic)</p>
                                <span class="text-sm font-semibold bg-green-500 text-white px-3 py-1 rounded-full">Available</span>
                            </div>
                            <p class="text-gray-300 mb-3">Standard medical transport with basic life support equipment.</p>
                            <div class="space-y-1 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: East Wing Parking
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-123456
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Karim Hossain
                                </div>
                            </div>
                            <button onclick="openBookingModal('AMB-101', 'Basic Life Support')" class="w-full py-2 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition"> Book This Ambulance </button>
                        </div>

                        <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-205 (Advanced)</p>
                                <span class="text-sm font-semibold bg-red-500 text-white px-3 py-1 rounded-full">Busy</span>
                            </div>
                            <p class="text-gray-300 mb-3">Equipped for critical care and advanced life support (ICU-level).</p>
                            <div class="space-y-1 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: En Route to City Hospital
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-654321
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Rina Akter
                                </div>
                            </div>
                            <button disabled class="w-full py-2 bg-gray-500 text-white font-medium rounded-lg opacity-70"> Currently Unavailable </button>
                        </div>

                        <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-303 (Neo-Natal)</p>
                                <span class="text-sm font-semibold bg-yellow-500 text-white px-3 py-1 rounded-full">Standby</span>
                            </div>
                            <p class="text-gray-300 mb-3">Specialized for safe transport of newborns and infants.</p>
                            <div class="space-y-1 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: Maternity Ward Standby
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-998877
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Jamil Ahmed
                                </div>
                            </div>
                            <button onclick="openBookingModal('AMB-303', 'Neo-Natal Transport')" class="w-full py-2 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition"> Book This Ambulance </button>
                        </div>

                    </div>
                </div>
            </section>

            <section id="reports-content" class="page-content">
                 <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="bar-chart-2" class="w-8 h-8 mr-3"></i> System Analytics & Reports
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="calendar" class="w-5 h-5 mr-2"></i> Appointment Summary Report</h2>
                        <p class="mb-4">Detailed breakdown of appointments by date, doctor, and status (completed, canceled, no-show).</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="user-round" class="w-5 h-5 mr-2"></i> Patient Demographics</h2>
                        <p class="mb-4">Reports on patient age, gender, geographic location, and most common specialties visited.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="trending-up" class="w-5 h-5 mr-2"></i> Financial & Billing Report</h2>
                        <p class="mb-4">Summary of doctor consultation fees, successful payments, failed payments, and outstanding balances.</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="history" class="w-6 h-6 mr-2"></i> Recent Report History</h2>
                        <p class="mb-4">Recently generated or scheduled reports.</p>
                        <ul class="space-y-3">
                            <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center hover:bg-white/20 transition">
                                <span class="font-medium text-white">Monthly Revenue (Dec 2024)</span>
                                <span class="text-sm text-gray-300">Generated 2 days ago</span>
                            </li>
                            <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center hover:bg-white/20 transition">
                                <span class="font-medium text-white">Doctor Performance Q4</span>
                                <span class="text-sm text-gray-300">Generated 1 week ago</span>
                            </li>
                            <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center hover:bg-white/20 transition">
                                <span class="font-medium text-white">Inventory Stock Status</span>
                                <span class="text-sm text-gray-300">Scheduled Daily</span>
                            </li>
                        </ul>
                        <button class="mt-6 py-2 px-6 btn-primary-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition w-full">View All History</button>
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

            <section id="settings-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="settings" class="w-8 h-8 mr-3"></i> System Settings
                </h1>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="glass-card p-6 rounded-xl shadow-xl lg:col-span-2">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="wrench" class="w-6 h-6 mr-2"></i> General Configuration</h2>
                        <form onsubmit="alert('General settings saved!'); return false;" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Clinic Name</label>
                                <input type="text" value="Heal Hub Clinic" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Default Currency</label>
                                <select class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                                    <option value="GHC">Ghanaian Cedi (GHC)</option>
                                    <option value="USD">US Dollar (USD)</option>
                                    <option value="EUR">Euro (EUR)</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="email-notifications" checked class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <label for="email-notifications" class="ml-2 block text-sm text-white">Enable Email Notifications for Appointments</label>
                            </div>
                            <button type="submit" class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition w-full">Save General Settings</button>
                        </form>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="shield-check" class="w-6 h-6 mr-2"></i> Security</h2>
                        <div class="space-y-3">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-medium text-white">Password Last Changed:</p>
                                <p class="text-sm text-gray-300">2024-11-01</p>
                            </div>
                            <button class="py-2 px-6 btn-primary-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition w-full">Change Password</button>
                            <button class="py-2 px-6 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition w-full">View Audit Logs</button>
                        </div>
                    </div>

                </div>
            </section>

        </main>
    </div>

    <div id="doctor-profile-modal" class="hidden fixed inset-0 bg-black/50 z-[90] flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl shadow-2xl max-w-lg w-full transform transition-all overflow-hidden text-white">
            <div class="p-6">
                <div class="flex justify-between items-start border-b border-gray-600 pb-4 mb-4">
                    <div>
                        <h2 id="modal-doctor-name" class="text-3xl font-bold mb-1">Dr. Jihan</h2>
                        <p id="modal-doctor-title" class="text-lg font-medium text-yellow-300">Cardiologist</p>
                    </div>
                    <button class="text-white hover:text-gray-400 transition" onclick="document.getElementById('doctor-profile-modal').classList.add('hidden')">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                    <div>
                        <span class="text-gray-400 font-medium">Experience:</span>
                        <p id="modal-doctor-experience" class="font-semibold">20+ years</p>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium">Education:</span>
                        <p id="modal-doctor-education" class="font-semibold">MD, Dhaka Medical College</p>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium">Specializations:</span>
                        <p id="modal-doctor-specializations" class="font-semibold">Cardiology, Arrhythmia Management</p>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium">Languages:</span>
                        <p id="modal-doctor-languages" class="font-semibold">Bangla, English</p>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="text-gray-400 font-medium block mb-1">Biography:</span>
                    <p id="modal-doctor-bio" class="text-sm text-gray-200 italic">Dr. Jihan is a leading expert in interventional and clinical cardiology. He specializes in complex arrhythmia management and preventative heart care.</p>
                </div>
                
                <div class="mb-6">
                    <span class="text-gray-400 font-medium block mb-1">Services Offered:</span>
                    <ul id="modal-doctor-services" class="list-disc list-inside text-sm text-gray-200 ml-4">
                        <li>Interventional Cardiology</li>
                        <li>ECG/Echo Review</li>
                        <li>Cardiac Consultation</li>
                    </ul>
                </div>

                <button class="w-full py-2 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition">Book Appointment</button>
            </div>
        </div>
    </div>
    
    <div id="medicine-details-modal" class="hidden fixed inset-0 bg-black/50 z-[90] flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl shadow-2xl max-w-md w-full transform transition-all overflow-hidden text-white">
            <div class="p-6">
                <div class="flex justify-between items-start border-b border-gray-600 pb-4 mb-4">
                    <div>
                        <h2 id="modal-medicine-name" class="text-3xl font-bold mb-1">PainAway Max (500mg)</h2>
                        <p id="modal-medicine-generic" class="text-lg font-medium text-yellow-300">Generic: Paracetamol</p>
                    </div>
                    <button class="text-white hover:text-gray-400 transition" onclick="document.getElementById('medicine-details-modal').classList.add('hidden')">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                    <div>
                        <span class="text-gray-400 font-medium">Unit Price:</span>
                        <p id="modal-medicine-price" class="font-semibold">5.00Tk / Strip (10 pcs)</p>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium">Stock Status:</span>
                        <p id="modal-medicine-stock" class="font-semibold text-red-400">Low Stock</p>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium">Expiry Date:</span>
                        <p id="modal-medicine-expiry" class="font-semibold">2026-11-01</p>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium">Origin:</span>
                        <p id="modal-medicine-origin" class="font-semibold">Bangladesh</p>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="text-gray-400 font-medium block mb-1">Key Ingredients:</span>
                    <p id="modal-medicine-materials" class="text-sm text-gray-200 italic">Paracetamol (500mg), Starch, Magnesium Stearate</p>
                </div>
                
                <button class="w-full py-2 btn-primary-medicine text-white font-medium rounded-lg transition">Edit Stock Details</button>
            </div>
        </div>
    </div>
    
    <div id="ambulance-booking-modal" class="hidden fixed inset-0 bg-black/50 z-[90] flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl shadow-2xl max-w-lg w-full transform transition-all overflow-hidden text-white">
            <div class="p-6">
                <div class="flex justify-between items-start border-b border-gray-600 pb-4 mb-4">
                    <div>
                        <h2 class="text-3xl font-bold mb-1">Book Ambulance</h2>
                        <p id="modal-ambulance-details" class="text-lg font-medium text-yellow-300">AMB-101 (Basic Life Support)</p>
                    </div>
                    <button class="text-white hover:text-gray-400 transition" onclick="closeBookingModal()">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <form onsubmit="alert('Ambulance Booked!'); closeBookingModal(); return false;" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Patient Name</label>
                        <input type="text" placeholder="Patient Name" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Pickup Location (Address)</label>
                        <textarea rows="2" placeholder="Full pickup address and landmark" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Destination Hospital</label>
                        <input type="text" placeholder="e.g., City General Hospital" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Emergency Contact Number</label>
                        <input type="tel" placeholder="(555) 555-5555" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    </div>
                    
                    <button type="submit" class="py-2 px-6 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition w-full">Confirm Booking & Dispatch</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        // --- DATA STRUCTURES (Simulated Database) ---
        const doctorData = {
            'Dr. Jihan': { name: 'Dr. Jihan', title: 'Cardiologist', bio: 'Dr. Jihan is a leading expert in interventional and clinical cardiology. He specializes in complex arrhythmia management and preventative heart care.', education: 'MD, Residency at Dhaka Medical College', experience: '20+ years', specializations: 'Cardiology, Arrhythmia Management, Preventative Heart Care', languages: 'Bangla, English', image: 'a.jpg', services: ['Interventional Cardiology', 'ECG/Echo Review', 'Stress Testing', 'Cardiac Consultation'] },
            'Dr. Fardin': { name: 'Dr. Fardin', title: 'Orthopedic Surgeon', bio: 'A specialist in orthopedic trauma and sports medicine, Dr. Fardin excels in minimally invasive surgical techniques and post-operative rehabilitation.', education: 'MBBS, MS Orthopedics', experience: '10+ years', specializations: 'Orthopedics, Sports Medicine, Trauma Surgery', languages: 'Bangla, English, Hindi', image: 'fardin.jpg', services: ['Joint Replacement Consultation', 'Arthroscopic Surgery', 'Fracture Management', 'Rehabilitation Planning'] },
            'Dr. Misbah': { name: 'Dr. Misbah', title: 'Pediatrician', bio: 'Dr. Misbah has a passion for child health, specializing in developmental disorders and general pediatric medicine. She provides compassionate care from newborns to adolescents.', education: 'MBBS, DCH', experience: '12 years', specializations: 'General Practice, Pediatric Unit', languages: 'Bangla, English', image: 'misbah.jpg', services: ['Well-Child Visits', 'Vaccination Scheduling', 'Developmental Assessments'] },
            'Dr. Kamal': { name: 'Dr. Kamal', title: 'General Practice', bio: 'Dr. Kamal provides comprehensive primary care for patients of all ages, focusing on preventive health and managing chronic conditions.', education: 'MBBS, FCPS', experience: '8+ years', specializations: 'General Practice', languages: 'Bangla, English', image: 'c.jpg', services: ['Annual Physicals', 'Flu Shots', 'Minor Injury Care'] },
            'Dr. humayrah': { name: 'Dr. humayrah', title: 'Neurologist', bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', education: 'MD from Johns Hopkins', experience: '15+ years', specializations: 'Neurology, Headache Management, Epilepsy', languages: 'English, Mandarin', image: 'c.jpg', // Placeholder image URL (using a generic one for now) services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] },
            'Dr. riaz siddiqe': { name: 'Dr. riaz siddiqe', title: 'Neurologist', bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', education: 'MD from Johns Hopkins', experience: '15+ years', specializations: 'Neurology, Headache Management, Epilepsy', languages: 'English, Mandarin', image: 'c.jpg', // Placeholder image URL (using a generic one for now) services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] },
            'Dr. Salman khan': { name: 'Dr. Salman khan', title: 'Neurologist', bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', education: 'MD from Johns Hopkins', experience: '15+ years', specializations: 'Neurology, Headache Management, Epilepsy', languages: 'English, Mandarin', image: 'c.jpg', // Placeholder image URL (using a generic one for now) services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] },
            'Dr. Eva chy': { name: 'Dr. Eva chy', title: 'Neurologist', bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', education: 'MD from Johns Hopkins', experience: '15+ years', specializations: 'Neurology, Headache Management, Epilepsy', languages: 'English, Mandarin', image: 'c.jpg', // Placeholder image URL (using a generic one for now) services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] },
            'Dr. Emon': { name: 'Dr. Emon', title: 'Neurologist', bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', education: 'MD from Johns Hopkins', experience: '15+ years', specializations: 'Neurology, Headache Management, Epilepsy', languages: 'English, Mandarin', image: 'c.jpg', // Placeholder image URL (using a generic one for now) services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] },
            'Dr. Sajib': { name: 'Dr. Sajib', title: 'Neurologist', bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', education: 'MD from Johns Hopkins', experience: '15+ years', specializations: 'Neurology, Headache Management, Epilepsy', languages: 'English, Mandarin', image: 'c.jpg', // Placeholder image URL (using a generic one for now) services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] },
        };

        const medicineDetails = {
            'PainAway Max': { name: 'PainAway Max', generic: 'Paracetamol', price: '5.00Tk / Strip (10 pcs)', expiry: '2026-11-01', origin: 'Bangladesh', materials: 'Paracetamol (500mg), Starch, Magnesium Stearate', stock: 'Low Stock' },
            'CoughRelief Extra': { name: 'CoughRelief Extra', generic: 'Dextromethorphan', price: '12.50Tk / Bottle (150ml)', expiry: '2025-05-20', origin: 'Bangladesh', materials: 'Dextromethorphan (20mg/5ml), Guaifenesin, Alcohol', stock: 'In Stock' },
            'Amoxil-500 Cap': { name: 'Amoxil-500 Cap', generic: 'Amoxicillin', price: '8.20Tk / Strip (8 pcs)', expiry: '2027-01-15', origin: 'UK', materials: 'Amoxicillin (500mg), Gelatin, Titanium Dioxide', stock: 'In Stock' },
            // Add more medicine data here as needed
        };

        // --- JS FUNCTIONS ---

        // Global variables for booking steps
        let selectedDoctor = null;
        let selectedTime = null;
        let selectedDate = null;

        // Function to switch between SPA pages
        function showPage(pageId, navElement) {
            // Hide all pages
            document.querySelectorAll('.page-content').forEach(page => {
                page.style.display = 'none';
            });

            // Show the selected page
            const activePage = document.getElementById(pageId);
            if (activePage) {
                activePage.style.display = 'block';
            }

            // Update active navigation link
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

        // Function to control the booking stepper
        function showBookingStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.booking-step').forEach(step => {
                step.classList.add('hidden');
            });
            // Remove active/done from all progress steps
            document.querySelectorAll('.progress-step').forEach(step => {
                step.classList.remove('active', 'done');
            });

            // Show the selected step
            const currentStepContent = document.getElementById('booking-step-' + stepNumber);
            if (currentStepContent) {
                currentStepContent.classList.remove('hidden');
            }

            // Update progress bar
            const steps = document.querySelectorAll('.progress-step');
            for (let i = 1; i <= steps.length; i++) {
                const step = document.getElementById('progress-step-' + i);
                if (i < stepNumber) {
                    step.classList.add('done');
                } else if (i === stepNumber) {
                    step.classList.add('active');
                }
            }

            // Update the progress line fill width (assuming 4 steps)
            const fillWidth = ((stepNumber - 1) / 3) * 100;
            document.getElementById('progress-line-fill').style.width = fillWidth + '%';

            // Re-render icons on the new step
            lucide.createIcons();
        }

        // Step 1: Doctor Selection Logic
        function selectDoctor(name, element) {
            selectedDoctor = name;
            document.querySelectorAll('#booking-step-1 .glass-card').forEach(card => {
                card.classList.remove('border-yellow-400');
            });
            element.classList.add('border-yellow-400');
            document.getElementById('next-step-1').classList.remove('opacity-50', 'cursor-not-allowed');
            document.getElementById('next-step-1').removeAttribute('disabled');
            document.getElementById('selected-doctor-name').textContent = name;
        }

        // Step 2: Time Selection Logic
        function selectTime(time, element) {
            selectedTime = time;
            document.querySelectorAll('.time-slot-btn').forEach(btn => {
                btn.classList.remove('bg-yellow-400', 'text-gray-900');
                btn.classList.add('bg-white/10', 'text-white');
            });
            element.classList.remove('bg-white/10', 'text-white');
            element.classList.add('bg-yellow-400', 'text-gray-900');
            
            document.getElementById('next-step-2').classList.remove('opacity-50', 'cursor-not-allowed');
            document.getElementById('next-step-2').removeAttribute('disabled');
        }
        
        // Step 2: Date Change Listener (Ensure date is selected)
        document.getElementById('appointment-date').addEventListener('change', (e) => {
            selectedDate = e.target.value;
            // Enable next step button if both date and time are selected
            if (selectedTime && selectedDate) {
                document.getElementById('next-step-2').classList.remove('opacity-50', 'cursor-not-allowed');
                document.getElementById('next-step-2').removeAttribute('disabled');
            }
        });

        // Step 3: Validation and Transition
        function validateStep3() {
            const form = document.getElementById('patient-info-form');
            if (form.checkValidity()) {
                // Populate confirmation details before moving to step 4
                populateConfirmation();
                showBookingStep(4);
            } else {
                // Trigger browser's native form validation UI
                form.reportValidity();
            }
        }

        // Step 4: Populate Confirmation Details
        function populateConfirmation() {
            const detailsDiv = document.getElementById('confirmation-details');
            
            const patientName = document.getElementById('patient-name').value;
            const patientPhone = document.getElementById('patient-phone').value;
            const patientEmail = document.getElementById('patient-email').value || 'N/A';
            const patientReason = document.getElementById('patient-reason').value;

            detailsDiv.innerHTML = `
                <p class="text-white/80"><span class="font-bold text-white">Doctor:</span> ${selectedDoctor}</p>
                <p class="text-white/80"><span class="font-bold text-white">Date:</span> ${selectedDate}</p>
                <p class="text-white/80"><span class="font-bold text-white">Time:</span> ${selectedTime}</p>
                <p class="text-white/80"><span class="font-bold text-white">Patient:</span> ${patientName}</p>
                <p class="text-white/80"><span class="font-bold text-white">Phone:</span> ${patientPhone}</p>
                <p class="text-white/80"><span class="font-bold text-white">Email:</span> ${patientEmail}</p>
                <p class="text-white/80"><span class="font-bold text-white">Reason:</span> ${patientReason}</p>
            `;
        }

        // Final Booking Function
        function confirmBooking() {
            alert(`Appointment confirmed with ${selectedDoctor} on ${selectedDate} at ${selectedTime}. Patient: ${document.getElementById('patient-name').value}`);
            // Reset state and return to dashboard
            selectedDoctor = null;
            selectedTime = null;
            selectedDate = null;
            document.getElementById('patient-info-form').reset();
            document.getElementById('next-step-1').classList.add('opacity-50', 'cursor-not-allowed');
            document.getElementById('next-step-1').setAttribute('disabled', 'disabled');
            showPage('dashboard-content', document.getElementById('nav-dashboard'));
        }

        // Function to open the Doctor Profile Modal
        function showDoctorProfileModal(name) {
            const data = doctorData[name];
            if (!data) return;

            document.getElementById('modal-doctor-name').textContent = data.name;
            document.getElementById('modal-doctor-title').textContent = data.title;
            document.getElementById('modal-doctor-experience').textContent = data.experience;
            document.getElementById('modal-doctor-education').textContent = data.education;
            document.getElementById('modal-doctor-specializations').textContent = data.specializations;
            document.getElementById('modal-doctor-languages').textContent = data.languages;
            document.getElementById('modal-doctor-bio').textContent = data.bio;
            
            const servicesList = document.getElementById('modal-doctor-services');
            servicesList.innerHTML = '';
            data.services.forEach(service => {
                const li = document.createElement('li');
                li.textContent = service;
                servicesList.appendChild(li);
            });

            document.getElementById('doctor-profile-modal').classList.remove('hidden');
            lucide.createIcons(); // Re-render icons inside the modal
        }
        
        // Function to open the Medicine Details Modal
        function showMedicineDetailsModal(name) {
            const data = medicineDetails[name];
            if (!data) return;

            document.getElementById('modal-medicine-name').textContent = data.name;
            document.getElementById('modal-medicine-generic').textContent = `Generic: ${data.generic}`;
            document.getElementById('modal-medicine-price').textContent = data.price;
            document.getElementById('modal-medicine-expiry').textContent = data.expiry;
            document.getElementById('modal-medicine-origin').textContent = data.origin;
            document.getElementById('modal-medicine-materials').textContent = data.materials;

            const stockElement = document.getElementById('modal-medicine-stock');
            stockElement.textContent = data.stock;
            stockElement.className = data.stock === 'Low Stock' ? 'font-semibold text-red-400' : 'font-semibold text-green-400';

            // 2. Show modal and re-render icons
            document.getElementById('medicine-details-modal').classList.remove('hidden');
            lucide.createIcons();
        }

        // Function to filter doctor table rows based on search input (Existing)
        function filterDoctorTable() {
            // 1. Get the input value
            const input = document.getElementById('doctorSearchInput');
            const filter = input.value.toUpperCase();
            // 2. Get the table rows
            const table = document.getElementById('doctorTable');
            const rows = table.getElementsByTagName('tr');

            // 3. Loop through rows (skip header row i=0) and hide those that don't match
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                // Get cells for Doctor Name (0), Specialty (1), Clinic (2)
                const nameCell = row.getElementsByTagName("td")[0]; 
                const specialtyCell = row.getElementsByTagName("td")[1];
                const clinicCell = row.getElementsByTagName("td")[2];

                if (nameCell && specialtyCell && clinicCell) {
                    const textValue = (nameCell.textContent || nameCell.innerText) + " " +
                                     (specialtyCell.textContent || specialtyCell.innerText) + " " +
                                     (clinicCell.textContent || clinicCell.innerText);
                    
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }       
            }
        }
        
        // Function to filter patient table rows based on search input (New)
        function filterPatientTable() {
            const input = document.getElementById('patientSearchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('patientTableBody');
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                // Get cells for Patient ID (0) and Name (1)
                const idCell = row.getElementsByTagName("td")[0]; 
                const nameCell = row.getElementsByTagName("td")[1];

                if (idCell && nameCell) {
                    const textValue = (idCell.textContent || idCell.innerText) + " " +
                                     (nameCell.textContent || nameCell.innerText);
                    
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }       
            }
        }

        // Ambulance Booking Modal Functions
        function openBookingModal(ambulanceId, details) {
            document.getElementById('modal-ambulance-details').textContent = `${ambulanceId} (${details})`;
            document.getElementById('ambulance-booking-modal').classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('ambulance-booking-modal').classList.add('hidden');
        }


     // Initial setup: Ensure the Dashboard page is shown on load (Changed from doctors-content)
window.onload = function() {
    // Check if a specific hash/URL fragment is present (optional: for external links)
    const initialPage = window.location.hash ? window.location.hash.substring(1) : 'dashboard-content';
    const initialNav = document.getElementById('nav-' + initialPage.replace('-content', ''));
    
    // Fallback to dashboard if a requested page/nav element doesn't exist
    if (document.getElementById(initialPage) && initialNav) {
        showPage(initialPage, initialNav);
    } else {
        showPage('dashboard-content', document.getElementById('nav-dashboard')); 
    }
}

// Fallback for if window.onload isn't fast enough
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        const initialPage = window.location.hash ? window.location.hash.substring(1) : 'dashboard-content';
        const initialNav = document.getElementById('nav-' + initialPage.replace('-content', ''));
        if (document.getElementById(initialPage) && initialNav) {
            showPage(initialPage, initialNav);
        } else {
             showPage('dashboard-content', document.getElementById('nav-dashboard')); 
        }
    });
}
    </script>

</body>
</html>