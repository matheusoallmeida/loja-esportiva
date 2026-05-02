<nav class="navbar navbar-expand-lg navbar-light  bg-light  border-bottom py-3">  <!-- py-3 espaçamento -->
  <div class="container">

    <!-- Logo -->
  <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" height="40">

    <!-- Botão mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="menu">

      <!-- Links -->
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="#">Lançamentos</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Masculino</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Feminino</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Infantil</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Ofertas</a></li>
      </ul>

      <!-- Busca + ícones -->
      <div class="d-flex align-items-center gap-3">

        <!-- Busca -->
        <input class="form-control" type="search" placeholder="Buscar">

        <!-- Ícones -->
        <span>❤️</span>
        <span>🛒</span>

      </div>

    </div>
  </div>
</nav>