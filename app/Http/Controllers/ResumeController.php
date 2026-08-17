<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resume' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5120',
            ],
        ]);

        $user = auth()->user();

        if ($user->resume) {
            Storage::disk('public')->delete(
                $user->resume->file_path
            );

            $user->resume->delete();
        }

        $file = $request->file('resume');

        $path = $file->store(
            'resumes',
            'public'
        );

        Resume::create([
            'user_id' => $user->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return back()->with(
            'success',
            'Resume uploaded successfully.'
        );
    }

    public function destroy()
    {
        $resume = auth()->user()->resume;

        if ($resume) {
            Storage::disk('public')->delete(
                $resume->file_path
            );

            $resume->delete();
        }

        return back()->with(
            'success',
            'Resume deleted successfully.'
        );
    }

    public function download(Resume $resume)
{
    $this->authorize('view', $resume);

    return Storage::disk('public')->download(
        $resume->file_path,
        $resume->file_name
    );
}
}