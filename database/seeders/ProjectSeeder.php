<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectDetail;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'project' => [
                    'id'          => 1,
                    'title'       => 'Exam Hall Seating Arrangement System',
                    'level'       => 'Beginner',
                    'description' => 'An automated system to manage exam hall seating, schedules, and notifications. Replaces manual processes with a centralized database and role-based access for admins, teachers, and students.',
                    'image'       => '/project-img/exam-hall.png',
                    'tags'        => ['Python', 'Django', 'MySQL', 'Flutter', 'Web App'],
                    'has_details' => true,
                    'sort_order'  => 1,
                ],
                'detail' => [
                    'hero_title'    => 'Exam Hall Seating',
                    'hero_subject'  => 'Arrangement System',
                    'tagline'       => '// Automation over manual exam management',
                    'stats'         => [
                        ['val' => 'Centralized', 'label' => 'Database'],
                        ['val' => 'Role-Based',  'label' => 'Access Control'],
                        ['val' => 'Automated',   'label' => 'Seat Allocation'],
                    ],
                    'abstract'      => 'The Examination Seating Arrangement System is designed to modernize the traditionally manual and error-prone process of exam seating management. The system stores student, exam, subject, and room details in a centralized database and automatically allocates seats based on capacity and predefined rules. It reduces administrative workload, minimizes human errors, and improves clarity for students, teachers, and administrators.',
                    'gallery'       => [
                        '/project-img/Screenshot 2025-10-31 182323.png',
                        '/project-img/Screenshot 2025-10-31 182349.png',
                        '/project-img/Screenshot 2025-10-31 182448.png',
                        '/project-img/Screenshot 2025-10-31 182506.png',
                    ],
                    'features'      => [
                        ['title' => 'Automated Seat Allocation',   'desc' => 'Generates seating arrangements based on room capacity, subjects, and student data.'],
                        ['title' => 'Centralized Data Management', 'desc' => 'Stores students, exams, rooms, teachers, and schedules securely in one system.'],
                        ['title' => 'Role-Based Login',            'desc' => 'Separate access for Admin, Teacher, Student, and Navigation modules.'],
                        ['title' => 'Exam Schedule Alerts',        'desc' => 'Students can view exam schedules and assigned seating information.'],
                        ['title' => 'Room Navigation',             'desc' => 'Helps users identify exam halls and room locations within the campus.'],
                        ['title' => 'Reduced Manual Errors',       'desc' => 'Eliminates time-consuming manual seating preparation and mistakes.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',   'stack' => 'HTML, CSS, JavaScript', 'icon' => 'fa-brands fa-js'],
                        ['name' => 'Backend',    'stack' => 'Python, Django',         'icon' => 'fa-brands fa-python'],
                        ['name' => 'Database',   'stack' => 'MySQL',                  'icon' => 'fa-solid fa-database'],
                        ['name' => 'Mobile App', 'stack' => 'Flutter',                'icon' => 'fa-brands fa-android'],
                    ],
                    'modules'       => [
                        ['title' => 'Admin Module',      'items' => ['Login', 'Arrange Seats', 'Add & Manage Teachers', 'Add & Manage Classes', 'View Malpractice Reports', 'Send Notifications']],
                        ['title' => 'Teacher Module',    'items' => ['Login', 'View Allocated Exam Halls', 'Report Malpractice', 'Room Navigation']],
                        ['title' => 'Student Module',    'items' => ['Login & Registration', 'View Exam Schedule', 'Check Seating Arrangement', 'Receive Notifications']],
                        ['title' => 'Navigation Module', 'items' => ['View Room Navigation', 'Locate Exam Halls']],
                    ],
                    'highlights'    => null,
                    'repo_url'      => 'https://github.com/Athulprgm/Xsitz2.git',
                    'live_url'      => null,
                ],
            ],
            [
                'project' => [
                    'id'          => 2,
                    'title'       => 'Velora Handmade',
                    'level'       => 'Intermediate',
                    'description' => 'A premium e-commerce platform for handmade crochet creations featuring dynamic delivery pricing, GPS location detection, and direct WhatsApp checkout.',
                    'image'       => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp',
                    'tags'        => ['React', 'Zustand', 'Tailwind CSS', 'Geoapify'],
                    'has_details' => true,
                    'sort_order'  => 2,
                ],
                'detail' => [
                    'hero_title'    => 'Velora',
                    'hero_subject'  => 'Handmade',
                    'tagline'       => '// Premium Luxury Crochet E-Commerce',
                    'stats'         => [
                        ['val' => 'Direct',  'label' => 'WhatsApp Ordering'],
                        ['val' => 'Dynamic', 'label' => 'Delivery Pricing'],
                        ['val' => 'GPS',     'label' => 'Auto-Geocoding'],
                    ],
                    'abstract'      => 'Velora Handmade is a premium, luxury-minimalist e-commerce platform for handmade crochet creations. It features a seamless, direct-to-owner WhatsApp ordering system that bypasses complex payment gateways. The platform integrates advanced features like HTML5 GPS Geolocation for precise address auto-filling and a dynamic distance-based delivery pricing calculator to provide an effortless checkout experience.',
                    'gallery'       => ['/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp'],
                    'features'      => [
                        ['title' => 'Advanced Checkout & WhatsApp Integration', 'desc' => 'Bypasses traditional payment gateways by generating a comprehensive, pre-filled WhatsApp message including order details, GPS coordinates, and payment mode.'],
                        ['title' => 'Dynamic Delivery Pricing',                  'desc' => 'Calculates dynamic distance-based pricing for local deliveries using specific town keywords, with a flat-rate fallback for nationwide shipping.'],
                        ['title' => 'GPS Location Detection',                    'desc' => 'Integrates HTML5 Geolocation and Geoapify API for reverse geocoding to automatically auto-fill the user\'s address, city, and pincode.'],
                        ['title' => 'Minimalist Luxury Design',                  'desc' => 'Premium typography, clean layout, dark/light mode switching, and grain overlays to give a tactile, editorial aesthetic.'],
                        ['title' => 'Fluid Animations',                          'desc' => 'Sophisticated entrance animations, smooth page transitions, and in-view scroll reveal effects using Framer Motion.'],
                        ['title' => 'Dynamic Product Catalog',                   'desc' => 'Filtering across categories like Bags, Pouches, and Baby Clips with high-quality hover zoom effects.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend Core',      'stack' => 'React 19, Vite',                       'icon' => 'fa-brands fa-react'],
                        ['name' => 'Styling & UI',       'stack' => 'Tailwind CSS 4, Framer Motion',        'icon' => 'fa-solid fa-paintbrush'],
                        ['name' => 'State Management',   'stack' => 'Zustand',                              'icon' => 'fa-solid fa-code-branch'],
                        ['name' => 'Mapping API',        'stack' => 'Geoapify, OpenStreetMap',              'icon' => 'fa-solid fa-map-location-dot'],
                    ],
                    'modules'       => [
                        ['title' => 'Checkout System', 'items' => ['GPS Coordinate Extraction', 'Geoapify Reverse Geocoding', 'Distance-based Pricing Engine', 'WhatsApp URI Encoding']],
                        ['title' => 'Shop & Catalog',  'items' => ['Dynamic Category Filtering', 'Bestseller & Gift Tags', 'Image Hover Zoom Effects']],
                        ['title' => 'UI Elements',     'items' => ['Global Theme Switching (Dark/Light)', 'Custom Loading Screens', 'Floating WhatsApp Contact', 'Scroll Reveal Animations']],
                    ],
                    'highlights'    => [
                        ['title' => 'Direct-to-Owner WhatsApp Checkout', 'desc' => 'The checkout payload encodes item details, pricing breakdown, precise delivery charges, and GPS coordinates into a seamless WhatsApp message.', 'image' => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp', 'tag' => 'E-Commerce'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => 'https://velora-zeta-nine.vercel.app/',
                ],
            ],
            [
                'project' => [
                    'id'          => 4,
                    'title'       => 'ExamPro AI',
                    'level'       => 'Advanced',
                    'description' => 'Advanced multi-tenant MERN application leveraging AI algorithms for optimized exam seat allocation, invigilation scheduling, and digital campus navigation.',
                    'image'       => '/New folder/Screenshot 2026-02-10 143102.png',
                    'tags'        => ['MERN Stack', 'AI Algorithm', 'React', 'Node.js'],
                    'has_details' => true,
                    'sort_order'  => 3,
                ],
                'detail' => [
                    'hero_title'    => 'ExamPro',
                    'hero_subject'  => 'AI',
                    'tagline'       => '// AI-Powered institutional exam logistics',
                    'stats'         => [
                        ['val' => 'AI-Driven',    'label' => 'Allocation'],
                        ['val' => 'MERN',         'label' => 'Full Stack'],
                        ['val' => 'Multi-Tenant', 'label' => 'System'],
                    ],
                    'abstract'      => 'ExamPro AI is a next-generation, multi-tenant web application designed for higher education institutions. It utilizes advanced AI algorithms to automate complex seat allocation logic and invigilation scheduling. The system minimizes operational complexity, eliminates manual errors, and provides interactive navigation through a digitally modeled campus infrastructure.',
                    'gallery'       => [
                        '/New folder/Screenshot 2026-02-10 143106.png',
                        '/New folder/Screenshot 2026-02-10 143112.png',
                        '/New folder/Screenshot 2026-02-10 143115.png',
                        '/New folder/Screenshot 2026-02-10 143118.png',
                        '/New folder/Screenshot 2026-02-10 143122.png',
                        '/New folder/Screenshot 2026-02-10 143135.png',
                        '/New folder/Screenshot 2026-02-10 143142.png',
                        '/New folder/Screenshot 2026-02-10 143201.png',
                        '/New folder/Screenshot 2026-02-10 143241.png',
                    ],
                    'features'      => [
                        ['title' => 'AI Allocation Engine',          'desc' => 'Uses advanced algorithms to optimize seat distribution based on capacity and subject constraints.'],
                        ['title' => 'Eliminate Manual Errors',       'desc' => 'Automates complex seating logic to remove human-induced mistakes.'],
                        ['title' => 'Institutional Scalability',     'desc' => 'Multi-tenant architecture supports large datasets and multi-campus environments.'],
                        ['title' => 'Infrastructure Modeling',       'desc' => 'Digital nodes and path connections for intuitive campus navigation.'],
                        ['title' => 'Centralized Data Management',   'desc' => 'Structured storage for exams, schedules, and violation records.'],
                        ['title' => 'Fairness & Transparency',       'desc' => 'Ensures equitable seat distribution and clear communication for students.'],
                        ['title' => 'Malpractice Tracking',          'desc' => 'Accountability systems with live reporting and violation logs.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',  'stack' => 'React 18, Vite',        'icon' => 'fa-brands fa-react'],
                        ['name' => 'Backend',   'stack' => 'Express.js, Node.js',   'icon' => 'fa-brands fa-node'],
                        ['name' => 'Database',  'stack' => 'MongoDB, Mongoose',     'icon' => 'fa-solid fa-leaf'],
                        ['name' => 'Security',  'stack' => 'JWT, BCrypt',           'icon' => 'fa-solid fa-shield-halved'],
                    ],
                    'modules'       => [
                        ['title' => 'College Admin',    'items' => ['Infrastructure Modeling', 'Automated Seat Allocation', 'Subject & Exam Management', 'Duty Assignment']],
                        ['title' => 'Student Module',   'items' => ['Interactive Navigation', 'Visual Seat ID', 'Personalized Timetable']],
                        ['title' => 'Invigilator Module', 'items' => ['Student Verification', 'Live Malpractice Reporting', 'Attendance Management']],
                        ['title' => 'Super Admin',      'items' => ['Multi-Tenancy Management', 'System Configuration']],
                        ['title' => 'Database Schema',  'items' => ['Users Collection (Role-based)', 'Colleges (Tenant Information)', 'BuildingMaps (Infrastructure Nodes)', 'SeatArrangements (Live Mapping)', 'Malpractices (Violation Records)']],
                    ],
                    'highlights'    => [
                        ['title' => 'AI-Powered Seat Allocation',  'desc' => 'Our proprietary algorithm analyzes room capacity and examination constraints to generate optimal, conflict-free seating maps in real-time.', 'image' => '/New folder/Screenshot 2026-02-10 143135.png', 'tag' => 'AI Intelligence'],
                        ['title' => 'Digital Infrastructure Map',  'desc' => 'A sophisticated node-link editor allowing administrators to digitally model campus buildings, connecting rooms and paths for seamless navigation.', 'image' => '/New folder/Screenshot 2026-02-10 143142.png', 'tag' => 'Infrastructure'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => null,
                ],
            ],
            [
                'project' => [
                    'id'          => 5,
                    'title'       => 'Kerala-One',
                    'level'       => 'Intermediate',
                    'description' => 'A comprehensive full-stack web application designed to showcase the development, history, and impact of the Kerala Government.',
                    'image'       => '/project-img/jana-vikasam-5.png',
                    'tags'        => ['React', 'Laravel', 'Vite', 'Tailwind CSS'],
                    'has_details' => true,
                    'sort_order'  => 4,
                ],
                'detail' => [
                    'hero_title'    => 'Jana Vikasam',
                    'hero_subject'  => 'Citizen Portal',
                    'tagline'       => '// Kerala Government Development Showcase',
                    'stats'         => [
                        ['val' => 'Full Stack',   'label' => 'Application'],
                        ['val' => 'Decoupled',    'label' => 'Architecture'],
                        ['val' => 'Interactive',  'label' => 'Map & Timeline'],
                    ],
                    'abstract'      => 'Jana Vikasam is a comprehensive full-stack web application designed to showcase the development, history, and impact of the Kerala Government. It serves as an interactive portal for citizens to explore development projects across different districts, view the state\'s historical timeline, read about government achievements, and engage through citizen testimonials and blogs.',
                    'gallery'       => [
                        '/project-img/jana-vikasam-5.png',
                        '/project-img/jana-vikasam-4.png',
                        '/project-img/jana-vikasam-6.png',
                        '/project-img/jana-vikasam-7.png',
                        '/project-img/jana-vikasam-3.png',
                    ],
                    'features'      => [
                        ['title' => 'Interactive Kerala Map',           'desc' => 'Visual map interface allowing users to explore development metrics and projects specific to different districts.'],
                        ['title' => 'Development Timeline',             'desc' => 'Scrolling chronological timeline highlighting key milestones and achievements over the years.'],
                        ['title' => 'Featured Projects Showcase',       'desc' => 'Display of prominent infrastructure, welfare, and technological projects with Before & After impact visualizations.'],
                        ['title' => 'Government History',               'desc' => 'Comprehensive directory detailing state history, including profiles of Chief Ministers.'],
                        ['title' => 'Blogs & Interactive Hub',          'desc' => 'Public feed of development stories, news updates, and articles for citizen engagement.'],
                        ['title' => 'Citizen Impact & Testimonials',    'desc' => 'Real stories and testimonials detailing the positive effects of government initiatives.'],
                        ['title' => 'Admin & User Dashboard',           'desc' => 'Content management (CRUD operations) for Projects, Districts, Timeline Milestones, and Blog Publishing.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',        'stack' => 'React 19, Vite, Tailwind CSS 4',     'icon' => 'fa-brands fa-react'],
                        ['name' => 'Backend',         'stack' => 'Laravel 11.x, PHP 8.3+',             'icon' => 'fa-brands fa-laravel'],
                        ['name' => 'Animations',      'stack' => 'Framer Motion, GSAP, Lenis',         'icon' => 'fa-solid fa-wand-magic-sparkles'],
                        ['name' => 'Authentication',  'stack' => 'Laravel Sanctum',                    'icon' => 'fa-solid fa-lock'],
                    ],
                    'modules'       => [
                        ['title' => 'Public Features',          'items' => ['Interactive Kerala Map', 'Development Timeline', 'Featured Projects Showcase', 'Government History', 'Blogs & Interactive Hub', 'Citizen Impact & Testimonials']],
                        ['title' => 'Admin & User Dashboard',   'items' => ['Authentication System (User & Admin)', 'Content Management (CRUD)', 'Blog Publishing', 'User Profile Management', 'Engagement Reactions']],
                    ],
                    'highlights'    => [
                        ['title' => 'Decoupled Architecture', 'desc' => 'A high-performance React application built with Vite communicates with a robust RESTful API developed with the Laravel framework.', 'image' => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp', 'tag' => 'Architecture'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => 'https://gov-vikasanam.vercel.app/showcase',
                ],
            ],
            [
                'project' => [
                    'id'          => 6,
                    'title'       => 'IntelResolve',
                    'level'       => 'Advanced',
                    'description' => 'A comprehensive civic-technology platform designed for complaint management and criminal identity warning, bridging the gap between citizens, departments, and law enforcement.',
                    'image'       => '/project-img/intelresolve-hero.png',
                    'tags'        => ['MERN Stack', 'React', 'Node.js', 'MongoDB', 'Civic Tech'],
                    'has_details' => true,
                    'sort_order'  => 5,
                ],
                'detail' => [
                    'hero_title'    => 'IntelResolve',
                    'hero_subject'  => 'Civic-Tech Platform',
                    'tagline'       => '// Complaint Management & Criminal Identity Warning',
                    'stats'         => [
                        ['val' => 'MERN', 'label' => 'Full Stack'],
                        ['val' => 'RBAC', 'label' => 'Access Control'],
                        ['val' => 'GIS',  'label' => 'Interactive Maps'],
                    ],
                    'abstract'      => 'IntelResolve is a comprehensive civic-technology platform designed for complaint management and criminal identity warning. It bridges the gap between citizens, administrative departments, and law enforcement by providing a unified platform for reporting incidents, tracking complaint resolutions, and managing public warnings regarding criminal activities.',
                    'gallery'       => [
                        '/project-img/intelresolve-hero.png',
                        '/project-img/intelresolve-complaints.png',
                        '/project-img/intelresolve-tracking.png',
                        '/project-img/intelresolve-report.png',
                        '/project-img/intelresolve-records.png',
                    ],
                    'features'      => [
                        ['title' => 'Complaint Management',        'desc' => 'Citizens can file complaints targeting specific departments with detailed descriptions, priorities, and geographical locations.'],
                        ['title' => 'Status Tracking & Audit Trail', 'desc' => 'Comprehensive activity logs and tracking for complaint resolutions (Pending, In-Progress, Resolved, Rejected).'],
                        ['title' => 'Criminal Identity Warning',   'desc' => 'Specialized module for managing and warning the public about known criminal profiles and repeat offenders.'],
                        ['title' => 'Interactive Mapping',         'desc' => 'Integration with OpenLayers for visualizing complaint locations and criminal activity hotspots.'],
                        ['title' => 'Role-Based Access Control',   'desc' => 'Distinct dashboards and capabilities for Admins, Department Users, and Citizens.'],
                        ['title' => 'Verification Workflow',       'desc' => 'Criminal profiles go through a strict verification process before public display.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',         'stack' => 'React 19, Vite, Tailwind CSS 4',    'icon' => 'fa-brands fa-react'],
                        ['name' => 'Backend',          'stack' => 'Node.js, Express.js',               'icon' => 'fa-brands fa-node'],
                        ['name' => 'Database',         'stack' => 'MongoDB, Mongoose',                 'icon' => 'fa-solid fa-leaf'],
                        ['name' => 'Mapping & Search', 'stack' => 'OpenLayers, Flexsearch',            'icon' => 'fa-solid fa-map-location-dot'],
                    ],
                    'modules'       => [
                        ['title' => 'Admin Module',         'items' => ['Full Department Oversight', 'Complaint Tracking & Audits', 'System Alerts Management', 'Criminal Record Verification']],
                        ['title' => 'Department User',      'items' => ['Handle Assigned Complaints', 'Manage Specific Tasks', 'Input Criminal Records']],
                        ['title' => 'Citizen Module',       'items' => ['Create & Track Complaints', 'Profile Management', 'Access Public Warning Board']],
                        ['title' => 'Security & Performance', 'items' => ['Global API Rate Limiting', 'Bcrypt Password Encryption', 'Helmet & CORS Security Policies', 'Comprehensive Audit Logging']],
                    ],
                    'highlights'    => [
                        ['title' => 'Criminal Risk Assessment', 'desc' => 'Categorizes criminals by risk level (Low, Medium, High, Critical) with a public warning board and verification workflows.', 'image' => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp', 'tag' => 'Security & Safety'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => null,
                ],
            ],
            [
                'project' => [
                    'id'          => 7,
                    'title'       => 'NextGen AI Resume Analyser',
                    'level'       => 'Advanced',
                    'description' => 'A full-stack web application designed to bridge the gap between job seekers and employers using AI and PDF extraction technologies.',
                    'image'       => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp',
                    'tags'        => ['MERN Stack', 'React', 'AI', 'PDF Parsing'],
                    'has_details' => true,
                    'sort_order'  => 6,
                ],
                'detail' => [
                    'hero_title'    => 'NextGen AI',
                    'hero_subject'  => 'Resume Analyser',
                    'tagline'       => '// Job Portal & AI Resume Matching',
                    'stats'         => [
                        ['val' => 'AI-Powered', 'label' => 'Analysis'],
                        ['val' => 'MERN',       'label' => 'Full Stack'],
                        ['val' => 'PDF',        'label' => 'Extraction'],
                    ],
                    'abstract'      => 'The NextGen AI Resume Analyser is a full-stack web application designed to bridge the gap between job seekers and employers. It provides a platform for managing job postings, authenticating users, and offering advanced resume-parsing capabilities using AI and PDF extraction technologies. The system leverages Recharts for analytics and allows users to generate and export optimized resumes.',
                    'gallery'       => ['/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp'],
                    'features'      => [
                        ['title' => 'AI Resume Analysis',         'desc' => 'Secure file upload handling using multer and text extraction from PDF resumes using pdf-parse to match candidates with job descriptions.'],
                        ['title' => 'Data Visualization Dashboard', 'desc' => 'Leverages Recharts to display visual analytics such as resume match scores and application statistics.'],
                        ['title' => 'PDF Report Export',          'desc' => 'Allows users to generate and download reports or optimized resumes directly from the browser using html2pdf.js and jsPDF.'],
                        ['title' => 'Job Management System',      'desc' => 'Comprehensive endpoints to create, read, update, and delete job postings, and retrieval of job details for the frontend feed.'],
                        ['title' => 'Secure Authentication',      'desc' => 'User registration and login endpoints with password encryption using Bcrypt and session management via JWT.'],
                        ['title' => 'Dynamic Routing & Layouts',  'desc' => 'Seamless navigation between the dashboard, job listings, and resume upload forms using React Router DOM.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',       'stack' => 'React 19, Vite, Tailwind CSS',    'icon' => 'fa-brands fa-react'],
                        ['name' => 'Backend',        'stack' => 'Node.js, Express.js',             'icon' => 'fa-brands fa-node'],
                        ['name' => 'Database',       'stack' => 'MongoDB, Mongoose',               'icon' => 'fa-solid fa-database'],
                        ['name' => 'Visualization',  'stack' => 'Recharts, html2pdf',              'icon' => 'fa-solid fa-chart-line'],
                    ],
                    'modules'       => [
                        ['title' => 'Job Seeker Module', 'items' => ['Resume Upload & Parsing', 'Job Feed & Listings', 'Application Statistics Dashboard', 'PDF Resume Export']],
                        ['title' => 'Employer Module',   'items' => ['Job Posting Management', 'Candidate Matching & Scores', 'Dashboard Analytics']],
                        ['title' => 'Backend API',       'items' => ['Authentication & Security (JWT)', 'File Uploads (Multer)', 'PDF Processing (pdf-parse)', 'Database Schema Models']],
                    ],
                    'highlights'    => [
                        ['title' => 'AI Resume Parsing', 'desc' => 'The system integrates pdf-parse for text extraction and AI models to intelligently match candidate resumes with job descriptions, providing comprehensive match scores.', 'image' => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp', 'tag' => 'AI & Analytics'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => null,
                ],
            ],
            [
                'project' => [
                    'id'          => 8,
                    'title'       => 'Digital Library (LibGo)',
                    'level'       => 'Beginner',
                    'description' => 'A full-stack Digital Library management system with role-based access, real-time request handling, and automated email notifications.',
                    'image'       => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp',
                    'tags'        => ['MERN Stack', 'React', 'Socket.io', 'Library'],
                    'has_details' => true,
                    'sort_order'  => 7,
                ],
                'detail' => [
                    'hero_title'    => 'Digital Library',
                    'hero_subject'  => 'LibGo',
                    'tagline'       => '// Modern Library Management System',
                    'stats'         => [
                        ['val' => 'Full Stack', 'label' => 'MERN Application'],
                        ['val' => 'Real-time',  'label' => 'Socket.io'],
                        ['val' => 'Automated',  'label' => 'Email Notifications'],
                    ],
                    'abstract'      => 'LibGo is a comprehensive, full-stack Digital Library management system designed to streamline the borrowing and management of books. The platform provides a seamless and secure user experience, featuring role-based access control, book lifecycle management, real-time request handling, and automated email notifications. It is built with a modern tech stack ensuring performance, scalability, and an intuitive user interface.',
                    'gallery'       => ['/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp'],
                    'features'      => [
                        ['title' => 'Book Lifecycle Management',    'desc' => 'Authenticated users can add new books, edit details, and process returns, dynamically updating the library\'s catalog.'],
                        ['title' => 'Real-time Request Handling',   'desc' => 'Users can submit borrow requests which approvers can review, accept, or reject in real-time.'],
                        ['title' => 'Automated Notifications',      'desc' => 'Integrated with Nodemailer to dispatch email notifications regarding request status, ensuring clear communication.'],
                        ['title' => 'Advanced Search & Filtering',  'desc' => 'Efficiently search the catalog by title, author, or keyword, and filter by category or genre.'],
                        ['title' => 'Role-Based Access Control',    'desc' => 'Strict access control policies differentiating between guest (view-only) and authenticated (interactive) users.'],
                        ['title' => 'Secure Authentication',        'desc' => 'User registration and login endpoints with password encryption using bcryptjs and session management via JWT.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',          'stack' => 'React 19, Vite, Tailwind CSS',    'icon' => 'fa-brands fa-react'],
                        ['name' => 'Backend',           'stack' => 'Node.js, Express.js',             'icon' => 'fa-brands fa-node'],
                        ['name' => 'Database',          'stack' => 'MongoDB, Mongoose',               'icon' => 'fa-solid fa-database'],
                        ['name' => 'Real-time & Comm',  'stack' => 'Socket.io, Nodemailer',           'icon' => 'fa-solid fa-bolt'],
                    ],
                    'modules'       => [
                        ['title' => 'Authentication & Authorization', 'items' => ['Secure Registration & Login', 'Protected Routing', 'Stateless JWT Authentication']],
                        ['title' => 'Book Management',               'items' => ['Add & Edit Books', 'Return System', 'My Books Dashboard']],
                        ['title' => 'Borrow Workflow',               'items' => ['Submit Borrow Requests', 'Approval/Rejection Handling', 'Borrowed Books Dashboard']],
                    ],
                    'highlights'    => [
                        ['title' => 'Real-time Borrow Requests', 'desc' => 'The system features an approval workflow that leverages Socket.io for live updates and Nodemailer for automated status emails, keeping all parties informed instantly.', 'image' => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp', 'tag' => 'Workflow & Notifications'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => null,
                ],
            ],
            [
                'project' => [
                    'id'          => 9,
                    'title'       => 'Gurukripa Builders',
                    'level'       => 'Advanced',
                    'description' => 'A modern, high-performance web application designed for a construction company, featuring dynamic 3D elements and smooth animations.',
                    'image'       => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp',
                    'tags'        => ['React', 'Three.js', 'Framer Motion', 'Vite'],
                    'has_details' => true,
                    'sort_order'  => 8,
                ],
                'detail' => [
                    'hero_title'    => 'Gurukripa',
                    'hero_subject'  => 'Builders',
                    'tagline'       => '// Modern Construction Web Application',
                    'stats'         => [
                        ['val' => '3D',   'label' => 'Rendering'],
                        ['val' => 'SPA',  'label' => 'Architecture'],
                        ['val' => 'Fast', 'label' => 'Performance'],
                    ],
                    'abstract'      => 'Gurukripa Builders is a modern, high-performance web application designed for a construction and building company. The application provides an engaging user experience with dynamic 3D elements, smooth animations, and a comprehensive overview of the company\'s services, stats, gallery, and contact information.',
                    'gallery'       => ['/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp'],
                    'features'      => [
                        ['title' => 'Immersive 3D Hero Section',       'desc' => 'Utilizes Three.js and React Three Fiber to create an interactive, visually striking landing experience that captures user attention immediately.'],
                        ['title' => 'Dynamic Animations',              'desc' => 'Powered by Framer Motion, ensuring smooth scroll reveals, component transitions, and interactive hover effects across the site.'],
                        ['title' => 'Comprehensive Service Showcase',   'desc' => 'Dedicated sections for displaying company statistics, offered services, and an auto-updating project gallery.'],
                        ['title' => 'Interactive ChatHub',             'desc' => 'A built-in chat interface designed to improve customer engagement and support inquiries.'],
                        ['title' => 'Performance Optimized',           'desc' => 'Built with Vite and React 19, ensuring lightning-fast load times, optimal bundling, and high performance even with 3D graphics rendering.'],
                    ],
                    'technologies'  => [
                        ['name' => 'Frontend',    'stack' => 'React 19, Vite',              'icon' => 'fa-brands fa-react'],
                        ['name' => '3D Rendering', 'stack' => 'Three.js, React Three Fiber', 'icon' => 'fa-solid fa-cube'],
                        ['name' => 'Animations',  'stack' => 'Framer Motion',               'icon' => 'fa-solid fa-wand-magic-sparkles'],
                        ['name' => 'UI/UX',       'stack' => 'Lucide React, CSS',           'icon' => 'fa-solid fa-paintbrush'],
                    ],
                    'modules'       => [
                        ['title' => 'Core Pages',           'items' => ['Hero (3D Landing)', 'About & History', 'Services & Capabilities', 'Company Stats']],
                        ['title' => 'Interactive Features', 'items' => ['Project Portfolio Gallery', 'Customer Support ChatHub', 'Inquiry & Contact Form']],
                        ['title' => 'Automation',           'items' => ['Automated Gallery Updates via Node.js Scripts', 'Optimized Build Processes']],
                    ],
                    'highlights'    => [
                        ['title' => '3D Web Experience', 'desc' => 'Integrates cutting-edge 3D rendering directly into the browser to showcase construction models and engage potential clients interactively.', 'image' => '/web-development-programming-and-code-testing-ui-concept-with-laptop-displaying-futuristic.webp', 'tag' => '3D Integration'],
                    ],
                    'repo_url'      => '#',
                    'live_url'      => 'https://gurukripa-builders-n6b7.vercel.app/',
                ],
            ],
        ];

        foreach ($projects as $data) {
            $project = Project::create($data['project']);
            $project->detail()->create($data['detail']);
        }

        $this->command->info('✅ Seeded ' . count($projects) . ' projects with full detail data.');
    }
}
