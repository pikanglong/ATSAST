<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use App\Models\Eloquents\Course;
use Illuminate\Http\Request;
use Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $coursemodel = new CourseModel();
        $ret = $coursemodel->list();
        $list = $ret['list'];
        $paginator = $ret['paginator'];
        return view('courses.index', [
            'page_title'=>"课程",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Courses",
            'result'=>$list,
            'paginator'=>$paginator,
        ]);
    }

    public function detail(Request $request)
    {
        $course = $request->course;
        $course->load('syllabus.signs','instructors.user','details');
        $user = Auth::user();
        $register = $course->registers()->where('uid',$user->id)->first();
        return view('courses.detail', [
            'page_title' => "课程",
            'site_title' => "SAST教学辅助平台",
            'navigation' => "Courses",
            'course'     => $course,
            'register'   => $register
        ]);
    }

    public function sign(Request $request)
    {
        $cid = $request->cid;
        $syid = $request->syid;
        $coursemodel = new CourseModel();
        if(!Auth::Check() || !$coursemodel->existCid($cid) || !$coursemodel->existSyid($cid,$syid)){
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $sign_status = $coursemodel->signStatus($cid,$syid,Auth::user()->id);
        $syllabus = $coursemodel->syllabusInfo($cid,$syid);
        return view('courses.sign', [
            'page_title'=>"课程",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Courses",
            'cid'=>$cid,
            'syid'=>$syid,
            'sign_status'=>$sign_status,
            'syllabus'=>$syllabus,
        ]);
    }

    public function register(Request $request)
    {
        $cid = $request->cid;
        $coursemodel = new CourseModel();
        if(!Auth::Check() || !$coursemodel->existCid($cid)){
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $register_status = $coursemodel->registerStatus($cid,Auth::user()->id);
        return view('courses.register', [
            'page_title'=>"课程",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Courses",
            'cid'=>$cid,
            'register_status'=>$register_status,
        ]);
    }

    public function script(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        return view('courses.script', [
            'page_title' => $course->course_name,
            'site_title' => "SAST教学辅助平台",
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
        ]);
    }

    public function feedback(Request $request)
    {
        $user = Auth::user();
        $course = $request->course;
        $syllabus = $request->syllabus;
        $feedback = $request->feedback;
        $register_status = $course->registers()->where('uid',$user->id)->count();
        return view('courses.feedback', [
            'page_title'      => "课程反馈",
            'site_title'      => $syllabus->title,
            'navigation'      => "Courses",
            'course'          => $course,
            'syllabus'        => $syllabus,
            'feedback'        => $feedback,
            'register_status' => $register_status,
        ]);
    }

    public function manage(Request $request)
    {
        $cid = $request->cid;
        $coursemodel = new CourseModel();
        if(!Auth::Check() || !$coursemodel->existCid($cid)){
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $ret = $coursemodel->manage($cid);
        if(!$ret){
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $result = $ret['result'];
        $site = $ret['site'];
        $detail = $ret['detail'];
        $instructor = $ret['instructor'];
        $syllabus = $ret['syllabus'];
        $access_right = $ret['access_right'];
        return view('courses.manage.index', [
            'page_title'=>"课程管理",
            'site_title'=>$site,
            'navigation'=>"Courses",
            'cid'=>$cid,
            'result'=>$result,
            'detail'=>$detail,
            'instructor'=>$instructor,
            'syllabus'=>$syllabus,
            'access_right'=>$access_right,
            'clearance'=>$access_right['clearance']
        ]);
    }

    public function add()
    {
        $coursemodel = new CourseModel();
        $access_right = $coursemodel->accessRightAdd(Auth::user()->id);
        if (!$access_right) {
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        return view('courses.manage.add', [
            'page_title'=>"新增课程",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Courses",
        ]);
    }

    public function edit(Request $request)
    {
        $course = $request->course;
        return view('courses.manage.edit', [
            'page_title' => "修改课程信息",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
        ]);
    }

    public function viewSign(Request $request)
    {
        $cid = $request->cid;
        $syid = $request->syid;
        $coursemodel = new CourseModel();
        $access_right = $coursemodel->accessRightViewSign(Auth::user()->id,$cid);
        $existSyid = $coursemodel->existSyid($cid,$syid);
        if (!$access_right || !$existSyid) {
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $ret = $coursemodel->viewSign($cid,$syid);
        if(!$ret){
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $sign_details = $ret['sign_details'];
        $result = $ret['result'];
        $syllabus_info = $ret['syllabus_info'];
        return view('courses.manage.sign.view', [
            'page_title'=>"查看签到情况",
            'site_title'=>$syllabus_info['title'],
            'navigation'=>"Courses",
            'cid'=>$cid,
            'syid'=>$syid,
            'sign_details'=>$sign_details,
            'result'=>$result,
            'syllabus_info'=>$syllabus_info,
        ]);
    }

    public function viewRegister(Request $request)
    {
        $cid = $request->cid;
        $coursemodel = new CourseModel();
        $access_right = $coursemodel->accessRightViewSign(Auth::user()->id,$cid);
        if (!$access_right) {
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $ret = $coursemodel->viewRegister($cid);
        if(!$ret){
            return redirect(request()->ATSAST_DOMAIN.route('course',null,false));
        }
        $register_details = $ret['register_details'];
        $result = $ret['result'];
        return view('courses.manage.view.register', [
            'page_title'=>"查看签到情况",
            'site_title'=>$result['course_name'],
            'navigation'=>"Courses",
            'cid'=>$cid,
            'register_details'=>$register_details,
            'result'=>$result,
        ]);
    }

    public function addSyllabus(Request $request)
    {
        $course = $request->course;
        return view('courses.manage.syllabus.add', [
            'page_title' => "新增课时",
            'site_title' => $course->name,
            'navigation' => "Courses",
            'course'     => $course,
        ]);
    }

    public function editSign(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        return view('courses.manage.sign.edit', [
            'page_title' => "新增课时",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
        ]);
    }

    public function editVideo(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        return view('courses.manage.video', [
            'page_title' => "设置教学视频",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
        ]);
    }

    public function editScript(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        return view('courses.manage.script', [
            'page_title' => "编辑课堂讲义",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
        ]);
    }

    public function editSyllabus(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        return view('courses.manage.syllabus.edit', [
            'page_title' => "修改课时信息",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
        ]);
    }

    public function editFeedback(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        return view('courses.manage.feedback.edit', [
            'page_title' => "修改反馈设置",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
        ]);
    }

    public function viewFeedback(Request $request)
    {
        $course = $request->course;
        $syllabus = $request->syllabus;
        $feedbacks = $syllabus->feedbacks;
        $feedbacks->load('user');
        return view('courses.manage.feedback.view', [
            'page_title' => "查看反馈",
            'site_title' => $course->course_name,
            'navigation' => "Courses",
            'course'     => $course,
            'syllabus'   => $syllabus,
            'feedbacks'  => $feedbacks
        ]);
    }
}
