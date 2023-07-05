<header class="mb-5">
  <nav class="navbar navbar-expand-lg bg-white align-items-start">
      <div class="container" style="flex-direction: row-reverse;">
          <a href="{{ route('register') }}" class="text-black-60 me-2 btn border border-dark-subtle py-2 px-4" type="button">
              حساب جديد
              <i class="fa-solid fa-user-plus ps-2"></i>
          </a>

          <a href="{{ route('login') }}" class="text-black-60 me-2 btn border border-dark-subtle py-2 px-4" type="button">
              دخول
              <i class="fa-solid fa-arrow-right-to-bracket pe-1"></i>
          </a>

          <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#main"
          aria-controls="main"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fa-solid fa-bars"></i>
          </button>
          
          <div class="collapse navbar-collapse" id="main">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link p-2 p-lg-3" aria-current="page" href="#">المقدمة</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link p-2 p-lg-3 active" href="index.html">تواصل معنا</a>
                  </li>
              </ul>
          </div>
          <div class="search ps-3 pe-3 d-none d-lg-block">
              <i class="fa-solid fa-magnifying-glass"></i>
          </div>
      </div>
  </nav>
</header>