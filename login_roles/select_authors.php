<form method="POST" >
    <label for="author">Seleccionar autor:</label>
    <select name="author_id" id="author" required>
        <option value="" disabled selected>Seleccione un autor</option>
        <?php
        // Consulta para obtener todos los autores
        $stmt = $pdo->prepare("SELECT author_id, author_name FROM book_authors");
        $stmt->execute();
        $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Recorrer y generar las opciones del select
        foreach ($authors as $author) {
            echo "<option value='" . $author['author_id'] . "'>" . htmlspecialchars($author['author_name']) . "</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" value="Enviar" class="btn btn-primary">
</form>
