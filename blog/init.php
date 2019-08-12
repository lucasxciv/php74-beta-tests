<?php

define('FILE_POSTS_STORAGE', __DIR__ . '/../data/posts.json');
define('FILE_AUTHORS_STORAGE', __DIR__ . '/../data/authors.json');

// Post
require_once __DIR__ . '/post/Post.php';
require_once __DIR__ . '/post/publish.php';
require_once __DIR__ . '/post/retrieve.php';

// Author
require_once __DIR__ . '/author/Author.php';
require_once __DIR__ . '/author/retrieve.php';
