<?php
declare (strict_types = 1);

namespace app\middleware;
use app\admin\controller\Admin;
use think\facade\Cache;

class Check
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response|\think\response\Redirect
     */
    public function handle($request, \Closure $next)
    {
        $current = Cache::get('info');
        // echo $current->is_super;
        if ($current->is_super !== '1'){
            return redirect('/think/admin/error');
        }else {
            return $next($request);
        }
    }
}
