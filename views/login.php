<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex felx-column justify-content-center align-items-center vh-100">

  <div class="card p-4 shadow-sm" style="width: 320px;">
    <h1 class="text-ceter mb-3">Task Manager</h1>
    <h2 class="text-center mb-4">Login</h2>

    <form id="loginform" novalidate>
      <div class="mb-3">
      <input type="text" name="username" id="username" placeholder="Usuario" required><br>
      </div>
      <div class="mb-3">
      <input type="password" name="password" id="password" placeholder="Contraseña" required><br>
      </div>
      <button type="submit" class="btn bnt -primary w-100">Entrar</button>
    </form>

    <div id="errorMsg" class="text-danger mt-3"></div>
  </div>

  <script src="../assets/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>