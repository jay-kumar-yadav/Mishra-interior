<?php
// Sample product data with prices
$products = [
    [
        'id' => 1,
        'name' => 'Flooring Mat',
        'category' => 'Flooring',
        'brand' => 'Brand 1',
        'tags' => ['Wall Stickers', 'Ornaments'],
        'image' => 'image/mi (76).jpg',
        'price' => 4500
    ],
    [
        'id' => 2,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 2',
        'tags' => ['Paintings', 'Arts Prints'],
        'image' => 'image/mi (77).jpg',
        'price' => 1200
    ],
    [
        'id' => 3,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 3',
        'tags' => ['Curtains', 'Indoor Fountains'],
        'image' => 'image/mi (79).jpg',
        'price' => 1500
    ],
    [
        'id' => 4,
        'name' => 'Interior Sample',
        'category' => 'Interior',
        'brand' => 'Brand 1',
        'tags' => ['Ornaments', 'Arts Prints'],
        'image' => 'image/mi (95).jpeg',
        'price' => 8998
    ],
    [
        'id' => 5,
        'name' => 'Wallpaper Design',
        'category' => 'Wallpaper',
        'brand' => 'Brand 2',
        'tags' => ['Wall Stickers', 'Paintings'],
        'image' => 'image/mi (86).jpg',
        'price' => 2200
    ],
    [
        'id' => 6,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 3',
        'tags' => ['Curtains', 'Indoor Fountains'],
        'image' => 'image/mi (14).jpeg',
        'price' => 1899
    ],
    [
        'id' => 7,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 1',
        'tags' => ['Arts Prints', 'Ornaments'],
        'image' => 'image/mi (29).jpg',
        'price' => 140000
    ],
    [
        'id' => 8,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 2',
        'tags' => ['Wall Stickers', 'Paintings'],
        'image' => 'image/mi (35).jpeg',
        'price' => 1699
    ],
    [
        'id' => 9,
        'name' => 'Interior Design',
        'category' => 'Interior',
        'brand' => 'Brand 3',
        'tags' => ['Curtains', 'Indoor Fountains'],
        'image' => 'image/mi (43).jpg',
        'price' => 12000
    ],
    [
        'id' => 10,
        'name' => 'Interior Design',
        'category' => 'Interior',
        'brand' => 'Brand 1',
        'tags' => ['Arts Prints', 'Ornaments'],
        'image' => 'image/mi (58).jpeg',
        'price' => 9550
    ],
    [
        'id' => 11,
        'name' => 'Walpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 2',
        'tags' => ['Wall Stickers', 'Paintings'],
        'image' => 'image/mi (59).jpg',
        'price' => 1999
    ],
    [
        'id' => 12,
        'name' => 'Flooring Mat',
        'category' => 'Flooring',
        'brand' => 'Brand 3',
        'tags' => ['Curtains', 'Indoor Fountains'],
        'image' => 'image/mi (62).jpg',
        'price' => 5275
    ],
    [
        'id' => 13,
        'name' => 'Wooden Sample',
        'category' => 'Wood',
        'brand' => 'Brand 1',
        'tags' => ['Arts Prints', 'Ornaments'],
        'image' => 'image/mi (118).jpeg',
        'price' => 7525
    ],
    [
        'id' => 14,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 2',
        'tags' => ['Wall Stickers', 'Paintings'],
        'image' => 'image/mi (62).jpg',
        'price' => 1350
    ],
    [
        'id' => 15,
        'name' => 'Wallpaper Sample',
        'category' => 'Wallpaper',
        'brand' => 'Brand 3',
        'tags' => ['Curtains', 'Indoor Fountains'],
        'image' => 'image/mi (88).jpeg',
        'price' => 2199
    ]
];

// Get all unique categories, brands, and tags for filters
$categories = array_unique(array_column($products, 'category'));
$brands = array_unique(array_column($products, 'brand'));
$all_tags = [];
foreach ($products as $product) {
    $all_tags = array_merge($all_tags, $product['tags']);
}
$tags = array_unique($all_tags);

