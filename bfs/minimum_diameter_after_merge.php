<?php

class Solution {

    /**
     * @param Integer[][] $edges1
     * @param Integer[][] $edges2
     * @return Integer
     */
    function minimumDiameterAfterMerge($edges1, $edges2) {
        $adj1 = $this->getAdjacent($edges1);
        $adj2 = $this->getAdjacent($edges2);

        $d1 = $this->getTreeDiameter($adj1);
        $d2 = $this->getTreeDiameter($adj2);

        return max($d1, $d2, ceil($d1 / 2) + ceil($d2 / 2) + 1);
    }

    function getTreeDiameter(array $adj): int {
        [$farthestNode, $dist] = $this->bfs(0, $adj);
        [$farthestNode, $diameter] = $this->bfs($farthestNode, $adj);
        return $diameter;
    }

    function bfs(int $start, array $adj): array {
        $queue = [[$start, 0]];
        $visited = [];
        $visited[$start] = true;
        $farthestNode = $start;
        $maxDist = 0;

        while (!empty($queue)) {
            [$node, $dist] = array_shift($queue);
            foreach ($adj[$node] as $nei) {
                if (!isset($visited[$nei])) {
                    $visited[$nei] = true;
                    $queue[] = [$nei, $dist + 1];
                    if ($dist + 1 > $maxDist) {
                        $maxDist = $dist + 1;
                        $farthestNode = $nei;
                    }
                }
            }
        }

        return [$farthestNode, $maxDist];
    }

    function getAdjacent(array $edges): array {
        $adj = [];
        foreach ($edges as [$n1, $n2]) {
            $adj[$n1][] = $n2;
            $adj[$n2][] = $n1;
        }
        return $adj;
    }
}

$edges1 = [[0,1],[0,2],[0,3]];
$edges2 = [[0,1]];
$expected = 3;
$solution = new Solution();
$res = $solution->minimumDiameterAfterMerge($edges1, $edges2);
var_dump($expected, $res, $res === $expected);

$edges1 = [[0,1],[0,2],[0,3],[2,4],[2,5],[3,6],[2,7]];
$edges2 = [[0,1],[0,2],[0,3],[2,4],[2,5],[3,6],[2,7]];
$expected = 5;
$solution = new Solution();
$res = $solution->minimumDiameterAfterMerge($edges1, $edges2);
var_dump($expected, $res, $res === $expected);

$edges1 = [[0,1],[2,0],[3,2],[3,6],[8,7],[4,8],[5,4],[3,5],[3,9]];
$edges2 = [[0,1],[0,2],[0,3]];
$expected = 7;
$solution = new Solution();
$res = $solution->minimumDiameterAfterMerge($edges1, $edges2);
var_dump($expected, $res, $res === $expected);




