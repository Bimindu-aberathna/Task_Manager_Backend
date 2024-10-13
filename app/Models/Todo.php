<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'task',
        'description',
        'status',
        'date',
        'user_id'  // Add this
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

// {
//     "task": "Wednesday meeting11",
//     "description": "Weekly team sync-up and project planning",
//     "status": "pending",
//     "date": "2023-10-16",
//     "user_id":1
//   }