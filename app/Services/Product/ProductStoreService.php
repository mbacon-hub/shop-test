<?php

namespace App\Services\Product;

use App\Data\Product\ProductData;
use App\Exceptions\App\Product\ProductUploadFileFailed;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductStoreInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductStoreService implements ProductStoreInterface
{

    /**
     * @param Filesystem                 $filesystem
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private Filesystem                 $filesystem,
        private ProductRepositoryInterface $productRepository,
    )
    {
        //
    }

    /**
     * @param array $data
     *
     * @return Product
     * @throws ProductUploadFileFailed
     * @throws Throwable
     */
    public function store(array $data): Product
    {
        $file = $data['img'];

        try {
            DB::beginTransaction();

            #uploading file
            $file = $this->filesystem->putFile('', $file);

            if (is_bool($file)) {
                #throw error if failed
                throw new ProductUploadFileFailed();
            }

            $productData = ProductData::from([
                ...$data,
                'img' => $file,
            ]);

            #store product
            $product = $this->productRepository->store($productData);

            DB::commit();

        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return $product;
    }
}
