<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /** @var Redirector */
    private $redirector;

    /**
     * Create a new filter instance.
     *
     * @param Guard      $auth
     * @param Redirector $redirector
     */
    public function __construct(Guard $auth, Redirector $redirector)
    {
        $this->auth = $auth;
        $this->redirector = $redirector;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->auth->guest()) {
            return $next($request);
        }

        if ($request->ajax()) {
            return new Response('Unauthorized.', 401);
        }

        return $this->redirector->guest('login');
    }

}
