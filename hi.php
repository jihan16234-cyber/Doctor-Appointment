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

        /* New Order Button Style for medicine cards */
        .btn-order-now { background-color: #dc2626; } /* Tailwind red-600 */
        .btn-order-now:hover { background-color: #b91c1c; } /* Tailwind red-700 */

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

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="user-plus" class="w-6 h-6 mr-2"></i> Register New Doctor</h2>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Full Name</label>
                                    <input type="text" placeholder="Dr. Jane Smith" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Specialty</label>
                                    <input type="text" placeholder="Cardiologist" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                            </div>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Contact Phone</label>
                                    <input type="tel" placeholder="(555) 123-4567" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
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
                                <span class="text-white">Avg. Patient Rating</span>
                                <span class="font-bold text-yellow-300">4.6 / 5.0</span>
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
            
            <section id="full-booking-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="calendar-check" class="w-8 h-8 mr-3"></i> Book New Appointment
                </h1>
                
                <div class="glass-card p-6 rounded-xl shadow-xl">
                    <div class="mb-8 relative flex justify-between items-center">
                        <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-600 transform -translate-y-1/2 flex items-center">
                            <div id="progress-line-1" class="progress-line h-1 bg-gray-900 w-1/3 transition-all duration-500"></div>
                            <div id="progress-line-2" class="progress-line h-1 bg-gray-900 w-1/3 transition-all duration-500"></div>
                            <div id="progress-line-3" class="progress-line h-1 bg-gray-900 w-1/3 transition-all duration-500"></div>
                        </div>

                        <div id="progress-step-1" class="progress-step active flex flex-col items-center">
                            <span class="step-number w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold bg-black text-white">1</span>
                            <span class="step-label text-sm mt-1">Doctor</span>
                        </div>
                        <div id="progress-step-2" class="progress-step flex flex-col items-center">
                            <span class="step-number w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold bg-gray-600 text-white">2</span>
                            <span class="step-label text-sm mt-1">Date & Slot</span>
                        </div>
                        <div id="progress-step-3" class="progress-step flex flex-col items-center">
                            <span class="step-number w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold bg-gray-600 text-white">3</span>
                            <span class="step-label text-sm mt-1">Patient Info</span>
                        </div>
                        <div id="progress-step-4" class="progress-step flex flex-col items-center">
                            <span class="step-number w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold bg-gray-600 text-white">4</span>
                            <span class="step-label text-sm mt-1">Confirm</span>
                        </div>
                    </div>

                    <div id="booking-step-1" class="booking-step space-y-4">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center"><i data-lucide="user" class="w-5 h-5 mr-2"></i> Step 1: Select Doctor</h3>
                        
                        <div class="relative w-full max-w-lg mb-6">
                            <input type="text" id="appointment-doctor-search" placeholder="Search doctors by name, specialty, or clinic..."
                                   onkeyup="filterAppointmentDoctors()"
                                   class="w-full bg-white/20 backdrop-blur-sm text-white placeholder-white/80 border border-white/30 rounded-full py-3 pl-12 pr-4 transition duration-300 focus:outline-none focus:border-white focus:bg-white/30"
                                   style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-white/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="space-y-3" id="doctor-list-container">
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="dr-jihan.jpg" alt="Dr. Jihan" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Jihan Khan</p>
                                        <p class="text-sm text-gray-300">Cardiology - Main Center</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. Jihan Khan'); showBookingStep(2)">Select</button>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="dr-fardin.jpg" alt="Dr. Fardin" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Fardin</p>
                                        <p class="text-sm text-gray-300">Orthopedics - East Wing Clinic</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. Fardin'); showBookingStep(2)">Select</button>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="dr-misbah.jpg" alt="Dr. Misbah" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Misbah</p>
                                        <p class="text-sm text-gray-300">General Practice - Pediatric Unit</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. Misbah'); showBookingStep(2)">Select</button>
                            </div>
                             <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="c.jpg" alt="Dr. Kamal" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Kamal</p>
                                        <p class="text-sm text-gray-300">General Practice - Main Center</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. Kamal'); showBookingStep(2)">Select</button>
                            </div>
                             <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="c.jpg" alt="Dr. Humayrah" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Humayrah</p>
                                        <p class="text-sm text-gray-300">Neurology - Neuroscience Center</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. humayra'); showBookingStep(2)">Select</button>
                            </div>
                             <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="c.jpg" alt="Dr. Riyaz Siddiqe" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Riyaz Siddiqe</p>
                                        <p class="text-sm text-gray-300">Neurology - Neuroscience Center</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. riaz siddiqe'); showBookingStep(2)">Select</button>
                            </div>
                             <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="c.jpg" alt="Dr. Salman Khan" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Salman Khan</p>
                                        <p class="text-sm text-gray-300">Neurology - Neuroscience Center</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="selectDoctor('Dr. Salman khan'); showBookingStep(2)">Select</button>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition" onclick="alert('Please select a doctor first.')">Next Step &rarr;</button>
                        </div>
                    </div>

                    <div id="booking-step-2" class="booking-step space-y-4 hidden">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center"><i data-lucide="clock" class="w-5 h-5 mr-2"></i> Step 2: Select Date & Time</h3>
                        <div class="glass-card p-4 rounded-xl shadow-lg border border-white/30">
                            <p class="font-semibold text-white mb-2">Selected Doctor: <span id="selected-doctor-name" class="text-yellow-300">N/A</span></p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Select Date</label>
                                    <input type="date" id="appointment-date" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Available Slots (Time)</label>
                                    <select id="appointment-slot" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white">
                                        <option value="" disabled selected>Choose a time slot</option>
                                        <option value="9:00 AM">9:00 AM - 9:30 AM</option>
                                        <option value="9:30 AM">9:30 AM - 10:00 AM</option>
                                        <option value="10:00 AM">10:00 AM - 10:30 AM</option>
                                        <option value="10:30 AM">10:30 AM - 11:00 AM</option>
                                        <option value="1:00 PM">1:00 PM - 1:30 PM</option>
                                        <option value="1:30 PM">1:30 PM - 2:00 PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(1)">&larr; Previous</button>
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition" onclick="validateStep2()">Next Step &rarr;</button>
                        </div>
                    </div>

                    <div id="booking-step-3" class="booking-step space-y-4 hidden">
                         <h3 class="text-xl font-bold text-white mb-4 flex items-center"><i data-lucide="user-round-check" class="w-5 h-5 mr-2"></i> Step 3: Patient Information</h3>
                         <div class="glass-card p-4 rounded-xl shadow-lg border border-white/30">
                            <form id="patient-info-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                    <input type="email" placeholder="patient@example.com" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Date of Birth</label>
                                    <input type="date" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-black placeholder:text-gray-300">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-white mb-1">Brief Complaint/Reason for Visit</label>
                                    <textarea rows="3" placeholder="I have been experiencing chest pain..." required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300"></textarea>
                                </div>
                            </form>
                         </div>

                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(2)">&larr; Previous</button>
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition" onclick="validateStep3()">Next Step &rarr;</button>
                        </div>
                    </div>

                    <div id="booking-step-4" class="booking-step space-y-4 hidden">
                         <h3 class="text-xl font-bold text-white mb-4 flex items-center"><i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> Step 4: Confirm & Book</h3>
                         <div class="glass-card p-6 rounded-xl shadow-lg border border-white/30">
                            <h4 class="text-lg font-semibold text-white mb-4">Appointment Summary</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between border-b border-white/10 pb-2">
                                    <span class="text-gray-300">Doctor:</span>
                                    <span id="confirm-doctor" class="font-bold text-yellow-300">Dr. Jihan Khan</span>
                                </div>
                                <div class="flex justify-between border-b border-white/10 pb-2">
                                    <span class="text-gray-300">Date:</span>
                                    <span id="confirm-date" class="font-bold text-white">2025-12-25</span>
                                </div>
                                <div class="flex justify-between border-b border-white/10 pb-2">
                                    <span class="text-gray-300">Time:</span>
                                    <span id="confirm-time" class="font-bold text-white">9:00 AM - 9:30 AM</span>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <span class="text-white font-semibold">Appointment Fee:</span>
                                    <span class="font-bold text-green-400">100.00 Tk</span>
                                </div>
                            </div>
                         </div>
                        
                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="showBookingStep(3)">&larr; Previous</button>
                            <button class="py-2 px-6 btn-primary-green text-white font-medium rounded-lg hover:bg-green-700 transition">Finalize Booking</button>
                        </div>
                    </div>
                </div>

            </section>

            <section id="patients-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="user-round" class="w-8 h-8 mr-3"></i> Patient Records & History
                </h1>
                
                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                     <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="search" class="w-6 h-6 mr-2"></i> Search Patient & Overview</h2>
                    
                    <input type="text" id="patientSearchInput" onkeyup="filterPatientTable()" placeholder="Search by patient ID or name..." class="w-full p-3 mb-6 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">

                    <div class="overflow-x-auto">
                       <table id="patientTable" class="min-w-full divide-y divide-white/30">
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
                </div>

                 <div class="glass-card p-6 rounded-xl shadow-xl">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="folder-plus" class="w-6 h-6 mr-2"></i> Register New Patient</h2>
                    <form class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Full Name</label>
                                <input type="text" placeholder="Patient Full Name" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Date of Birth</label>
                                <input type="date" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-black placeholder:text-gray-300">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Contact Phone</label>
                                <input type="tel" placeholder="(555) 123-4567" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Email Address (Optional)</label>
                                <input type="email" placeholder="patient@example.com" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white mb-1">Address/City</label>
                            <input type="text" placeholder="123 Health Ave, City" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                        </div>
                        <button type="submit" class="py-2 px-6 btn-primary-blue text-white font-medium rounded-lg hover:bg-blue-700 transition w-full">Register Patient</button>
                    </form>
                </div>
            </section>
            
            <section id="medicine-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="pill" class="w-8 h-8 mr-3"></i> Pharmacy & Inventory Management
                </h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                            <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="box" class="w-6 h-6 mr-2"></i> Medicine Stock Overview</h2>
                            <input type="text" id="medicineSearchInput" onkeyup="filterMedicineCards()" placeholder="Search by medicine name or generic name..." class="w-full p-3 mb-6 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="medicine-card-container">
                                
                                <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                                    <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                        <img src="1.jpg" alt="PainAway Max" class="w-full h-full object-cover">
                                        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">Low Stock</span>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-300 font-medium">Generic: Ibuprofen</p>
                                        <h3 class="text-xl font-bold mb-1">PainAway Max</h3>
                                        <p class="text-lg font-bold text-yellow-300 mb-2">5.00Tk / Strip (10 pcs)</p>
                                    </div>
                                    <div class="mt-auto flex gap-2">
                                        <button class="w-1/2 py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('PainAway Max');">View Details</button>
                                        <a href="pay.php" class="w-1/2 text-center py-2 btn-order-now text-white font-medium rounded-lg transition flex items-center justify-center">Order Now</a>
                                    </div>
                                </div>
                                
                                <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                                    <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                        <img src="2.jpg" alt="CoughRelief Extra" class="w-full h-full object-cover">
                                        <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-300 font-medium">Generic: Dextromethorphan</p>
                                        <h3 class="text-xl font-bold mb-1">CoughRelief Extra</h3>
                                        <p class="text-lg font-bold text-yellow-300 mb-2">12.50Tk / Bottle (150ml)</p>
                                    </div>
                                    <div class="mt-auto flex gap-2">
                                        <button class="w-1/2 py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('CoughRelief Extra');">View Details</button>
                                        <a href="pay.php" class="w-1/2 text-center py-2 btn-order-now text-white font-medium rounded-lg transition flex items-center justify-center">Order Now</a>
                                    </div>
                                </div>

                                <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                                    <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                        <img src="23.jpg" alt="Amoxil-500 Cap" class="w-full h-full object-cover">
                                        <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">In Stock</span>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-300 font-medium">Generic: Amoxicillin</p>
                                        <h3 class="text-xl font-bold mb-1">Amoxil-500 Cap</h3>
                                        <p class="text-lg font-bold text-yellow-300 mb-2">8.20Tk / Strip (8 pcs)</p>
                                    </div>
                                    <div class="mt-auto flex gap-2">
                                        <button class="w-1/2 py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('Amoxil-500 Cap');">View Details</button>
                                        <a href="pay.php" class="w-1/2 text-center py-2 btn-order-now text-white font-medium rounded-lg transition flex items-center justify-center">Order Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="glass-card p-6 rounded-xl shadow-xl">
                            <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="plus-circle" class="w-6 h-6 mr-2"></i> Add New Medicine</h2>
                            <form class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-white mb-1">Medicine Name</label>
                                        <input type="text" placeholder="e.g., Aspirin" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-white mb-1">Generic Name</label>
                                        <input type="text" placeholder="e.g., Acetylsalicylic Acid" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-white mb-1">Quantity/Stock</label>
                                        <input type="number" placeholder="500 units" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-white mb-1">Unit Price (Tk)</label>
                                        <input type="number" step="0.01" placeholder="5.00" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                     <div>
                                        <label class="block text-sm font-medium text-white mb-1">Expiry Date</label>
                                        <input type="date" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-black placeholder:text-gray-300">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-white mb-1">Supplier/Origin</label>
                                        <input type="text" placeholder="Local Pharma / India" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Image URL (Optional)</label>
                                    <input type="url" placeholder="http://example.com/med.jpg" class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <button type="submit" class="py-2 px-6 btn-primary-medicine text-white font-medium rounded-lg hover:bg-indigo-700 transition w-full">Add Medicine to Inventory</button>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="glass-card p-6 rounded-xl shadow-xl">
                            <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="bell" class="w-6 h-6 mr-2"></i> Inventory Alerts</h2>
                            <div class="space-y-3">
                                <div class="p-3 bg-red-800/50 rounded-lg border border-red-500">
                                    <p class="font-bold text-white">PainAway Max</p>
                                    <p class="text-sm text-gray-200">Below minimum stock (Remaining: 15 units).</p>
                                </div>
                                <div class="p-3 bg-yellow-800/50 rounded-lg border border-yellow-500">
                                    <p class="font-bold text-white">Amoxil-500 Cap</p>
                                    <p class="text-sm text-gray-200">Expiry in 3 months (Batch XA23).</p>
                                </div>
                            </div>
                            <button class="mt-6 py-2 px-6 btn-primary-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition w-full">View All Alerts</button>
                        </div>
                    </div>
                </div>

            </section>
            
            <section id="ambulance-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="ambulance" class="w-8 h-8 mr-3"></i> Ambulance Service Management
                </h1>
                
                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="car" class="w-6 h-6 mr-2"></i> Available Vehicles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-001</p>
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">Available</span>
                            </div>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-green-400"></i> Location: Central Depot
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +88017XXXXXXXX
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Riaz
                                </div>
                            </div>
                            <button class="w-full py-2 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition" onclick="showBookingModal('AMB-001', 'Riaz')">Book Now</button>
                        </div>
                        
                        <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-002</p>
                                <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full">On Call</span>
                            </div>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-yellow-400"></i> Location: Near City Hospital
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +88017YYYYYYYY
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Emon
                                </div>
                            </div>
                            <button disabled class="w-full py-2 bg-gray-600 text-white font-medium rounded-lg cursor-not-allowed opacity-50"> Unavailable </button>
                        </div>
                        
                        <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-003</p>
                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">Maintenance</span>
                            </div>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: Maintenance Bay
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: N/A
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: N/A
                                </div>
                            </div>
                            <button disabled class="w-full py-2 bg-gray-600 text-white font-medium rounded-lg cursor-not-allowed opacity-50"> Unavailable </button>
                        </div>
                        
                    </div>
                </div>

            </section>
            
            <section id="reports-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="bar-chart-2" class="w-8 h-8 mr-3"></i> System Analytics & Reports
                </h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="calendar" class="w-5 h-5 mr-2"></i> Appointment Summary Report</h2>
                        <p class="mb-4">Detailed breakdown of appointments by date, doctor, and status (completed, canceled, no-show).</p>
                        <button class="py-2 px-4 btn-primary-red text-white rounded-lg hover:bg-red-600 transition w-full">Generate Report</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="user-round" class="w-5 h-5 mr-2"></i> Patient Demographics Report</h2>
                        <p class="mb-4">Analysis of patient data including age groups, most common conditions, and geographical spread.</p>
                        <button class="py-2 px-4 btn-primary-blue text-white rounded-lg hover:bg-blue-600 transition w-full">Generate Report</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="stethoscope" class="w-5 h-5 mr-2"></i> Doctor Performance Report</h2>
                        <p class="mb-4">Metrics on doctor booking rates, average consultation time, and patient satisfaction scores.</p>
                        <button class="py-2 px-4 btn-primary-indigo text-white rounded-lg hover:bg-indigo-600 transition w-full">Generate Report</button>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i data-lucide="pill" class="w-5 h-5 mr-2"></i> Inventory & Supply Report</h2>
                        <p class="mb-4">Reports on medicine stock levels, high-usage items, and upcoming expiry alerts.</p>
                        <button class="py-2 px-4 btn-primary-medicine text-white rounded-lg hover:bg-yellow-600 transition w-full">Generate Report</button>
                    </div>
                </div>
            </section>
            
            <section id="settings-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="settings" class="w-8 h-8 mr-3"></i> System & User Settings
                </h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="users" class="w-6 h-6 mr-2"></i> User & Access Management</h2>
                        <div class="space-y-4">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-bold text-white mb-1">Dr. Jihan Khan</p>
                                <p class="text-sm text-gray-300 mb-2">Role: Administrator / Full Access</p>
                                <button class="py-1 px-4 btn-primary-pink text-white rounded-lg hover:bg-pink-700 transition">Edit Role</button>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-bold text-white mb-1">Riaz Siddiqe</p>
                                <p class="text-sm text-gray-300 mb-2">Role: Nurse / Limited Patient Access</p>
                                <button class="py-1 px-4 btn-primary-pink text-white rounded-lg hover:bg-pink-700 transition">Edit Role</button>
                            </div>
                            <button class="mt-4 py-2 px-6 btn-primary-green text-white font-medium rounded-lg hover:bg-green-700 transition w-full">Add New User</button>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="database" class="w-6 h-6 mr-2"></i> System Maintenance</h2>
                        <div class="space-y-4">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-bold text-white mb-1">Database Backup</p>
                                <p class="text-sm text-gray-300 mb-2">Last backup: 1 hour ago. Recommended: Daily.</p>
                                <button class="py-1 px-4 btn-primary-yellow text-white rounded-lg hover:bg-yellow-700 transition">Run Backup Now</button>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-bold text-white mb-1">Clear Cache & Logs</p>
                                <p class="text-sm text-gray-300 mb-2">Frees up temporary storage space.</p>
                                <button class="py-1 px-4 btn-primary-red text-white rounded-lg hover:bg-red-700 transition">Clear Data</button>
                            </div>
                        </div>
                    </div>
                     <div class="glass-card p-6 rounded-xl shadow-xl lg:col-span-2">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="messages-square" class="w-6 h-6 mr-2"></i> Recent Feedback</h2>
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
                                <button class="mt-1 text-xs text-green-400 hover:text-green-300">Acknowledge</button>
                            </div>
                             <div class="p-3 bg-white/10 rounded-lg">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-white">Patient A.J.</span>
                                    <span class="text-yellow-300 font-bold">5/5 <i data-lucide="star" class="w-3 h-3 inline fill-yellow-300"></i></span>
                                </div>
                                <p class="text-gray-300 text-sm italic">"The new online booking system is very easy to use."</p>
                                <button class="mt-1 text-xs text-green-400 hover:text-green-300">Acknowledge</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
        <div id="doctor-profile-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="glass-card rounded-xl shadow-2xl max-w-xl w-full transform transition-all overflow-hidden text-white border border-white/20">
                <div class="p-6 border-b border-white/20 flex justify-between items-center">
                    <h2 class="text-2xl font-bold" id="modal-doctor-name">Doctor Name</h2>
                    <button class="text-white hover:text-gray-300" onclick="closeDoctorProfileModal()">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-6">
                    <div class="flex items-start space-x-6 mb-4">
                        <img id="modal-doctor-image" src="" alt="Doctor Image" class="w-24 h-24 rounded-full object-cover border-4 border-yellow-300/50 shadow-lg">
                        <div>
                            <p class="text-xl font-semibold text-yellow-300" id="modal-doctor-title">Title</p>
                            <p class="text-lg text-gray-300" id="modal-doctor-specialization">Specialization</p>
                            <p class="text-md text-gray-400" id="modal-doctor-experience">Experience</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-300 mb-4 italic" id="modal-doctor-bio">Doctor biography...</p>

                    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                        <div>
                            <span class="text-gray-400 font-medium">Education:</span>
                            <p class="font-semibold" id="modal-doctor-education">MBBS, MD</p>
                        </div>
                        <div>
                            <span class="text-gray-400 font-medium">Languages:</span>
                            <p class="font-semibold" id="modal-doctor-languages">English, Hindi</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold border-b border-white/20 pb-1 mb-2">Key Services</h3>
                    <ul id="modal-doctor-services" class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        </ul>
                </div>

                <div class="p-6 border-t border-white/20 flex justify-end">
                    <button class="py-2 px-6 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="closeDoctorProfileModal()">Close</button>
                </div>
            </div>
        </div>

        <div id="medicine-details-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="glass-card rounded-xl shadow-2xl max-w-md w-full transform transition-all overflow-hidden text-white border border-white/20">
                <div class="p-6 border-b border-white/20 flex justify-between items-center">
                    <h2 class="text-2xl font-bold" id="modal-medicine-name">Medicine Name</h2>
                    <button class="text-white hover:text-gray-300" onclick="closeMedicineDetailsModal()">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-6">
                    <img id="modal-medicine-image" src="" alt="Medicine Image" class="w-full h-40 object-cover rounded-lg mb-4 shadow-md">
                    
                    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                        <div>
                            <span class="text-gray-400 font-medium">Generic:</span>
                            <p id="modal-medicine-generic" class="font-semibold">Ibuprofen</p>
                        </div>
                        <div>
                            <span class="text-gray-400 font-medium">Price:</span>
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
                            <p id="modal-medicine-origin" class="font-semibold">India</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold border-b border-gray-700 pb-1 mb-2">Key Ingredients</h3>
                    <p id="modal-medicine-materials" class="text-sm text-gray-300 mb-6">Active ingredients listed here.</p>

                    <a href="pay.php" class="w-full text-center py-3 btn-order-now text-white font-medium rounded-lg transition hover:shadow-lg flex items-center justify-center text-lg">
                        Order Now (Proceed to Payment)
                    </a>
                </div>
            </div>
        </div>
        
        <div id="ambulance-booking-modal" class="hidden fixed inset-0 bg-black/50 z-[90] flex items-center justify-center p-4">
            <div class="bg-gray-800 rounded-xl shadow-2xl max-w-lg w-full transform transition-all overflow-hidden text-white p-6">
                <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
                    <h2 class="text-2xl font-bold">Book Ambulance</h2>
                    <button class="text-gray-300 hover:text-white" onclick="closeBookingModal()">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div class="bg-white/10 p-3 rounded-lg">
                        <p class="text-lg font-semibold mb-1">Ambulance ID: <span id="modal-ambulance-id" class="text-yellow-300">AMB-001</span></p>
                        <p class="text-sm">Driver: <span id="modal-ambulance-driver">Riaz</span></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Patient Name</label>
                        <input type="text" placeholder="Full Name" required class="w-full p-2 rounded-lg border-2 border-gray-600 focus:border-indigo-500 transition bg-gray-700 text-white placeholder:text-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Pickup Location (Address/Area)</label>
                        <input type="text" placeholder="e.g., House 10, Road 5, Mirpur" required class="w-full p-2 rounded-lg border-2 border-gray-600 focus:border-indigo-500 transition bg-gray-700 text-white placeholder:text-gray-400">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Contact Phone</label>
                            <input type="tel" placeholder="+8801XXXXXXXXX" required class="w-full p-2 rounded-lg border-2 border-gray-600 focus:border-indigo-500 transition bg-gray-700 text-white placeholder:text-gray-400">
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Emergency Level</label>
                            <select class="w-full p-2 rounded-lg border-2 border-gray-600 focus:border-indigo-500 transition bg-gray-700 text-white">
                                <option value="urgent">Urgent</option>
                                <option value="standard" selected>Standard</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Destination Hospital (Optional)</label>
                        <input type="text" placeholder="e.g., Main Medical Center" class="w-full p-2 rounded-lg border-2 border-gray-600 focus:border-indigo-500 transition bg-gray-700 text-white placeholder:text-gray-400">
                    </div>
                    
                    <button type="submit" class="w-full py-3 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition mt-4">Confirm Ambulance Booking</button>
                </form>
            </div>
        </div>

    </div> 
<script>
    // Data Structure for Doctor Profiles (used by modal)
    const doctorData = {
        'Dr. Jihan Khan': {
            name: 'Dr. Jihan Khan',
            title: 'Cardiologist',
            bio: 'Dr. Jihan is a leading expert in cardiac health, specializing in interventional cardiology and cardiac rhythm disorders. He is committed to providing the highest level of patient care.',
            education: 'MBBS, MD (Cardiology)',
            experience: '18 years',
            specializations: 'Cardiology, Interventional Procedures',
            languages: 'Bangla, English, Urdu',
            image: 'dr-jihan.jpg',
            services: ['Cardiac Consultation', 'ECG Analysis', 'Angiography', 'Stent Placement']
        },
        'Dr. Fardin': {
            name: 'Dr. Fardin',
            title: 'Orthopedic Surgeon',
            bio: 'A compassionate surgeon focused on restoring mobility and function. Dr. Fardin specializes in joint replacement and sports injuries.',
            education: 'MBBS, MS (Orthopedics)',
            experience: '15 years',
            specializations: 'Orthopedics, Joint Replacement, Sports Medicine',
            languages: 'Bangla, English, Hindi',
            image: 'dr-fardin.jpg',
            services: ['Joint Replacement Consultation', 'Arthroscopic Surgery', 'Fracture Management', 'Rehabilitation Planning']
        },
        'Dr. Misbah': {
            name: 'Dr. Misbah',
            title: 'Pediatrician',
            bio: 'Dr. Misbah has a passion for child health, specializing in developmental disorders and general pediatric medicine. She provides compassionate care from newborns to adolescents.',
            education: 'MBBS, DCH',
            experience: '12 years',
            specializations: 'General Practice, Pediatric Unit',
            languages: 'Bangla, English',
            image: 'dr-misbah.jpg',
            services: ['Well-Child Visits', 'Vaccination Scheduling', 'Developmental Assessments', 'Sick Child Care']
        },
        'Dr. Kamal': {
            name: 'Dr. Kamal',
            title: 'General Practitioner',
            bio: 'A reliable GP offering comprehensive first-line care for a wide range of acute and chronic conditions.',
            education: 'MBBS, Family Medicine Certification',
            experience: '8 years',
            specializations: 'General Practice',
            languages: 'Bangla, English',
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Routine Checkups', 'Minor Illness Treatment', 'Health Screening', 'Referral Services']
        },
        'Dr. humayra': {
            name: 'Dr. Humayrah',
            title: 'Neurologist',
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
            education: 'MD from Johns Hopkins',
            experience: '15+ years',
            specializations: 'Neurology, Headache Management, Epilepsy',
            languages: 'English, Mandarin',
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
        },
         'Dr. riaz siddiqe': {
            name: 'Dr. riaz siddiqe',
            title: 'Neurologist',
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
            education: 'MD from Johns Hopkins',
            experience: '15+ years',
            specializations: 'Neurology, Headache Management, Epilepsy',
            languages: 'English, Mandarin',
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
        },
         'Dr. Salman khan': {
            name: 'Dr. Salman khan',
            title: 'Neurologist',
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
            education: 'MD from Johns Hopkins',
            experience: '15+ years',
            specializations: 'Neurology, Headache Management, Epilepsy',
            languages: 'English, Mandarin',
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment']
        },
         'Dr. Eva chy': {
            name: 'Dr. Eva chy',
            title: 'Neurologist',
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.',
            education: 'MD from Johns Hopkins',
            experience: '15+ years',
            specializations: 'Neurology, Headache Management, Epilepsy',
            languages: 'English, Mandarin',
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
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
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
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
    };
    
    // Data Structure for Medicine Profiles (used by modal)
    const medicineData = {
        'PainAway Max': {
            name: 'PainAway Max',
            generic: 'Ibuprofen',
            price: '5.00Tk / Strip (10 pcs)',
            stock: 'Low Stock',
            expiry: '2025-06-01',
            origin: 'Bangladesh',
            image: '1.jpg',
            materials: '400mg Ibuprofen, Microcrystalline Cellulose, Magnesium Stearate.'
        },
        'CoughRelief Extra': {
            name: 'CoughRelief Extra',
            generic: 'Dextromethorphan',
            price: '12.50Tk / Bottle (150ml)',
            stock: 'In Stock',
            expiry: '2026-11-01',
            origin: 'India',
            image: '2.jpg',
            materials: 'Dextromethorphan HBr, Guaifenesin, Purified Water.'
        },
         'Amoxil-500 Cap': {
            name: 'Amoxil-500 Cap',
            generic: 'Amoxicillin',
            price: '8.20Tk / Strip (8 pcs)',
            stock: 'In Stock',
            expiry: '2027-03-20',
            origin: 'Bangladesh',
            image: '23.jpg',
            materials: 'Amoxicillin Trihydrate equivalent to Amoxicillin 500mg.'
        }
    };

    // Global variable to store selected doctor for booking
    let selectedDoctor = null;

    // Function to switch between pages/sections (Existing)
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
        
        // Special case for booking page: ensure step 1 is shown
        if (pageId === 'full-booking-content') {
            showBookingStep(1); 
        }
    }
    
    // Function to select a doctor for booking (New)
    function selectDoctor(doctorName) {
        selectedDoctor = doctorName;
        document.getElementById('selected-doctor-name').textContent = doctorName;
        document.getElementById('confirm-doctor').textContent = doctorName;
    }

    // Function to validate Step 2 of booking (New)
    function validateStep2() {
        const date = document.getElementById('appointment-date').value;
        const slot = document.getElementById('appointment-slot').value;

        if (!selectedDoctor) {
             alert('Please select a doctor first.');
             return;
        }
        if (!date || !slot) {
            alert('Please select a date and time slot.');
            return;
        }

        document.getElementById('confirm-date').textContent = date;
        document.getElementById('confirm-time').textContent = slot;

        showBookingStep(3);
    }
    
     // Function to validate Step 3 of booking (New)
    function validateStep3() {
        const form = document.getElementById('patient-info-form');
        // Basic form validation check (since there's no actual submission, this is symbolic)
        const isFormValid = form.checkValidity();

        if (!isFormValid) {
            alert('Please fill out all required patient information fields.');
            form.reportValidity(); // Triggers browser's default validation messages
            return;
        }

        // For a real system, you would submit data here before going to step 4
        showBookingStep(4);
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

        // Update progress bar
        document.querySelectorAll('.progress-step').forEach(step => {
            step.classList.remove('active', 'done');
        });

        for (let i = 1; i <= 4; i++) {
            const stepElement = document.getElementById(`progress-step-${i}`);
            if (i < stepNumber) {
                stepElement.classList.add('done');
            } else if (i === stepNumber) {
                stepElement.classList.add('active');
            }
        }
        
        // Manually update the progress line width
        const progressLines = [
            { id: 'progress-line-1', step: 2 }, 
            { id: 'progress-line-2', step: 3 }, 
            { id: 'progress-line-3', step: 4 }
        ];
        
        progressLines.forEach(line => {
            const lineElement = document.getElementById(line.id);
            if (stepNumber > line.step) {
                lineElement.style.backgroundColor = 'var(--color-dark-black)';
            } else {
                lineElement.style.backgroundColor = '#555555'; // Use a darker color for incomplete
            }
        });
        
        // Create icons for the newly visible step
        lucide.createIcons();
    }

    // Function to show the Doctor Profile Modal (Existing)
    function showDoctorProfileModal(doctorName) {
        const data = doctorData[doctorName];
        if (!data) return;

        // 1. Populate modal fields
        document.getElementById('modal-doctor-name').textContent = data.name;
        document.getElementById('modal-doctor-title').textContent = data.title;
        document.getElementById('modal-doctor-specialization').textContent = data.specializations;
        document.getElementById('modal-doctor-experience').textContent = `Experience: ${data.experience}`;
        document.getElementById('modal-doctor-bio').textContent = data.bio;
        document.getElementById('modal-doctor-education').textContent = data.education;
        document.getElementById('modal-doctor-languages').textContent = data.languages;
        document.getElementById('modal-doctor-image').src = data.image;

        // 2. Populate services list
        const servicesList = document.getElementById('modal-doctor-services');
        servicesList.innerHTML = '';
        data.services.forEach(service => {
            const li = document.createElement('li');
            li.textContent = service;
            servicesList.appendChild(li);
        });

        // 3. Show the modal
        document.getElementById('doctor-profile-modal').classList.remove('hidden');
        lucide.createIcons(); // Re-render icons inside the modal
    }

    // Function to close the Doctor Profile Modal (Existing)
    function closeDoctorProfileModal() {
        document.getElementById('doctor-profile-modal').classList.add('hidden');
    }

    // Function to show the Medicine Details Modal (Existing)
    function showMedicineDetailsModal(medicineName) {
        const data = medicineData[medicineName];
        if (!data) return;

        // 1. Populate modal fields
        document.getElementById('modal-medicine-name').textContent = data.name;
        document.getElementById('modal-medicine-generic').textContent = data.generic;
        document.getElementById('modal-medicine-price').textContent = data.price;
        document.getElementById('modal-medicine-stock').textContent = data.stock;
        document.getElementById('modal-medicine-expiry').textContent = data.expiry;
        document.getElementById('modal-medicine-origin').textContent = data.origin;
        document.getElementById('modal-medicine-image').src = data.image;
        document.getElementById('modal-medicine-materials').textContent = data.materials;
        
        // Update stock color
        if (data.stock === 'Low Stock') {
             document.getElementById('modal-medicine-stock').classList.add('text-red-400');
             document.getElementById('modal-medicine-stock').classList.remove('text-green-400');
        } else {
             document.getElementById('modal-medicine-stock').classList.add('text-green-400');
             document.getElementById('modal-medicine-stock').classList.remove('text-red-400');
        }

        // 2. Show the modal
        document.getElementById('medicine-details-modal').classList.remove('hidden');
    }

    // Function to close the Medicine Details Modal (Existing)
    function closeMedicineDetailsModal() {
        document.getElementById('medicine-details-modal').classList.add('hidden');
    }
    
    // Function to show the Ambulance Booking Modal (New)
    function showBookingModal(ambulanceId, driverName) {
        document.getElementById('modal-ambulance-id').textContent = ambulanceId;
        document.getElementById('modal-ambulance-driver').textContent = driverName;
        document.getElementById('ambulance-booking-modal').classList.remove('hidden');
    }

    function closeBookingModal() {
        document.getElementById('ambulance-booking-modal').classList.add('hidden');
    }

    // Function to filter the doctor table (Existing)
    function filterDoctorTable() {
        const input = document.getElementById('doctorSearchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById("doctorTable");
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) { // Start from 1 to skip header row
            let match = false;
            // Check all cells (td) in the row
            const tds = tr[i].getElementsByTagName("td");
            for (let j = 0; j < tds.length; j++) {
                const cell = tds[j];
                if (cell) {
                    if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            // Show/hide row based on match
            tr[i].style.display = match ? "" : "none";
        }
    }
    
     // Function to filter the patient table (Existing)
    function filterPatientTable() {
        const input = document.getElementById('patientSearchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById("patientTable");
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) { // Start from 1 to skip header row
            let match = false;
            const tds = tr[i].getElementsByTagName("td");
            for (let j = 0; j < 2; j++) { // Only check first two columns (ID and Name)
                const cell = tds[j];
                if (cell) {
                    if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            // Show/hide row based on match
            tr[i].style.display = match ? "" : "none";
        }
    }

    // Function to filter medicine cards based on search input (Existing)
    function filterMedicineCards() {
        const input = document.getElementById('medicineSearchInput');
        const filter = input.value.toUpperCase();
        const container = document.getElementById('medicine-card-container');
        const cards = container.getElementsByClassName('glass-card'); // Use class name for cards

        for (let i = 0; i < cards.length; i++) {
            let card = cards[i];
            let textContent = card.textContent || card.innerText;
            
            if (textContent.toUpperCase().indexOf(filter) > -1) {
                card.style.display = "flex"; // Show as flex
            } else {
                card.style.display = "none";
            }
        }
    }

    // Function to filter doctors in the appointment (booking step 1) section (NEW)
    function filterAppointmentDoctors() {
        const input = document.getElementById('appointment-doctor-search');
        const filter = input.value.toUpperCase();
        const container = document.getElementById('doctor-list-container');
        const cards = container.getElementsByClassName('flex'); // Assuming doctor cards are main flex items

        for (let i = 0; i < cards.length; i++) {
            let card = cards[i];

            // Crucial: Only target the direct doctor listing elements (the top-level flex containers)
            if (card.parentNode.id === 'doctor-list-container') {
                let textContent = card.textContent || card.innerText;
                
                if (textContent.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "flex"; // Show as flex
                } else {
                    card.style.display = "none";
                }
            }
        }
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