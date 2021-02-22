
    <form action="" method="post">
        <label for="email">Direccion: </label><input id="email" type="email" name="email"><br>
        <label for="nombre">Nombre: </label><input id="nombre" type="text" name="nombre"><br>
        <label for="comentario">Cometario: </label><br>
        <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea><br></br>
        <label for="operacion"><?php echo $operaciones[$numero-1].": "?></label><input type="number" name="operacion" id="operacion"><br>
        <input type="hidden" name="numero" value=<?php echo ($numero-1) ?>>
        <input type="submit" id="validar" name="validar" value="Enviar">
    </form>