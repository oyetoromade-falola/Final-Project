<?php
session_start();

/* ✅ Secure‑session check */
if (
    !isset($_SESSION['logged_in']) ||
    $_SESSION['logged_in'] !== true ||
    $_SESSION['role'] !== 'student'
) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Dashboard – COURSEMART FCFMT</title>

  <!-- Styles -->
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>

  <style>
    html,body{height:100%;margin:0}
    body{display:flex;flex-direction:column;background:#f4f7fa}
    main{flex:1}
    .card{border-radius:10px;box-shadow:0 2px 15px rgba(0,0,0,.05)}
    .welcome-box{background:linear-gradient(to right,#007bff,#0056b3);color:#fff;padding:2rem;border-radius:10px;margin-bottom:2rem}
    .section-title{font-weight:600;color:#333;margin-top:2rem;margin-bottom:1rem;border-bottom:2px solid #007bff;padding-bottom:.5rem}
    .footer-highlight{color:#ffc107;font-weight:700}
    .footer-credit{color:#ffffffcc;font-style:italic}
    .footer-link{color:#0dcaf0;font-weight:600;text-decoration:none}
    .footer-link:hover{color:#fff}
    .nav-text{font-weight:600;color:#f8f9fa}
    .nav-link:hover .nav-text{color:#ffc107}
  </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="img/coursemart-logo.png" alt="Logo" width="40" height="40" class="me-2">
      <strong>COURSEMART FCFMT</strong>
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
       <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php"><span class="nav-text">Home</span></a></li>
          <!-- ✅ Show Admin link only if admin is logged in -->
    <li class="nav-item">
  <a class="nav-link" href="admin_panel.php">
    <span class="nav-text">Admin</span>
  </a>
</li>
     <li class="nav-item"><a class="nav-link" href="cart.html"><span class="nav-text">Cart</span></a></li>

        <li class="nav-item"><a class="nav-link" href="about.html"><span class="nav-text">About</span></a></li>
        <li class="nav-item"><a class="nav-link" href="courses.html"><span class="nav-text">Courses</span></a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html"><span class="nav-text">Contact</span></a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><span class="nav-text">Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="faq_testimonials.php"><span class="nav-text">FAQs</span></a></li>
        <?php if (isset($_SESSION['admin_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="admin_panel.php"><span class="nav-text">Admin</span></a></li>
        <?php endif; ?> 
        <li class="nav-item"><a class="nav-link" href="logout.php"><span class="nav-text">Logout</span></a></li>
      </ul>
    </div>
  </div>
</nav>

<main>
  <div class="container mt-5">
    <div class="welcome-box text-center">
      <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Student'); ?>!</h2>
      <p class="lead">Here’s a quick overview of your activity on COURSEMART FCFMT.</p>
    </div>

    <!-- Wallet -->
    <div class="card border-primary shadow-sm mb-4 text-center">
      <div class="card-body">
        <h5 class="card-title text-primary">🎓 Wallet Balance</h5>
        <p class="fs-4 fw-bold">₦<span id="walletDisplay">0.00</span></p>
        <a href="wallet.html" class="btn btn-outline-primary btn-sm">Top Up Wallet</a>
      </div>
    </div>

    <!-- Stats -->
    <div class="row text-center g-4">
      <div class="col-md-4"><div class="card p-4"><h5>Total Items in Cart</h5><h3 class="text-primary" id="cartCount">0</h3></div></div>
      <div class="col-md-4"><div class="card p-4"><h5>Recently Added</h5><h3 class="text-success" id="recentCount">0</h3></div></div>
      <div class="col-md-4"><div class="card p-4"><h5>Recommendations</h5><h3 class="text-warning" id="recommendCount">0</h3></div></div>
    </div>

    <!-- Recommendations -->
    <h4 class="section-title">Recommended Courses</h4>
    <div class="row g-4" id="recommendations"><!-- JS injects here --></div>
  </div>

  <!-- 🔍 Recommendation Modal -->
  <div class="modal fade" id="recommendationModal" tabindex="-1" aria-labelledby="recommendationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="recommendationLabel">Item added to cart ✅<br>You may also like</h5>
          <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"><div class="row g-4" id="modal-recs"></div></div>
      </div>
    </div>
  </div>
</main>

<!-- ✅ Footer -->
<footer class="text-center text-white bg-dark py-3 mt-5">
  <p><span class="footer-highlight">&copy; 2025 COURSEMART FCFMT</span> | <span class="footer-credit">Designed by <strong>Falola Regina</strong></span></p>
  <p><a class="footer-link" href="contact.html">Contact</a> | <a class="footer-link" href="about.html">About</a></p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ----------------------------------------------------------
   Complete course catalogue (ID‑keyed)
   ---------------------------------------------------------- */
const courseCatalog = {
  1:{title:"Microsoft Excel",image:"img/excel.webp",department:"ICT & Computer Science",data_id:123},
  2:{title:"Data Analytics",image:"img/data.webp",department:"ICT & Computer Science",data_id:123},
  3:{title:"Web Development",image:"img/webdev.webp",department:"ICT & Computer Science",data_id:123},
  4:{title:"Cyber Security (Basics)",image:"img/cyber1.webp",department:"ICT & Computer Science",data_id:123},
  5:{title:"Data Structures & Algorithms",image:"img/Data Structures & Algorithm1.webp",department:"ICT & Computer Science",data_id:123},
  6:{title:"Software Engineering",image:"img/Software Engineering.webp",department:"ICT & Computer Science",data_id:123},
  7:{title:"Cybersecurity Fundamentals",image:"img/Cybersecurity Fundamentals.webp",department:"ICT & Computer Science",data_id:null},
  8:{title:"Cloud Computing",image:"img/Cloud Computing.webp",department:"ICT & Computer Science",data_id:123},
  9:{title:"Mobile App Development",image:"img/Mobile App Development.webp",department:"ICT & Computer Science",data_id:123},
  10:{title:"Database Systems (MySQL, Oracle)",image:"img/Database Systems (MySQL, Oracle).webp",department:"ICT & Computer Science",data_id:123},
  11:{title:"Linux for Beginners",image:"img/Linux for Beginners.webp",department:"ICT & Computer Science",data_id:123},
  12:{title:"Microsoft Excel for Data Analysis",image:"img/Microsoft Excel for Data Analysis.webp",department:"ICT & Computer Science",data_id:123},
  13:{title:"JavaScript Full Stack Bootcamp",image:"img/JavaScript Full Stack Bootcamp.webp",department:"ICT & Computer Science",data_id:123},
  14:{title:"UI/UX Design Principles",image:"img/ux.webp",department:"ICT & Computer Science",data_id:123},
  15:{title:"Digital Marketing & SEO",image:"img/Digital Marketing & SEO.webp",department:"ICT & Computer Science",data_id:123},
  16:{title:"Artificial Intelligence (AI) & Machine Learning",image:"img/Artificial Intelligence (AI) & Machine Learning.webp",department:"ICT & Computer Science",data_id:123},
  17:{title:"Fish Breeding & Hatchery",image:"img/fish-breeding.webp",department:"Marine & Fisheries Technology",data_id:123},
  18:{title:"Fish Feed Production",image:"img/fish-feed.webp",department:"Marine & Fisheries Technology",data_id:123},
  19:{title:"Motorman",image:"img/motorman.webp",department:"Marine & Fisheries Technology",data_id:123},
  20:{title:"Fitter (Machinist)",image:"img/fitter.webp",department:"Marine & Fisheries Technology",data_id:123},
  21:{title:"Oceanography",image:"img/Oceanography.webp",department:"Marine & Fisheries Technology",data_id:123},
  22:{title:"Marine Biology",image:"img/Marine Biology.webp",department:"Marine & Fisheries Technology",data_id:123},
  23:{title:"Fisheries Economics",image:"img/Fisheries Economics.webp",department:"Marine & Fisheries Technology",data_id:123},
  24:{title:"Aquatic Animal Health",image:"img/Aquatic Animal Health.webp",department:"Marine & Fisheries Technology",data_id:123},
  25:{title:"Fish Nutrition & Feeding",image:"img/Fish Nutrition & Feeding.webp",department:"Marine & Fisheries Technology",data_id:123},
  26:{title:"Vessel Navigation",image:"img/Vessel Navigation.webp",department:"Marine & Fisheries Technology",data_id:123},
  27:{title:"Maritime Safety and Law",image:"img/Maritime Safety and Law.webp",department:"Marine & Fisheries Technology",data_id:123},
  28:{title:"Marine Pollution Management",image:"img/Marine Pollution Management.webp",department:"Marine & Fisheries Technology",data_id:123},
  29:{title:"Coastal Zone Management",image:"img/Coastal Zone Management.webp",department:"Marine & Fisheries Technology",data_id:123},
  30:{title:"Efficient Deck Hand",image:"img/nautical.webp",department:"Nautical Science,Marine Transport & Business, Hydrology & Water Resources",data_id:123},
  31:{title:"Shipping & Port Management",image:"img/business.webp",department:"Nautical Science,Marine Transport & Business, Hydrology & Water Resources",data_id:123},
  32:{title:"Water Quality Management",image:"img/water.webp",department:"Nautical Science,Marine Transport & Business, Hydrology & Water Resources",data_id:123},
  33:{title:"Laptop",image:"img/laptop.webp",department:"Student Essentials",data_id:123},
  34:{title:"Scientific Calculator",image:"img/calculator.webp",department:"Student Essentials",data_id:123},
  35:{title:"Academic planners",image:"img/Academic planners.webp",department:"Student Essentials",data_id:123},
  36:{title:"Notebook (40 Leaves)",image:"img/notebook.webp",department:"Student Essentials",data_id:123},
  37:{title:"Practical logbooks",image:"img/Practical logbooks.webp",department:"Student Essentials",data_id:123},
  38:{title:"Ballpoint Pen (Blue)",image:"img/pen.webp",department:"Student Essentials",data_id:123},
  39:{title:"USB Flash Drive (16GB)",image:"img/flashdrive.webp",department:"Student Essentials",data_id:123},
  40:{title:"Mathematical Drawing Set",image:"img/drawingset.webp",department:"Student Essentials",data_id:123},
  41:{title:"Student Backpack",image:"img/backpack.webp",department:"Student Essentials",data_id:123},
  42:{title:"MTN 4G LTE Modem",image:"img/modem.webp",department:"Student Essentials",data_id:123},
  43:{title:"White Laboratory Coat",image:"img/labcoat.webp",department:"Student Essentials",data_id:123},
  44:{title:"FCFMT ID Card Holder",image:"img/FCFMT ID Card Holder.webp",department:"Student Essentials",data_id:123},
  45:{title:"Student lab manuals",image:"img/Student lab manuals.webp",department:"Student Essentials",data_id:123},
  46:{title:"Drawing boards",image:"img/Drawing boards.webp",department:"Student Essentials",data_id:123},
  47:{title:"Rechargeable study lamps",image:"img/Rechargeable study lamps.webp",department:"Student Essentials",data_id:123},
  48:{title:"Mini whiteboards & markers",image:"img/Mini whiteboards & markers.webp",department:"Student Essentials",data_id:123}
};

/* ---------- Helpers ---------- */
const courseArr = Object.values(courseCatalog);               // easier iteration
const titleIndex = Object.fromEntries(courseArr.map(c=>[c.title,c])); // title → course

function getCourseByTitle(t){return titleIndex[t]||null;}
function getCart(){return JSON.parse(localStorage.getItem("cart")||"[]");}
function saveCart(c){localStorage.setItem("cart",JSON.stringify(c));}

/* ---------- Initial load ---------- */
document.addEventListener("DOMContentLoaded",()=>{
  const cart = getCart();
  document.getElementById("walletDisplay").textContent =
      parseFloat(localStorage.getItem("walletBalance")||"0").toFixed(2);
  document.getElementById("cartCount").textContent   = cart.length;
  document.getElementById("recentCount").textContent = cart.slice(-2).length;

  buildRecommendations();
});

function buildRecommendations() {
  const recWrap = document.getElementById("recommendations");
  const recCounter = document.getElementById("recommendCount");
  const cart = getCart();

  if (!cart.length) {
    recWrap.innerHTML = `<div class="col-12 text-center text-muted">
      No recommendations yet – add something to your cart.
    </div>`;
    recCounter.textContent = "0";
    return;
  }

  const cartTitles = new Set(cart.map(c => c.name));
  const categoriesInCart = new Map();

  // Step 1: Group cart items by category
  for (const item of cart) {
    const course = Object.values(courseCatalog).find(c => c.title === item.name);
    if (course && course.department) {
      if (!categoriesInCart.has(course.department)) {
        categoriesInCart.set(course.department, []);
      }
      categoriesInCart.get(course.department).push(course.title);
    }
  }

  const allRecommendations = [];

  // Step 2: For each category, try to get at least one course not in cart
  for (const [category] of categoriesInCart) {
    const available = Object.values(courseCatalog).filter(c =>
      c.department === category && !cartTitles.has(c.title)
    );

    if (available.length) {
      allRecommendations.push(...available.slice(0, 1)); // Pick one from this category
    }
  }

  // Step 3: If we got less than 4 and only one category has available courses
  if (allRecommendations.length < 4) {
    // Try to find the first category with more available options
    for (const [category] of categoriesInCart) {
      const remaining = Object.values(courseCatalog).filter(c =>
        c.department === category && !cartTitles.has(c.title) &&
        !allRecommendations.includes(c)
      );
      for (let i = 0; i < remaining.length && allRecommendations.length < 4; i++) {
        allRecommendations.push(remaining[i]);
      }
      if (allRecommendations.length >= 4) break;
    }
  }

  // Step 4: Final recommendation list (up to 4)
  const recs = allRecommendations.slice(0, 4);
  recCounter.textContent = recs.length;

  if (!recs.length) {
    recWrap.innerHTML = `<div class="col-12 text-center text-muted">
      You've already added everything we could recommend 😅
    </div>`;
    return;
  }

  // Step 5: Render the recommendations
  recWrap.innerHTML = recs.map(data => `
    <div class="col-md-3 col-6">
      <div class="card text-center shadow-sm course-card">
        <img src="${data.image}" class="card-img-top" alt="${data.title}">
        <div class="card-body">
          <h6 class="card-title">${data.title}</h6>
          <button class="btn btn-sm btn-outline-primary"
                  onclick="addToCart('${data.title.replace(/'/g,"\\'")}', '${data.image.replace(/'/g,"\\'")}')">
            Add to Cart
          </button>
        </div>
      </div>
    </div>
  `).join('');
}

/* ---------- Add‑to‑Cart ---------- */
function addToCart(title,image){
  const cart=getCart();
  if(cart.some(i=>i.name===title)){alert("Item already in your cart.");return;}

  const course=getCourseByTitle(title);
  cart.push({
    name:title,
    image:image,
    quantity:1,
    department:course?course.department:"Other",
    price:1000
  });
  saveCart(cart);

  document.getElementById("cartCount").textContent = cart.length;
  buildRecommendations();

  /* copy main grid into modal for a familiar look */
  document.getElementById("modal-recs").innerHTML =
    document.getElementById("recommendations").innerHTML;

  new bootstrap.Modal(document.getElementById("recommendationModal")).show();
}
</script>
</body>
</html>
