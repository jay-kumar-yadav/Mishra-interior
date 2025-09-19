<?php
/**
 * Reviews and Likes Data for Mishra Interiors
 * This file contains sample reviews and likes data
 */

// Sample Reviews Data
$reviews_data = [
    [
        'id' => 1,
        'name' => 'Priya Sharma',
        'location' => 'Whitefield, Bangalore',
        'rating' => 5,
        'date' => '2024-01-15',
        'review' => 'Mishra Interiors transformed our home beyond our expectations. Their attention to detail and creative vision made our dream home a reality. The team was professional, punctual, and incredibly talented.',
        'project_type' => 'Residential Design',
        'image' => 'image/mi (102).jpg'
    ],
    [
        'id' => 2,
        'name' => 'Rajesh Kumar',
        'location' => 'Koramangala, Bangalore',
        'rating' => 5,
        'date' => '2024-01-10',
        'review' => 'Professional, punctual, and incredibly talented. They delivered our office renovation on time and within budget. The modern design has significantly improved our workplace productivity.',
        'project_type' => 'Commercial Design',
        'image' => 'image/mi (107).jpg'
    ],
    [
        'id' => 3,
        'name' => 'Anita Reddy',
        'location' => 'Indiranagar, Bangalore',
        'rating' => 5,
        'date' => '2024-01-05',
        'review' => 'From concept to completion, the team was amazing. They understood our vision and brought it to life beautifully. The kitchen design is exactly what we dreamed of.',
        'project_type' => 'Kitchen Design',
        'image' => 'image/mi (105).jpg'
    ],
    [
        'id' => 4,
        'name' => 'Suresh Patel',
        'location' => 'JP Nagar, Bangalore',
        'rating' => 5,
        'date' => '2023-12-28',
        'review' => 'Excellent work! The bedroom design is stunning and the quality of materials used is top-notch. Highly recommended for anyone looking for interior design services.',
        'project_type' => 'Bedroom Design',
        'image' => 'image/mi (103).jpg'
    ],
    [
        'id' => 5,
        'name' => 'Meera Singh',
        'location' => 'HSR Layout, Bangalore',
        'rating' => 5,
        'date' => '2023-12-20',
        'review' => 'The dining room transformation is incredible. The team\'s creativity and attention to detail is outstanding. Our guests are always impressed with the design.',
        'project_type' => 'Dining Room',
        'image' => 'image/mi (106).jpg'
    ],
    [
        'id' => 6,
        'name' => 'Vikram Joshi',
        'location' => 'Electronic City, Bangalore',
        'rating' => 5,
        'date' => '2023-12-15',
        'review' => 'Outstanding service and beautiful results. The bathroom design is like a spa retreat. The team was professional throughout the entire process.',
        'project_type' => 'Bathroom Design',
        'image' => 'image/mi (109).jpg'
    ]
];

// Sample Likes Data
$likes_data = [
    [
        'id' => 1,
        'name' => 'Priya Sharma',
        'location' => 'Whitefield',
        'liked_on' => '2024-01-15',
        'project' => 'Modern Living Room Design'
    ],
    [
        'id' => 2,
        'name' => 'Rajesh Kumar',
        'location' => 'Koramangala',
        'liked_on' => '2024-01-14',
        'project' => 'Office Space Design'
    ],
    [
        'id' => 3,
        'name' => 'Anita Reddy',
        'location' => 'Indiranagar',
        'liked_on' => '2024-01-13',
        'project' => 'Kitchen Renovation'
    ],
    [
        'id' => 4,
        'name' => 'Suresh Patel',
        'location' => 'JP Nagar',
        'liked_on' => '2024-01-12',
        'project' => 'Luxury Bedroom'
    ],
    [
        'id' => 5,
        'name' => 'Meera Singh',
        'location' => 'HSR Layout',
        'liked_on' => '2024-01-11',
        'project' => 'Dining Room Design'
    ],
    [
        'id' => 6,
        'name' => 'Vikram Joshi',
        'location' => 'Electronic City',
        'liked_on' => '2024-01-10',
        'project' => 'Bathroom Makeover'
    ],
    [
        'id' => 7,
        'name' => 'Deepa Nair',
        'location' => 'Marathahalli',
        'liked_on' => '2024-01-09',
        'project' => 'Living Room Design'
    ],
    [
        'id' => 8,
        'name' => 'Arun Kumar',
        'location' => 'BTM Layout',
        'liked_on' => '2024-01-08',
        'project' => 'Office Interior'
    ],
    [
        'id' => 9,
        'name' => 'Sunita Gupta',
        'location' => 'Bannerghatta',
        'liked_on' => '2024-01-07',
        'project' => 'Kitchen Design'
    ],
    [
        'id' => 10,
        'name' => 'Ravi Shankar',
        'location' => 'Hebbal',
        'liked_on' => '2024-01-06',
        'project' => 'Bedroom Interior'
    ]
];

