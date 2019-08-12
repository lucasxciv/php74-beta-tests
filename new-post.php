<?php

require_once __DIR__ . '/blog/init.php';

$requestMethodType  = $_SERVER['REQUEST_METHOD'];
$formInputsFromGet  = $_GET ?? [];
$formInputsFromPost = $_POST ?? [];

$formInputsFromGet['action'] ??= 'load';

if ($requestMethodType === 'POST' && $formInputsFromGet['action'] === 'publish') {
    $numberOfPosts = count(getPosts()) + 1;

    $post = new Post;
    $post->id = $numberOfPosts;
    $post->title = $formInputsFromPost['title'];
    $post->content = $formInputsFromPost['content'];
    $post->postedAt = new \DateTimeImmutable();
    $post->author = getAuthorById($formInputsFromPost['author_id']);

    storePost($post);

    $formMessage = sprintf('Blog post published! Now you have %s posts :)', $numberOfPosts);
}

$authors = getAuthors();
$posts = getPosts();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP 7.4 Test</title>

    <!-- Bootstrap -->
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.3/examples/blog/blog.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="index.php">Home</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#">PHP 7.4 Blog Test</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
            </div>
        </div>
    </header>
</div>

<br>
<div class="container container-fluid">
    <h2>Create New Post</h2>

    <form method="post" action="new-post.php?action=publish">
        <?php if (isset($formMessage)): ?>
        <div class="alert alert-success" role="alert">
            <?=$formMessage?>
        </div>
        <?php endif ?>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="8" required></textarea>
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <select name="author_id" id="author" class="form-control" required>
                <option value=""></option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?=$author->id?>"><?=$author->name?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Publish</button>
    </form>
</div>
</body>
</html>
