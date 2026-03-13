<?php
include "connection.php";
session_start();
$admin = $_SESSION["admin"] ?? ["fname" => "Admin", "lname" => "", "role" => "admin", "status" => "approved", "pfp" => ""];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiNK AURA — Admin</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/admin_style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="assets/logo.jpg" />
</head>

<body class="adm-body">

<!-- overlay (mobile sidebar) -->
<div class="adm-overlay" id="adm-overlay" onclick="closeSidebar();"></div>


<!-- =============================================
     HEADER
     ============================================= -->
<header class="adm-header">
    <div style="display:flex; align-items:center; gap:0.9rem;">
        <button class="adm-hamburger" onclick="toggleSidebar();">
            <i class="bi bi-list"></i>
        </button>
        <span class="adm-header__brand">PiNK AURA</span>
        <span style="font-size:0.62rem; letter-spacing:2px; text-transform:uppercase; color:rgb(190,160,163); padding-top:0.2rem;">admin</span>
    </div>
    <div class="adm-header__right">
        <span class="adm-header__greeting">✦ &nbsp;<?php echo date("l, d M"); ?></span>
        <div class="adm-header__avatar" onclick="showSection('profile');">
            <img src="<?php echo $admin['pfp'] ?: 'assests/user.png'; ?>" alt="pfp" />
            <span><?php echo htmlspecialchars($admin['fname'] . ' ' . $admin['lname']); ?></span>
            <i class="bi bi-chevron-down" style="font-size:0.65rem; color:rgb(190,155,158);"></i>
        </div>
    </div>
</header>


<!-- =============================================
     LAYOUT
     ============================================= -->
