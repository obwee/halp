<?php

/**
 * Utils
 * Class library for utility functions.
 */
class Utils
{

    /**
     * sortByDate
     * Sort a multidimensional array by date using usort.
     * @param array $aData
     * @return $aData
     */
    public static function sortByDate(&$aData)
    {
        return usort($aData, fn($aFirstElement, $aSecondElement) =>
            strtotime($aFirstElement['dateRequested']) - strtotime($aSecondElement['dateRequested'])
        );
    }

}