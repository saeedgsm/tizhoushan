<?php

namespace App\Http\Controllers\Admin;

use App\DefaultCover;
use App\Http\Controllers\Controller;
use App\Traits\UploaderFile;
use Illuminate\Http\Request;

class DefaultCoverController extends Controller
{
    use UploaderFile;

    public function index()
    {
        $covers = DefaultCover::query()
            ->orderBy('cover_name', 'asc')
            ->paginate(20);
        return view('panel.admin.defaultCovers.all', compact('covers'));
    }

    public function create()
    {
        return view('panel.admin.defaultCovers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cover_name' => 'required|string|min:3|max:191',
            'cover_loc' => ['required', 'string', 'regex:/^\S*$/u', 'min:5', 'max:191'],
            'cover_url' => ['required', 'image'],
        ]);
        $input = $request->except('cover_url');
        $file = $request->file('cover_url');
        if ($file) {
            $input['cover_url'] = $this->uploadImage($file, $request['cover_loc']);
        }
        DefaultCover::create($input);
        return redirect(route('admin.defaultCovers.index'))
            ->with('success', 'اطلاعات کاور پیش فرض با موفقیت ثبت گردید.');
    }

    public function edit(DefaultCover $defaultCover)
    {
        return view('panel.admin.defaultCovers.edit', compact('defaultCover'));
    }

    public function update(Request $request, DefaultCover $defaultCover)
    {
        $request->validate([
            'cover_name' => 'required|string|min:3|max:191',
            'cover_loc' => ['required', 'string', 'regex:/^\S*$/u', 'min:5', 'max:191'],
            'cover_url' => ['nullable', 'image'],
        ]);
        $input = $request->except('cover_url');
        $file = $request->file('cover_url');
        if ($file) {
            if (file_exists(asset($defaultCover->cover_url)))
                unlink($defaultCover->cover_url);
            $input['cover_url'] = $this->uploadImage($file, $request['cover_loc']);
        } else {
            $input['cover_url'] = $defaultCover->cover_url;
        }
        $defaultCover->update($input);
        return redirect(route('admin.defaultCovers.index'))
            ->with('success', 'اطلاعات کاور پیش فرض با موفقیت ویرایش گردید.');
    }

    public function destroy(DefaultCover $defaultCover)
    {
        if (file_exists(asset($defaultCover->cover_url)))
            unlink($defaultCover->cover_url);
        $defaultCover->delete();
        return redirect(route('admin.defaultCovers.index'))
            ->with('success', 'اطلاعات کاور پیش فرض با موفقیت ویرایش گردید.');
    }
}
