<?php
include_once("../shared/formulario.php");

class FormAgregarProducto extends formulario
{
    public function FormAgregarProductoShow($categorias, $listaPrivilegios, $subcategorias)
    {
        $title = "Agregar Producto";
        $this->getHead($title, $listaPrivilegios);
?>
        <div class="container">
            <h1>Agregar Producto</h1>
            <form method="post" action="./getProductos.php">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br><br>

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" required><br><br>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required><br><br>

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required><br><br>

                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="0" > Seleccione tu categoria</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?php echo $categoria['idcategoria']; ?>"><?php echo $categoria['namecategoria']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                
                <div id="subcategorias" style="display:none;">
                    <label for="subcategoria">Subcategoría:</label>
                    <select id="subcategoria" name="subcategoria" onchange="mostrarSubcategorias(this.value)">
                        <!-- Las opciones se llenarán dinámicamente con JavaScript -->
                    </select><br><br>
                </div>

                <script>
                    function mostrarSubcategorias(categoriaSeleccionada) {
                        var subcategoriasDiv = document.getElementById('subcategorias');
                        var subcategoriaSelect = document.getElementById('subcategoria');

                        // Limpia las opciones existentes
                        subcategoriaSelect.innerHTML = '';

                        // Si la categoría seleccionada no es 0, muestra el segundo conjunto de opciones
                        if (categoriaSeleccionada != 0) {
                            subcategoriasDiv.style.display = 'block';

                            // Llena el segundo conjunto de opciones con las subcategorías relacionadas a la categoría seleccionada
                            <?php foreach ($subcategorias as $subcategoria) : ?>
                                if (<?php echo $subcategoria['categoria_id']; ?> == categoriaSeleccionada) {
                                    var option = document.createElement('option');
                                    option.value = <?php echo $subcategoria['id']; ?>;
                                    option.text = '<?php echo $subcategoria['nombre']; ?>';
                                    subcategoriaSelect.add(option);
                                }
                            <?php endforeach; ?>
                        } else {
                            // Si la categoría es 0, oculta el segundo conjunto de opciones
                            subcategoriasDiv.style.display = 'none';
                        }
                    }
                </script>
                

                <input type="submit" name="btnAgregar" value="Agregar">
            </form>
        </div>
<?php
        $this->getFoot();
    }
}
?>
