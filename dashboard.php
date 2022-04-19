<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "db/Database.php";
require "db/User.php";
$user = new User();

if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">OAUTH 2.0 PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">Tokens</a>
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#secretsModal">Secrets</a>
                    </div>
                </div>
            </div>
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Token</th>
                    <th scope="col">Expiry</th>
                    <th scope="col">Scope</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                foreach ($user->GetTokens() as $row) {
                    $count++;
                ?>
                    <tr>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><?php echo $row['access_token'] ?></td>
                        <td><?php echo $row['expires'] ?></td>
                        <td><?php echo $row['scope'] ?></td>
                    </tr>
                <?php
                }
                if ($count == 0) {
                ?>
                <tr>
                    <th colspan="4">No records</th>
                </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>

    <div class="modal" id="secretsModal" tabindex="-1" aria-labelledby="secretsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">API secrets</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $data = $user->GetSecrets();
                    foreach ($data as $row) {
                    ?>
                        <p>Client ID: <?php echo $row['client_id'] ?></p>
                        <p>Client Secret: <?php echo $row['client_secret'] ?></p>
                    <?php }  ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>