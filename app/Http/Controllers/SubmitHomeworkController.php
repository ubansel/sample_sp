<?php

namespace App\Http\Controllers;

use App\Models\StudentHomework;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SubmitHomeworkController extends Controller
{

    /**
     * @param Request $request
     * @param string $studentId
     * @param string $homeworkId
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitHomework(Request $request, string $studentId, string $homeworkId)
    {
        $request->validate(
            [
                'homework_file' => 'required|file',
            ]
        );

        try {

            $submitted = false;
            $filePath = "";

            $file = $request->file('homework_file');
            if ($file->isValid()) {

                // To avoid a storage folder full of files that could collide,
                // the path naming scheme will be:
                // homework_submissions/{student_id}/{homework_id}_uuid

                //Use the default storage mechanism.
                $filePath = $file->storeAs(
                    "homework_submissions/{$studentId}",
                    "{$homeworkId}_" . Str::uuid());

                if (!empty($filePath)) {
                    // Lookup the student's homework and store the file path
                    // Create it if it doesn't exist
                    StudentHomework::firstOrCreate([
                        'student_id' => $studentId,
                        'homework_id' => $homeworkId,
                    ],
                    [
                        'filepathname' => $filePath,
                        'submission_datetime' => Carbon::now()
                    ]);
                    $submitted = true;
                }
            }

            return \response()->json([
                'submitted' => $submitted,
                'file' => $filePath,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'submitted' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
