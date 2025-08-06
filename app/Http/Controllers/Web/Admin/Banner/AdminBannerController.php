<?php

namespace App\Http\Controllers\Web\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Banner\StoreBannerRequest;
use App\Http\Requests\Web\Admin\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\Dashboard\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AdminBannerController extends Controller
{
    protected BannerService $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }


    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return View::make('Admin.pages.banners.index', compact('banners'));
    }


    public function create()
    {

        return View::make('Admin.pages.banners.create');
    }

    public function store(StoreBannerRequest $request): RedirectResponse
    {
        // dd($request->all());

        $this->bannerService->store($request->validated());

        return Redirect::route('banners.index')->with('success', __('messages.banner_created'));
    }


    public function edit(Banner $banner)
    {
        return View::make('Admin.pages.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner): RedirectResponse
    {
        $this->bannerService->update($banner, $request->validated());
        return Redirect::route('banners.index')->with('success', __('messages.banner_updated'));
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $this->bannerService->delete($banner);
        return Redirect::route('banners.index')->with('success', __('messages.banner_deleted'));
    }
}
