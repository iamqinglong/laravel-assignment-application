<?php

namespace App\Models\Post;

use DateTime;
use Carbon\Carbon;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title','slug','content','status','published_at'
    ];

    /**
     * The attributes that should be cast.
     * @var array
     */
    protected $casts = [
        'published_at'  => 'datetime',
    ];

    /**
     * The categories that belong to the post.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
