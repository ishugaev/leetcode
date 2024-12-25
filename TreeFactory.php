<?php

declare(strict_types=1);

class TreeFactory
{
    public function createTreeFromArray(array $root): ?TreeNode
    {
        if (empty($root)) {
            return null;
        }

        $nodes = [];
        foreach ($root as $node) {
            $nodes[] = $node === null ? null : new TreeNode($node);
        }

        $c = count($root);
        $i = 0;
        $j = 1;
        while ($j < $c) {
            if ($nodes[$i] !== null) {
                if ($j < $c && $nodes[$j] !== null) {
                    $nodes[$i]->left = $nodes[$j];
                }
                $j++;
                if ($j < $c && $nodes[$j] !== null) {
                    $nodes[$i]->right = $nodes[$j];
                }
                $j++;
            }
            $i++;
        }
        return $nodes[0];
    }
}