<!DOCTYPE html>
<html lang="en">

<head>
    <title>Table Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Table Example</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Major</th>
                    <th>Year</th>
                    <th class="w-25 text-center">Update</th>
                    <th class="w-25 text-center">Delete</th>
                </tr>
            </thead>
            <?php foreach ($this->friends as $friend) : ?>
                <tbody>
                    <tr>
                        <td><?= $friend["Name"] ?></td>
                        <td><?= $friend["Major"] ?></td>
                        <td><?= $friend["Year"] ?></td>
                        <?php $id = $friend["Name"] . "|" . $friend["Major"] . "|" . $friend["Year"] ?>
                        <form action="?command=update" method="post">
                            <td class="w-25 text-center">
                                <input type="hidden" name="update_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </td>
                        </form>
                        <form action="?command=delete" method="post">
                            <td class="w-25 text-center">
                                <input type="hidden" name="delete_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </td>
                        </form>
                    </tr>
                    <!-- Add more rows here -->
                </tbody>
            <?php endforeach; ?>
        </table>
        <form action="?command=add" method="post">
            <button type="submit" class="btn btn-dark">Add</button>
        </form>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNS4Qzo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>