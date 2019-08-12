<?php

function array_find(array $items, callable $callback) {
    foreach ($items as $item) {
        if ($callback($item)) {
            return $item;
        }
    }
    return false;
}

function newAuthorFromArray(array $authorData) {
    $author = new Author;
    $author->id = $authorData['id'];
    $author->name = $authorData['name'];
    $author->profile = $authorData['profile'];

    return $author;
}

function retrieveAuthors(callable $retrieveAuthorsFromStorage) : array {
    return array_map(fn($author) => newAuthorFromArray($author), $retrieveAuthorsFromStorage()); // Arrow Function
}

function getAuthors() : array {
    return retrieveAuthors(fn() : array => json_decode(file_get_contents(FILE_AUTHORS_STORAGE), true));
}

function getAuthorById(int $authorId) : Author {
    return array_find(getAuthors(), fn(Author $author) => $author->id === $authorId);
}
