<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<body>
    <h2>Login</h2>
    <form id="loginform">
        <input type="text" name="username" id="username" placeholder="Usuario" required><br>
        <input type="password" name="password" id="password" placeholder="Contraseña" required><br>
        <button type="submit">Entrar</button>
    </form>

    <div id="errorMsg" style="color: red;"></div>

    <script>
        document.getElementById(loginform).addEventListener("submit", async function(e) {
            e.preventDefault();
              const formData = new FormData(this);

      const response = await fetch("/app/controllers/AuthController.php?action=login", {
        method: "POST",
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        window.location.href = "/views/dashboard.php";
      } else {
        document.getElementById("errorMsg").textContent = result.message;
      }
    });
    
    </script>

</body>

</html>