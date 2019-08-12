<?php

class Post
{
    public int $id;
    public string $title;
    public string $content;
    public DateTimeImmutable $postedAt;
    public Author $author;
}
