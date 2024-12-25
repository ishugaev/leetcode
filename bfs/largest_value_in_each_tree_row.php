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
        if ($root == null) {
            return [];
        }

        return $this->bfs($root);
    }

    private function bfs(?TreeNode $root): array
    {
        $res = [];
        $queue = [$root];

        while (!empty($queue)) {
            $levelSize = count($queue);
            $levelMax = PHP_INT_MIN;

            for ($i = 0; $i < $levelSize; $i++) {
                $node = array_shift($queue);
                $levelMax = max($levelMax, $node->val);

                if ($node->left !== null) {
                    $queue[] = $node->left;
                }

                if ($node->right !== null) {
                    $queue[] = $node->right;
                }
            }

            $res[] = $levelMax;
        }

        return $res;
    }
}

$root = [1,3,2,5,3,null,9];
$treeFactory = new TreeFactory();
$tree = $treeFactory->createTreeFromArray($root);
$expected = [1, 3, 9];
$solution = new Solution();
$res = $solution->largestValues($tree);
var_dump($expected, $res, $res === $expected);

$root = [1,3,5];
$treeFactory = new TreeFactory();
$tree = $treeFactory->createTreeFromArray($root);
$expected = [1, 5];
$solution = new Solution();
$res = $solution->largestValues($tree);
var_dump($expected, $res, $res === $expected);

$root = [1];
$treeFactory = new TreeFactory();
$tree = $treeFactory->createTreeFromArray($root);
$expected = [1];
$solution = new Solution();
$res = $solution->largestValues($tree);
var_dump($expected, $res, $res === $expected);