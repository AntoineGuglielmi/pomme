<?php
class Post
{
    public function get_created_at($format = 'd/m/Y')
    {
        $date = new DateTime();
        $date->setTimestamp($this->created_at);
        return $date->format($format);
    }
}