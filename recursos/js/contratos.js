console.log("Hola mundo desde js para contratos")

// Agregar funcionalidad para insertar un contrato y actualizar la tabla
document.getElementById('ContratosForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    console.log([...formData]); // Muestra los datos que se están enviando
    fetch('/api/contratos', {
        method: 'POST',
        body: formData
    })
    .then(response => loadContratos())
});

function loadContratos() {
    fetch('/api/contratos')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('ContratosTable').querySelector('tbody');
        tableBody.innerHTML = ''; // Limpiar tabla
        data.forEach(contract => {
            const row = `<tr>
                <td>${contract.id}</td>
                <td>${contract.fecha_inicio}</td>
                <td>${contract.fecha_fin}</td>
                <td>${contract.modalidad}</td>
                <td>${contract.tarifa}</td>
                <td>${contract.ruta_id}</td>
                <td>
                    <button onclick="editContract(${contract.id}, '${contract.fecha_inicio}', '${contract.fecha_fin}', '${contract.modalidad}', '${contract.tarifa}', '${contract.ruta_id}')">Editar</button>
                    <button onclick="deleteContract(${contract.id})">Eliminar</button>
                </td>
            </tr>`;
            tableBody.innerHTML += row; // Agregar fila a la tabla
        });
    });
}

// Nueva función para eliminar un contrato
function deleteContract(id) {
    fetch(`/api/contratos/${id}`, {
        method: 'DELETE'
    })
    .then(response => loadContratos())
}

// Nueva función para editar un contrato
function editContract(id, fecha_inicio, fecha_fin, modalidad, tarifa, ruta_id) {
    document.querySelector('input[name="fecha_inicio"]').value = fecha_inicio;
    document.querySelector('input[name="fecha_fin"]').value = fecha_fin;
    document.querySelector('input[name="modalidad"]').value = modalidad;
    document.querySelector('input[name="tarifa"]').value = tarifa;
    document.querySelector('input[name="ruta_id"]').value = ruta_id;

    // Mostrar el botón de actualizar y ocultar el de insertar
    document.getElementById('insertButtonContratos').style.display = 'none';
    document.getElementById('updateButtonContratos').style.display = 'inline-block';

    // Cambiar el evento del botón de actualizar
    const updateButton = document.getElementById('updateButtonContratos');
    updateButton.onclick = function() {
        const formData = new FormData(document.getElementById('ContratosForm'));
        console.log([...formData]); // Muestra los datos que se están enviando
        fetch(`/api/contratos/${id}`, {
            method: 'POST',
            body: formData
        })
        .then(response => loadContratos())
    };
}

// Función para limpiar el formulario
function clearFormContratos() {
    document.getElementById('ContratosForm').reset();
    document.getElementById('insertButtonContratos').style.display = 'inline-block'; // Mostrar botón de insertar
    document.getElementById('updateButtonContratos').style.display = 'none'; // Ocultar botón de actualizar

    loadContratos();
}

// Agregar evento para el buscador
document.getElementById('searchInputContratos').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const tableBody = document.getElementById('ContratosTable').querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        row.style.display = rowText.includes(searchTerm) ? '' : 'none'; // Mostrar u ocultar fila
    });
});

// Cargar contratos al inicio
loadContratos();