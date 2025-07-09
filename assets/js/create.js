
  document.getElementById("taskForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
      const response = await fetch("/TaskManager/app/controllers/TaskController.php?action=create", {
        method: "POST",
        body: formData
      });

      const result = await response.json();

      const formMsg = document.getElementById("formMsg");
      if (result.success) {
        formMsg.textContent = "Tarea creada exitosamente";
        formMsg.style.color = "green";
        this.reset();
      } else {
        formMsg.textContent = "Error: " + result.message;
        formMsg.style.color = "red";
      }

    } catch (error) {
      document.getElementById("formMsg").textContent = "Error al crear tarea.";
      console.error(error);
    }
  });