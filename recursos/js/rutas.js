console.log("Hola mundo desde js")

// Agregar funcionalidad para insertar un ruta y actualizar la tabla
document.getElementById('RutasForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    console.log([...formData]); // Muestra los datos que se están enviando
    fetch('/api/rutas', {
        method: 'POST',
        body: formData
    })
    .then(response =>   loadRutas())
  
});
    
function loadRutas() {
    fetch('/api/rutas   ')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('RutasTable').querySelector('tbody');
        tableBody.innerHTML = ''; // Limpiar tabla
        data.forEach(project => {
            const row = `<tr>
                <td>${project.id}</td>
                <td>${project.capacidad}</td>
                <td>${project.estado}</td>
                <td>${project.kilometraje}</td>
                <td>
                    <button onclick="editRoute(${project.id}, '${project.capacidad}', '${project.estado}', '${project.kilometraje}')">Editar</button>
                    <button onclick="deleteRoute(${project.id})">Eliminar</button>
                </td>
            </tr>`;
            tableBody.innerHTML += row; // Agregar fila a la tabla
        });
    });
}

// Nueva función para eliminar un ruta
function deleteRoute(id) {
    fetch(`/api/rutas/${id}`, {
        method: 'DELETE'
    })
    .then(response =>   loadRutas())
  
}

// Nueva función para editar un ruta
function editRoute(id, capacidad, estado, kilometraje) {
    document.querySelector('input[name="capacidad"]').value = capacidad;
    document.querySelector('input[name="estado"]').value = estado;
    document.querySelector('input[name="kilometraje"]').value = kilometraje;

    // Mostrar el botón de actualizar y ocultar el de insertar
    document.getElementById('insertButtonRutas').style.display = 'none';
    document.getElementById('updateButtonRutas').style.display = 'inline-block';

    // Cambiar el evento del botón de actualizar
    const updateButton = document.getElementById('updateButtonRutas');
    updateButton.onclick = function() {
        const formData = new FormData(document.getElementById('RutasForm'));
        console.log([...formData]); // Muestra los datos que se están enviando
        fetch(`/api/rutas/${id}`, {
            method: 'POST',
            body: formData
        })
        .then(response =>   loadRutas())
      
    };
}

// Función para limpiar el formulario
function clearFormRutas() {
    document.getElementById('RutasForm').reset();
    document.getElementById('insertButtonRutas').style.display = 'inline-block'; // Mostrar botón de insertar
    document.getElementById('updateButtonRutas').style.display = 'none'; // Ocultar botón de actualizar

    loadRutas();
}

// Agregar evento para el buscador
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const tableBody = document.getElementById('RutasTable').querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        row.style.display = rowText.includes(searchTerm) ? '' : 'none'; // Mostrar u ocultar fila
    });
});

// Cargar rutas al inicio
loadRutas();