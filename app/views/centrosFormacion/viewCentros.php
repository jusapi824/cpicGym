<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros Formacion</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <h1>CPICGym - software gestion gimnasio CPIC</h1>
    </header>
    <div class="container">
        <div class="data-container">
            <?php
                if (empty($centros)) {
                    echo "<br>No se encuentran Centros de Formación en la base de datos";
                } else {
                    foreach ($centros as $key => $value) {
                        echo "<div class='record'>
                            <span>ID: $value->id - $value->nombre</span>
                            <div class='buttons'>
                                <button>Consultar</button>
                                <button>Editar</button>
                                <button>Eliminar</button>
                            </div>
                        </div>";
                    }
                }
            ?>
        </div>
    </div>
    <footer>
        <p>Desarrollado por ADSO 2873711</p>
    </footer>
</body>
</html>