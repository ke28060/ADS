<?php
include_once('conexion.php');

class Producto extends Conexion
{
    public function listarProductos()
    {
        $this->conectarBD();

        $productos = array();

        $sql = "SELECT * FROM productos";

        $resultado = $this->conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $fila['imagen_base64'] = $this->convertirImagenABase64($fila['imagen']);
                $productos[] = $fila;
            }

            $this->desConectarBD();
            return $productos;
        } else {
            $this->desConectarBD();
            return array(); // Retorna un array vacío si no hay productos
        }
    }

    // Función para convertir una imagen binaria a base64
    private function convertirImagenABase64($imagenBinaria)
{
    if (!empty($imagenBinaria)) {
        $base64 = @base64_encode($imagenBinaria);
        if ($base64 === false) {
            // Manejo de error si base64_encode falla
            return null;
        }
        return 'data:image/jpeg;base64,' . $base64;
    } else {
        return null;
    }
}

    public function InsertarProducto($nombre, $imagen, $cantidad, $precio, $idCategoria)
    {
        $this->conectarBD();

        $nombre = $this->conexion->real_escape_string($nombre);
        $imagen = $this->conexion->real_escape_string($imagen);
        $cantidad = (int)$cantidad;
        $precio = (float)$precio;
        $idCategoria = (int)$idCategoria;

        $sql = "INSERT INTO productos (nameproductos, imagen, cantidad, precio, idcategoria) VALUES ('$nombre', '$imagen', $cantidad, $precio, $idCategoria)";

        if ($this->conexion->query($sql) === TRUE) {
            $this->desConectarBD();
            return true; // Inserción exitosa
        } else {
            $this->desConectarBD();
            return false; // Error en la inserción
        }
    }

        public function ModificarProducto($idProducto, $nuevaCantidad, $nuevoPrecio)
    {
        $this->conectarBD();

        $idProducto = (int)$idProducto;
        $nuevaCantidad = (int)$nuevaCantidad;
        $nuevoPrecio = (float)$nuevoPrecio;

        $sql = "UPDATE productos SET cantidad = $nuevaCantidad, precio = $nuevoPrecio WHERE idproductos = $idProducto";

        if ($this->conexion->query($sql) === TRUE) {
            $this->desConectarBD();
            return true; 
        } else {
            $this->desConectarBD();
            return false; 
        }
    }

    
    public function obtenerDetallesProducto($idProducto)
    {
        $this->conectarBD();

        $idProducto = $this->conexion->real_escape_string($idProducto);

        $sql = "SELECT * FROM productos WHERE idproductos = '$idProducto'";
        $resultado = $this->conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();
            $producto['imagen_base64'] = $this->convertirImagenABase64($producto['imagen']);
            $this->desConectarBD();
            return $producto; // Retorna los detalles del producto como un array asociativo
        } else {
            $this->desConectarBD();
            return null; // Retorna nulo si no se encuentra el producto
        }
    }

    public function EliminarProducto($idProducto)
    {
        $this->conectarBD();

        $idProducto = (int)$idProducto;

        $sql = "DELETE FROM productos WHERE idproductos = $idProducto";

        if ($this->conexion->query($sql) === TRUE) {
            $this->desConectarBD();
            return true; // Eliminación exitosa
        } else {
            $this->desConectarBD();
            return false; // Error en la eliminación
        }
    }

    public function buscarYActualizarDatos($terminoBusqueda) {
        $this->conectarBD();

        $terminoBusqueda = $this->conexion->real_escape_string($terminoBusqueda);

        $sql = "SELECT * FROM Productos WHERE nameproductos LIKE '%$terminoBusqueda%'";

        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            
            $productosEncontrados = array();
    
            while ($fila = $resultado->fetch_assoc()) {
                $productosEncontrados[] = $fila;
            }
            $this->conexion->close();
            return $productosEncontrados;
        } else {
            $this->conexion->close();
            return array();
        }

        
        
    }

    public function buscarProductosdeCarrito($productosCarrito) {
        $this->conectarBD();
    
        $productosEncontrados = [];
    
        foreach ($productosCarrito as $producto) {
            $idProducto = $producto['id'];
    
            $sql = "SELECT * FROM Productos WHERE idproductos = $idProducto";
    
            $resultado = $this->conexion->query($sql);
    
            if ($resultado->num_rows > 0) {
                $productoEncontrado = $resultado->fetch_assoc();
                $productosEncontrados[] = $productoEncontrado;
            }
        }
    
        $this->conexion->close();
    
        return $productosEncontrados;
    }
    
    public function obtenerCantidadProductosEnCarrito($idProducto)
    {
        $this->conectarBD();

        $idProducto = $this->conexion->real_escape_string($idProducto);

        $sql = "SELECT cantidad FROM productos WHERE idproductos = '$idProducto'";
        $resultado = $this->conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $cantidad = $fila['cantidad'];
            $this->desConectarBD();
            return $cantidad; // Retorna la cantidad del producto en el carrito
        } else {
            $this->desConectarBD();
            return 0; // Retorna 0 si no se encuentra el producto en el carrito
        }
    }

    public function reducirCantidadProducto($idProducto)
    {
        $this->conectarBD();

        $idProducto = $this->conexion->real_escape_string($idProducto);

        // Obtener la cantidad actual del producto
        $sqlCantidadActual = "SELECT cantidad FROM productos WHERE idproductos = '$idProducto'";
        $resultadoCantidad = $this->conexion->query($sqlCantidadActual);
        $filaCantidad = $resultadoCantidad->fetch_assoc();
        $cantidadActual = $filaCantidad['cantidad'];

        if ($cantidadActual > 0) {
            // La cantidad es mayor que cero, se puede reducir
            $sql = "UPDATE productos SET cantidad = cantidad - 1 WHERE idproductos = '$idProducto'";
            
            // Ejecutar la consulta
            $resultado = $this->conexion->query($sql);

            $this->desConectarBD();

            if ($resultado) {
                return true; // La cantidad se redujo correctamente
            } else {
                return false; // Error al reducir la cantidad
            }
        } else {
            $this->desConectarBD();
            return "No se puede reducir la cantidad, ya que es igual a cero.";
        }
    }




}
?>