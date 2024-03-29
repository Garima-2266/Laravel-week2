<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class form extends Model
{
    protected $fillable=[
        'name',
        'email',
        'password',
        'description',
        'image',
    ];

public function getImage()
{
    if (str_starts_with($this->image, 'http')) {
        return $this->image;
    }
    return '/storage/' . $this->image;

}
public function updatePhoto($image)
{
    // Delete the old photo if it exists
    if ($this->image) {
        Storage::disk('public')->delete($this->image);
    }

    // Generate a random name for the new photo
    $randomName = Str::uuid()->toString();

    // Store the new photo with the generated name
    $path = $image->storeAs('forms', $randomName . '.' . $image->extension(), 'public');

    // Update the user's profile photo path in the database
    $this->update(['image' => $path]);
}
}
