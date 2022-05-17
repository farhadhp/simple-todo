<?php

namespace Farhadhp\SimpleTodo\Services;

use Farhadhp\SimpleTodo\Models\Label;
use Farhadhp\SimpleTodo\Models\Task;
use phpDocumentor\Reflection\Types\False_;

class LabelService
{
    /**
     * @param array $titles
     * @return array
     */
    public function getIds(array $titles): array
    {
        if (!$this->insertIfNotExists($titles)) {
            return [];
        }

        return Label::query()
            ->whereIn('title', $titles)
            ->pluck('id')
            ->toArray();
    }

    public function insertIfNotExists(array $titles): bool
    {
        $insertData = [];

        foreach ($titles as $title) {
            $insertData[] = [
                'title' => $title,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        if (!empty($insertData)) {
            Label::query()->insertOrIgnore($insertData);
            return true;
        }

        return false;
    }
}
