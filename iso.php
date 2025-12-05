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

            <section id="full-booking-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="calendar-check" class="w-8 h-8 mr-3"></i> Book New Appointment
                </h1>
                <div class="glass-card p-6 rounded-xl shadow-xl">
                    <div class="flex justify-between items-center mb-10 relative">
                        <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-600 transform -translate-y-1/2 z-0 hidden sm:block"></div>
                        <div id="progress-line-1-2" class="absolute left-[calc(1/6*100%)] right-[calc(4/6*100%)] top-1/2 h-0.5 bg-gray-600 transform -translate-y-1/2 z-5 transition-all duration-500 hidden sm:block"></div>
                        <div id="progress-line-2-3" class="absolute left-[calc(3/6*100%)] right-[calc(2/6*100%)] top-1/2 h-0.5 bg-gray-600 transform -translate-y-1/2 z-5 transition-all duration-500 hidden sm:block"></div>
                        <div id="progress-line-3-4" class="absolute left-[calc(5/6*100%)] right-[calc(0/6*100%)] top-1/2 h-0.5 bg-gray-600 transform -translate-y-1/2 z-5 transition-all duration-500 hidden sm:block"></div>

                        <div id="progress-step-1" class="progress-step active text-center relative z-10">
                            <div class="step-number w-10 h-10 flex items-center justify-center rounded-full mx-auto mb-2 text-lg font-bold">1</div>
                            <p class="step-label text-sm hidden sm:block">Select Doctor</p>
                        </div>
                        
                        <div id="progress-step-2" class="progress-step text-center relative z-10">
                            <div class="step-number w-10 h-10 flex items-center justify-center rounded-full mx-auto mb-2 text-lg font-bold">2</div>
                            <p class="step-label text-sm hidden sm:block">Date & Time</p>
                        </div>

                        <div id="progress-step-3" class="progress-step text-center relative z-10">
                            <div class="step-number w-10 h-10 flex items-center justify-center rounded-full mx-auto mb-2 text-lg font-bold">3</div>
                            <p class="step-label text-sm hidden sm:block">Patient Info</p>
                        </div>

                        <div id="progress-step-4" class="progress-step text-center relative z-10">
                            <div class="step-number w-10 h-10 flex items-center justify-center rounded-full mx-auto mb-2 text-lg font-bold">4</div>
                            <p class="step-label text-sm hidden sm:block">Confirmation</p>
                        </div>
                    </div>

                    <div id="booking-step-1" class="booking-step">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="stethoscope" class="w-6 h-6 mr-2"></i> Step 1: Choose a Doctor
                        </h2>
                        
                        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="dr-jihan.jpg" alt="Dr. Jihan" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Jihan Khan</p>
                                        <p class="text-sm text-gray-300">Cardiology - Main Center</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="showBookingStep(2)">Select</button>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="dr-fardin.jpg" alt="Dr. Fardin" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Fardin</p>
                                        <p class="text-sm text-gray-300">Orthopedics - East Wing Clinic</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="showBookingStep(2)">Select</button>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <div class="flex items-center space-x-4">
                                    <img src="dr-misbah.jpg" alt="Dr. Misbah" class="w-12 h-12 rounded-full object-cover border-2 border-white/50">
                                    <div>
                                        <p class="font-bold text-white">Dr. Misbah</p>
                                        <p class="text-sm text-gray-300">Pediatrics - Pediatric Unit</p>
                                    </div>
                                </div>
                                <button class="py-1 px-4 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-600 transition" onclick="showBookingStep(2)">Select</button>
                            </div>
                            </div>

                        <div class="mt-8 flex justify-end">
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg opacity-50 cursor-not-allowed">Next: Time & Date</button>
                        </div>
                    </div>

                    <div id="booking-step-2" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="calendar" class="w-6 h-6 mr-2"></i> Step 2: Select Date & Time
                        </h2>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="p-6 bg-white/10 rounded-lg shadow-inner">
                                <h3 class="text-xl font-semibold mb-4 text-white">Choose a Date</h3>
                                <input type="date" required class="w-full p-3 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-black placeholder:text-gray-300">
                                <p class="text-sm text-gray-300 mt-2">Dr. Jihan Khan's next available date is 2024-12-10.</p>
                            </div>
                            
                            <div class="p-6 bg-white/10 rounded-lg shadow-inner">
                                <h3 class="text-xl font-semibold mb-4 text-white">Available Timeslots</h3>
                                <div class="grid grid-cols-3 gap-3">
                                    <button class="p-3 bg-white/20 rounded-lg text-white font-medium hover:bg-white/40 transition">09:00 AM</button>
                                    <button class="p-3 bg-white/20 rounded-lg text-white font-medium hover:bg-white/40 transition">10:30 AM</button>
                                    <button class="p-3 bg-white/20 rounded-lg text-white font-medium hover:bg-white/40 transition">11:00 AM</button>
                                    <button class="p-3 bg-white/20 rounded-lg text-white font-medium hover:bg-white/40 transition">02:00 PM</button>
                                    <button class="p-3 bg-green-500 rounded-lg text-white font-medium shadow-md">03:30 PM</button> <button class="p-3 bg-white/20 rounded-lg text-white font-medium hover:bg-white/40 transition">05:00 PM</button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 btn-primary-blue text-white font-medium rounded-lg transition" onclick="showBookingStep(1)">Previous: Select Doctor</button>
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg transition" onclick="showBookingStep(3)">Next: Patient Info</button>
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
                            <button class="py-2 px-6 btn-primary-blue text-white font-medium rounded-lg transition" onclick="showBookingStep(2)">Previous: Date & Time</button>
                            <button class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg transition" onclick="showBookingStep(4)">Next: Confirm Booking</button>
                        </div>
                    </div>

                    <div id="booking-step-4" class="booking-step hidden">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i> Step 4: Review and Confirm
                        </h2>
                        
                        <div class="p-6 bg-white/10 rounded-xl shadow-inner mb-6 space-y-4">
                            <h3 class="text-xl font-semibold text-white border-b border-white/20 pb-2">Appointment Summary</h3>
                            <div class="flex justify-between summary-row">
                                <span class="text-gray-300">Doctor:</span>
                                <span class="font-bold text-white">Dr. Jihan Khan (Cardiology)</span>
                            </div>
                            <div class="flex justify-between summary-row">
                                <span class="text-gray-300">Date:</span>
                                <span class="font-bold text-white">2024-12-10</span>
                            </div>
                            <div class="flex justify-between summary-row">
                                <span class="text-gray-300">Time:</span>
                                <span class="font-bold text-white">03:30 PM</span>
                            </div>
                            <div class="flex justify-between summary-row border-t border-white/20 pt-4">
                                <span class="text-xl text-yellow-300">Consultation Fee:</span>
                                <span class="text-xl font-bold text-yellow-300">30.00 TK</span>
                            </div>
                        </div>
                        
                        <p class="text-gray-300 mb-6">By clicking "Confirm & Pay," you agree to the hospital's terms and conditions and will be redirected to the payment gateway.</p>

                        <div class="mt-8 flex justify-between">
                            <button class="py-2 px-6 btn-primary-blue text-white font-medium rounded-lg transition" onclick="showBookingStep(3)">Previous: Patient Info</button>
                            <button class="py-2 px-6 btn-primary-red text-white font-medium rounded-lg transition" onclick="window.location.href='pay.php'">Confirm & Pay</button>
                        </div>
                    </div>

                </div>
            </section>
            
            <section id="patients-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="user-round" class="w-8 h-8 mr-3"></i> Patient Records Management
                </h1>
                
                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="search" class="w-6 h-6 mr-2"></i> Patient Search & Overview</h2>
                    
                   <input type="text" id="patientSearchInput" onkeyup="filterPatientTable()" placeholder="Search by ID, name, or last visit date..." class="w-full p-3 mb-6 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    
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
                                <tr class="hover:bg-white/10">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">P00104</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Dana Evan</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">2024-11-28</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><a href="#" class="text-white hover:text-gray-300">View History</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            
            <section id="medicine-content" class="page-content">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-8 tracking-tight flex items-center">
                    <i data-lucide="pill" class="w-8 h-8 mr-3"></i> Medicine Inventory & Ordering
                </h1>

                <div class="glass-card p-6 rounded-xl shadow-xl mb-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="search" class="w-6 h-6 mr-2"></i> Search Medicine & Quick Order</h2>
                    <input type="text" id="medicineSearchInput" onkeyup="filterMedicineCards()" placeholder="Search medicine by name or generic name..." class="w-full p-3 mb-6 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">

                    <div id="medicine-card-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="21.jpg" alt="" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">Low Stock</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-300 font-medium">Generic: Paracetamol</p>
                                <h3 class="text-xl font-bold mb-1">PainAway Max (500mg)</h3>
                                <p class="text-lg font-bold text-yellow-300 mb-2">5.00Tk / Strip (10 pcs)</p>
                            </div>
                            <div class="mt-auto flex gap-2">
                                <button class="w-1/2 py-2 btn-primary-medicine text-white font-medium rounded-lg transition" onclick="showMedicineDetailsModal('PainAway Max (500mg)');">View Details</button>
                                <a href="pay.php" class="w-1/2 text-center py-2 btn-order-now text-white font-medium rounded-lg transition flex items-center justify-center">Order Now</a>
                            </div>
                            </div>
                        
                        <div class="glass-card p-4 rounded-lg shadow-md hover:shadow-xl flex flex-col">
                            <div class="relative h-40 mb-3 overflow-hidden rounded-lg">
                                <img src="22.jpg" alt="" class="w-full h-full object-cover">
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
                                <img src="23.jpg" alt="" class="w-full h-full object-cover">
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
                    
                    <div class="mt-6 text-center">
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
                                    <label class="block text-sm font-medium text-white mb-1">Unit Price (Tk)</label>
                                    <input type="number" step="0.01" placeholder="5.00" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Current Stock Count</label>
                                    <input type="number" placeholder="1200" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-white mb-1">Expiry Date</label>
                                    <input type="date" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-black placeholder:text-gray-300">
                                </div>
                            </div>
                            <button type="submit" class="py-2 px-6 btn-primary-indigo text-white font-medium rounded-lg hover:bg-indigo-700 transition w-full">Add to Inventory</button>
                        </form>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="bell" class="w-6 h-6 mr-2"></i> Stock Alerts</h2>
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
                                <span class="text-sm font-semibold bg-yellow-500 text-white px-3 py-1 rounded-full">On Call</span>
                            </div>
                            <p class="text-gray-300 mb-3">Equipped with cardiac monitors and advanced life support (ALS).</p>
                            <div class="space-y-1 mb-4">
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-red-400"></i> Location: Sector A, Route 3
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-400"></i> Number: +880 1711-987654
                                </div>
                                <div class="flex items-center text-sm text-gray-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-400"></i> Driver: Rumi Ahmed
                                </div>
                            </div>
                            <button onclick="openBookingModal('AMB-205', 'Advanced Life Support')" class="w-full py-2 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition"> Book This Ambulance </button>
                        </div>
                         <div class="glass-card p-4 rounded-xl shadow-lg">
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-3">
                                <p class="text-xl font-bold text-white">AMB-309 (Basic)</p>
                                <span class="text-sm font-semibold bg-gray-500 text-white px-3 py-1 rounded-full">Maintenance</span>
                            </div>
                            <p class="text-gray-300 mb-3">Standard medical transport with basic life support equipment.</p>
                            <div class="space-y-1 mb-4">
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

                <div class="glass-card p-6 rounded-xl shadow-xl mt-6">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="history" class="w-6 h-6 mr-2"></i> Recent Report History</h2>
                    <p class="mb-4">Recently generated or scheduled reports.</p>
                    <ul class="space-y-3">
                        <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center">
                            <span class="font-medium">Monthly Appointment Summary (Oct 2024)</span>
                            <span class="text-sm text-gray-300">Generated: 2024-11-01 <a href="#" class="text-blue-300 ml-3">Download</a></span>
                        </li>
                         <li class="p-3 bg-white/10 rounded-lg flex justify-between items-center">
                            <span class="font-medium">Financial Summary (Q3 2024)</span>
                            <span class="text-sm text-gray-300">Generated: 2024-10-05 <a href="#" class="text-blue-300 ml-3">Download</a></span>
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
                        <h2 class="text-2xl font-semibold mb-4 flex items-center"><i data-lucide="database" class="w-6 h-6 mr-2"></i> System Maintenance</h2>
                        <div class="space-y-4">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-bold text-white mb-1">Backup Database</p>
                                <p class="text-sm text-gray-300 mb-2">Last backup performed: 2024-12-05 02:00 AM.</p>
                                <button class="py-1 px-4 btn-primary-indigo text-white rounded-lg hover:bg-indigo-700 transition">Run Backup Now</button>
                            </div>
                            <div class="p-3 bg-white/10 rounded-lg">
                                <p class="font-bold text-white mb-1">Clear Cache & Logs</p>
                                <p class="text-sm text-gray-300 mb-2">Frees up temporary storage space.</p>
                                <button class="py-1 px-4 btn-primary-red text-white rounded-lg hover:bg-red-700 transition">Clear Data</button>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-xl shadow-xl">
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
                                <button class="mt-1 text-xs text-red-400 hover:text-red-300">Delete/Hide</button>
                            </div>
                        </div>
                        <button class="mt-6 py-2 px-6 btn-primary-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition w-full">View All Reviews</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div id="doctor-profile-modal" class="hidden fixed inset-0 bg-black/50 z-[90] flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl shadow-2xl max-w-lg w-full transform transition-all overflow-hidden text-white">
            <div class="relative bg-blue-800 h-32">
                <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition" onclick="document.getElementById('doctor-profile-modal').classList.add('hidden')">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
                <img id="modal-doctor-image" src="" alt="Doctor Image" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-24 h-24 rounded-full object-cover border-4 border-gray-800">
            </div>
            
            <div class="pt-16 p-6 text-center">
                <h2 id="modal-doctor-name" class="text-3xl font-bold mb-1"></h2>
                <p id="modal-doctor-title" class="text-lg font-medium text-yellow-300 mb-4"></p>
                
                <div class="text-left space-y-3 border-t border-b border-gray-700 py-4 mb-4">
                    <p class="text-sm"><span class="font-semibold text-gray-400">Specialization:</span> <span id="modal-doctor-specialization"></span></p>
                    <p class="text-sm"><span class="font-semibold text-gray-400">Experience:</span> <span id="modal-doctor-experience"></span></p>
                    <p class="text-sm"><span class="font-semibold text-gray-400">Education:</span> <span id="modal-doctor-education"></span></p>
                </div>

                <p id="modal-doctor-bio" class="text-gray-300 italic text-sm mb-4"></p>
                
                <h3 class="text-xl font-semibold mt-6 mb-3 border-b border-gray-700 pb-1">Services</h3>
                <ul id="modal-doctor-services" class="list-disc list-inside text-left text-gray-300 text-sm grid grid-cols-2 gap-1">
                    </ul>

                <button class="mt-6 w-full py-2 btn-primary-pink text-white font-medium rounded-lg hover:bg-pink-700 transition" onclick="document.getElementById('doctor-profile-modal').classList.add('hidden'); showPage('full-booking-content', document.getElementById('nav-appointments')); return false;">Book Appointment</button>
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
        <div class="bg-gray-800 rounded-xl shadow-2xl max-w-lg w-full transform transition-all overflow-hidden text-white">
            <div class="p-6">
                <div class="flex justify-between items-start border-b border-gray-600 pb-4 mb-4">
                    <div>
                        <h2 class="text-3xl font-bold mb-1">Book Ambulance</h2>
                        <p id="modal-ambulance-type" class="text-lg font-medium text-red-400"></p>
                    </div>
                    <button class="text-white hover:text-gray-400 transition" onclick="closeBookingModal()">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <form onsubmit="alert('Ambulance Booked for AMB-101!'); closeBookingModal(); return false;" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Patient Name</label>
                        <input type="text" placeholder="Full Name" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Pickup Location (Address)</label>
                        <input type="text" placeholder="e.g., House 12, Road 5, Sector 4" required class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-white/10 text-white placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">Destination Hospital/Clinic</label>
                        <input type="text" value="Main Medical Center (Default)" readonly class="w-full p-2 rounded-lg border-2 border-white/20 focus:border-white transition bg-gray-700/50 text-white placeholder:text-gray-300">
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full py-3 btn-primary-red text-white font-medium rounded-lg hover:bg-red-700 transition text-lg"> Confirm Ambulance Booking </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
    // --- DATA STORE (Mock Data for Modals/Filtering) ---
    const doctorData = {
        'Dr. jihan': { 
            name: 'Dr. Jihan Khan', title: 'Senior Consultant Cardiologist', 
            bio: 'A distinguished expert in interventional and clinical cardiology. He specializes in complex arrhythmia management and preventative heart care.', 
            education: 'MD, Residency at Dhaka Medical College', 
            experience: '20+ years', 
            specializations: 'Cardiology, Arrhythmia Management, Preventative Heart Care', 
            languages: 'Bangla, English', 
            image: 'a.jpg', 
            services: ['Interventional Cardiology', 'ECG/Echo Review', 'Stress Testing', 'Cardiac Consultation'] 
        },
        'Dr. Fardin': { 
            name: 'Dr. Fardin', title: 'Orthopedic Surgeon', 
            bio: 'A specialist in orthopedic trauma and sports medicine, Dr. Fardin excels in minimally invasive surgical techniques and post-operative rehabilitation.', 
            education: 'MBBS, MS Orthopedics', 
            experience: '10+ years', 
            specializations: 'Orthopedics, Sports Medicine, Trauma Surgery', 
            languages: 'Bangla, English, Hindi', 
            image: 'fardin.jpg', 
            services: ['Joint Replacement Consultation', 'Arthroscopic Surgery', 'Fracture Management', 'Rehabilitation Planning'] 
        },
        'Dr. Misbah': { 
            name: 'Dr. Misbah', title: 'Pediatrician', 
            bio: 'Dr. Misbah has a passion for child health, specializing in developmental disorders and general pediatric medicine. She provides compassionate care from newborns to adolescents.', 
            education: 'MBBS, DCH', 
            experience: '12 years', 
            specializations: 'General Practice, Pediatric Unit', 
            languages: 'Bangla, English', 
            image: 'misbah.jpg', 
            services: ['Well-Child Visits', 'Vaccination Scheduling', 'Developmental Assessments', 'Sick Child Care'] 
        },
        'Dr. Kamal': { 
            name: 'Dr. Kamal', title: 'General Practitioner', 
            bio: 'A reliable GP offering comprehensive first-line care for a wide range of acute and chronic conditions.', 
            education: 'MBBS, Family Medicine Certification', 
            experience: '8 years', 
            specializations: 'General Practice', 
            languages: 'Bangla, English', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Routine Checkups', 'Minor Illness Treatment', 'Health Screening', 'Referral Services'] 
        },
         'Dr. humayra': { 
            name: 'Dr. Humayrah', title: 'Neurologist', 
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', 
            education: 'MD from Johns Hopkins', 
            experience: '15+ years', 
            specializations: 'Neurology, Headache Management, Epilepsy', 
            languages: 'English, Mandarin', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] 
        },
        'Dr. Riyaz Siddiqe': { 
            name: 'Dr. Riyaz Siddiqe', title: 'Neurologist', 
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', 
            education: 'MD from Johns Hopkins', 
            experience: '15+ years', 
            specializations: 'Neurology, Headache Management, Epilepsy', 
            languages: 'English, Mandarin', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] 
        },
        'Dr. Salman Khan': { 
            name: 'Dr. Salman khan', title: 'Neurologist', 
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', 
            education: 'MD from Johns Hopkins', 
            experience: '15+ years', 
            specializations: 'Neurology, Headache Management, Epilepsy', 
            languages: 'English, Mandarin', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] 
        },
        'Dr. Eva Chy': { 
            name: 'Dr. Eva chy', title: 'Neurologist', 
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', 
            education: 'MD from Johns Hopkins', 
            experience: '15+ years', 
            specializations: 'Neurology, Headache Management, Epilepsy', 
            languages: 'English, Mandarin', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] 
        },
        'Dr. Emon': { 
            name: 'Dr. Emon', title: 'Neurologist', 
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', 
            education: 'MD from Johns Hopkins', 
            experience: '15+ years', 
            specializations: 'Neurology, Headache Management, Epilepsy', 
            languages: 'English, Mandarin', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] 
        },
        'Dr. Sajib': { 
            name: 'Dr. Sajib', title: 'Neurologist', 
            bio: 'Dr. Chen is a leading expert in neurological disorders, including migraines and movement disorders. He employs the latest diagnostic technologies and personalized treatment plans.', 
            education: 'MD from Johns Hopkins', 
            experience: '15+ years', 
            specializations: 'Neurology, Headache Management, Epilepsy', 
            languages: 'English, Mandarin', 
            image: 'c.jpg', // Placeholder image URL (using a generic one for now)
            services: ['Neurological Consultation', 'MRI/CT Review', 'EMG Testing', 'Migraine Treatment'] 
        },
    };

    const medicineData = {
        'PainAway Max (500mg)': {
            name: 'PainAway Max (500mg)',
            generic: 'Paracetamol',
            price: '5.00Tk / Strip (10 pcs)',
            expiry: '2026-11-01',
            origin: 'India',
            materials: 'Paracetamol (500mg), Starch, Microcrystalline Cellulose',
            stock: 'Low Stock' 
        },
        'CoughRelief Extra': {
            name: 'CoughRelief Extra',
            generic: 'Dextromethorphan',
            price: '12.50Tk / Bottle (150ml)',
            expiry: '2025-05-20',
            origin: 'Bangladesh',
            materials: 'Dextromethorphan (20mg/5ml), Guaifenesin, Alcohol',
            stock: 'In Stock' 
        },
        'Amoxil-500 Cap': {
            name: 'Amoxil-500 Cap',
            generic: 'Amoxicillin',
            price: '8.20Tk / Strip (8 pcs)',
            expiry: '2027-01-15',
            origin: 'UK',
            materials: 'Amoxicillin (500mg), Gelatin, Titanium Dioxide',
            stock: 'In Stock' 
        },
        // Add more medicine data here as needed
    };


    // --- JS FUNCTIONS ---

    // Function to switch between SPA pages (Existing)
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
    }
    
    // Function to show the Doctor Profile Modal (Existing)
    function showDoctorProfileModal(doctorName) {
        const data = doctorData[doctorName];
        if (!data) return;

        // 1. Populate modal fields
        document.getElementById('modal-doctor-name').textContent = data.name;
        document.getElementById('modal-doctor-title').textContent = data.title;
        document.getElementById('modal-doctor-specialization').textContent = data.specializations;
        document.getElementById('modal-doctor-experience').textContent = data.experience;
        document.getElementById('modal-doctor-education').textContent = data.education;
        document.getElementById('modal-doctor-bio').textContent = `"${data.bio}"`;
        document.getElementById('modal-doctor-image').src = data.image;

        // Clear and repopulate services
        const servicesList = document.getElementById('modal-doctor-services');
        servicesList.innerHTML = '';
        data.services.forEach(service => {
            const li = document.createElement('li');
            li.textContent = service;
            servicesList.appendChild(li);
        });

        // 2. Show modal and re-render icons
        document.getElementById('doctor-profile-modal').classList.remove('hidden');
        lucide.createIcons();
    }

    // Function to show the Medicine Details Modal (Existing)
    function showMedicineDetailsModal(medicineName) {
        const data = medicineData[medicineName];
        if (!data) return;

        // 1. Populate modal fields
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

        // 3. Loop through rows (skip header row i=0) and hide those that don't
        for (let i = 1; i < rows.length; i++) {
            let row = rows[i];
            let cells = row.getElementsByTagName('td');
            let match = false;

            // Check content of Name, Specialty, and Clinic columns (index 0, 1, 2)
            for (let j = 0; j <= 2; j++) { 
                let cell = cells[j];
                if (cell) {
                    if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            // Show/hide row based on match
            row.style.display = match ? "" : "none";
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
            let title = card.getElementsByTagName('h3')[0]; // Medicine Name
            let generic = card.getElementsByTagName('p')[0]; // Generic Name

            if (title && generic) {
                if (title.textContent.toUpperCase().indexOf(filter) > -1 || 
                    generic.textContent.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }
    }
    
    // Function to open the ambulance booking modal (Existing)
    function openBookingModal(ambulanceId, type) {
        document.getElementById('modal-ambulance-type').textContent = `Booking for ${ambulanceId} (${type})`;
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