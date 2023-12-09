<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
// use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'nullable|string',
        'email' => 'required|email|unique:users,email',
        'id_number' => 'nullable|integer|unique:users,Id_number',
        'artical' => 'required|string',
        'affiliation' => 'required|string',
        'co_authors' => 'required|array', // تغيير json إلى array
        'abstract' => 'required|string',
        'figures' => 'required|string',
        'SCHFS' => 'nullable|integer'
    ];
    public function index(){
        return view('registration');
    }
    //
    public function upload(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $uniqueFileName = $file->store('uploads', 'public');
            
            return response()->json(['status' => 'success', 'file' => $uniqueFileName]);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Error while upload file']);
    }
    
    public function create(Request $request)
    {
        
       $this->validate($request, $this->rules);
    
        try {
            // إنشاء مستخدم جديد
            $user = User::create([
                'First_name' => $request->input('first_name'),
                'Last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'Id_number' => $request->input('id_number'),
                'password' => bcrypt('coderans'),
                // إضافة حقول المستخدم الأخرى حسب الحاجة
            ]);
    
            // إنشاء طلب بحث جديد مرتبط بالمستخدم
            $application = Application::create([
                'user_id' => $user->id,
                'artical' => $request->input('artical'),
                'Affiliation' => $request->input('affiliation'),
               'Co_authors' => json_encode($request->input('co_authors')),
                // 'Co_authors' => json_encode(['مؤلف1', 'مؤلف2']),
                'abstract_file_path' => $request->input('abstract'),
                'figures_file_path' => $request->input('figures'),
                'SCHFS' => $request->input('SCHFS'),
                // إضافة حقول الطلب حسب الحاجة
            ]);
    
            // إعادة تعيين حقول النموذج بعد التقديم
            // session()->flash('message', 'Registration successful!');j
            return redirect()->back()->with('message', 'Registration successful!');
        } catch (\Exception $e) {
            session()->flash('error', 'Registration failed. Please try again.');
    
            // تسجيل الاستثناء لأغراض التصحيح
            Log::error($e);
    
            // إعادة رمي الاستثناء لعرض صفحة الخطأ الافتراضية في Laravel
            throw $e;
        }
    }
    
    
    
}
