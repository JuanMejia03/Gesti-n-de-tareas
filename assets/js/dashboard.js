async function cargarTareas() {
  try {
    const response = await fetch(
      "/TaskManager/app/controllers/TaskController.php?action=list"
    );
    const result = await response.json();

    const container = document.getElementById("tasklist");
    container.innerHTML = "";

    if (result.success && result.tasks.length > 0) {
      result.tasks.forEach((task) => {
        const estado = task.is_completed == 1 ? "Completada" : "Pendiente";
        const fecha = new Date(task.created_at).toLocaleString();

        const div = document.createElement("div");

        const btnEliminar = document.createElement("button");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.addEventListener("click", async () => {
          const confirmar = confirm(`¿eliminar la tarea "${task.title}"?`);
          if (!confirmar) return;

          const formData = new FormData();
          formData.append("id", task.id);

          const res = await fetch(
            "/TaskManager/app/controllers/TaskController.php?action=delete",
            {
              method: "POST",
              body: formData,
            }
          );

          if (!res.ok) {
            throw new Error("Error en la respuesta del servidor");
          }

          const resultado = await res.json();

          if (resultado.success) {
            div.remove();
          } else {
            alert("Error al eliminar la tarea");
          }
        });

        div.innerHTML = `
                        <strong>${task.title}</strong><br>
                        <em>${task.description ?? "Sin descripción"}</em><br>
                        Estado: ${estado}<br>
                        Creada: ${fecha}
                    `;

        div.appendChild(document.createElement("br"));
        div.appendChild(btnEliminar);
        div.appendChild(document.createElement("hr"));
        container.appendChild(div);
      });
    } else {
      container.textContent = "No hay tareas disponibles.";
    }
  } catch (error) {
    console.error("Error al cargar tareas:", error);
    document.getElementById("tasklist").textContent =
      "No se pudieron cargar las tareas.";
  }
}

document.addEventListener("DOMContentLoaded", cargarTareas);
