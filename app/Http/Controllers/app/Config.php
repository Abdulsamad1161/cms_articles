<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\ConfigApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Config extends Controller
{
  public function appConfig()
  {
    $data['app'] = ConfigApp::find(1);
    return view('content.app.appConfig', $data);
  }

  public function appConfigUpdate(Request $request)
  {
    try {
      // Validate the incoming request with the appropriate rules
      $validator = Validator::make($request->all(), [
        'companyName' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()
          ->back()
          ->withInput()
          ->withErrors($validator->errors()->all(), 'validation_errors');
      }

      // Find the user by ID
      $app = ConfigApp::findOrFail(1);

      // Handle file upload
      if ($request->hasFile('companyLogo')) {
        $image = $request->file('companyLogo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/login'), $imageName);
        // Update the image attribute of the user
        $app->companyLogo = $imageName;
      }

      // Update other user attributes
      $app->companyName = $request->companyName;

      // Save the updated user to the database
      $app->save();

      $request->session()->flash('success', 'Configuration Successfully Updated');
      return redirect()->route('app-config');
    } catch (QueryException $e) {
      // If updating failed due to a database error
      $errorMessage = 'An error occurred while updating the employee.';
    } catch (\Exception $e) {
      // If updating failed due to other unexpected errors
      $errorMessage = 'An unexpected error occurred. Please try again.';
    }

    // Flash error message to session
    $request->session()->flash('error', $errorMessage);

    // Redirect back to the employee list page with error message
    return redirect()->route('app-config');
  }
}
