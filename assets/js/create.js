document
  .getElementById("taskForm")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const confirmar = confirm("¿Estás seguro de que deseas crear esta tarea?");
    if (!confirmar) return;

    const formData = new FormData(this);

    try {
      const response = await fetch(
        "/TaskManager/app/controllers/TaskController.php?action=create",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      const formMsg = document.getElementById("formMsg");
      if (result.success) {
        window.location.href = result.redirect;
        alert("¡Tarea creada exitosamente!");
      } else {
        formMsg.textContent = "Error: " + result.message;
        formMsg.style.color = "red";
      }
    } catch (error) {
      document.getElementById("formMsg").textContent = "Error al crear tarea.";
      console.error(error);
    }
  });

