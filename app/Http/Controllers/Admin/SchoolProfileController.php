<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    /**
     * Show the school profile edit form.
     */
    public function edit()
    {
        $profile = SchoolProfile::getProfile();

        // If no profile exists yet, create a default one
        if (!$profile) {
            $profile = new SchoolProfile();
        }

        return view('admin.school-profile.edit', compact('profile'));
    }

    /**
     * Update the school profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name'       => 'required|string|max:255',
            'address'           => 'required|string|max:500',
            'district'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'province'          => 'nullable|string|max:255',
            'postal_code'       => 'nullable|string|max:10',
            'phone'             => 'required|string|max:20',
            'whatsapp'          => 'nullable|string|max:20',
            'email'             => 'required|email|max:255',
            'latitude'          => 'required|numeric|between:-90,90',
            'longitude'         => 'required|numeric|between:-180,180',
            'google_maps_embed' => 'nullable|string',
            'google_maps_url'   => 'nullable|url|max:2000',
            'operating_hours'   => 'nullable|string|max:255',
        ]);

        $profile = SchoolProfile::first();

        if ($profile) {
            $profile->update($validated);
        } else {
            SchoolProfile::create($validated);
        }

        return redirect()
            ->route('admin.school-profile.edit')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
