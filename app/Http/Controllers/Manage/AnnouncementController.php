<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
  public $routePrefix = 'manage.announcement';
  public $viewPrefix = 'manage.announcement';

  public function list(Request $request)
  {
    $obj = new Announcement();
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
    $obj = new Announcement();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $announcement = new Announcement();

    $validator = $announcement->register($data);

    if($validator === true) {
      return redirect()->route($this->routePrefix.'.list')
        ->with('success', 'ニュース作成完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'ニュース作成失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function update(Request $request)
  {
    $obj = Announcement::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Announcement::findOrFail($request->id);

    $validator = $obj->edit($data);

    if($validator === true) {
      return redirect()
        ->back()
        ->with('success', 'ニュース変更完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'ユーザ変更失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function view(Request $request)
  {
    $obj = Announcement::find($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function delete(Request $request)
  {
    $obj = Announcement::find($request->id);
    $obj->delete();

    return redirect()->route($this->routePrefix.'.list')
      ->with('success', '削除完了しました');
  }
}