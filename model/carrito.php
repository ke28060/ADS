<?php
include_once("conexion.php");
class Carrito extends Conexion
{
    public function obtenerDetallesCarrito($idProducto)
    {
        $this->conectarBD();

        $idProducto = $this->conexion->real_escape_string($idProducto);

        $sql = "SELECT * FROM carrito WHERE idProducto = '$idProducto'";
        $resultado = $this->conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $CarritoDatos= $resultado->fetch_assoc();
            $this->desConectarBD();
            return $CarritoDatos; // Retorna los detalles del producto como un array asociativo
        } else {
            $this->desConectarBD();
            return null; // Retorna nulo si no se encuentra el producto
        }
    }

    public function agregarProductoAlCarrito($idProducto)
{
    $this->conectarBD();

    $idProducto = $this->conexion->real_escape_string($idProducto);

    // Verificar si el producto ya está en el carrito
    $sqlCarrito = "SELECT * FROM carrito WHERE idProducto = '$idProducto'";
    $resultadoCarrito = $this->conexion->query($sqlCarrito);

    // Verificar la disponibilidad del producto en la tabla productos
    $sqlProductos = "SELECT cantidad FROM productos WHERE idproductos = '$idProducto'";
    $resultadoProductos = $this->conexion->query($sqlProductos);
    $filaProductos = $resultadoProductos->fetch_assoc();
    $cantidadDisponible = $filaProductos['cantidad'];

    if ($cantidadDisponible > 0) { // Si la cantidad disponible es mayor que cero
        if ($resultadoCarrito && $resultadoCarrito->num_rows > 0) {
            // El producto ya está en el carrito, aumentar la cantidad
            $sqlUpdate = "UPDATE carrito SET cantidadCarrito = cantidadCarrito + 1 WHERE idProducto = '$idProducto'";
            $resultadoUpdate = $this->conexion->query($sqlUpdate);

            if ($resultadoUpdate) {
                $this->desConectarBD();
                return true; // Producto actualizado en el carrito
            } else {
                $this->desConectarBD();
                return false; // Error al actualizar el producto en el carrito
            }
        } else {
            // El producto no está en el carrito, insertar nuevo producto
            $sqlInsert = "INSERT INTO carrito (idProducto, cantidadCarrito) VALUES ('$idProducto', 1)";
            $resultadoInsert = $this->conexion->query($sqlInsert);

            if ($resultadoInsert) {
                $this->desConectarBD();
                return true; // Producto insertado en el carrito
            } else {
                $this->desConectarBD();
                return false; // Error al insertar el producto en el carrito
            }
        }
    } else {
        $this->desConectarBD();
        return "El producto no tiene cantidad disponible para agregar al carrito.";
    }
}


    public function listarProductosEnCarrito()
    {
        $this->conectarBD();

        $sql = "SELECT c.*, p.nameproductos, p.precio 
        FROM carrito c 
        JOIN productos p ON p.idproductos = c.idProducto";
        $resultado = $this->conexion->query($sql);

        $productosEnCarrito = array();

        if ($resultado && $resultado->num_rows > 0) {
            // Recorre los resultados y los agrega a un array
            while ($fila = $resultado->fetch_assoc()) {
                $productosEnCarrito[] = $fila;
            }
        }

        $this->desConectarBD();

        return $productosEnCarrito;
    }

    public function eliminarProductoDelCarrito($idProducto)
    {
        $this->conectarBD();

        $idProducto = $this->conexion->real_escape_string($idProducto);

        // Eliminar el producto del carrito basado en el idProducto
        $sqlDelete = "DELETE FROM carrito WHERE idProducto = '$idProducto'";
        
        // Ejecutar la consulta
        $resultado = $this->conexion->query($sqlDelete);

        $this->desConectarBD();

        if ($resultado) {
            return true; // El producto se eliminó correctamente del carrito
        } else {
            return false; // Error al eliminar el producto del carrito
        }
    }

    public function devolverCantidadProductoATablaProductos()
    {
        $this->conectarBD();

        $sqlCantidadProductos = "SELECT idProducto, SUM(cantidadCarrito) AS cantidadTotal FROM carrito GROUP BY idProducto";
        $resultadoCantidadProductos = $this->conexion->query($sqlCantidadProductos);

        while ($filaCantidadProducto = $resultadoCantidadProductos->fetch_assoc()) {
            $idProducto = $filaCantidadProducto['idProducto'];
            $cantidadTotal = $filaCantidadProducto['cantidadTotal'];

            $sqlUpdate = "UPDATE productos SET cantidad = cantidad + $cantidadTotal WHERE idproductos = '$idProducto'";
            $resultadoUpdate = $this->conexion->query($sqlUpdate);

            if (!$resultadoUpdate) {
                $this->desConectarBD();
                return false; 
            }
        }
        $sqlDelete = "DELETE FROM carrito";
        $resultadoDelete = $this->conexion->query($sqlDelete);

        $this->desConectarBD();

        if ($resultadoDelete) {
            return true; 
        } else {
            return false; 
        }
    }

    public function copiarDatosACarrito() 
    {
        $this->conectarBD();
    
        // Generar un número único de 6 dígitos
        $codigoUnico = $this->generarNumeroUnico();
    
        // Copiar los datos de la tabla carrito a la tabla proforma con el código único generado
        $sqlInsert = "INSERT INTO proforma (proforma_id, producto_id, codigo, cantidad)
            SELECT NULL, idProducto, '$codigoUnico', cantidadCarrito
            FROM carrito";
    
        $resultadoInsert = $this->conexion->query($sqlInsert);
    
        if ($resultadoInsert) {
            // Eliminar todos los registros de la tabla carrito
            $sqlDelete = "DELETE FROM carrito";
            $resultadoDelete = $this->conexion->query($sqlDelete);
    
            $this->desConectarBD();
    
            if ($resultadoDelete) {
                return true; // Los datos se copiaron a proforma y se eliminaron de carrito correctamente
            } else {
                return false; // Error al eliminar los datos de carrito después de la copia
            }
        } else {
            $this->desConectarBD();
            return false; // Error al copiar los datos a proforma
        }
    }
    
    private function generarNumeroUnico() {
        $numero = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT); 
    
        $sql = "SELECT COUNT(*) as total FROM proforma WHERE codigo = '$numero'";
        $resultado = $this->conexion->query($sql);
    
        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $total = $fila['total'];
    
            if ($total > 0) {
                return $this->generarNumeroUnico();
            } else {
                return $numero;
            }
        } else {
            return $this->generarNumeroUnico();
        }
    }

    public function aumentarCantidadProductoEnCarrito($idProducto)
    {
        $this->conectarBD();

        $idProducto = $this->conexion->real_escape_string($idProducto);

        // Obtener la cantidad del carrito para el producto específico
        $sqlCantidadCarrito = "SELECT SUM(cantidadCarrito) AS cantidadTotal FROM carrito WHERE idProducto = '$idProducto'";
        $resultadoCantidadCarrito = $this->conexion->query($sqlCantidadCarrito);
        $filaCantidadCarrito = $resultadoCantidadCarrito->fetch_assoc();
        $cantidadCarrito = $filaCantidadCarrito['cantidadTotal'];

        // Actualizar la cantidad del producto en la tabla productos
        $sqlUpdate = "UPDATE productos SET cantidad = cantidad + $cantidadCarrito WHERE idproductos = '$idProducto'";
        
        // Ejecutar la consulta
        $resultado = $this->conexion->query($sqlUpdate);

        $this->desConectarBD();

        if ($resultado) {
            return true; // La cantidad se aumentó correctamente
        } else {
            return false; // Error al aumentar la cantidad
        }
    }
    

}
?>
