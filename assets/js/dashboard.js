async function cargarTareas() {
  try {
    //Peticion para las tareas
    const response = await fetch(
      "/TaskManager/app/controllers/TaskController.php?action=list"
    );
    const result = await response.json();

    const container = document.getElementById("tasklist");
    container.innerHTML = "";
    //Creacion de un listado de las tareas dependiendo del tamaño del arreglo
    if (result.success && result.tasks.length > 0) {
      result.tasks.forEach((task) => {
        const estado = task.is_completed == 1 ? "Completada" : "Pendiente";
        const fecha = new Date(task.created_at).toLocaleString();

        const card = document.createElement("div");
        card.className = "col-md-4";

        // creacion de las tareas dependiendo del array
        card.innerHTML = `
          <div class="card ${
            task.is_completed == 1 ? "border-success" : "border-warning"
          } h-100">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">${task.title}</h5>
              <p class="card-text flex-grow-1">${
                task.description ?? "Sin descripción"
              }</p>
              <p class="card-text"><small class="text-muted">Estado: ${estado}</small></p>
              <p class="card-text"><small class="text-muted">Creada: ${fecha}</small></p>
              <div class="d-flex justify-content-between mt-auto">
                <button class="btn btn-danger btn-sm btnEliminar">Eliminar</button>
                <button class="btn btn-primary btn-sm btnEditar">Editar</button>
                <button class="btn btn-outline-secondary btn-sm btnToggle">${
                  task.is_completed == 1 ? "Pendinete" : "Completar"
                }</button>
               </div>
            </div>
          </div>
        `;

        const btnEliminar = card.querySelector(".btnEliminar");
        btnEliminar.addEventListener("click", async () => {
          if (!confirm(`¿Eliminar la tarea "${task.title}"?`)) return;

          const formData = new FormData();
          formData.append("id", task.id);

          const res = await fetch(
            "/TaskManager/app/controllers/TaskController.php?action=delete",
            {
              method: "POST",
              body: formData,
            }
          );

          const resultado = await res.json();

          if (resultado.success) {
            cargarTareas();
          } else {
            alert("Error al eliminar la tarea");
          }
        });

        const btnEditar = card.querySelector(".btnEditar");
        btnEditar.addEventListener("click", () => {
          document.getElementById("editTaskId").value = task.id;
          document.getElementById("editTitle").value = task.title;
          document.getElementById("editDescription").value =
            task.description ?? "";
          editModal.show();
        });

        const btnToggle = card.querySelector(".btnToggle");
        btnToggle.addEventListener("click", async () => {
          const formData = new FormData();
          formData.append("id", task.id);
          formData.append("is_completed", task.is_completed == 1 ? 0 : 1);

          const res = await fetch(
            "/TaskManager/app/controllers/TaskController.php?action=toggle",
            {
              method: "POST",
              body: formData,
            }
          );

          const result = await res.json();

          if (result.success) {
            cargarTareas();
          } else {
            alert("Error al cambiar el estado");
          }
        });

        container.appendChild(card);
      });
    } else {
      container.innerHTML =
        '<p class="text-center text-muted">No hay tareas disponibles.</p>';
    }
  } catch (error) {
    console.error("Error al cargar tareas:", error);
    document.getElementById("tasklist").innerHTML =
      '<p class="text-danger">No se pudieron cargar las tareas.</p>';
  }
}

document.addEventListener("DOMContentLoaded", () => {
  cargarTareas();

  const modalElement = document.getElementById("editModal");
  window.editModal = new bootstrap.Modal(modalElement);
});

//para guardar los cambis realizdos en el modal papito bello

document.getElementById("ediForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const confirmar = confirm("deseas hacer la edicion de la tarea");
  if (!confirmar) return;

  const id = document.getElementById("editTaskId").value;
  const title = document.getElementById("editTitle").value.trim();
  const description = document.getElementById("editDescription").value.trim();

  const formData = new FormData();
  formData.append("id", id);
  formData.append("title", title);
  formData.append("description", description);

  const res = await fetch(
    "/TaskManager/app/controllers/TaskController.php?action=update",
    {
      method: "POST",
      body: formData,
    }
  );

  const result = await res.json();

  if (result.success) {
    alert("Tarea actualizada correctamente");
    editModal.hide();
    cargarTareas();
  }
});