/**
 * Get all reviews
 */
function getAllReviews() {
    global $reviews_data;
    return $reviews_data;
}

/**
 * Get all likes
 */
function getAllLikes() {
    global $likes_data;
    return $likes_data;
}

/**
 * Get review by ID
 */
function getReviewById($id) {
    global $reviews_data;
    foreach ($reviews_data as $review) {
        if ($review['id'] == $id) {
            return $review;
        }
    }
    return null;
}

/**
 * Get likes count
 */
function getLikesCount() {
    global $likes_data;
    return count($likes_data);
}

/**
 * Get reviews count
 */
function getReviewsCount() {
    global $reviews_data;
    return count($reviews_data);
}

// Sample Projects Data
$projects_data = [
    [
        'id' => 1,
        'title' => 'Modern Living Room Design',
        'client' => 'Priya Sharma',
        'location' => 'Whitefield, Bangalore',
        'type' => 'Residential',
        'area' => '450 sq ft',
        'duration' => '6 weeks',
        'budget' => '₹8,50,000',
        'status' => 'Completed',
        'date' => '2024-01-15',
        'description' => 'A contemporary living room with minimalist design, featuring custom furniture, modern lighting, and elegant color scheme.',
        'image' => 'image/mi (102).jpg',
        'features' => ['Custom Sofa Set', 'Modern Lighting', 'Wall Art', 'Plants & Decor']
    ],
    [
        'id' => 2,
        'title' => 'Luxury Master Bedroom',
        'client' => 'Rajesh Kumar',
        'location' => 'Koramangala, Bangalore',
        'type' => 'Residential',
        'area' => '300 sq ft',
        'duration' => '4 weeks',
        'budget' => '₹6,20,000',
        'status' => 'Completed',
        'date' => '2024-01-10',
        'description' => 'Elegant master bedroom with premium finishes, walk-in closet, and luxury bathroom design.',
        'image' => 'image/mi (103).jpg',
        'features' => ['King Size Bed', 'Walk-in Closet', 'Luxury Bathroom', 'Premium Finishes']
    ],
    [
        'id' => 3,
        'title' => 'Contemporary Kitchen',
        'client' => 'Anita Reddy',
        'location' => 'Indiranagar, Bangalore',
        'type' => 'Residential',
        'area' => '200 sq ft',
        'duration' => '5 weeks',
        'budget' => '₹5,80,000',
        'status' => 'Completed',
        'date' => '2024-01-05',
        'description' => 'Modern kitchen with smart storage solutions, premium appliances, and elegant countertops.',
        'image' => 'image/mi (105).jpg',
        'features' => ['Smart Storage', 'Premium Appliances', 'Granite Countertops', 'Modern Cabinets']
    ],
    [
        'id' => 4,
        'title' => 'Elegant Dining Room',
        'client' => 'Suresh Patel',
        'location' => 'JP Nagar, Bangalore',
        'type' => 'Residential',
        'area' => '180 sq ft',
        'duration' => '3 weeks',
        'budget' => '₹4,50,000',
        'status' => 'Completed',
        'date' => '2023-12-28',
        'description' => 'Sophisticated dining space with custom dining table, elegant lighting, and premium furniture.',
        'image' => 'image/mi (106).jpg',
        'features' => ['Custom Dining Table', 'Chandelier', 'Premium Chairs', 'Wall Art']
    ],
    [
        'id' => 5,
        'title' => 'Modern Office Space',
        'client' => 'Meera Singh',
        'location' => 'HSR Layout, Bangalore',
        'type' => 'Commercial',
        'area' => '1200 sq ft',
        'duration' => '8 weeks',
        'budget' => '₹15,00,000',
        'status' => 'Completed',
        'date' => '2023-12-20',
        'description' => 'Contemporary office design with open workspace, meeting rooms, and modern amenities.',
        'image' => 'image/mi (107).jpg',
        'features' => ['Open Workspace', 'Meeting Rooms', 'Reception Area', 'Modern Amenities']
    ],
    [
        'id' => 6,
        'title' => 'Spa-like Bathroom',
        'client' => 'Vikram Joshi',
        'location' => 'Electronic City, Bangalore',
        'type' => 'Residential',
        'area' => '120 sq ft',
        'duration' => '4 weeks',
        'budget' => '₹3,80,000',
        'status' => 'Completed',
        'date' => '2023-12-15',
        'description' => 'Luxury bathroom with spa-like features, premium fixtures, and elegant design.',
        'image' => 'image/mi (109).jpg',
        'features' => ['Spa Features', 'Premium Fixtures', 'Marble Finishes', 'Modern Amenities']
    ]
];

