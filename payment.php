<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect them to the login page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Management Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  
  <style>
    /* Using Inter font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      
      /* Your background image styles */
       background-image: url('darma.jpg'); 
      background-size: cover;       
      background-position: center;    
      background-repeat: no-repeat; 
      background-attachment: fixed;   
      overflow-x: hidden;
    }
  </style>
</head>
<body>
  <div id="root"></div>

  <script type="text/babel">
    
    // Using React hooks from the global React object
    const { useState } = React;

    // --- SVG Icon Components ---
    
    const IconLayoutDashboard = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <rect width="7" height="9" x="3" y="3" rx="1" /><rect width="7" height="5" x="14" y="3" rx="1" /><rect width="7" height="9" x="14" y="12" rx="1" /><rect width="7" height="5" x="3" y="16" rx="1" />
      </svg>
    );

    const IconBedDouble = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M2 5v10" /><path d="M2 17v2" /><path d="M22 5v10" /><path d="M22 17v2" /><path d="M4 12h16" /><path d="M6 10h2" /><path d="M16 10h2" /><path d="M4 5h16" /><path d="M4 17h16" /><path d="M6 15h2" /><path d="M16 15h2" />
      </svg>
    );

    const IconWrench = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.4 1.4a1 1 0 0 0 1.4 0lA1 1 0 0 0 19 8l-2.2 2.2a2 2 0 0 1-2.8 0L8 4.2a2 2 0 0 1 0-2.8L10.2 2a1 1 0 0 0 1.4 0l1.4 1.4a1 1 0 0 0 1.4 0l.1-.1Z" /><path d="m18.5 8.5 3 3L12 21a2 2 0 0 1-2.8 0L4.2 16a2 2 0 0 1 0-2.8Z" />
      </svg>
    );

    const IconReceiptText = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" /><path d="M14 8H8" /><path d="M16 12H8" /><path d="M12 16H8" />
      </svg>
    );

    const IconUser = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" />
      </svg>
    );

    const IconSearch = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <circle cx="11" cy="11" r="8" /><path d="m21 21-4.3-4.3" />
      </svg>
    );

    const IconChevronLeft = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="m15 18-6-6 6-6" />
      </svg>
    );

    const IconMapPin = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" /><circle cx="12" cy="10" r="3" />
      </svg>
    );

    const IconDollarSign = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <line x1="12" x2="12" y1="2" y2="22" /><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
      </svg>
    );

    const IconCalendar = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" /><line x1="16" x2="16" y1="2" y2="6" /><line x1="8" x2="8" y1="2" y2="6" /><line x1="3" x2="21" y1="10" y2="10" />
      </svg>
    );

    const IconCheck = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M20 6 9 17l-5-5" />
      </svg>
    );

    const IconLogout = ({ className }) => (
      <svg className={className} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16 17 21 12 16 7" /><line x1="21" y1="12" x2="9" y2="12" />
      </svg>
    );


    // --- Mock Data ---
    const MOCK_USER = {
      name: "Nazmul Hasan Jihan",
      avatar: "https://placehold.co/100x100/E2E8F0/4A5568?text=AJ"
    };
    
    const MOCK_CURRENT_HOSTEL = {
      id: "h-001",
      name: "Bashundhara Hostels",
      room: "A-203",
      rentDueDate: "Nov 10, 2025",
      rentStatus: "Paid"
    };

    const MOCK_AREAS = [
      { id: "a-01", name: "Downtown" },
      { id: "a-02", name: "University Square" },
      { id: "a-03", name: "North Campus" },
      { id: "a-04", name: "Southside" },
    ];

    const MOCK_HOSTELS = [
      { id: "h-001", name: "Bashundhara Hostel", area: "Bashundhara", price: 450, rating: 4.8, available: true, image: "12.jpg", description: "A top-tier hostel offering premium services, high-speed Wi-Fi, and a rooftop terrace. Perfect for professionals and students seeking comfort.", amenities: ["High-speed Wi-Fi", "Rooftop Terrace", "24/7 Security", "Air Conditioning", "Common Kitchen"] },
      { id: "h-002", name: "Hostel By Zoofamily", area: "Bashundhara", price: 300, rating: 4.2, available: true, image: "13.jpg", description: "The perfect spot for travelers on a budget. We offer clean dorms, a friendly atmosphere, and are located right in the heart of the city.", amenities: ["Free Wi-Fi", "Locker Storage", "Shared Lounge", "Communal Kitchen", "Laundry Facilities"] },
      { id: "h-003", name: "Mir Hostel", area: "mirpur", price: 380, rating: 4.5, available: false, image: "11.jpg", description: "Located just steps from the university, this dorm is ideal for students. Features quiet study areas and weekly social events.", amenities: ["Study Lounge", "Free Wi-Fi", "Cafe on-site", "Gym Access", "24/7 Security"] },
      { id: "h-004", name: "Japanese Lodge Hydrangea", area: "Purbachal", price: 410, rating: 4.6, available: true, image: "10.jpg", description: "Modern, clean, and convenient. Campus Side Living provides all the comforts of home, right next to campus.", amenities: ["Private Rooms", "High-speed Wi-Fi", "Air Conditioning", "On-site Parking", "Common Kitchen"] },
      { id: "h-005", name: "Hotel Nyzote Inn", area: "Mohammadpur", price: 390, rating: 4.3, available: true, image: "1.jpg", description: "Explore the vibrant Southside! Our residences offer a blend of comfort and local culture, with easy access to shops and restaurants.", amenities: ["Free-Moving-Wi-Fi", "Ensuite Bathrooms", "Shared Lounge", "24/7 Reception", "Laundry Facilities"] },
       { id: "h-006", name: "matikata hostel", area: "Bashundhara", price: 450, rating: 4.8, available: true, image: "2.jpg", description: "A top-tier hostel offering premium services, high-speed Wi-Fi, and a rooftop terrace. Perfect for professionals and students seeking comfort.", amenities: ["High-speed Wi-Fi", "Rooftop Terrace", "24/7 Security", "Air Conditioning", "Common Kitchen"] },
      { id: "h-007", name: "Diabari Hostel", area: "Uttara", price: 300, rating: 4.2, available: true, image: "3.jpg", description: "The perfect spot for travelers on a budget. We offer clean dorms, a friendly atmosphere, and are located right in the heart of the city.", amenities: ["Free Wi-Fi", "Locker Storage", "Shared Lounge", "Communal Kitchen", "Laundry Facilities"] },
      { id: "h-008", name: "Tulip Homestay", area: "mirpur", price: 380, rating: 4.5, available: false, image: "4.jpg", description: "Located just steps from the university, this dorm is ideal for students. Features quiet study areas and weekly social events.", amenities: ["Study Lounge", "Free-Type", "Cafe on-site", "Gym Access", "24/7 Security"] },
      { id: "h-009", name: "Baridhara Hostel", area: "Baridhara", price: 410, rating: 4.6, available: true, image: "5.jpg", description: "Modern, clean, and convenient. Campus Side Living provides all the comforts of home, right next to campus.", amenities: ["Private Rooms", "High-speed Wi-Fi", "Air Conditioning", "On-site Parking", "Common Kitchen"] },
      { id: "h-010", name: "Nila Hostel", area: "Purbachal", price: 390, rating: 4.3, available: true, image: "6.jpg", description: "Explore the vibrant Southside! Our residences offer a blend of comfort and local culture, with easy access to shops and restaurants.", amenities: ["Free-Moving-Wi-Fi", "Ensuite Bathrooms", "Shared Lounge", "24/7 Reception", "Laundry Facilities"] },
      { id: "h-011", name: "Dhaka Hostel", area: "Bashundhara", price: 450, rating: 4.8, available: true, image: "12.jpg", description: "A top-tier hostel offering premium services, high-speed Wi-Fi, and a rooftop terrace. Perfect for professionals and students seeking comfort.", amenities: ["High-speed Wi-Fi", "Rooftop Terrace", "24/7 Security", "Air Conditioning", "Common Kitchen"] },
      { id: "h-012", name: " jihan By Zoofamily", area: "Bashundhara", price: 300, rating: 4.2, available: true, image: "13.jpg", description: "The perfect spot for travelers on a budget. We offer clean dorms, a friendly atmosphere, and are located right in the heart of the city.", amenities: ["Free Wi-Fi", "Locker Storage", "Shared Lounge", "Communal Kitchen", "Laundry Facilities"] },
      { id: "h-013", name: "raj Hostel", area: "mirpur", price: 380, rating: 4.5, available: false, image: "11.jpg", description: "Located just steps from the university, this dorm is ideal for students. Features quiet study areas and weekly social events.", amenities: ["Study Lounge", "Free Wi-Fi", "Cafe on-site", "Gym Access", "24/7 Security"] },
      { id: "h-014", name: "chinees Lodge Hydrangea", area: "Purbachal", price: 410, rating: 4.6, available: true, image: "10.jpg", description: "Modern, clean, and convenient. Campus Side Living provides all the comforts of home, right next to campus.", amenities: ["Private Rooms", "High-speed Wi-Fi", "Air Conditioning", "On-site Parking", "Common Kitchen"] },
      { id: "h-015", name: "Hotel Nyzote", area: "Mohammadpur", price: 390, rating: 4.3, available: true, image: "1.jpg", description: "Explore the vibrant Southside! Our residences offer a blend of comfort and local culture, with easy access to shops and restaurants.", amenities: ["Free-Moving-Wi-Fi", "Ensuite Bathrooms", "Shared Lounge", "24/7 Reception", "Laundry Facilities"] },
       { id: "h-016", name: "mati hostel", area: "Bashundhara", price: 450, rating: 4.8, available: true, image: "2.jpg", description: "A top-tier hostel offering premium services, high-speed Wi-Fi, and a rooftop terrace. Perfect for professionals and students seeking comfort.", amenities: ["High-speed Wi-Fi", "Rooftop Terrace", "24/7 Security", "Air Conditioning", "Common Kitchen"] },
      { id: "h-017", name: "Uttara Hostel", area: "Uttara", price: 300, rating: 4.2, available: true, image: "3.jpg", description: "The perfect spot for travelers on a budget. We offer clean dorms, a friendly atmosphere, and are located right in the heart of the city.", amenities: ["Free Wi-Fi", "Locker Storage", "Shared Lounge", "Communal Kitchen", "Laundry Facilities"] },
     
    ];

    const MOCK_COMPLAINTS = [
      { id: "c-01", title: "Leaky Faucet in Room A-203", status: "In Progress", date: "Nov 02, 2025" },
      { id: "c-02", title: "Wi-Fi not working on 3rd floor", status: "Pending", date: "Nov 04, 2025" },
      { id: "c-03", title: "Broken light in common room", status: "Completed", date: "Oct 28, 2025" },
    ];
    
    const MOCK_RENT_HISTORY = [
      { id: "r-01", month: "November 2025", amount: 450, status: "Paid", date: "Nov 01, 2025" },
      { id: "r-02", month: "October 2025", amount: 450, status: "Paid", date: "Oct 01, 2025" },
      { id: "r-03", month: "September 2025", amount: 450, status: "Paid", date: "Sep 01, 2025" },
      { id: "r-04", month: "August 2025", amount: 450, status: "Paid", date: "Aug 01, 2025" },
    ];


    // --- Reusable Components ---
    
    // New Top Navigation Bar component
    const TopNavbar = ({ currentPage, setCurrentPage }) => {
      const navItems = [
        { id: 'dashboard', label: 'Dashboard' },
        { id: 'hostelList', label: 'Hostels' },
        { id: 'complaints', label: 'Complaints' },
        { id: 'rent', label: 'Rent' },
        { id: 'nid', label: 'NID Access' },
        { id: 'security', label: 'Security' },
      ];

      return (
        // --- MODIFIED: bg-black/80 changed to bg-black/90 for darkest glass effect on Nav Bar ---
        <nav className="w-full bg-black/90 backdrop-blur-lg border-b border-white/20 text-white shadow-md p-4 flex justify-between items-center sticky top-0 z-50">
          
          {/* Logo / Title */}
          <div className="font-bold text-2xl">
            HostelMgmt
          </div>

          {/* Links */}
          <div className="flex items-center space-x-6">
            <ul className="hidden md:flex items-center space-x-6">
              {navItems.map(item => (
                <li key={item.id}>
                  <button
                    onClick={() => setCurrentPage(item.id)}
                    className={`font-medium text-lg text-gray-200 hover:text-white transition-all
                      ${currentPage === item.id 
                        ? 'pb-1 border-b-2 border-white' 
                        : ''
                      }`}
                  >
                    {item.label}
                  </button>
                </li>
              ))}
            </ul>
            
            {/* User/Logout Button */}
            <div className="flex items-center ml-6 border-l border-gray-500 pl-6 space-x-4">
              <span className="font-medium hidden sm:block">Hi, {MOCK_USER.name.split(' ')[0]}</span>
              <button 
                onClick={() => { window.location.href = 'login.php'; }}
                title="Logout"
                className="font-medium text-red-400 hover:text-red-300"
              >
                <IconLogout className="w-6 h-6" />
              </button>
            </div>
          </div>
        </nav>
      );
    };

    // StatCard component restyled for darker frosted glass
    const StatCard = ({ title, value, icon, color }) => (
      // --- MODIFIED: bg-black/80 changed to bg-black/90 for darker card effect ---
      <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md flex items-center space-x-4">
        <div className={`p-3 rounded-full ${color}`}>
          {icon}
        </div>
        <div>
          <div className="text-sm font-medium text-gray-200">{title}</div>
          <div className="text-2xl font-bold text-white">{value}</div>
        </div>
      </div>
    );


    // --- Page Components ---

    // DashboardView restyled for darker frosted glass
    const DashboardView = ({ setCurrentPage }) => {
      const rentStatusColor = MOCK_CURRENT_HOSTEL.rentStatus === 'Paid'
        ? 'bg-green-200 text-green-800'
        : 'bg-red-200 text-red-800'; 

      const chartData = [
        { month: 'Jul', expenses: 60 },
        { month: 'Aug', expenses: 50 },
        { month: 'Sep', expenses: 70 },
        { month: 'Oct', expenses: 90 },
        { month: 'Nov', expenses: 80 },
      ];

      return (
        <div className="space-y-8">
          <h1 className="text-3xl font-bold text-white">Welcome back, {MOCK_USER.name.split(' ')[0]}!</h1>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <StatCard
              title="Current Hostel"
              value={MOCK_CURRENT_HOSTEL.room}
              icon={<IconBedDouble className="w-6 h-6 text-blue-600" />}
              color="bg-blue-100"
            />
            <StatCard
              title="Rent Due"
              value={MOCK_CURRENT_HOSTEL.rentDueDate}
              icon={<IconCalendar className="w-6 h-6 text-green-600" />}
              color="bg-green-100"
            />
            <StatCard
              title="Open Complaints"
              value={MOCK_COMPLAINTS.filter(c => c.status !== 'Completed').length}
              icon={<IconWrench className="w-6 h-6 text-yellow-600" />}
              color="bg-yellow-100"
            />
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {/* Card restyled for darker frosted glass */}
            {/* --- MODIFIED: bg-black/80 changed to bg-black/90 --- */}
            <div className="lg:col-span-2 bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-xl font-semibold mb-4 text-white">Current Hostel Details</h2>
              <div className="space-y-3">
                <h3 className="text-2xl font-bold text-blue-300">{MOCK_CURRENT_HOSTEL.name}</h3>
                <p className="text-gray-200 font-medium">Room: <span className="text-white">{MOCK_CURRENT_HOSTEL.room}</span></p>
                <div className="flex items-center">
                  <p className="text-gray-200 font-medium">Rent Status:</p>
                  <span className={`ml-2 px-3 py-1 rounded-full text-sm font-medium ${rentStatusColor}`}>
                    {MOCK_CURRENT_HOSTEL.rentStatus}
                  </span>
                </div>
                <div className="flex pt-4 space-x-4">
                  <button
                    onClick={() => setCurrentPage('rent')}
                    className="flex items-center bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition-all"
                  >
                    <IconDollarSign className="w-5 h-5 mr-2" />
                    Pay Rent
                  </button>
                  <button
                    onClick={() => setCurrentPage('complaints')}
                    className="flex items-center bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition-all"
                  >
                    <IconWrench className="w-5 h-5 mr-2" />
                    File Complaint
                  </button>
                </div>
              </div>
            </div>

            {/* Card restyled for darker frosted glass */}
            {/* --- MODIFIED: bg-black/80 changed to bg-black/90 --- */}
            <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-xl font-semibold mb-4 text-white">Monthly Expenses</h2>
              <div className="flex items-end justify-between h-48 space-x-2">
                {chartData.map((data, index) => (
                  <div key={index} className="flex flex-col items-center flex-1">
                    <div
                      className="w-full bg-blue-500 rounded-t-lg hover:bg-blue-600 transition-all"
                      style={{ height: `${data.expenses}%` }}
                      title={`$${data.expenses}`}
                    ></div>
                    <span className="text-xs font-medium text-gray-200 mt-2">{data.month}</span>
                  </div>
                ))}
              </div>
            </div>
          </div>
          
          {/* Card restyled for darker frosted glass */}
          {/* --- MODIFIED: bg-black/80 changed to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-xl font-semibold mb-4 text-white">Find a New Hostel</h2>
            <p className="text-gray-200 mb-6">Explore hostels in different areas.</p>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
              {MOCK_AREAS.map(area => (
                <button
                  key={area.id}
                  onClick={() => setCurrentPage('hostelList')} 
                  className="flex flex-col items-center justify-center p-4 bg-white/10 rounded-lg border border-white/20 hover:shadow-md hover:bg-white/20 transition-all"
                >
                  <IconMapPin className="w-8 h-8 text-blue-400 mb-2" />
                  <span className="font-medium text-white">{area.name}</span>
                </button>
              ))}
            </div>
          </div>
        </div>
      );
    };


    // HostelListView restyled for dark frosted glass
    const HostelListView = ({ setCurrentPage, setSelectedHostelId }) => {
      const [searchQuery, setSearchQuery] = useState('');

      const filteredHostels = MOCK_HOSTELS.filter(hostel =>
        hostel.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
        hostel.area.toLowerCase().includes(searchQuery.toLowerCase())
      );

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Hostel Search</h1>
          
          <div className="relative max-w-lg">
            <input 
              type="text" 
              placeholder="Search by name or area..." 
              className="w-full pl-10 pr-4 py-3 rounded-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
              value={searchQuery} 
              onChange={(e) => setSearchQuery(e.target.value)} 
            />
            <IconSearch className="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
          </div>

          {/* --- MODIFIED: Hostel cards changed from bg-black/80 to bg-black/90 --- */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredHostels.length > 0 ? (
              filteredHostels.map(hostel => (
                <div key={hostel.id} className="bg-black/90 backdrop-blur-lg border border-white/20 text-white rounded-xl shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                  <img src={hostel.image} alt={hostel.name} className="w-full h-48 object-cover" onError={(e) => { e.target.src = 'https://placehold.co/600x400/cccccc/707070?text=Image+Error'; }} />
                  <div className="p-6">
                    <div className="flex justify-between items-start mb-2">
                      <span className="text-sm font-medium text-blue-400">{hostel.area}</span>
                      <span className={`px-3 py-1 rounded-full text-xs font-semibold ${hostel.available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`}>
                        {hostel.available ? 'Available' : 'Full'}
                      </span>
                    </div>
                    <h3 className="text-xl font-bold text-white mb-2">{hostel.name}</h3>
                    <div className="flex justify-between items-center">
                      <div className="text-lg font-bold text-white">
                        {hostel.price}<span className="text-sm font-normal text-gray-300">/month</span>
                      </div>
                      <div className="flex items-center">
                        <span className="text-yellow-500">&#9733;</span>
                        <span className="ml-1 text-white font-medium">{hostel.rating}</span>
                      </div>
                    </div>
                    <button
                      className="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition-all disabled:bg-gray-400"
                      disabled={!hostel.available}
                      onClick={() => {
                        setSelectedHostelId(hostel.id);
                        setCurrentPage('hostelDetail');
                      }}
                    >
                      {hostel.available ? 'View Details' : 'Notify Me'}
                    </button>
                  </div>
                </div>
              ))
            ) : (
              <p className="text-gray-200 col-span-full text-center">No hostels found matching your search.</p>
            )}
          </div>
        </div>
      );
    };

    // HostelDetailView restyled for dark frosted glass
    const HostelDetailView = ({ hostelId, setCurrentPage, setSelectedHostelId }) => {
      const hostel = MOCK_HOSTELS.find(h => h.id === hostelId);

      if (!hostel) {
        return (
          // --- MODIFIED: bg-black/80 changed to bg-black/90 ---
          <div className="p-8 bg-black/90 backdrop-blur-lg border border-white/20 text-white rounded-xl">
            <p>Hostel not found.</p>
            <button onClick={() => setCurrentPage('hostelList')} className="mt-4 text-blue-400 hover:underline">
              Go back to Hostel List
            </button>
          </div>
        );
      }

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('hostelList')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Hostel List
          </button>
          
          {/* --- MODIFIED: Main container changed from bg-black/80 to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 md:p-8 rounded-xl shadow-md">
            <h1 className="text-3xl font-bold text-white mb-6">{hostel.name}</h1>
            
            <img 
              src={hostel.image} 
              alt={hostel.name} 
              className="w-full h-64 object-cover rounded-lg mb-6"
              onError={(e) => { e.target.src = 'https://placehold.co/800x400/cccccc/707070?text=Image+Error'; }}
            />

            <div className="flex justify-between items-center mb-4 border-b border-white/20 pb-4">
              <div className="flex items-center text-gray-200">
                <IconMapPin className="w-5 h-5 text-blue-400 mr-2" />
                <span className="font-medium">{hostel.area}</span>
              </div>
              <div className="flex items-center">
                <span className="text-yellow-500 text-lg">&#9733;</span>
                <span className="ml-1 text-white font-medium">{hostel.rating}</span>
              </div>
            </div>

            <p className="text-gray-200 mb-6">{hostel.description}</p>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h2 className="text-xl font-semibold text-white mb-4">Amenities</h2>
                <ul className="space-y-2">
                  {hostel.amenities.map(amenity => (
                    <li key={amenity} className="flex items-center text-gray-200">
                      <IconCheck className="w-5 h-5 text-green-500 mr-2" />
                      <span>{amenity}</span>
                    </li>
                  ))}
                </ul>
              </div>
              {/* --- MODIFIED: Inner summary box changed from bg-black/40 to bg-black/80 for a more solid, dark look --- */}
              <div className="bg-black/80 p-6 rounded-lg shadow-inner">
                <div className="text-3xl font-bold text-white mb-2">
                  {hostel.price} 
                  <span className="text-base font-normal text-gray-300">/month</span>
                </div>
                <p className="text-gray-200 mb-4">All bills included. No hidden fees.</p>
                <button
                  className="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-all disabled:bg-gray-400"
                  disabled={!hostel.available}
                  onClick={() => window.location.href = 'nid.php'}
                >
                  {hostel.available ? 'Book Now' : 'Join Waitlist'}
                </button>
              </div>
            </div>
          </div>
        </div>
      );
    };

    // ComplaintView restyled for darker frosted glass
    const ComplaintView = ({ setCurrentPage }) => {
      const getStatusColor = (status) => {
        switch (status) {
          case 'In Progress': return 'bg-yellow-100 text-yellow-700';
          case 'Pending': return 'bg-red-100 text-red-700';
          case 'Completed': return 'bg-green-100 text-green-700';
          default: return 'bg-gray-100 text-gray-700';
        }
      };

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Complaints & Repairs</h1>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
            <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-2xl font-bold text-white mb-4">File a New Complaint</h2>
              <form className="space-y-4">
                <div>
                  <label htmlFor="title" className="block text-sm font-medium text-gray-300 mb-2">Issue Title</label>
                  <input type="text" id="title" placeholder="e.g., Leaky faucet" className="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>
                <div>
                  <label htmlFor="details" className="block text-sm font-medium text-gray-300 mb-2">Details</label>
                  <textarea id="details" rows="4" placeholder="Describe the issue and location (e.g., Room A-203 bathroom)." className="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <button type="submit" className="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition-all">
                  Submit Complaint
                </button>
              </form>
            </div>

            {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
            <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-2xl font-bold text-white mb-6">Your Complaint History</h2>
              <ul className="space-y-4">
                {MOCK_COMPLAINTS.map(complaint => (
                  <li key={complaint.id} className="p-4 border border-gray-600 bg-gray-800/20 rounded-lg">
                    <div className="flex justify-between items-center mb-1">
                      <h3 className="font-semibold text-white">{complaint.title}</h3>
                      <span className={`px-3 py-1 rounded-full text-xs font-semibold ${getStatusColor(complaint.status)}`}>
                        {complaint.status}
                      </span>
                    </div>
                    <p className="text-sm text-gray-300">{complaint.date}</p>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      );
    };

    // RentView restyled for darker frosted glass
    const RentView = ({ setCurrentPage }) => {
      const getStatusColor = (status) => {
        return status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
      };

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Rent Overview</h1>

          {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <div className="md:col-span-2">
              <h2 className="text-lg font-semibold text-white">November 2025 Rent</h2>
              <p className="text-3xl font-bold text-white">450.00 Tk</p>
              <p className="text-sm text-gray-300">Due: {MOCK_CURRENT_HOSTEL.rentDueDate}</p>
            </div>
            <div className="flex flex-col items-start md:items-end">
              <span className={`mb-4 px-3 py-1 rounded-full text-sm font-medium ${getStatusColor(MOCK_CURRENT_HOSTEL.rentStatus)}`}>
                {MOCK_CURRENT_HOSTEL.rentStatus}
              </span>
              <button 
                className="w-full md:w-auto bg-green-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-green-700 transition-all"
                disabled={MOCK_CURRENT_HOSTEL.rentStatus === 'Paid'}
              >
                Pay Now
              </button>
            </div>
          </div>

          {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-2xl font-bold text-white mb-6">Rent Payment History</h2>
            <ul className="space-y-3">
              {MOCK_RENT_HISTORY.map(rent => (
                <li key={rent.id} className="flex justify-between items-center p-4 bg-gray-800/20 rounded-lg border border-white/10">
                  <div className="font-semibold text-white">{rent.month}</div>
                  <div className="flex items-center space-x-4">
                    <span className="text-lg font-bold text-white">${rent.amount}.00</span>
                    <span className={`px-3 py-1 rounded-full text-xs font-semibold ${getStatusColor(rent.status)}`}>
                      {rent.status}
                    </span>
                  </div>
                </li>
              ))}
            </ul>
          </div>
        </div>
      );
    };

    // NidAccessView restyled for darker frosted glass
    const NidAccessView = ({ setCurrentPage }) => {
      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">NID Access & Verification</h1>

          {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-2xl font-bold text-white mb-4">Your Verification Status</h2>
            <div className="flex items-center">
              <span className="flex items-center px-4 py-2 rounded-full text-lg font-semibold bg-green-100 text-green-700">
                <IconCheck className="w-6 h-6 mr-2" /> Verified
              </span>
              <p className="ml-4 text-gray-200">Your NID was successfully verified on Oct 15, 2025.</p>
            </div>
          </div>

          {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-2xl font-bold text-white mb-6">Your NID Information</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label className="block text-sm font-medium text-gray-300">Full Name</label>
                <p className="text-lg font-medium text-white">{MOCK_USER.name}</p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-300">NID Number</label>
                <p className="text-lg font-medium text-white">1998********1234</p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-300">Date of Birth</label>
                <p className="text-lg font-medium text-white">Jan 01, 1998</p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-300">Permanent Address</label>
                <p className="text-lg font-medium text-white">123 Main St, Dhaka, Bangladesh</p>
              </div>
            </div>
            <p className="mt-6 text-sm text-gray-300">For security reasons, some information is masked. Please contact administration if you need to update your details.</p>
          </div>

          {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
          <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-2xl font-bold text-white mb-4">Upload NID/ID Card (if not verified)</h2>
            <p className="text-gray-300 mb-4">Please upload a clear, scanned image of your national ID card (front and back).</p>
            <form>
              <input type="file" className="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
              <button type="submit" className="mt-4 bg-blue-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-blue-700 transition-all">
                Upload & Submit for Verification
              </button>
            </form>
          </div>
        </div>
      );
    };

    // SecurityView restyled for darker frosted glass
    const SecurityView = ({ setCurrentPage }) => {
      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Security & Safety</h1>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div className="space-y-8">
              {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
              <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
                <h2 className="text-2xl font-bold text-white mb-4">Emergency Contacts</h2>
                <ul className="space-y-3">
                  <li className="flex justify-between">
                    <span className="font-medium text-gray-200">Hostel Warden (Mr. Alam)</span>
                    <span className="font-bold text-white">+880 1700-000111</span>
                  </li>
                  <li className="flex justify-between">
                    <span className="font-medium text-gray-200">Front Security Desk (24/7)</span>
                    <span className="font-bold text-white">Ext: 001</span>
                  </li>
                  <li className="flex justify-between">
                    <span className="font-medium text-gray-200">Local Police Station</span>
                    <span className="font-bold text-white">999</span>
                  </li>
                  <li className="flex justify-between">
                    <span className="font-medium text-gray-200">Ambulance Service</span>
                    <span className="font-bold text-white">109</span>
                  </li>
                </ul>
              </div>

              {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
              <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
                <h2 className="text-2xl font-bold text-white mb-4">Key Security Policies</h2>
                <ul className="list-disc list-inside text-gray-200 space-y-2">
                  <li><strong>Visitor Policy:</strong> All visitors must register at the front desk and must leave the premises by 10:00 PM. No overnight guests are allowed without prior written permission.</li>
                  <li><strong>Quiet Hours:</strong> Quiet hours are enforced from 11:00 PM to 7:00 AM daily. Please be respectful of your fellow residents.</li>
                  <li><strong>Fire Safety:</strong> Fire extinguishers are located on every floor. Please read the emergency exit signs posted in the hallway.</li>
                </ul>
              </div>
            </div>
            
            <div className="space-y-8">
              {/* --- MODIFIED: Card changed from bg-black/80 to bg-black/90 --- */}
              <div className="bg-black/90 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
                <h2 className="text-2xl font-bold text-white mb-4">Report an Incident</h2>
                <form className="space-y-4">
                  <div>
                    <label htmlFor="incident_type" className="block text-sm font-medium text-gray-300 mb-2">Type of Incident</label>
                    <select id="incident_type" className="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option className="bg-gray-800 text-white" value="noise">Noise Complaint</option>
                      <option className="bg-gray-800 text-white" value="damage">Property Damage</option>
                      <option className="bg-gray-800 text-white" value="safety">Safety Concern</option>
                      <option className="bg-gray-800 text-white" value="other">Other</option>
                    </select>
                  </div>
                  <div>
                    <label htmlFor="incident_details" className="block text-sm font-medium text-gray-300 mb-2">Details</label>
                    <textarea id="incident_details" rows="4" placeholder="Describe the incident, time, and location." className="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                  </div>
                  <button type="submit" className="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition-all">
                    Submit Anonymous Report
                  </button>
                </form>
              </div>
            </div>

          </div>
        </div>
      );
    };

    // --- Main App Component ---
    function App() {
      const [currentPage, setCurrentPage] = useState('dashboard');
      const [selectedHostelId, setSelectedHostelId] = useState(null);

      const renderPage = () => {
        switch (currentPage) {
          case 'dashboard':
            return <DashboardView setCurrentPage={setCurrentPage} />;
          case 'hostelList':
            return <HostelListView setCurrentPage={setCurrentPage} setSelectedHostelId={setSelectedHostelId} />;
          case 'hostelDetail':
            return <HostelDetailView hostelId={selectedHostelId} setCurrentPage={setCurrentPage} setSelectedHostelId={setSelectedHostelId} />;
          case 'complaints':
            return <ComplaintView setCurrentPage={setCurrentPage} />;
          case 'rent':
            return <RentView setCurrentPage={setCurrentPage} />;
          case 'nid':
            return <NidAccessView setCurrentPage={setCurrentPage} />;
          case 'security':
            return <SecurityView setCurrentPage={setCurrentPage} />;
            
          default:
            return <DashboardView setCurrentPage={setCurrentPage} />;
        }
      };
      
      return (
        // Changed layout from flex to block
        <div className="min-h-screen font-inter">
          
          {/* Added the new TopNavbar component */}
          <TopNavbar currentPage={currentPage} setCurrentPage={setCurrentPage} />

          {/* Page Content - Renders directly on body background */}
          <main className="max-w-7xl mx-auto p-4 md:p-8">
            {renderPage()}
          </main>

        </div>
      );
    }
    // --- END HEAVILY MODIFIED ---


    // --- Mount the App ---\
    const rootElement = document.getElementById('root');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);

  </script>
</body>
</html>