<?php
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
        <div class="row mb-5">
            <div class="col">
                <?php foreach ($books as $book) : ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $book['title'] ?> (<?php echo $book['year'] ?>)
                            </h5>
                            <p class="card-text">Автор: <?php echo $book['author'] ?></p>
                            <p class="card-text">Жанр: <?php echo $book['genre'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="GET">
                    <?php foreach ($books as $key => $book) : ?>
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
                    <?php endforeach; ?>
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