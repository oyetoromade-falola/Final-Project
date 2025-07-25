<?php
/* ---------- bootstrap session & username --------------- */
session_start();
$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FAQs & Testimonials – COURSEMART FCFMT</title>
  <meta name="viewport" content="width=device-width,initial‑scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <style>
    /* 💬 Chat theming */
    #chatBox{background:#f8f9fa;border-radius:10px}
    #chatMessages div{margin-bottom:8px;padding:6px 10px;
      background:#e0f0ff;border-radius:8px;word-wrap:break-word;font-size:14px}
    .chat-dark{background:#1e1e2f!important;color:#fff}
    .chat-dark textarea,.chat-dark .btn{background:#2b2b3d!important;color:#fff}

    /* Dark‑mode toggle for whole page (optional) */
    body.dark-page{background:#121212;color:#e4e4e4}
  </style>
</head>
<body>

<!-- ░░ Navbar ░░ -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="img/coursemart-logo.png" alt="Logo" width="40" height="40" class="me-2">
      <strong>COURSEMART FCFMT</strong>
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link"   href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link"   href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link"   href="courses.html">Courses</a></li>
        <li class="nav-item"><a class="nav-link"   href="contact.html">Contact</a></li>
        <li class="nav-item"><a class="nav-link"   href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link"   href="faq_testimonials.php">FAQs</a></li>
        <li class="nav-item"><a class="nav-link"   href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- ░░ Page Header ░░ -->
<header class="bg-primary text-white text-center py-3">
  <h1>FAQs & Testimonials</h1>
</header>

<div class="container py-5">

  <!-- ░░ FAQs ░░ -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary m-0">Frequently Asked Questions</h2>

    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="darkPageToggle">
      <label class="form-check-label" for="darkPageToggle">Dark Mode</label>
    </div>
  </div>

  <input id="faqSearch" class="form-control mb-4" placeholder="Search FAQs…">

  <div class="accordion" id="faqAccordion">
    <!-- FAQ #1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="hdr1">
        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">
          What is COURSEMART FCFMT?
        </button>
      </h2>
      <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          COURSEMART turns course registration into a smooth, e‑commerce‑style experience with smart recommendations and a personal wallet.
        </div>
      </div>
    </div>

    <!-- FAQ #2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="hdr2">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
          How do I sign up?
        </button>
      </h2>
      <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Click <em> click on the get started in your homepage Login → Sign Up</em>, fill in your student details, and you’re done!
        </div>
      </div>
    </div>

    <!-- FAQ #3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="hdr3">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
          Will COURSEMART recommend courses for me?
        </button>
      </h2>
      <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Absolutely — based on what you add to your cart, the platform suggests related courses and materials.
        </div>
      </div>
    </div>
  </div>

  <!-- ░░ Testimonials ░░ -->
  <h2 class="text-center text-primary mt-5 mb-4">Student Testimonials</h2>
  <div class="row gy-4" id="testimonials">

    <?php
    /* ➜ real projects would fetch these from DB */
    $testis = [
      ["msg"=>"Coursemart platform is an interesting and friendly user interface platform, which provides me with easy access to the course of my interest and other related courses. This is amazing!","name"=>"Alimi Mubaraq Eyitayo"],
      ["msg"=>"COURSEMART made it easy for me to find and enroll in my ICT courses without any stress. I love the user interface!","name"=>"Shittu Usman Olatunji"],
      ["msg"=>"I find this interface very helpful, and it will boost my Academy performance,i love it and is a sure plug to me.thanks to COURSEMART FCFMT.","name"=>"Uwakwe Precious"],
      ["msg"=>"First, welcome page review(view course, there is a need for a brief intro on what the course is about.<br>

secondly, course section needs to be able to cart when courses are selected.<br>

thirdly, recommendation section need more professional courses to be added.<br>

Lastly, the wallet page. no deduction of fee after payment, Needs wallet deduction, but overall awesome!","name"=>"Okeke Vivian"],
    ];
    foreach($testis as $t): ?>
      <div class="col-md-6">
        <div class="card shadow h-100">
          <div class="card-body">
            <p class="card-text">“<?= $t['msg'] ?>”</p>
            <h6 class="card-subtitle text-muted">– <?= $t['name'] ?></h6>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <!-- ░░ Add new testimonial ░░ -->
  <h4 class="text-center mt-5">Submit Your Testimonial</h4>
  <form action="submit_testimonial.php" method="post" class="mx-auto" style="max-width:600px;">
    <div class="mb-3">
      <label class="form-label" for="name">Full Name</label>
      <input  id="name" name="name"  class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="department">Department</label>
      <input  id="department" name="department" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="message">Testimonial</label>
      <textarea id="message" name="message" rows="3" class="form-control" required></textarea>
    </div>
    <button class="btn btn-primary">Submit</button>
  </form>
</div><!-- /.container -->

<!-- ░░ Floating Chat ░░ -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:1050;">
  <button class="btn btn-sm btn-secondary mb-2" onclick="toggleTheme()">🌙 Theme</button>
  <button class="btn btn-info"                 onclick="toggleChat()">💬 Chat</button>

  <div id="chatBox" class="card shadow d-none" style="width:300px;">
    <div class="card-header bg-primary text-white">Live Chat</div>
    <div class="card-body">
      <div id="chatMessages" style="height:200px;overflow-y:auto;"></div>
      <textarea id="chatInput" class="form-control mb-2" rows="2" placeholder="Type a message…"></textarea>
      <button class="btn btn-sm btn-primary w-100" onclick="sendMessage()">Send</button>
    </div>
  </div>
</div>

<!-- ░░ Footer ░░ -->
<footer class="text-center text-white bg-dark py-3 mt-5">
  <p>&copy; 2025 COURSEMART FCFMT | Designed by <strong>Falola Regina</strong></p>
  <p><a class="footer-link" href="contact.html">Contact</a> | <a class="footer-link" href="about.html">About</a></p>
</footer>

<!-- ░░ JS ░░ -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ===========================================================
   Config
   =========================================================== */
const loggedInUser = "<?= htmlspecialchars($username,ENT_QUOTES) ?>"; // "Guest" fallback

/* ===========================================================
   Chat helpers
   =========================================================== */
function toggleChat(){
  const box = document.getElementById('chatBox');
  box.classList.toggle('d-none');
  if(!box.classList.contains('d-none')) fetchMessages();
}

function toggleTheme(){
  document.getElementById('chatBox').classList.toggle('chat-dark');
}

function sendMessage(){
  const msg = document.getElementById('chatInput').value.trim();
  if(!msg) return;

  fetch('send_message.php',{
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:`username=${encodeURIComponent(loggedInUser)}&message=${encodeURIComponent(msg)}`
  }).then(()=>{ document.getElementById('chatInput').value=''; fetchMessages(); });
}

function fetchMessages(){
  fetch('fetch_messages.php')
    .then(r=>r.json())
    .then(data=>{
      const wrap = document.getElementById('chatMessages');
      wrap.innerHTML = data.map(m=>`<div><strong>${m.username}:</strong> ${m.message}</div>`).join('');
      wrap.scrollTop = wrap.scrollHeight;
    });
}

/* Auto‑refresh every 5 s when chat is open */
setInterval(()=>{ if(!document.getElementById('chatBox').classList.contains('d-none')) fetchMessages(); },5000);

/* ===========================================================
   Dark page mode
   =========================================================== */
document.getElementById('darkPageToggle')?.addEventListener('change',()=>{
  document.body.classList.toggle('dark-page');
});

/* ===========================================================
   FAQ search
   =========================================================== */
document.getElementById('faqSearch')?.addEventListener('keyup',function(){
  const v = this.value.toLowerCase();
  document.querySelectorAll('.accordion-item').forEach(item=>{
    item.style.display = item.innerText.toLowerCase().includes(v)?'block':'none';
  });
});
</script>
</body>
</html>
