<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard | Medical Desk</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --glass-bg: rgba(17, 25, 40, 0.75); 
            --glass-border: rgba(255, 255, 255, 0.125);
            --glass-highlight: rgba(255, 255, 255, 0.05);
            --accent-primary: #3b82f6; 
            --text-main: #f3f4f6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Fixed Background */
        .fixed-bg-layer {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1;
        }
        .bg-image {
            width: 100%; height: 100%;
            background-image: url('https://picsum.photos/1920/1080?random=20');
            background-size: cover; background-position: center;
        }
        .bg-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(2px);
        }

        /* Glass Utilities */
        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        .glass-nav {
            background: rgba(17, 25, 40, 0.6);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
        }
        .glass-input {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--glass-border);
            color: white;
        }
        .glass-input:focus { outline: none; border-color: var(--accent-primary); background: rgba(0, 0, 0, 0.4); }

        /* Badges */
        .badge { padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-waiting { background: rgba(234, 179, 8, 0.2); color: #fde047; border: 1px solid rgba(234, 179, 8, 0.3); }
        .badge-checked-in { background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid rgba(59, 130, 246, 0.3); }
        .badge-cancelled { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3); }
        
        /* Financial Badges */
        .badge-paid { background: rgba(34, 197, 94, 0.2); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.3); }
        .badge-overdue { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3); }
        .badge-pending { background: rgba(249, 115, 22, 0.2); color: #fdba74; border: 1px solid rgba(249, 115, 22, 0.3); }

        /* Medical Badges */
        .badge-critical { background: rgba(239, 68, 68, 0.15); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.2); }
        .badge-chronic { background: rgba(168, 85, 247, 0.15); color: #d8b4fe; border: 1px solid rgba(168, 85, 247, 0.2); }
        .badge-healthy { background: rgba(34, 197, 94, 0.15); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.2); }
        .badge-blood { background: rgba(255, 255, 255, 0.1); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.2); font-family: monospace; }


        /* Utility */
        .hidden-view { display: none; }
        .active-nav { background: rgba(255,255,255,0.1) !important; color: white !important; }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="antialiased min-h-screen relative">

    <div class="fixed-bg-layer">
        <div class="bg-image"></div>
        <div class="bg-overlay"></div>
    </div>

    <nav class="fixed top-0 w-full z-50 glass-nav h-16 flex items-center justify-between px-4 lg:px-8">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded bg-blue-500 flex items-center justify-center text-white font-bold shadow-lg">
                <i data-lucide="activity" class="w-5 h-5"></i>
            </div>
            <span class="font-semibold text-lg tracking-tight">MediDesk <span class="text-blue-400 text-sm font-normal">Reception</span></span>
        </div>

        <div class="hidden md:flex items-center gap-1">
            <button onclick="switchTab('dashboard')" id="nav-dashboard" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition text-gray-300 active-nav">Dashboard</button>
            <button onclick="switchTab('appointments')" id="nav-appointments" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition text-gray-300">Appointments</button>
            <button onclick="switchTab('billing')" id="nav-billing" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition text-gray-300">Billing</button>
            <button onclick="switchTab('patients')" id="nav-patients" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition text-gray-300">Patients</button>
            <button onclick="switchTab('doctors')" id="nav-doctors" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition text-gray-300">Doctors</button>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 pl-4 border-l border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-medium text-white">Sarah Jenkins</p>
                </div>
                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-500 to-blue-500 p-[2px]">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah" class="w-full h-full rounded-full bg-gray-900">
                </div>
            </div>
        </div>
    </nav>

    <main class="relative z-10 pt-24 pb-12 px-4 lg:px-8 max-w-7xl mx-auto">
        
        <div id="view-dashboard" class="view-section fade-in">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
                <div>
                    <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider font-semibold">Overview</p>
                    <h1 class="text-3xl font-bold text-white">Dashboard Overview</h1>
                </div>
                <button onclick="openModal()" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-lg shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i> New Appointment
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="glass-panel p-5 rounded-xl flex justify-between">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase">Total Today</p>
                        <h3 class="text-2xl font-bold text-white mt-1">42</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-500/10 text-blue-400"><i data-lucide="calendar" class="w-6 h-6"></i></div>
                </div>
                <div class="glass-panel p-5 rounded-xl flex justify-between">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase">Waiting</p>
                        <h3 class="text-2xl font-bold text-white mt-1">8</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-yellow-500/10 text-yellow-400"><i data-lucide="users" class="w-6 h-6"></i></div>
                </div>
                <div class="glass-panel p-5 rounded-xl flex justify-between">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase">Doctors In</p>
                        <h3 class="text-2xl font-bold text-white mt-1">5</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-purple-500/10 text-purple-400"><i data-lucide="stethoscope" class="w-6 h-6"></i></div>
                </div>
                 <div class="glass-panel p-5 rounded-xl flex justify-between">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase">Urgent</p>
                        <h3 class="text-2xl font-bold text-white mt-1">3</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-red-500/10 text-red-400"><i data-lucide="alert-circle" class="w-6 h-6"></i></div>
                </div>
            </div>

            <div class="glass-panel rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4">Today's Schedule</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs text-gray-400 uppercase border-b border-white/10">
                                <th class="pb-3">Time</th>
                                <th class="pb-3">Patient</th>
                                <th class="pb-3">Doctor</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody id="dashboard-table-body" class="text-sm">
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="view-appointments" class="view-section hidden-view fade-in">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-white">All Appointments</h1>
                <div class="flex gap-2">
                    <input type="date" class="glass-input px-3 py-2 rounded-lg text-sm">
                    <button class="bg-blue-600 px-4 py-2 rounded-lg text-white">Filter</button>
                </div>
            </div>
            
            <div class="glass-panel rounded-xl overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-xs uppercase text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Time</th>
                            <th class="px-6 py-4">Patient Name</th>
                            <th class="px-6 py-4">Reason</th>
                            <th class="px-6 py-4">Doctor</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody id="appointments-full-table-body" class="text-sm divide-y divide-white/10">
                        </tbody>
                </table>
            </div>
        </div>

        <div id="view-billing" class="view-section hidden-view fade-in">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
                <div>
                    <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider font-semibold">Financials</p>
                    <h1 class="text-3xl font-bold text-white">Billing & Invoices</h1>
                </div>
                <div class="flex gap-3">
                    <button class="glass-panel px-4 py-2 rounded-lg text-sm hover:bg-white/5 transition flex items-center gap-2">
                        <i data-lucide="download" class="w-4 h-4"></i> Export Report
                    </button>
                    <button class="bg-green-600 hover:bg-green-500 text-white px-5 py-2.5 rounded-lg shadow-lg flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Create Invoice
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="glass-panel p-5 rounded-xl border-l-4 border-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide">Monthly Revenue</p>
                            <h3 class="text-2xl font-bold text-white mt-1">42,590Tk</h3>
                        </div>
                        <div class="p-2 bg-green-500/10 rounded-lg text-green-400"><i data-lucide="dollar-sign" class="w-5 h-5"></i></div>
                    </div>
                </div>
                <div class="glass-panel p-5 rounded-xl border-l-4 border-red-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide">Outstanding</p>
                            <h3 class="text-2xl font-bold text-white mt-1">3,850Tk</h3>
                        </div>
                        <div class="p-2 bg-red-500/10 rounded-lg text-red-400"><i data-lucide="alert-octagon" class="w-5 h-5"></i></div>
                    </div>
                </div>
                <div class="glass-panel p-5 rounded-xl border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide">Claims Processed</p>
                            <h3 class="text-2xl font-bold text-white mt-1">156Tk</h3>
                        </div>
                        <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400"><i data-lucide="file-text" class="w-5 h-5"></i></div>
                    </div>
                </div>
                <div class="glass-panel p-5 rounded-xl border-l-4 border-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide">Avg. Daily Bill</p>
                            <h3 class="text-2xl font-bold text-white mt-1">215Tk</h3>
                        </div>
                        <div class="p-2 bg-purple-500/10 rounded-lg text-purple-400"><i data-lucide="bar-chart-2" class="w-5 h-5"></i></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 glass-panel rounded-xl overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-white/10 flex justify-between items-center">
                        <h3 class="font-bold text-lg">Recent Invoices</h3>
                        <div class="relative">
                            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-2.5 text-gray-500"></i>
                            <input type="text" placeholder="Search invoices..." class="glass-input pl-9 pr-4 py-1.5 rounded-full text-sm w-48 focus:w-64 transition-all">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 text-xs uppercase text-gray-400">
                                <tr>
                                    <th class="px-5 py-3">Invoice ID</th>
                                    <th class="px-5 py-3">Patient</th>
                                    <th class="px-5 py-3">Insurance</th>
                                    <th class="px-5 py-3">Date</th>
                                    <th class="px-5 py-3">Amount</th>
                                    <th class="px-5 py-3">Status</th>
                                    <th class="px-5 py-3"></th>
                                </tr>
                            </thead>
                            <tbody id="billing-table-body" class="text-sm divide-y divide-white/10">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="glass-panel rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-4">Live Transactions</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 rounded-lg bg-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center text-green-400">
                                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">Copay Received</p>
                                    <p class="text-xs text-gray-400">Alice Johnson</p>
                                </div>
                            </div>
                            <span class="text-green-400 font-bold text-sm">+$45.00</span>
                        </div>
                         <div class="flex items-center justify-between p-3 rounded-lg bg-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400">
                                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">Ins. Claim Paid</p>
                                    <p class="text-xs text-gray-400">BlueCross - #9921</p>
                                </div>
                            </div>
                            <span class="text-blue-400 font-bold text-sm">+$850.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="view-patients" class="view-section hidden-view fade-in">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
                <div>
                    <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider font-semibold">Directory</p>
                    <h1 class="text-3xl font-bold text-white">Patient Records</h1>
                </div>
                <div class="flex gap-3">
                    <div class="relative">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" placeholder="Search by name or ID..." class="glass-input pl-10 pr-4 py-2.5 rounded-lg w-64">
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-lg shadow-lg flex items-center gap-2">
                        <i data-lucide="user-plus" class="w-4 h-4"></i> Add Patient
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="glass-panel p-4 rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase">Total Patients</p>
                        <h3 class="text-xl font-bold text-white">1,248</h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400"><i data-lucide="users" class="w-5 h-5"></i></div>
                </div>
                <div class="glass-panel p-4 rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase">New This Month</p>
                        <h3 class="text-xl font-bold text-white">+84</h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center text-green-400"><i data-lucide="trending-up" class="w-5 h-5"></i></div>
                </div>
                 <div class="glass-panel p-4 rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase">Critical Care</p>
                        <h3 class="text-xl font-bold text-white">12</h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-red-500/20 flex items-center justify-center text-red-400"><i data-lucide="activity" class="w-5 h-5"></i></div>
                </div>
                <div class="glass-panel p-4 rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase">Avg Daily Visits</p>
                        <h3 class="text-xl font-bold text-white">45</h3>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400"><i data-lucide="calendar-check" class="w-5 h-5"></i></div>
                </div>
            </div>

            <div class="glass-panel rounded-xl overflow-hidden">
                <div class="p-4 border-b border-white/10 flex gap-4 items-center">
                    <button class="text-white text-sm font-medium border-b-2 border-blue-500 pb-1">All Patients</button>
                    <button class="text-gray-400 text-sm font-medium hover:text-white pb-1">In-Patient</button>
                    <button class="text-gray-400 text-sm font-medium hover:text-white pb-1">Out-Patient</button>
                    <div class="flex-1 text-right">
                         <select class="bg-black/20 border border-white/10 text-gray-300 text-xs rounded px-2 py-1 outline-none">
                            <option>Sort by Name</option>
                            <option>Sort by Last Visit</option>
                         </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 text-xs uppercase text-gray-400">
                            <tr>
                                <th class="px-6 py-4">Patient</th>
                                <th class="px-6 py-4">Contact</th>
                                <th class="px-6 py-4">Bio / Medical</th>
                                <th class="px-6 py-4">Visit History</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="patients-table-body" class="text-sm divide-y divide-white/10">
                            </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-white/10 flex justify-between items-center text-xs text-gray-400">
                    <span>Showing 1-5 of 1,248 patients</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 rounded bg-white/5 hover:bg-white/10">Prev</button>
                        <button class="px-3 py-1 rounded bg-white/5 hover:bg-white/10">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="view-doctors" class="view-section hidden-view fade-in">
             <h1 class="text-3xl font-bold text-white mb-6">Medical Staff</h1>
             <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                 <div class="glass-panel p-6 rounded-xl text-center">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=DrSmith" class="w-20 h-20 rounded-full mx-auto mb-3 bg-gray-700">
                    <h3 class="font-bold text-lg">Dr. J. Smith</h3>
                    <p class="text-blue-400 text-sm">Cardiology</p>
                    <div class="mt-4 flex justify-center gap-2">
                        <span class="badge badge-checked-in">Available</span>
                    </div>
                 </div>
                 <div class="glass-panel p-6 rounded-xl text-center">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=DrLee" class="w-20 h-20 rounded-full mx-auto mb-3 bg-gray-700">
                    <h3 class="font-bold text-lg">Dr. A. Lee</h3>
                    <p class="text-blue-400 text-sm">Neurology</p>
                    <div class="mt-4 flex justify-center gap-2">
                        <span class="badge badge-cancelled">Busy</span>
                    </div>
                 </div>
             </div>
        </div>

    </main>

    <div id="appointment-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="glass-panel w-full max-w-lg rounded-2xl p-6 relative">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white"><i data-lucide="x" class="w-6 h-6"></i></button>
                <h2 class="text-2xl font-bold mb-4">New Appointment</h2>
                <form onsubmit="handleFormSubmit(event)" class="space-y-4">
                    <input type="text" required class="glass-input w-full px-4 py-2 rounded-lg" placeholder="Patient Name">
                    <div class="flex gap-4">
                        <input type="date" class="glass-input w-full px-4 py-2 rounded-lg">
                        <input type="time" class="glass-input w-full px-4 py-2 rounded-lg">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-medium">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // --- DATA ---
        const appointments = [
            { time: "09:00 AM", patient: "Alice Johnson", doctor: "Dr. Smith", type: "Check-up", status: "Checked In" },
            { time: "09:30 AM", patient: "Michael Brown", doctor: "Dr. Patel", type: "Consultation", status: "Waiting" },
            { time: "10:15 AM", patient: "Sophie Turner", doctor: "Dr. Lee", type: "Follow-up", status: "Cancelled" },
            { time: "11:00 AM", patient: "David Wilson", doctor: "Dr. Smith", type: "Surgery", status: "Pending" }
        ];

        const billingRecords = [
            { id: "#INV-2023-001", patient: "Alice Johnson", insurance: "BlueCross", date: "Oct 24, 2023", amount: "150.00Tk", status: "Paid" },
            { id: "#INV-2023-002", patient: "Michael Brown", insurance: "Aetna", date: "Oct 24, 2023", amount: "2,500.00Tk", status: "Pending" },
            { id: "#INV-2023-003", patient: "Sarah Miller", insurance: "UnitedHealth", date: "Oct 23, 2023", amount: "450.00Tk", status: "Overdue" },
            { id: "#INV-2023-004", patient: "James Wilson", insurance: "Private", date: "Oct 22, 2023", amount: "120.00Tk", status: "Paid" },
            { id: "#INV-2023-005", patient: "Emily Clark", insurance: "Medicare", date: "Oct 21, 2023", amount: "780.00TK", status: "Pending" },
        ];

        const patientRecords = [
            { 
                id: "P-0042", name: "Alice Johnson", email: "alice.j@example.com", 
                age: 34, gender: "F", blood: "O+", phone: "+1 (555) 010-1234",
                condition: "Healthy", conditionClass: "badge-healthy",
                lastVisit: "Oct 24, 2023", nextAppt: "None"
            },
            { 
                id: "P-0043", name: "Michael Brown", email: "m.brown@example.com", 
                age: 58, gender: "M", blood: "A-", phone: "+1 (555) 010-5678",
                condition: "Hypertension", conditionClass: "badge-chronic",
                lastVisit: "Oct 24, 2023", nextAppt: "Nov 12, 2023"
            },
            { 
                id: "P-0044", name: "Sophie Turner", email: "sophie.t@example.com", 
                age: 24, gender: "F", blood: "B+", phone: "+1 (555) 010-9988",
                condition: "Migraine", conditionClass: "badge-chronic",
                lastVisit: "Sep 15, 2023", nextAppt: "Oct 30, 2023"
            },
            { 
                id: "P-0045", name: "David Wilson", email: "dwilson@example.com", 
                age: 45, gender: "M", blood: "AB+", phone: "+1 (555) 010-2233",
                condition: "Critical", conditionClass: "badge-critical",
                lastVisit: "Today", nextAppt: "Tomorrow"
            },
            { 
                id: "P-0046", name: "Sarah Miller", email: "sarah.m@example.com", 
                age: 29, gender: "F", blood: "A+", phone: "+1 (555) 010-4455",
                condition: "Pregnancy", conditionClass: "badge-chronic",
                lastVisit: "Oct 01, 2023", nextAppt: "Nov 01, 2023"
            }
        ];

        // --- INIT ---
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            renderDashboardTables();
            renderBillingTable();
            renderPatientTable();
        });

        // --- TABS ---
        function switchTab(tabName) {
            document.querySelectorAll('.view-section').forEach(el => el.classList.add('hidden-view'));
            const selectedView = document.getElementById('view-' + tabName);
            if(selectedView) selectedView.classList.remove('hidden-view');

            document.querySelectorAll('nav button').forEach(btn => {
                btn.classList.remove('active-nav', 'text-white');
                btn.classList.add('text-gray-300');
            });
            const activeBtn = document.getElementById('nav-' + tabName);
            if(activeBtn) {
                activeBtn.classList.add('active-nav');
                activeBtn.classList.remove('text-gray-300');
            }
        }

        // --- RENDER FUNCTIONS ---
        function renderDashboardTables() {
            const dashboardBody = document.getElementById('dashboard-table-body');
            const fullBody = document.getElementById('appointments-full-table-body');
            
            if(dashboardBody) dashboardBody.innerHTML = '';
            if(fullBody) fullBody.innerHTML = '';

            appointments.forEach((appt) => {
                let badgeClass = 'badge-waiting';
                if(appt.status === 'Checked In') badgeClass = 'badge-checked-in';
                if(appt.status === 'Cancelled') badgeClass = 'badge-cancelled';

                if(dashboardBody) {
                    dashboardBody.innerHTML += `
                        <tr class="border-b border-white/5">
                            <td class="py-3 text-gray-300">${appt.time}</td>
                            <td class="py-3 font-medium text-white">${appt.patient}</td>
                            <td class="py-3 text-gray-400">${appt.doctor}</td>
                            <td class="py-3"><span class="badge ${badgeClass}">${appt.status}</span></td>
                        </tr>`;
                }
                if(fullBody) {
                    fullBody.innerHTML += `
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-gray-300">${appt.time}</td>
                            <td class="px-6 py-4 font-bold text-white">${appt.patient}</td>
                            <td class="px-6 py-4 text-gray-400">${appt.type}</td>
                            <td class="px-6 py-4 text-gray-300">${appt.doctor}</td>
                            <td class="px-6 py-4"><span class="badge ${badgeClass}">${appt.status}</span></td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-blue-400 hover:text-white mr-2"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                                <button class="text-red-400 hover:text-white"><i data-lucide="trash" class="w-4 h-4"></i></button>
                            </td>
                        </tr>`;
                }
            });
        }

        function renderBillingTable() {
            const billingBody = document.getElementById('billing-table-body');
            if(!billingBody) return;
            billingBody.innerHTML = '';

            billingRecords.forEach(bill => {
                let badgeClass = 'badge-pending';
                if(bill.status === 'Paid') badgeClass = 'badge-paid';
                if(bill.status === 'Overdue') badgeClass = 'badge-overdue';

                billingBody.innerHTML += `
                    <tr class="hover:bg-white/5 transition group">
                        <td class="px-5 py-4 font-mono text-xs text-blue-300">${bill.id}</td>
                        <td class="px-5 py-4 font-medium text-white">${bill.patient}</td>
                        <td class="px-5 py-4 text-gray-400">${bill.insurance}</td>
                        <td class="px-5 py-4 text-gray-400 text-xs">${bill.date}</td>
                        <td class="px-5 py-4 font-bold text-white">${bill.amount}</td>
                        <td class="px-5 py-4"><span class="badge ${badgeClass}">${bill.status}</span></td>
                        <td class="px-5 py-4 text-right">
                            <button class="text-gray-500 hover:text-white opacity-0 group-hover:opacity-100 transition"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
                        </td>
                    </tr>`;
            });
        }

        function renderPatientTable() {
            const patientBody = document.getElementById('patients-table-body');
            if(!patientBody) return;
            patientBody.innerHTML = '';

            patientRecords.forEach(p => {
                patientBody.innerHTML += `
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-700">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=${p.name}" class="w-full h-full rounded-full">
                                </div>
                                <div>
                                    <p class="text-white font-medium text-sm">${p.name}</p>
                                    <p class="text-gray-500 text-xs">${p.email}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-gray-300 text-sm">
                                <i data-lucide="phone" class="w-3 h-3"></i> ${p.phone}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 mb-1">
                                <span class="badge badge-blood">${p.blood}</span>
                                <span class="text-gray-400 text-xs self-center">${p.age} yrs / ${p.gender}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-gray-300 text-sm">Last: ${p.lastVisit}</p>
                            <p class="text-blue-400 text-xs">Next: ${p.nextAppt}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge ${p.conditionClass}">${p.condition}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 rounded-lg bg-blue-600/20 text-blue-400 hover:bg-blue-600 hover:text-white transition" title="Profile"><i data-lucide="user" class="w-4 h-4"></i></button>
                                <button class="p-1.5 rounded-lg bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white transition" title="Message"><i data-lucide="message-square" class="w-4 h-4"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        // --- MODAL LOGIC ---
        function openModal() { document.getElementById('appointment-modal').classList.remove('hidden'); }
        function closeModal() { document.getElementById('appointment-modal').classList.add('hidden'); }
        function handleFormSubmit(e) {
            e.preventDefault();
            closeModal();
            alert("Appointment Booked!");
        }
    </script>
</body>
</html>