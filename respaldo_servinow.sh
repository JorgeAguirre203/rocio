#!/bin/bash

# Variables
FECHA=$(date +"%Y-%m-%d_%H-%M")
ARCHIVO_SQL="respaldo_servinow_jorge_${FECHA}.sql"
DESTINO="/var/www/html/rocio/rocio/$ARCHIVO_SQL"

# Crear respaldo
mysqldump -u root -p1234 servinow_jorge > "$DESTINO"

# Verificar si se creó correctamente
if [ $? -eq 0 ]; then
  echo "✅ Respaldo creado exitosamente: $DESTINO"
else
  echo "❌ Error al crear el respaldo"
fi
