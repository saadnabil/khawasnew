<?php
namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
     * Handle the imported collection.
     * 
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Assuming each row is an array containing user data
            $name = $row[1];
            $email = $row[1];
            $phone = $row[2];
            $usercode = $row[3];

            // Find existing user with the same name and slug
            $user = User::where('name', $name)
                        ->where('email', $email)
                        ->where('phone',$phone)
                        ->where('usercode',$usercode)
                        ->first();

            if ($user) {
                // Update existing user
                $user->update([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'usercode' => $usercode,
                ]);
            } else {
                // Create a new user
                User::create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'usercode' => $usercode,
                ]);
            }
        }
    }
}
