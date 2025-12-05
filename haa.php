

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

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
      
      /* Your background image styles (Kept as requested) */
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

    // --- SVG Icon Components (omitted for brevity) ---
    
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


    // --- Mock Data (omitted for brevity) ---
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
        // Changed to bg-amber-900/95 for a darker, less transparent brown navigation menu
        <nav className="w-full bg-amber-900/95 backdrop-blur-lg border-b border-white/20 text-white shadow-md p-4 flex justify-between items-center sticky top-0 z-50">
          
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

    // StatCard component restyled for darker brown frosted glass
    const StatCard = ({ title, value, icon, color }) => (
      // Changed to bg-amber-900/95 for a darker, less transparent brown box
      <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md flex items-center space-x-4">
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

    // DashboardView restyled for darker brown frosted glass
    const DashboardView = ({ setCurrentPage }) => {
      const rentStatusColor = MOCK_CURRENT_HOSTEL.rentStatus === 'Paid' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700';
      const chartData = [
        { month: 'Aug', expenses: 60 },
        { month: 'Sep', expenses: 80 },
        { month: 'Oct', expenses: 70 },
        { month: 'Nov', expenses: 95 },
      ];

      return (
        <div className="space-y-8">
          <h1 className="text-3xl font-bold text-white">Welcome Back, {MOCK_USER.name.split(' ')[0]}!</h1>
          
          {/* Stats Grid */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <StatCard 
              title="Current Hostel" 
              value={MOCK_CURRENT_HOSTEL.name} 
              icon={<IconBedDouble className="w-6 h-6" />} 
              color="bg-amber-300 text-amber-800" 
            />
            <StatCard 
              title="Room Number" 
              value={MOCK_CURRENT_HOSTEL.room} 
              icon={<IconMapPin className="w-6 h-6" />} 
              color="bg-blue-300 text-blue-800" 
            />
            <StatCard 
              title="Rent Status" 
              value={MOCK_CURRENT_HOSTEL.rentStatus} 
              icon={<IconDollarSign className="w-6 h-6" />} 
              color={MOCK_CURRENT_HOSTEL.rentStatus === 'Paid' ? "bg-green-300 text-green-800" : "bg-red-300 text-red-800"} 
            />
            <StatCard 
              title="Complaints" 
              value={MOCK_COMPLAINTS.filter(c => c.status !== 'Completed').length} 
              icon={<IconWrench className="w-6 h-6" />} 
              color="bg-purple-300 text-purple-800" 
            />
          </div>

          {/* Main Content Grid */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {/* My Hostel Card - changed to bg-amber-900/95 for a darker, less transparent brown box */}
            <div className="lg:col-span-2 bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-xl font-semibold mb-4 text-white">My Hostel & Actions</h2>
              <div className="space-y-3 border-b border-white/20 pb-4">
                <p className="text-lg font-bold text-white">{MOCK_CURRENT_HOSTEL.name} - Room {MOCK_CURRENT_HOSTEL.room}</p>
                <p><span className="font-medium text-white">Rent Status:</span> <span className={`px-3 py-1 rounded-full text-sm font-semibold ${rentStatusColor}`}>{MOCK_CURRENT_HOSTEL.rentStatus}</span></p>
                <p><span className="font-medium text-white">Next Due Date:</span> {MOCK_CURRENT_HOSTEL.rentDueDate}</p>
              </div>
              <div className="mt-6 flex space-x-4">
                {/* MODIFIED: Changed bg-green-600/700 to bg-gray-900/black for darker action button */}
                <button 
                  onClick={() => setCurrentPage('rent')} 
                  disabled={MOCK_CURRENT_HOSTEL.rentStatus === 'Paid'}
                  className="flex items-center bg-gray-900 text-white px-4 py-2 rounded-lg font-medium hover:bg-black transition-all disabled:bg-gray-500"
                >
                  <IconDollarSign className="w-5 h-5 mr-2" /> Pay Rent
                </button>
                <button 
                  onClick={() => setCurrentPage('complaints')}
                  className="flex items-center bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition-all"
                >
                  <IconWrench className="w-5 h-5 mr-2" /> File Complaint
                </button>
              </div>
            </div>

            {/* Monthly Expenses Chart */}
            {/* Card changed to bg-amber-900/95 for a darker, less transparent brown box */}
            <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
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

          {/* Find New Hostel Card */}
          {/* Card changed to bg-amber-900/95 for a darker, less transparent brown box */}
          <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-xl font-semibold mb-4 text-white">Find a New Hostel</h2>
            <p className="text-gray-200 mb-6">Explore hostels in different areas.</p>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
              {MOCK_AREAS.map(area => (
                <button 
                  key={area.id}
                  onClick={() => setCurrentPage('hostelList')}
                  className="bg-amber-800 hover:bg-amber-700 text-white font-medium py-3 px-4 rounded-lg transition-all"
                >
                  {area.name}
                </button>
              ))}
              <button 
                  onClick={() => setCurrentPage('hostelList')}
                  className="bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-lg transition-all"
                >
                  View All ({MOCK_HOSTELS.length})
                </button>
            </div>
          </div>
        </div>
      );
    };


    // HostelListView restyled for darker brown frosted glass
    const HostelListView = ({ setCurrentPage, setSelectedHostelId }) => {
      const [searchQuery, setSearchQuery] = useState('');
      const [areaFilter, setAreaFilter] = useState('all');
      const [maxPrice, setMaxPrice] = useState(600);
      const [ratingFilter, setRatingFilter] = useState(0);

      const filteredHostels = MOCK_HOSTELS.filter(hostel => {
        const matchesSearch = hostel.name.toLowerCase().includes(searchQuery.toLowerCase());
        const matchesArea = areaFilter === 'all' || hostel.area.toLowerCase() === areaFilter.toLowerCase();
        const matchesPrice = hostel.price <= maxPrice;
        const matchesRating = hostel.rating >= ratingFilter;
        return matchesSearch && matchesArea && matchesPrice && matchesRating;
      });

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Hostel Listings ({filteredHostels.length} Found)</h1>

          {/* Filters - CHANGED TO bg-amber-900/95 */}
          <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
            <h2 className="text-xl font-semibold text-white mb-4">Filters</h2>
            <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
              
              {/* Search */}
              <div className="md:col-span-2">
                <label htmlFor="search" className="block text-sm font-medium text-gray-300 mb-2">Search Name</label>
                <div className="relative">
                  <IconSearch className="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
                  <input
                    type="text"
                    id="search"
                    value={searchQuery}
                    onChange={(e) => setSearchQuery(e.target.value)}
                    placeholder="Search by hostel name..."
                    className="w-full pl-10 pr-4 py-2 bg-gray-800/50 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>
              </div>

              {/* Area Filter */}
              <div>
                <label htmlFor="area-filter" className="block text-sm font-medium text-gray-300 mb-2">Area</label>
                <select
                  id="area-filter"
                  value={areaFilter}
                  onChange={(e) => setAreaFilter(e.target.value)}
                  className="w-full px-3 py-2 bg-gray-800/50 border border-white/20 rounded-lg text-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="all">All Areas</option>
                  {[...new Set(MOCK_HOSTELS.map(h => h.area))].map(area => (
                    <option key={area} value={area}>{area}</option>
                  ))}
                </select>
              </div>
            
              {/* Price Filter */}
              <div>
                <label htmlFor="price-range" className="block text-sm font-medium text-gray-300 mb-2">Price Range: ${maxPrice === 600 ? '600+' : maxPrice}</label>
                <input
                  type="range"
                  id="price-range"
                  min="0"
                  max="600"
                  step="50"
                  value={maxPrice}
                  onChange={(e) => setMaxPrice(Number(e.target.value))}
                  className="w-full h-2 bg-white/30 rounded-lg appearance-none cursor-pointer range-lg"
                />
              </div>

              {/* Rating Filter */}
              <div>
                <label htmlFor="rating" className="block text-sm font-medium text-gray-300 mb-2">Min Rating: {ratingFilter.toFixed(1)} Stars</label>
                <input
                  type="range"
                  id="rating"
                  min="0"
                  max="5"
                  step="0.1"
                  value={ratingFilter}
                  onChange={(e) => setRatingFilter(Number(e.target.value))}
                  className="w-full h-2 bg-white/30 rounded-lg appearance-none cursor-pointer range-lg"
                />
              </div>

            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {filteredHostels.length > 0 ? (
              filteredHostels.map(hostel => (
                // Individual Hostel Card - CHANGED TO bg-amber-900/95
                <div 
                  key={hostel.id} 
                  className="bg-amber-900/95 backdrop-blur-sm border border-white/20 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer"
                  onClick={() => {
                    setSelectedHostelId(hostel.id);
                    setCurrentPage('hostelDetail');
                  }}
                >
                  <img 
                    src={hostel.image} 
                    alt={hostel.name} 
                    className="w-full h-40 object-cover" 
                    onError={(e) => { e.target.src = 'https://placehold.co/400x200/444444/CFCFCF?text=Hostel+Image'; }}
                  />
                  <div className="p-4">
                    <div className="flex justify-between items-start mb-2">
                      <h3 className="text-xl font-bold text-white leading-tight hover:text-blue-400 transition-colors">{hostel.name}</h3>
                      <span className={`px-3 py-1 text-xs rounded-full font-semibold ml-2 ${hostel.available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`}>
                        {hostel.available ? 'Available' : 'Full'}
                      </span>
                    </div>
                    <div className="flex items-center text-yellow-400 mb-2">
                      <span className="font-bold mr-1">{hostel.rating}</span>
                      <span className="text-sm">&#9733;</span>
                      <span className="text-sm font-semibold text-gray-300 ml-3 flex items-center">
                        <IconMapPin className="w-4 h-4 mr-1 text-red-400" /> {hostel.area} 
                      </span>
                    </div>
                    <p className="text-lg font-bold text-blue-400">${hostel.price} / month</p>
                    <p className="text-sm text-gray-300 mt-2 line-clamp-2">{hostel.description}</p>
                  </div>
                </div>
              ))
            ) : (
              <p className="text-white md:col-span-4 text-lg text-center p-8 bg-amber-900/95 backdrop-blur-lg border border-white/20 rounded-xl">No hostels match your current filters.</p>
            )}
          </div>
        </div>
      );
    };

    // HostelDetailView restyled for dark brown frosted glass
    const HostelDetailView = ({ hostelId, setCurrentPage }) => {
      const hostel = MOCK_HOSTELS.find(h => h.id === hostelId);

      if (!hostel) {
        return (
          <div className="space-y-8">
            <button onClick={() => setCurrentPage('hostelList')} className="flex items-center text-sm text-blue-400 hover:underline">
              <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Listings
            </button>
            <h1 className="text-3xl font-bold text-white">Hostel Not Found</h1>
            <p className="text-gray-200">The requested hostel could not be found.</p>
          </div>
        );
      }

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('hostelList')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Listings
          </button>
          
          {/* Main Card - CHANGED TO bg-amber-900/95 */}
          <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-xl">
            <h1 className="text-4xl font-bold text-white mb-4">{hostel.name}</h1>
            <p className="text-lg font-medium text-gray-300 flex items-center mb-6">
              <IconMapPin className="w-5 h-5 mr-2 text-red-400" /> {hostel.area}
            </p>

            <img 
              src={hostel.image} 
              alt={hostel.name} 
              className="w-full h-64 object-cover rounded-lg mb-6" 
              onError={(e) => { e.target.src = 'https://placehold.co/800x400/444444/CFCFCF?text=Hostel+Image'; }}
            />

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div>
                <p className="text-sm font-medium text-gray-300">Monthly Price</p>
                <p className="text-2xl font-bold text-white">${hostel.price}</p>
              </div>
              <div>
                <p className="text-sm font-medium text-gray-300">Rating</p>
                <p className="text-2xl font-bold text-yellow-400 flex items-center">{hostel.rating} <span className="ml-1 text-base">&#9733;</span></p>
              </div>
              <div>
                <p className="text-sm font-medium text-gray-300">Status</p>
                <span className={`px-4 py-1 rounded-full text-lg font-bold ${hostel.available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`}>
                  {hostel.available ? 'Available' : 'Full'}
                </span>
              </div>
            </div>

            <h2 className="text-xl font-semibold text-white mb-2">Description</h2>
            <p className="text-gray-200 mb-6">{hostel.description}</p>

            <h2 className="text-xl font-semibold text-white mb-2">Key Amenities</h2>
            <ul className="grid grid-cols-2 gap-3 text-gray-200 list-disc list-inside">
              {hostel.amenities.map((amenity, index) => (
                <li key={index} className="flex items-center">
                  <IconCheck className="w-4 h-4 mr-2 text-green-400" /> {amenity}
                </li>
              ))}
            </ul>

            {/* MODIFIED: Changed bg-blue-600/700 to bg-gray-900/black for darker action button */}
            <button 
              className="mt-8 w-full md:w-auto bg-gray-900 text-white py-3 px-6 rounded-lg text-lg font-medium hover:bg-black transition-all disabled:bg-gray-400" 
              disabled={!hostel.available}
            >
              {hostel.available ? 'Book Now' : 'Join Waitlist'}
            </button>
          </div>
        </div>
      );
    };

    // ComplaintView restyled for dark brown frosted glass
    const ComplaintView = ({ setCurrentPage }) => {
      const getStatusColor = (status) => {
        if (status === 'Completed') return 'bg-green-100 text-green-700';
        if (status === 'In Progress') return 'bg-yellow-100 text-yellow-700';
        return 'bg-red-100 text-red-700'; // Pending
      };

      const [newComplaintTitle, setNewComplaintTitle] = useState('');

      const handleSubmit = (e) => {
        e.preventDefault();
        if (newComplaintTitle.trim()) {
          // In a real app, you would send this to a server
          alert(`Complaint submitted: "${newComplaintTitle}"`);
          setNewComplaintTitle('');
        }
      };

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Maintenance & Complaints</h1>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {/* File New Complaint Card - CHANGED TO bg-amber-900/95 */}
            <div className="lg:col-span-1 bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md h-full">
              <h2 className="text-2xl font-bold text-white mb-4">File a New Complaint</h2>
              <form onSubmit={handleSubmit}>
                <label htmlFor="complaint-title" className="block text-sm font-medium text-gray-300 mb-2">Issue Title</label>
                <input
                  id="complaint-title"
                  type="text"
                  value={newComplaintTitle}
                  onChange={(e) => setNewComplaintTitle(e.target.value)}
                  placeholder="e.g., Leaky faucet, AC not working"
                  required
                  className="w-full px-3 py-2 bg-gray-800/50 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                />
                <p className="text-xs text-gray-400 mt-1">A maintenance worker will be dispatched within 24 hours.</p>
                
                <button 
                  type="submit" 
                  className="mt-4 w-full md:w-auto bg-red-600 text-white py-3 px-6 rounded-lg text-lg font-medium hover:bg-red-700 transition-all"
                >
                  <IconWrench className="w-5 h-5 mr-2 inline-block" /> Submit Complaint
                </button>
              </form>
            </div>

            {/* Complaint History Card - CHANGED TO bg-amber-900/95 */}
            <div className="lg:col-span-2 bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md h-full">
              <h2 className="text-2xl font-bold text-white mb-4">Your Complaint History</h2>
              
              {MOCK_COMPLAINTS.length > 0 ? (
                <ul className="space-y-3">
                  {MOCK_COMPLAINTS.map(complaint => (
                    <li key={complaint.id} className="flex justify-between items-center p-4 bg-gray-800/20 rounded-lg border border-white/10">
                      <div className="flex-1 min-w-0">
                        <div className="font-semibold text-white truncate">{complaint.title}</div>
                        <div className="text-sm text-gray-400">{complaint.date}</div>
                      </div>
                      <span className={`px-3 py-1 rounded-full text-xs font-semibold ${getStatusColor(complaint.status)} ml-4`}>
                        {complaint.status}
                      </span>
                    </li>
                  ))}
                </ul>
              ) : (
                <p className="text-gray-400">No complaints filed yet.</p>
              )}
            </div>
          </div>
        </div>
      );
    };

    // RentView restyled for dark brown frosted glass
    const RentView = ({ setCurrentPage }) => {
      const rentStatusColor = MOCK_CURRENT_HOSTEL.rentStatus === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
      const getStatusColor = (status) => {
        return status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
      };
      
      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Rent & Billing</h1>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {/* Current Billing Card - CHANGED TO bg-amber-900/95 */}
            <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-2xl font-bold text-white mb-4">Current Billing Cycle</h2>
              <div className="space-y-4">
                <div className="flex justify-between border-b border-white/20 pb-2">
                  <span className="text-gray-300">Hostel Rent:</span>
                  <span className="text-white font-bold">$450.00</span>
                </div>
                <div className="flex justify-between border-b border-white/20 pb-2">
                  <span className="text-gray-300">Utilities (Est.):</span>
                  <span className="text-white font-bold">$50.00</span>
                </div>
                <div className="flex justify-between border-b border-white/20 pb-2">
                  <span className="text-gray-300">Maintenance Fee:</span>
                  <span className="text-white font-bold">$0.00</span>
                </div>
                <div className="flex justify-between pt-2">
                  <span className="text-xl font-bold text-white">Total Due:</span>
                  <span className="text-xl font-bold text-white">$500.00</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-300">Due Date:</span>
                  <span className="text-red-400 font-semibold">{MOCK_CURRENT_HOSTEL.rentDueDate}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-300">Status:</span>
                  <span className={`px-3 py-1 rounded-full text-sm font-semibold ${rentStatusColor}`}>{MOCK_CURRENT_HOSTEL.rentStatus}</span>
                </div>
              </div>

              {/* MODIFIED: Changed bg-green-600/700 to bg-gray-900/black for darker action button */}
              <button 
                disabled={MOCK_CURRENT_HOSTEL.rentStatus === 'Paid'}
                className="mt-6 w-full md:w-auto bg-gray-900 text-white py-3 px-6 rounded-lg text-lg font-medium hover:bg-black transition-all disabled:bg-gray-400"
              >
                <IconDollarSign className="w-5 h-5 mr-2 inline-block" /> Proceed to Payment
              </button>
            </div>

            {/* Rent History Card - CHANGED TO bg-amber-900/95 */}
            <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-2xl font-bold text-white mb-4">Rent Payment History</h2>
              <ul className="space-y-3">
                {MOCK_RENT_HISTORY.map(payment => (
                  <li key={payment.id} className="flex justify-between items-center p-4 bg-gray-800/20 rounded-lg border border-white/10">
                    <div className="flex-1 min-w-0">
                      <div className="font-semibold text-white">{payment.month}</div>
                      <div className="text-sm text-gray-400">{payment.date}</div>
                    </div>
                    <div className="text-right">
                      <div className="text-lg font-bold text-white">${payment.amount}.00</div>
                      <span className={`px-3 py-1 rounded-full text-xs font-semibold ${getStatusColor(payment.status)} ml-4`}>
                        {payment.status}
                      </span>
                    </div>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      );
    };

    // NidAccessView restyled for dark brown frosted glass
    const NidAccessView = ({ setCurrentPage }) => {
      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">NID Verification & Access</h1>
          
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {/* Verification Status Card - CHANGED TO bg-amber-900/95 */}
            <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-2xl font-bold text-white mb-4">Your Verification Status</h2>
              <div className="flex items-center">
                <span className="flex items-center px-4 py-2 rounded-full text-lg font-semibold bg-green-100 text-green-700">
                  <IconCheck className="w-6 h-6 mr-2" /> Verified
                </span>
                <p className="ml-4 text-gray-200">Your NID was successfully verified on Oct 15, 2025.</p>
              </div>
            </div>

            {/* NID Information Card - CHANGED TO bg-amber-900/95 */}
            <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md">
              <h2 className="text-2xl font-bold text-white mb-6">Your NID Information</h2>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">NID Number</label>
                  <p className="text-white text-lg font-semibold">1987-1234567-890</p>
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">Date of Birth</label>
                  <p className="text-white text-lg font-semibold">15/01/1987</p>
                </div>
                <div className="md:col-span-2">
                  <label className="block text-sm font-medium text-gray-300 mb-2">Address</label>
                  <p className="text-white text-lg font-semibold">123/A, Kazi Nazrul Islam Road, Dhaka-1209</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      );
    };

    // SecurityView restyled for dark brown frosted glass
    const SecurityView = ({ setCurrentPage }) => {
      const accessLog = [
        { time: '1:15 AM - OUT', date: '27 Nov 2025', status: 'OUT' },
        { time: '12:30 AM - IN', date: '27 Nov 2025', status: 'IN' },
        { time: '10:00 PM - OUT', date: '26 Nov 2025', status: 'OUT' },
        { time: '6:00 PM - IN', date: '26 Nov 2025', status: 'IN' },
        { time: '1:00 PM - OUT', date: '26 Nov 2025', status: 'OUT' },
      ];

      return (
        <div className="space-y-8">
          <button onClick={() => setCurrentPage('dashboard')} className="flex items-center text-sm text-blue-400 hover:underline">
            <IconChevronLeft className="w-4 h-4 mr-1" /> Back to Dashboard
          </button>
          <h1 className="text-3xl font-bold text-white">Security & Access</h1>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {/* Card 1: CCTV/Access log - CHANGED TO bg-amber-900/95 */}
            <div className="lg:col-span-2 bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md h-full">
              <h2 className="text-2xl font-bold text-white mb-4">Recent Access Log (Room A-203)</h2>
              <ul className="space-y-3 text-sm">
                {accessLog.map((log, index) => (
                  <li key={index} className="flex justify-between text-gray-200 border-b border-white/10 pb-2">
                    <span className="font-medium">{log.date}</span>
                    <span className={`font-bold ${log.status === 'IN' ? 'text-green-400' : 'text-red-400'}`}>{log.time}</span>
                  </li>
                ))}
              </ul>
              <button 
                  className="mt-6 w-full md:w-auto bg-gray-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-gray-700 transition-all text-sm"
                >
                  View Full Log
              </button>
            </div>

            {/* Card 2: Security Contact - CHANGED TO bg-amber-900/95 */}
            <div className="bg-amber-900/95 backdrop-blur-lg border border-white/20 p-6 rounded-xl shadow-md h-full">
              <h2 className="text-2xl font-bold text-white mb-4">Emergency Contact</h2>
              <div className="space-y-3">
                <div>
                  <p className="text-sm font-medium text-gray-300">Main Security Desk</p>
                  <p className="text-white text-lg font-semibold">+(880) 123 456 7890</p>
                </div>
                <div>
                  <p className="text-sm font-medium text-gray-300">Management Office</p>
                  <p className="text-white text-lg font-semibold">+(880) 987 654 3210</p>
                </div>
              </div>
              <p className="text-sm text-red-400 mt-4">In case of fire or immediate danger, call local emergency services (999) first.</p>
            </div>
          </div>
        </div>
      );
    };


    // --- Main App Component ---

    const App = () => {
      // Use 'dashboard' as the initial page
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


    // --- Mount the App ---
    const rootElement = document.getElementById('root');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);

  </script>
</body>
</html>