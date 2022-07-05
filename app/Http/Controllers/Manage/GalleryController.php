<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Gallery;

class GalleryController extends Controller
{
  public $routePrefix = 'manage.gallery';
  public $viewPrefix = 'manage.gallery';

  public function list(Request $request)
  {
    $obj = new Gallery();
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
    $obj = new Gallery();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $gallery = new Gallery();

    $validator = $gallery->register($data);

    if($validator === true) {
      return redirect()->route($this->routePrefix.'.list')
        ->with('success', 'ギャラリー作成完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'ギャラリー作成失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function update(Request $request)
  {
    $obj = Gallery::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Gallery::findOrFail($request->id);

    $validator = $obj->edit($data);

    if($validator === true) {
      return redirect()
        ->back()
        ->with('success', 'ギャラリー変更完了しました');
    }

    return redirect()
      ->back()
      ->with('error', 'ユーザ変更失敗しました。各フィールドに確認ください')
      ->withInput($data)
      ->withErrors($validator);
  }

  public function view(Request $request)
  {
    $obj = Gallery::find($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function delete(Request $request)
  {
    $obj = Gallery::find($request->id);
    $obj->delete();

    return redirect()->route($this->routePrefix.'.list')
      ->with('success', '削除完了しました');
  }
}