<div class="adm-wrapper">

    <!-- SIDEBAR -->
    <aside class="adm-sidebar" id="adm-sidebar">

        <span class="adm-sidebar__section-label">Main</span>
        <button class="adm-nav-item active" id="nav-dashboard" onclick="showSection('dashboard');">
            <i class="bi bi-grid"></i> Dashboard
        </button>

        <span class="adm-sidebar__section-label">Catalogue</span>
        <button class="adm-nav-item" id="nav-products" onclick="showSection('products');">
            <i class="bi bi-box-seam"></i> Products
        </button>
        <button class="adm-nav-item" id="nav-add-product" onclick="showSection('add-product');">
            <i class="bi bi-plus-circle"></i> Add Product
        </button>
        <button class="adm-nav-item" id="nav-inventory" onclick="showSection('inventory');">
            <i class="bi bi-stack"></i> Inventory
        </button>

        <span class="adm-sidebar__section-label">Store</span>
        <button class="adm-nav-item" id="nav-orders" onclick="showSection('orders');">
            <i class="bi bi-bag-check"></i> Orders
        </button>
        <button class="adm-nav-item" id="nav-customers" onclick="showSection('customers');">
            <i class="bi bi-people"></i> Customers
        </button>

        <span class="adm-sidebar__section-label">Account</span>
        <button class="adm-nav-item" id="nav-profile" onclick="showSection('profile');">
            <i class="bi bi-person-circle"></i> My Profile
        </button>

        <div class="adm-sidebar__spacer"></div>
        <button class="adm-nav-item logout" onclick="adminSignout();">
            <i class="bi bi-box-arrow-left"></i> Log Out
        </button>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="adm-main">


        <!-- ==========================================
             DASHBOARD
             ========================================== -->
        <div class="adm-section active" id="section-dashboard">
            <p class="adm-page-title">Dashboard</p>
            <p class="adm-page-sub">welcome back, admin01 ✦</p>

            <!-- stat cards -->
            <div class="adm-stats">
                <div class="adm-stat-card">
                    <div class="adm-stat-card__icon"><i class="bi bi-bag-check"></i></div>
                    <div class="adm-stat-card__body">
                        <div class="adm-stat-card__label">Total Orders</div>
                        <div class="adm-stat-card__value" id="stat-orders">—</div>
                        <div class="adm-stat-card__change"><i class="bi bi-clock"></i> <span id="stat-pending">—</span> pending</div>
                    </div>
                </div>
                <div class="adm-stat-card">
                    <div class="adm-stat-card__icon"><i class="bi bi-box-seam"></i></div>
                    <div class="adm-stat-card__body">
                        <div class="adm-stat-card__label">Products</div>
                        <div class="adm-stat-card__value" id="stat-products">—</div>
                        <div class="adm-stat-card__change"><i class="bi bi-check2-circle"></i> active listings</div>
                    </div>
                </div>
                <div class="adm-stat-card">
                    <div class="adm-stat-card__icon"><i class="bi bi-people"></i></div>
                    <div class="adm-stat-card__body">
                        <div class="adm-stat-card__label">Customers</div>
                        <div class="adm-stat-card__value" id="stat-customers">—</div>
                        <div class="adm-stat-card__change"><i class="bi bi-person-check"></i> registered</div>
                    </div>
                </div>
                <div class="adm-stat-card">
                    <div class="adm-stat-card__icon"><i class="bi bi-currency-dollar"></i></div>
                    <div class="adm-stat-card__body">
                        <div class="adm-stat-card__label">Total Earnings</div>
                        <div class="adm-stat-card__value" id="stat-earnings" style="font-size:1.4rem;">—</div>
                        <div class="adm-stat-card__change"><i class="bi bi-graph-up"></i> all time</div>
                    </div>
                </div>
            </div>

            <!-- recent orders table -->
            <div class="adm-card">
                <div class="adm-recent-header">
                    <span class="adm-card__title">Recent Orders</span>
                    <button class="adm-btn adm-btn--ghost adm-btn--sm" onclick="showSection('orders');">
                        View All <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                <div class="adm-table-wrap">
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="recent-orders-body">
                            <!-- populate via your PHP/AJAX -->
                            <tr>
                                <td colspan="5" style="text-align:center; color:rgb(190,160,163); padding:2rem;">
                                    connect your backend to load orders
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ==========================================
             PRODUCTS
             ========================================== -->
        <div class="adm-section" id="section-products">
            <p class="adm-page-title">Products</p>
            <p class="adm-page-sub">manage your product catalogue</p>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.2rem; flex-wrap:wrap; gap:0.8rem;">
                <div class="adm-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="product-search" placeholder="Search products..." oninput="filterTable('product-search','products-table');">
                </div>
                <button class="adm-btn adm-btn--primary" onclick="showSection('add-product');">
                    <i class="bi bi-plus-lg"></i> Add Product
                </button>
            </div>

            <div class="adm-card">
                <div class="adm-table-wrap">
                    <table class="adm-table" id="products-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-body">
                            <!-- populate via your PHP/AJAX -->
                            <tr>
                                <td colspan="6" style="text-align:center; color:rgb(190,160,163); padding:2rem;">
                                    connect your backend to load products
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ==========================================
             ADD PRODUCT
             ========================================== -->
        <div class="adm-section" id="section-add-product">
            <p class="adm-page-title">Add Product</p>
            <p class="adm-page-sub">add a new product to the catalogue</p>

            <div class="adm-card">
                <div class="adm-form-grid">
                    <div>
                        <label class="adm-label">Product Title</label>
                        <div class="inp-wrap" style="margin-bottom:0;">
                            <input type="text" id="ap_title" class="inp-field" placeholder=" " required/>
                            <label class="inp-label">e.g. Velvet Matte Lipstick</label>
                        </div>
                    </div>
                    <div>
                        <label class="adm-label">Price (USD)</label>
                        <div class="inp-wrap" style="margin-bottom:0;">
                            <input type="text" step="0.01" id="ap_price" class="inp-field" placeholder=" " required/>
                            <label class="inp-label">0.00</label>
                        </div>
                    </div>
                    <div>
                        <label class="adm-label">Main Category</label>
                        <select class="adm-select" id="ap_main_cat" onchange="loadSubCategories();">
                            <option value="0">Select category...</option>
                            <?php 
                                $MainCat_rs = Database::search("SELECT * FROM `main_category` ");
                                $MainCat_num = $MainCat_rs->num_rows;
                                for ($x=0; $x < $MainCat_num; $x++) {
                                    $MainCat_data = $MainCat_rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $MainCat_data["id"]; ?>"><?php echo $MainCat_data["name"]; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="adm-label">Sub Category</label>
                        <select class="adm-select" id="ap_sub_cat">
                            <option value="0" >Select main category first...</option>
                            
                        </select>
                    </div>
                </div>

                <div style="margin-top:1rem;">
                    <label class="adm-label">Description</label>
                    <textarea class="adm-textarea" id="ap_desc" placeholder="Product description..." ></textarea>
                </div>

                <div style="margin-top:1rem;">
                    <label class="adm-label">Product Images</label>
                    <div class="adm-upload" onclick="document.getElementById('ap_images').click();">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p>Click to upload images<br><span style="font-size:0.68rem;">JPG, PNG — max 5 images</span></p>
                        <input type="file" id="ap_images" multiple accept="image/*" style="display:none;" onchange="previewImages();">
                    </div>
                    <div id="ap_image_preview" style="display:flex; gap:0.6rem; flex-wrap:wrap; margin-top:0.8rem;"></div>
                </div>

                <div style="display:flex; gap:0.8rem; margin-top:1.5rem; justify-content:flex-end;">
                    <button class="adm-btn adm-btn--outline" onclick="showSection('products');">Cancel</button>
                    <button class="adm-btn adm-btn--primary" onclick="addProduct();">
                        <i class="bi bi-plus-lg"></i> Add Product
                    </button>
                </div>
            </div>
        </div>


        <!-- ==========================================
             INVENTORY
             ========================================== -->
        <div class="adm-section" id="section-inventory">
            <p class="adm-page-title">Inventory</p>
            <p class="adm-page-sub">restock products and track history</p>

            <div class="adm-card">
                <div class="adm-card__title">Add Stock</div>
                <div class="adm-form-grid">
                    <div>
                        <label class="adm-label">Product</label>
                        <select class="adm-select" id="inv_product">
                            <option value="">Select product...</option>
                            <!-- populate via PHP -->
                        </select>
                    </div>
                    <div>
                        <label class="adm-label">Quantity to Add</label>
                        <div class="inp-wrap" style="margin-bottom:0;">
                            <input type="number" id="inv_qty" class="inp-field" placeholder=" " min="1">
                            <label class="inp-label">Enter quantity</label>
                        </div>
                    </div>
                </div>
                <div style="display:flex; justify-content:flex-end; margin-top:1rem;">
                    <button class="adm-btn adm-btn--primary" onclick="addStock();">
                        <i class="bi bi-plus-lg"></i> Add Stock
                    </button>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card__title">Restock History</div>
                <div class="adm-table-wrap">
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty Added</th>
                                <th>Added By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="inventory-body">
                            <tr>
                                <td colspan="4" style="text-align:center; color:rgb(190,160,163); padding:2rem;">
                                    connect your backend to load history
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ==========================================
             ORDERS
             ========================================== -->
        <div class="adm-section" id="section-orders">
            <p class="adm-page-title">Orders</p>
            <p class="adm-page-sub">view and update order statuses</p>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.2rem; flex-wrap:wrap; gap:0.8rem;">
                <div class="adm-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="order-search" placeholder="Search by order ID or customer..." oninput="filterTable('order-search','orders-table');">
                </div>
                <select class="adm-select" style="max-width:12rem;" onchange="filterOrderStatus(this.value);">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="adm-card">
                <div class="adm-table-wrap">
                    <table class="adm-table" id="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody id="orders-body">
                            <tr>
                                <td colspan="7" style="text-align:center; color:rgb(190,160,163); padding:2rem;">
                                    connect your backend to load orders
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ==========================================
             CUSTOMERS
             ========================================== -->
        <div class="adm-section" id="section-customers">
            <p class="adm-page-title">Customers</p>
            <p class="adm-page-sub">registered customer accounts</p>

            <div style="margin-bottom:1.2rem;">
                <div class="adm-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="customer-search" placeholder="Search by name or email..." oninput="filterTable('customer-search','customers-table');">
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-table-wrap">
                    <table class="adm-table" id="customers-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Joined</th>
                                <th>Verified</th>
                            </tr>
                        </thead>
                        <tbody id="customers-body">
                            <tr>
                                <td colspan="6" style="text-align:center; color:rgb(190,160,163); padding:2rem;">
                                    connect your backend to load customers
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ==========================================
             PROFILE
             ========================================== -->
        <div class="adm-section" id="section-profile">
            <p class="adm-page-title">My Profile</p>
            <p class="adm-page-sub">manage your admin account</p>

            <div class="adm-card">
                <div style="display:flex; flex-wrap:wrap;">

                    <!-- avatar -->
                    <div class="adm-profile-avatar-wrap" style="min-width:14rem; flex:0 0 auto;">
                        <img class="adm-profile-avatar"
                             id="prof-avatar-img"
                             src="<?php echo $admin['pfp'] ?: 'assests/user.png'; ?>"
                             alt="profile pic">
                        <div class="adm-profile-name"><?php echo htmlspecialchars($admin['fname'].' '.$admin['lname']); ?></div>
                        <div class="adm-profile-role"><?php echo $admin['role'] == 'super_admin' ? '✦ Super Admin' : 'Admin'; ?></div>
                        <span class="adm-badge adm-badge--<?php echo $admin['role'] == 'super_admin' ? 'super' : 'approved'; ?>" style="margin-top:0.4rem;">
                            <?php echo $admin['role'] == 'super_admin' ? 'Super Admin' : 'Admin'; ?>
                        </span>
                        <button class="adm-btn adm-btn--outline adm-btn--sm" style="margin-top:0.8rem;" onclick="document.getElementById('pfp_upload').click();">
                            <i class="bi bi-camera"></i> Change Photo
                        </button>
                        <input type="file" id="pfp_upload" accept="image/*" style="display:none;" onchange="previewPfp();">
                    </div>

                    <!-- form -->
                    <div style="flex:1; padding:1.5rem; min-width:0;">
                        <div class="adm-form-grid">
                            <div>
                                <label class="adm-label">First Name</label>
                                <div class="inp-wrap" style="margin-bottom:0;">
                                    <input type="text" id="prof_fname" class="inp-field" placeholder=" " value="<?php echo htmlspecialchars($admin['fname']); ?>">
                                    <label class="inp-label">First Name</label>
                                </div>
                            </div>
                            <div>
                                <label class="adm-label">Last Name</label>
                                <div class="inp-wrap" style="margin-bottom:0;">
                                    <input type="text" id="prof_lname" class="inp-field" placeholder=" " value="<?php echo htmlspecialchars($admin['lname']); ?>">
                                    <label class="inp-label">Last Name</label>
                                </div>
                            </div>
                            <div>
                                <label class="adm-label">Email</label>
                                <div class="inp-wrap" style="margin-bottom:0;">
                                    <input type="email" id="prof_email" class="inp-field" placeholder=" " value="<?php echo htmlspecialchars($admin['email'] ?? ''); ?>" readonly>
                                    <label class="inp-label">Email</label>
                                </div>
                            </div>
                            <div>
                                <label class="adm-label">Account Status</label>
                                <div class="inp-wrap" style="margin-bottom:0;">
                                    <input type="text" class="inp-field" placeholder=" " value="<?php echo ucfirst($admin['status'] ?? 'approved'); ?>" readonly>
                                    <label class="inp-label">Status</label>
                                </div>
                            </div>
                        </div>

                        <!-- change password -->
                        <div style="margin-top:1.5rem; padding-top:1.2rem; border-top:1px solid rgba(245,217,221,0.8);">
                            <div class="adm-card__title" style="margin-bottom:1rem;">Change Password</div>
                            <div class="adm-form-grid">
                                <div>
                                    <label class="adm-label">New Password</label>
                                    <div class="inp-wrap" style="margin-bottom:0;">
                                        <input type="password" id="prof_newpw" class="inp-field" placeholder=" ">
                                        <label class="inp-label">New Password</label>
                                        <button type="button" class="inp-eye" onclick="togglePw('prof_newpw','spi_p1');"><i id="spi_p1" class="bi bi-eye-slash"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="adm-label">Confirm Password</label>
                                    <div class="inp-wrap" style="margin-bottom:0;">
                                        <input type="password" id="prof_conpw" class="inp-field" placeholder=" ">
                                        <label class="inp-label">Re-type Password</label>
                                        <button type="button" class="inp-eye" onclick="togglePw('prof_conpw','spi_p2');"><i id="spi_p2" class="bi bi-eye-slash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display:flex; justify-content:flex-end; margin-top:1.5rem;">
                            <button class="adm-btn adm-btn--primary" onclick="updateProfile();">
                                <i class="bi bi-check2"></i> Save Changes
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </main>
</div>


<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
<script>

/* =============================================
   SECTION SWITCHER
   ============================================= */
function showSection(name) {
    document.querySelectorAll('.adm-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.adm-nav-item').forEach(b => b.classList.remove('active'));
    const sec = document.getElementById('section-' + name);
    const nav = document.getElementById('nav-' + name);
    if (sec) sec.classList.add('active');
    if (nav) nav.classList.add('active');
    closeSidebar();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* =============================================
   SIDEBAR (mobile)
   ============================================= */
function toggleSidebar() {
    document.getElementById('adm-sidebar').classList.toggle('open');
    document.getElementById('adm-overlay').classList.toggle('open');
}
function closeSidebar() {
    document.getElementById('adm-sidebar').classList.remove('open');
    document.getElementById('adm-overlay').classList.remove('open');
}

/* =============================================
   TABLE SEARCH FILTER
   ============================================= */
function filterTable(inputId, tableId) {
    const q    = document.getElementById(inputId).value.toLowerCase();
    const rows = document.querySelectorAll('#' + tableId + ' tbody tr');
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}

/* =============================================
   ORDER STATUS FILTER
   ============================================= */
function filterOrderStatus(status) {
    const rows = document.querySelectorAll('#orders-table tbody tr');
    rows.forEach(row => {
        const badge = row.querySelector('.adm-badge');
        if (!status || (badge && badge.textContent.trim().toLowerCase() === status)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

/* =============================================
   IMAGE PREVIEW (add product)
   ============================================= */
function previewImages() {
    const files   = document.getElementById('ap_images').files;
    const preview = document.getElementById('ap_image_preview');
    preview.innerHTML = '';
    Array.from(files).slice(0, 5).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML += `<img src="${e.target.result}"
                style="width:5rem;height:5rem;object-fit:cover;border-radius:0.6rem;border:2px solid rgba(245,217,221,0.9);">`;
        };
        reader.readAsDataURL(file);
    });
}

/* =============================================
   PROFILE PHOTO PREVIEW
   ============================================= */
function previewPfp() {
    const file = document.getElementById('pfp_upload').files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('prof-avatar-img').src = e.target.result;
    };
    reader.readAsDataURL(file);
}

/* =============================================
   PASSWORD EYE TOGGLE
   ============================================= */
function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    }
}




