<?php

namespace App\Http\Controllers\Admin;

use App\EducationalBase;
use App\EducationalClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\InfoStudent;
use App\RegisterClassStudent;
use App\Traits\OptionTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoStudentController extends Controller
{
    use OptionTrait;

    public function uncheckedProfiles()
    {
        $unchecked = User::query()->where('level', 'student')
            ->where('avatar', '!=', null)
            ->where('avatar_check', 0)
            ->oldest()->paginate(20);
        return view('panel.admin.InfoStudents.unchecked', compact('unchecked'));
    }

    public function submitProfiles(User $student)
    {
        $student->update(['avatar_check' => 1]);
        return redirect(url()->previous())->with('success', 'تصویر کاربر با موفقیت تایید گردید!');
    }

    public function index()
    {
        return view('panel.admin.InfoStudents.activeCourseStudents');
    }

    public function index1(Request $request)
    {

       // return $request->all();
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 20;
        $base = 12;
        $class = null;
        $q = null;
       // $headerTitle = null;

        if ($request->has('base')) $base = $request->query('base');
        if ($request->has('class')) $class = $request->query('class');
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
//return $base;
        $students = User::query()
            ->where('level', 'student')
           // ->orderBy($sortBy, $orderBy)
            //->where('')
           ->get();
        $data_students=null;
        foreach ($students as $student){
            $name_family = $student->first_name . ' ' . $student->last_name;
            $register = $student->studentBaseClass;
        //    return $register->educationBase->base_title;
            $data_students[]=[
                'id' =>$student->id,
                'name_family' =>$name_family,
                'base_id' => $register->educationBase->id ?? null,
                'base_name' => $register->educationBase->base_title ?? 'تعیین نشده',
                'class_id' => $register->educationClass->id ?? null,
                'class_name' => $register->educationClass->class_title ?? 'تعیین نشده',
                'user_code' => $student->usercode,
                'user_pass' => $student->userpass,
                'email' => $student->email ?? 'تعیین نشده',
                'phone' => $student->phone ?? 'تعیین نشده',
            ];
        }
        $col_students = collect($data_students);
        $data_students= $col_students->where('base_id',$base)
            ->where('class_id',$class);
        $data_students->all();
        //$data_students
        $students = paginate($data_students,$perPage);
        $students->withPath(url()->current());

        $bases = EducationalBase::query()
            ->orderBy('id', 'asc')
            ->get();
        if (! $request->has('class')) {
            $classes = EducationalClass::query()->where('base_id',12)->orderBy('class_title','asc')->get();
        }else{
            $classes = EducationalClass::query()
                ->where('base_id',$base)
                ->orderBy('class_title', 'asc')
                ->get();
        }


        //  $students = User::where('level','student')->latest()->paginate(20);
        return view('panel.admin.InfoStudents.all',
            compact('students', 'sortBy','orderBy','perPage',
                'base','bases','q','classes','class'
            ));
    }

    public function create()
    {
        $states = DB::table('states')->orderBy('name', 'asc')->get();
        $bases = EducationalBase::all();
        return view('panel.admin.InfoStudents.create', compact('states', 'bases'));
    }

    public function store(StudentRequest $request)
    {
        $randomString = $this->createUniquePrivateCode(8);
        if (empty($request['usercode'])) {
            $userCode = $this->createUniqueUserCode();
        } else {
            $userCode = $request['usercode'];
        }

        $userData = [
            'private_code' => $randomString,
            'usercode' => $userCode,
            'level' => 'student',
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'userpass' => $request['password'],
            'password' => bcrypt($request['password']),
            'block' => $request['block'],
        ];
        $user = User::create($userData);
        $studentData = [
            'user_id' => $user->id,
            'melli' => $request['melli'],
            'father' => $request['father'],
            'state_id' => $request['state_id'],
            'city_id' => $request['city_id'],
            'gender' => $request['gender'],
        ];
        InfoStudent::create($studentData);
        $register = [
            'user_id' => $user->id,
            'base_id' => $request['base_id'],
            'class_id' => $request['class_id'],
        ];
        RegisterClassStudent::create($register);
        return redirect(route('admin.students.index'))->with('success', 'کاربر با موفقیت ثبت گردید!');
    }

    public function show(User $student)
    {
        $state = DB::table('states')->where('id', $student->student->state_id)->first();
        $city = DB::table('cities')->where('id', $student->student->city_id)->first();
        return view('panel.admin.InfoStudents.show', compact('student', 'state', 'city'));
    }

    public function edit(User $student)
    {
        $stInfo = $student->student;
        if (!$stInfo) {
            $stInfo = InfoStudent::create(['user_id' => $student->id]);
        }

        $states = DB::table('states')->orderBy('name', 'asc')->get();
        $cities = DB::table('cities')->where('state_id', $stInfo->state_id)->orderBy('name', 'asc')->get();

        $register = $student->studentBaseClass;
        $bases = EducationalBase::query()->get();
        $classes = EducationalClass::query()->where('base_id', $register->base_id)->orderBy('class_title', 'asc')->get();

        return view('panel.admin.InfoStudents.edit',
            compact('student', 'states', 'cities', 'stInfo', 'register', 'bases', 'classes'));
    }

    public function update(StudentRequest $request, InfoStudent $student)
    {
        $user = $student->user;
        if ($request['email']) {
            $newEmail = $request['email'];
        } else {
            $newEmail = $user->email;
        }

        if ($request['phone']) {
            $newPhone = $request['phone'];
        } else {
            $newPhone = $user->phone;
        }

        if ($request['password']) {
            $userpass = $request['password'];
            $newPassword = bcrypt($request['password']);
        } else {
            $userpass = $user->userpass;
            $newPassword = $user->password;
        }

        if ($request['melli']) {
            $newMelli = $request['melli'];
        } else {
            $newMelli = $student->melli;
        }
        $userData = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $newEmail,
            'phone' => $newPhone,
            'userpass' => $userpass,
            'password' => $newPassword,
            'block' => $request['block'],
        ];
        $studentData = [
            'melli' => $newMelli,
            'father' => $request['father'],
            'state_id' => $request['state_id'],
            'city_id' => $request['city_id'],
            'gender' => $request['gender'],
        ];
        $user->update($userData);
        $student->update($studentData);
        $register = $user->studentBaseClass;
        $register->update([
            'base_id' => $request['base_id'],
            'class_id' => $request['class_id'],
        ]);
        return redirect(route('admin.students.index'))->with('success', 'کاربر با موفقیت ویرایش گردید!');
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect(route('admin.students.index'))->with('success', 'کاربر با موفقیت حذف گردید!');
    }

}