// Sample Clients Data
$clients_data = [
    [
        'id' => 1,
        'name' => 'Priya Sharma',
        'location' => 'Whitefield, Bangalore',
        'type' => 'Residential Client',
        'projects' => 2,
        'total_value' => '₹15,00,000',
        'since' => '2023-08-15',
        'status' => 'Active',
        'phone' => '+91 98765 43210',
        'email' => 'priya.sharma@email.com',
        'avatar' => 'PS'
    ],
    [
        'id' => 2,
        'name' => 'Rajesh Kumar',
        'location' => 'Koramangala, Bangalore',
        'type' => 'Commercial Client',
        'projects' => 3,
        'total_value' => '₹25,00,000',
        'since' => '2023-06-20',
        'status' => 'Active',
        'phone' => '+91 98765 43211',
        'email' => 'rajesh.kumar@email.com',
        'avatar' => 'RK'
    ],
    [
        'id' => 3,
        'name' => 'Anita Reddy',
        'location' => 'Indiranagar, Bangalore',
        'type' => 'Residential Client',
        'projects' => 1,
        'total_value' => '₹8,50,000',
        'since' => '2023-11-10',
        'status' => 'Active',
        'phone' => '+91 98765 43212',
        'email' => 'anita.reddy@email.com',
        'avatar' => 'AR'
    ],
    [
        'id' => 4,
        'name' => 'Suresh Patel',
        'location' => 'JP Nagar, Bangalore',
        'type' => 'Residential Client',
        'projects' => 2,
        'total_value' => '₹12,00,000',
        'since' => '2023-09-05',
        'status' => 'Active',
        'phone' => '+91 98765 43213',
        'email' => 'suresh.patel@email.com',
        'avatar' => 'SP'
    ],
    [
        'id' => 5,
        'name' => 'Meera Singh',
        'location' => 'HSR Layout, Bangalore',
        'type' => 'Commercial Client',
        'projects' => 2,
        'total_value' => '₹18,00,000',
        'since' => '2023-07-15',
        'status' => 'Active',
        'phone' => '+91 98765 43214',
        'email' => 'meera.singh@email.com',
        'avatar' => 'MS'
    ],
    [
        'id' => 6,
        'name' => 'Vikram Joshi',
        'location' => 'Electronic City, Bangalore',
        'type' => 'Residential Client',
        'projects' => 1,
        'total_value' => '₹6,50,000',
        'since' => '2023-10-20',
        'status' => 'Active',
        'phone' => '+91 98765 43215',
        'email' => 'vikram.joshi@email.com',
        'avatar' => 'VJ'
    ],
    [
        'id' => 7,
        'name' => 'Deepa Nair',
        'location' => 'Marathahalli, Bangalore',
        'type' => 'Residential Client',
        'projects' => 1,
        'total_value' => '₹7,20,000',
        'since' => '2023-12-01',
        'status' => 'Active',
        'phone' => '+91 98765 43216',
        'email' => 'deepa.nair@email.com',
        'avatar' => 'DN'
    ],
    [
        'id' => 8,
        'name' => 'Arun Kumar',
        'location' => 'BTM Layout, Bangalore',
        'type' => 'Commercial Client',
        'projects' => 1,
        'total_value' => '₹10,00,000',
        'since' => '2023-11-25',
        'status' => 'Active',
        'phone' => '+91 98765 43217',
        'email' => 'arun.kumar@email.com',
        'avatar' => 'AK'
    ]
];

/**
 * Get all projects
 */
function getAllProjects() {
    global $projects_data;
    return $projects_data;
}

/**
 * Get all clients
 */
function getAllClients() {
    global $clients_data;
    return $clients_data;
}

/**
 * Get project by ID
 */
function getProjectById($id) {
    global $projects_data;
    foreach ($projects_data as $project) {
        if ($project['id'] == $id) {
            return $project;
        }
    }
    return null;
}

/**
 * Get client by ID
 */
function getClientById($id) {
    global $clients_data;
    foreach ($clients_data as $client) {
        if ($client['id'] == $id) {
            return $client;
        }
    }
    return null;
}

/**
 * Get projects count
 */
function getProjectsCount() {
    global $projects_data;
    return count($projects_data);
}

/**
 * Get clients count
 */
function getClientsCount() {
    global $clients_data;
    return count($clients_data);
}
?>
