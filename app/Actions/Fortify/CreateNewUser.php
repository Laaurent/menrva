<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'required'  => 'Ce champ est obligatoire.',
            'unique'    => 'L\'email est déjà utilisé.',
            'min'     => 'Le mot de passe doit au moins contenir 8 caractères',
            'confirmed'     => 'Le mot de passe ne correspond pas'
        ])->validate();

        $user = User::insertGetId([
            'user_type_id' => $input['user_type_id'],
            'name' => $input['name'],
            'first_name' => $input['first_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        if ($user) {
            Storage::disk('public')->copy('/avatars/avatar.png', "/avatars/$user/avatar.png");
            Storage::disk('public')->copy('/avatars/background.png', "/avatars/$user/background.png");
        }

        return User::find($user);
    }
}
