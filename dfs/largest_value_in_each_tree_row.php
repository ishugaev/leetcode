<?php

declare(strict_types=1);

require_once "../TreeNode.php";
require_once "../TreeFactory.php";

class Solution
{
    /**
     * @param TreeNode $root
     * @return Integer[]
     */
    public function largestValues($root): array
    {
        $res = [];
        $resByLevels = [];
        $this->dfs($root, 0, $resByLevels);
        foreach ($resByLevels as $resByLevel) {
            $res[] = max($resByLevel);
        }
        return $res;
    }

    private function dfs(?TreeNode $node, int $level, array &$res)
    {
        if ($node === null) {
            return;
        }

        $res[$level][] = $node->val;

        $this->dfs($node->left, $level + 1, $res);
        $this->dfs($node->right, $level + 1, $res);
    }
}

$root = [1,3,2,5,3,null,9];
$treeFactory = new TreeFactory();
$tree = $treeFactory->createTreeFromArray($root);
$expected = [1, 3, 9];
$solution = new Solution();
$res = $solution->largestValues($tree);
var_dump($expected, $res, $res === $expected);