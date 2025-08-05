<?php

namespace App\Services\Dashboard;

use App\Repositories\BannerRepository;
use App\Models\Banner;

class BannerService
{
    protected $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function store(array $data): Banner
    {
        
        return $this->bannerRepository->create($data);
    }

    public function update(Banner $banner, array $data): Banner
    {
        
        return $this->bannerRepository->update($banner, $data);
    }

    public function delete(Banner $banner): bool
    {
        
        return $this->bannerRepository->delete($banner);
    }
}
