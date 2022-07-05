<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Schedule;
use App\Models\ScheduleParticipant;

class ScheduleController extends Controller
{
  public $routePrefix = 'manage.schedule';
  public $viewPrefix = 'manage.schedule';

  public function list(Request $request)
  {
    $obj = new Schedule();
    $filters = $request->query('filters');
    $page = $request->query('page');
    $sort = $request->query('sort');

    if($filters)
      $obj->fill($filters);
      $data = $obj->filter($filters, [
      'pagination' => true,
      'page' => $page,
      'sort' => $sort
    ]);

    return view($this->viewPrefix.'.list', [
      'obj' => $obj,
      'data' => $data,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function create()
  {
    $obj = new Schedule();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $schedule = new Schedule();

    $validator = $schedule->register($data);

    if($validator === true) {
      return redirect()->route($this->routePrefix.'.list')
        ->with('success', 'スケジュール作成完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'スケジュール作成失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function clone(Request $request)
  {
    $obj = Schedule::findOrFail($request->id);

    return view($this->viewPrefix.'.clone', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function clonePost(Request $request)
  {
    $data = $request->all();
    $obj = Schedule::findOrFail($request->id);
    $new = new Schedule();

    $validator = $new->register($data);

    if($validator === true) {
      return redirect()
        ->route($this->routePrefix.'.list')
        ->with('success', 'スケジュール変更完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'ユーザ変更失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function update(Request $request)
  {
    $obj = Schedule::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Schedule::findOrFail($request->id);

    $validator = $obj->edit($data);

    if($validator === true) {
      return redirect()
        ->back()
        ->with('success', 'スケジュール変更完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'ユーザ変更失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function view(Request $request)
  {
    $obj = Schedule::find($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function delete(Request $request)
  {
    $obj = Schedule::find($request->id);
    $obj->delete();

    return redirect()->route($this->routePrefix.'.list')
      ->with('success', '削除完了しました');
  }

  public function renderExportFile(Request $request)
  {
    $obj = Schedule::find($request->id);

    return view($this->viewPrefix.'.render-export-file', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function printPreview(Request $request)
  {
    $obj = Schedule::find($request->id);

    return view($this->viewPrefix.'.print-preview', [
      'obj' => $obj
    ]);
  }

  public function approveApplicant(Request $request)
  {
    Schedule::findOrFail($request->id);
    $obj = ScheduleParticipant::findOrFail($request->applicationId);
    $result = $obj->approve();

    if($result) {
      return redirect()
        ->back()
        ->with('succeed', '申し込みデータを承認しました。');
    }

    return redirect()
      ->back()
      ->with('error', '申し込みデータの承認が失敗しました。');
  }

  public function rejectApplicant(Request $request)
  {
    Schedule::find($request->id);
    $obj = ScheduleParticipant::findOrFail($request->applicationId);
    $result = $obj->reject();

    if($result) {
      return redirect()
        ->back()
        ->with('succeed', '申し込みデータを否定しました。');
    }

    return redirect()
      ->back()
      ->with('error', '申し込みデータの否定が失敗しました。');
  }
}