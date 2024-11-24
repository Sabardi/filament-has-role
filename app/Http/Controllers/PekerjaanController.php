<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        $jobs = Pekerjaan::with('kategoris')->get();
        return view('User.job.index', compact('kategoris', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "hello";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validatedData = $request->validate([
            'company' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id', // Assuming 'kategoris' is the name of your categories table
        ]);

        // Handle the image upload
        if ($request->hasFile('thumbnail')) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/thumbnails'), $imageName); // Save to public/images/thumbnails
            $validatedData['thumbnail'] = $imageName; // Add the image name to the validated data
        }

        // Create a new Pekerjaan record
        Pekerjaan::create($validatedData);

        // Redirect or return response
        return redirect()->back()->with('success', 'Job created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Pekerjaan $job)
    // {

    //     $validatedData = $request->validate([
    //         'company' => 'required|string|max:255',
    //         'title' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
    //         'description' => 'required|string',
    //         'location' => 'required|string|max:255',
    //         'kategori_id' => 'required|exists:kategoris,id', // Assuming 'kategoris' is the name of your categories table
    //     ]);

    //     $job->update($validatedData);

    //     // Redirect or return response
    //     return redirect()->back()->with('success', 'Job updated successfully!');
    // }


    public function update(Request $request, Pekerjaan $job)
    {
        // Define validation rules
        $validatedData = $request->validate([
            'company' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id', // Assuming 'kategoris' is the name of your categories table
        ]);

        // Handle the thumbnail upload if a new file is provided
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail if it exists
            if ($job->thumbnail) {
                $oldImagePath = public_path('images/thumbnails/' . $job->thumbnail);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Remove the old image file
                }
            }

            // Upload the new thumbnail
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/thumbnails'), $imageName); // Save to public/images/thumbnails
            $validatedData['thumbnail'] = $imageName; // Add the new image name to the validated data
        } else {
            // If no new thumbnail is uploaded, keep the old one
            $validatedData['thumbnail'] = $job->thumbnail;
        }

        // Update the existing Pekerjaan record with validated data
        $job->update($validatedData);

        // Redirect or return response
        return redirect()->back()->with('success', 'Job updated successfully!');
    }

    public function destroy(Pekerjaan $job)
    {
        $job->delete();

        return redirect()->back()->with('success', 'Job delete successfully!');
    }
}
