async function cargarTareas() {
  try {
    //Peticion para las tareas
    const response = await fetch("/TaskManager/app/controllers/TaskController.php?action=list");
    const result = await response.json();

    const container = document.getElementById("tasklist");
    container.innerHTML = "";
    //Creacion de un listado de las tareas dependiendo del tamaño del arreglo
    if (result.success && result.tasks.length > 0) {
      result.tasks.forEach((task) => {
        const estado = task.is_completed == 1 ? "Completada" : "Pendiente";
        const fecha = new Date(task.created_at).toLocaleString();

        const div = document.createElement("div");

        //Creacion del boton eliminar
        const btnEliminar = document.createElement("button");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.addEventListener("click", async () => {
          const confirmar = confirm(`¿eliminar la tarea "${task.title}"?`);
          if (!confirmar) return;

          const formData = new FormData();
          formData.append("id", task.id);

          const res = await fetch("/TaskManager/app/controllers/TaskController.php?action=delete",
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

        //boton para editar
        const btnEditar = document.createElement("button");
        btnEditar.textContent = "Editar";
        btnEditar.addEventListener("click", () => {
          document.getElementById("editTaskId").value = task.id;
          document.getElementById("editTitle").value = task.title;
          document.getElementById("editDescription").value =
            task.description ?? "";
          document.getElementById("editModal").style.display = "flex";
        });

        //botoncito tipo toogle para el estado de la tarea
        const btnToggle = document.createElement("button");
        btnToggle.textContent = task.is_completed == 1 ? "Marcar como pendiente" : "Marcar como completada";

        btnToggle.addEventListener("click", async () => {
          const formData = new FormData();
          formData.append("id", task.id);
          formData.append("is_completed", task.is_completed == 1 ? 0 : 1);

          const res = await fetch("/TaskManager/app/controllers/TaskController.php?action=toggle",
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

        // impresion de los valores de cada campo
        div.innerHTML = `
                        <strong>${task.title}</strong><br>
                        <em>${task.description ?? "Sin descripción"}</em><br>
                        Estado: ${estado}<br>
                        Creada: ${fecha}
                    `;

        //uniendo los diferentes elemonts al nodo pricnipal dhaaaa
        div.appendChild(document.createElement("br"));
        div.appendChild(btnEliminar);
        div.appendChild(btnEditar);
        div.appendChild(btnToggle);
        div.appendChild(document.createElement("hr"));
        container.appendChild(div);
      });
    } else {
      container.textContent = "No hay tareas disponibles.";
    }
  } catch (error) {
    console.error("Error al cargar tareas:", error);
    document.getElementById("tasklist").textContent = "No se pudieron cargar las tareas.";
  }
}

document.addEventListener("DOMContentLoaded", cargarTareas);

//para guardar los cambis realizdos en el modal papito bello

document.getElementById("ediForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const id = document.getElementById("editTaskId").value;
  const title = document.getElementById("editTitle").value;
  const description = document.getElementById("editDescription").value;

  const formData = new FormData();
  formData.append("id", id);
  formData.append("title", title);
  formData.append("description", description);

  const res = await fetch("/TaskManager/app/controllers/TaskController.php?action=update",
    {
      method: "POST",
      body: formData,
    }
  );

  const result = await res.json();

  if (result.success) {
    alert("Tarea actualizada correctamente");
    document.getElementById("editModal").style.display = "none";
    cargarTareas();
  }
});

//para cancelar el modal
document.getElementById("cancelEdit").addEventListener("click", () => {
  document.getElementById("editModal").style.display = "none";
});
