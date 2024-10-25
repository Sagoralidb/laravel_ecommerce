<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\VisitorDetail;
use App\Models\User;

class ExcludeAdminFromVisitorCount
{
    public function handle(Request $request, Closure $next)
    {
        // এডমিন ব্যবহারকারীর জন্য বিজিটর হিসেব রেকর্ড করা হবে না
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // যদি পূর্বের বিজিট সেশন রিসেট হয়ে গেছে তবে রেকর্ড করুন
        if (!$request->session()->has('recorded_visit')) {
            $this->recordVisitor($request);
            $request->session()->put('recorded_visit', true);
        }

        return $next($request);
    }

    protected function recordVisitor(Request $request)
    {
        $agent = new Agent;
        VisitorDetail::create([
            'ip_address' => $request->ip(),
            'device_type' => $agent->device(),
            'browser' => $agent->browser(),
        ]);
    }
}
