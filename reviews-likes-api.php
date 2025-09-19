<?php
/**
 * Reviews and Likes API
 * Handles AJAX requests for reviews and likes data
 */

header('Content-Type: application/json');

// Include the data file
require_once 'reviews-likes-data.php';

// Get the action from the request
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'get_reviews':
        $reviews = getAllReviews();
        echo json_encode([
            'success' => true,
            'data' => $reviews,
            'count' => count($reviews)
        ]);
        break;
        
    case 'get_likes':
        $likes = getAllLikes();
        echo json_encode([
            'success' => true,
            'data' => $likes,
            'count' => count($likes)
        ]);
        break;
        
    case 'get_review':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $review = getReviewById($id);
        if ($review) {
            echo json_encode([
                'success' => true,
                'data' => $review
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Review not found'
            ]);
        }
        break;
        
    case 'get_projects':
        $projects = getAllProjects();
        echo json_encode([
            'success' => true,
            'data' => $projects,
            'count' => count($projects)
        ]);
        break;
        
    case 'get_clients':
        $clients = getAllClients();
        echo json_encode([
            'success' => true,
            'data' => $clients,
            'count' => count($clients)
        ]);
        break;
        
    case 'get_project':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $project = getProjectById($id);
        if ($project) {
            echo json_encode([
                'success' => true,
                'data' => $project
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Project not found'
            ]);
        }
        break;
        
    case 'get_client':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $client = getClientById($id);
        if ($client) {
            echo json_encode([
                'success' => true,
                'data' => $client
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Client not found'
            ]);
        }
        break;
        
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
        break;
}
?>
