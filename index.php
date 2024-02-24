<?php
include 'api.php';

// Clave de API de NewsAPI
$apiKey = 'bf8e900a909740649d5c5eee12dfabe3';

// Obtener las fuentes de las noticias principales
$sources = getTopHeadlinesSources($apiKey);

// Número de fuentes por página
$fuentes_por_pagina = 10;

// Número total de fuentes
$total_fuentes = count($sources['sources']);

// Página actual
$pagina_actual = isset($_GET['page']) ? $_GET['page'] : 1;

// Índice inicial de la fuente para la página actual
$indice_inicio = ($pagina_actual - 1) * $fuentes_por_pagina;

// Fuentes para la página actual
$fuentes_pagina = array_slice($sources['sources'], $indice_inicio, $fuentes_por_pagina);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News source</title>
    <link href="styles/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
    <h1 class="title">News Sources</h1>
        <p class="subtitle">Discover a variety of reliable and up-to-date news sources from around the world</p>
        <?php if (!empty($fuentes_pagina)): ?>
            <ul class="list-group">
                <?php foreach ($fuentes_pagina as $source): ?>
                    <li class="list-group-item">
                        <h5 class="mb-1"><?php echo $source['name']; ?></h5>
                        <p class="mb-1"><?php echo $source['description']; ?></p>
                        <a href="<?php echo $source['url']; ?>" class="btn btn-link btn-sm">see more...</a>
                        <br>
                        <?php
                        $autor = getRandomUser();
                        ?>
                        <small class="text-muted">Category: <?php echo $source['category']; ?> | Languaje: <?php echo $source['language']; ?>  | Author: <?php echo ucfirst($autor['name']['first']) . ' ' . ucfirst($autor['name']['last']); ?></small>
                        
                        
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                   
                    <li class="page-item <?php echo ($pagina_actual == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($pagina_actual - 1); ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item <?php echo ($pagina_actual == 1) ? 'active' : ''; ?>"><a class="page-link" href="?page=1">1</a></li>
                    <?php
                    $total_paginas = ceil($total_fuentes / $fuentes_por_pagina);
                    $inicio = max(2, $pagina_actual - 2);
                    $fin = min($total_paginas - 1, $pagina_actual + 2);
                    for ($i = $inicio; $i <= $fin; $i++) {
                        echo '<li class="page-item ' . ($pagina_actual == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                    <li class="page-item <?php echo ($pagina_actual == $total_paginas) ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $total_paginas; ?>"><?php echo $total_paginas; ?></a></li>
                    <li class="page-item <?php echo ($pagina_actual == $total_paginas) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($pagina_actual + 1); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php else: ?>
            <div class="alert alert-warning mt-4" role="alert">
                No hay fuentes de noticias disponibles.
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
