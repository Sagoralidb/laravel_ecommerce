<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\VisitorDetail;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // এডমিন ব্যবহারকারীর জন্য বিজিটর হিসেব রেকর্ড করা হবে না
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // প্রতি রিকুয়েস্টের জন্য রেকর্ডিং চেক করুন
        if (!$request->session()->has('visited')) {
            $this->recordVisitor($request);
            $request->session()->put('visited', true);
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