function loadSubCategories() { 
    var mainCatID = document.getElementById("ap_main_cat");
    var subCatID = document.getElementById("ap_sub_cat");
    
    var form = new FormData();
    form.append("mcat", mainCatID.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() { 
        if (request.status == 200 && request.readyState == 4) {
            var data = JSON.parse(request.responseText);

            subCatID.innerHTML = '<option value="0" >Select sub category...</option>';

            data.forEach(function(sub) {
                subCatID.innerHTML += '<option value="' + sub.sub_category_id + '">' + sub.name + '</option>';
            });
        }
    }
    request.open("POST", "loadSubCategoryProcess.php", true)
    request.send(form);
}

function addProduct()        { 
    var title = document.getElementById("ap_title");
    var price = documenet.getElementById("ap_price");
    var mc = document.getElementById("ap_main_cat");
    var sc = document.getElementById("ap_sub_cat");
    var desc = document.getElementById("ap_desc");
}



function editProduct(id)     { /* your AJAX */ }
function deleteProduct(id)   { /* your AJAX */ }
function addStock()          { /* your AJAX */ }
function updateOrderStatus(id, status) { /* your AJAX */ }
function updateProfile()     { /* your AJAX */ }
function adminSignout()      { /* your signout */ }

</script>
</body>
</html>