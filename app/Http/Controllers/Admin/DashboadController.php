<?php
// Project2 : dashboad Controller as HomeController


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorDetail;
use App\Models\Order;
use App\Models\Product2;
use App\Models\TempImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DashboadController extends Controller
{
   public function dashboard()
   {
       $totalOrders     = Order::where('status', '!=', 'cancelled')->count();
       $totalProducts   = Product2::count();
       $totalCustomer   = User::where('user_type','user')->count();
       $totalAdmin      = User::where('user_type','admin')->where('status',1)->count();
       $totalUser       = User::count();
       $totalRevenue    = Order::where('status', '!=', 'cancelled')->sum('grand_total');
       $totalPendding   = Order::where('status', '=', 'pending')->count();
       $OrderCancelled    = Order::where('status', '=', 'cancelled')->count();

       $starOfMont      = Carbon::now()->startOfMonth()->format('Y-m-d');
       $currentDate     = Carbon::now()->format('Y-m-d');
       $revenueThisMonth= Order::where('status', '!=', 'cancelled')
                                ->whereDate('created_at', '>=', $starOfMont)
                                ->whereDate('created_at', '<=', $currentDate)
                                ->sum('grand_total');

        //Last month revenue
        $lastMonthStartDate =   Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndtDate  =   Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $revenueLastMonth   = Order::where('status', '!=', 'cancelled')
                                    ->whereDate('created_at', '>=', $lastMonthStartDate)
                                    ->whereDate('created_at', '<=', $lastMonthEndtDate)
                                    ->sum('grand_total');
        // Last 30 days revenue calculate                          
        $last_30_Days_StartDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $revenueLast_30_Dasy = Order::where('status', '!=', 'cancelled')
                                        ->whereDate('created_at', '>=', $last_30_Days_StartDate)
                                        ->whereDate('created_at', '<=', $currentDate)
                                        ->sum('grand_total');

        $lastMonthName =Carbon::now()->subMonth()->startOfMonth()->format('M');
        $currentMonthName =Carbon::now()->format('M');;

        //Visitor Chart details 
            $dailyVisitors = VisitorDetail::selectRaw('DATE(created_at) as date, count(*) as count')
               ->groupBy('date')
               ->orderBy('date', 'asc')
               ->get()
               ->pluck('count', 'date')
               ->toArray();

            $deviceData = VisitorDetail::select('device_type', DB::raw('count(*) as total'))
               ->groupBy('device_type')
               ->pluck('total', 'device_type')
               ->toArray();

            $browserData = VisitorDetail::select('browser', DB::raw('count(*) as total'))
               ->groupBy('browser')
               ->pluck('total', 'browser')
               ->toArray();

            $todayVisitors = VisitorDetail::whereDate('created_at', Carbon::today())->count();

       $data['totalOrders']   = $totalOrders;
       $data['totalProducts'] = $totalProducts;
       $data['totalCustomer'] = $totalCustomer;
       $data['totalAdmin']    = $totalAdmin;
       $data['totalUser']     = $totalUser;
       $data['totalRevenue']        = $totalRevenue;
       $data['totalPendding']       = $totalPendding;
       $data['OrderCancelled']      = $OrderCancelled;
       $data['revenueThisMonth']    = $revenueThisMonth;
       $data['revenueLastMonth']    = $revenueLastMonth;
       $data['revenueLast_30_Dasy'] = $revenueLast_30_Dasy;
       $data['lastMonthName']       = $lastMonthName;
       $data['currentMonthName']    = $currentMonthName;
       $data['dailyVisitors']       = $dailyVisitors;
       $data['deviceData']          = $deviceData;
       $data['browserData']         = $browserData;
       $data['todayVisitors']       = $todayVisitors;

    //Delete Temp Images
      $dayBeforeToday = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
      $tempImages = TempImage::where('created_at','<=',$dayBeforeToday)->get();

         foreach ($tempImages as $tempImage) {
            $path = public_path('temp/'.$tempImage->name); //temp image path   
            $thumbPath = public_path('temp/thumb'.$tempImage->name);//thumb image path

                  //Delete Main Image or useless image
                  if( File::exists($path) ) {
                     File::delete($path);
                  }
                  //Delete Thumb Image or useless image
                  if( File::exists($thumbPath) ) {
                     File::delete($thumbPath);
                  }
               TempImage::where('id',$tempImage->id)->delete();
               }

            return view('admin.dashboard',$data);
   }

       

   public function profile()
   {
    return view('admin.profile');
   }
}
