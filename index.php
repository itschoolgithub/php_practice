<?php
    function getBooks($books) {
        foreach ($books as $key => $book) : ?>
            <input type="hidden"
                name="books[<?php echo $key ?>][title]"
                value="<?php echo $book['title'] ?>">
            <input type="hidden"
                name="books[<?php echo $key ?>][author]"
                value="<?php echo $book['author'] ?>">
            <input type="hidden"
                name="books[<?php echo $key ?>][year]"
                value="<?php echo $book['year'] ?>">
            <input type="hidden"
                name="books[<?php echo $key ?>][genre]"
                value="<?php echo $book['genre'] ?>">
        <?php endforeach;
    }

    if (isset($_GET['books'])) {
        $books = $_GET['books'];
    } else {
        $books = [
            [
                'title'  => 'Преступление и наказание',
                'author' => 'Фёдор Достоевский',
                'year'   => 1866,
                'genre'  => 'Роман'
            ],
            [
                'title'  => 'Война и мир',
                'author' => 'Лев Толстой',
                'year'   => 1869,
                'genre'  => 'Роман'
            ],
            [
                'title'  => 'Мастер и Маргарита',
                'author' => 'Михаил Булгаков',
                'year'   => 1967,
                'genre'  => 'Роман, Фантастика'
            ]
        ];
    }

    if (
        isset($_GET['title']) &&
        isset($_GET['author']) &&
        isset($_GET['year']) &&
        isset($_GET['genre'])
    ) {
        $books[] = [
            'title'  => $_GET['title'],
            'author' => $_GET['author'],
            'year'   => $_GET['year'],
            'genre'  => $_GET['genre']
        ];
    }

    if (isset($_GET['delete'])) {
        unset($books[$_GET['delete']]);
        $books = array_values($books);
    }

    if (isset($_GET['order'])) {
        $order = $_GET['order'];
        usort($books, function ($book1, $book2) use ($order) {
            if ($order == "DESC") {
                return $book2['year'] - $book1['year'];
            } else {
                return $book1['year'] - $book2['year'];
            }

            // if ($book1['year'] > $book2['year']) {
            //     return 1;
            // } elseif ($book1['year'] == $book2['year']) {
            //     return 0;
            // } else {
            //     return -1;
            // }
        });
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container py-4">
        <div class="row mb-3">
            <div class="col">
                <form action="" method="GET">
                    <?php getBooks($books); ?>
                    <select class="form-select mb-1" name="order">
                        <option selected value="ASC">По возрастанию</option>
                        <option value="DESC">По убыванию</option>
                    </select>
                    <button class="btn btn-success">Сортировать</button>
                </form>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <?php foreach ($books as $key => $book) : ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $book['title'] ?> (<?php echo $book['year'] ?>)
                            </h5>
                            <p class="card-text">Автор: <?php echo $book['author'] ?></p>
                            <p class="card-text">Жанр: <?php echo $book['genre'] ?></p>
                            <form action="" method="GET">
                                <?php getBooks($books) ?>
                                <input type="hidden" name="delete" value="<?php echo $key ?>">
                                <button class="btn btn-outline-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="GET">
                    <?php getBooks($books) ?>
                    <div class="mb-3">
                        <label for="title" class="form-label">Название книги</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Название книги">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Автор книги</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="Автор книги">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Год издания книги</label>
                        <input type="number" class="form-control" id="year" name="year" placeholder="Год издания книги">
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label">Жанр книги</label>
                        <input type="text" class="form-control" id="genre" name="genre" placeholder="Жанр книги">
                    </div>
                    <button class="btn btn-primary">Добавить книгу</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>