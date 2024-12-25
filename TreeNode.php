<?php

declare(strict_types=1);

/**
 * Leetcode uses this class for tasks related to binary trees.
 * It violates OOP/SOLID principles. Use it just for aligning with leetcode.
 */
class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    public function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}
