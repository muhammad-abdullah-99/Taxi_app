<?php

namespace App\Http\Controllers;

use App\Models\PackageSubDetail;
use App\Models\PackageType;
use Illuminate\Http\Request;

class BankController extends Controller
{
      public function showAllBank()
    {
        return view('/admin/transport/bank/bank');
    }
      public function showAllPackageDetails()
    {
        $packages=PackageType::whereHas('subDetail')->with('subDetail')->get();;
        return view('/admin/transport/bank/packages',compact('packages'));
    }
}
