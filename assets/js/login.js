
   document.getElementById("loginform").addEventListener("submit", async function(e) {
      e.preventDefault();
      const formData = new FormData(this);

      const response = await fetch("/TaskManager/app/controllers/AuthController.php?action=login", {
        method: "POST",
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        window.location.href = result.redirect;
      } else {
        document.getElementById("errorMsg").textContent = result.message;
      }
    });


    