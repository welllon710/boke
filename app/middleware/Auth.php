<?php
declare (strict_types = 1);

namespace app\middleware;
use think\facade\Cache;
class Auth
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
        if (Cache::has('info') ){
            return $next($request);
        }else{
            return redirect('/think');
        }
    }
}
