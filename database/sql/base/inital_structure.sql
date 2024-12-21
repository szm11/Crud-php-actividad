

CREATE TABLE rutas_escolares (
    id SERIAL PRIMARY KEY,
    capacidad INT,
    estado VARCHAR(255),
    kilometraje DECIMAL(10, 2)
);

CREATE TABLE contratos (
    id SERIAL PRIMARY KEY,
    fecha_inicio DATE,
    fecha_fin DATE,
    modalidad VARCHAR(255),
    tarifa DECIMAL(10, 2),
    ruta_id INT,
    FOREIGN KEY (ruta_id) REFERENCES rutas_escolares(id)
);
