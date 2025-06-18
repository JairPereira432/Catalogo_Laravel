// Instala dependencias: express, mysql2, cors, body-parser
const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const mysql = require('mysql2');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Configura tu conexión MySQL
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '123JP',
  database: 'catalogo_laravel'
});

// Obtener productos
app.get('/productos', (req, res) => {
  db.query('SELECT * FROM productos', (err, results) => {
    if (err) return res.status(500).json({ error: err });
    res.json(results);
  });
});

// Agregar producto
app.post('/productos', (req, res) => {
  const { nombre, precio, descripcion, imagen } = req.body;
  db.query('INSERT INTO productos (nombre, precio, descripcion, imagen) VALUES (?, ?, ?, ?)',
    [nombre, precio, descripcion, imagen],
    (err, result) => {
      if (err) return res.status(500).json({ error: err });
      res.json({ id: result.insertId });
    }
  );
});

// Modificar producto
app.put('/productos/:id', (req, res) => {
  const { nombre, precio, descripcion, imagen } = req.body;
  db.query('UPDATE productos SET nombre=?, precio=?, descripcion=?, imagen=? WHERE id=?',
    [nombre, precio, descripcion, imagen, req.params.id],
    (err) => {
      if (err) return res.status(500).json({ error: err });
      res.json({ ok: true });
    }
  );
});

// Eliminar producto
app.delete('/productos/:id', (req, res) => {
  db.query('DELETE FROM productos WHERE id=?', [req.params.id], (err) => {
    if (err) return res.status(500).json({ error: err });
    res.json({ ok: true });
  });
});

app.listen(3000, () => console.log('API corriendo en http://localhost:3000'));