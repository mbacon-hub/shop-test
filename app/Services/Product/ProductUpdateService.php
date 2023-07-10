<?php

namespace App\Services\Product;

use App\Data\Product\ProductData;
use App\Exceptions\App\Product\ProductUploadFileFailed;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductStoreInterface;
use App\Services\Interfaces\ProductUpdateInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductUpdateService implements ProductUpdateInterface
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
    public function update(array $data): Product
    {
        $file      = $data['img'] ?? false;
        $productId = $data['id'];

        #getting product by id
        $product = $this->productRepository->byId($productId);

        #if not found throw error
        if(is_null($product)) {
            throw new ModelNotFoundException('Not found');
        }

        try {
            DB::beginTransaction();

            #if file exists upload file
            if ($file) {
                $uploadedFile = $this->filesystem->putFile('', $file);

                if (is_bool($uploadedFile)) {
                    throw new ProductUploadFileFailed();
                }
            }

            $productData = ProductData::from([
                ...$data,
                'img' => $uploadedFile ?? null,
            ]);

            $product = $this->productRepository->update($product, $productData);

            DB::commit();

        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return $product;
    }
}