// Process search and filters
$search_term = "";
$min_price = 0;
$max_price = 200000; // Default max price in rupees
$selected_categories = [];
$selected_brands = [];
$selected_tags = [];
$filtered_products = $products;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get search term
    if (isset($_POST['search'])) {
        $search_term = trim($_POST['search']);
    }
    
    // Get price range if submitted
    if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
        $min_price = floatval($_POST['min_price']);
        $max_price = floatval($_POST['max_price']);
    }
    
    // Get selected categories
    if (isset($_POST['categories']) && is_array($_POST['categories'])) {
        $selected_categories = $_POST['categories'];
    }
    
    // Get selected brands
    if (isset($_POST['brands']) && is_array($_POST['brands'])) {
        $selected_brands = $_POST['brands'];
    }
    
    // Get selected tags
    if (isset($_POST['tags']) && is_array($_POST['tags'])) {
        $selected_tags = $_POST['tags'];
    }
    
    // Filter products
    $filtered_products = array_filter($products, function($product) use ($search_term, $min_price, $max_price, $selected_categories, $selected_brands, $selected_tags) {
        // Search term matching
        $name_match = empty($search_term) || 
                     (stripos($product['name'], $search_term) !== false);
        
        $category_match = empty($search_term) || 
                         (stripos($product['category'], $search_term) !== false);
        
        // Price matching
        $price_match = ($product['price'] >= $min_price) && 
                      ($product['price'] <= $max_price);
        
        // Category filter
        $category_filter_match = empty($selected_categories) || 
                               in_array($product['category'], $selected_categories);
        
        // Brand filter
        $brand_filter_match = empty($selected_brands) || 
                            in_array($product['brand'], $selected_brands);
        
        // Tag filter
        $tag_filter_match = empty($selected_tags);
        if (!empty($selected_tags)) {
            foreach ($selected_tags as $tag) {
                if (in_array($tag, $product['tags'])) {
                    $tag_filter_match = true;
                    break;
                }
            }
        }
        
        return ($name_match || $category_match) && $price_match && $category_filter_match && $brand_filter_match && $tag_filter_match;
    });
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <![endif]-->
        <meta name="keywords" content="Mishar Interios,Wallpaper,Wooden Flooring,
              Carpet,Vinyl,Sport Flooring,Blinds,Sera Board,Deck Wood Flooring,Wall Paintaing,Interior
              Rubber Flooring,
              Mehta Techno"/>
        <meta name="description" content="Mishra Interior - Responsive HTML Template for Interior Design and Decoration" />
        <meta name="author" content="mehtatechno.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Mishra Interiors -Interior Design and Decoration</title>

        <link rel="icon" href="image/0.png" type="image/x-icon">
        <link href="main.css" rel="stylesheet">
        <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            .tag-checkbox {
                display: inline-block;
                margin: 5px;
                padding: 5px 10px;
                background: #f5f5f5;
                border-radius: 3px;
                cursor: pointer;
            }
            .tag-checkbox input[type="checkbox"] {
                display: none;
            }
            .tag-checkbox input[type="checkbox"]:checked + span {
                color: #337ab7;
                font-weight: bold;
            }
            .filter-btn {
                margin-top: 10px;
                width: 100%;
            }
            .filter-section {
                margin-bottom: 20px;
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
            }
            .no-products {
                text-align: center;
                padding: 40px;
                font-size: 18px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <!--//==Preloader Start==//-->
        <div class="preloader">
            <div class="thecube">
                <div class="loader"></div>
                <h4>Loading</h4>
            </div>
        </div>
        <!--//==Preloader End==//-->  
        <!--//==Header Start==//-->
        <?php include 'header.php'; ?>
        <!--//==Header End==//-->
        <!--//==Page Header Start==//-->	  
        <div class="page-header black-overlay">
            <div class="container breadcrumb-section">
                <div class="row pad-s15">
                    <div class="col-md-12">
                        <h2>Shop</h2>
                        <div class="clear"></div>
                        <div class="breadcrumb-box">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                                </li>
                                <li class="active">Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//==Page Header End==//-->
        <!--//==Product Detail Page Start==//-->
        <section class="page_single wa-product-sidebar padTB100">
            <div class="container">
                <div class="row">
                    <!--//==Product Detail Section Start==//-->			
                    <div class="col-md-9 col-sm-8 col-xs-12 pull-right">
                        <div class="row marB20">
                            <?php if (count($filtered_products) > 0): ?>
                                <?php foreach ($filtered_products as $product): ?>
                                <!--//==Product Item==//-->
                                <div class="col-md-4 col-sm-6 product-item" 
                                     data-category="<?php echo htmlspecialchars($product['category']); ?>"
                                     data-brand="<?php echo htmlspecialchars($product['brand']); ?>"
                                     data-tags='<?php echo json_encode($product['tags']); ?>'
                                     data-price="<?php echo $product['price']; ?>">
                                    <div class="wa-product">
                                        <div class="wa-product-thumbnail wa-item">
                                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                            <div class="caption">
                                                <div class="caption-text">
                                                    <ul class="wa-product-icon">
                                                        <li><a href="<?php echo htmlspecialchars($product['image']); ?>" class="fancybox" data-fancybox-group="group"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                                        <li><a href="product-detail-sidebar.php?id=<?php echo $product['id']; ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                        <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wa-product-caption">
                                            <h2>
                                                <a href="product-detail-sidebar.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a>
                                            </h2>
                                            <div class="clear"></div>
                                            <h5><?php echo htmlspecialchars($product['category']); ?></h5>
                                            <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!--//==Product Item==//-->
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <p>No products found matching your search criteria.</p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-12 col-sm-12">
                                <div class="styled-pagination padB30 text-right">
                                    <ul>
                                        <li><a class="prev" href="#"><i class="fa fa-angle-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#" class="active">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a class="next" href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//==Product Detail Section End==//-->
                    <!--//======Sidebar Start=======//-->
                    <div class="col-md-3 col-sm-4 col-xs-12 pull-left">
                        <div class="row">
                            <div class="sidebar">
                                <div class="col-md-12">
                                    <!--widget-->
                                    <div class="widget filter-section">
                                        <h4>search</h4>
                                        <form id="search-form">
                                            <div class="form-group clearfix">
                                                <input type="search" id="search-input" name="search" value="<?php echo htmlspecialchars($search_term); ?>" placeholder="Search Here">
                                            </div>
                                        </form>
                                    </div>
                                    <!--widget-->
                                    <div class="widget filter-section">
                                        <h4>Price Filter (₹)</h4>
                                        <div class="form-group clearfix">
                                            <label for="amount" class="padB10">Price range:</label>												  
                                            <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                <div class="ui-slider-range ui-corner-all ui-widget-header wa-uiwidget-header"></div>
                                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default wa-ui-state-default"></span>
                                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default wa-ui-state-default2"></span>
                                            </div>
                                            <p class="padT20">
                                                <input type="text" id="amount" name="amount" readonly>
                                                <input type="hidden" id="min_price" name="min_price" value="<?php echo $min_price; ?>">
                                                <input type="hidden" id="max_price" name="max_price" value="<?php echo $max_price; ?>">
                                            </p>
                                            <button type="button" id="price-filter-btn" class="btn btn-primary btn-sm filter-btn">Filter by Price</button>
                                        </div>
                                    </div>
                                    <!--widget-->
                                    <div class="widget filter-section">
                                        <h4>Categories</h4>
                                        <!--//==Item List Start==//-->
                                        <ul class="links-lists" id="category-filter">
                                            <?php foreach ($categories as $category): 
                                                $count = count(array_filter($products, function($product) use ($category) {
                                                    return $product['category'] === $category;
                                                }));
                                            ?>
                                            <li>
                                                <p class="positionR">
                                                    <label class="inline radio-label" for="category_<?php echo htmlspecialchars(str_replace(' ', '_', $category)); ?>">
                                                        <input id="category_<?php echo htmlspecialchars(str_replace(' ', '_', $category)); ?>" 
                                                               type="checkbox" name="categories" 
                                                               value="<?php echo htmlspecialchars($category); ?>"
                                                               <?php echo in_array($category, $selected_categories) ? 'checked' : ''; ?>>
                                                        <?php echo htmlspecialchars($category); ?>
                                                        <span class="box-check"><span class="inside"></span></span>
                                                    </label>											
                                                </p>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <!--//==Item List End==//-->
                                    
                                    </div>
                                    <!--widget-->
                                    <div class="widget filter-section">
                                        <h4>Brands</h4>
                                        <!--//==Item List Start==//-->
                                        <ul class="links-lists" id="brand-filter">
                                            <?php foreach ($brands as $brand): 
                                                $count = count(array_filter($products, function($product) use ($brand) {
                                                    return $product['brand'] === $brand;
                                                }));
                                            ?>
                                            <li>
                                                <p class="positionR">
                                                    <label class="inline radio-label" for="brand_<?php echo htmlspecialchars(str_replace(' ', '_', $brand)); ?>">
                                                        <input id="brand_<?php echo htmlspecialchars(str_replace(' ', '_', $brand)); ?>" 
                                                               type="checkbox" name="brands" 
                                                               value="<?php echo htmlspecialchars($brand); ?>"
                                                               <?php echo in_array($brand, $selected_brands) ? 'checked' : ''; ?>>
                                                        <?php echo htmlspecialchars($brand); ?>
                                                        <span class="box-check"><span class="inside"></span></span>
                                                    </label>											
                                                </p>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <!--//==Item List End==//-->
                                       
                                    </div>
                                    <!--widget-->
                                    <div class="widget filter-section">
                                        <h4>Popular Tags</h4>
                                        <!--//==Item tag Start==//-->
                                        <div class="tag-list" id="tag-filter">
                                            <?php foreach ($tags as $tag): ?>
                                            <label class="tag-checkbox">
                                                <input type="checkbox" name="tags" value="<?php echo htmlspecialchars($tag); ?>"
                                                       <?php echo in_array($tag, $selected_tags) ? 'checked' : ''; ?>>
                                                <span><?php echo htmlspecialchars($tag); ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                        <!--//==Item tag End==//-->
                                       
                                    </div>
                                    <!--widget-->
                                    <div class="widget">
                                        <h4>latest Product</h4>
                                        <div class="row text-center">
                                            <!--//==Item Start==//-->
                                            <div class="sidebar-post">
                                                <div class="wa-theme-design-block strict-no-border">
                                                    <figure class="dark-theme">
                                                        <a href="product-detail-sidebar.php"><img src="image/mi (118).jpeg" alt="Thumbnail"></a>
                                                    </figure>
                                                </div>
                                            </div>
                                            <!--//==Item End==//-->
                                            <!--//==Item Start==//-->
                                            <div class="sidebar-post">
                                                <div class="wa-theme-design-block strict-no-border">
                                                    <figure class="dark-theme">
                                                        <a href="product-detail-sidebar.php"><img src="image/mi (62).jpg" alt="Thumbnail"></a>
                                                    </figure>
                                                </div>
                                            </div>
                                            <!--//==Item End==//-->
                                            <!--//==Item Start==//-->
                                            <div class="sidebar-post">
                                                <div class="wa-theme-design-block strict-no-border">
                                                    <figure class="dark-theme">
                                                        <a href="product-detail-sidebar.php"><img src="image/mi (75).jpg" alt="Thumbnail"></a>
                                                    </figure>
                                                </div>
                                            </div>
                                            <!--//==Item End==//-->
                                            <!--//==Item Start==//-->
                                            <div class="sidebar-post">
                                                <div class="wa-theme-design-block strict-no-border">
                                                    <figure class="dark-theme">
                                                        <a href="product-detail-sidebar.php"><img src="image/mi (74).jpg" alt="Thumbnail"></a>
                                                    </figure>
                                                </div>
                                            </div>
                                            <!--//==Item End==//-->
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//======Sidebar End=======//-->
                </div>
            </div>
        </section>
        <!--//==Product Detail Page End==//-->		
        <!--//=========Footer Start=========//-->
        <?php include 'footer.php'; ?>

        <!--//=========Footer End=========//-->	  
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/plugins/menu/js/hover-dropdown-menu.js"></script> 
        <script type="text/javascript" src="assets/plugins/menu/js/jquery.hover-dropdown-menu-addon.js"></script>	
        <script src="assets/plugins/owl-carousel/js/owl.carousel.js"></script>	 
        <script src="assets/plugins/mixitup/js/jquery.mixitup.js"></script>	
        <script src="assets/plugins/fancymedia/js/jquery.fancybox.pack.js"></script>
        <script src="assets/plugins/fancymedia/js/jquery.fancybox-media.js"></script>  		
        <script type="text/javascript" src="assets/plugins/counter/js/jquery.countTo.js"></script> 
        <script type="text/javascript" src="assets/plugins/counter/js/jquery.appear.js"></script>    
        <script src="assets/js/main.js"></script>
        
        <!-- Filtering JavaScript -->
        <script>
        $(document).ready(function() {
            // Initialize price slider (in rupees)
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 200000,
                values: [<?php echo $min_price; ?>, <?php echo $max_price; ?>],
                slide: function(event, ui) {
                    $("#amount").val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });
            $("#amount").val("₹" + $("#slider-range").slider("values", 0) +
                " - ₹" + $("#slider-range").slider("values", 1));
            
            // Filter products based on all criteria
            function filterProducts() {
                var searchTerm = $('#search-input').val().toLowerCase();
                var minPrice = parseFloat($("#min_price").val());
                var maxPrice = parseFloat($("#max_price").val());
                
                // Get selected categories
                var selectedCategories = [];
                $('#category-filter input:checked').each(function() {
                    selectedCategories.push($(this).val());
                });
                
                // Get selected brands
                var selectedBrands = [];
                $('#brand-filter input:checked').each(function() {
                    selectedBrands.push($(this).val());
                });
                
                // Get selected tags
                var selectedTags = [];
                $('#tag-filter input:checked').each(function() {
                    selectedTags.push($(this).val());
                });
                
                // Filter products
                $('.product-item').each(function() {
                    var productName = $(this).find('h2 a').text().toLowerCase();
                    var productCategory = $(this).find('h5').text();
                    var productBrand = $(this).data('brand');
                    var productTags = $(this).data('tags');
                    var productPrice = parseFloat($(this).data('price'));
                    
                    // Check search term
                    var nameMatch = searchTerm === '' || 
                                   productName.includes(searchTerm);
                    
                    // Check price
                    var priceMatch = productPrice >= minPrice && 
                                   productPrice <= maxPrice;
                    
                    // Check category
                    var categoryMatch = selectedCategories.length === 0 || 
                                      selectedCategories.includes(productCategory);
                    
                    // Check brand
                    var brandMatch = selectedBrands.length === 0 || 
                                   selectedBrands.includes(productBrand);
                    
                    // Check tags
                    var tagMatch = selectedTags.length === 0;
                    if (selectedTags.length > 0) {
                        for (var i = 0; i < selectedTags.length; i++) {
                            if (productTags.includes(selectedTags[i])) {
                                tagMatch = true;
                                break;
                            }
                        }
                    }
                    
                    // Show or hide based on all filters
                    if (nameMatch && priceMatch && categoryMatch && brandMatch && tagMatch) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                
                // Check if any products are visible
                if ($('.product-item:visible').length === 0) {
                    $('.marB20').append('<div class="col-md-12 no-products"><p>No products found matching your criteria.</p></div>');
                } else {
                    $('.no-products').remove();
                }
            }
            
            // Set up event listeners
            $('#search-input').on('keyup', filterProducts);
            $('#price-filter-btn').on('click', filterProducts);
            $('#category-filter-btn').on('click', filterProducts);
            $('#brand-filter-btn').on('click', filterProducts);
            $('#tag-filter-btn').on('click', filterProducts);
            
            // Also filter when checkboxes change
            $('#category-filter input, #brand-filter input, #tag-filter input').on('change', filterProducts);
            
            // Initial filter
            filterProducts();
        });
        </script>
    </body>
</html>