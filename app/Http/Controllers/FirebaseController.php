<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    protected $database;

    public function __construct()
    {
        $serviceAccountPath = storage_path('app/firebase-auth.json');
        $databaseUrl = 'https://water-level-sensor-4919d-default-rtdb.asia-southeast1.firebasedatabase.app/';

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri($databaseUrl);

        $this->database = $firebase->createDatabase();
    }

    public function getFirebaseData(Request $request)
    {
        $reference = $this->database->getReference();
        $data = $reference->getValue();

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('firebase.index', ['data' => $data]);
    }
}
