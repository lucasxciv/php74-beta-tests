<?php

function serializePost(Post $post) : array {
    return [
        'id' => $post->id,
        'title' => $post->title,
        'content' => $post->content,
        'posted_at' => $post->postedAt->format('Y-m-d H:i:s'),
        'author' => [
            'id' => $post->author->id,
            'name' => $post->author->name,
            'profile' => $post->author->profile,
        ],
    ];
}

function appendPosts(Post $post, callable $getPosts, callable $storePosts) : void {
    $storePosts([serializePost($post), ...$getPosts()]);
}

function storePost(Post $post) : void {
    $getPostsFromFile = fn() => getPosts();
    $storePostsIntoFile = fn($posts) => file_put_contents(FILE_POSTS_STORAGE, (string)json_encode($posts));

    appendPosts($post, $getPostsFromFile, $storePostsIntoFile);
}
