
async function cargarTareas() {
  try {
    const response = await fetch("/TaskManager/app/controllers/TaskController.php?action=list");
    const result = await response.json();

    const container = document.getElementById("tasklist");
    container.innerHTML = "";

    if (result.success && result.tasks.length > 0) {
      result.tasks.forEach((task) => {
        const estado = task.is_completed == 1 ? "Completada" : "Pendiente";
        const fecha = new Date(task.created_at).toLocaleString();

        const div = document.createElement("div");
        div.innerHTML = `
                        <strong>${task.title}</strong><br>
                        <em>${task.description ?? "Sin descripción"}</em><br>
                        Estado: ${estado}<br>
                        Creada: ${fecha}
                        <hr>
                    `;
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
