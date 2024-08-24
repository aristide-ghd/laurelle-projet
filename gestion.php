<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page de gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/gestion.css"> -->
    <style>
        .ajout{
            margin-top: 60px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        footer {
            margin-top: auto;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center text-secondary fs-1 mb-4">Visibilité sur vos finances</h1>
        <div class="table-responsive">
            <!-- <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Type</th>
                        <th class="tot">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ventes</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Dépenses</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Recettes</td>
                        <td></td>
                    </tr>
                </tbody>
            </table> -->

            <table class="table table-bordered table-striped">
                <thead class="text-white">
                    <tr>
                        <th>Type</th>
                        <th class="text-end fw-bold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-light rounded-3 shadow-sm">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-cash me-2 fs-4"></i> Ventes
                        </td>
                        <td class="text-end">-</td>
                    </tr>
                    <tr class="bg-light rounded-3 shadow-sm mt-3">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-wallet2 me-2 fs-4"></i> Dépenses
                        </td>
                        <td class="text-end">-</td>
                    </tr>
                    <tr class="bg-light rounded-3 shadow-sm mt-3">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-piggy-bank me-2 fs-4"></i> Recettes
                        </td>
                        <td class="text-end">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>
