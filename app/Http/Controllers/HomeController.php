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
        'SCHFS' => 'nullable|integer',
        'title' => 'required|string',
        'author' => 'required|string',
        'conference' => 'nullable|string',
        'link' => 'nullable|url',
        'title_or_position' => 'required|string',
        'oral' => 'nullable|string',
    ];
    public function index(){
        // $ds = Application::find(8);
        // dd($ds->Co_authors[0]->co_authors);
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
        // dd($request->input('co_authors'));
       $this->validate($request, $this->rules);
    //    dd($request->input('co_authors'));
    
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
                'author' => $request->input('author'),
                'title' => $request->input('title'),
               'Co_authors' => json_encode($request->input('co_authors')),
                // 'Co_authors' => json_encode(['مؤلف1', 'مؤلف2']),
                'abstract_file_path' => $request->input('abstract'),
                'figures_file_path' => $request->input('figures'),
                'SCHFS' => $request->input('SCHFS'),
                'conference' => $request->input('conference'),
                'link' => $request->input('link'),
                'title_or_position' => $request->input('title_or_position'),
                'oral' =>$request->input('oral'),
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
