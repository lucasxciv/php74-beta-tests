<?php

function newPostFromArray(array $postData) {
    $post = new Post;
    $post->id = $postData['id'];
    $post->title = $postData['title'];
    $post->content = $postData['content'];
    $post->postedAt = new \DateTimeImmutable($postData['posted_at']);
    $post->author = newAuthorFromArray($postData['author']);

    return $post;
}

function retrievePosts(callable $retrievePostsFromStorage) : array {
    return array_map(fn($post) => newPostFromArray($post), $retrievePostsFromStorage()); // Arrow Function
}

function getPosts() : array {
    return retrievePosts(fn() : array => json_decode(file_get_contents(FILE_POSTS_STORAGE), true));
}
