<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'author'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    private $name;

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    private $author;
}
