<?php

namespace App\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class ArrayTransformerSerializer extends ArraySerializer
{
    /**
     * @param       $resourceKey
     * @param array $data
     *
     * @return array|array[]
     */
    public function collection($resourceKey, array $data): array
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }

        return $data;
    }

    /**
     * @param       $resourceKey
     * @param array $data
     *
     * @return array|array[]
     */
    public function item($resourceKey, array $data): array
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }
        return $data;
    }
}
