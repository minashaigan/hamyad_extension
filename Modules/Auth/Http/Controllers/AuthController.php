<?php

namespace Modules\Auth\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Auth\Entities\Code;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('api.auth', ['except' => ['index', 'register', 'login']]);
        $this->user = new User();
    }

    /**
     * view register page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth::index');
    }

    /**
     * Register a user and get a JWT.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        Config::set('jwt.user', 'App\User');
        Config::set('auth.providers.users.model', \App\User::class);
        // validation
        $this->validate($request, [
            'name'              => 'required|min:3',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:6|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'phone'             => 'required|min:11|max:12|regex:/(09)[0-9]{9}/|unique:users',
        ],[
            'name.required'     => 'وارد کردن نام شما ضروری است',
            'name.min'          => 'نام کامل خود را وارد نمایید ( حداقل 3 کاراکتر)',
            'email.required'    => 'وارد کردن ایمیل شما ضروری است',
            'email.email'       => 'ایمیل معتبر نیست',
            'email.unique'      => 'ایمیل قبلا ثبت شده است.',
            'password.required' => 'رمز عبور ضروری میباشد',
            'password.min'      => 'حداقل طول پسورد ۶ است',
            'password.confirmed'=> 'رمز و تایید آن  مطابقت ندارند',
            'password.regex'    => 'رمز باید حداقل شامل یک حرف و یک عدد باشد.',
            'phone.required'    => 'موبایل الزامی است.',
            'phone.min'         => 'موبایل شما معتبر نیست.',
            'phone.max'         => 'موبایل شما معتبر نیست.',
            'phone.regex'       => 'فرمت شماره تماس درست نیست از فرمت مثالی ۰۹۳۰۱۱۰۱۰۱۰ استفاده نمایید.',
            'phone.unique'      => 'موبایل قبلا ثبت شده است.'
        ]);

        if ($request['name'] == trim($request['name']) && strpos($request['name'], ' ') !== false) {
            $names = explode(" ", $request['name']);
            // create
            try {
                User::query()->create([
                    'first_name'    => $names[0],
                    'last_name'     => $names[1],
                    'email'         => $request['email'],
                    'password'      => app('hash')->make($request->get('password')),
                    'phone'         => $request['phone'],
                    'join_date'     => \Carbon\Carbon::now()->format('m/d/Y')
                ]);
            }
            catch (\Exception $e){

                return redirect('home')->withErrors(report($e));
            }
        }
        else {
            // create
            try {
                User::query()->create([
                    'first_name' => $request['name'],
                    'email' => $request['email'],
                    'password' => app('hash')->make($request->get('password')),
                    'phone' => $request['phone'],
                    'join_date' => \Carbon\Carbon::now()->format('m/d/Y')
                ]);
            } catch (\Exception $e) {
                return redirect('home')->withErrors(report($e));
            }
        }
        // JWT Auth
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = $this->guard()->attempt($credentials)) {

                return redirect('home')->withErrors('Unauthorized');
            }
        } catch (JWTException $e) {

            return redirect('home')->withErrors(report($e));
        }

        return redirect('home');
    }

    /**
     * login the user and get a JWT.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        Config::set('jwt.user', 'App\User');
        Config::set('auth.providers.users.model', \App\User::class);
        //validation
        $credentials = $this->validate($request, [
            'email'             => 'required|email',
            'password'          => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ],[
            'email.required'    => 'وارد کردن ایمیل شما ضروری است',
            'email.email'       => 'ایمیل معتبر نیست',
            'password.required' => 'رمز عبور ضروری میباشد',
            'password.min'      => 'حداقل طول پسورد ۶ است',
            'password.regex'    => 'رمز باید حداقل شامل یک حرف و یک عدد باشد.',
        ]);

        $user = User::query()->where('email', $request->input('email'))->first();
        if($user)
        {
            if (Hash::check($request->input('password'), $user->password))
            {
                try
                {
                    if (!$token = $this->guard()->attempt($credentials))
                    {
                        return redirect('home')->withErrors('Unauthorized');
                    }
                }
                catch (JWTException $e)
                {
                    return redirect('home')->withErrors('could_not_create_token');
                }
            }
            else
            {
                return redirect('home')->withErrors('Password is wrong');
            }
        }
        else
        {
            return redirect('home')->withErrors('Phone does not exist.');
        }
        return redirect('home');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['data' => ['message' => 'Successfully logged out','status_code' => '200']], 200);
    }

    /**
     * user reset password.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password'              => 'required|min:6',
            'new_password'          => 'required|min:6',
        ], [
            'password.required'     => 'رمز عبور ضروری میباشد ',
            'password.min'          => 'حداقل طول پسورد ۶ است ',
            'new_password.required' => 'رمز عبور جدید ضروری میباشد ',
            'new_password.min'      => 'حداقل طول پسورد جدید ۶ است ',
        ]);

//        if($user = app('Dingo\Api\Auth\Auth')->user())
//        {
            $credentials = [
//                'email'             => $user->email,
                'password'          => $request['password']
            ];

            try {
                if (! $token = $this->guard()->attempt($credentials)) {
                    return response()->json(['data' => ['message' => 'Password is wrong'], 'result' => 0], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['data' => ['message' => 'could_not_create_token'], 'result' => 0], 500);
            }

            try {
//                $user->password = app('hash')->make($request->get('new_password'));
//                $user->save();
            }
            catch (\Exception $e){
                return response()->json(['data' => ['message' => $e], 'result' => 0], 500);
            }

            return $this->respondWithToken($token);
//        }
//        else{
//            return response()->json(['data' => ['message' => 'Unauthorized'], 'result' => 0], 401);
//        }
    }

    /**
     * user forgot password and get a JWT.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {

        $this->validate($request, [
            'email'             => 'required|email',
        ],[
            'email.required'    => ' ایمیل الزامی می باشد.',
            'email.email'       => 'ایمیل شما معتبر نیست',
        ]);

        if($user = User::query()->where('email', $request['email'])->first())
        {
            try {
                $temp_code = random_int(00000,99999);

                $code = new Code(['code' => $temp_code]);

                $user->codes()->save($code);
            }
            catch (\Exception $e) {
                return response()->json(['data' => ['message' => $e], 'result' => 0], 500);
            }

            try {
                Mail::raw('A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request just click the link below:' . "\r\n" . "\r\n" .
                    "$temp_code" .
                    "\r\n" . "\r\n" . 'If the above code does not work, try to get another. If you continue to experience problems please feel free to contact us.',
                    function ($message) use ($request) {
                        $message->to($request['email']);
                        $message->subject("Hamyad - Password Reset Instructions");
                        $message->getSwiftMessage();
                    });
            }
            catch (\Exception $e){
                $code->delete();
                return response()->json(['data' => ['message' => $e], 'result' => 0], 400);
            }
            return response()->json(['data' => ['message' => 'Email Send Successfully'], 'result' => 1], 200);
        }
        else
        {
            return response()->json(['data' => ['message' => 'Email Not Found'], 'result' => 0], 404);
        }
    }

    /**
     *
     * submit user received email correctly
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPasswordSubmit(Request $request)
    {
        if ($request->has('code')) {
            $code = Code::query()->where('code', $request['code'])->first();
            if ($code) {
                if ($user = $code->user()->first()) {

                    try {
                        $code->delete();

                        $temp_code = str_random(20);

                        $code = new Code(['code' => $temp_code]);

                        $user->codes()->save($code);

                    }
                    catch (\Exception $e){
                        return response()->json(['data' => ['message' => $e], 'result' => 0], 500);
                    }
                    return response()->json([
                        'result' => 1,
                        'message' => 'User Recognized Successfully',
                        'token' => $temp_code,
                    ]);
                }
                else {
                    return response()->json(['data' => ['message' => 'Unauthorized'], 'result' => 0], 401);
                }
            }
            else{
                return response()->json(['data' => ['message' => 'Wrong Token'], 'result' => 0], 401);
            }
        }
        else{
            return response()->json(['data' => ['message' => 'no Token'], 'result' => 0], 401);
        }
    }

    /**
     * user set password.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPassword(Request $request)
    {
        if($request->has('token')){
            $code = Code::query()->where('code', $request['token'])->first();
            if($code) {
                if ($user = $code->user()->first()) {

                    if ($user->activated == 1) {
                        $credentials = $this->validate($request, [
                            'phone' => 'required|min:11|max:12|regex:/(09)[0-9]{9}/',
                            'password' => 'required|min:6|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                        ],[
                            'password.required'=> 'رمز عبور ضروری میباشد ',
                            'password.min'=> 'حداقل طول پسورد ۶ است ',
                            'password.confirmed'=> 'رمز و تایید آن  مطابقت ندارند',
                            'password.regex' => 'رمز باید حداقل شامل یک حرف و یک عدد باشد.',
                            'phone.required'   => 'موبایل الزامی است.',
                            'phone.min'        => 'موبایل شما معتبر نیست.',
                            'phone.max'        => 'موبایل شما معتبر نیست.',
                            'phone.regex' =>'فرمت شماره تماس درست نیست از فرمت مثالی ۰۹۳۰۱۱۰۱۰۱۰ استفاده نمایید.'
                        ]);

                        try {
                            $user->password = app('hash')->make($request->get('password'));
                            $user->save();
                        }
                        catch (\Exception $e){
                            return response()->json(['data' => ['message' => $e], 'result' => 0], 500);
                        }

                        try {
                            if (!$token = $this->guard()->attempt($credentials)) {

                                return response()->json(['data' => ['message' => 'Unauthorized'], 'result' => 0], 401);
                            }
                        } catch (JWTException $e) {
                            return response()->json(['data' => ['message' => $e], 'result' => 0], 500);
                        }

                        $code->delete();
                        return $this->respondWithToken($token);
                    }
                    else{
                        return response()->json(['data' => ['message' => 'User is not activated yet'], 'result' => 0], 401);
                    }
                } else {
                    return response()->json(['data' => ['message' => 'Unauthorized'], 'result' => 0], 401);
                }
            }
            else{
                return response()->json(['data' => ['message' => 'Wrong Token'], 'result' => 0], 401);
            }
        }
        else{
            return response()->json(['data' => ['message' => 'no Token'], 'result' => 0], 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json(['data' => ['message' => 'Successful', 'token' => $token], 'result' => 1], 200);
    }

    public function guard()
    {
        return Auth::guard();
    }

}